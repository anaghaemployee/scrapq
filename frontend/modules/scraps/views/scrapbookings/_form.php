<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\ScrapBookings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scrap-bookings-form">
    <div class="row">
        <div class="col-lg-5">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pickup_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pick_date')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Pick up Date' ],
                		'value'=>date("Y-m-d"), 'pluginOptions' => ['autoclose' => true ,'format' => 'yyyy-mm-dd',] ] ) ?>  

    <?= $form->field($model, 'pickup_time')->dropDownList(['08:00-10:00'=>'08:00-10:00','10:00 - 12:00','12:00-14:00','14:00-16:00','16:00-18:00'
    		
    ],['prompt'=>'Select Pickup Time']) ?>

    <?= $form->field($model, 'pickup_term')->radioList(['One Time'=>'One Time','Fortnightly'=>'Fortnightly','Weekly'=>'Weekly','Monthly'=>'Monthly']); ?>

    <?= $form->field($model, 'pickup_scrap')->dropdownList($model->scrap_name,['prompt' =>'Select Scrap']) ?>

    <?= $form->field($model, 'scrap_quantity')->radioList(['Below 50 Kg' => 'Below 50 Kg','Above 50 Kg' => 'Above 50 Kg','Above 100 Kg' => 'Above 100 Kg']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
    </div>

</div>
