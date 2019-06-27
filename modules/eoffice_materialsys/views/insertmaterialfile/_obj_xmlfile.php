<?php

use yii\widgets\ActiveForm;

foreach ($content as $key => $value) {
    ?>
    <!-- Card -->
    <div name="block" class="panel panel-default border-box">
        <div class="panel-heading head-box">
            <span class="title elipsis">
                <!-- panel title -->
                <strong>ใบสั่งซื้อวัสดุหมายเลข ( <?= $value['model_bill_master']->bill_master_id ?> )</strong>
            </span>
            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="btn-detail" data-toggle="tooltip" title="รายละเอียดข้อมูล"
                       data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i> รายละเอียด</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-7">
                    <?php $form = ActiveForm::begin([
                        'id' => 'detail-bill',
                        'enableAjaxValidation' => true,
                        'action' => null,
                        'enableClientValidation' => false,
                        'validateOnBlur' => false,
                        'validateOnType' => false,
                        'validateOnChange' => false,
                        'options' => [
                        ]
                    ]);
                    ?>
                    <?= $form->field($value['model_bill_master'], 'bill_master_date', [
                        'options' => [
                            'class' => 'form-group col-md-4'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false])
                        ->textInput(
                            [
                                'class' => 'form-control masked',
                                'data-format' => '99/99/9999',
                                'placeholder' => 'วว/ดด/ปปปป',
                                'data-placeholder' => "_",
                                'disabled' => 'disabled'
                            ]
                        )
                    ?>
                    <?= $form->field($value['model_bill_master'], 'bill_master_id', [
                            'options' => [
                                'class' => 'form-group col-md-4 col-xs-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false]
                    )->textInput(
                        [
                            'class' => 'form-control',
                            'disabled' => 'disabled'
                        ]
                    )
                    ?>
                    <?= $form->field($value['model_bill_master'], 'bill_master_id_no', [
                            'options' => [
                                'class' => 'form-group col-md-4 col-xs-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false]
                    )->textInput(
                        [
                            'class' => 'form-control',
                            'disabled' => 'disabled'
                        ]
                    )
                    ?>
                    <?= $form->field($value['model_bill_master'], 'bill_master_check', [
                            'options' => [
                                'class' => 'form-group col-md-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false]
                    )->textInput(
                        [
                            'class' => 'form-control',
                            'disabled' => 'disabled'
                        ]
                    )
                    ?>
                    <?= $form->field($value['model_bill_master'], 'bill_mater_record', [
                            'options' => [
                                'class' => 'form-group col-md-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false]
                    )->textInput(
                        [
                            'class' => 'form-control',
                            'disabled' => 'disabled'
                        ]
                    )
                    ?>
                    <div class="form-group col-md-9">
                        <label>สั่งซื้อจากบริษัท</label>
                        <?= \yii\helpers\Html::activeDropDownList($value['model_bill_master'], 'company_id', $value['model_company'], ['class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-3">
                        <div class="pull-left mat-pass" style="margin-top: 20px;">
                            <input type="checkbox" name="material_pass">:วัสดุผ่านมือ
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-md-5">
                    <label>อัพโหลด PDF : </label>
                    <?php $form = ActiveForm::begin([
                        'action' => 'upfilepdf',
                        'id' => 'myDropzonepdf' . $value['count'],
                        'options' => [
                            'class' => 'dropzone dropzone-size',
                            'name' => $value['model_bill_master']->bill_master_id,
                        ],
                    ]) ?>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
            <div name="material_pass" style="display: none;" class="row margin-bottom-20">
                <div class="col-md-12">
                    <label>ชื่อผู้เบิก</label>
                    <select id="" class="form-control search-user" name="search-user">
                    </select>
                    <span id="errorEnter_user" class="hidden-text"
                          style="color: red;">กรุณาเลือกผู้เบิกวัสดุ</span>
                </div>
                <div class="col-md-6">
                    <label>รายละเอียดการนำไปใช้(*)</label>
                    <select name="detail" style="width: 100%">
                        <option value="DF001">วิชาเรียน</option>
                        <option value="DF002">โครงการ</option>
                        <option value="DF003">กิจกรรม</option>
                        <option value="DF004" selected>อื่น ๆ</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div style="display: none" name="boxdetail" id="DF001">
                        <div class="row">
                            <div class="col-md-4">
                                <label>รหัสวิชา</label>
                                <input name="order_detail_name_id" type="text" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <label>ชื่อวิชา</label>
                                <input name="order_detail_name" type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" name="boxdetail" id="DF002">
                        <div class="row">
                            <div class="col-md-4">
                                <label>รหัสโครงการ</label>
                                <input name="order_detail_name_id" type="text" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <label>ชื่อโครงการ</label>
                                <input name="order_detail_name" type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" name="boxdetail" id="DF003">
                        <div class="row">
                            <div class="col-md-12">
                                <label>ชื่อกิจกรรม</label>
                                <input name="order_detail_name" type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="display: block" name="boxdetail" id="DF004">
                        <div class="row">
                            <div class="col-md-12">
                                <label>รายละเอียด</label>
                                <textarea name="order_detail" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-condensed">
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-5">วัสดุ</th>
                            <th class="col-md-5">นำเข้าสู่วัสดุ</th>
                        </tr>
                        <tbody>
                        <?php
                        $allprice = 0;
                        $count_items = 0;
                        foreach ($value['items'] as $key2 => $value2) {
                            $allprice += $value2->QTY * $value2->UPRICE;
                            $count_items++;
                            ?>
                            <tr>
                                <td><?= $key2 + 1 ?></td>
                                <td>
                                    <div>
                                        <div><b>ชื่อวัสดุ : <?= $value2->PRODUCT_NAME ?> - <?= $value2->REMARK ?></b>
                                        </div>
                                        <div>จำนวน : <span
                                                    name="amount"><?= $value2->QTY ?></span> <?= $value2->UMS_NAME ?>
                                        </div>
                                        <div>ราคาต่อหน่วย : <span name="unit_per_price"><?= $value2->UPRICE ?></span>
                                            บาท
                                        </div>
                                        <div>ราคารวม : <?= $value2->UPRICE * $value2->QTY ?> บาท</div>
                                    </div>
                                </td>
                                <td>
                                    <select id="search_mat<?= '-' . $value['count'] . '-' . $key2 ?>"
                                            class="form-control" name="state">
                                </td>
                                <!--                                <td >-->
                            </tr>
                            <?php

                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-summary">
                        <div class="panel-body">
                            สรุปรายการทั้งหมด
                        </div>
                        <!-- Summary Material List -->
                        <div class="panel-footer">
                            <div class="row" style="font-size: 14px">
                                <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span>ราคารวม</span>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 pull-right">
                                    <span id="price"><?= $allprice ?></span> บาท
                                </div>
                                <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span>รายการทั้งหมด</span>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4 pull-right">
                                    <span id="amount-list"><?= $count_items ?></span> รายการ
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<div id='id_dropfile' style='visibility: hidden'><?= $countarray ?></div>
<div id='id_searchmat' style='visibility: hidden'><?= $countmat ?></div>
