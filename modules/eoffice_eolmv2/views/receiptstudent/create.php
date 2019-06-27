<?php

use yii\helpers\Html;
use app\modules\eoffice_eolmv2\models\EolmReceiptStudentDetail;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmReceiptStudent */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Create receipt for student');
use app\modules\eoffice_eolmv2\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalsearch']];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search approval form'), 'url' => ['approvalajsearch']];
}
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search receipt for student'), 'url' => ['index', 'id' => $_GET["id"]]];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Search receipt for student'), 'url' => ['index', 'id' => $_GET["id"]]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-receipt-student-create">



    <?= $this->render('_form', [
        'model' => $model,
        'modelsAddress' => (empty($modelsAddress)) ? [new EolmReceiptStudentDetail] : $modelsAddress
    ]) ?>

</div>
