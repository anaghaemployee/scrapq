<?php

namespace frontend\modules\scraps\models;

use Yii;

/**
 * This is the model class for table "booking_confimation".
 *
 * @property int $booking_confirmationId
 * @property int $booking_scraps
 * @property string $type
 */
class BookingConfimation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking_confimation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scrap_book_id', 'type'], 'required'],
            [['scrap_book_id'], 'integer'],
            [['type'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'booking_confirmationId' => 'Booking Confirmation ID',
            'booking_scraps' => 'Booking Scraps',
            'type' => 'Type',
        ];
    }
}
