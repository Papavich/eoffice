<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\base\view;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $location \app\modules\materialsystem\models\MatsysLocation */
/* @var $locationDel \app\modules\materialsystem\models\MatsysMaterial */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- page title -->
<header id="page-header">
    <h1>ตั้งค่าสถานที่จัดเก็บ</h1>
</header>
<!-- /page title -->

<div id="content" class="padding-20">

    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการสถานที่จัดเก็บ</strong> <!-- panel title -->
							</span>
        </div>
        <!-- Seacrch Page -->

        <div class="row">

            <!-- LEFT -->
            <div class="col-md-12">

                <!-- Panel Tabs -->
                <div id="panel-ui-tan-l1" class="panel panel-default">

                    <div class="panel-heading">
                        <!-- tabs nav -->
                        <ul class="nav nav-tabs pull-left">
                            <li class="active"><!-- TAB 1 -->
                                <a href="#search_page1" data-toggle="tab">ค้นหาจากรหัส หรือ ชื่อสถานที่จัดเก็บ</a>
                            </li>
                        </ul>
                        <!-- /tabs nav -->

                    </div>

                    <!-- panel content -->
                    <div class="panel-body">

                        <!-- tabs content -->
                        <div class="tab-content transparent">

                            <div id="search_page1" class="tab-pane active"><!-- TAB 1 CONTENT -->
                                <div class="col-md-3 col-sm-3">
                                    <select class="form-control select2" style="width: 230px;">
                                        <option value=""></option>
                                        <option value="1">รหัส : L001</option>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-white">
                                    <i class="fa fa-search"> ค้นหา</i>
                                </button>

                            </div><!-- /TAB 1 CONTENT -->
                        </div>
                        <!-- /tabs content -->

                    </div>
                    <!-- /panel content -->

                    <!-- Seacrch Page -->
        <!-- panel content -->
        <div class="panel-body">

            <table class="table table-striped table-bordered table-hover">

                <table class="table table-striped table-bordered table-hover">

                <button type="button" class="btn-success btn-3 btn-sm btn-3d" data-toggle="modal" data-target="#myAdd">เพิ่มสถานที่</button>
                <thead>
                <tr>
                    <th width="1%">ลำดับ</th>
                    <th width="13%">รหัสสถานที่</th>
                    <th>ชื่อสถานที่</th>
                    <th width="20%">การจัดการ</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 1; $lop = 0; $idCheck = 0; ?>

                <?php foreach ($mat as $locationDel) { ?>  <!-- ทั้งหมดนี้คือคำสั่งสร้างตัวแปรไว้ check การลบ -->
                    <?php $check[] = $locationDel->location_id;
                    $cutCheck = array_unique($check); //คำสั่ง ตัดอาเรย์ที่ว้ำกันออกไป
                    $lop = count($cutCheck);    //คำสั่งเก็บรอบ loop
                }   ?>

                <?php foreach ($mat_location as $location) {
                    $idCheck = 0; // กำหนดให้ idCheck เพื่อ รีเซทค่า check ใหม่ ?>
                <tr>
                    <td><?= $count ?></td>
                    <td><?= $location->location_id ?></td>
                    <td><?= $location->location_name ?></td>
                    <td>
                        <div class="col-md-3 col-xs-2">
                            <a class="btn btn-xs btn-warning btn-3d" data-toggle="modal" data-target="#myEdit<?= $location->location_id ?>">แก้ไข</a>
                        </div>
<!--                        --><?php //for($i=0; $i<$cutCheck[$lop-1]; $i++) { ?>
<!--                            --><?php //if ($location->location_id == $cutCheck[$i]){
//                                $idCheck = 1;
//                            }
//                        }?>
                        <?php if($idCheck == 0){ ?>
                            <div class="col-md-3 col-xs-2">
                                <a class="btn btn-xs btn-danger btn-3d" data-toggle="modal" data-target="#myDel<?= $location->location_id ?>">ลบ</a>
                            </div>
                    </td>
                    <?php } ?>
                </tr>
                    <?php $count++; } ?>
                </tbody>
            </table>
        </div>
    </div>
                <div class="col-md-12">
                    <div class="text-center">
                        <?php
                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                        ?>
                    </div>
                </div>
    <!-- ============================= modal add ====================================-->
    <div id="myAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="col-md-12">

                    <!-- ------ -->
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-transparent">
                            <strong>เพิ่มสถานที่จัดเก็บ</strong>
                        </div>

                        <div class="panel-body">

                            <?php $form = ActiveForm::begin(['action'=>['location/create'],]) ?>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <label>ลำดับ</label>
                                        <input type="text" class="form-control" name="count" value="<?= $count ?>" disabled>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <label>รหัสสถานที่</label>
                                        <input type="text" class="form-control" name="location_id" value="<?= $count ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <label>ชื่อสถานที่</label>
                                        <input type="text" name="location_name" value="" class="form-control required">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input onclick="myAlert()" class="btn btn-success btn-small margin-top-30" type="submit" value="บันทึก">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <a href="#" class="btn btn-danger  btn-small margin-top-30" data-dismiss="modal">ยกเลิก</a>
                                </div>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================= modal add ====================================-->

    <!-- ============================= modal delete ====================================-->
    <?php foreach ($mat_location as $location) {  ?>
        <div id="myDel<?= $location->location_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="col-md-12">

                        <!-- ------ -->
                        <div class="panel panel-default" align="center">
                            <div class="panel-heading panel-heading-transparent">
                                <h4 class="modal-title" id="myModalLabel">คุณต้องการลบใช่หรือไม่</h4>
                            </div>
                            <div class="modal-body">
                                <?php $form = ActiveForm::begin(['action'=>['location/deletelocation'],]) ?>
                                <div class="modal-body" align="center">
                                    <input type="hidden" name="location_id[]" value="<?= $location->location_id ?>">
                                    <input onclick="myDel()" class="btn btn-success btn-3d" type="submit" value="ยืนยัน">
                                    <a href="#" class="btn btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                                </div>
                                <?php ActiveForm::end() ?>
                            </div>
                        </div>
                        <!-- /----- -->
                    </div>
                </div>
            </div>
        </div>
    <?php  } ?>
    <!-- ============================= modal delete ====================================-->

    <!-- =============================  edit modal ====================================-->
    <?php $count=1; ?>
    <?php foreach ($mat_location as $location) {  ?>
    <div id="myEdit<?= $location->location_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="row">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="col-md-12">

                        <!-- ------ -->
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>แก้ไขสถานที่จัดเก็บ</strong>
                            </div>

                            <div class="panel-body">

                                <?php $form = ActiveForm::begin(['action'=>['location/updatelocation'],])?>                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label>ลำดับ</label>
                                            <input type="text" class="form-control" name="count" value="<?= $count ?>" disabled>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label>รหัสสถานที่</label>
                                            <input type="text" class="form-control" name="location_id" value="ฺ"<?= $location->location_id ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="loc_id[]" value="<?= $location->location_id ?>">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <label>ชื่อสถานที่</label>
                                            <input type="text" name="location_name[]" value="<?= $location->location_name ?>" class="form-control required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input onclick="myAlert()" class="btn btn-3d btn-success btn-sm btn-block margin-top-30" type="submit" value="บันทึก">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <a href="#" class="btn btn-danger btn-sm btn-block margin-top-30" data-dismiss="modal">ยกเลิก</a>
                                    </div>
                                </div>
                                <?php ActiveForm::end() ?>
                            </div>

                        </div>
                        <!-- /----- -->
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php $count++; } ?>
    <!-- ============================= edit modal ====================================-->
</div>

<!--    <script>-->
<!--        function myAlert(){-->
<!--            alert("บันทึกข้อมูลสำเร็จ");-->
<!--        }-->
<!--        function myDel(){-->
<!--            alert("ลบรายการสำเร็จ");-->
<!--        }-->
<!--    </script>-->