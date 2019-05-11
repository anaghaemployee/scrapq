<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\scraps\models\ScrapbookingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scrap Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scrap-bookings-index">

    <h1><?= Html::encode($this->title) ?></h1>

 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'scrap_book_id',
            'name',
            'email:email',
            'mobile',
            'pickup_address:ntext',
            'pick_date',
            'pickup_time',
            
            //'pickup_scrap',
            //'scrap_quantity',
            //'createdDate',
            //'updatedDate',

            //['class' => 'yii\grid\ActionColumn'],
        		['class' => 'yii\grid\ActionColumn',
        		'controller' => 'scrapbookings',
        		//'header'=>'Subjects View',
        		'template' => '{view}',
        		'buttons' => [
        				'view' => function ($url,$data) {
        					$url = Url::to(['/scraps/scrapbookings/view','id'=>$data->scrap_book_id]);
        					return Html::a(
        							'<span class="glyphicon glyphicon-eye-open"></span>',
        							$url,[// to prevent breaking table on hover
        									'title' => ' view',]);
        				},
        		
        		
        				],
        				],
        ],
    ]); ?>


</div>
