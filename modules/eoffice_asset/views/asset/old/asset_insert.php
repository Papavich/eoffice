<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use kartik\widgets\DepDrop;

use app\modules\eoffice_asset\assets\AppAssetAsset;
AppAssetAsset::register($this);
use app\modules\eoffice_asset\models\Asset;
use app\modules\eoffice_asset\models\AssetGet;
use app\modules\eoffice_asset\models\AssetCompany;
use app\modules\eoffice_asset\models\AssetDetail;
use app\modules\eoffice_asset\models\AssetTypeDepartment;
use app\modules\eoffice_asset\models\AssetTypeUniversity;
use app\modules\eoffice_asset\models\AssetRoom;
use app\modules\eoffice_asset\models\AssetBuilding;
?>


    <!-- page title -->
    <header id="page-header">
        <h1>รายการครุภัณฑ์</h1>
        <ol class="breadcrumb">
            <li><a href="#">หน้าหลัก</a></li>
            <li><a href="#">รายการครุภัณฑ์</a></li>
            <li class="active">นำเข้าครุภัณฑ์</li>
        </ol>
    </header>
    <!-- /page title -->

<?php $form = ActiveForm::begin(); ?>

    <!------------------------------------------ส่วนที่ 1 -------------------------------------------------------->
<div class="panel panel-default">
    <div class="panel-heading panel-heading-transparent">
        <strong>ฟอร์มนำเข้าครุภัณฑ์ (ส่วนที่ 1)</strong>
    </div>

    <div class="panel-body">

        <form class="validate" action="view" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
            <fieldset>
                <!-- required [php action request] -->
                <input type="hidden" name="action" value="contact_send" />

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelasset, 'asset_date')->textInput() ?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelasset, 'asset_year')->textInput() ?>
                        </div>
                        <div class="col-md-4 col-sm-4 ">

                            <?php echo $form->field($modelasset, 'asset_get')->dropDownList(ArrayHelper::map(AssetGet::find()->all(), 'asset_get_id', 'asset_get_name'),['prompt'=>'เลือกวิธีการได้มา']) ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($modelasset, 'asset_budget')->textInput() ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?php echo $form->field($modelasset, 'asset_company')->dropDownList(ArrayHelper::map(AssetCompany::find()->all(),
                                'asset_company_id', 'asset_company_name'),['prompt'=>'เลือกบริษัท']) ?>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert_company"><i class="fa fa-plus-square "></i>
                                เพิ่มข้อมูลบริษัท
                            </button>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton($modelasset->isNewRecord ? 'Create' : 'Update', ['class' => $modelasset->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                </div>
<!--เพิ่มข้อมูลบริษัทธิ-->
                <div id="insert_company" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">เพิ่มข้อมูลบริษัท</h4>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                                    <fieldset>
                                        <!-- required [php action request] -->
                                        <input type="hidden" name="action" value="contact_send" />

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>ชื่อบริษัท</label>
                                                    <input type="email" name="contact[email]" value="" class="form-control required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>เบอร์โทรศัพท์ติดต่อ</label>
                                                    <input type="email" name="contact[email]" value="" class="form-control required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>E-mail</label>
                                                    <input type="email" name="contact[email]" value="" class="form-control required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>ที่อยู่บริษัท</label>
                                                    <textarea name="contact[experience]" rows="4" class="form-control required"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                </form>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                <button type="button" class="btn btn-primary">บันทึกข้อมูล</button>
                            </div>

                        </div>
                    </div>
                </div>
<!--สิ้นสุดเพิ่มข้อมูลบริษัท-->

            </fieldset>
        </form>

    </div>
</div>

    <!----------------------------------------------------ส่วนที่ 2--------------------------------------------------------- -->
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-transparent">
            <strong>ฟอร์มนำเข้าครุภัณฑ์ (ส่วนที่ 2)</strong>
        </div>
        <div class="panel-body">

            <div id="education_fields">

            </div>


            <form class="validate" action="#" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                <fieldset>
                    <!-- required [php action request] -->
                    <input type="hidden" name="action" value="contact_send" />

                    <div class="row">
                        <div class="form-group ">
                            <div class="col-md-6 col-sm-6 ">
                                <?= $form->field($model, 'asset_univ_code_start')->textInput() ?>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <?php echo $form->field($model, 'asset_univ_type')->dropDownList(ArrayHelper::map(AssetTypeUniversity::find()->all(), 'asset_type_univ_id', 'asset_type_univ_name'),['prompt'=>'เลือกประเภทครุภัณฑ์มหาวิทยาลัย']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group ">
                            <div class="col-md-6 col-sm-6 ">
                                <?= $form->field($model, 'asset_dept_code_start')->textInput() ?>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <?php echo $form->field($model, 'asset_dept_type')->dropDownList(ArrayHelper::map(AssetTypeDepartment::find()->all(), 'asset_type_dept_id', 'asset_type_dept_name'),['prompt'=>'เลือกประเภทครุภัณฑ์ภาควิชา']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4 col-sm-4 ">
                                <?= $form->field($model, 'asset_detail_name')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <?= $form->field($model, 'asset_detail_brand')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <?= $form->field($model, 'asset_detail_amount')->textInput() ?>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($model, 'asset_detail_age')->textInput() ?>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <?= $form->field($model, 'asset_detail_price')->textInput() ?>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <?= $form->field($model, 'asset_detail_price_wreck')->textInput() ?>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                <?= $form->field($model, 'asset_detail_insurance')->textInput() ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6">
                                <?php echo $form->field($model, 'asset_detail_building')->dropDownList(ArrayHelper::map(AssetBuilding::find()->all(), 'building_id', 'building_name'),['prompt'=>'เลือกอาคาร']) ?>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <?php echo $form->field($model, 'asset_detail_room')->dropDownList(ArrayHelper::map(AssetRoom::find()->all(), 'room_id', 'room_name'),['prompt'=>'เลือกห้อง/สถานที่']) ?>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>




            <div class="col-sm-3 nopadding">
                <div class="form-group">
                    <div class="input-group">

                        <div class="input-group-btn">
                            <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>

        </div>

    </div>

<!--ปุ่ม-->
<?php ActiveForm::end(); ?>

<script type="text/javascript">
    var room = 1;
    function education_fields() {


        var objTo = document.getElementById('education_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass");
        var rdiv = 'removeclass';
        divtest.innerHTML = '<div class="panel-body" id="' + room + '"><div id="education_fields"> </div> <form class="validate" > <fieldset> <!-- required [php action request] --> <input type="hidden" name="action" value="contact_send" /> <div class="row"> <div class="form-group "> <div class="col-md-6 col-sm-6 "> <label>รหัสครุภัณฑ์มหาวิทยาลัย</label> <input type="text" class="form-control masked" data-format="9999999999999" data-placeholder="_" placeholder="5702040000035"> </div> <div class="col-md-6 col-sm-6"> <label>ประเภทครุภัณฑ์ (มหาวิทยาลัย)</label> <select name="contact[position]" class="form-control pointer required"> <option value="">--- เลือกประเภท ---</option> <option value="Marketing">ครุภัณฑ์คอมพิวเตอร์</option> <option value="Developer">ครุภัณฑ์สำนักงาน</option> </select> </div> </div> </div> <div class="row"> <div class="form-group "> <div class="col-md-6 col-sm-6 "> <label>รหัสครุภัณฑ์ภาควิชา</label> <input type="text" class="form-control masked" data-format="คพ.99-99999/99" data-placeholder="_" placeholder="คพ.00-00000/00"> </div> <div class="col-md-6 col-sm-6"> <label>ประเภทครุภัณฑ์ (มหาวิทยาลัย)</label> <label>ประเภทครุภัณฑ์</label> <select name="contact[position]" class="form-control pointer required"> <option value="">--- เลือกประเภท ---</option> <option value="Marketing">ตู้ไม้ / โต๊ะทำงำน</option> <option value="Developer">เครื่องคอมพิวเตอร์</option> </select> </div> </div> </div> <div class="row"> <div class="form-group"> <div class="col-md-4 col-sm-4 "> <label>ชื่อรายการครุภัณฑ์</label> <input type="mat_name" name="contact[#]" value="" class="form-control required"></input> </div> <div class="col-md-4 col-sm-4 "> <label>ยี่ห้อ/ลักษณะ</label> <input type="mat_name" name="contact[#]" value="" class="form-control required"></input> </div> <div class="col-md-4 col-sm-4 "> <label>จำนวน</label> <input type="mat_name" name="contact[#]" value="" class="form-control required"></input> </div> </div> </div> <div class="row"> <div class="form-group"> <div class="col-md-4 col-sm-4"> <label>อายุการใช้งาน (ปี)</label> <input type="text" name="contact[expected_salary]" value="" class="form-control required" > </div> <div class="col-md-4 col-sm-4 "> <label>ราคาต่อหน่วย</label> <input type="mat_name" name="contact[#]" value="" class="form-control required"></input> </div> <div class="col-md-4 col-sm-4"> <label>ราคาซาก</label> <input type="text" name="contact[expected_salary]" value="" class="form-control required"> </div> </div> </div> <div class="row"> <div class="form-group"> <div class="col-md-12 col-sm-12"> <label>ระยะประกัน</label> <input type="text" class="form-control rangepicker" value="2015-01-01 - 2016-12-31" data-format="yyyy-mm-dd" data-from="2015-01-01" data-to="2016-12-31"> </div> </div> </div> <div class="row"> <div class="form-group"> <div class="col-md-6 col-sm-6"> <label>อาคาร</label> <select name="contact[position]" class="form-control pointer required"> <option value="">--- ระบุอาคาร/ตึก ---</option> <option value="Marketing">อาคาร/ตึก 1</option> <option value="Developer">อาคาร/ตึก 2</option> </select> </div> <div class="col-md-6 col-sm-6"> <label>ห้อง</label> <select name="contact[position]" class="form-control pointer required"> <option value="">--- ระบุห้อง ---</option> <option value="Marketing">ห้อง 1</option> <option value="Developer">ห้อง 2</option> </select><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button> </div> </div> </div> </fieldset> </form>  <div class="clear"></div> </div>';
        room++;
        objTo.appendChild(divtest);
    }

    function remove_education_fields(rid) {
        document.getElementById(rid).remove();
    }
</script>