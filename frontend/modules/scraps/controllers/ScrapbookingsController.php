<?php

namespace frontend\modules\scraps\controllers;

use Yii;
use frontend\modules\scraps\models\ScrapBookings;
use frontend\modules\scraps\models\ScrapbookingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\scraps\models\Scraps;

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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ScrapBookings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ScrapBookings();
        $scrapinfo = Scraps::find()->select('scrap_id,scarp_name')->all();
        $scraps =array();
        for($k=0;$k<count($scrapinfo);$k++)
        {
        	//$hospital['Prompt'] = 'Select Hospital Name';
        	$scraps[$scrapinfo[$k]['scarp_name']] = $scrapinfo[$k]['scarp_name'];
        }
        $model->scrap_name = $scraps;

        if ($model->load(Yii::$app->request->post())) {
        	
        	$model->createdDate = date("Y-m-d H:i:s");
        	$model->save();
        	Yii::$app->session->setFlash('success', 'Successfully Book the Appointment');
            return $this->redirect(['/site/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
