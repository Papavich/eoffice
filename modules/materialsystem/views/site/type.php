<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\base\view;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;


/* @var $this yii\web\View */
/* @var $type \app\modules\materialsystem\models\MatsysMaterialType */
/* @var $type \app\modules\materialsystem\models\MatsysMaterialType */
/* @var $typeDel \app\modules\materialsystem\models\MatsysMaterial */
/* @var $searchModel \app\modules\materialsystem\models\Search */
/* @var $model \app\modules\materialsystem\models\Search */
/* @var $form yii\widgets\ActiveForm */

?>

<!-- page title -->
<!--<header id="page-header">
    <h1>ตั้งค่าหมวดหมู่</h1>
</header>-->
<!-- /page title -->

<div id="content" class="padding-20">

    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>รายการหมวดหมู่</strong> <!-- panel title -->
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
                                <a href="#search_page1" data-toggle="tab">ค้นหาจากรหัส หรือ ชื่อหมวดหมู่</a>
                            </li>
                        </ul>
                        <!-- /tabs nav -->

                    </div>

                    <!-- panel content -->
                    <div class="panel-body">

                        <!-- tabs content -->

                        <div id="search_page1" class="tab-pane active"><!-- TAB 1 CONTENT -->
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                <select class="form-control select2" style="width: 230px;">
                                    <option value=""></option>
                                    <option value="1">รหัส : T001</option>

                                </select>
                            </div>
                            <div class="col-md-2 col-sm-9 col-xs-6">
                                <button type="submit" class="btn btn-white">
                                    <i class="fa fa-search"> ค้นหา</i>
                                </button>
                            </div>

                        </div><!-- /TAB 1 CONTENT -->
                        <!-- /tabs content -->

                    </div>


                    <!-- /panel content -->

                    <!-- Seacrch Page -->
                    <!-- panel content -->
                    <!--<div class="padding-20" >
                        <button type="button" class="glyphicon glyphicon-plus btn-success btn-3 btn-sm btn-3d" data-toggle="modal" data-target="#myAdd"> เพิ่มหมวดหมู่</button>
                    </div>-->
                    <div class="panel-body">
                        <?php /*echo $this->render('_typesearch', ['models' => $searchModel]); */ ?>

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="1%">ลำดับ</th>
                                <th width="13%">รหัสหมวดหมู่</th>
                                <th>ชื่อหมวดหมู่</th>
                                <th width="20%">
                                    <button type="button"
                                            class="glyphicon glyphicon-plus btn-success btn-3 btn-sm btn-3d"
                                            data-toggle="modal" data-target="#myAdd"> เพิ่มหมวดหมู่
                                    </button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; ?>

                            <?php foreach ($mat_type as $type) {
                                $idCheck = 0; // กำหนดให้ idCheck เพื่อ รีเซทค่า check ใหม่ ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $type->material_type_id ?></td>
                                    <td><?= $type->material_type_name ?></td>
                                    <td>
                                        <div class="col-md-2 col-xs-2">
                                            <a class="glyphicon glyphicon-edit btn btn-3d btn-info btn-xs"
                                               data-toggle="modal"
                                               data-target="#myEdit<?= $type->material_type_id ?>"></a>
                                        </div>
                                        <!--                        --><?php //for($i=0; $i<$cutCheck[$lop-1]; $i++) { ?>
                                        <!--                            --><?php //if ($type->material_type_id == $cutCheck[$i]){
                                        //                                $idCheck = 1;
                                        //                             }
                                        //                        }?>
                                        <?php if ($idCheck == 0){ ?>
                                        <div class="col-md-2 col-xs-2">
                                            <a class="glyphicon glyphicon-trash btn btn-3d btn-danger btn-xs"
                                               data-toggle="modal"
                                               data-target="#myDel<?= $type->material_type_id ?>"></a>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php $count++;
                            } ?>
                            </tbody>
                        </table>
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
                    <div id="myAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="col-md-12">

                                    <!-- ------ -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading panel-heading-transparent">
                                            <strong>เพิ่มหมวดหมู่</strong>
                                        </div>

                                        <div class="panel-body">

                                            <?php $form1 = ActiveForm::begin(['action' => ['type/create'],]) ?>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <label>ลำดับ</label>
                                                        <input type="text" class="form-control" name="count"
                                                               value="<?= $count ?>" disabled>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <label>รหัสหมวดหมู่</label>
                                                        <input type="text" class="form-control" id="material_type_id"
                                                               name="material_type_id" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <label>ชื่อหมวดหมู่</label>
                                                        <input type="text" name="material_type_name" value=""
                                                               class="form-control required">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-2 col-sm-2 col-xs-12">
                                                    <input class="btn btn-success btn-small margin-top-30" type="submit"
                                                           value="บันทึก">
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-xs-12">
                                                    <a href="#" class="btn btn-danger  btn-small margin-top-30"
                                                       data-dismiss="modal">ยกเลิก</a>
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
                    <?php foreach ($mat_type as $type) { ?>
                        <div id="myDel<?= $type->material_type_id ?>" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="col-md-12">

                                        <!-- ------ -->
                                        <div class="panel panel-default" align="center">
                                            <div class="panel-heading panel-heading-transparent">
                                                <h4 class="modal-title" id="myModalLabel">คุณต้องการลบใช่หรือไม่</h4>
                                            </div>
                                            <div class="panel-body">
                                                <?php $form0 = ActiveForm::begin(['action' => ['type/deletetype'],]) ?>
                                                <div class="modal-body" align="center">
                                                    <input type="hidden" name="type_id[]"
                                                           value="<?= $type->material_type_id ?>">
                                                    <input class="btn btn-success btn-3d" type="submit" value="ยืนยัน">
                                                    <a href="#" class="btn btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                                                </div>
                                                <?php ActiveForm::end() ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /----- -->
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- ============================= modal delete ====================================-->

                    <!-- ============================= modal edit ====================================-->
                    <?php $count = 1; ?>
                    <?php foreach ($mat_type as $type) { ?>
                    <div id="myEdit<?= $type->material_type_id ?>" class="modal fade" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="col-md-12">

                                    <!-- ------ -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading panel-heading-transparent">
                                            <strong>แก้ไขหมวดหมู่</strong>
                                        </div>

                                        <div class="panel-body">
                                            <?php $form2 = ActiveForm::begin(['action' => ['type/updatetype'],]) ?>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <label>ลำดับ</label>
                                                        <input type="text" class="form-control" name="count"
                                                               value="<?= $count ?>" disabled>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <label>รหัสหมวดหมู่</label>
                                                        <input type="hidden" name="mat_id[]"
                                                               value="<?= $type->material_type_id ?>">
                                                        <input type="text" class="form-control" name="material_type_id"
                                                               value="<?= $type->material_type_id ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <label>ชื่อหมวดหมู่</label>
                                                        <input type="text" name="material_type_name[]"
                                                               value="<?= $type->material_type_name ?>"
                                                               class="form-control required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 col-sm-2 col-xs-12">
                                                    <input class="btn btn-success btn-small margin-top-30" type="submit"
                                                           value="บันทึก">
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-xs-12">
                                                    <a href="#" class="btn btn-danger  btn-small margin-top-30"
                                                       data-dismiss="modal">ยกเลิก</a>
                                                </div>
                                            </div>
                                            <?php ActiveForm::end() ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /----- -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $count++;
            } ?>
        </div>
        <!-- ============================= modal edit ====================================-->

