<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $model app\modules\materialsystem\models\LocationSearch */
/* @var $location \app\modules\materialsystem\models\MatsysLocation */

?>

<div class="padding-20">

    <div class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong><h4>ตารางสถานที่จัดเก็บ</h4></strong> <!-- panel title -->
							</span>
        </div>
        <!-- Seacrch Page -->

        <div class="row">

            <!-- LEFT -->
            <div class="col-md-12">

                <!-- Panel Tabs -->
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <!-- tabs nav -->
                        <ul class="nav nav-tabs pull-left">
                            <li class="active"><!-- TAB 1 -->
                                <a href="#" data-toggle="tab">ค้นหาจากรหัส หรือ ชื่อหมวดหมู่</a>
                            </li>
                        </ul>
                        <!-- /tabs nav -->
                    </div>

                    <?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax', 'timeout' => 5000]) ?>

                    <!-- เรียก view _search.php -->
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    <br>
                    <div class="panel-body">
                        <?= GridView::widget([
                            'id' => 'grid-user',
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'tableOptions' => [
                                'class' => 'table table-striped table-bordered table-hover',
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'location_id',
                                'location_name',
                                ['class' => 'yii\grid\ActionColumn', 'template' => '{custom_view}',
                                    'options' => ['style' => 'width:90px;'],
                                    'buttonOptions' => ['class' => 'btn btn-default'],
                                    'buttons' =>
                                        ['custom_view' => function ($url, $model1) {
                                            /* @var $model1 \app\modules\materialsystem\models\MatsysLocation */
                                            // Html::a args: title, href, tag properties.
                                            return '<div class="btn-group btn-group-sm text-center" role="group">
                                    <a class="glyphicon glyphicon-pencil btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myEdit' . $model1->location_id  . '"></a>
                                    <a class="glyphicon glyphicon-trash btn btn-3d btn-default btn-xs" data-toggle="modal" data-target="#myDel' . $model1->location_id . '"></a>
                                        </div>';
                                        },
                                        ]
                                ],
                            ],
                        ]); ?>
                    </div>
                    <?php yii\widgets\Pjax::end() ?>/

                </div>
            </div>
        </div>
    </div>
</div>

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
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin(['action'=>['location/deletelocation'],]) ?>
                            <div class="padding-20" align="center">
                                <input type="hidden" name="loca_id[]" value="<?= $location->location_id ?>">
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
    <div id="myEdit<?= $location->location_id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                                <?php $form = ActiveForm::begin(['action'=>['location/updatelocation'],])?>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label>รหัสสถานที่</label>
                                            <input type="text" class="form-control" name="loca_id[]" value="ฺ"<?= $location->location_id ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                    <input type="hidden" name="loca_id[]" value="<?= $location->location_id ?>">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <label>ชื่อสถานที่</label>
                                            <input type="text" class="form-control" name="loca_name[]" value="<?= $location->location_name ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <input class="btn btn-3d btn-success btn-sm btn-block margin-top-30" type="submit" value="บันทึก">
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
