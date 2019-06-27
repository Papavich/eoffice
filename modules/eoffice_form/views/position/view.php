<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\Position */

$this->title = $model->position_name;
$this->params['breadcrumbs'][] = ['label' => 'ตำแหน่ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Design Section</strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="position-view">



                <p>
                    <?= Html::a('แก้ไขตำแหน่ง', ['update', 'id' => $model->position_id], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('ลบตำแหน่ง', ['delete', 'id' => $model->position_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => '',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'position_id',
                        'position_name',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
