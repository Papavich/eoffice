<?php
/* @var $item \app\modules\materialsystem\models\MatsysMaterial */
/* @var $type \app\modules\materialsystem\models\MatsysMaterialType  */ //$type เป็น model MaterialType
/* @var $stock \app\modules\materialsystem\models\MatsysMaterialHasStock */
?>
    <div id="content" class="dashboard padding-20">
        <header id="page-header">
            <h1>ระบบเบิกวัสดุ</h1>
        </header>
        <div id="panel-2" class="panel panel-default cs-remargin" style="margin-top: 20px">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#select1">ค้นหาวัสดุ</a></li>
                    <li><a data-toggle="tab" href="#select2">ค้นหาตามหมวดหมู่</a></li>
                </ul>
                <div class="row cs-main">
                    <div class="tab-content">
                        <!-- Page 1 -->
                        <div id="select1" class="tab-pane fade in active">
                            <div class="col-lg-5 col-md-5">
                                <label>ชื่อวัสดุ</label>
                                <select class="form-control select2">
                                    <option value="">ค้นหาวัสดุ</option>
                                    <option value="1">กระดาษ A4</option>
                                    <option value="2">ปากกา</option>
                                    <option value="3">ดินสอ</option>
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-5">
                                <label>จำนวน(*)</label>
                                <input type="number" value="0" min="0" max="1000" class="form-control">
                            </div>
                        </div>
                        <!-- End Page1 -->
                        <!-- Page 2 -->
                        <div id="select2" class="tab-pane fade">
                            <div class="col-lg-3">
                                <label>หมวดหมู่</label>
                                <select class="select2" style="width: 100%">
                                    <option value="">กระดาษ</option>
                                    <option value="1">เครื่องเขียน</option>
                                    <option value="2">เครื่องใช้ไฟฟ้า</option>
                                    <option value="3">อุปกรณ์อิเล็กทรอนิกส์</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-5">
                                <label>ชื่อวัสดุ</label>
                                <select class="select2" style="width: 100%">
                                    <option value="">ค้นหาวัสดุ</option>
                                    <option value="1">กระดาษ A4</option>
                                    <option value="2">ปากกา</option>
                                    <option value="3">ดินสอ</option>
                                </select>
                            </div>
                            <div class="col-lg-1">
                                <label>จำนวน(*)</label>
                                <input type="number" value="0" min="0" max="1000" class="form-control">
                            </div>
                        </div>
                        <!-- End Page2 -->
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>รายละเอียดกดารนำไปใช้(*)</label>
                                <select id="detail" style="width: 100%">
                                    <option value="0">รายละเอียด</option>
                                    <option value="1">วิชาเรียน</option>
                                    <option value="2">โครงการ</option>
                                    <option value="3">กิจกรรม</option>
                                    <option value="4">อื่น</option>
                                </select>
                            </div>
                            <div class="col-lg-12" style="display: none" id="boxdetail" name="1">
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-4">
                                        <label>รหัสวิชา</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-8">
                                        <label>ชื่อวิชา</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>รายละเอียด</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="display: none" id="boxdetail" id="boxdetail" name="2">
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-4">
                                        <label>รหัสโครงการ</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-8">
                                        <label>ชื่อโครงการ</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>รายละเอียด</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="display: none" id="boxdetail" id="boxdetail" name="3">
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-12">
                                        <label>ชื่อกิจกรรม</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label>รายละเอียด</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="display: none" id="boxdetail" id="boxdetail" name="4">
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-12">
                                        <label>รายละเอียด</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-info glyphicon glyphicon-plus cs-main-btn">
                            เพิ่มรายการ
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="nav nav-tabs"></div>
        <div id="panel-1" class="panel panel-default ">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>รายการใบเบิก</strong> <!-- panel title -->
                    <small class="size-12 weight-300 text-mutted hidden-xs">2015</small>
                </span>
                <!-- right options -->
                <ul class="options pull-right list-inline">
                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                           data-placement="bottom"></a></li>
                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                           data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                </ul>
                <!-- /right options -->
            </div>
            <!-- panel content -->
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <th class="col-lg-1">ลำดับ</th>
                        <th class="col-lg-1">รหัสวัสดุ</th>
                        <th class="col-lg-2">รูปภาพ</th>
                        <th class="col-lg-2">รายการ</th>
                        <th class="col-lg-1">หน่วยนับ</th>
                        <th class="col-lg-1">จำนวน</th>
                        <th class="col-lg-1">ราคาต่อหน่วย</th>
                        <th class="col-lg-1">ราคารวม</th>
                        <th class="col-lg-1"></th>
                    </tr>
                    <?php
                    $count = 1;
                    $total = 0;
                    foreach ($model as $item){
                        ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= $item->material_id ?></td>
                            <td><img src="<?= Yii::getAlias('@web') ?>/assets/cs-image/blank_image.png" class="cs-image-table"></td>
                            <td><?= $item->material_name ?></td>
                            <td><?php foreach ($mat_type as $type) {
                                if($type->material_type_id === $item->material_id){
                                    echo $type->material_type_name;
                                }
                                }?></td>
                            <td><input type="number" value="0" min="0" max="<?= $item->matsysMaterialHasStocks[0]->material_has_amount_use ?>" class="cs-amount-table">/<?= $item->matsysMaterialHasStocks[0]->material_has_amount_use ?></td>
                            <td><?php foreach ($mat_stock as $stock){
                                if ($stock->material_id === $item->material_id) {
                                    echo $stock->material_has_price_per_unit;
                                }
                                } ?> บาท</td>
                            <td><?= $item->matsysMaterialHasStocks[0]->material_has_amount_use * $item->material_amount_check ?></td>
                            <?php $total += $item->matsysMaterialHasStocks[0]->material_has_amount_use * $item->material_amount_check; ?>
                            <td>
                                <div align="center">
                                    <button type="button"
                                            class="btn btn-danger btn-sm glyphicon glyphicon-trash"></button>
                                </div>
                            </td>
                        </tr>
                    <?php $count++; } ?>

                </table>
                <table class="table cs-remargin">
                    <tr>
                        <th class="col-lg-9">รายการทั้งหมด <?= $count-1 ?> รายการ</th>
                        <th class="col-lg-3">
                            <div align="right">รวมเป็นเงิน <?= $total ?> บาท</div>
                        </th>
                    </tr>
                </table>
            </div>
            <!-- /panel content -->
        </div>
        <div class="pull-right cs-footer">
            <button type="button" class="btn btn-success">ยืนยันรายการ</button>
            <button type="button" class="btn btn-danger">ยกเลิกการทำรายการ</button>
        </div>
    </div>
</section>
<!-- /MIDDLE -->
