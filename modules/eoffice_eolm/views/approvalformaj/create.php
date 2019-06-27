<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmApprovalform */

$this->title = app\modules\eoffice_eolm\controllers::t( 'menu','Approval form');
//$this->params['breadcrumbs'][] = ['label' => 'ค้นหาแบบขออนุมัติหลักการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-create">
    <?= $this->render('_form', [
        'model' => $model,
        //'modelUser' => $modelUser,
    ]) ?>

</div>
