<?php

namespace star\blog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use star\blog\models\Post;

/**
 * PostSearch represents the model behind the search form about `common\modules\blog\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'user_id', 'language_id', 'star_id', 'cluster_id', 'station_id', 'status', 'views', 'allow_comment', 'create_time', 'update_time'], 'integer'],
            [['title', 'url', 'source', 'summary', 'content', 'tags'], 'safe'],
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
        $query = Post::find();

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
            'id' => $this->id,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
            'language_id' => $this->language_id,
            'star_id' => $this->star_id,
            'cluster_id' => $this->cluster_id,
            'station_id' => $this->station_id,
            'status' => $this->status,
            'views' => $this->views,
            'allow_comment' => $this->allow_comment,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        $query->orderBy('id desc');

        return $dataProvider;
    }
}
