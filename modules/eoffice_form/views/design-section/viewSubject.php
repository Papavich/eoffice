<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\DesignSection */

$this->title = 'Section : '.$model->design_section_name;

$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->template->template_name, 'url' => ['req-template/view','id' => $model->template_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="design-section-view">

    <h3></h3>

    <div id="content" class="dashboard">
        <div id="panel-1" class="panel panel-primary">
            <div class="panel-heading">
                  <span class="title elipsis">
                    <strong><?= Html::encode($this->title) ?></strong>
                  </span>
            </div>
            <div class="panel-body">
                <p>
                    <?= Html::a('แก้ไขหมวดหมู่', ['update', 'id' => $model->design_section_id,'template_id' => $model->template_id], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('ลบหมวดหมู่', ['delete', 'id' => $model->design_section_id, 'template_id' => $model->template_id], [
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
                        //'design_section_id',
                        'design_section_name',
                        'sectionType.section_type_name',
                        'design_section_order',
                        //'template_id',

                    ],
                ]) ?>
            </div>
        </div>
    </div>

</div>
