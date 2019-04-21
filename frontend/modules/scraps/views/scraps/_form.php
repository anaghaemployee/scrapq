<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\Scraps */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scraps-form">
	<div class="box box-primary">
	<div class="box-body">
<div class="row">
        <div class="col-lg-5">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'scarp_name')->textInput(['maxlength' => true]) ?>
    
   <?php if($model->scrap_image  != ''){ ?>
   	<img src="<?php echo $model->scrap_image;  ?>" width="50px">
   	
  <?php }  ?>

    <?= $form->field($model, 'scrap_image')->fileInput() ?>

    <?= $form->field($model, 'scrap_status')->dropDownList([ 'Active' => 'Active', 'In-active' => 'In-active', ], ['prompt' => 'Select Scrap Status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
    </div>

</div>
</div>
</div>
