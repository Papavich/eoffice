<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 10/1/2561
 * Time: 23:51
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_eolm\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisPerson;
use kartik\widgets\Select2;
use app\modules\eoffice_eolm\controllers;
?>
<div class="eolm-setting-signer">
    <?php $form = ActiveForm::begin(['id' => 'setting-signer']); ?>
    <br>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <!-- อาจารย์ผู้ขออนุมัติ --->
            <?=
            $form->field($model1, 'person_id')
                ->dropDownList(
                    ArrayHelper::map(EofficeCentralViewPisBoardOfDirectors::find()/*->where(['person_type'=> 1])*/->asArray()->all(),'person_id',function($model) {
                        return $model['academic_positions_abb_thai'].' '.$model['person_name'].' '.$model['person_surname'].'  ( '.$model['position_name'].' )';
                    } /*'ใส่ชื่อและนามสกุล'*/)
                )->label('approvers',['class'=>'label-class'])->label(controllers::t( 'label', 'Approver')) ?>
            <!-- จนท --->
            <?= $form->field($model1, 'person_ids')->widget(Select2::className(), [
                'data' => ArrayHelper::map(EofficeMainViewPisPerson::find()->where(['person_type' => 2])->asArray()->all(), 'person_id', function($model) {
                    return $model['person_name'].' '.$model['person_surname'];
                } /*'ใส่ชื่อและนามสกุล'*/),
                'model' => $model1,
                'attribute' => 'person_ids',
                'language' => 'th',
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                ],
            ])->label(controllers::t( 'label', 'Owner')) ?>

            <div class="form-group">
                <?= Html::submitButton($model1->isNewRecord ? controllers::t( 'label', 'Create') : controllers::t( 'label', 'Update'), ['class' => $model1->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>


