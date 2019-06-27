<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolm\models\EolmLoancontract */

$this->title = \app\modules\eoffice_eolm\controllers::t( 'menu','Details for contract loan');
$userType = \app\modules\eoffice_eolm\components\AuthHelper::getUserType();
if ($userType==\app\modules\eoffice_eolm\components\AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => 'ตรวจสอบเอกสาร', 'url' => ['approvalformsf/index']];
}elseif ($userType==\app\modules\eoffice_eolm\components\AuthHelper::TYPE_TEACHER){
    $this->params['breadcrumbs'][] = ['label' => 'ตรวจสอบเอกสาร', 'url' => ['approvalformaj/index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-loancontract-view">
   <!--p>
        <= Html::a('Update', ['update', 'id' => $model->eolm_app_id], ['class' => 'btn btn-primary']) ?>
        <= Html::a('Delete', ['delete', 'id' => $model->eolm_app_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'eolm_loa_approvers',
            [   'attribute'=> 'eolm_loa_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_loa_date, 'long')." "
            ],
            /*[   'attribute'=> 'eolm_loa_use_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_loa_use_date, 'long')." "
            ],
            [   'attribute'=> 'eolm_loa_refund_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_loa_refund_date, 'long')." "
            ],*/
            'eolm_loa_total_amout',
            'eolm_loa_total_text',
        ],
    ]) ?>
    <div class="form-group text-center">
        <?php
        use app\modules\eoffice_eolm\controllers;
        use app\modules\eoffice_eolm\components\AuthHelper;
        $userType = AuthHelper::getUserType();
        if ($userType==AuthHelper::TYPE_ADMIN){
            echo Html::a(controllers::t( 'label','Back'), ['approvalformsf/index'], ['class' => 'btn btn-primary']);
        }elseif ($userType==AuthHelper::TYPE_TEACHER||AuthHelper::TYPE_APPROVERS){
            echo Html::a(controllers::t( 'label','Back'), ['approvalformaj/index'], ['class' => 'btn btn-primary']);
        }?>
    </div>

</div>
