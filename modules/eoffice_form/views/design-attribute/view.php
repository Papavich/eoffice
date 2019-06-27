<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\Designattribute */

$this->title = 'Field : '.$model->attribute_ref;

$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->designSection->template->template_name, 'url' => ['req-template/view','id' => $model->designSection->template_id]];
$this->params['breadcrumbs'][] = ['label' => 'Section : '.$model->designSection->design_section_name, 'url' => ['design-section/view','id' => $model->design_section_id]];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="design-attribute-view">

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
                    <?= Html::a('แก้ไขฟิลด์', ['update', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('ลบฟิลด์', ['delete', 'attribute_ref' => $model->attribute_ref, 'design_section_id' => $model->design_section_id], [
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
                        'attribute_ref',
                        'attribute_name',
                        'attribute_order',
                        'attributeFunction.attribute_function_name',
                        'attributeType.attribute_type_name',
                        'designSection.design_section_name',
                    ],
                ]) ?>
            </div>
        </div>
    </div>

</div>
