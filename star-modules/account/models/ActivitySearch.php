<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-29
 * Time: 下午2:07
 */

namespace star\account\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ActivitySearch represents the model behind the search form about `p2p\activity\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'activity_type', 'activity_send_type', 'vaild_date', 'create_time', 'update_time', 'is_delete'], 'integer'],
            [['activity_send_value'], 'safe'],
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
        $query = Activity::find();

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
            'activity_id' => $this->activity_id,
            'activity_type' => $this->activity_type,
            'activity_send_type' => $this->activity_send_type,
            'vaild_date' => $this->vaild_date,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_delete' => $this->is_delete,
        ]);

        $query->andFilterWhere(['like', 'activity_send_value', $this->activity_send_value]);

        return $dataProvider;
    }
}