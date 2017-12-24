<?php

namespace frontend\backend\basic\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\basic\models\Industri;

/**
 * IndustriSearch represents the model behind the search form of `frontend\backend\basic\models\Industri`.
 */
class IndustriSearch extends Industri
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INDUSTRY_ID', 'INDUSTRY_GRP_ID', 'STATUS'], 'integer'],
            [['INDUSTRY_NM', 'CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT'], 'safe'],
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
        $query = Industri::find();

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
            'INDUSTRY_ID' => $this->INDUSTRY_ID,
            'INDUSTRY_GRP_ID' => $this->INDUSTRY_GRP_ID,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'INDUSTRY_NM', $this->INDUSTRY_NM])
            ->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY]);

        return $dataProvider;
    }
}
