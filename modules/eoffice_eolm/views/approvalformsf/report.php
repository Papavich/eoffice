<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use app\modules\eoffice_eolm\models\EolmStatus;
use app\modules\eoffice_eolm\models\EolmApprovalformHasProvince;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\eoffice_eolm\models\EolmApprovalformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\modules\eoffice_eolm\controllers;
$this->title = controllers::t( 'menu','Summary report');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eolm-approvalform-report">
    <?php
    $gridColumns = [

        ['class' => 'yii\grid\SerialColumn',
            'header'=>'ลำดับที่'],
        ['attribute'=>'eolm_app_subject',
            'label'=>'รายละเอียด/เรื่อง'],
        'eolm_app_number',
        ['attribute'=>'eolmType.eolm_type_name',
            'label'=>'ติดต่อราชการประเภท'],
        /*['attribute'=>'person1.person_id',
            'value'=>function($model) {
                return $model['person_name'].' '.$model['person_surname'];}
        ],*/
        ['attribute'=>function($model) {
            return $model->person1['academic_positions_abb_thai']." "
                .$model->person1['person_name']." "
                .$model->person1['person_surname'];},
            'label'=>'ผู้เดินทาง'],
//        'จังหวัด'
        'eolm_app_date',
        ['attribute'=>function($model) {
            $sql = 'SELECT * FROM eoffice_olm.eolm_approvalform_has_province  
                    LEFT JOIN eoffice_central.province ON eoffice_olm.eolm_approvalform_has_province.PROVINCE_ID = eoffice_central.province.PROVINCE_ID 
                    WHERE eoffice_olm.eolm_approvalform_has_province.eolm_app_id='.$model->eolm_app_id;
            $model = EolmApprovalformHasProvince::findBySql($sql)->asArray()->all();
            $txt= "";
            foreach($model as $m){
                if ($m === reset($model)){
                    $txt=$m['PROVINCE_NAME'];
                }else{
                    $txt=$txt.','.$m['PROVINCE_NAME'];
                }
            }
            return $txt;
        }, 'label'=>'สถานที่'],
        ['attribute'=>function($model) {
            $sql = 'SELECT * FROM eoffice_olm.eolm_loancontract WHERE eoffice_olm.eolm_loancontract.eolm_app_id='.$model->eolm_app_id;
            $model = \app\modules\eoffice_eolm\models\EolmLoancontract::findBySql($sql)->one();
            return $model['eolm_loa_total_amout'];
        }, 'label'=>'จำนวนเงิน'],
        ['attribute'=>function($model) {
            $sql = 'SELECT * FROM eoffice_olm.eolm_disbursementform WHERE eoffice_olm.eolm_disbursementform.eolm_app_id='.$model->eolm_app_id;
            $model = \app\modules\eoffice_eolm\models\EolmDisbursementform::findBySql($sql)->one();
            return $model['eolm_dis_total'];
        }, 'label'=>'จ่ายจริง'],
        ['attribute'=>function($model) {
            $sql = 'SELECT * FROM eoffice_olm.eolm_repay WHERE eoffice_olm.eolm_repay.eolm_app_id='.$model->eolm_app_id;
            $model = \app\modules\eoffice_eolm\models\EolmRepay::findBySql($sql)->one();
            return $model['eolm_repay'];
        }, 'label'=>'เหลือ'],
        ['attribute'=>'eolmBudt.eolm_budt_name',
            'label'=>'เบิกจาก'],
        ['attribute'=>'eolmExp.eolm_exp_name',
            'label'=>'หมวดรายจ่าย'],
      //  'eolm_app_event_date',
       // ['class' => 'yii\grid\ActionColumn'],
    ];
    $defaultStyle = [
        'label' => ''.controllers::t( 'menu','Summary report'),
        'font' => ['bold' => true],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'color' => [
                'argb' => 'FFE5E5E5',
            ],
        ],
        'options' => ['title' => ''.controllers::t( 'menu','Download document')],
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK],
            ],
            'inside' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK],
            ]
        ],

    ];

    echo '<div class="text-center">'.
        ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'fontAwesome' => true,
        'showHeader' => true,
        'filename'=>'สรุปการไปราชการ',
            'stream' => false,
            //'afterSaveView' => '_view', // this view file can be overwritten with your own that displays the generated file link
            'folder' => '@webroot/web_eolm/export', // this is default save folder on server
            'linkPath' => '/web_eolm/export', // the web accessible location to the above folder
        'asDropdown' => true, // this is important for this case so we just need to get a HTML list
            'dropdownOptions'=>[
                'label'=>'ออกรายงาน',
                'class' => 'btn btn-success'
            ],
        'showColumnSelector' => false,
        'showConfirmAlert' => false,
        'target' => [
            ExportMenu::TARGET_SELF
            ],
        'exportConfig' =>
            [
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_EXCEL => false,
                ExportMenu::FORMAT_PDF => false,
                ExportMenu::FORMAT_CSV => false,
                ExportMenu::FORMAT_EXCEL_X => $defaultStyle,
            ],


    ]) .'</div>'?>

    <p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
              //  'contentOptions' => ['style' => 'width:100%;'],
            ],
            [ // แสดงชื่อ
                'attribute'=>'eolm_budget_year',
                'headerOptions' => ['style' => 'width:15%'],
            ],
            [
                'attribute'=>'eolm_app_date',
                'headerOptions' => ['style' => 'width:25%'],
                    'options' => [
                        'format' => 'YYYY-MM-DD',
                    ],
                    'filterType' => GridView::FILTER_DATE_RANGE,
                    'filterWidgetOptions' => ([
                        'attribute' => 'eolm_app_date',
                        'presetDropdown' => true,
                        'convertFormat' => false,
                        'pluginOptions' => [
                            'separator' => ' - ',
                            'format' => 'YYYY-MM-DD',
                            'locale' => [
                                'format' => 'YYYY-MM-DD'
                            ],
                        ],
                        'pluginEvents' => [
                            "apply.daterangepicker" => "function() { apply_filter('eolm_app_date') }",
                        ],
                ])
            ],
            [ // แสดงชื่อ
                'attribute'=>'person1',
                'format'=>'html',
                'filter'=>ArrayHelper::map(\app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisPerson::find()->all(),'person_id','person_name'),
                'label' => controllers::t('label_appform','User approval'),
                'value'=> function($model) {
                    return $model->person1['academic_positions_abb_thai']." ".$model->person1['person_name']." ".$model->person1['person_surname'];
                }
            ],
            [ // แสดงชื่อ
                'attribute'=>'eolm_type_id',
                'format'=>'html',
                'filter'=>ArrayHelper::map(\app\modules\eoffice_eolm\models\EolmType::find()->all(),'eolm_type_id','eolm_type_name'),
                'label' => controllers::t('label_appform','Type'),
                'value'=> 'eolmType.eolm_type_name'
                /*'value'=>function($model, $key, $index, $column) {
                    if ($model->eolm_status_id == 1) {
                        return "<span class=\"label label-info\">รอตรวจสอบ</span>";
                    } elseif ($model->eolm_status_id == 2) {
                        return "<span class=\"label label-warning\">รออนุมัติ</span>";
                    } elseif ($model->eolm_status_id == 3) {
                        return "<span class=\"label label-success\">อนุมัติ</span>";
                    } elseif ($model->eolm_status_id == 4) {
                        return "<span class=\"label label-danger\">ไม่อนุมัติ</span>";
                    }
                }*/
            ],
            'eolm_app_subject',
            //'eolm_app_event_date',




        ],
    ]); ?>

</div>
