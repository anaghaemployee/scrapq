<?php

namespace frontend\modules\scraps\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\scraps\models\ScrapBookings;

/**
 * ScrapbookingsSearch represents the model behind the search form of `frontend\modules\scraps\models\ScrapBookings`.
 */
class ScrapbookingsSearch extends ScrapBookings
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scrap_book_id'], 'integer'],
            [['name', 'email', 'mobile', 'pickup_address', 'pick_date', 'pickup_time', 'pickup_scrap', 'scrap_quantity', 'createdDate', 'updatedDate'], 'safe'],
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
        $query = ScrapBookings::find();

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
            'scrap_book_id' => $this->scrap_book_id,
            'pick_date' => $this->pick_date,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'pickup_address', $this->pickup_address])
            ->andFilterWhere(['like', 'pickup_time', $this->pickup_time])
            ;

        return $dataProvider;
    }
}
