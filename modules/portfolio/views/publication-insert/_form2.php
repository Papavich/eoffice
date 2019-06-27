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
use app\modules\portfolio\models\Category;
use app\modules\portfolio\models\PublicationsType;
use app\modules\portfolio\models\PublicationsTypeSearch;
use app\modules\portfolio\models\AuthorLevel;
use app\modules\portfolio\models\PublicationSearch;
use app\modules\portfolio\models\AuthorLevelSearch;
use app\modules\portfolio\models\MemberSearch;
use app\modules\portfolio\controllers;
use kartik\datetime\DateTimePicker;
use yii\web\JsExpression;
use app\modules\portfolio\models\Countries;
use app\modules\portfolio\models\Cities;
use app\modules\portfolio\models\States;
use app\modules\portfolio\models\Contributor;
use yii\helpers\Url;
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
if($modelPublication->isNewRecord){
    $province = [];
    $district = [];
    $tambon = [];

    $district_list = [];
    $tambon_list = [];

}else{
    $province = $modelPublication->cities->id;
    $district = $modelPublication->cities->id;
    $tambon = $modelPublication->cities_id;

    $district_list = ArrayHelper::map(States::find()->where(['country_id'=>$province])->orderBy('name ASC')->all(),'id','name');
    $tambon_list    = ArrayHelper::map(Cities::find()->where(['state_id'=>$district])->orderBy('name ASC')->all(),'id','name');
}
?>
<!-- page title -->
<header id="page-header">
    <h1>ผลงานตีพิมพ์</h1>
    <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li><a href="#">ผลงานตีพิมพ์</a></li>
        <li class="active">เพิ่มวารสารวิชาการ</li>
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
                <i class="fa fa-envelope"></i> เพิ่มข้อมูล (ส่วนที่ วารสารวิชาการ)
            </div>
            <div class="row">
                <div class="form-group ">
                    <div class="col-md-12 col-sm-12">
                        <?php echo '<br/>';?>
                        <center>
                        <?= Html::a('วารสารวิชาการ', ['publication-insert/create2'], ['class' => 'btn btn-success']) ?>

                        <?= Html::a('บทความทางวิชาการ', ['publication-insert/create3'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('การประชุมวิชาการ', ['publication-insert/create4'], ['class' => 'btn btn-success']) ?>
                        </center>

                    </div>
                </div>
            </div>


                <div class="panel-body">

                    <div class="row">
                        <div class="form-group">

                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'pub_name_thai')->textInput(['maxlength' => true])->label("ชื่อวารสาร (ภาษาไทย)") ?>
                            </div>


                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($modelPublication, 'pub_name_eng')->textInput(['maxlength' => true])->label("ชื่อวารสาร (ภาษาอังกฤษ)") ?>
                            </div>

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
                                    ]))->label(" วันที่ ")
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'acticle_detail')->textInput(['maxlength' => true])->label("รายละเอียดบทความ ") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'page_number')->textInput(['maxlength' => true])->label("เลขที่หน้า") ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'abstract')->textInput(['maxlength' => true]) ->label(" บทคัดย่อ ")?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'press')->textInput(['maxlength' => true])->label("ประเทศ") ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?= $form->field($modelPublication, 'publisher')->textInput(['maxlength' => true])->label(" สำนักพิมพ์ ") ?>
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
                            <?= $form->field($modelPublication, 'cities_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Cities::find()->all(), 'id', 'name'), ['prompt' => 'เมืองที่จัดงาน']) ->label(" เมือง ")?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'article')->textInput()->label(" บทความ ") ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'number')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '999-999   หน้า'])->label("เลขหน้า"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'impact_factor')->textInput() ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelPublication, 'db_db_id')->dropDownList(ArrayHelper::map(app\modules\portfolio\models\Db::find()->all(), 'db_id', 'db_name'), ['prompt' => 'มาตราฐานวิชาการ'])->label(" มาตรฐานวิชาการ ") ?>

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






                    </div>
                    <div class="col-md-6 col-sm-6">
                        <select name="type[]">
                            <option value=""><-- ประเภทผลงานตีพิมพ์ --></option>
                            <?php
                            foreach (PublicationsType::find()->all() as $type) { ?>


                                <option value="<?= $type->pub_type_id; ?>"><?= $type->pub_type_name ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>



            <div class="row">

                <div class="col-md-4 col-sm-4">

                    <div class="form-group">


                        <?= Html::dropDownList('country[]',$province,

                            ArrayHelper::map(Countries::find()->orderBy('name ASC')->all(), 'id','name'),
                            [
                                'class'=>'form-control',
                                'id'=>'country',
                                'prompt'=>'เลือกประเทศ',
                                'onchange' =>'
                         $.get("'.Url::toRoute('/portfolio/base/state').'",{id:$(this).val()})
                           .done(function(data){
                                   $("select#state").html(data);
                                   });
                                '
                            ]





                        );?>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">

                        <?= Html::dropDownList('state[]',$district,
                            $district_list,

                            [
                                'class'=>'form-control',
                                'id'=>'state',
                                'prompt'=>'เลือกรัฐ',
                                'onchange' =>'
                           $.get("'.Url::toRoute('/portfolio/base/city').'",{id:$(this).val()})
                           .done(function(data){
                                   $("select#city").html(data);
                                   });
                                '
                            ]
                        //ArrayHelper::map(BaseDistrict::find()->orderBy('district_name ASC')->all(), 'id','district_name')




                        );?>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group">

                        <?= Html::dropDownList('city[]',$tambon,
                            $district_list,

                            [
                                'class'=>'form-control',
                                'id'=>'city',
                                'prompt'=>'เลือกเมือง',
                                'onchange' =>'
                           $.get("'.Url::toRoute('/portfolio/base/city').'",{id:$(this).val()})
                          
                                '
                            ]
                        //ArrayHelper::map(BaseDistrict::find()->orderBy('district_name ASC')->all(), 'id','district_name')




                        );?>

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
                                        <?php echo $form->field($modelProjectMember, "[{$index}]member_name")->textInput(['maxlength' => true])->label("ชื่อ") ?>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <?php echo $form->field($modelProjectMember, "[{$index}]member_lname")->textInput(['maxlength' => true])->label("นามสกุล") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 ">
                                        <?= $form->field($modelProjectMember, "[{$index}]person_id")->dropDownList(ArrayHelper::map($persons, 'id', 'name'), ['prompt' => '---- เลือก ------'])->label("ชื่อเจ้าหน้าที่และอาจารย์") ?>
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
            <center><?= Html::submitButton($modelProjectMember->isNewRecord ? 'สร้าง' : 'Update', ['class' => 'btn btn-primary']) ?></center>
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



</script>