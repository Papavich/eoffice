<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmReceiptStudent */

$this->title = \app\modules\eoffice_eolm\controllers::t( 'menu','Details for receipt for student');
use app\modules\eoffice_eolm\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['approvalsearch']];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['approvalajsearch']];
}
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['index', 'id' => $_GET["eolm_app_id"]]];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['indexaj', 'id' => $_GET["eolm_app_id"]]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-receipt-student-view">

    <!--<p>
        <?/*= Html::a('Update', ['update', 'eolm_app_id' => $model->eolm_app_id, 'person_id' => $model->person_id], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Delete', ['delete', 'eolm_app_id' => $model->eolm_app_id, 'person_id' => $model->person_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'eolm_app_id',
            [
                'attribute'=> 'person_id',
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Student Code'),
            ]
            ,
            [
                'label' =>\app\modules\eoffice_eolm\controllers::t('label_appform','Student follower'),
                'value' => function($model) {
                    $sql = 'SELECT * FROM eoffice_central.view_student_full  WHERE eoffice_central.view_student_full.STUDENTID='.$model->person_id;
                    $model = \app\modules\eoffice_eolm\models\model_main\EofficeMainViewStudentFull::findBySql($sql)->one();
                    $txt= $model['STUDENTNAME']." ".$model['STUDENTSURNAME'];
                    return $txt;
                }
            ],[
                'attribute'=> 'eolm_rec_std_total',
                'label' =>\app\modules\eoffice_eolm\controllers::t('label','Total'),
            ],
            /*'crby',
            'crtime',
            'udby',
            'udtime',*/
        ],
    ]) ?>
    <div class="form-group text-center">
        <?php
        $userType = \app\modules\eoffice_eolm\components\AuthHelper::getUserType();
        if ($userType==\app\modules\eoffice_eolm\components\AuthHelper::TYPE_ADMIN){
            echo Html::a(\app\modules\eoffice_eolm\controllers::t('label','Back'), ['index','id'=>$model->eolm_app_id], ['class' => 'btn btn-primary']);
        }elseif ($userType==\app\modules\eoffice_eolm\components\AuthHelper::TYPE_TEACHER){
            echo Html::a(\app\modules\eoffice_eolm\controllers::t('label','Back'), ['index','id'=>$model->eolm_app_id], ['class' => 'btn btn-primary']);
        }?>
    </div>

</div>
