<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\Designattribute */

//$this->title = 'เพิ่ม attribute ใหม่';
//$this->params['breadcrumbs'][] = ['label' => 'Design attributes', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
//, 'url' => ['req-template/view','id' => $model->designSection->template->template_id]
//$this->title = 'แก้ไข ';
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
//$this->params['breadcrumbs'][] = ['label' => 'Template : '.$model->design_section_id];
$this->params['breadcrumbs'][] = ['label' => 'Section : ', 'url' => ['design-section/view','id' => $design_section_id]];
$this->params['breadcrumbs'][] = 'เพิ่ม';
?>
<div class="design-attribute-create">

    <?= $this->render('_form', [
        'model' => $model,
        'design_section_id' => $design_section_id,
    ]) ?>

</div>
