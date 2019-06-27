<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'project_name_thai')->textInput(['id'=>'project_name_thai','readOnly'=> true]) ?>

    <?= $form->field($model, 'project_name_eng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_start')->widget(
        DatePicker::className(), [
        // inline too, not bad
        //'inline' => true,
        // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>

    <?= $form->field($model, 'project_end')->textInput() ?>

    <?= $form->field($model, 'project_duration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_budget')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'repayment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sponsor_sponsor_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Sponsor::find()->all(),'sponsor_id','sponsor_name') ,['prompt'=>'ผู้สนับสนุน']) ?>

    <?= $form->field($model, 'participation_participation_project_code')->textInput() ?>

    <?= $form->field($model, 'advisor_id')->textInput() ?>

    <?= $form->field($model, 'std_id')->textInput() ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
