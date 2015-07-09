<?php

namespace star\shipment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use star\shipment\models\Shipment;

/**
 * ShipmentSearch represents the model behind the search form about `star\shipment\models\Shipment`.
 */
class ShipmentSearch extends Shipment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipment_id', 'order_id', 'create_at', 'status'], 'integer'],
            [['shipment_method', 'trace_no'], 'safe'],
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
        $query = Shipment::find();

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
            'shipment_id' => $this->shipment_id,
            'order_id' => $this->order_id,
            'create_at' => $this->create_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'shipment_method', $this->shipment_method])
            ->andFilterWhere(['like', 'trace_no', $this->trace_no]);

        return $dataProvider;
    }
}
