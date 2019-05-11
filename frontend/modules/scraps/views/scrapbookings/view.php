<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
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
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
<h4>Scrap Products</h4>
  <?= GridView::widget([
  		
        'dataProvider' => $dataProvider,   
   		'rowOptions' => ['class' => 'grid_body_row'],
   		'headerRowOptions' => ['class' => 'grid_header_row'],
   		'filterRowOptions' => ['class' => 'grid_filter_row'],
        'columns' => [
  		
  		[
  		'label'=>'Scrap Name',
  		'attribute' => 'scrap_name',
  		'value' =>  function($data)
  		{
  			return $data->scrap_name;
  		},
  		],
  		'weightquantity',
  		'price',
  		'price_weight'
               	  		
        ],
    ]); ?>
   <div>
   
   <table class="table table-bordered">          
          <tbody>           
          <tr>
              <td colspan="4" class="text-right">Booking Status</td>
              <td ><?= $BookingConfimation->type;?></td>
            </tr>
            <tr>
              <td colspan="4" class="text-right">Total</td>
              <td ><?= 'RS.   '.$total;?></td>
            </tr>
           </tbody>
        </table>