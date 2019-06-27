<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\AttributeData */

$this->title = 'List : '.$model->attribute_data;
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->attributeRef->designSection->template->template_name, 'url' => ['req-template/view','id' => $model->attributeRef->designSection->template_id]];
$this->params['breadcrumbs'][] = ['label' => 'Section : '.$model->attributeRef->designSection->design_section_name, 'url' => ['design-section/view','id' => $model->design_section_id]];
$this->params['breadcrumbs'][] = ['label' => 'Attribute : '.$model->attributeRef->attribute_ref, 'url' => ['design-attribute/view-list','attribute_ref' => $model->attribute_ref,'design_section_id' => $model->design_section_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-data-view">

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
                    <?= Html::a('แก้ไขลิสต์', ['update', 'id' => $model->attribute_data_id, 'design_section_id' => $model->design_section_id, 'attribute_ref' => $model->attribute_ref], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('ลบลิสต์', ['delete', 'id' => $model->attribute_data_id, 'design_section_id' => $model->design_section_id, 'attribute_ref' => $model->attribute_ref], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'attribute_data_id',
                        'attribute_data',
                        'attribute_order',
                        //'attribute_ref',
                        //'design_section_id',
                    ],
                ]) ?>
            </div>
        </div>
    </div>

</div>
