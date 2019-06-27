<?php
/* @var $stock \app\modules\materialsystem\models\MatsysStockMaterial */
?>

<!-- page title -->
<header id="page-header">
    <h1>ประวัติการรับเข้า</h1>
</header>

<div id="content" class="padding-20">



    <div id="panel-3" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong></strong> <!-- panel title -->
							</span>


        </div>

        <!-- panel content -->
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
                                    <a href="#search_page1" data-toggle="tab">ค้นหาจาก รหัส </a>
                                </li>
                                <li class=""><!-- TAB 2 -->
                                    <a href="#search_page2" data-toggle="tab">ค้นหาจาก วันที่</a>
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
                                            <?php foreach ($mat_stock as $stock) { ?>
                                            <option value="1"><?= $stock->stock_id ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-white">
                                        <i class="fa fa-search"> ค้นหา</i>
                                    </button>

                                </div><!-- /TAB 1 CONTENT -->

                                <div id="search_page2" class="tab-pane"><!-- TAB 1 CONTENT -->
                                    <div class="col-md-4 col-sm-4">
                                        <select style="width: 200px;">
                                            <option value=""selected disabled>เดือน</option>>
                                            <option value="1">มกราคม</option>
                                            <option value="2">กุมภาพันธ์</option>
                                            <option value="3">มีนาคม</option>
                                            <option value="">เมษายน</option>
                                            <option value="">พฤษภาคม</option>
                                            <option value="">มิถุนายน</option>
                                            <option value="">กรกฎาคม</option>
                                            <option value="">สิงหาคม</option>
                                            <option value="">กันยายน</option>
                                            <option value="">ตุลาคม</option>
                                            <option value="">พฤษจิกายน</option>
                                            <option value="">ธันวาคม</option>
                                        </select>
                                        <select style="width: 100px;">
                                            <option value=""selected disabled>ปี</option>>
                                            <option value="1">2560</option>
                                            <option value="2">2561</option>
                                            <option value="3">2562</option>
                                            <option value="">2563</option>
                                            <option value="">2564</option>
                                            <option value="">2565</option>
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

                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th width="5%">ลำดับ</th>
                                <th width="15%">วัน/เดือน/ปี</th>
                                <th width="20%">รหัสใบสั่งซื้อ</th>
                                <th>รายละเอียด</th>
                            </tr>
                            </thead>
                            <?php $count = 1 ?>
                            <?php foreach ($mat_stock as $stock) { ?>
                            <tbody>
                            <tr>
                                <td align="center"><?= $count ?></td>
                                <td><?= $stock->stock_date ?></td>
                                <td><?= $stock->stock_id ?></td>
                                <td><a data-toggle="modal" data-target="#myDetail<?= $stock->stock_id ?>">ดูรายละเอียด</a></td>
                            </tr>
                            </tbody>
                            <?php $count ++; } ?>
                        </table>

                    </div>
                    <!-- /panel content -->

                </div>
                <!-- /PANEL -->
            </div>



            <!-- =============================  edit modal ====================================-->
            <?php foreach ($mat_stock as $stock) { ?>
            <div id="myDetail<?= $stock->stock_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="row">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">รายการวัสดุ</h4>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <table class="table table-striped table-bordered table-hover" id="sample_3">
                                    <thead>
                                    <tr>
                                        <th width="3%">ลำดับ</th>
                                        <th width="3%">รหัสวัสดุ</th>
                                        <th width="30%">รายการ</th>
                                        <th width="10%">ราคา/บาท</th>
                                        <th width="9%">หน่วยนับ</th>
                                        <th width="8%">จำนวน</th>
                                    </tr>
                                    </thead>
                                    <?php $num = 1 ?>
                                    <tbody>
                                        <!-- data table -->
                                        <tr>
                                            <td><?= $num ?></td>
                                            <td>
                                                <div class="w3-container">
                                                    <!--<img src="<?/*= Yii::$app->homeUrl*/?>assets/images/<?/*= $stock->matsysMaterialHasStocks[0]->material_has_image */?>" width="80" height="80" onclick="document.getElementById('modal01<?/*= $stock->matsysMaterialHasStocks[0]->material_has_image */?>').style.display='block'">
                                                    <div id="modal01<?/*= $stock->matsysMaterialHasStocks[0]->material_has_image */?>" class="modal" onclick="this.style.display='none'">
                                                        <div class="w3-modal-content w3-animate-zoom" align="center">
                                                            <img src="<?/*= Yii::$app->homeUrl*/?>assets/images/<?/*= $stock->matsysMaterialHasStocks[0]->material_has_image */?>" style="width:40%">
                                                        </div>
                                                    </div>-->
                                                    <div align="center">
                                                        <label align="center"><?= $stock->matsysMaterialHasStocks[0]->material_id ?></label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <label>ชื่อวัสดุ : <?= $stock->materials[0]->material_name ?><br><br>
                                                    หมวดหมู่ : <?= $stock->materials[0]->materialType->material_type_name ?> <br>
                                                </label>
                                            </td>
                                            <td><label><?= $stock->matsysMaterialHasStocks[0]->material_has_price_per_unit ?></label></td>
                                            <td><label><?= $stock->matsysMaterialHasStocks[0]->material_has_name_price_per_unit ?></label></td>
                                            <td><?= $stock->matsysMaterialHasStocks[0]->material_has_amount ?></td>
                                        </tr>
                                        <!-- data table -->
                                    </tbody>
                                    <?php $num ++; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- ============================= edit modal ====================================-->