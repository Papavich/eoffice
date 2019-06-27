<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
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
        <?= $form->field( $model, 'pro_name_th' )->textInput( ['readonly' => !$model->isNewRecord] ) ?>
    </div>

    <div>
        <?= $form->field( $model, 'pro_name_en' )->textInput( ['readonly' => !$model->isNewRecord] ) ?>
    </div>

    <div>

        <?= $form->field( $model, 'reason' )->textarea( ['rows' => 6] ) ?>
    </div>


    <br>
    <button type="button" class="btn btn-3d btn-teal  pull-right" onclick="clearForm()"><i class="fa fa-remove"></i><?=controllers::t( 'label', 'Clear Form' )?>
    </button>
    <?= Html::submitButton( '<i class="fa fa-save"></i>'.controllers::t( 'label', 'Save' ).'', ['class' => 'btn btn-3d btn-teal pull-right'] ) ?>
    <?php ActiveForm::end(); ?>
</div>
<script>
    function clearForm() {
        $('#changetopicrequest-pro_name_th').val("");//using the id of the textbox empty the value.
        $('#changetopicrequest-pro_name_en').val("");//using the id of the textbox empty the value.
        $('#changetopicrequest-reason').val("");//using the id of the textbox empty the value.
    }

</script>