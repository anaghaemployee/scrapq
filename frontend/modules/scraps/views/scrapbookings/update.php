<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\ScrapBookings */

$this->title = 'Update Scrap Bookings: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Scrap Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->scrap_book_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scrap-bookings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
