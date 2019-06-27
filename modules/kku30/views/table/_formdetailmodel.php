<?php

use yii\widgets\ActiveForm;
use yii\helpers\Json;
use kartik\widgets\Select2;

?>
<div class="table-responsive" id="div_sumary_model" style="display: none">
    <strong>ตารางสรุปผลการจัดตาราง</strong>
    <table class="table table-striped table-bordered table-hover" id="table_sumary_model"
           style="text-align: center !important;">
        <thead>
        <tr bgcolor="#BBEBFF">
            <th class="text-center" rowspan="2">ห้อง</th>
            <th class="text-center" colspan="4">การใช้ช่วงเวลา</th>
        </tr>
        <tr bgcolor="#BBEBFF">
            <th class="text-center">แบบ 1 ชม.</th>
            <th class="text-center">แบบ 1.5 ชม.</th>
            <th class="text-center">แบบ 2 ชม.</th>
            <th class="text-center">แบบ 3 ชม.</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>