<?php

use yii\base\Model;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\widgets\DepDrop;
use yii\helpers\Json;
use app\modules\portfolio\assets\AppAsset;

AppAsset::register($this);

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
use app\modules\portfolio\controllers;
use kartik\datetime\DateTimePicker;
use yii\web\JsExpression;

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
?>
<!-- page title -->
<header id="page-header">
    <h1>ผลงานตีพิมพ์</h1>
    <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li><a href="#">ผลงานตีพิมพ์</a></li>
        <li class="active">เพิ่มผลงานตีพิมพ์</li>
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
                <i class="fa fa-envelope"></i> เพิ่มข้อมูล (ส่วนที่ 1)
            </div>
            <div class="row">
                <div class="form-group ">
                    <div class="col-md-12 col-sm-12">
                        <button type="button" onclick="pub1(this)" class="btn btn-default">
                            รูปแบบที่หนึ่ง
                        </button>
                        <button type="button" onclick="pub2(this)" class="btn btn-default">
                            รูปแบบที่สอง
                        </button>
                        <button type="button" onclick="pub3(this)" class="btn btn-default">
                            รูปแบบที่สาม
                        </button>

                        <input type="text" name="cond[]" value="inside" class="hidden">
                    </div>
                </div>
            </div>
            <div class="f">
                11111111111
                <div class="panel-body">

                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'pub_name_thai')->textInput(['maxlength' => true]) ?>
                            </div>


                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'pub_name_eng')->textInput(['maxlength' => true]) ?>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'book_name')->textInput() ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'date')->widget(
                                DateTimePicker::className([
                                    'name' => 'datetime_10',
                                    'options' => ['placeholder' => 'Select operating time ...'],
                                    'convertFormat' => true,
                                    'pluginOptions' => [
                                        'format' => 'd-M-Y g:i A',
                                        'startDate' => '01-Mar-2014 12:00 AM',
                                        'todayHighlight' => true
                                    ]
                                ]));
                            ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'acticle_detail')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'page_number')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'abstract')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'press')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'publisher')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'ISBN')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => 'ISBN  999-999-999-9']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'issn')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => 'ISSN  9999-9999']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'dataval')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'article')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'number')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '999-999   หน้า']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'issuance')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'dataindex')->dropDownList(ArrayHelper::map($persons, 'id', 'name'), ['prompt' => '---- SELECT ME ------']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'impact_factor')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'doi')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => 'DOI  99.9999/999']); ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-6 col-sm-6">
                            <select name="type[]">
                                <option value=""><-- ประเภทผลงานตีพิมพ์ --></option>
                                <?php
                                foreach (PublicationsType::find()->all() as $type) { ?>


                                    <option value="<?= $type->pub_type_id; ?>"><?= $type->pub_type_name ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'cities_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Cities::find()->all(), 'id', 'name'), ['prompt' => 'เมือง']) ?>


                        </div>
                        <
                    </div>

                </div>
            </div>


            <!--ฟอร์มที่2-->
            <div class="f1 hidden">
                2222222222222222
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'pub_name_thai')->textInput(['maxlength' => true]) ?>
                            </div>


                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'pub_name_eng')->textInput(['maxlength' => true]) ?>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'book_name')->textInput() ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'date')->widget(
                                DateTimePicker::className([
                                    'name' => 'datetime_10',
                                    'options' => ['placeholder' => 'Select operating time ...'],
                                    'convertFormat' => true,
                                    'pluginOptions' => [
                                        'format' => 'd-M-Y g:i A',
                                        'startDate' => '01-Mar-2014 12:00 AM',
                                        'todayHighlight' => true
                                    ]
                                ]));
                            ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'acticle_detail')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'page_number')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'abstract')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'press')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'publisher')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'ISBN')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => 'ISBN  999-999-999-9']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'issn')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => 'ISSN  9999-9999']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'dataval')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'article')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'number')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '999-999   หน้า']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'issuance')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'dataindex')->dropDownList(ArrayHelper::map($persons, 'id', 'name'), ['prompt' => '---- SELECT ME ------']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'impact_factor')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'doi')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => 'DOI  99.9999/999']); ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-6 col-sm-6">
                            <select name="type[]">
                                <option value=""><-- ประเภทผลงานตีพิมพ์ --></option>
                                <?php
                                foreach (PublicationsType::find()->all() as $type) { ?>


                                    <option value="<?= $type->pub_type_id; ?>"><?= $type->pub_type_name ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'cities_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Cities::find()->all(), 'id', 'name'), ['prompt' => 'เมือง']) ?>


                        </div>
                        <
                    </div>

                </div>
            </div>
            <!---->


            <!--ฟอร์มที่3-->
            <div class="f2 hidden">
                3333333333333333
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'pub_name_thai')->textInput(['maxlength' => true]) ?>
                            </div>


                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'pub_name_eng')->textInput(['maxlength' => true]) ?>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'book_name')->textInput() ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'date')->widget(
                                DateTimePicker::className([
                                    'name' => 'datetime_10',
                                    'options' => ['placeholder' => 'Select operating time ...'],
                                    'convertFormat' => true,
                                    'pluginOptions' => [
                                        'format' => 'd-M-Y g:i A',
                                        'startDate' => '01-Mar-2014 12:00 AM',
                                        'todayHighlight' => true
                                    ]
                                ]));
                            ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'acticle_detail')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'page_number')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'abstract')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'press')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'publisher')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'ISBN')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => 'ISBN  999-999-999-9']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'issn')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => 'ISSN  9999-9999']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'dataval')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'article')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'number')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '999-999   หน้า']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'issuance')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'dataindex')->dropDownList(ArrayHelper::map($persons, 'id', 'name'), ['prompt' => '---- SELECT ME ------']) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'impact_factor')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'doi')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => 'DOI  99.9999/999']); ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-6 col-sm-6">
                            <select name="type[]">
                                <option value=""><-- ประเภทผลงานตีพิมพ์ --></option>
                                <?php
                                foreach (PublicationsType::find()->all() as $type) { ?>


                                    <option value="<?= $type->pub_type_id; ?>"><?= $type->pub_type_name ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'cities_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Cities::find()->all(), 'id', 'name'), ['prompt' => 'เมือง']) ?>


                        </div>
                        <
                    </div>

                </div>
            </div>
            <!---->


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
                                    <div class="col-md-12 col-sm-12">
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
                                        <?php echo $form->field($modelProjectMember, "[{$index}]member_name")->textInput(['maxlength' => true]) ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <?php echo $form->field($modelProjectMember, "[{$index}]member_lname")->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 ">
                                        <?= $form->field($modelProjectMember, "[{$index}]person_id")->dropDownList(ArrayHelper::map($persons, 'id', 'name'), ['prompt' => '---- SELECT ME ------']) ?>
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
            <?= Html::submitButton($modelProjectMember->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
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