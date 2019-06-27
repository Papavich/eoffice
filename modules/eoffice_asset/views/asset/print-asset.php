<div class="text-center">

<div class="modal-body">
    <table class="table table-bordered nomargin">
        <tbody>
        <tr>
            <td colspan="3" ><b>ส่วนที่ 1</b></td>
        </tr>
        <tr>
            <td><b>วันที่นำเข้า: </b> <?php echo $model['asset_date'];?></td>
            <td><b>ปีงบประมาณ: </b><?php echo $model['asset_year'];?></td>
            <td><b>วิธีการได้มา: </b><?php echo \app\modules\eoffice_asset\models\AssetGet::findOne($model['asset_get'])->asset_get_name; ?></td>
        </tr>
        <tr>
            <td><b>จำนวนเงินงปบประมาณ:  </b><?php echo $model['asset_budget'];?></td>
            <td colspan="2" ><b>ผู้ขาย/บริษัท: </b><?php echo \app\modules\eoffice_asset\models\AssetCompany::findOne($model['asset_company'])->asset_company_name; ?></td>
        </tr>
        </tbody>
    </table>
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
                    <th>ประเภทครุภัณฑ์</th>
                    <th>สถานที่/ห้อง</th>
                    <th>สถานะการยืม</th>

                </tr>
                </thead>
                <tbody>
                <?php  $x=1;  foreach ($modelA as $value):?>
                    <tr>
                        <td><?php  echo $x++; ?></td>
                        <td><?php  echo  $value['asset_dept_code_start']; ?></td>
                        <td><?php  echo  $value['asset_detail_name']; ?></td>
                        <td><?php  echo   \app\modules\eoffice_asset\models\AssetTypeDepartment::findOne($value['asset_dept_type'])->asset_type_dept_name; ?></td>
                        <td><?php  echo   \app\modules\eoffice_asset\models\EofficeCentralViewPisRoom::findOne($value['asset_detail_room'])->rooms_name; ?></td>
                        <td><?php  echo \app\modules\eoffice_asset\models\AssetDetailStatus::findOne( $value['asset_detail_status'])->asset_status_name; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



</div>


