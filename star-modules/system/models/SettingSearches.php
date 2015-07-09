<?php

namespace star\system\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use star\system\models\Setting;

/**
 * SettingSearches represents the model behind the search form about `star\system\models\Setting`.
 */
class SettingSearches extends Setting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['setting_id', 'menu_sort', 'group_sort'], 'integer'],
            [['menu_code', 'menu_label', 'group_code', 'group_label'], 'safe'],
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
        $query = Setting::find();

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
            'setting_id' => $this->setting_id,
            'menu_sort' => $this->menu_sort,
            'group_sort' => $this->group_sort,
        ]);

        $query->andFilterWhere(['like', 'menu_code', $this->menu_code])
            ->andFilterWhere(['like', 'menu_label', $this->menu_label])
            ->andFilterWhere(['like', 'group_code', $this->group_code])
            ->andFilterWhere(['like', 'group_label', $this->group_label]);

        return $dataProvider;
    }
}
