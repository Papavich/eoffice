<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Project_Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="portfolio-form">

    <div class="row">


        <div class="box">

            <div class="box-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <div class="col-lg-2">
                    <?= $form->field($model, 'person_id')->textInput(['maxlength' => true]) ?>
                </div> 
                <div class="col-lg-2">   
                    <?= $form->field($model, 'prefix_id')->dropDownList(backend\models\Person::getPrefixDetail(), ['prompt' => '-เลือกคำนำหน้า-']) ?>    
                </div> 
                <div class="col-lg-4">    
                    <?= $form->field($model, 'person_firstname')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">      
                    <?= $form->field($model, 'person_lastname')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?=
                    $form->field($model, 'person_date_work_start')->widget(
                            DatePicker::className(), [
                        // inline too, not bad
                        //'inline' => true, 
                        // modify template for custom rendering
                        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]);
                    ?>    
                </div>
                <div class="col-lg-4">   
                    <?= $form->field($model, 'position_id')->dropDownList(backend\models\Person::getPositionDetail(), ['prompt' => '-เลือกตำแหน่ง-']) ?> 
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'department_id')->dropDownList(backend\models\Person::getDepartmentDetail(), ['prompt' => '-เลือกหน่วยงาน-']) ?>     
                </div>
                <div class="col-lg-6">    
                    <?= $form->field($model, 'person_address')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">    
                    <?= $form->field($model, 'person_tel')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-12">     
                    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>

<?php ActiveForm::end(); ?>

            </div>
        </div>




    </div>    


</div>
