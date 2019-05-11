<?php

namespace frontend\modules\cart\controllers;

use Yii;
use frontend\modules\scraps\models\Scraps;
use frontend\modules\cart\models\Cart;
use frontend\modules\scraps\models\ScrapBookings;
use frontend\modules\scraps\models\BookingScraps;
use frontend\modules\scraps\models\BookingConfimation;
class CartController extends \yii\web\Controller
{
    public function actionIndex($id)
    {	
    	if($id == 0){
    	$model = new ScrapBookings(); 
    	$this->layout = '/version';
    	$cart = Cart::find()->where(['session_id'=>Yii::$app->session->getId(),'booking_id' =>$id])->all();
    	
        return $this->render('index',['cart'=>$cart,'model'=>$model]);
    	}
    	else{ 
    		$price =0;
    		$bkinfo = BookingScraps::find()->where(['scrap_book_id'=>$id])->all();
    		foreach ($bkinfo as $key=>$value){
    		$price = $price + $value['price_weight'];
    		}
    		$this->layout = '/version';
    		$cart = Cart::find()->where(['booking_id' =>$id])->all();
    		if(!empty($cart)){
    		return $this->render('exchangeindex',['cart'=>$cart,'exchangeprice'=>$price]);
    		}
    		else{
    			$model = new ScrapBookings();
    			$this->layout = '/version';
    			$cart = Cart::find()->where(['session_id'=>Yii::$app->session->getId(),'booking_id' =>0])->all();    			 
    			return $this->render('index',['cart'=>$cart,'model'=>$model]);
    			 
    		}
    	}
    }
    
    public function actionAdd(){
    	$model = new Cart();
    	$json = array();
    	$qty = 1;
    	$price = $_GET['price'];
    	$scrapid = $_GET['scrapid'];
    	$sign = $_GET['inc'];    	
    	$scrapname = Scraps::findByScrap($scrapid);
    	$model->scrap_id= $scrapid;
    	$model->scrap_name= $scrapname->scarp_name;
    	$model->session_id	= Yii::$app->session->getId();
    	$model->weightquantity	= $qty;
    	$model->price	= $price;
    	if($qty !=0){
    	$model->price_weight= $price * $qty;
    	}else{
    		$model->price_weight= $price;
    	}
    	$model->created_date= date("Y-m-d H:i:s");
    	$model->updated_date= date("Y-m-d H:i:s");
    	
    	$query = Cart::find()->where(['scrap_id'=>$model->scrap_id,'session_id'=>$model->session_id])->one();
		if( $query == ''){
			if($sign == 'inc'){
			$model->save();			
			
			}
		}
		else{
			if($sign == 'inc'){		
			$query->weightquantity =$query->weightquantity+ $qty;
			}
			else{
				$query->weightquantity = $query->weightquantity - $qty;
			}
			$query->price_weight= $price * $query->weightquantity;
			$query->updated_date= date("Y-m-d H:i:s");
			$json['qty'] = $query->weightquantity;
			$json['price'] = 'Rs. '.number_format($query->price_weight,2);
			//print_r($query->weightquantity);exit;
			if($query->weightquantity != 0){
			$query->update();
			}
			else{
				$query->delete();
			}		
			
		}
		$json['qty'] = 1;
		$json['price'] = 'Rs. '.number_format($price,2);
		$cartcount = 0;
		$cartdata = Cart::find()->where(['session_id'=>$model->session_id,'booking_id'=>0])->asarray()->all();
		foreach($cartdata as $key=>$value){
			$cartcount = $cartcount +$value['weightquantity'];
		}
		$json['status'] = "Success";
		$json['cartcount'] = $cartcount;
		//print_r($json);exit;
		
		return json_encode($json);
		
    }
    public function actionCartupdate(){
    	
    	$model = new Cart();
    	$json = array();
    	$qty = $_GET['qty'];
    	$price = $_GET['price'];
    	$scrapid = $_GET['scrapid'];
    	$sign = $_GET['inc'];
    	
    	$model->session_id = Yii::$app->session->getId();    
    	$query = Cart::find()->where(['session_id'=>$model->session_id,'scrap_id'=>$scrapid])->one();
    	if($sign == 'inc'){
    	$query->weightquantity = $qty + 1;
    	}
    	else{
    		$query->weightquantity = $qty-1;
    	}
    	//print_r($query->weightquantity);exit;
    	$query->price_weight= $price * $query->weightquantity;
    	$query->updated_date= date("Y-m-d H:i:s");
    	if($query->weightquantity != 0){
    		$query->update();
    	}else{
    		$query->delete();
    	}
    	$json['qty'] = $query->weightquantity ;
    	$json['price'] = 'Rs. '.number_format($query->price_weight,2);
    	$cartcount = 0;
    	$totalvalue = 0;
    	$cartdata = Cart::find()->where(['session_id'=>$model->session_id,'booking_id'=>0])->asarray()->all();
    	foreach($cartdata as $key=>$value){
    		$cartcount = $cartcount +$value['weightquantity'];
    		$totalvalue = $totalvalue +$value['price_weight'];
    		
    	}
    	$json['status'] = "Success";
    	$json['cartcount'] = $cartcount;
    	$json['totalvalue'] ='Rs. '.number_format($totalvalue,2) ;
    	return json_encode($json);
    	
    }
    public function actionCartremove($cartId){
    	$model = Cart::find()->where(['cart_id'=>$cartId])->one();
    	 
    	$model->delete();
    }
	
}
