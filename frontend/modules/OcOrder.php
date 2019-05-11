<?php

namespace frontend\modules\order\models;

use Yii;

/**
 * This is the model class for table "oc_order".
 *
 * @property int $order_id
 * @property int $invoice_no
 * @property string $invoice_prefix
 * @property int $store_id
 * @property string $store_name
 * @property string $store_url
 * @property int $customer_id
 * @property int $customer_group_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $telephone
 * @property string $fax
 * @property string $custom_field
 * @property string $payment_firstname
 * @property string $payment_lastname
 * @property string $payment_company
 * @property string $payment_address_1
 * @property string $payment_address_2
 * @property string $payment_city
 * @property string $payment_postcode
 * @property string $payment_country
 * @property int $payment_country_id
 * @property string $payment_zone
 * @property int $payment_zone_id
 * @property string $payment_address_format
 * @property string $payment_custom_field
 * @property string $payment_method
 * @property string $payment_code
 * @property string $shipping_firstname
 * @property string $shipping_lastname
 * @property string $shipping_company
 * @property string $shipping_address_1
 * @property string $shipping_address_2
 * @property string $shipping_city
 * @property string $shipping_postcode
 * @property string $shipping_country
 * @property int $shipping_country_id
 * @property string $shipping_zone
 * @property int $shipping_zone_id
 * @property string $shipping_address_format
 * @property string $shipping_custom_field
 * @property string $shipping_method
 * @property string $shipping_code
 * @property string $comment
 * @property string $total
 * @property int $order_status_id
 * @property int $affiliate_id
 * @property string $commission
 * @property int $marketing_id
 * @property string $tracking
 * @property int $language_id
 * @property int $currency_id
 * @property string $currency_code
 * @property string $currency_value
 * @property string $ip
 * @property string $forwarded_ip
 * @property string $user_agent
 * @property string $accept_language
 * @property string $date_added
 * @property string $date_modified
 */
class OcOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oc_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'store_id', 'customer_id', 'customer_group_id', 'payment_country_id', 'payment_zone_id', 'shipping_country_id', 'shipping_zone_id', 'order_status_id', 'affiliate_id', 'marketing_id', 'language_id', 'currency_id'], 'integer'],
            [[ 'store_name', 'store_url', 'firstname', 'email', 'telephone',  'payment_firstname', 'payment_address_1', 'payment_address_2', 'payment_city', 'payment_postcode', 'payment_country', 'payment_country_id', 'payment_zone', 'payment_zone_id',  'shipping_firstname',  'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_country', 'shipping_country_id', 'shipping_zone', 'shipping_zone_id',  'affiliate_id', 'commission', 'marketing_id', 'language_id', 'currency_id', 'currency_code', 'ip', 'user_agent', 'accept_language', 'date_added', 'date_modified'], 'required'],
            [['custom_field', 'payment_address_format', 'payment_custom_field', 'shipping_address_format', 'shipping_custom_field', 'comment'], 'string'],
            [['total', 'commission', 'currency_value'], 'number'],
            [['date_added', 'date_modified'], 'safe'],
            [['invoice_prefix'], 'string', 'max' => 26],
            [['store_name', 'tracking'], 'string', 'max' => 64],
            [['store_url', 'user_agent', 'accept_language'], 'string', 'max' => 255],
            [['firstname', 'lastname', 'telephone', 'fax', 'payment_firstname', 'payment_lastname', 'shipping_firstname', 'shipping_lastname'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 96],
            [['payment_company'], 'string', 'max' => 60],
            [['payment_address_1', 'payment_address_2', 'payment_city', 'payment_country', 'payment_zone', 'payment_method', 'payment_code', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_country', 'shipping_zone', 'shipping_method', 'shipping_code'], 'string', 'max' => 128],
            [['payment_postcode', 'shipping_postcode'], 'string', 'max' => 10],
            [['shipping_company', 'ip', 'forwarded_ip'], 'string', 'max' => 40],
            [['currency_code'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'invoice_no' => 'Invoice No',
            'invoice_prefix' => 'Invoice Prefix',
            'store_id' => 'Store ID',
            'store_name' => 'Store Name',
            'store_url' => 'Store Url',
            'customer_id' => 'Customer ID',
            'customer_group_id' => 'Customer Group ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'fax' => 'Fax',
            'custom_field' => 'Custom Field',
            'payment_firstname' => 'Payment Firstname',
            'payment_lastname' => 'Payment Lastname',
            'payment_company' => 'Payment Company',
            'payment_address_1' => 'Payment Address 1',
            'payment_address_2' => 'Payment Address 2',
            'payment_city' => 'Payment City',
            'payment_postcode' => 'Payment Postcode',
            'payment_country' => 'Payment Country',
            'payment_country_id' => 'Payment Country ID',
            'payment_zone' => 'Payment Zone',
            'payment_zone_id' => 'Payment Zone ID',
            'payment_address_format' => 'Payment Address Format',
            'payment_custom_field' => 'Payment Custom Field',
            'payment_method' => 'Payment Method',
            'payment_code' => 'Payment Code',
            'shipping_firstname' => 'Shipping Firstname',
            'shipping_lastname' => 'Shipping Lastname',
            'shipping_company' => 'Shipping Company',
            'shipping_address_1' => 'Shipping Address 1',
            'shipping_address_2' => 'Shipping Address 2',
            'shipping_city' => 'Shipping City',
            'shipping_postcode' => 'Shipping Postcode',
            'shipping_country' => 'Shipping Country',
            'shipping_country_id' => 'Shipping Country ID',
            'shipping_zone' => 'Shipping Zone',
            'shipping_zone_id' => 'Shipping Zone ID',
            'shipping_address_format' => 'Shipping Address Format',
            'shipping_custom_field' => 'Shipping Custom Field',
            'shipping_method' => 'Shipping Method',
            'shipping_code' => 'Shipping Code',
            'comment' => 'Comment',
            'total' => 'Total',
            'order_status_id' => 'Order Status ID',
            'affiliate_id' => 'Affiliate ID',
            'commission' => 'Commission',
            'marketing_id' => 'Marketing ID',
            'tracking' => 'Tracking',
            'language_id' => 'Language ID',
            'currency_id' => 'Currency ID',
            'currency_code' => 'Currency Code',
            'currency_value' => 'Currency Value',
            'ip' => 'Ip',
            'forwarded_ip' => 'Forwarded Ip',
            'user_agent' => 'User Agent',
            'accept_language' => 'Accept Language',
            'date_added' => 'Date Added',
            'date_modified' => 'Date Modified',
        ];
    }
}
