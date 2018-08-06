<?php

namespace star\account\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use star\account\models\Withdrawal;

/**
 * WithdrawalSearch represents the model behind the search form about `star\account\models\Withdrawal`.
 */
class WithdrawalSearch extends Withdrawal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['withdrawal_id', 'user_id', 'status', 'create_at', 'update_at'], 'integer'],
            [['withdrawal_fee'], 'number'],
            [['withdrawal_account', 'account_name'], 'safe'],
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
        $query = Withdrawal::find();

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
            'withdrawal_id' => $this->withdrawal_id,
            'user_id' => $this->user_id,
            'withdrawal_fee' => $this->withdrawal_fee,
            'status' => $this->status,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'withdrawal_account', $this->withdrawal_account])
            ->andFilterWhere(['like', 'account_name', $this->account_name]);

        return $dataProvider;
    }
}
