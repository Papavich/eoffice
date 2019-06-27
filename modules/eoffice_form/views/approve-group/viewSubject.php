<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveGroup */

$this->title = 'Group : '.$model->group_name;

$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->template->template_name, 'url' => ['req-template/view','id' => $model->template_id]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="attribute-data-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Approve Group</strong>
                  </span>
            </div>
            <div class="panel-body">
                <div class="approve-group-view">

                    <p>
                        <?= Html::a('แก้ไขกลุ่มผู้พิจารณา', ['update', 'id' => $model->group_id,'template_id' => $model->template_id], ['class' => 'btn btn-default']) ?>
                        <?= Html::a('ลบกลุ่มผู้พิจารณา', ['delete', 'id' => $model->group_id, 'template_id' => $model->template_id], [
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
                            //'group_id',
                            'group_name',
                            'group_order',
                            'template.template_name',
                            'approveType.approve_type_name',
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>


</div>
