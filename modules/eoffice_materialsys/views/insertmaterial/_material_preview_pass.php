<?php
use app\modules\eoffice_materialsys\models\User;
?><div class="table-responsive nomargin">
    <div class="preview-content">
        <div>บันทึกเลขที่ : <span class="preview-heigtlight"><?= $model_bill_master['bill_mater_record'] ?></span>เลขที่ใบตรวจรับ
            :
            <span class="preview-heigtlight"><?= $model_bill_master['bill_master_check'] ?></span></div>
        <div>ใบส่งของ เลขที่ : <span class="preview-heigtlight"><?= $model_bill_master['bill_master_id'] ?></span>
            เล่มที่ : <span
                    class="preview-heigtlight"><?= $model_bill_master['bill_master_id_no'] ?></span> วันที่ : <span
                    class="preview-heigtlight"><?= $model_bill_master['bill_master_date'] ?></span>
        </div>
        <div>รับพัสดุจากบริษัท : <span
                    class="preview-heigtlight"><?= $company ?></span></div>
    </div>
    <div class="preview-content">
        <div>
            ผู้เบิกวัสดุ : <span class="preview-heigtlight"><?= User::getFullname($id_user) ?></span>
        </div>
        <div>
            รายละเอียดการนะไปใช้ :
            <div>
                รหัส :<span class="preview-heigtlight"><?= $order_detail_name_id ?></span>
                ชื่อ  :<span class="preview-heigtlight"><?= $order_detail_name ?></span>
                <div>
                    รายละเอียด :<span class="preview-heigtlight"><?= $order_detail ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="preview-content">
        <h6 style="margin-bottom: 0"><b>ข้อมูลไฟล์ PDF : </b><?= $filepdf ?></h6>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th class="col-md-1"><i class="fa fa-sort" aria-hidden="true"></i> ลำดับ</th>
            <th class="col-md-5"><i class="fa fa-th-list" aria-hidden="true"></i></i> รายการ</th>
            <th class="col-md-2"><i class="glyphicon glyphicon-send "></i> จำนวน</th>
            <th class="col-md-2"><i class="glyphicon glyphicon-send "></i> ราคาต่อหน่วย</th>
            <th class="col-md-2"><i class="fa fa-money" aria-hidden="true"></i></i> จำนวนเงิน</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $priceall = 0;
        $array_name = [];
        $array_unit = [];
        $count = 0;
        foreach ($model_name as $key => $value) {
            array_push($array_name, $value['material_name']);
            array_push($array_unit, $value['material_unit_name']);
        }
        foreach (array_combine($array_name, $model_detail) as $key => $value) {
            $priceall += $value['bill_detail_price_per_unit'] * $value['bill_detaill_amount'];
            ?>
            <tr>
                <td><?= $count + 1 ?></td>
                <td><?= $key ?></td>
                <td><?= number_format((float)$value['bill_detaill_amount'], 2, '.', '') . " " . $array_unit[$count] ?></td>
                <td><?= number_format((float)$value['bill_detail_price_per_unit'], 2, '.', '') ?>
                    <sapn class="pull-right">บาท</sapn>
                </td>
                <td><?= number_format((float)$value['bill_detail_price_per_unit'] * $value['bill_detaill_amount'], 2, '.', '') ?>
                    <sapn class="pull-right">บาท</sapn>
                </td>
            </tr>
            <?php
            $count++;
        }
        ?>

        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td>รวม</td>
            <td></td>
            <td></td>
            <td class="text-right"><?= number_format((float)$priceall, 2, '.', '') ?> บาท</td>
        </tr>
        <tr>
            <td></td>
            <td>ราคาก่อนหักส่วนลด(ไม่รวมภาษีมูลค่าเพิ่ม)</td>
            <td></td>
            <td></td>
            <td class="text-right"><?= number_format((float)$priceall, 2, '.', '') ?> บาท</td>
        </tr>
        <tr>
            <td></td>
            <td>หักส่วนลด</td>
            <td></td>
            <td></td>
            <td class="text-right">0.00 บาท</td>
        </tr>
        <tr>
            <td></td>
            <td>ราคาหลังหักส่วนลด(ไม่รวมภาษีมูลค่าเพิ่ม)</td>
            <td></td>
            <td></td>
            <td class="text-right"><?= number_format((float)$priceall, 2, '.', '') ?> บาท</td>
        </tr>
        <tr>
            <td></td>
            <td>ภาษีมูลค่าเพิ่ม</td>
            <td></td>
            <td></td>
            <td class="text-right"><?= number_format((float)$priceall * 0.07, 2, '.', '') ?> บาท</td>
        </tr>
        <tr>
            <td></td>
            <td>รวมทั้งสิ้น</td>
            <td></td>
            <td></td>
            <td class="text-right"><?= number_format((float)$priceall + ($priceall * 0.07), 2, '.', '') ?> บาท</td>
        </tr>
        </tfoot>
    </table>
    ** สกุลเงิน บาท **
</div>