<?php
/* @var $this yii\web\View */
?>

<body>
<div id="content" class="dashboard padding-20">

  <div id="panel-1" class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong class="size-20">แจ้งเตือนการสอบ</strong> <!-- panel title -->
      </span>

    </div>

    <!-- panel content -->

  <div class="panel-body">
    <div class="col-md-12">
      <br/><center>

      <a class="btn btn-featured btn-danger" data-toggle="modal" data-target=".bs-example-modal-lg">
        <span>แจ้งเตือนกรรมการคุมสอบ</span>
      <i class="et-megaphone"></i> </a>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- header modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">แจ้งเตือนกรรมการคุมสอบ</h4>
        </div>

      <!-- body modal -->
      <div class="modal-body">
        คุณต้องการแจ้งเตือนกรรมการคุมสอบใช่หรือไม่
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">ปิด</a>
        <a href="#" class="btn btn-primary toastr-notify" data-progressBar="true" data-position="top-right" data-notifyType="success" data-message="แจ้งเตือนสำเร็จ!" data-dismiss="modal">ยืนยัน</a>

      </div>

    </div>
  </div>
</div>

<div class="height-350"></div>

</section>

<!-- /MIDDLE -->

</div>






<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>

<!-- PAGE LEVEL SCRIPT -->

<!-- STYLESWITCHER - REMOVE -->
<script async type="text/javascript" src="assets/plugins/styleswitcher/styleswitcher.js"></script>
</body>
