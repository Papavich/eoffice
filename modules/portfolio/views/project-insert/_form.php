<?php

use yii\base\Model;
use yii\helpers\Url;
use app\modules\portfolio\controllers\BaseController;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\widgets\DepDrop;
use yii\helpers\Json;
use app\modules\portfolio\assets\AppAsset;
use app\modules\portfolio\models\Contributor;
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
use app\modules\portfolio\models\ProjectRole;
use kartik\datetime\DateTimePicker;
use yii\web\JsExpression;
use app\modules\portfolio\models\Countries;
use app\modules\portfolio\models\Cities;
use app\modules\portfolio\models\States;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $person array */
/* @var $modelProject app\modules\portfolio\models\Project */



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
if($modelProject->isNewRecord){
    $province = [];
    $district = [];
    $tambon = [];

    $district_list = [];
    $tambon_list = [];

}else{
    $province = $modelProject->cities->id;
    $district = $modelProject->cities->id;
    $tambon = $modelProject->cities_id;

    $district_list = ArrayHelper::map(States::find()->where(['country_id'=>$province])->orderBy('name ASC')->all(),'id','name');
    $tambon_list    = ArrayHelper::map(Cities::find()->where(['state_id'=>$district])->orderBy('name ASC')->all(),'id','name');
}
?>
<!-- page title -->
<header id="page-header">
    <h1>โครงการวิจัย</h1>
    <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li><a href="#">โครงการวิจัย</a></li>
        <li class="active">เพิ่มโครงการวิจัย</li>
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
            <div class="panel-body">
                <div class="row">
                    <div class="form-group">

                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelProject, 'project_name_thai')->textInput(['maxlength' => true]) ?>
                        </div>


                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelProject, 'project_name_eng')->textInput(['maxlength' => true]) ?>
                        </div>

                </div>
                    </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelProject, 'project_start')->widget(
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
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelProject, 'project_end')->widget(
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
                        <div class="col-md-4 col-sm-4">
                            <label>ผู้สนับสนุน</label>
                            <select name="sponsor[]">
                                <option value=""><-- ผู้สนับสนุนโครงการวิจัย --></option>
                                <?php
                                foreach (app\modules\portfolio\models\Sponsor::find()->all() as $sponsor) { ?>
                                    <option value="<?= $sponsor->sponsor_id ?>"><?= $sponsor->sponsor_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">

                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelProject, 'project_budget')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'decimal',
                                    'groupSeparator' => ',',
                                    'autoGroup' => true]
                            ]); ?>
                        </div>

                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelProject, 'repayment')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelProject, 'project_url')->widget(\yii\widgets\MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' =>  'url',
                                ],
                            ])->label("เว็บไซต์"); ?>
                        </div>
                    </div>
                    </div>







            </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelProject, 'cities_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Countries::find()->all(), 'id', 'name'), ['prompt' => 'เลือกประเทศ'])->label(" ประเทศ ") ?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelProject, 'cities_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\States::find()->all(), 'id', 'name'), ['prompt' => 'เลือกรัฐ'])->label(" รัฐ ") ?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelProject, 'cities_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Cities::find()->all(), 'id', 'name'), ['prompt' => 'เลือกเมือง'])->label(" เมือง") ?>
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
                <button type="button" class="pull-right add-item btn btn-success btn-xs" onclick="num(this)"><i class="fa fa-plus"></i>
                    เพิ่มสมาชิก
                </button>
                <div class="clearfix"></div>
            </div>

            <div class="panel-body container-items"><!-- widgetContainer -->
                <?php foreach ($modelsProjectMember as $index => $modelProjectMember): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">

                            <span class="panel-title-address">่ <?php

                                {

                                }

                                ?> </span>
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
                                        <?= $form->field($modelProjectMember, "[{$index}]person_id")->dropDownList(ArrayHelper::map($persons, 'id', 'name'), ['prompt' => '---- เลือก ------']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">  &nbsp;&nbsp;&nbsp;&nbsp;<label>หน้าที่ในโครงการ</label>
                                <div class="form-group">

                                    <div class="col-md-6 col-sm-6 ">

                                        <select name="role[]">
                                        <?php
                                        foreach (ProjectRole::find()->all() as $project_role) { ?>
                                            <option value="<?= $project_role->project_role_id ?>"><?= $project_role->project_role_name ?></option>
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

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>

        <div class="form-group " >
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

  //var count=0;

  //function num(f) {

  //  count += 1;

   //  f.myText.value = count
  //}

</script>