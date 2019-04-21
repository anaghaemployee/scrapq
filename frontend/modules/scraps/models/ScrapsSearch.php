<?php

namespace frontend\modules\scraps\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\scraps\models\Scraps;

/**
 * ScrapsSearch represents the model behind the search form of `frontend\modules\scraps\models\Scraps`.
 */
class ScrapsSearch extends Scraps
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scrap_id'], 'integer'],
            [['scarp_name', 'scrap_image', 'scrap_status', 'createdDate', 'updatedDate'], 'safe'],
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
        $query = Scraps::find();

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
            'scrap_id' => $this->scrap_id,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'scarp_name', $this->scarp_name])
            ->andFilterWhere(['like', 'scrap_image', $this->scrap_image])
            ->andFilterWhere(['like', 'scrap_status', $this->scrap_status]);

        return $dataProvider;
    }
}
