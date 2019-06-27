<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<div id="content" class="dashboard">
    <div id="panel-1" class="panel panel-primary">
        <div class="panel-heading">
                  <span class="title elipsis">
                    <strong>โอนการพิจารณาคำร้อง</strong>
                  </span>
        </div>
        <div class="panel-body">
            <div class="req-template-form">
                <?php $form = ActiveForm::begin(['action' => 'transfer']); ?>

                <?php
                $attributeFunction = app\modules\eoffice_form\models\ViewPositionJoinAssign::find()->all();
                $listData=ArrayHelper::map($attributeFunction,'user_id','position_name');
                ?>

                <?= $form->field($model, 'approve_id')->dropDownList(
                    $listData,['prompt'=>'-- เลือกประเภท --'])
                ?>

                <div class="form-group">
                    <?= Html::submitButton(' โอนใบคำร้อง', ['class' => 'btn btn-success fa fa-check']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

