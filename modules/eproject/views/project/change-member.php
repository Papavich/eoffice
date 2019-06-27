<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use app\modules\eproject\models\User;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title =controllers::t( 'label', 'Change Topic Request' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div>
    <div class="row">
        <div class="col-xs-6 col-md-4" style="font-weight: bold" align="right"><?=controllers::t( 'label', 'Current Project Name (Thai)' )?>
            :
        </div>
        <div class="col-xs-6 col-md-8">
            <?=$project->name_th?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-md-4" style="font-weight: bold" align="right"><?=controllers::t( 'label', 'Current Project Name (English)' )?>            :
        </div>
        <div class="col-xs-6 col-md-8">
            <?=$project->name_en?>
        </div>
    </div>

    <hr>
    <?php $form = ActiveForm::begin( ['id' => 'project-form'] ); ?>
    <div>
        <?= $form->field( $project, 'currentStudents' )->widget(Select2::classname(), [
            'data' => ArrayHelper::map( \app\modules\eproject\models\ChangeMemberRequest::getAvailableStudent(), 'id', 'name' ),
            'options' => ['placeholder'=>controllers::t( 'label','Choose Group Member'),'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'allowClear' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 10
            ],
        ] )->label( controllers::t( 'label', controllers::t( 'label', 'Group Member' ) ) ) ?>
    </div>
    <div>

        <?= $form->field( $model, 'reason' )->textarea( ['rows' => 6] ) ?>
    </div>


    <br>

    <?= Html::submitButton( '<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>
    <?php ActiveForm::end(); ?>
</div>
