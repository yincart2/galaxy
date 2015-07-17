<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-7-15
 * Time: 下午2:17
 */

namespace star\payment\models\paypal;

use PayPal\Api\Amount;
use PayPal\Api\Authorization;
use PayPal\Api\Capture;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use star\order\models\Order;
use star\system\models\SingletonSetting;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Yii;
use yii\helpers\Url;

class PayPal extends Model
{
    const MODE_SANDBOX = 'sandbox';
    const MODE_LIVE = 'live';

    const LOG_LEVEL_FINE = 'FINE';
    const LOG_LEVEL_INFO = 'INFO';
    const LOG_LEVEL_WARN = 'WARN';
    const LOG_LEVEL_ERROR = 'ERROR';

    private $_apiContext = null;
    public $clientId;
    public $clientSecret;
    public $isProduction = false;
    public $currency = 'USD';
    public $config = [];

    private function setConfig()
    {
        $setting = \Yii::createObject(SingletonSetting::className());
        // ### Api context
        // Use an ApiContext object to authenticate
        // API calls. The clientId and clientSecret for the
        // OAuthTokenCredential class can be retrieved from
        // developer.paypal.com
        $this->_apiContext = new ApiContext(
            new OAuthTokenCredential(
                $this->clientId = trim($setting->getSettingValue('payment_paypal_clientId')),
                $this->clientSecret = trim($setting->getSettingValue('payment_paypal_clientSecret'))
            )
        );
        $this->_apiContext->setConfig(ArrayHelper::merge(
                [
                    'mode'                      => $setting->getSettingValue('payment_paypal_mode'), // development (sandbox) or production (live) mode
                    'http.ConnectionTimeOut'    => 30,
                    'http.Retry'                => 1,
                    'log.LogEnabled'            => $setting->getSettingValue('payment_paypal_log'),
                    'log.FileName'              => Yii::getAlias('@runtime/logs/paypal.log'),
                    'log.LogLevel'              => self::LOG_LEVEL_FINE,
                    'validation.level'          => 'log',
                    'cache.enabled'             => 'true'
                ],$this->config)
        );
        // Set file name of the log if present
        if (isset($this->config['log.FileName'])
            && isset($this->config['log.LogEnabled'])
            && ((bool)$this->config['log.LogEnabled'] == true)
        ) {
            $logFileName = \Yii::getAlias($this->config['log.FileName']);
            if ($logFileName) {
                if (!file_exists($logFileName)) {
                    if (!touch($logFileName)) {
                        throw new ErrorException('Can\'t create paypal.log file at: ' . $logFileName);
                    }
                }
            }
            $this->config['log.FileName'] = $logFileName;
        }

        return $this->_apiContext;
    }

    public function init(){
        $this->setConfig();
    }

    public function pay($id)
    {

        // ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

// ### Itemized information
// (Optional) Lets you specify item wise
// information

        $order = \Yii::createObject(Order::className())->findOne($id);
        $orderItems = $order->orderItem;
        $itemTmp = [];
        foreach($orderItems as $orderItem){
            $item = new Item();
            $item->setName($orderItem->name)
                ->setCurrency($this->currency)
                ->setQuantity($orderItem->qty)
                ->setPrice($orderItem->price);
            $itemTmp[]= $item;
        }

        $itemList = new ItemList();
        $itemList->setItems($itemTmp);

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
        $details = new Details();
        $total = $order->total_price-$order->shipping_fee-$order->payment_fee;
        $details->setShipping($order->shipping_fee)
            ->setTax($order->payment_fee)
            ->setSubtotal($total);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency($this->currency)
            ->setDetails($details)
            ->setTotal($order->total_price);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber($order->order_no);

// ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(Url::to(['/payment/home/pay-pal/return','success'=>true],true))
            ->setCancelUrl(Url::to(['/','success'=>false],true));

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'order'
        $payment = new Payment();
        $payment->setIntent("order")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval

       $payment->create($this->_apiContext);


// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getApprovalLink()
// method

        $approvalUrl = $payment->getApprovalLink();
        /** @var  $paymentModel \star\payment\models\Payment*/
        $paymentModel = Yii::createObject(\star\payment\models\Payment::className());
        $paymentModel->setAttributes([
            'order_id'=>$order->order_id,
            'payment_method'=>$paymentModel::PAYPAL,
            'payment_fee'=>0,
            'transcation_no'=>$payment->id,
            'status'=>$paymentModel::STATUS_WAIT_BUYER_PAY,
        ]);
        if(!$paymentModel->save()){
            throw new Exception(Yii::t('payment','create payment record fail'));
        }

        return $approvalUrl;
    }

    public function executePayment($paymentId,$payerID){
        $payment = Payment::get($paymentId, $this->_apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerID);
        try {
             $payment->execute($execution, $this->_apiContext);
            try {
                $payment = Payment::get($paymentId, $this->_apiContext);
            } catch (Exception $ex) {

                exit(1);
            }
        } catch (Exception $ex) {

            exit(1);
        }

        return $payment;
    }

    /**
     * 看着官方的文档执行了下面的步骤  不过搞不懂有什么用
     * @param $payment
     * @return Capture
     */
    public function getOrder($payment){
        $transactions = $payment->getTransactions();
        $transaction = $transactions[0];
        $relatedResources = $transaction->getRelatedResources();
        $relatedResource = $relatedResources[0];
        $order = $relatedResource->getOrder();

        $order  = \PayPal\Api\Order::get($order->getId(), $this->_apiContext);

        $authorization = new Authorization();
        $amount = $order->getAmount();
        $amount->setDetails(null);
        $authorization->setAmount($amount);

        $order->authorize($authorization, $this->_apiContext);


        $capture = new Capture();
        $capture->setIsFinalCapture(true);
        $capture->setAmount($amount);
        $result = $order->capture($capture,$this->_apiContext);

        return $result;
    }
} 