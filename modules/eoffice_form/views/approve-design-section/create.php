<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\ApproveDesignSection */

$this->title = 'เพิ่มกลุ่มผู้พิจารณา';
$this->params['breadcrumbs'][] = ['label' => 'แบบฟอร์มคำร้อง', 'url' => ['req-template/index']];
$this->params['breadcrumbs'][] = ['label' => 'Template : ', 'url' => ['req-template/view','id'=> $template_id]];
$this->params['breadcrumbs'][] = ['label' => 'Group : ', 'url' => ['approve-group/view','id'=>$group_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= Html::encode($this->title) ?></h3>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>Approve Section</strong>
                  </span>
        </div>
        <!-- panel content -->
        <div class="panel-body">
            <div class="approve-design-section-create">
                <?= $this->render('_form', [
                    'model' => $model,
                    'group_id' => $group_id,
                ]) ?>

            </div>
        </div>
        <!-- /panel content -->
    </div>
    <!-- /PANEL -->

</div>

