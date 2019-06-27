<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\modules\requestform\models\ReqType;
use app\modules\requestform\models\ReqCategory;


/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'ยื่นแบบฟอร์มใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div id="content" class="padding-20">

        <div class="row">
            <div class="create-form">
                <?php $form = ActiveForm::begin(); ?>

                <?php
                $ReqTemplate = app\modules\requestform\models\ReqTemplate::find()->all();
                $listData=ArrayHelper::map($ReqTemplate,'template_id','template_name');
                ?>
                <?= $form->field($model, 'template_id')->dropDownList($listData,['prompt'=>'-- เลือกประเภท --']) ?>

                <!-- $form->field($model, 'template_template')->fileInput(['class' => 'form-control ']) -->

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'ต่อไป' : 'Update', ['value' => $model->template_id ,'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
