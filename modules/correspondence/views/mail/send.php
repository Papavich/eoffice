<html>
<head>
    <?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
    /* @var $form yii\widgets\ActiveForm */
    /* @var $model app\models\LoginForm */

    $this->title = Html::encode($this->title) . '- สร้างข้อความ';
    ?>
</head>
<body>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!-- Menu mail  -->
            <?php
            include "menumail.php";
            ?>

            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <input class="form-control" placeholder="To:">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Subject:">
                        </div>
                        <div class="form-group">
                    <textarea id="compose-textarea-send" class="form-control" style="height: 300px">
                      
                    </textarea>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> ไฟล์
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">ขนาดไฟล์สูงสุด. 32MB</p>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" id="drafButton"><i class="fa fa-pencil"></i>
                                บันทึกฉบับร่าง
                            </button>
                            <button type="submit" class="btn btn-primary" id="sendButton"><i
                                        class="fa fa-envelope-o"></i>ส่ง
                            </button>
                        </div>
                        <button type="reset" class="btn btn-default warning cancel" id="cancelButton"><i
                                    class="fa fa-times"></i> ยกเลิก
                        </button>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
</aside>


<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

<!-- Page Script -->
<?php

$this->registerJs(<<<JS
$(document).ready(function(){

    $("#compose-textarea-send").wysihtml5();
    
});
JS
);
?>
</body>
</html>
