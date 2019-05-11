<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\ScrapBookings */

$this->title = 'Book to sold Your Scrap';/* 
$this->params['breadcrumbs'][] = ['label' => 'Scrap Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title; */
?>
<div class="scrap-bookings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
