<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\models\TaTypeRule;
use app\modules\eoffice_ta\models\TaVariable;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaEquation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-equation-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-lg-6">
    <?= $form->field($model, 'ta_equation_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ta_equation_detail')->textarea(['rows' => 6]) ?>
    </div>
    <div class="col-lg-6">
    <?=  $form->field($model, 'ans')->dropdownList(
        ArrayHelper::map(TaVariable::find()->where(['status'=>TaVariable::TYPE_VARIABLE_MAIN])->all(),
            'ta_variable_id',
            'ta_variable_name'),
        [
            'id'=>'ddl-variable',
            'prompt'=>'เลือกตัวแปรคำตอบ'
        ]); ?>
    <?=  $form->field($model, 'ta_type_rule_id')->dropdownList(
        ArrayHelper::map(TaTypeRule::find()->all(),
            'ta_type_rule_id',
            'ta_type_rule_name'),
        [
            'id'=>'ddl-document',
            'prompt'=>'เลือกประเภทสูตร'
        ]); ?>

    <?= $form->field($model, 'active_status')->dropDownList([ '0'=>'ปิด', '1'=>'เปิดใช้งาน', ], ['prompt' => '']) ?>

    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
