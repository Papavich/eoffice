
<?php
/* @var $item \app\modules\materialsystem\models\MatsysMaterial */  //ไว้บอกว่า $item เป็น model ไหน
/* @var $type \app\modules\materialsystem\models\MatsysMaterialType  */ //$type เป็น model MaterialType
/* @var $stock \app\modules\materialsystem\models\MatsysMaterialHasStock */ //$stock เป็น model MatsysMaterialHasStock
/* @var $detail \app\modules\materialsystem\models\MatsysDetail */
?>

<div id="panel-2" class="panel panel-default cs-remargin">
    <div class="panel-heading">
                <span class="title elipsis">
                    <strong>วัสดุทั้งหมด</strong> <!-- panel title -->
                    <small class="size-12 weight-300 text-mutted hidden-xs">8</small>
                </span>
        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a>
            </li>
            <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                   data-placement="bottom"><i class="fa fa-expand"></i></a></li>
        </ul>
        <!-- /right options -->
    </div>
    <div class="panel-body">
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
                                <a href="#search_page1" data-toggle="tab">ค้นหาจากชื่อ หรือรหัส </a>
                            </li>
                            <li class=""><!-- TAB 2 -->
                                <a href="#search_page2" data-toggle="tab">ค้นหาตามหมวดหมู่</a>
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
                                    <select class="form-control select2" style="width: 230px;">                                    <option value=""></option>>
                                        <option value="1">ปากกา</option>
                                        <option value="2">กระดาษ A4</option>
                                        <option value="3">ลวดเย็บกระดาษ</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-white">
                                    <i class="fa fa-search"> ค้นหา</i>
                                </button>

                            </div><!-- /TAB 1 CONTENT -->

                            <div id="search_page2" class="tab-pane"><!-- TAB 1 CONTENT -->
                                <div class="col-md-3 col-sm-3">
                                    <select class="form-control select2" style="width: 230px;">
                                        <option value=""></option>>
                                        <option value="1">วัสดุใช้สอย</option>
                                        <option value="2">วัสดุสำนักงาน</option>
                                        <option value="3">วัสดุคงทนถาวร</option>
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
                    <?php $count = 1;
                    foreach ($model as $item) { ?>
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <!-- Place the anchor tag here to cover both your caption and image -->
                                <div class="caption">
                                    <div align="center">
                                    <!-- เก็บค่า id ไว้เพื่อส่งเข้า modal -->
                                    <label>
                                        <h2 class=""><?= $item->material_name ?></h2>
                                        <img src="/cs-e-office/web/web_mat/images/<?= $item->matsysMaterialHasStocks[0]->material_has_image ?>"
                                             width="80" height="80">
                                    </label>

                                <form action="/cs-e-office/web/materialsystem/item/addcart" method="post">


                                    <?php foreach ($mat_stock
                                    as $stock) {
                                    if ($item->material_id === $stock->material_id) { ?>


                                    <label><br/>จำนวนที่ต้องการเบิก :<input type="number" name="mat_amount" class="form-control"
                                                                    value="" min="1"
                                                                    max="<?= $item->matsysMaterialHasStocks[0]->material_has_amount_use ?>"
                                                                    style="width: 100px" required>

                                        จากทั้งหมด <?= $stock->material_has_amount_use;
                                        } ?>
                                        <?php } ?>
                                    <?php foreach ($mat_type as $type) {
                                        if ($type->material_type_id === $item->material_type_id) { ?>
                                            <?= $item->matsysMaterialHasStocks[0]->material_has_name_price_per_unit ?>

                                            <br/>
                                                <a class="btn btn-info btn-3d" data-toggle="modal"
                                                   data-target="#myDetail<?= $item->material_id ?>">ข้อมูลวัสดุ
                                                </a>
                                                <button type="button" name="" class="btn btn-success btn-3d" data-toggle="modal" data-target="#myCart<?= $item->material_id ?>">เบิกวัสดุ</button>
        <!--                                    <button type="submit" name="" class="btn btn-success btn-3d">เบิกวัสดุ</button> -->
                                            </div>
                                <!--<img src="<? /*= Yii::$app->getModule('materialsystem')->basePath; */ ?>/images/paper.png" alt="..." class="">-->
                                <!-- Anchor tag ends covering both image and caption -->
                                </div>
                            </div>
                        </div>

                        <!-- ================================== modal ========================================== -->
                        <div id="myCart<?= $item->material_id ?>" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">กรอกรายละเอียดการนำวัสดุไปใช้งาน</h4>
                                    </div>
                                    <!-- Modal Body -->
                                    <div class="padding-20">
                                        <select name="list_detail" id="list_detail" style="width: 100%">
                                            <option value="null" selected disabled>เลือกรายละเอียด</option>
                                            <?php foreach ($mat_detail as $detail) { ?>
                                                <option value="<?= $detail->detail_id ?>"><?= $detail->detail_name?></option>
                                            <?php } ?>
                                                <input type="hidden" name="select_detail" value="<?= $detail->detail_name?>">
                                        </select>
                                    </div>

                                    <div class="padding-20">
                                        <input type="text" class="form-control" name="detail_text" value="">
                                    </div>
                                    <div class="padding-20" align="center">
                                        <input type="submit" class="btn btn-success btn-3d" value="ยืนยัน">
                                        <a href="#" class="btn btn-small btn-danger btn-3d" data-dismiss="modal">ยกเลิก</a>
                                    </div>
                                    <!-- Modal Body -->
                                </div>
                            </div>
                        </div>
                        <!-- ================================== modal ========================================== -->

                        <!-- ============================= modal ====================================-->
                        <div id="myDetail<?= $item->material_id ?>" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">ข้อมูลวัสดุ</h4>
                                    </div>

                                    <!-- Modal Body -->

                                        <input type="hidden" name="mat_id" value="<?= $item->material_id ?>"/>
                                        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
                                        <div class="modal-body" align="center">
                                            <img src="/cs-e-office/web/web_mat/images/<?= $item->matsysMaterialHasStocks[0]->material_has_image ?>"
                                                 width="250" height="250">
                                            <input type="hidden" name="mat_per_unit" value="<?= $item->matsysMaterialHasStocks[0]->material_has_price_per_unit ?>">
                                            <input type="hidden" name="mat_pic" value="<?= $item->matsysMaterialHasStocks[0]->material_has_image ?>"/> <!--ส่งรูปไปกับ session -->
                                            <input type="hidden" name="mat_name_unit" value="<?= $item->matsysMaterialHasStocks[0]->material_has_name_price_per_unit ?>"/> <!--ส่งหน่วยนับไปกับ session -->
                                            <p>รหัสวัสดุ : <?= $item->material_id ?> </p>
                                            <p>ชื่อวัสดุ : <?= $item->material_name ?></p>
                                            <input type="hidden" name="mat_name" value="<?= $item->material_name ?>"/>
                                            <p>รายละเอียด : <?= $item->material_detail ?></p>
                                            <input type="hidden" name="mat_detail" value="<?= $item->material_detail ?>"/>
                                            <input type="hidden" name="mat_price"
                                                   value="<?= $item->matsysMaterialHasStocks[0]->material_has_amount_use ?>"/>
                                            </p>
                                        </div>
                                        <?php } ?>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- ============================= modal ====================================-->
                        </form>
                    <?php } ?>
                </div>
                <nav class="pull-right" style="padding-right: 30px">
                    <ul class="pagination">
                        <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">3 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">4 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">5 <span class="sr-only">(current)</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">วัสดุ</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <img src="/cs-e-office/web/images/noavatar.jpg" class="cs-image-table">
                        </div>
                        <div class="col-lg-7">
                            <div><b>ชื่อวัสดุ :</b><span>ปากกา</span></div>
                            <div><b>รายละเอียด :</b><span>ปากกาสีแดง</span></div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <label>จำนวน(*)</label>
                                    <br>
                                    <input type="number" value="0" min="0" max="1000"
                                           class="form-control cs-edit-formcontrol-online"><span>/100</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <br>
                            <label>หมายเหตุ(*)</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info">เบิกวัสดุ</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
