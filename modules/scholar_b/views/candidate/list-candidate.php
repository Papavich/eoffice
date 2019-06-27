<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Button;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\scholar_b\models\ScbCandidateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="scb-candidate-index">
    <div class="panel-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="col-md-1"></div>
        <div class="col-md-10" align="center">
            <div class="input-group">
                <input class="form-control" type="text" name="search_text"
                       autocomplete="off" id="search_text" placeholder="ค้นหา"/>
                <div class="input-group-btn">
                    <button class="btn btn-info" type="submit"><i class="fa fa-lg fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-12" style="margin-top: 20px">
            <table id="table1" class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th width="5%">ลำดับ</th>
                    <th width="20%">เลขบัตรประจำตัวประชาชน</th>
                    <th width="20%">ชื่อ-นามสกุล</th>
                    <th width="20%">อีเมล์</th>
                    <th width="15%">เบอร์โทรศัพท์</th>
                    <th width="10%">สถานะ</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                foreach ($candidate as $rows) {

                    ?>
                    <tr>
                        <td><?= $count ?></td>
                        <td><?= $rows->id_card ?></td>
                        <td><?= $rows->prefix . ' ' . $rows->firstname . ' ' . $rows->lastname ?></td>
                        <td><?= $rows->email ?></td>
                        <td><?= $rows->mobile ?></td>
                        <td><?= $rows->status ?></td>
                        <td>
                            <a class="btn btn-info" href='../candidate/detailcandidate?id=<?php echo $rows->id_card?>'>ดูเพิ่มเติม</a>
                        </td>
                    </tr>
                    <?php
                    $count++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



