<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker ;

use kartik\widgets\DepDrop;

use app\modules\eoffice_asset\models;
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

<!--เก่า-->
<!-- page  title -->
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


                            <?= $form->field($model, 'asset_date')->widget(DatePicker::classname(), [
                                'language' => 'th',
                                'dateFormat' => 'yyyy-MM-dd',
                                'clientOptions'=>[
                                    'changeMonth'=>true,
                                    'changeYear'=>true,
                                ],
                                'options'=>['class'=>'form-control']
                            ]) ?>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($model, 'asset_year')->textInput() ?>
                        </div>
                        <div class="col-md-4 col-sm-4 ">

                            <?php echo $form->field($model, 'asset_get')->dropDownList(ArrayHelper::map(AssetGet::find()->all(), 'asset_get_id', 'asset_get_name'),['prompt'=>'เลือกวิธีการได้มา']) ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4">
                            <?= $form->field($model, 'asset_budget')->textInput() ?>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <?php echo $form->field($model, 'asset_company')->dropDownList(ArrayHelper::map(AssetCompany::find()->all(),
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
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

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



<!--ปุ่ม-->
<?php ActiveForm::end(); ?>

