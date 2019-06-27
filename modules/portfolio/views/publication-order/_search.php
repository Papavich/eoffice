<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pub_order_id') ?>

    <?= $form->field($model, 'publication_pub_id') ?>

    <?= $form->field($model, 'author_level_auth_level_id') ?>

    <?= $form->field($model, 'project_member_pro_member_id') ?>

    <?= $form->field($model, 'publications_type_pub_type_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
