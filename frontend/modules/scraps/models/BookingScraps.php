<?php

namespace frontend\modules\scraps\models;

use Yii;

/**
 * This is the model class for table "booking_scraps".
 *
 * @property int $bookingScrapId
 * @property int $scrap_book_id
 * @property int $scrapId
 * @property string $scrap_name
 * @property int $weightquantity
 * @property string $price
 * @property string $price_weight
 */
class BookingScraps extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking_scraps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['scrap_book_id', 'scrapId', 'scrap_name', 'weightquantity', 'price', 'price_weight'], 'required'],
            [['scrap_book_id', 'scrapId', 'weightquantity'], 'integer'],
            [['price', 'price_weight'], 'number'],
            [['scrap_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bookingScrapId' => 'Booking Scrap ID',
            'scrap_book_id' => 'Scrap Book ID',
            'scrapId' => 'Scrap ID',
            'scrap_name' => 'Scrap Name',
            'weightquantity' => 'Weightquantity',
            'price' => 'Price',
            'price_weight' => 'Price Weight',
        ];
    }
}
