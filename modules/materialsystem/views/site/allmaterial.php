
<?php
/* @var $item \app\modules\materialsystem\models\MatsysMaterial */  //ไว้บอกว่า $item เป็น model ไหน
use yii\widgets\LinkPager;

/* @var $type \app\modules\materialsystem\models\MatsysMaterialType  */ //$type เป็น model MaterialType
/* @var $stock \app\modules\materialsystem\models\MatsysBillDetail */ //$stock เป็น model MatsysBillDetail
/* @var $detail \app\modules\materialsystem\models\MatsysDetail */
/* @var $order_detail \app\modules\materialsystem\models\MatsysOrderDetail */
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
                                <h4 class=""><b><?= $item->material_name ?></b></h4>
                                <img src="/cs-e-office/web/web_mat/images/<?= $item->material_image ?>"
                                     width="80" height="80">
                            </label>

                        <form action="/cs-e-office/web/materialsystem/item/addcart" method="post">


                            <?php
                            $amount=0;
                            foreach ($item->matsysBillDetails
                            as $stock) {
                                $amount+=$stock->bill_detail_use_amount;
                                ?>



                              <?php  } ?>
                            <label><br/>จำนวนที่ต้องการเบิก :<input type="number" name="mat_amount" class="form-control"
                                                                    value="" min="1"
                                                                    max="<?= $item->matsysBillDetails[0]->bill_detail_use_amount ?>"
                                                                    style="width: 100px" required>

                                จากทั้งหมด <?= $amount;?>
                            <?php foreach ($mat_type as $type) {
                                if ($type->material_type_id === $item->material_type_id) { ?>
                                    <?= $item->material_unit_name ?>

                                    <br/>
                                        <a class="btn btn-info btn-3d" data-toggle="modal"
                                           data-target="#myDetail<?= $item->material_id ?>">ข้อมูลวัสดุ
                                        </a>
                                        <button type="button" name="" class="btn btn-success btn-3d" data-toggle="modal" data-target="#myCart<?= $item->material_id ?>">เบิกวัสดุ</button>
<!--                                    <button type="submit" name="" class="btn btn-success btn-3d">เบิกวัสดุ</button> -->
                                        <input type="hidden" name="mat_id" value="<?= $item->material_id ?>">
                                    </div>
                        <!--<img src="<? Yii::$app->getModule('materialsystem')->basePath;  ?>/images/paper.png" alt="..." class="">* -->
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
                            <div class="modal-header" align="center">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">ท่านต้องการเลือกวัสดุรายการนี้ใช่หรือไม่</h4>
                            </div>
                            <!-- Modal Body -->

                                    <input type="hidden" name="mat_per_unit" value="<?= $item->matsysBillDetails[0]->bill_detail_price_per_unit ?>"/>
                                    <input type="hidden" name="mat_pic" value="<?= $item->material_image ?>"/> <!--ส่งรูปไปกับ session -->
                                    <input type="hidden" name="mat_name_unit" value="<?= $item->material_unit_name ?>"/> <!--ส่งหน่วยนับไปกับ session -->
                                    <input type="hidden" name="mat_name" value="<?= $item->material_name ?>"/>
                                    <input type="hidden" name="mat_detail" value="<?= $item->material_detail ?>"/>
                                    <input type="hidden" name="mat_price"
                                           value="<?= $item->matsysBillDetails[0]->bill_detail_price_per_unit ?>"/>
                            <div class="padding-20" align="center" id="sub_detail">
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
                                    <img src="/cs-e-office/web/web_mat/images/<?= $item->material_image ?>"
                                         width="250" height="250">

                                    <p>รหัสวัสดุ : <?= $item->material_id ?> </p>
                                    <p>ชื่อวัสดุ : <?= $item->material_name ?></p>
                                    <p>รายละเอียด : <?= $item->material_detail ?></p>
                                    </p>
                                </div>
                                <?php } ?>
                                <?php }$count++; ?>
                        </div>
                    </div>
                </div>
                <!-- ============================= modal ====================================-->
                </form>
            <?php } ?>
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

    </div>
</div>
</div>