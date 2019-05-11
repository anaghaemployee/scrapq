<?php

namespace frontend\modules\scraps\models;

use Yii;

/**
 * This is the model class for table "scrap_bookings".
 *
 * @property int $scrap_book_id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $pickup_address
 * @property string $pick_date
 * @property string $pickup_time
 * @property string $pickup_term
 * @property string $pickup_scrap
 * @property string $scrap_quantity
 * @property string $createdDate
 * @property string $updatedDate
 */
class ScrapBookings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $scrap_name;
	public $needcash;
    public static function tableName()
    {
        return 'scrap_bookings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'mobile',  'pick_date', 'pickup_time',  'createdDate'], 'required'],
        	[['name', 'email', 'mobile', 'pickup_address', 'pick_date', 'pickup_time', 'createdDate'], 'safe'],
            [['pickup_address'], 'string'],
            [['pick_date', 'createdDate', 'updatedDate'], 'safe'],
            [['name', 'email', 'pickup_time', ], 'string', 'max' => 200],
            [['mobile'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'scrap_book_id' => 'Scrap Book ID',
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'pickup_address' => 'Pickup Address',
            'pick_date' => 'Pickup Date',
            'pickup_time' => 'Pickup Time',
            'pickup_term' => 'Pickup Term',
            'pickup_scrap' => 'Pickup Scrap',
            'scrap_quantity' => 'Scrap Quantity',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
