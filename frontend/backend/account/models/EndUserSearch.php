<?php

namespace frontend\backend\account\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\account\models\EndUser;

/**
 * EndUserSearch represents the model behind the search form of `frontend\backend\account\models\EndUser`.
 */
class EndUserSearch extends EndUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CUSTOMER_ID', 'STATUS', 'YEAR_AT', 'MONTH_AT'], 'integer'],
            [['ACCESS_GROUP', 'STORE_ID', 'NAME', 'EMAIL', 'PHONE', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'DCRP_DETIL'], 'safe'],
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
        $query = EndUser::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'CUSTOMER_ID' => $this->CUSTOMER_ID,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
            'YEAR_AT' => $this->YEAR_AT,
            'MONTH_AT' => $this->MONTH_AT,
        ]);

        $query->andFilterWhere(['like', 'ACCESS_GROUP', $this->ACCESS_GROUP])
            ->andFilterWhere(['like', 'STORE_ID', $this->STORE_ID])
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
            ->andFilterWhere(['like', 'PHONE', $this->PHONE])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'DCRP_DETIL', $this->DCRP_DETIL]);

        return $dataProvider;
    }
}
