<?php
Yii::getAlias('@mat_assets');
$this->registerJsFile('@mat_assets/select_material.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<header id="page-header">
    <h1>เพิ่มจำนวนวัสดุ</h1>
    <ol class="breadcrumb pull-right">
        <li data-toggle="tooltip" data-placement="bottom" title="เพิ่มวัสดุชนิดใหม่"><a class="btn btn-success ">
                <div class="glyphicon glyphicon-plus"></div>
            </a></li>
    </ol>
</header>
<div id="content" class="dashboard padding-20">
    <div class="panel panel-default cs-remargin">
        <div class="panel-body">

            <ul class="nav nav-tabs">
                <li class="active "><a data-toggle="tab" href="#select1">ค้นหาวัสดุ</a></li>
                <li><a data-toggle="tab" href="#select2">ค้นหาตามหมวดหมู่</a></li>

            </ul>
            <form style="margin: 0">
                <div class="row cs-main">
                    <div class="tab-content">
                        <!-- Page 1 -->
                        <div id="select1" class="tab-pane fade in active">
                            <div class="col-md-10">
                                <label>ชื่อวัสดุ</label>
                                <select class="select2" id="material" style="width: 100%">
                                    <option value="69">ค้นหาวัสดุ</option>
                                    <option value="9">ปากกา</option>
                                    <option value="10">กระดาษ A4</option>
                                    <option value="11">ดินสอ</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Page1 -->
                        <!-- Page 2 -->
                        <div id="select2" class="tab-pane fade">
                            <div class="col-lg-4 col-md-4">
                                <label>หมวดหมู่</label>
                                <select class="select2" style="width: 100%">
                                    <option value="">กระดาษ</option>
                                    <option value="1">เครื่องเขียน</option>
                                    <option value="2">เครื่องใช้ไฟฟ้า</option>
                                    <option value="3">อุปกรณ์อิเล็กทรอนิกส์</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label>ชื่อวัสดุ</label>
                                <select class="select2" id="material2" style="width: 100%">
                                    <option value="69">ค้นหาวัสดุ</option>
                                    <option value="9">ปากกา</option>
                                    <option value="10">กระดาษ A4</option>
                                    <option value="11">ดินสอ</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Page2 -->
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <button type="button" name="btn-select-material" class="btn btn-info cs-main-btn" style="width: 100%">
                            <div class="glyphicon glyphicon-plus">เลือก</div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="ajax_insert"></div>

    <?php
//    Example use model

//    foreach ($model as $row){
////        print_r($row);
//        echo $row['material_name'];
//        echo "->";
//        echo $row['location']['location_name'];
//        echo "->";
//        echo $row['matrerialType']['matrerial_type_name'];
//        echo "<br>";
//    }
//        echo $this->render('_material_obj',['material_model' => $result_model])
    ?>

</div>