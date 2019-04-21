<?php

namespace frontend\modules\scraps\controllers;

use Yii;
use frontend\modules\scraps\models\Scraps;
use frontend\modules\scraps\models\ScrapsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ScrapsController implements the CRUD actions for Scraps model.
 */
class ScrapsController extends Controller
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
     * Lists all Scraps models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ScrapsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Scraps model.
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
     * Creates a new Scraps model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Scraps();

        if ($model->load(Yii::$app->request->post())) {
        	$model->scrap_image = UploadedFile::getInstance($model,'scrap_image');
        	if(!(empty($model->scrap_image)))
        	{
        		$imageName = time().$model->scrap_image->name;
        		$model->scrap_image->saveAs('scrapimages/'.$imageName );
        		$model->scrap_image = 'scrapimages/'.$imageName;
        	
        	}
        	else{
        		$model->scrap_image = '';
        	}
        	$model->createdDate = date("Y-m-d H:i:s");
        	 $model->save();
        	 Yii::$app->session->setFlash('success', 'Successfully create the scraps');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Scraps model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $scrapimage = $model->scrap_image;

        if ($model->load(Yii::$app->request->post())) {
        	$model->scrap_image = UploadedFile::getInstance($model,'scrap_image');
        	if(!(empty($model->scrap_image)))
        	{
        		$imageName = time().$model->scrap_image->name;
        		$model->scrap_image->saveAs('scrapimages/'.$imageName );
        		$model->scrap_image = 'scrapimages/'.$imageName;
        		 
        	}
        	else{
        		$model->scrap_image = $scrapimage;
        	}
        	
        	$model->save();
            return $this->redirect(['view', 'id' => $model->scrap_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Scraps model.
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
     * Finds the Scraps model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Scraps the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Scraps::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
