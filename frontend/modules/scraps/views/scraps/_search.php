<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\ScrapsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scraps-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'scrap_id') ?>

    <?= $form->field($model, 'scarp_name') ?>

    <?= $form->field($model, 'scrap_image') ?>

    <?= $form->field($model, 'scrap_status') ?>

    <?= $form->field($model, 'createdDate') ?>

    <?php // echo $form->field($model, 'updatedDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
