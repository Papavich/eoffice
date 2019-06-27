<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\eoffice_asset\models\AssetBorrow */

?>
<div id="content" class="padding-20">
<div id="panel-misc-portlet-color-r2" class="panel panel-warning">
    <div class="panel-heading">
            <span class="elipsis"><!-- panel title -->
                <strong>รอนุมัติการยืม</strong>
            </span>
    </div>
    <div class="panel-body">
        <div class="row">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'borrow_id',
            'borrow_user_fname',
            'borrow_user_lname',
            'borrow_user_tel',
            'borrow_date',
            'borrow_object',
        ],
    ]) ?>

<!--=============================================================-->

    <div id="panel-misc-portlet-color-r2" class="panel panel-warning">
        <div class="panel-heading">
                        <span class="elipsis"><!-- panel title -->
                            <strong>รายการครุภัณฑ์ (ส่วนที่ 2)</strong>
                        </span>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover nomargin">
                    <thead>
                    <tr>

                        <th>#</th>
                        <th>รหัสครุภัณฑ์</th>
                        <th>ชื่อรายการครุภัณฑ์</th>
                        <th>สถานะการดำเนินการ</th>
                        <th>ดำเนินการ</th>


                    </tr>
                    </thead>
                    <tbody>
                    <?php  $x=1;  foreach ($modelA as $value):?>
                        <tr>
                            <td><?php  echo $x++; ?></td>
                            <td><?php  echo \app\modules\eoffice_asset\models\AssetDetail::findOne($value['borrow_detail_asset_id'])->asset_dept_code_start;  ?></td>
                            <td><?php  echo \app\modules\eoffice_asset\models\AssetDetail::findOne($value['borrow_detail_asset_id'])->asset_detail_name;   ?></td>
                            <td><?php  echo \app\modules\eoffice_asset\models\AssetBorrowStatus::findOne($value['borrow_detail_status'])->status_name;   ?></td>

                            <td><a href="rescript" class="btn btn-3d btn-green btn-sm">อนุมัติการยืม</a></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div></div></div></div>