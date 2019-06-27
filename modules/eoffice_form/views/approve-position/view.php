<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApprovePosition */


$this->title = 'Approve : '.$model->position_name;

$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->approveGroup->template->template_name, 'url' => ['req-template/view','id' => $model->approveGroup->template_id]];
$this->params['breadcrumbs'][] = ['label' => 'Group : '.$model->approveGroup->group_name, 'url' => ['approve-group/view','id' => $model->approve_group_id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<h3></h3>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong><?= Html::encode($this->title) ?></strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="approve-position-view">
                <p >
                    <?= Html::a('แก้ไขผู้พิจารณา', ['update', 'position_id' => $model->position_id, 'approve_group_id' => $model->approve_group_id], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('ลบผู้พิจารณา', ['delete', 'position_id' => $model->position_id, 'approve_group_id' => $model->approve_group_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            //'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'position_id',
                        'position_name',
                        'position_order',
                        //'approve_group_id',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
