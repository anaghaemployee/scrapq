<?php

namespace frontend\modules\scraps\controllers;

use Yii;
use frontend\modules\scraps\models\ScrapBookings;
use frontend\modules\scraps\models\ScrapbookingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\scraps\models\Scraps;
use frontend\modules\cart\models\Cart;
use frontend\modules\scraps\models\BookingScraps;
use frontend\modules\scraps\models\BookingConfimation;
use yii\data\ActiveDataProvider;
/**
 * ScrapbookingsController implements the CRUD actions for ScrapBookings model.
 */
class ScrapbookingsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ScrapBookings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScrapbookingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ScrapBookings model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    	$total =0;
    	$model = $this->findModel($id);
    	$BookingConfimation = BookingConfimation::find()->where(['scrap_book_id'=>$id])->one();
    	$Bookingtotal = BookingScraps::find()->where(['scrap_book_id'=>$id])->all();
    	foreach ($Bookingtotal  as $key=>$value){
    		$total = $total + $value['price_weight'];
    	}
    	$BookingScraps = new ActiveDataProvider([
    			'query' => BookingScraps::find()->where(['scrap_book_id'=>$id]),
    	]);
        return $this->render('view', [
            'model' => $model,
        	'dataProvider'=>$BookingScraps,
        	'BookingConfimation'=>$BookingConfimation,
        	'total'=>$total
        ]);
    }

    /**
     * Creates a new ScrapBookings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	
    	$this->layout = '/version';
        $model = new ScrapBookings();       
        if ($model->load(Yii::$app->request->post())) {
        	//print_r($model);exit;
        	$cartdata = Cart::find()->where(['session_id'=>Yii::$app->session->getId(),'booking_id'=>0])->all();
      		if(!empty($cartdata)){
        	$model->createdDate = date("Y-m-d H:i:s");
        		if($model->save()){
        			foreach($cartdata as $key=>$value){
        				$bookscrapsmodel = new BookingScraps();
        				$bookscrapsmodel->scrap_book_id = $model->scrap_book_id;
        				$bookscrapsmodel->scrapId = $value['scrap_id'];
        				$bookscrapsmodel->scrap_name	 = $value['scrap_name'];
        				$bookscrapsmodel->weightquantity =$value['weightquantity'];
        				$bookscrapsmodel->price = $value['price'];
        				$bookscrapsmodel->price_weight = $value['price_weight'];
        				$bookscrapsmodel->save();
        			}        			
        		}
        	//Cart::deleteAll(['session_id'=> Yii::$app->session->getId()]);
        	Yii::$app->session->setFlash('success', 'Successfully Book the Appointment');
            return $this->redirect(['/cart/cart','id'=>$model->scrap_book_id]);
       		}
        }
    }
    public function actionConfimation()
    {
    	$id = $_GET['id'];
    	$amount =0;
    	$bookingid = $_GET['bookingid'];    	
    	$model = new BookingConfimation();
    	$model->type = $id;
    	$model->scrap_book_id = $bookingid;
    	$BookingScraps = BookingScraps::find()->where(['scrap_book_id'=>$bookingid])->all();
    	foreach ($BookingScraps as $key=>$value){
    		$amount = $amount + $value['price_weight'];
    	}
    	$model->amount = $amount;
    	$query = BookingConfimation::find()->where(['scrap_book_id'=>$bookingid])->one();
    	if(empty($query)){
    		if(!empty($model->scrap_book_id)){
    		$model->save();
    		$json['status']="success";
    		Cart::deleteAll(['session_id'=> Yii::$app->session->getId()]);
    		}
    		else{
    			$json['status']="fail";
    		}
    	}
    	else{
    		$json['status']="fail";
    	}
    	return json_encode($json);
    	
    }

    /**
     * Updates an existing ScrapBookings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->scrap_book_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ScrapBookings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ScrapBookings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ScrapBookings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ScrapBookings::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
