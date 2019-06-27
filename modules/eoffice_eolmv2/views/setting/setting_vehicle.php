<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\modules\eoffice_eolmv2\models\EolmVehicleCost;
use app\modules\eoffice_eolmv2\controllers;
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 10/1/2561
 * Time: 23:51
 */
?>
<div class="eolm-vehicle-cost-form">
    <br>

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'eolm_vehicle_cost')->textInput(['maxlength' => true])->label( controllers::t( 'label', 'Vehicle values in Bangkok')) ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'vehicle2')->textInput(['maxlength' => true])->label( controllers::t( 'label', 'Vehicle values in Khon Kaen')) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ?  controllers::t( 'label', 'Create') :  controllers::t( 'label', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
                </div>
            </div>
        </div>

     </div>

    <?php ActiveForm::end(); ?>

</div>

