<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\eoffice_ta\models\TaWorkloadTeacher;
use app\modules\eoffice_ta\controllers;
use app\modules\eoffice_ta\models\TaRequest;


/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaRegisterSection */


$save =  'ยืนยัน';//controllers::t( 'label', 'Save');
$update = controllers::t( 'label', 'Update');
$this->title = 'Update Ta Register Section: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Ta Register Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->section, 'url' => ['view', 'section' => $model->section, 'subject_id' => $model->subject_id, 'person_id' => $model->person_id, 'term' => $model->term, 'year' => $model->year]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-register-section-update">

        <div class="panel-body">
            <?php $form = ActiveForm::begin(//[
            //'action' => ['_form'],
            //['method' => 'get']
            );
            ?>
            เลือกรูปภาพผู้สมัคร <?=Html::input('file', 'ta_image')?>
            <br>
            <div class="table-responsive">
                <table class="table  table-vertical-middle nomargin">
                    <thead>
                    <tr class="info">
                        <th class="width-30"></th>
                        <th>section</th><!--STUDY-->
                        <th>ประเภทงานช่วยสอน</th> <!--STUDY-->
                        <th>วันสอน</th><!--STUDY-->
                        <th>เวลาสอน</th><!--STUDY-->
                        <th>จำนวนชั่วโมง</th><!--STUDY-->
                    </tr>
                    </thead>
                    <?php
                    // $wload_id = 'W-S'.$sec.'-'.$s.'-'.$t;
                    $secs = TaWorkloadTeacher::find()->where(['subject_id'=>$id,'term'=>$t,'year'=>$y])->all();
                    foreach ($secs as $sec){
                        $sec1 = $sec->section;
                        $wtype = $sec->ta_type_work_id;
                        ?>
                        <tbody>
                        <?php
                        if ($wtype == 'C'){
                            $ct_start = $sec->time_start;
                            $ct_end = $sec->time_end;
                            // $hr_c = $ct_end-$ct_start;
                            $hr_c = (strtotime($ct_end) - strtotime($ct_start))/( 60 * 60 );
                            $c_day = $sec->day_lect;
                            $lt_start = $sec->time_start_lab;
                            $lt_end = $sec->time_end_lab;
                            $l_day = $sec->day_lab;
                            ?>
                            <tr>
                                <td>
                                    <?=Html::input('checkbox','section[]', $model->section.$model->ta_type_work_id,['multiple'=>"multiple"])?>

                                </td>
                                <td><?=$sec->section?></td>
                                <td>
                                    <label >Lecture</label>
                                </td>
                                <td><?=$sec->day_lect?></td>
                                <td><?=$sec->time_start.'-'.$sec->time_end?></td>
                                <td><?=$hr_c?>ชม.</td>
                            </tr>

                        <?php }elseif($wtype == 'L'){
                            $lt_start = $sec->time_start_lab;
                            $lt_end = $sec->time_end_lab;
                            $l_day = $sec->day_lab;
                            $hr_l = (strtotime($lt_end) - strtotime($lt_start))/( 60 * 60 );
                            ?>
                            <tr>
                                <td>

                                    <?php  //Html::input('checkbox', 'section', $sec1)?>
                                    <?=Html::input('checkbox', 'section[]', $model->section.$model->ta_type_work_id,['multiple'=>"multiple"])?>
                                </td>
                                <td><?=$sec->section?></td>
                                <td>
                                    <label >Lab</label>
                                </td>
                                <td><?=$sec->day_lab?></td>
                                <td><?=$sec->time_start_lab.'-'.$sec->time_end_lab?></td>
                                <td><?=$hr_l?>ชม.</td>
                            </tr>
                        <?php  }else{
                            $ct_start = $sec->time_start;
                            $ct_end = $sec->time_end;
                            // $hr_c = $ct_end-$ct_start;

                            $c_day = $sec->day_lect;
                            $hr_c = (strtotime($ct_end) - strtotime($ct_start))/( 60 * 60 );

                            $lt_start = $sec->time_start_lab;
                            $lt_end = $sec->time_end_lab;
                            $l_day = $sec->day_lab;
                            $hr_l = (strtotime($lt_end) - strtotime($lt_start))/( 60 * 60 );
                            ?>
                            <tr>
                                <td>
                                    <?php  //Html::input('checkbox', 'section', $sec1)?>

                                    <?=Html::input('checkbox', 'section[]', $model->section.$model->ta_type_work_id,['multiple'=>"multiple"])?>
                                </td>
                                <td><?=$sec->section?></td>
                                <td>
                                    <label >Lecture</label>
                                </td>
                                <td><?=$sec->day_lect?></td>
                                <td><?=$sec->time_start.'-'.$sec->time_end?></td>
                                <td><?=$hr_c?>ชม.</td>
                            </tr>
                            <tr>
                                <td>
                                    <?php  //Html::input('checkbox', 'section', $sec1)?>
                                    <?=Html::input('checkbox', 'section[]', $model->section.$model->ta_type_work_id,['multiple'=>"multiple"])?>
                                </td>
                                <td><?=$sec->section?></td>
                                <td>
                                    <label >Lab</label>
                                </td>
                                <td><?=$sec->day_lab?></td>
                                <td><?=$sec->time_start_lab.'-'.$sec->time_end_lab?></td>
                                <td><?=$hr_l?>ชม.</td>
                            </tr>
                        <?php  } ?>
                        </tbody>

                    <?php } ?>
                </table>
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ?  '<i class="glyphicon glyphicon-floppy-disk"></i>'.$save : '<i class="glyphicon glyphicon-floppy-disk"></i>'.$update, ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-success pull-right']) ?>

            </div>

            <?php ActiveForm::end(); ?>

        </div>

</div>
