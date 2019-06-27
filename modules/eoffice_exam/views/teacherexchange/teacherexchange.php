
<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<div id="content" class="dashboard padding-20">

  <div id="panel-1" class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong class="size-20">แลกเปลี่ยนวันที่คุมสอบ</strong> <!-- panel title -->

      </span>

    </div>


  <!-- panel content -->


  <!-- /page title -->

  <div class="fancy-form fancy-form-select text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
          <!-- date picker -->
          วันที่<input type="text" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
        </div>
      </div>
    </div>
    </br>
    <div class="fancy-form fancy-form-select text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-offset-3 col-lg-6">
            <input type="text" name="proctorname" value="" class="form-control required" placeholder="Enter Proctor Name..">
          </div>
        </div>
      </div><br>
      <a href="#" class="btn btn-3d btn-reveal btn-green">
        <i class="glyphicon glyphicon-search"></i>
        <span>Search</span>
      </a>
      <br><br>

      <div class="fancy-form fancy-form-select text-center">
        <div class="container">
          <div class="row">
            <div class="col-lg-offset-2 col-lg-8">
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <thead>
                  <tr>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">ผู้คุมสอบ</th>
                    <th class="text-center">วันที่คุมสอบ</th>
                    <th class="text-center">เวลาคุมสอบ</th>
                    <th class="text-center">ห้องสอบ</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                      ผศ.สันติ ทินตะนัย
                    </td>
                    <td>
                      9/7/2017
                    </td>
                    <td>
                      08.30-10.30
                    </td>
                    <td>
                      SC8103
                    </td>
                    <td>
                      <a onclick="window.open('https://www.facebook.com/messages','_blank');" class="btn btn-default btn-xs"><i class="fa fa-wechat"></i> chat </a>
                      <?= Html::a('<i class="fa fa-refresh"> Exchange</i>', ['formexchange'], ['class'=>'btn btn-default btn-xs','fa fa-refresh']) ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>





<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>


<!-- STYLESWITCHER - REMOVE -->
<script async type="text/javascript" src="assets/plugins/styleswitcher/styleswitcher.js"></script>
