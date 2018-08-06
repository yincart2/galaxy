<?php
/**
 * the layouts for member module
 * @var yii\web\View $this
 **/
use yii\helpers\Url;

$this->beginContent('@theme/cluster/default/layouts/main.php');

?>
    <div class="row">

        <aside class="col-md-3 col-sm-4">

            <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

            <section class="section_offset">

                <h3><?= Yii::t('member', 'Member Center') ?></h3>

                <ul class="theme_menu">

                    <li class="<?= isset($this->params['information']) ? 'current' : ''?>">
                        <a href="<?= Url::to(['/member/default/index']) ?>">
                            <?= Yii::t('member', 'Member Information') ?>
                        </a>
                    </li>
                    <li class="<?= isset($this->params['wishlist']) ? 'current' : ''?>">
                        <a href="<?= Url::to(['/member/wishlist/get-wishlist']) ?>">
                            <?= Yii::t('member', 'My WishList') ?>
                        </a>
                    </li>
                    <li class="<?= isset($this->params['delivery-address']) ? 'current' : ''?>">
                        <a href="<?= Url::to(['/member/address/delivery-address']) ?>">
                            <?= Yii::t('member', 'Delivery Address') ?>
                        </a>
                    </li>
                    <li class="<?= isset($this->params['order-list']) ? 'current' : ''?>">
                        <a href="<?= Url::to(['/order/home/order/list']) ?>">
                            <?= Yii::t('member', 'Order') ?>
                        </a>
                    </li>
                    <li class="<?= isset($this->params['refund-list']) ? 'current' : ''?>">
                        <a href="<?= Url::to(['/refund/home/refund/index']) ?>">
                            <?= Yii::t('refund', 'Refund Log') ?>
                        </a>
                    </li>
                    <li class="<?= isset($this->params['withdrawal-log']) ? 'current' : ''?>">
                        <a href="<?= Url::to(['/account/home/account/withdrawal-log']) ?>">
                            <?= Yii::t('account', 'Withdrawal Log') ?>
                        </a>
                    </li>
                    <li class="<?= isset($this->params['money-log']) ? 'current' : ''?>">
                        <a href="<?= Url::to(['/account/home/account/money-log']) ?>">
                            <?= Yii::t('account', 'Money Log') ?>
                        </a>
                    </li>
                </ul>

            </section>
            <!--/ .section_offset -->

            <!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

        </aside>
        <!--/ [col]-->

        <main class="col-md-9 col-sm-8">
            <?= $content ?>
        </main>
        <!--/ [col]-->

    </div><!--/ .row-->

<?php $this->endContent(); ?>