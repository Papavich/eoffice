<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\AttributeData */

/*$this->title = 'Update Attribute Data: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Attribute Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->attribute_data_id, 'url' => ['view', 'id' => $model->attribute_data_id]];
$this->params['breadcrumbs'][] = 'Update';*/

$this->title = 'แก้ไข ';
//$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/view','id'=>$template_id]];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->attributeRef->designSection->template->template_name, 'url' => ['req-template/view','id' => $model->attributeRef->designSection->template_id]];
$this->params['breadcrumbs'][] = ['label' => 'Section : '.$model->attributeRef->designSection->design_section_name, 'url' => ['design-section/view','id' => $model->design_section_id]];
$this->params['breadcrumbs'][] = ['label' => 'Attribute : '.$model->attributeRef->attribute_ref, 'url' => ['view', 'id' => $model->attribute_data_id]];
$this->params['breadcrumbs'][] = ['label' => 'List : '.$model->attribute_data, 'url' => ['view', 'id' => $model->attribute_data_id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>

<div class="attribute-data-update">

    <?= $this->render('_form', [
        'model' => $model,
        'design_section_id' => $design_section_id,
        'attribute_ref' => $attribute_ref,
    ]) ?>

</div>
