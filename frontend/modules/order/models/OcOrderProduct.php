<?php

namespace frontend\modules\order\models;

use Yii;

/**
 * This is the model class for table "oc_order_product".
 *
 * @property int $order_product_id
 * @property int $order_id
 * @property int $product_id
 * @property string $name
 * @property string $model
 * @property int $quantity
 * @property string $price
 * @property string $total
 * @property string $tax
 * @property int $reward
 */
class OcOrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oc_order_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'name', 'model', 'quantity', 'reward'], 'required'],
            [['order_id', 'product_id', 'quantity', 'reward'], 'integer'],
            [['price', 'total', 'tax'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['model'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_product_id' => 'Order Product ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'name' => 'Name',
            'model' => 'Model',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
            'tax' => 'Tax',
            'reward' => 'Reward',
        ];
    }
}
