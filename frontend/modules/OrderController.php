<?php

namespace frontend\modules\order\controllers;

use Yii;
use frontend\modules\cart\models\Cart;
use frontend\modules\order\models\OcOrder;
use frontend\modules\scraps\models\ScrapBookings;
use frontend\modules\order\models\OcOrderProduct;
use frontend\modules\exchange\models\OcProduct;
use frontend\modules\scraps\models\BookingConfimation;
class OrderController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate($bookingid)
    {
    	$total=0;
    	$model = new OcOrder();
    	$cartdata = Cart::findCartData($bookingid);
    	foreach($cartdata as $key=>$value){
    		$total = $total+$value['price_weight'];
    	}
    	$bookingaddress = ScrapBookings::find()->where(['scrap_book_id'=>$bookingid])->one();
    	$address = explode(',',$bookingaddress->pickup_address);
    	$exchangeamount = BookingConfimation::find()->where(['scrap_book_id'=>$bookingid])->one();
    	$zone = explode(' ',$address[6]);      	
    	$model->invoice_no ='0';
    	$model->invoice_prefix ='INV-2013-00';
    	$model->store_name ='Paper Industry';
    	$model->store_url ='http://papex.in/';
    	$model->customer_group_id =1;
    	$model->firstname =$bookingaddress->name;
    	$model->lastname ='';
    	$model->email =$bookingaddress->email;
    	$model->telephone =$bookingaddress->mobile;
    	$model->payment_firstname =$bookingaddress->name;
    	$model->payment_lastname ='';
    	$model->payment_company ='';
    	$model->payment_address_1 =$address[0].','.$address[1];
    	$model->payment_address_2 =$address[2].','.$address[3].','.$address[4];
    	$model->payment_city =$address[5];
    	$model->payment_postcode =$zone[2];
    	$model->payment_country =$address[7];
    	$model->payment_country_id ='99';
    	$model->payment_zone =$zone[1];
    	$model->payment_zone_id ='4231';
    	$model->payment_address_format ='';
    	$model->payment_custom_field ='';
    	$model->payment_method ='';
    	$model->payment_code ='';
    	$model->shipping_firstname =$bookingaddress->name;
    	$model->shipping_lastname ='';
    	$model->shipping_company ='';
    	$model->shipping_address_1 =$address[0].','.$address[1];
    	$model->shipping_address_2 =$address[2].','.$address[3].','.$address[4];
    	$model->shipping_city =$address[5];
    	$model->shipping_postcode =$zone[2];
    	$model->shipping_country =$address[7];
    	$model->shipping_country_id ='99';
    	$model->shipping_zone =$zone[1];
    	$model->shipping_zone_id ='4231';
    	$model->shipping_address_format ='';
    	$model->shipping_custom_field ='';
    	$model->shipping_method ='';
    	$model->shipping_code ='';
    	$model->comment ='';
    	$model->total =$total;
    	$model->order_status_id =6;
    	$model->affiliate_id =0;
    	$model->commission =0.0000;
    	$model->marketing_id =0;
    	$model->tracking ='';
    	$model->language_id =1;
    	$model->currency_id =4;
    	$model->currency_code ="IND";
    	$model->currency_value =1.00000000;
    	$model->ip =$_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
    	$model->forwarded_ip ='';
    	$model->user_agent ='Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36';
    	$model->accept_language ='en-US,en;q=0.9';
    	$model->date_added =date("Y-m-d H:i:s");
    	$model->date_modified =date("Y-m-d H:i:s");
    	//print_r($model);exit;
    	if($model->save()){
    		foreach($cartdata as $key=>$value){
    		$orderproductsmodel = new OcOrderProduct();
    		$orderproductsmodel->order_id = $model->order_id;
    		$orderproductsmodel->product_id = $value['scrap_id'];
    		$orderproductsmodel->name = $value['scrap_name'];
    		$product = OcProduct::find()->where(['product_id'=>$value['scrap_id']])->one();
    		$orderproductsmodel->model = $product->model;
    		$orderproductsmodel->quantity = $value['weightquantity'];
    		$orderproductsmodel->price = $value['price'];
    		$orderproductsmodel->total = $value['price_weight'];
    		$orderproductsmodel->tax = 0;
    		$orderproductsmodel->reward = 0;
    		$orderproductsmodel->save();
    		Cart::deleteAll(['booking_id'=>$bookingid]);
    		}
    		if($exchangeamount == '0.00'){
    			Yii::$app->getSession()->setFlash('success', 'Your are success fully exchange scrap with your required products');
    			$this->redirect(['/site/index']);
    		}
    		else{
    			Yii::$app->getSession()->setFlash('success', 'Your are success fully exchange scrap with your required products and remaining cash will give at we arrive');
    			$this->redirect(['/site/index']);
    		}
    	}
    	else{
    		print_r($model->errors);exit;
    	}
    	
    }

}
