<?php

namespace frontend\modules\cart\controllers;

use Yii;
use frontend\modules\scraps\models\Scraps;
use frontend\modules\cart\models\Cart;
class CartController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->layout = '/version';
    	$cart = Cart::find()->where(['session_id'=>Yii::$app->session->getId()])->all();
    	
        return $this->render('index',['cart'=>$cart]);
    }
    
    public function actionAdd(){
    	$model = new Cart();
    	$json = array();
    	$qty = $_GET['qty'];
    	$price = $_GET['price'];
    	$scrapid = $_GET['scrapid'];
    	$scrapname = Scraps::findByScrap($scrapid);
    	$model->scrap_id= $scrapid;
    	$model->scrap_name= $scrapname->scarp_name;
    	$model->session_id	= Yii::$app->session->getId();
    	$model->weightquantity	= $qty;
    	$model->price	= $price;
    	$model->price_weight= $price * $qty;
    	$model->created_date= date("Y-m-d H:i:s");
    	$model->updated_date= date("Y-m-d H:i:s");
    	//print_r($model);exit;
    	$query = Cart::find()->where(['scrap_id'=>$model->scrap_id,'session_id'=>$model->session_id])->one();
		if( $query == ''){
			$model->save();
		}
		else{
			$query->weightquantity =$query->weightquantity+ $qty;
			$query->price_weight= $price * $qty;
			$query->updated_date= date("Y-m-d H:i:s");
			$query->update();			
		}
		$json['status'] = "Success";
		return json_encode($json);
		
    }
    public function actionCartupdate(){
    	
    	$model = new Cart();
    	$json = array();
    	$qty = $_GET['qty'];
    	$price = $_GET['price'];
    	$scrapid = $_GET['scrapid'];
    	$model->session_id = Yii::$app->session->getId();    
    	$query = Cart::find()->where(['session_id'=>$model->session_id,'scrap_id'=>$scrapid])->one();
    	$query->weightquantity = $qty;
    	$query->price_weight= $price * $qty;
    	$query->updated_date= date("Y-m-d H:i:s");
    	$query->update();
    }
    public function actionCartremove($cartId){
    	$model = Cart::find()->where(['cart_id'=>$cartId])->one();
    	 
    	$model->delete();
    }
	
}
