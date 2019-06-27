<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\PublicationOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="publication-order-form">

    <div class="row">
        <div class="form-group">


                <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-4 col-sm-4">
        <?= $form->field($model, 'pub_order_id')->textInput() ?>
    </div>

            <div class="col-md-4 col-sm-4">
                <?= $form->field($model, 'person_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Person::find()->all(),'person_id','FullName') ,['prompt'=>'รหัสบุคคล']) ?>
        </div>

            <div class="col-md-4 col-sm-4">
                <?= $form->field($model, 'publication_pub_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Publication::find()->all(),'pub_id','FullName') ,['prompt'=>'รายชื่อผลงานตีพิมพ์']) ?>
            </div>

            <div class="col-md-4 col-sm-4">
                <?= $form->field($model, 'author_level_auth_level_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\AuthorLevel::find()->all(),'auth_level_id','auth_level_name') ,['prompt'=>'รายชื่อลำดับผู้เขียน']) ?>
            </div>


    <div class="form-group">
        <div class="col-md-1 col-sm-4">
        &nbsp; <br/> <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

