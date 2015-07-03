<?php

namespace star\payment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use star\payment\models\Payment;

/**
 * PaymentSearch represents the model behind the search form about `star\payment\models\Payment`.
 */
class PaymentSearch extends Payment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_id', 'order_id', 'payment_method', 'create_at', 'status'], 'integer'],
            [['payment_fee'], 'number'],
            [['transcation_no'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Payment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'payment_id' => $this->payment_id,
            'order_id' => $this->order_id,
            'payment_method' => $this->payment_method,
            'payment_fee' => $this->payment_fee,
            'create_at' => $this->create_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'transcation_no', $this->transcation_no]);

        return $dataProvider;
    }
}
