<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\Designattribute */

$this->title = 'แก้ไข ';
//$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/view','id'=>$template_id]];

$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->designSection->template->template_name, 'url' => ['req-template/view','id' => $model->designSection->template_id]];
$this->params['breadcrumbs'][] = ['label' => 'Section : '.$model->designSection->design_section_name, 'url' => ['design-section/view', 'id' => $model->design_section_id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="design-attribute-update">

    <?= $this->render('_form', [
        'model' => $model,
        'design_section_id' => $design_section_id,
    ]) ?>

</div>
