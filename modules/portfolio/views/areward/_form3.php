<?php

use yii\base\Model;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\widgets\DepDrop;
use yii\helpers\Json;
use app\modules\portfolio\assets\AppAsset;
use yii\helpers\Url;
AppAsset::register($this);
use app\modules\portfolio\models\Countries;
use app\modules\portfolio\models\Cities;
use app\modules\portfolio\models\States;

use app\modules\portfolio\models\Publication;
use app\modules\portfolio\models\Member;
use app\modules\portfolio\models\PublicationOrder;
//use app\modules\portfolio\models\ProjectQuery;
use app\modules\portfolio\models\PublicationsType;
use app\modules\portfolio\models\PublicationsTypeSearch;
use app\modules\portfolio\models\AuthorLevel;
use app\modules\portfolio\models\PublicationSearch;
use app\modules\portfolio\models\AuthorLevelSearch;
use app\modules\portfolio\models\MemberSearch;
use app\modules\portfolio\models\Contributor;
use app\modules\portfolio\controllers;
use kartik\datetime\DateTimePicker;
use yii\web\JsExpression;
use kartik\widgets\Select2;


use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $person array */


$js = 'jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("ProjectMember:" + (ProjectMember + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("ProjectMember: " + (ProjectMember + 1))
    });
});
';

$this->registerJs($js);
//if($modelPublication->isNewRecord){
//    $province = [];
//    $district = [];
//    $tambon = [];
//
//    $district_list = [];
//    $tambon_list = [];
//
//}else{
//    $province = $modelPublication->cities->id;
//    $district = $modelPublication->cities->id;
//    $tambon = $modelPublication->cities_id;
//
//    $district_list = ArrayHelper::map(States::find()->where(['country_id'=>$province])->orderBy('name ASC')->all(),'id','name');
//    $tambon_list    = ArrayHelper::map(Cities::find()->where(['state_id'=>$district])->orderBy('name ASC')->all(),'id','name');
//}
?>
<!-- page title -->
<header id="page-header">
    <h1>ผลงานตีพิมพ์</h1>
    <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li><a href="#">ผลงานตีพิมพ์</a></li>
        <li class="active">เพิ่มข้อมูลผลงานตีพืมพ์</li>
    </ol>
