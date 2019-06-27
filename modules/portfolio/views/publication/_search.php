<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pub_id') ?>

    <?= $form->field($model, 'pub_name_thai') ?>

    <?= $form->field($model, 'pub_name_eng') ?>

    <?= $form->field($model, 'book_name') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'acticle_detail') ?>

    <?php // echo $form->field($model, 'page_number') ?>

    <?php // echo $form->field($model, 'abstract') ?>

    <?php // echo $form->field($model, 'press') ?>

    <?php // echo $form->field($model, 'publisher') ?>

    <?php // echo $form->field($model, 'ISBN') ?>

    <?php // echo $form->field($model, 'auth_level_id') ?>

    <?php // echo $form->field($model, 'issn') ?>

    <?php // echo $form->field($model, 'dataval') ?>

    <?php // echo $form->field($model, 'article') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'issuance') ?>

    <?php // echo $form->field($model, 'dataindex') ?>

    <?php // echo $form->field($model, 'impact_factor') ?>

    <?php // echo $form->field($model, 'doi') ?>

    <?php // echo $form->field($model, 'advisor_id') ?>

    <?php // echo $form->field($model, 'person_id') ?>

    <?php // echo $form->field($model, 'std_id') ?>

    <?php // echo $form->field($model, 'contributor_contributor_id') ?>

    <?php // echo $form->field($model, 'cities_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
