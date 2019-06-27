<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Person*/
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prefix_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\Prefix::find()->all(),'prefix_id','prefix_name'), ['prompt' => 'ตำแหน่ง']) ?>


    <?= $form->field($model, 'person_firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_date_work_start')->textInput() ?>

    <?= $form->field($model, 'position_id')->dropDownList(\yii\helpers\ArrayHelper::map(\backend\models\Position::find()->all(),'position_id','position_name'), ['prompt' => 'ตำแหน่ง']) ?>

    <?= $form->field($model, 'department_id')->dropDownList(\yii\helpers\ArrayHelper::map(\backend\models\Department::find()->all(),'department_id','department_name'), ['prompt' => 'สาขา']) ?>


    <?= $form->field($model, 'person_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_picture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_work_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'publication_pub_id')->dropDownList(\yii\helpers\ArrayHelper::map(\backend\models\Publication::find()->all(),'pub_id','pub_name_thai'), ['prompt' => 'สถานะ']) ?>

    <?= $form->field($model, 'project_project_id')->dropDownList(\yii\helpers\ArrayHelper::map(\backend\models\Project::find()->all(),'project_id','project_name_thai'), ['prompt' => 'โครงการวิจัย']) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
