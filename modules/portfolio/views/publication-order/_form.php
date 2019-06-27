<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'publication_pub_id')->textInput() ?>

    <?= $form->field($model, 'author_level_auth_level_id')->textInput() ?>

    <?= $form->field($model, 'project_member_pro_member_id')->textInput() ?>

    <?= $form->field($model, 'publications_type_pub_type_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
