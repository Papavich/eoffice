<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\PositionActing */

$this->title = 'Update Position Acting: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'รักษาการแทน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'รักษาการแทนในตำแหน่ง '.$model->position->position_name, 'url' => ['view', 'position_id' => $model->position_id, 'user_id' => $model->user_id, 'acting_startDate' => $model->acting_startDate, 'acting_endDate' => $model->acting_endDate]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
            <div class="position-acting-form">

                <?php $form = ActiveForm::begin(['action'=>'create']); ?>

                <?php
                $position = app\modules\eoffice_form\models\Position::find()
                    ->all();
                $listData=ArrayHelper::map($position,'position_id','position_name');
                ?>

                <?= $form->field($model, 'position_id')->dropDownList($listData,['prompt'=>'-- เลือกตำแหน่ง --']) ?>


                <?php
                $person = app\modules\eoffice_form\models\ViewPisPerson::find()
                    ->orderBy('PREFIXABB DESC')
                    ->all();
                $listData=ArrayHelper::map($person,'person_card_id',
                    function($model) {
                        return $model['PREFIXABB'].' '.$model['person_name'].' '.$model['person_surname'];
                    }
                );
                ?>

                <?= $form->field($model, 'user_id')->dropDownList($listData,['prompt'=>'-- เลือกบุคคลากร --']) ?>

                <div class="row">
                    <div class="col-lg-6">

                        <?= $form->field($model, 'acting_startDate')->textInput(['class' => 'datepicker form-control']) ?>
                    </div>

                    <div class="col-lg-6">
                        <?= $form->field($model, 'acting_endDate')->textInput(['class' => 'datepicker form-control']) ?>
                    </div>
                </div>



                <div class="form-group">
                    <?= Html::submitButton(' บันทึก', ['class' => 'btn btn-success fa fa-check']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

        </div>
    </div>
</div>
