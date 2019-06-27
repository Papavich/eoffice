<!-- page title -->
<header id="page-header">
    <h1>เพิ่มข้อมูลวัสดุผ่านระบบ kkufmis</h1>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <!-- ------ -->
    <div class="panel panel-default">
        <div class="panel-heading panel-heading-transparent">
            <strong>คลิกหรือวางไฟล์ XML เพื่อเพิ่มข้อมูล</strong>
        </div>

        <div class="panel-body">

            <form action="<?= Yii::$app->homeUrl ?>assets/plugins/dropzone/upload.php" method="post" class="dropzone nomargin" id="my-dropzone"></form>

        </div>

        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-12">
                <a href="<?= Yii::$app->homeUrl ?>materialsystem/default/showkkufmis" class="btn btn-3d btn-success btn-xl btn-block margin-top-30">
                    <i class="glyphicon glyphicon-edit" aria-hidden="false"></i>บันทึก
                </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <a href="<?= Yii::$app->homeUrl ?>materialsystem/default/index" class="btn btn-danger btn-warning btn-xl btn-block margin-top-30">
                    <i class="glyphicon glyphicon-remove" aria-hidden="false"></i>ยกเลิก
                </a>
            </div>
        </div>

        <div class="panel-footer">
        </div>
    </div>

    <!-- /----- -->
</div>