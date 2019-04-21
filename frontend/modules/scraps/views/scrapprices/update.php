<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\ScrapPrices */

$this->title = 'Update Scrap Prices: ' . $model->scrap_price_id;
$this->params['breadcrumbs'][] = ['label' => 'Scrap Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->scrap_price_id, 'url' => ['view', 'id' => $model->scrap_price_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scrap-prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
