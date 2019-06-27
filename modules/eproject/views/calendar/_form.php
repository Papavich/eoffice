<?php

use app\modules\eproject\controllers;
use app\modules\eproject\models\Download;
use kartik\select2\Select2;
//use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eproject\models\Calendar */
/* @var $modelRelation app\modules\eproject\models\DownloadXCalendar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calendar-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field( $model, 'detail' )->textarea( ['rows' => 6] ) ?>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6 col-md-6">
                <?= $form->field( $model, 'start_date' )->widget(
                    DatePicker::className(), [
                    'language' => 'th',
                    'options' => ['class'=>'form-control','placeholder' => controllers::t( 'label', 'Select event start date' )],
//                    'pluginOptions' => [
//                        'format' => 'yyyy-mm-dd',
//                        'todayHighlight' => true
//                    ]
                    'dateFormat'=>'yyyy-MM-dd',
                ] ); ?>
            </div>
            <div class="col-sm-6 col-md-6">
                <?= $form->field( $model, 'end_date' )->widget(
                    DatePicker::className(), [
                    'language' => 'th',
                    'options' => ['class'=>'form-control','placeholder' => controllers::t( 'label', 'Select event end date' )],
//                    'pluginOptions' => [
//                        'format' => 'yyyy-mm-dd',
//                        'todayHighlight' => true
//                    ]

                    'dateFormat'=>'yyyy-MM-dd',

                ] ); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                echo $form->field( $model, 'downloads' )->widget( Select2::classname(), [
                    'data' => ArrayHelper::map( Download::find()->all(), 'id', 'title' ),
                    'options' => ['placeholder' => controllers::t( 'label', 'Choose Related Form' ), 'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumInputLength' => 10
                    ],
                ] )->label( controllers::t( 'label', 'Related Forms' ) );
                ?>
            </div>
        </div>

        <?= Html::submitButton( '<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
