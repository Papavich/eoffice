<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'ขั้นตอนที่ 1 : เพิ่มรายละเอียดแบบฟอร์ม';
//$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">
    <h3><?= Html::encode($this->title) ?></h3>
    <div id="content" class="padding-20">

        <div class="row">
            <div class="create-form">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'template_name')->textInput() ?>

                <?php
                $ReqCategory = app\modules\requestform\models\ReqCategory::find()->all();
                $listData=ArrayHelper::map($ReqCategory,'category_id','category_name');
                ?>

                <?= $form->field($model, 'req_category_category_id')->dropDownList($listData,['prompt'=>'-- เลือกประเภท --']) ?>

                <?php
                $ReqType = app\modules\requestform\models\ReqType::find()->all();
                $listData=ArrayHelper::map($ReqType,'req_type_id','req_type_name');
                ?>
                <?= $form->field($model, 'req_type_req_type_id')->dropDownList($listData,['prompt'=>'-- เลือกประเภท --']) ?>

                <?= $form->field($model, 'template_layout')->fileInput(['class' => 'form-control ','disabled' => 'disabled']) ?>

                <div class="form-group pull-right">
                    <?= Html::submitButton($model->isNewRecord ? 'ต่อไป' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-reveal btn-green' : 'btn btn-reveal btn-green']) ?>
                </div>

                <?php ActiveForm::end(); ?>



                <?php
                Modal::begin([
                    'header' => '<h3 style="margin-bottom: 0px;">Hello world</h3>',
                    'toggleButton' => ['label' => 'click me'],
                    'footer' => '<button type="button" class="btn btn-reveal btn-green">Click Me!</button><button type="button" class="btn btn-reveal btn-green">Click Me!</button>',
                ]);

                echo 'ท่านต้องการออกแบบดีไซน์คำร้องใหม่หรือไม่?';

                Modal::end();
                ?>

            </div>
        </div>
    </div>
</div>
