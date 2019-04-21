<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\scraps\models\ScrappricesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scrap Prices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scrap-prices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Scrap Prices', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'scrap_price_id',
            'scrap_id',
            'scrap_price',
            'scrap_quantity',
            'createdDate',
            //'updatedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
