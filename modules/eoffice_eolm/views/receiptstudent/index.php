<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dialog\Dialog;
use app\modules\eoffice_eolm\controllers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolm\models\EolmReceiptStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = controllers::t( 'menu','Search receipt for student');
use app\modules\eoffice_eolm\components\AuthHelper;
$userType = AuthHelper::getUserType();
if ($userType==AuthHelper::TYPE_ADMIN){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['approvalsearch']];
}elseif ($userType==AuthHelper::TYPE_TEACHER||$userType == AuthHelper::TYPE_APPROVERS){
    $this->params['breadcrumbs'][] = ['label' => \app\modules\eoffice_eolm\controllers::t( 'menu','Search approval form'), 'url' => ['approvalajsearch']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-receipt-student-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="	fa fa-plus"></i> '.\app\modules\eoffice_eolm\controllers::t( 'menu','Create a Receipt for Student'), '@web/eoffice_eolm/receiptstudent/create?id='.$_GET['id'], ['class'=>'btn btn-social btn-success'],[
            'title' => Yii::t('app', 'ทำสัญญา')
        ]);?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'eolmApp.eolm_app_subject',
            [
                'attribute'=> 'person_id',
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

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'{view} {update} {delete} {excel}',
                'contentOptions'=>[
                    'noWrap' => true],
                //'options'=> ['style'=>'width:250px;'],
                'buttons'=>[
                    'view' => function($url,$model,$key){
                        return Html::a('<i class="fa fa-eye"></i> '.controllers::t( 'menu','Details for receipt for student'),$url,['class'=>'btn btn-block btn-social btn-info']);
                    },
                    'update' => function($url,$model,$key){
                        return  Html::a('<i class="fa fa-pencil-square-o"></i> '.controllers::t( 'menu','Update receipt for student'),$url,['class'=>'btn btn-block btn-social btn-warning']);
                    },
                    'delete' => function($url,$model,$key){
                        return Dialog::widget([
                                'libName' => 'krajeeDialogCust', // a custom lib name
                                'overrideYiiConfirm' => true,'options' => [  // customized BootstrapDialog options
                                    //'size' => Dialog::SIZE_LARGE, // large dialog text
                                    // 'type' => Dialog::TYPE_SUCCESS, // bootstrap contextual color
                                    'title' => controllers::t('label', 'Confirm'),
                                    'btnOKClass' => 'btn-warning',
                                    'btnOKLabel' => /*Dialog::ICON_OK . ' ' . */controllers::t('label', 'Ok'),
                                    'btnCancelLabel' => /*Dialog::ICON_CANCEL . ' ' . */controllers::t('label', 'Cancel')]
                            ]).
                            Html::a('<i class="fa fa-trash"></i> '.controllers::t( 'menu','Delete'),$url,['class'=>'btn btn-block btn-social btn-red','data' => ['confirm' => controllers::t('label', 'Are you sure you want to delete this item?'),'method' => 'post']]);
                    },
                    'excel' => function($url,$model,$key){
                        return  Html::a('<i class="fa fa-file-excel-o"></i> '.controllers::t( 'menu','Print'),$url,['class'=>'btn btn-block btn-social btn-success']);
                    },

                ],
            ],


        ],
    ]); ?>
</div>
