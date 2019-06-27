<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_form\models\ViewStudentFull;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\UserRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id,'readonly' => 'true'])->label(false) ?>

    <?php $getLevel = ViewStudentFull::find()->where(['STUDENTID' => Yii::$app->user->identity->username])->one();
    $education = $getLevel['LEVELNAME'];

    $education = explode(' ', $education, 2);
    if($education[0] == 'ปริญญาเอก' || $education[0] == 'ปริญญาโท' ){
        $education[0] = 'บัณฑิตศึกษา';
    }
    ?>

    <?php
    $Template = app\modules\eoffice_form\models\ReqTemplate::find()
        ->where([
                'template_level' => $education[0],
            'template_available' => 'เปิดใช้งาน'
        ])
        ->all();
    $listData=ArrayHelper::map($Template,'template_id','template_name');
    ?>

    <?= $form->field($model, 'template_id')->dropDownList($listData
        ,
        ['prompt'=>'-- เลือกแบบฟอร์มคำร้อง --']) ?>

    <?= $form->field($model, 'cr_date')->textInput(['value' => date('Y-m-d')]) ?>

    <?= $form->field($model, 'cr_term')->textInput([]) ?>

    <?= $form->field($model, 'cr_year')->textInput([])  ?>

    <!-- $form->field($model, 'req_json')->textarea(['rows' => 6]) -->

    <!-- $form->field($model, 'req_doc')->textarea(['rows' => 6]) -->

    <div class="form-group">
        <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
