<?php

namespace star\catalog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use star\catalog\models\ItemProp;

/**
 * ItemPropSearch represents the model behind the search form about `star\catalog\models\ItemProp`.
 */
class ItemPropSearch extends ItemProp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prop_id', 'category_id', 'parent_prop_id', 'parent_value_id', 'type', 'is_key_prop', 'is_sale_prop', 'is_color_prop', 'must', 'multi', 'status', 'sort_order'], 'integer'],
            [['prop_name', 'prop_alias'], 'safe'],
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
        $query = ItemProp::find();

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
            'prop_id' => $this->prop_id,
            'category_id' => $this->category_id,
            'parent_prop_id' => $this->parent_prop_id,
            'parent_value_id' => $this->parent_value_id,
            'type' => $this->type,
            'is_key_prop' => $this->is_key_prop,
            'is_sale_prop' => $this->is_sale_prop,
            'is_color_prop' => $this->is_color_prop,
            'must' => $this->must,
            'multi' => $this->multi,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
        ]);

        $query->andFilterWhere(['like', 'prop_name', $this->prop_name])
            ->andFilterWhere(['like', 'prop_alias', $this->prop_alias]);

        return $dataProvider;
    }
}
