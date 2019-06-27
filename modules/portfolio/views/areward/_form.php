<?php
use kato\assets\DropZoneAsset;
use kato\DropZone;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\portfolio\controllers\BaseController;

use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\datetime\DateTimePicker;
use kartik\widgets\DepDrop;
use app\modules\portfolio\models\BaseProvince;
use app\modules\portfolio\models\BaseDistrict;
use app\modules\portfolio\models\BaseTambon;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model app\modules\portfolio\models\Areward */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord){
    $province = [];
    $district = [];
    $tambon = [];

    $district_list = [];
    $tambon_list = [];

}else{
    $province = $model->baseTambon->base_province_id;
    $district = $model->baseTambon->base_district_id;
    $tambon = $model->base_tambon_id;

    $district_list = ArrayHelper::map(BaseDistrict::find()->where(['base_province_id'=>$province])->orderBy('district_name ASC')->all(),'id','district_name');
    $tambon_list    = ArrayHelper::map(BaseTambon::find()->where(['base_district_id'=>$district])->orderBy('tambon_name ASC')->all(),'id','tambon_name');
}
?>

<div class="areward-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="form-group">

                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'areward_name')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'date_areward')->widget(
                            DateTimePicker::className([
                                'name' => 'datetime_10',
                                'options' => ['placeholder' => 'Select operating time ...'],
                                'convertFormat' => true,
                                'pluginOptions' => [
                                    'format' => 'd-M-Y g:i A',
                                    'startDate' => '01-Mar-2014 12:00 AM',
                                    'todayHighlight' => true
                                ]
                            ])); ?>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'level_level_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Level::find()->all(),'level_id','level_name') ,['prompt'=>'ระดับรางวัล']) ?>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'institution_ag_award_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Institution::find()->all(),'ag_award_id','ag_award_name') ,['prompt'=>'ระดับรางวัล']) ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6 col-sm-6">



                        <?= $form->field($model, 'data_detail')->widget(CKEditor::className(), [
                            'options' => ['rows' => 2],
                            'preset' => 'standard',
                        ])->label("รายละเอียดของรางวัล") ?>
                    </div>

                    <div class="col-md-6 col-sm-6">

                        <?= $form->field($model, 'image')->fileInput() ?>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'countries_id')->textInput(['maxlength' => true])->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Countries::find()->all(), 'id', 'name'), ['prompt' => 'เลือกประเทศ'])->label(" ประเทศ ") ?>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'states_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\States::find()->all(), 'id', 'name'), ['prompt' => 'เลือกรัฐ'])->label(" รัฐ ") ?>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <?= $form->field($model, 'cities_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Cities::find()->all(), 'id', 'name'), ['prompt' => 'เลือกเมือง'])->label(" เมือง") ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-6 col-sm-6">
                        <?=$form->field($model, 'person_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map($persons,'id','name'),
                            'language' => 'th',
                            'options' => ['placeholder' => 'ค้นหาอาจารย์ที่ปรึกษา...','id'=>'positions'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label('อาจารย์ที่ปรึกษา') ?>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'person_id')->dropDownList(ArrayHelper::map($stds, 'id', 'name'), ['prompt' => 'เลือกนักศึกษา'])->label("นักศึกษา") ?>



                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <br/><center ></center><?= Html::submitButton('บันทึกข้อมูล', ['class' => 'btn btn-success']) ?></div>
        </div>
    </div>

</div>

<?php ActiveForm::end(); ?>



</div>
