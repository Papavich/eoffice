<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\eoffice_materialsys\models\MatsysMaterial;


//CSS Page
$this->registerCssFile('@mat_assets/material/css/material.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
//Script Page
$this->registerJsFile('@mat_assets/material/js/script.js', ['depends' => [yii\web\JqueryAsset::className()]]);


// Select2 Plugin
$this->registerCssFile('@mat_components/select2/css/select2.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@mat_components/select2/js/select2.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


//DropzoneJS
$this->registerJsFile('@web/plugins/dropzone/dropzone.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//DropzoneJS Css
$this->registerCssFile('@web/plugins/dropzone/css/dropzone.css', ['depends' => [\app\modules\eoffice_materialsys\assets\AssetTheme::className()]]);
//DropzoneJS Config my dropzone
$this->registerJsFile('@mat_assets/material/js/dropzone-config.js', ['depends' => [yii\web\JqueryAsset::className()]]);


$this->title = 'Matsys Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matsys-material-index">
    <!-- Head -->
    <header id="page-header" style="margin-bottom: 20px">
        <h1>จัดการวัสดุ</h1>
        <ol class="breadcrumb">
            <li><a href="#">จัดการวัสดุ</a></li>
        </ol>
    </header>

    <!-- cake -->
    <div id="panel-3" class="panel panel-default ">
        <div class="panel-heading">
                <span class="">
                    <strong>วัสดุใกล้หมด</strong> <!-- panel title -->
                </span>
            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Colapse"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a></li>
            </ul>
            <!-- /right options -->
        </div>
        <!-- panel content -->
        <div class="panel-body" style="">
            <div class="row">
                <?php foreach ($material_alert as $key_alert => $value_alert){ ?>
                <div class="col-md-2">
                    <div class="thumbnail">
                        <img src="<?= Yii::$app->homeUrl . "web_mat/images/" . $value_alert->material_image ?>" alt="...">
                        <div class="caption">
                            <h5 style="margin: 0"><a href="<?= Yii::$app->homeUrl . Yii::$app->controller->module->id . "/material/view?id=" . $value_alert->material_id ?>"><?= $value_alert->material_name ?></a></h5>
                            <p style="margin: 0"><b>คงเหลือ : </b> <?= MatsysMaterial::amountAll($value_alert->material_id) ?> <?= $value_alert->material_unit_name ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- /panel content -->
    </div>
    <!-- Main Contain -->
    <div class="panel panel-default ">
        <div class="panel-heading topic-import-auto panel-heading-height" style="height: 75px !important;">
        <span class="title elipsis">
            <i class="fa fa-stack-overflow fa-2x" aria-hidden="true"></i>  <strong
                    class="topic-import">วัสดุทั้งหมด</strong> <!-- panel title -->
        </span>
            <!-- Button Create material to Session -->
            <button type="button" id="addmat" class="btn btn-success btn-sm pull-right" data-toggle="modal"
                    data-target="#createMaterial">สร้างวัสดุใหม่
            </button>
            <div class="pull-right head-box">
                <label>เรียงตาม : </label>
                <select name="sort" onchange="location = this.value;">
                    <?php $params = Yii::$app->request->queryParams; ?>
                    <option value="listmaterial?<?php if (isset($params['view'])) {
                        echo "view=block&";
                    } ?>sort=material_name" <?php if (isset($params['sort'])) {
                        if ($params['sort'] == 'material_name') {
                            echo "selected";
                        }
                    } ?>>เรียงตามชื่อ
                    </option>
                    <option value="listmaterial?<?php if (isset($params['view'])) {
                        echo "view=block&";
                    } ?>sort=order_count" <?php if (isset($params['sort'])) {
                        if ($params['sort'] == 'material_order_count') {
                            echo "selected";
                        }
                    } ?>>เรียงตามวัสดุที่นิยมใช้บ่อย
                    </option>
                </select>
