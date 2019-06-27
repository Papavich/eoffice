<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Publication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pub_name_thai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pub_name_eng')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'acticle_detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abstract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'press')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISBN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_level_id')->textInput() ?>

    <?= $form->field($model, 'issn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataval')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issuance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataindex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'impact_factor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'advisor_id')->textInput() ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'std_id')->textInput() ?>

    <?= $form->field($model, 'contributor_contributor_id')->textInput() ?>

    <?= $form->field($model, 'cities_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
