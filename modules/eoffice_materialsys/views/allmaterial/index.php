<?php

use yii\grid\GridView;
use app\modules\eoffice_materialsys\models\MatsysMaterial;
use app\modules\eoffice_materialsys\models\MatsysOrder;

//CSS Page
$this->registerCssFile('@mat_assets/allmaterial/css/allmaterial.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
//JS Page
$this->registerJsFile('@mat_assets/allmaterial/js/script-index.js', ['depends' => [yii\web\JqueryAsset::className()]]);


$id = Yii::$app->user->identity->getId();
if (MatsysOrder::searchConfirmbill($id) != 'false') {
    $bill = MatsysOrder::searchConfirmbill($id);
    $bill_id = $bill->order_id;
    ?>
    <script type="text/javascript">
        var order_id = "<?= $bill_id ?>";
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        var order_id = "";
    </script>
    <?php
}
?>

<!-- Main Contain -->
<div class="panel panel-default ">
    <div class="panel-heading topic-import-auto panel-heading-height" style="height: 75px !important;">
        <form style="margin: 0;width: 100%">
        <span class="title elipsis">
            <i class="fa fa-stack-overflow fa-2x" aria-hidden="true"></i>  <strong
                    class="topic-import">วัสดุทั้งหมด</strong> <!-- panel title -->
        </span>
            <!-- Button Create material to Session -->

            <div class="pull-right head-box" style="width: 250px">
                <?= \yii\helpers\Html::activeDropDownList($type, 'material_type_id', $modelType, [
                    'class' => 'form-control select2 select2-edit-width',
                    'id' => 'selectType',
                    'name' => 'type'
                ]) ?>
            </div>

            <div class="pull-right">
                <label style="margin-top: 8px;
    margin-right: 10px;">ประเภทวัสดุ :</label>
            </div>
            <div class="pull-right margin-right-6 ">
                <label>ผลลัพธ์ :</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default  <?php if(!isset($params['view'])){
                        echo 'active';
                    }elseif (isset($params['view'])){
                        if($params['view']=='list'){
                            echo 'active';
                        }
                    } ?>">
                        <input type="radio" name="view" class="select3" value="list"
                            <?php if(!isset($params['view'])){
                                        echo 'checked';
                            }elseif (isset($params['view'])){
                                if($params['view']=='list'){
                                    echo 'checked';
                                }
                            } ?>
                                 ><i class="fa fa-th-list fa-2x vertical" aria-hidden="true"></i>
                    </label>
                    <label class="btn btn-default <?php if (isset($params['view'])){
                        if($params['view']=='block'){
                            echo 'active';
                        }
                    } ?>">
                        <input type="radio" name="view" class="select3" value="block"
                            <?php if (isset($params['view'])){
                                if($params['view']=='block'){
                                    echo 'checked';
                                }
                            } ?>
                                ><i class="fa fa-th-large fa-2x vertical" aria-hidden="true"></i>
                    </label>
                </div>

            </div>
            <div class="pull-right margin-right-10" style="width: 250px">
                <div id="custom-search-input">
                    <div class="input-group col-md-12" style="height: 35px;">
                        <input type="text" name="search" id="searchMaterial" class="form-control input-lg"
                               placeholder="ค้นหาวัสดุ" style="height: inherit !important;"/>
                        <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <!-- Panel content -->
    <div class="panel-body">
        <?php
        if (isset($params['view'])) {
            if($params['view'] == 'block') {
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
            }elseif ($params['view'] == 'list'){
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
                            'format' => 'raw',
                            'headerOptions' => [
                                'class' => 'col-md-5',
                            ],
                            'value' => function ($dataProvider, $modelMateril) {
                                $detail = "<div class='text-tbody'>";
                                $detail .= "<div  ><b>ชื่อวัสดุ </b>: <span name='material_name'>" . $dataProvider->material_name . "</span></div>";
                                $detail .= "<div><b>รหัสวัสดุ </b>: <span name='material_id'>" . $dataProvider->material_id . "</span></div>";
                                $detail .= "<div><b>รายละเอียด </b>: <span  name='material_detail'>" . $dataProvider->material_detail . "</span></div>";
                                $detail .= "<div><b>จำนวนคงเหลือ </b>: <span name='material_all'>" . MatsysMaterial::amountAll($dataProvider->material_id) . "</span> <span name='material_unit'>" . $dataProvider->material_unit_name . "</span></div></div>";
                                return $detail;
                            }

                        ],
                        [ // Type
                            'label' => '<div>ประเภทวัสดุ<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                            'attribute' => 'material_type_id',
                            'encodeLabel' => false,
                            'format' => 'raw',
                            'headerOptions' => [
                                'class' => 'col-md-4',
                            ],
                            'value' => function ($dataProvider, $key, $index, $column) {
                                $detail = "<div><b>ประเภทวัสดุ : </b></div><div><span name='material_type'>" . $dataProvider->materialType->material_type_name . "</span></div>";
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
                                $action = "<button name='addItem' data-id='" . $dataProvider->material_id . "' class='btn btn-info btn-sm'>เพิ่มรายการ</button>";
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
            }
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
                        'format' => 'raw',
                        'headerOptions' => [
                            'class' => 'col-md-5',
                        ],
                        'value' => function ($dataProvider, $modelMateril) {
                            $detail = "<div class='text-tbody'>";
                            $detail .= "<div  ><b>ชื่อวัสดุ </b>: <span name='material_name'>" . $dataProvider->material_name . "</span></div>";
                            $detail .= "<div><b>รหัสวัสดุ </b>: <span name='material_id'>" . $dataProvider->material_id . "</span></div>";
                            $detail .= "<div><b>รายละเอียด </b>: <span  name='material_detail'>" . $dataProvider->material_detail . "</span></div>";
                            $detail .= "<div><b>จำนวนคงเหลือ </b>: <span name='material_all'>" . MatsysMaterial::amountAll($dataProvider->material_id) . "</span> <span name='material_unit'>" . $dataProvider->material_unit_name . "</span></div></div>";
                            return $detail;
                        }

                    ],
                    [ // Type
                        'label' => '<div>ประเภทวัสดุ<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                        'attribute' => 'material_type_id',
                        'encodeLabel' => false,
                        'format' => 'raw',
                        'headerOptions' => [
                            'class' => 'col-md-4',
                        ],
                        'value' => function ($dataProvider, $key, $index, $column) {
                            $detail = "<div><b>ประเภทวัสดุ : </b></div><div><span name='material_type'>" . $dataProvider->materialType->material_type_name . "</span></div>";
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
                            $action = "<button name='addItem' data-id='" . $dataProvider->material_id . "' class='btn btn-info btn-sm'>เพิ่มรายการ</button>";
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

<!-- Modal Create Order -->
<div class="modal fade" id="ModalAddItem" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    ชื่อวัสดุ : <span name="modal-material_name"></span>
                    <span style="font-size: 15px !important;color: rgba(0,0,0,0.73);">จำนวนคงเหลือ :
                        <span name="modal-material_allamount"></span>
                        <span name="modal-material_unit"></span>
                    </span>
                </h4>
            </div>
            <div class="modal-body modal-center">
                <div class="row">
                    <div class="col-md-6" style="text-align: center;border-right: solid 1px #0000001a;">
                        <img class="image-in-modal" src="/cs-e-office/web/web_mat/images/tape.jpg" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class='text-tbody' style="margin-bottom: 20px">
                            <div><b style="font-size: 20px">ชื่อวัสดุ </b>: <span name="modal-material_name"></span>
                            </div>
                            <div><b>รหัสวัสดุ </b>: <span name="modal-material_id"></span></div>
                            <div><b>รายละเอียด </b>: <span name="modal-material_detail"></span></div>
                            <div><b>ประเภทวัสดุ </b>: <span name="modal-material_type"></span></div>
                        </div>
                        <div>
                            <div>
                                <input type="number" name="amount" class="form-control modal-input-amount" min="0"
                                       value="1">/
                                <span name="modal-material_allamount"></span>
                                <span name="modal-material_unit"></span>
                                <button id="additemtoorder" class="btn btn-info btn-sm pull-right margin-right-10"><i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i>เพิ่มรายการ
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div>
<!-- Modal Error repeatedly -->
<div class="modal fade" id="ModalErrorrepeatedly" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">สถานะการแจ้งเตือน</h4>
            </div>
            <div class="modal-body modal-center" style="text-align: center">
                <i class="fa fa-exclamation-triangle fa-4x warning-fa" aria-hidden="true"
                   style="vertical-align: middle;padding-right: 10px;color: #b8ad5c"></i>
                <b style="font-size: 20px">ไม่สามารถเพิ่มวัสดุได้ เนื่องจากมีวัสดุอยู่ในรายการแล้ว</b>
            </div>
        </div>
    </div>
</div>