<!--                ผลลัพธ์ : <a href="listmaterial"><i-->
<!--                            class="fa fa-th-list fa-2x vertical --><?php //if (!isset($params['view'])) {
//                                echo "active-list";
//                            } ?><!--" aria-hidden="true"></i></a>-->
<!--                <a href="listmaterial?view=block"><i-->
<!--                            class="fa fa-th-large fa-2x vertical --><?php //if (isset($params['view'])) {
//                                echo "active-list";
//                            } ?><!--" aria-hidden="true"></i></a>-->
            </div>
        </div>
        <!-- Panel content -->
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 pull-right margin-bottom-10">
                    <form style="margin: 0;">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" name="search" id="searchMaterial" class="form-control input-lg"
                                       placeholder="ค้นหาวัสดุ"/>
                                <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <?php
            if (isset($params['view'])) {
                echo "<div class=\"row\">";
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_item',
                    'viewParams' => [
                        'fullView' => true,
                        'context' => 'main-page',
                        // ...
                    ],
                ]);
                echo "</div>";
            } else {


                echo GridView::widget(['dataProvider' => $dataProvider,
                    'columns' => [['class' => 'yii\grid\SerialColumn'],
                        [ //Image
                            'label' => "<div>รูปวัสดุ<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                            'encodeLabel' => false,
                            'attribute' => 'material_name',
                            'format' => 'html',
                            'headerOptions' => [
                                'class' => 'col-md-3',
                            ],
                            'value' => function ($dataProvider, $key, $index, $column) {
                                $img = "<div class='image-center'><img class='image' src='" . Yii::$app->homeUrl . "web_mat/images/" . $dataProvider->material_image . "' alt=''></div>'";
                                return $img;
                            }
                        ],
                        [ // Name && Detail
                            'label' => "<div>วัสดุ<i class='fa fa-sort pull-right' aria-hidden='true'></i></div>",
                            'encodeLabel' => false,
                            'attribute' => 'material_name',
                            'format' => 'html',
                            'headerOptions' => [
                                'class' => 'col-md-5',
                            ],
                            'value' => function ($dataProvider, $modelMateril) {
                                $detail = "<div class='text-tbody'>";
                                $detail .= "<div ><b>ชื่อวัสดุ </b>: " . $dataProvider->material_name . "</div>";
                                $detail .= "<div><b>รหัสวัสดุ </b>: " . $dataProvider->material_id . "</div>";
                                $detail .= "<div><b>รายละเอียด </b>: " . $dataProvider->material_detail . "</div>";
                                $detail .= "<div><b>จำนวนเมื่อแจ้งเตือน </b>: " . $dataProvider->material_amount_check . "</div>";
                                $detail .= "<div><b>จำนวนคงเหลือ </b>: " . MatsysMaterial::amountAll($dataProvider->material_id) . " " . $dataProvider->material_unit_name . "</div></div>";
                                return $detail;
                            }

                        ],
                        [ // Location
                            'label' => '<div>สถานที่จัดเก็บ<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                            'attribute' => 'location_id',
                            'encodeLabel' => false,
                            'format' => 'html',
                            'headerOptions' => [
                                'class' => 'col-md-2',
                            ],
                            'value' => function ($dataProvider, $key, $index, $column) {
                                $detail = "<div><b>สถานที่จัดเก็บ : </b></div><div>" . $dataProvider->location->location_name . "</div>";
                                return $detail;
                            }
                        ],
                        [ // Type
                            'label' => '<div>ประเภทวัสดุ<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                            'attribute' => 'material_type_id',
                            'encodeLabel' => false,
                            'format' => 'html',
                            'headerOptions' => [
                                'class' => 'col-md-2',
                            ],
                            'value' => function ($dataProvider, $key, $index, $column) {
                                $detail = "<div><b>ประเภทวัสดุ : </b></div><div>" . $dataProvider->materialType->material_type_name . "</div>";
                                return $detail;
                            }
                        ],
                        [ // Image
                            'label' => '',
                            'encodeLabel' => false,
                            'format' => 'raw',
                            'headerOptions' => [
                                'class' => 'col-md-2',
                            ],
                            'value' => function ($dataProvider, $key, $index, $column) {
                                $action = "<div class='action-material'><div class='action-btn'><div><a class='btn btn-sm btn-default btn-full margin-top-3' href='" . Yii::$app->homeUrl . Yii::$app->controller->module->id . "/material/update?id=" . $dataProvider->material_id . "'><span class=\"glyphicon glyphicon-pencil\"></span> แก้ไข</a></div>";
                                $action .= "<div><a class='btn btn-sm btn-default btn-full margin-top-3' href='" . Yii::$app->homeUrl . Yii::$app->controller->module->id . "/material/view?id=" . $dataProvider->material_id . "'><span class=\"glyphicon glyphicon-eye-open\"></span> รายละเอียด</a></div>";
                                $action .= "<div><a name='btn-delete' data-id='".$dataProvider->material_id."' class='btn btn-sm btn-danger btn-full margin-top-3'><span class=\"glyphicon glyphicon-trash\"></span> ลบ</a></div></div></div>";
                                return $action;
                            }
                        ],
                        // 'material_id',
                        // 'material_name',
                        // 'material_detail',
                        // 'material_amount_check',
                        // 'material_order_count',
                        // 'material_unit_name',
                        // 'material_image',
                        // 'location_id',
                        // 'material_type_id',

                    ],
                ]);
            } ?>

        </div>
    </div>
