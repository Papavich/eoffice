<?php

/* @var $this yii\web\View */
$this->title = 'ภาพรวมระบบ';
?>

<div class="row">
    <div class="col-md-3">

        <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-blue"><i class="fa fa-male"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">จำนวนบุคลากร</span>
          <span class="info-box-number"><?= $countPerson; ?> คน</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div>
     <div class="col-md-3">
        <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-green"><i class="fa fa-at"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">ข้อมูลแผนก</span>
          <span class="info-box-number"><?= $countDepartment; ?> รายการ</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div>
     <div class="col-md-3">
        <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-orange"><i class="fa fa-bell"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">ข้อมูลตำแหน่ง</span>
          <span class="info-box-number"><?= $countPosition; ?> รายการ</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div>

</div>