</header>
    <!-- /page title -->
    <div class="publication-insert-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <!----------------------------------insert asset------------------------------------>
    <fieldset>
        <!-- required [php action request] -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> เพิ่มข้อมูล (บทความทางวิชาการ และ )
            </div>
            <div class="row">
                <div class="form-group ">
                    <div class="col-md-12 col-sm-12">
                        <?php echo '<br/>';?>
                        <center>


                            <?= Html::a('บทความทางวิชาการ', ['publication-insert/create3'], ['class' => 'btn btn-success']) ?>
                            <?= Html::a('การประชุมวิชาการ', ['publication-insert/create4'], ['class' => 'btn btn-success']) ?>
                        </center>
                    </div>
                </div>
            </div>
            <div class="f">
                
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

                                <?= $form->field($model, 'data_detail')->textInput(['maxlength' => true]) ?>
                            </div>

                            <div class="col-md-6 col-sm-6">

                                <?= $form->field($model, 'image')->fileInput() ?>
                            </div>
                            >
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















                </div>
            </div>





        </div>
        <!-- Modal Header -->
        <!------------------- insert asset detail (multi-form)----------------------->
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 4, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsProjectMember[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'pro_member_id',
                'member_name',
                'member_lname',
                'project_role_id',
                'person_person_id',
                'project_project_id',
            ],
        ]);
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> เพิ่มสมาชิก (ส่วนที่ 2)
                <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i>
                    เพิ่มสมาชิก
                </button>
                <div class="clearfix"></div>
            </div>

            <div class="panel-body container-items"><!-- widgetContainer -->
                <?php foreach ($modelsProjectMember as $index => $modelProjectMember): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address"> </span>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i
                                        class="fa fa-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                <div class="form-group ">
                                    <div class="col-md-4 col-sm-4">
                                        <button type="button" onclick="inside(this)" class="btn btn-default">
                                            ภายในระบบ
                                        </button>
                                        <button type="button" onclick="outside(this)" class="btn btn-default">
                                            ภายนอกระบบ
                                        </button>
                                        <input type="text" name="cond[]" value="inside" class="hidden">
                                    </div>
                                </div>


                            </div>
                            <div class="row hidden">
                                <div class="form-group ">
                                    <div class="col-md-6 col-sm-6">
                                        <?php echo $form->field($modelProjectMember, "[{$index}]member_name")->textInput(['maxlength' => true])->label("ชื่อ") ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <?php echo $form->field($modelProjectMember, "[{$index}]member_lname")->textInput(['maxlength' => true])->label("นามสกุล")?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 ">

                                        <?= $form->field($modelProjectMember, "[{$index}]person_id")->dropDownList(ArrayHelper::map($persons, 'id', 'name'), ['prompt' => '---- เลือก ------'])->label("สมาชิกผลงานตีพิมพ์") ?>



                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 ">
                                        <select name="role[]">
                                            <option value="">-- ลำดับผู้เขียน --</option>
                                            <?php
                                            foreach (AuthorLevel::find()->all() as $auth_level) { ?>

                                                <option value="<?= $auth_level->auth_level_id ?>"><?= $auth_level->auth_level_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-md-6 col-sm-6 ">


                                        <input type="checkbox"  id="status"  name="status[]"
                                        <?php
                                        foreach (Contributor::find()->all() as $i ) { ?>
                                            <option value="<?= $i->contributor_id ?>"><?= $i->contributor_name?></option>


                                        <?php } ?>



                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>

        <div class="form-group">
            <center><?= Html::submitButton($modelProjectMember->isNewRecord ? 'บันทึกข้อมูล' : 'Update', ['class' => 'btn btn-success']) ?></center>
        </div>

        <?php ActiveForm::end(); ?>
</div>


<script>

  function inside (ev) {
//    console.log(ev.parentNode.parentNode.parentNode.parentNode.childNodes)
    var inside = ev.parentNode.parentNode.parentNode.parentNode.childNodes[5]
    var outside = ev.parentNode.parentNode.parentNode.parentNode.childNodes[3]
    var cond = ev.parentNode.childNodes[5]
    $(cond).val('inside')
    $(inside).attr('class', 'row')
    $(outside).attr('class', 'row hidden')

  }

  function outside (ev) {
//    console.log(ev.parentNode.parentNode.parentNode.parentNode.childNodes)
    var inside = ev.parentNode.parentNode.parentNode.parentNode.childNodes[5]
    var outside = ev.parentNode.parentNode.parentNode.parentNode.childNodes[3]
    var cond = ev.parentNode.childNodes[5]
    $(cond).val('outside')
    $(inside).attr('class', 'row hidden')
    $(outside).attr('class', 'row')
  }

  function pub1 (ev) {
    console.log(ev)
//    var pub1 = ev.parentNode.parentNode.parentNode.parentNode.childNodes[5]
//    var pub2 = ev.parentNode.parentNode.parentNode.parentNode.childNodes[3]
//    var pub3 = ev.parentNode.parentNode.parentNode.parentNode.childNodes[3]
//    var cond = ev.parentNode.childNodes[5]
//    $(cond).val('pub1')
    $('.f').attr('class', 'f')
    $('.f1').attr('class', 'f1 hidden')
    $('.f2').attr('class', 'f2 hidden')

  }

  function pub2 (ev) {
    console.log(ev)
//    var pub1 = ev.parentNode.parentNode.parentNode.parentNode.childNodes[5]
//    var pub2 = ev.parentNode.parentNode.parentNode.parentNode.childNodes[3]
//    var pub3 = ev.parentNode.parentNode.parentNode.parentNode.childNodes[3]
//    var cond = ev.parentNode.childNodes[5]
//    $(cond).val('pub2')
    $('.f').attr('class', 'f hidden')
    $('.f1').attr('class', 'f1 ')
    $('.f2').attr('class', 'f2 hidden')
  }

  function pub3 (ev) {
    console.log(ev)
//    var pub1 = ev.parentNode.parentNode.parentNode.parentNode.childNodes[5]
//    var pub2 = ev.parentNode.parentNode.parentNode.parentNode.childNodes[3]
//    var pub3 = ev.parentNode.parentNode.parentNode.parentNode.childNodes[3]
//    var cond = ev.parentNode.childNodes[5]
//    $(cond).val('pub3')
    $('.f').attr('class', 'f hidden')
    $('.f1').attr('class', 'f1 hidden')
    $('.f2').attr('class', 'f2 ')
  }


</script>