<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_ta\models\TaComparisonGradeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-comparison-grade-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ta_comparison_grade_id') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'subject_version') ?>

    <?= $form->field($model, 'term') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'ta_status_id') ?>

    <?php // echo $form->field($model, 'grade_name') ?>

    <?php // echo $form->field($model, 'grade_value') ?>

    <?php // echo $form->field($model, 'doc_ref') ?>

    <?php // echo $form->field($model, 'crby') ?>

    <?php // echo $form->field($model, 'crtime') ?>

    <?php // echo $form->field($model, 'udby') ?>

    <?php // echo $form->field($model, 'udtime') ?>

    <?php // echo $form->field($model, 'subject_id_compar') ?>

    <?php // echo $form->field($model, 'subject_name_compar') ?>

    <?php // echo $form->field($model, 'compar_detail') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
