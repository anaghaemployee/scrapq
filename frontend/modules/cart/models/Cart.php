<?php

namespace frontend\modules\cart\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $cart_id
 * @property int $scrap_id
 * @property string $scrap_name
 * @property string $session_id
 * @property int $weightquantity
 * @property string $price
 * @property string $price_weight
 * @property string $created_date
 * @property string $updated_date
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $model;
    public static function tableName()
    {
        return 'cart';
    }
	
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scrap_id', 'scrap_name', 'session_id', 'weightquantity', 'price', 'price_weight', 'created_date', 'updated_date'], 'required'],
            [['scrap_id', 'weightquantity'], 'integer'],
            [['price', 'price_weight'], 'number'],
            [['created_date', 'updated_date','model'], 'safe'],
            [['scrap_name', 'session_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cart_id' => 'Cart ID',
            'scrap_id' => 'Scrap ID',
            'scrap_name' => 'Scrap Name',
            'session_id' => 'Session ID',
            'weightquantity' => 'Weightquantity',
            'price' => 'Price',
            'price_weight' => 'Price Weight',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
    public static function findCartData($bookingid)
    {
    	$data = array();
    	$data = Cart::find('cart.*,oc_product.model')->innerjoin(['oc_product','cart.scrap_id=oc_product.product_id'])->where(['booking_id'=>$bookingid])->asArray()->all();
    	return $data;
    }
}
