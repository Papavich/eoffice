<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\correspondence\controllers;
$this->title = Html::encode($this->title) . 'ตั้งค่าประเภทเอกสาร';

?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<section id="middle" style="color: black">
    <div id="content" class="padding-30">
        <div id="panel-ui-tan-l1" class="panel panel-default">

            <div class="panel-heading">

									<span class="elipsis"><!-- panel title -->
                                        <?php
                                        
                                        ?>
                                        <b><?= controllers::t('menu', 'Settings') ?></b> <!-- panel title -->
									</span>

                <!-- tabs nav -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><!-- TAB 1 -->
                        <a href="#ttab1_nobg" data-toggle="tab" aria-expanded="true"><?= controllers::t('menu', 'Speed') ?></a>
                    </li>
                    <li class=""><!-- TAB 2 -->
                        <a href="#ttab2_nobg" data-toggle="tab" aria-expanded="false"><?= controllers::t('menu', 'Secret') ?></a>
                    </li>
                    <li class=""><!-- TAB 2 -->
                        <a href="#ttab3_nobg" data-toggle="tab" aria-expanded="false"><?= controllers::t('menu', 'Document type') ?></a>
                    </li>
                    <li class=""><!-- TAB 2 -->
                        <a href="#ttab4_nobg" data-toggle="tab" aria-expanded="false"><?= controllers::t('menu', 'Secret') ?></a>
                    </li>
                </ul>
                <!-- /tabs nav -->

            </div>

            <!-- panel content -->
            <div class="panel-body">

                <!-- tabs content -->
                <div class="tab-content transparent">

                    <div id="ttab1_nobg" class="tab-pane active"><!-- TAB 1 CONTENT -->
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <?php
                            foreach ($model_speed as $rows){
                                echo "<tr>";
                                echo "<td>".$rows['speed_name']."</td>";
                                echo  "<td>".Html::a("<i class=\"fa fa-edit\"></i>
                                            <span>".controllers::t('menu', 'Edit')."</span>",
                                        ['staff-send/edit-send-form?id=' . $rows['speed_id']],
                                        ['class' => 'btn btn-3d btn-xs btn-reveal btn-blue btnw'])."</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <div>
                            <a href="#NewListModal" class="btn btn-default"
                               data-toggle="modal" data-whatever="@mdo">สร้างรายการทำลายใหม่
                            </a>
                            <button style="float: left" class="btn btn-success">บันทึก</button>
                        </div>
                    </div><!-- /TAB 1 CONTENT -->

                    <div id="ttab2_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <?php
                            foreach ($model_secret as $rows){
                                echo "<tr>";
                                echo "<td>".$rows['secret_name']."</td>";
                                echo  "<td>".Html::a("<i class=\"fa fa-edit\"></i>
                                            <span>".controllers::t('menu', 'Edit')."</span>",
                                        ['staff-send/edit-send-form?id=' . $rows['secret_id']],
                                        ['class' => 'btn btn-3d btn-xs btn-reveal btn-blue btnw'])."</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div><!-- /TAB 2 CONTENT -->
                    <div id="ttab3_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <?php
                            foreach ($model_type as $rows){
                                echo "<tr>";
                                echo "<td>".$rows['type_name']."</td>";
                                echo  "<td>".Html::a("<i class=\"fa fa-edit\"></i>
                                            <span>".controllers::t('menu', 'Edit')."</span>",
                                        ['?id=' . $rows['type_id']],
                                        ['class' => 'btn btn-3d btn-xs btn-reveal btn-blue btnw'])."</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                        <div>
                            555
                        </div>
                    </div><!-- /TAB 3 CONTENT -->
                    <div id="ttab4_nobg" class="tab-pane"><!-- TAB 2 CONTENT -->
                        <p>Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque. Ut enim massa, sodales tempor convallis et, iaculis ac massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div><!-- /TAB 4 CONTENT -->

                </div>
                <!-- /tabs content -->

            </div>
            <!-- /panel content -->

        </div>

</section>
<!-- Add new list modal -->
<div class="modal fade" id="NewListModal" role="dialog">
    <div class="modal-dialog" style="width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
                <h4 class="modal-title">สร้างรายการหนังสือที่ต้องการทำลาย</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-bordered"
                       id="sample_editable_1">
                    <thead>
                    <tr>
                        <th>เลือกทั้งหมด <input type="checkbox" id="choseall"></th>
                        <th>เลขที่</th>
                        <th>วันที่หนังสือ</th>
                        <th>วันครบทำลาย</th>
                        <th>เรื่อง</th>
                        <th>ผู้รับ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="checkalllist">
                            </td>
                            <td align="center">
                                <?= $i + 1 ?>
                            </td>
                            <td align="center">
                                31/05/60
                            </td>
                            <td align="center">
                                29/09/60
                            </td>
                            <td align="center">
                                ทดสอบ <?= $i + 1 ?>
                            </td>
                            <td align="center">
                                นางสาวชนกนันท์ ถูไกรวงษ์
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
                <div>
                    <button type="button" class="btn btn-success"  data-dismiss="modal">สร้างรายการ</button>
                </div>
            </div>
        </div>
    </div>
</div>
