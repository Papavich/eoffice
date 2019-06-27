<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmApprovalform */

$this->title = app\modules\eoffice_eolmv2\controllers::t( 'menu','Approval form');
//$this->params['breadcrumbs'][] = ['label' => 'ค้นหาแบบขออนุมัติหลักการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-create">
    <?= $this->render('_form', [
        'model' => $model,
        //'modelUser' => $modelUser,
    ]) ?>

</div>
