<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\ScrapBookings */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Scrap Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="scrap-bookings-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'scrap_book_id',
            'name',
            'email:email',
            'mobile',
            'pickup_address:ntext',
            'pick_date',
            'pickup_time',
            'pickup_term',
            'pickup_scrap',
            'scrap_quantity',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
