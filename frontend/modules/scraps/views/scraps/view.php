<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\scraps\models\Scraps */

$this->title = $model->scarp_name;
$this->params['breadcrumbs'][] = ['label' => 'Scraps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="scraps-view">
	<div class="box box-primary">
	<div class="box-body">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->scrap_id], ['class' => 'btn btn-primary']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'scrap_id',
            'scarp_name',
          [
        		'attribute' => 'scrap_image',
        		'format' => 'html',
        		'value' => function ($data) {
        			return Html::img('../web/'. $data['scrap_image'],
        					['width' => '50px']);
        		},
        		],
            'scrap_status',
            'scrap_price',
            'scrap_quantity',
            'createdDate',
            'updatedDate',
        ],
    ]) ?>

</div>
</div>
</div>
