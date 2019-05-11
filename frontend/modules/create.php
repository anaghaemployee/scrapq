<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\Scraps */

$this->title = 'Create Scraps';
$this->params['breadcrumbs'][] = ['label' => 'Scraps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scraps-create">
   <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
