<?php
use app\modules\correspondence\controllers;
function findUserId()
{
    $userid = \app\modules\correspondence\models\User::find()
        ->where(['username' => Yii::$app->user->identity->username])
        ->one();
    if ($userid){
        return $userid->id;
    }else{
        return null;
    }
}
?>
<!-- MODAL LABEL -->
<div class="modal fade bs-example-modal-sm" id="NewLabelModal" role="dialog" style="color: black">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
            </div>
            <div class="modal-body">
                <div class="cms-inbox-label-form">
                    <?php
                    $model_label = new \app\modules\correspondence\models\CmsInboxLabel();
                    ?>
                    <div class="cms-inbox-label-form">
                        <div id="add-label-error">
                            <span style='color: red'><?=controllers::t('menu','Label names must be unique.')?></span>
                        </div>
                        <?php $form = \yii\widgets\ActiveForm::begin(['id'=>'mail-labels-create'],['options' => ['enctype' => 'multipart/form-data']]); ?>

                        <?= $form->field($model_label, 'inbox_label_id')
                            ->hiddenInput(['value' => 'LBID' . date('md') . Yii::$app->user->identity->id . gettimeofday()["usec"]])
                            ->label(false) ?>

                        <?= $form->field($model_label, 'label_name')->textInput(['maxlength' => true, 'autocomplete' => 'off','autofocus'=> true]) ?>
                        <?= $form->field($model_label, 'user_id')
                            ->hiddenInput(['value' => findUserId()])
                            ->label(false) ?>
                        <div class="form-group">
                            <?= \yii\helpers\Html::submitButton($model_label->isNewRecord ? controllers::t('menu', 'Create')
                                : controllers::t('menu', 'Edit'), ['class' => $model_label->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                                'id' => 'submitCreateLabel']) ?>
                        </div>

                        <?php \yii\widgets\ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /MODAL LABEL -->