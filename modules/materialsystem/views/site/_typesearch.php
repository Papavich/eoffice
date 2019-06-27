<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\materialsystem\models\TypeSearch;

/* @var $this yii\web\View */
/* @var $model \app\modules\materialsystem\models\TypeSearch */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="type-search" >

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= Html::activeTextInput($model, 'material_type_id',['class'=>'form-control','placeholder'=>'ค้นหาข้อมูล...']) ?>
   <!-- <?/*= $form->field($model, 'material_type_id') */?>
    --><?/*= $form->field($model,'material_type_name') */?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<!--<div class="type1-search">

    <?php /*$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); */?>

    <div class="input-group">
        <?/*= Html::activeTextInput($model, 'q',['class'=>'form-control','placeholder'=>'ค้นหาข้อมูล...']) */?>
        <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
            <?/*= Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-default']) */?>
      </span>
    </div>
    --><?php /*ActiveForm::end(); */?>

</div>