</div>
<!-- Modal Preview -->
<div class="modal fade bs-example-modal-lg" id="createMaterial" role="dialog">
    <div class="modal-dialog modal-lg modal-preview" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title"><i class="fa fa-list-alt" style="vertical-align: middle" aria-hidden="true"></i>
                    เพิ่มวัสดุชนิดใหม่</h3>
            </div>
            <div id="preview-content" class="modal-body">
                <!-- Preview Content -->
                <div class="row padding-top-10 margin-right-10 margin-left-10">
                    <?php $form = ActiveForm::begin([
                        'id' => 'detail-material',
                        'action' => null,
                        'options' => [
                        ]
                    ]);
                    ?>
                    <?= $form->field($modelMateril, 'material_id', [
                        'options' => [
                            'class' => 'form-group col-md-3'
                        ]])
                        ->textInput(
                            [
                                'class' => 'form-control',
                            ]
                        )
                    ?>
                    <?= $form->field($modelMateril, 'material_name', [
                        'options' => [
                            'class' => 'form-group col-md-4'
                        ]])
                        ->textInput(
                            [
                                'class' => 'form-control',
                            ]
                        )
                    ?>
                    <?= $form->field($modelMateril, 'material_amount_check', [
                        'options' => [
                            'class' => 'form-group col-md-3'
                        ]])
                        ->textInput(
                            [
                                'type' => 'number',
                                'class' => 'form-control',
                            ]
                        )
                    ?>
                    <?= $form->field($modelMateril, 'material_unit_name', [
                        'options' => [
                            'class' => 'form-group col-md-2'
                        ]])
                        ->textInput(
                            [
                                'class' => 'form-control',
                            ]
                        )
                    ?>
                    <?= $form->field($modelMateril, 'material_detail', [
                        'options' => [
                            'class' => 'form-group col-md-12'
                        ]])->textarea(['rows' => '3']) ?>
                    <div class="form-group col-md-6">
                        <label>สถานที่จัดเก็บ</label>
                        <!--  ,'id'=>'search-company'-->
                        <?= \yii\helpers\Html::activeDropDownList($modelMateril, 'location_id', $modelLocation, ['class' => 'form-control select2']) ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label>ประเภทวัสดุ</label>
                        <!--  ,'id'=>'search-company'-->
                        <?= \yii\helpers\Html::activeDropDownList($modelMateril, 'material_type_id', $modelType, ['class' => 'form-control select2']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                    <div class="form-group col-md-12 margin-top-10">
                        <label>อัพโหลดรูปภาพ : </label>
                        <?php $form = ActiveForm::begin([
                            'action' => 'upfile',
                            'id' => 'myDropzone',
                            'options' => [
                                'class' => 'dropzone ef-dropzone-size',
                            ],
                        ]) ?>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">ยกเลิก</button>
                <button id="submit-database" type="button" class="btn btn-success btn-sm">ยืนยันการเพิ่มวัสดุ</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error Update-->
<div class="modal fade" id="ErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">เกิดข้อผิดพลาด
                    <small>ไฟล์[<i id="filename"></i>]</small>
                </h4>
            </div>
            <div class="modal-body modal-center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"></i><b>รูปแบบไฟล์ไม่รองรับ</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error Size-->
<div class="modal fade" id="ErrorModalSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">เกิดข้อผิดพลาด
                    <small>ไฟล์[<i id="filenamesize"></i>]</small>
                </h4>
            </div>
            <div class="modal-body modal-center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"></i><b>ไฟล์มีขนาดใหญ่เกิน</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error MaxFile -->
<div class="modal fade" id="ErrorModalmaxFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">เกิดข้อผิดพลาด
                </h4>
            </div>
            <div class="modal-body modal-center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"></i><b>ไม่สามารถอัพไฟล์เกิน 1
                    ไฟล์</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error Delete -->
<div class="modal fade" id="ErrorModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">ไม่สามารถลบวัสดุได้
                </h4>
            </div>
            <div class="modal-body modal-center" style="font-size: 20px;padding: 30px 0;text-align: center">
                <i class="glyphicon glyphicon-warning-sign"></i><b> วัสดุถูกใช้งานหรือถูกอ้างอิง</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Success Delete -->
<div class="modal fade" id="ConfirmModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">ยืนยันการลบวัสดุ</h4>
            </div>
            <div class="modal-body modal-center" style="font-size: 20px;padding: 30px 0;text-align: center">
                <a href="#" class="btn btn-danger" name="confirm-delete" data-dismiss="modal">ยืนยัน</a>
                <a href="#" class="btn btn-default" data-dismiss="modal">ยกเลิก</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal Success Delete -->
<div class="modal fade" id="SuccessModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">สถานะ
                </h4>
            </div>
            <div class="modal-body modal-center" style="font-size: 20px;padding: 30px 0;text-align: center">
                <b>ลบรายการสำเร็จ</b>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error repeatedly -->
<div class="modal fade" id="ModalErrorrepeatedly" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="margin-top: 150px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">สถานะการแจ้งเตือน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"
                   style="vertical-align: middle;padding-right: 10px;color: #b8ad5c"></i>
                <b style="font-size: 20px">ไม่สามารถเพิ่มวัสดุได้ เนื่องจากมีรหัสวัสดุนี้อยู่แล้ว</b>
            </div>
        </div>
    </div>
</div>
