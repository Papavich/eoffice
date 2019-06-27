<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_form\models\PositionAssign */

$this->title = 'Update Position Assign: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'การดำรงตำแหน่ง', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'แก้ไข '.$model->position->position_name;
?>






<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">

        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <br>
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

            </div>
            <?= $form->field($model, 'cr_date')->hiddenInput(['value' => date('Y-m-d')])->label(false) ?>

            <?= $form->field($model, 'cr_by')->hiddenInput(['maxlength' => true,'value' => Yii::$app->user->identity->username])->label(false) ?>

            <?= Html::submitButton('แก้ไข', ['class' => 'btn btn-success']) ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>




