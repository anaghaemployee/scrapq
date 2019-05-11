<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\ScrapBookings */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="cart-section spad">
		<div class="container">
			<div class="row">
<div class="scrap-bookings-form">
    <div class="row">
        

    <?php $form = ActiveForm::begin(); ?>
 <div class="form-group">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
</div>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pickup_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pick_date')->widget ( DatePicker::classname (), [ 'options' => [ 'placeholder' => 'Enter Pick up Date' ],
                		'value'=>date("Y-m-d"), 'pluginOptions' => ['autoclose' => true ,'format' => 'yyyy-mm-dd',] ] ) ?>  

    <?= $form->field($model, 'pickup_time')->dropDownList(['08:00-10:00'=>'08:00-10:00','10:00 - 12:00'=>'10:00 - 12:00','12:00-14:00'=>'12:00-14:00','14:00-16:00'=>'14:00-16:00','16:00-18:00'=>'16:00-18:00'
    		
    ],['prompt'=>'Select Pickup Time']) ?>

    
    

    <?php ActiveForm::end(); ?>
    
    </div>

</div>
</div>
</div>
</section>
