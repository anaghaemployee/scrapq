<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\ScrapPrices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scrap-prices-form">
	<div class="box box-primary">
	<div class="box-body">
<div class="row">
        <div class="col-lg-5">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'scrap_id')->dropdownList($model->scrap_name,['prompt' =>'Select Scrap']) ?>


    <?= $form->field($model, 'scrap_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scrap_quantity')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
</div>