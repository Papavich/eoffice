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
    <!-- Main Contain -->
    <div class="panel panel-default ">
        <div class="panel-heading topic-import-auto panel-heading-height" style="height: 75px !important;">
        <span class=" elipsis">
            <i class="fa fa-stack-overflow fa-2x" aria-hidden="true"></i>  <strong
                    class="topic-import">วัสดุในการคืนทั้งหมด</strong> <!-- panel title -->
        </span>
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
                                $detail .= "<div><b>จำนวนคงเหลือ </b>: " . MatsysMaterial::amountAllReturn($dataProvider->material_id) . " " . $dataProvider->material_unit_name . "</div></div>";
                                return $detail;
                            }

                        ],
                        [ // Type
                            'label' => '<div>ประเภทวัสดุ<i class=\'fa fa-sort pull-right\' aria-hidden=\'true\'></i></div>',
                            'attribute' => 'material_type_id',
                            'encodeLabel' => false,
                            'format' => 'html',
                            'headerOptions' => [
                                'class' => 'col-md-4',
                            ],
                            'value' => function ($dataProvider, $key, $index, $column) {
                                $detail = "<div><b>ประเภทวัสดุ : </b></div><div>" . $dataProvider->materialType->material_type_name . "</div>";
                                return $detail;
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