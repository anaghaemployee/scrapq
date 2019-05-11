<?php

namespace frontend\modules\exchange\controllers;
use Yii;
use frontend\modules\exchange\models\OcProduct;
use frontend\modules\scraps\models\BookingConfimation;
use frontend\modules\exchange\models\OcProductDescription;
use frontend\modules\cart\models\Cart;

class ExchangeController extends \yii\web\Controller
{
    public function actionIndex($id)
    {
    	
		$this->layout = '/version';
		$bkinfo = BookingConfimation::find()->where(['scrap_book_id'=>$id])->one();
		$price = $bkinfo->amount;

		//$prinfo = OcProduct::find()->where(['<', 'oc_product.price', $price])->all();
		$prinfo = OcProduct::find()->select('oc_product.*,oc_product_description.*')
		->innerjoin('oc_product_description','oc_product_description.product_id=oc_product.product_id')
		->where(['<', 'oc_product.price', $price])->andWhere(['status' => 1])->all();
		//print_r($prinfo[0]);exit;

		          return $this->render('index',
        		[
        			'prinfo'=>$prinfo,
        			'price'=>$price
           		]);
 
    }
    public function actionCartadd(){
    	$model = new Cart();
    	$json = array();
    	$qty = 1;
    	$price = $_GET['price'];
    	$productid = $_GET['productid'];
    	$sign = $_GET['inc'];
    	$bookingid = $_GET['bookingid'];
    	
    	$scrapname = OcProductDescription::find()->where(['product_id'=>$productid])->one();
    	$model->scrap_id= $productid;
    	$model->scrap_name= $scrapname->name;
    	$model->session_id	= Yii::$app->session->getId();
    	$model->weightquantity	= $qty;
    	$model->price	= $price;
    	if($qty !=0){
    		$model->price_weight= $price * $qty;
    	}else{
    		$model->price_weight= $price;
    	}
    	$model->booking_id= $bookingid;
    	$model->created_date= date("Y-m-d H:i:s");
    	$model->updated_date= date("Y-m-d H:i:s");
    	$totalprice = BookingConfimation::find()->where(['scrap_book_id'=>$bookingid])->one();
    	//$totalprice->amount =  $totalprice->amount - $price;
    	
    	$query = Cart::find()->where(['scrap_id'=>$model->scrap_id,'booking_id'=>$bookingid])->one();
    	if( $query == ''){
    		if($sign == 'inc'){   			
    			
    			if($totalprice->amount != 0.00 && $totalprice->amount >= $price ){
    			$totalprice->amount =  $totalprice->amount - $price;
    			$model->save();
    			$json['status'] = "Success";
    			 
    			}
    			else{
    				$json['status'] = "Fail";
    				 
    			}    				
    		}
    	}
    	else{
    		if($sign == 'inc'){
    			
    			$query->weightquantity =$query->weightquantity+ $qty;
    		}
    		else{
    			$totalprice->amount =  $totalprice->amount + $price;
    			$query->weightquantity = $query->weightquantity - $qty;
    		}
    		$query->price_weight= $price * $query->weightquantity;
    		$query->updated_date= date("Y-m-d H:i:s");
    		$json['qty'] = $query->weightquantity;
    		$json['price'] = 'Rs. '.number_format($query->price_weight,2);
    		//print_r($query->weightquantity);exit;
    		if($query->weightquantity != 0){
    			
    			if($totalprice->amount != 0.00 && $totalprice->amount >= $price){
    				
    				$totalprice->amount =  $totalprice->amount - $price;
    				$json['status'] = "Success";    				 
    				$query->update();
    			}
    			else{
    				$json['status'] = "Fail";
    					
    			}
    		}
    		else{
    			$query->delete();
    		}
    			
    	}
    	$totalprice->save();
    	$json['qty'] = 1;
    	$json['price'] = 'Rs. '.number_format($price,2);
    	$cartcount = 0;
    	$cartdata = Cart::find()->where(['booking_id'=>$bookingid])->asArray()->all();
    	foreach($cartdata as $key=>$value){
    		$cartcount = $cartcount +$value['weightquantity'];
    	}
    	$json['totalvalue'] = 'Rs. '.number_format($totalprice->amount,2);
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
    	$bookingid = $_GET['bookingid'];
    	
    	$bkinfo = BookingConfimation::find()->where(['scrap_book_id'=>$bookingid])->one();
    	$total = $bkinfo->amount;
    	
    	$model->session_id = Yii::$app->session->getId();
    	$query = Cart::find()->where(['scrap_id'=>$scrapid,'booking_id'=>$bookingid])->one();
    	//print_r($query)
    	if($sign == 'inc'){    	
    		$query->weightquantity = $qty + 1;    		
    	}
    	else{
    		$query->weightquantity = $qty - 1;
    	}
    	
    	//print_r($query->weightquantity);exit;
    	$query->price_weight= $price * $query->weightquantity;
    	$query->updated_date= date("Y-m-d H:i:s");
    	if($query->weightquantity != 0){
    		if($sign == 'inc'){
    		if($total != 0.00 && $total >= $price){
    			$bkinfo->amount = $total - $price;
    			$json['status'] = "Success";
    			$query->update();
    		}
    		else{
    			$json['status'] = "Fail";    				
    		}
    		}
    		else{
    			$bkinfo->amount = $total + $price;
    			$json['status'] = "Success";
    			$query->update();
    		}
    	
    	}else{
    		$query->delete();
    	}
    	$bkinfo->update();
    	$cartcount = 0;
    	$totalvalue = 0;
    	$cartdata = Cart::find()->where(['booking_id'=>$bookingid])->asarray()->all();
    	foreach($cartdata as $key=>$value){
    		$cartcount = $cartcount +$value['weightquantity'];
    		$totalvalue = $totalvalue +$value['price_weight'];
    		 
    	}
    	$json['qty'] = $query->weightquantity ;
    	$json['price'] = 'Rs. '.number_format($query->price_weight,2);
    
    	$json['cartcount'] = $cartcount;
    	$json['totalvalue'] ='Rs. '.number_format($totalvalue,2) ;
    	$json['exchange'] = 'Rs. '.number_format($bkinfo->amount,2);
    	// print_r($json);exit;
    	
    	return json_encode($json);
    	 
    }
    

}
