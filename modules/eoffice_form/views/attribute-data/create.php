<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\AttributeData */

$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
//$this->params['breadcrumbs'][] = ['label' => 'Template : ', 'url' => ['req-template/view','id' => $model->attribute_ref]];
$this->params['breadcrumbs'][] = ['label' => 'Section : ', 'url' => ['design-section/view','id' => $design_section_id]];
$this->params['breadcrumbs'][] = ['label' => 'Attribute : '.$attribute_ref, 'url' => ['design-attribute/view-list','attribute_ref' => $attribute_ref,'design_section_id' => $design_section_id]];
$this->params['breadcrumbs'][] = 'เพิ่ม';
?>
<div class="attribute-data-create">

    <?= $this->render('_form', [
        'model' => $model,
        'design_section_id' => $design_section_id,
        'attribute_ref' => $attribute_ref,
    ]) ?>

</div>
