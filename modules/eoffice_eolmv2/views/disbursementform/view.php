<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\eoffice_eolmv2\models\Uploads;
/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_eolmv2\models\EolmDisbursementform */

$this->title = \app\modules\eoffice_eolmv2\controllers::t( 'menu','Details for expenses');
$userType = \app\modules\eoffice_eolmv2\components\AuthHelper::getUserType();
if ($userType==\app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Check document'), 'url' => ['approvalformsf/index']];
}elseif ($userType==\app\modules\eoffice_eolmv2\components\AuthHelper::TYPE_TEACHER){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolmv2\controllers::t( 'menu','Check document'), 'url' => ['approvalformaj/index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-disbursementform-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'eolm_dis_go_from',
            [   'attribute'=> 'eolm_dis_go_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_dis_go_date, 'long')." "
            ],
            'eolm_dis_go_time',
            'eolm_dis_back_to',
            [   'attribute'=> 'eolm_dis_back_date',
                'value'=>Yii::$app->thaiFormatter->asDate($model->eolm_dis_back_date, 'long')." "
            ],
            'eolm_dis_back_time',
            'eolm_dis_date_count',
            'eolm_dis_time',
            'eolm_dis_disburse_for',
            'eolm_dis_allowance_type',
            'eolm_dis_allowance_day',
            'eolm_dis_allowance_cost',
            'eolm_dis_hotal_type',
            'eolm_dis_hotal_day',
            'eolm_dis_hotal_cost',
            'eolm_vehicletype',
            'eolm_dis_vehicle_cost',
            'eolm_dis_other_expenses',
            'eolm_dis_other_expenses_cost',
            'eolm_dis_total',
            'eolm_dis_total_text' ,
           //['attribute'=>'docs','value'=>$model->listDownloadFiles('docs'),'format'=>'html'],
        ],
    ]) ?>

    <div class="form-group text-center">
        <?php
        use app\modules\eoffice_eolmv2\controllers;
        use app\modules\eoffice_eolmv2\components\AuthHelper;
        $userType = AuthHelper::getUserType();
        if ($userType==AuthHelper::TYPE_ADMIN){
            echo Html::a(controllers::t( 'label','Back'), ['approvalformsf/index'], ['class' => 'btn btn-primary']);
        }elseif ($userType==AuthHelper::TYPE_TEACHER||AuthHelper::TYPE_APPROVERS){
            echo Html::a(controllers::t( 'label','Back'), ['approvalformaj/index'], ['class' => 'btn btn-primary']);
        }?>
    </div>

</div>
