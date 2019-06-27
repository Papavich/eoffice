
<!-- Card -->
<!--<div class="panel panel-default border-box">-->
<!--    <div class="panel-heading head-box">-->
<!--        <span class="title elipsis">-->
<!--            <!-- panel title -->-->
<!--            <strong>ใบสั่งซื้อวัสดุหมายเลข ( --><?//= $model_bill_master['bill_master_id'] ?><!-- )</strong>-->
<!--        </span>-->
<!--        <!-- right options -->-->
<!--        <ul class="options pull-right list-inline">-->
<!--            <li><a href="#" class="btn-detail" data-toggle="tooltip" title="รายละเอียดข้อมูล"-->
<!--                   data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i> รายละเอียด</a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="panel-body">-->
<!--        <div class="row">-->
<!--            <div class="col-md-7">-->
<!--                --><?php //$form = ActiveForm::begin([
//                    'id' => 'detail-bill',
//                    'enableAjaxValidation' => true,
//                    'action' => null,
//                    'enableClientValidation' => false,
//                    'validateOnBlur' => false,
//                    'validateOnType' => false,
//                    'validateOnChange' => false,
//                    'options' => [
//                    ]
//                ]);
//                ?>
<!--                --><?//= $form->field($model_bill_master, 'bill_master_date', [
//                    'options' => [
//                        'class' => 'form-group col-md-4'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false])
//                    ->textInput(
//                        [
//                            'class' => 'form-control masked',
//                            'data-format' => '99/99/9999',
//                            'placeholder' => 'วว/ดด/ปปปป',
//                            'data-placeholder' => "_",
//                            'disabled' => 'disabled'
//                        ]
//                    )
//                ?>
<!--                --><?//= $form->field($model_bill_master, 'bill_master_id', [
//                        'options' => [
//                            'class' => 'form-group col-md-4 col-xs-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false]
//                )->textInput(
//                    [
//                        'class' => 'form-control',
//                        'disabled' => 'disabled'
//                    ]
//                )
//                ?>
<!--                --><?//= $form->field($model_bill_master, 'bill_master_id_no', [
//                        'options' => [
//                            'class' => 'form-group col-md-4 col-xs-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false]
//                )->textInput(
//                    [
//                        'class' => 'form-control',
//                        'disabled' => 'disabled'
//                    ]
//                )
//                ?>
<!--                --><?//= $form->field($model_bill_master, 'bill_master_check', [
//                        'options' => [
//                            'class' => 'form-group col-md-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false]
//                )->textInput(
//                    [
//                        'class' => 'form-control',
//                        'disabled' => 'disabled'
//                    ]
//                )
//                ?>
<!--                --><?//= $form->field($model_bill_master, 'bill_mater_record', [
//                        'options' => [
//                            'class' => 'form-group col-md-6'], 'errorOptions' => ['tag' => null], 'enableAjaxValidation' => true, 'validateOnBlur' => false]
//                )->textInput(
//                    [
//                        'class' => 'form-control',
//                        'disabled' => 'disabled'
//                    ]
//                )
//                ?>
<!--                <div class="form-group col-md-12">-->
<!--                    <label>สั่งซื้อจากบริษัท</label>-->
<!--                    --><?//= \yii\helpers\Html::activeDropDownList($model_bill_master, 'company_id',$model_company,['class'=>'form-control']) ?>
<!--                </div>-->
<!--                --><?php //ActiveForm::end(); ?>
<!--            </div>-->
<!--            <div class="col-md-5">-->
<!--                <label>อัพโหลด PDF : </label>-->
<!--                --><?php //$form = ActiveForm::begin([
//                    'action' => 'upfilepdf',
//                    'id' => 'myDropzonepdf' . $count,
//                    'options' => [
//                        'class' => 'dropzone dropzone-size',
//                        'name' => $model_bill_master['bill_master_id'],
//                    ],
//                ]) ?>
<!--                --><?php //ActiveForm::end() ?>
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="col-md-7">-->
<!--                <table class="table table-condensed">-->
<!--                    <tr>-->
<!--                        <th class="col-md-1">#</th>-->
<!--                        <th class="col-md-5">วัสดุ</th>-->
<!--                        <th class="col-md-5">นำเข้าสู่วัสดุ</th>-->
<!--                        <th class="col-md-1">หมายเหตุ</th>-->
<!--                    </tr>-->
<!--                    --><?php
//                    $allprice = 0;
//                    $count_items = 0;
//                    foreach ($items as $key => $value) {
//                        $allprice += $value->QTY*$value->UPRICE;
//                        $count_items++;
//                        ?>
<!--                        <tr>-->
<!--                            <td>--><?//= $key + 1 ?><!--</td>-->
<!--                            <td>-->
<!--                                <div>-->
<!--                                    <div><b>ชื่อวัสดุ : --><?//= $value->PRODUCT_NAME ?><!-- - --><?//= $value->REMARK ?><!--</b></div>-->
<!--                                    <div>จำนวน : --><?//= $value->QTY ?><!-- --><?//= $value->UMS_NAME ?><!--</div>-->
<!--                                    <div>ราคาต่อหน่วย : --><?//= $value->UPRICE ?><!-- บาท</div>-->
<!--                                    <div>ราคารวม : --><?//= $value->UPRICE*$value->QTY ?><!-- บาท</div>-->
<!--                                </div>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <select id="search_mat--><?//= '-'.$count.'-'.$key ?><!--" class="form-control" name="state">-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <button class="btn btn-sm btn-info"> วัสดุผ่านมือ</button>-->
<!--                            </td>-->
<!--                        </tr>-->
<!--                        --><?php
//
//                    }
//                    ?>
<!--                </table>-->
<!--            </div>-->
<!--            <div class="col-md-5">-->
<!--                <div class="panel panel-summary">-->
<!--                    <div class="panel-body">-->
<!--                        สรุปรายการทั้งหมด-->
<!--                    </div>-->
<!--                    <!-- Summary Material List -->-->
<!--                    <div class="panel-footer">-->
<!--                        <div class="row" style="font-size: 14px">-->
<!--                            <div class="col-md-7 col-sm-7 col-xs-7">-->
<!--                                <span>ราคารวม</span>-->
<!--                            </div>-->
<!--                            <div class="col-md-4 col-sm-4 col-xs-4 pull-right">-->
<!--                                <span id="price">--><?//= $allprice ?><!--</span> บาท-->
<!--                            </div>-->
<!--                            <div class="col-md-7 col-sm-7 col-xs-7">-->
<!--                                <span>รายการทั้งหมด</span>-->
<!--                            </div>-->
<!--                            <div class="col-md-4 col-sm-4 col-xs-4 pull-right">-->
<!--                                <span id="amount-list">--><?//= $count_items ?><!--</span> รายการ-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->