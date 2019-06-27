<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'สร้างแบบฟอร์มใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('cs-e-office/modules/requestform/assets/js/dynamic-form.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="test-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Yii::$app->getRequest()->getQueryParams()?>

    <?php $form = ActiveForm::begin(['action' => 'approval','id' => 'mainform', 'method' => 'post',]);?>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-lg-3">

                <ul class="side-nav list-group margin-bottom30">
                    <li class="list-group-item list-toggle ">   <!-- NOTE: "active" to be open on page load -->
                        <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-2"><i class="fa fa-edit"></i> แบบฟอร์ม</a>
                        <ul id="collapse-2" class="collapse in" ><!-- NOTE: "collapse in" to be open on page load -->
                            <li><a onclick="txtFunction()"><i class="fa fa-angle-right"></i> Textbox</a></li>
                            <li><a onclick="#"><i class="fa fa-angle-right"></i> Areabox</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Checkbox</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Radiobox</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Dropdown</a></li>
                            <li><a onclick="dateFunction()"><i class="fa fa-angle-right"></i> Datepicker</a></li>
                        </ul>
                    </li>
                    <li class="list-group-item list-toggle">   <!-- NOTE: "active" to be open on page load -->
                        <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-3"><i class="fa fa-user"></i> ข้อมูลพื้นฐาน</a>
                        <ul id="collapse-3" class="collapse in"><!-- NOTE: "collapse in" to be open on page load -->
                            <li><a href="#"><i class="fa fa-angle-right"></i> ชื่อ</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> นามสกุล</a></li>
                            <li><a onclick="titleFunction()"><i class="fa fa-angle-right"></i> คำนำหน้า</a></li>
                            <li><a onclick="genderFunction()" ><i class="fa fa-angle-right"></i> เพศ</a></li>
                            <li><a onclick="majorFunction()"><i class="fa fa-angle-right"></i> สาขาวิชา</a></li>
                            <li><a onclick="deptFunction()"><i class="fa fa-angle-right"></i> ภาควิชา</a></li>
                            <li><a onclick="factFunction()"><i class="fa fa-angle-right"></i> คณะที่สังกัด</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> เกรดเฉลี่ย</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> ภาคการศึกษา</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> ปีการศึกษา</a></li>

                        </ul>
                    </li>
                    <li class="list-group-item list-toggle">   <!-- NOTE: "active" to be open on page load -->
                        <a data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-4"><i class="fa fa-home"></i> ข้อมูลส่วนตัว</a>
                        <ul id="collapse-4" class="collapse in"><!-- NOTE: "collapse in" to be open on page load -->
                            <li><a href="#"><i class="fa fa-angle-right"></i> บ้านเลขที่</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> หมู่ที่</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> ตำบล</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> ถนน</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> อำเภอ</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> จังหวัด</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> รหัสไปรษณีย์</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> เบอร์โทรศัพท์</a></li>

                        </ul>
                    </li><br>


                    <div class="form-group">
                        <a onclick="resetElements()" class="btn btn-3d btn-reveal btn-red">
                            <i class="fa fa-times"></i>
                            <span>รีเซ็ท</span>
                        </a>

                        <?= Html::submitButton($model->isNewRecord ? 'เสร็จสิ้น' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-3d btn-reveal btn-green' : 'btn btn-3d btn-reveal btn-green']) ?>

                    </div>

                    <!--  <a data-toggle="modal" data-target="#req_confirm" class="btn btn-3d btn-reveal btn-green">
                        <i class="fa fa-check"></i>
                        <span>ยืนยัน</span>
                      </a>
              -->
                </ul>
            </div>
            <div class="col-md-9 col-lg-9">
                <div id="myForm" class="form-group">
                   

                    <div class="row" align="center">
                        <div class="col-md-3 col-sm-3">
                            <span>รหัสอ้างอิง</span>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <span>ชื่อฟิลด์</span>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <span>ฟังก์ชัน</span>
                        </div>

                    </div>


                    <input type='hidden' id= 'boxTYPE' name='boxTYPE' value='' />
                    <input type='hidden' id= 'counter' name='counter' value='' />
                </div>
            </div>



            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
