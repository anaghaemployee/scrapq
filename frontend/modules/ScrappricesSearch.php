<?php

namespace frontend\modules\scraps\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\scraps\models\ScrapPrices;

/**
 * ScrappricesSearch represents the model behind the search form of `frontend\modules\scraps\models\ScrapPrices`.
 */
class ScrappricesSearch extends ScrapPrices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scrap_price_id', 'scrap_id'], 'integer'],
            [['scrap_price', 'scrap_quantity', 'createdDate', 'updatedDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ScrapPrices::find();

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
            'scrap_price_id' => $this->scrap_price_id,
            'scrap_id' => $this->scrap_id,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'scrap_price', $this->scrap_price])
            ->andFilterWhere(['like', 'scrap_quantity', $this->scrap_quantity]);

        return $dataProvider;
    }
}
