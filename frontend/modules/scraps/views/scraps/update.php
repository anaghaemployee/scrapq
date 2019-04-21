<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\Scraps */

$this->title = 'Update Scraps: ' . $model->scarp_name;
$this->params['breadcrumbs'][] = ['label' => 'Scraps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->scrap_id, 'url' => ['view', 'id' => $model->scrap_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scraps-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
