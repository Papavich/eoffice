<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;

?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t('label', 'Detail Funded Grant') ?></h1>
    <ol class="breadcrumb">
        <li><a href="../site/index"><?= controllers::t('label', 'Home') ?></a></li>
        <li><a href="../funded-grant/index"><?= controllers::t('label', 'Funded Grant') ?></a></li>
        <li class="active"><?= controllers::t('label', 'Detail Funded Grant') ?></li>
    </ol>
</header>
<!-- /page title -->
<div class="scb-funded-view">
    <div id="content" class="padding-20">
        <div class="panel-body">
            <div class="col-md-12">
                <div class="group">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span>
                                    <b> รายละเอียดนักศึกษา</b>
                                </div>
                                <div class="panel-body">
                                    <label>เลขประจำตัวนักศึกษา : <?php echo$model_funded->student_id?></label>
                                    <br><label>ชื่อ-สกุล : <?php echo$main_full->PREFIXNAME ?><?php echo $main_full->STUDENTNAME?>  <?php echo $main_full->STUDENTSURNAME ?></label>
                                    <br><label>สาขาวิชา : <?php echo $main_full->major_name ?></label>
                                    <br><label>ทุนการศึกษา : </label>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span>
                                    <b> รายละเอียดการเบิก</b>
                                </div>
                                <div class="panel-body">
                                    <label>ปีการศึกษา : <?php echo $model_funded->year ?></label>
                                    <br><label>ภาคการศึกษา : <?php echo $model_funded->semester ?></label>
                                    <br><label>รายการการเบิก
                                        : <?php echo $model_funded->fundedname->funded_type_name ?></label>
                                    <br><label>จำนวนเงิน : <?php echo $model_funded->funded_amount ?></label>
                                    <br><label>วันที่เบิกเงิน : <?php echo $model_funded->funded_date ?></label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <p>
                            <?= Html::a('Update', ['update', 'student_id' => $model_funded->student_id, 'funded_type_id' => $model_funded->funded_type_id, 'funded_date' => $model_funded->funded_date, 'year' => $model_funded->year, 'semester' => $model_funded->semester], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'student_id' => $model_funded->student_id, 'funded_type_id' => $model_funded->funded_type_id, 'funded_date' => $model_funded->funded_date, 'year' => $model_funded->year, 'semester' => $model_funded->semester], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </p>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>


</div>
