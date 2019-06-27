<?php
use yii\helpers\Html;
use \app\modules\correspondence\controllers;
use yii\widgets\Pjax;
$this->title = Html::encode($this->title) . 'จดหมายที่ส่งแล้ว';
$this->registerCss("
table tbody tr td a {
  display: block;
  width: 100%;
  color: black;
}
tr.hover {
  cursor: pointer;
}
a:hover{
  color: black;
}
");

$this->registerJsFile('@web/../modules/correspondence/style/js/mail-input.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/../modules/correspondence/style/js/mail.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <!-- Menu mail  -->
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary" style="overflow: inherit">
                    <!-- Mail Header -->
                    <?= $this->render('mail_header', ['model_label' => $model_label,'pages' => $pages,
                        'searchData'=>  $searchData]) ?>
                    <!-- /.Mail Header -->
                    <!-- Mail Body -->

                    <?= $this->render('mail_body-gridview', ['dataProvider' => $dataProvider,'gridColumns'=>$gridColumns
                        ,'model_label' => $model_label,'pages' => $pages]) ?>
                    <!-- /.Mail Body -->
                    </form>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<?= $this->render('label_form') ?>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- Page Script -->
<script>
    var pass_id;
    function redirectDeleteRoll(id) {
        pass_id = id;

    }
</script>
