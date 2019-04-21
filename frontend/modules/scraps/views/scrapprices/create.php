<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\ScrapPrices */

$this->title = 'Create Scrap Prices';
$this->params['breadcrumbs'][] = ['label' => 'Scrap Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scrap-prices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
