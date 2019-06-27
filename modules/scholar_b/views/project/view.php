<?php
/**
 * Created by PhpStorm.
 * User: PzPavilion
 * Date: 2/5/2561
 * Time: 17:52
 */

use app\modules\scholar_b\models\model_main\EofficeCentralViewPisPerson;
use yii\helpers\Html;
use app\modules\scholar_b\controllers;

?>

<?= \yii\helpers\Html::csrfMetaTags() ?>

<div id="content" class="padding-20">
    <div class="panel-body">
        <div class="row">
            <div class="form-group">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                            <b>ข้อมูลทั่วไป</b>
                        </div>
                        <div class="panel-body" style="height: 130px;">
                            <label>ชื่อโครงงาน : </label> <?php echo $project->project_name ?>
                            <br>
                            <lable>ประเภทโครงงาน :</lable> <?php echo $project->projectType->type_name ?>

                            <?php

                                if($adviser_main){
                                    $name = EofficeCentralViewPisPerson::find()->where(['person_card_id'=>$adviser_main->teacher_id_card])->one();
                                    echo "<br><lable>อาจารย์ที่ปรึกษาหลัก :</lable> ". $name->PREFIXABB . $name->person_name . "  " . $name->person_surname ;
                                }
                                if($adviser_co){
                                    $name = EofficeCentralViewPisPerson::find()->where(['person_card_id'=>$adviser_co->teacher_id_card])->one();
                                    echo "<br><lable>อาจารย์ที่ปรึกษาร่วม :</lable> " . $name->PREFIXABB . $name->person_name . "  " . $name->person_surname ;
                                }
                            ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                            <b>ข้อมูลวันที่</b>
                        </div>
                        <div class="panel-body" style="height: 130px;">
                            <label>วันที่เริ่มต้น : </label><?php echo $project->project_date ?>
                            <br>
                            <lable>ความก้าวหน้าโครงงาน :</lable>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active"
                                     role="progressbar"
                                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                     style="width:<?php echo $project->project_status; ?>%"><?php echo $project->project_status . "%"; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>
                            <b>ข้อมูลโครงงาน</b>
                        </div>
                        <div class="panel-body">
                            <center><?php echo \yii\helpers\Html::img('@web/web_scb/uploads/project/images/' . $project->project_image, ['width' => 400]) ?></center>
                            <br><?= \yii\helpers\HtmlPurifier::process($project->project_detail) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"><span class="glyphicon glyphicon-inbox"></span>
                            <b><?php echo controllers::t('label', 'Download Document'); ?></b></div>
                        <div class="panel-body">
                            <?php echo Html::a(' ' . controllers::t('label', 'Click for Download', ['class' => 'btn btn-primary']), '@web/web_scb/uploads/project/' . $project->project_file, ['class' => 'glyphicon glyphicon-download-alt btn btn-default btn-sm']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>