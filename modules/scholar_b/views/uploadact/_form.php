<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\scholar_b\controllers;

/* @var $this yii\web\View */
/* @var $model app\modules\scholar_b\models\ScbStudentHasActivityMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scb-student-has-activity-main-form">
    <div id="content" class="padding-30">
        <div class="panel-body">
            <div class="row">
                <div class="container">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>ภาพกิจกรรม <?php echo $model->activityMain->act_main_name ?></h4>
                        </div>
                    </div>

                    <?php if ($model->activity_img != ""){ ?>
                    <div class="row">
                        <div classs="col-6-md">
                            <center><?php echo Html::img('@web/web_scb/uploads/activity/images/' . $model->activity_img, ['width' => 400]) ?></center>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <?= $form->field($model, 'activity_img')->fileInput() ?>

                            <div class="form-group">
                                <?= Html::submitButton('<i class="fa fa-save"></i>' . controllers::t('label', 'Save') . '', ['class' => 'btn btn-success']) ?>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?= $form->field($model, 'student_id')->hiddenInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'activity_main_id')->hiddenInput() ?>

            <?= $form->field($model, 'year')->hiddenInput() ?>

            <?= $form->field($model, 'select_activity_status')->hiddenInput() ?>

        </div>
        <?php ActiveForm::end(); ?>
    </div>
