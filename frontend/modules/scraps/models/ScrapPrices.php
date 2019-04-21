<?php

namespace frontend\modules\scraps\models;

use Yii;

/**
 * This is the model class for table "scrap_prices".
 *
 * @property int $scrap_price_id
 * @property int $scrap_id
 * @property string $scrap_price
 * @property string $scrap_quantity
 * @property string $createdDate
 * @property string $updatedDate
 */
class ScrapPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	 public $scrap_name;
    public static function tableName()
    {
        return 'scrap_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scrap_id', 'scrap_price', 'scrap_quantity', 'createdDate', 'updatedDate'], 'safe'],
            [['scrap_id'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['scrap_price', 'scrap_quantity'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'scrap_price_id' => 'Scrap Price ID',
            'scrap_id' => 'Scrap ID',
            'scrap_price' => 'Scrap Price',
            'scrap_quantity' => 'Scrap Quantity',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
