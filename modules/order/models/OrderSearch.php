<?php

namespace star\order\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use star\order\models\Order;

/**
 * OrderSearch represents the model behind the search form about `star\order\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'star_id', 'create_at', 'update_at', 'status'], 'integer'],
            [['order_no', 'address', 'memo'], 'safe'],
            [['total_price', 'shipping_fee', 'payment_fee'], 'number'],
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
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find()->orderBy([ 'create_at' => SORT_DESC]);

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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'star_id' => $this->star_id,
            'total_price' => $this->total_price,
            'shipping_fee' => $this->shipping_fee,
            'payment_fee' => $this->payment_fee,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'order_no', $this->order_no])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'memo', $this->memo]);

        return $dataProvider;
    }
}
