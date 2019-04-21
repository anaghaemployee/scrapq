<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\scraps\models\ScrapsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scraps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scraps-index">
	<div class="box box-primary">
	<div class="box-body">

   

    <p>
        <?= Html::a('Create Scraps', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           //'scrap_id',
            'scarp_name',
            //'scrap_image:ntext',
        		[
        		'attribute' => 'scrap_image',
        		'format' => 'html',
        		'value' => function ($data) {
        			return Html::img('../web/'. $data['scrap_image'],
        					['width' => '50px']);
        		},
        		],
            'scrap_status',
           // 'createdDate',
            //'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
</div>
</div>
