<?php

namespace star\catalog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use star\catalog\models\Item;

/**
 * ItemSearch represents the model behind the search form about `star\catalog\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'category_id', 'stock', 'min_number', 'is_show', 'is_promote', 'is_new', 'is_hot', 'is_best', 'click_count', 'wish_count', 'review_count', 'deal_count', 'create_time', 'update_time', 'country', 'state', 'city'], 'integer'],
            [['star_id', 'title', 'currency', 'props', 'props_name', 'desc', 'language'], 'safe'],
            [['price', 'shipping_fee'], 'number'],
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
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'item_id' => $this->item_id,
            'category_id' => $this->category_id,
            'stock' => $this->stock,
            'min_number' => $this->min_number,
            'price' => $this->price,
            'shipping_fee' => $this->shipping_fee,
            'is_show' => $this->is_show,
            'is_promote' => $this->is_promote,
            'is_new' => $this->is_new,
            'is_hot' => $this->is_hot,
            'is_best' => $this->is_best,
            'click_count' => $this->click_count,
            'wish_count' => $this->wish_count,
            'review_count' => $this->review_count,
            'deal_count' => $this->deal_count,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
        ]);

        $query->andFilterWhere(['like', 'star_id', $this->star_id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'props', $this->props])
            ->andFilterWhere(['like', 'props_name', $this->props_name])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
