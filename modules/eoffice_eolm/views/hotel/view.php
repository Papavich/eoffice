<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmHotel */

use app\modules\eoffice_eolm\controllers;
$this->title = controllers::t( 'menu','Details for accommodation');
$this->params['breadcrumbs'][] = ['label' => controllers::t( 'menu','Search accommodation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-hotel-view">


    <!--<p>
        <?/*= Html::a('Update', ['update', 'id' => $model->eolm_hotel_id], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->eolm_hotel_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>
-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'eolm_hotel_id',
            'eolm_hotel_name',
            'eolm_hotel_address',
        ],
    ]) ?>
    <div class="form-group text-center">
        <?php echo Html::a(\app\modules\eoffice_eolm\controllers::t( 'label','Back'), ['index'], ['class' => 'btn btn-primary']);
       ?>
    </div>

</div>
