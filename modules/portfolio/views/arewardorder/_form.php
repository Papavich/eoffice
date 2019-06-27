<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Areward */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="areward-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'areward_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_areward')->textInput() ?>

    <?= $form->field($model, 'level_level_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Level::find()->all(),'level_id','level_name') ,['prompt'=>'ระดับรางวัล']) ?>


    <?= $form->field($model, 'institution_ag_award_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Institution::find()->all(),'ag_award_id','ag_award_name') ,['prompt'=>'ระดับรางวัล']) ?>


    <?= $form->field($model, 'data_detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'cities_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Cities::find()->all(),'id','name') ,['prompt'=>'ระดับรางวัล']) ?>

    <?= $form->field($model, 'member_member_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Member::find()->all(),'member_id','member') ,['prompt'=>'ระดับรางวัล']) ?>

    <?= $form->field($model, 'std_id')->dropDownList(ArrayHelper::map($stds, 'id', 'name'), ['prompt' => '---- SELECT ME ------']) ?>

    <?= $form->field($model, "person_id")->dropDownList(ArrayHelper::map($persons, 'id', 'name'), ['prompt' => '---- SELECT ME ------']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
