<?php
use yii\helpers\Html;

$this->title = Html::encode($this->title);
?>

<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<section class="content">
    <div class="content-wrapper">
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

                <!-- /.box-body -->
                <div class="box-footer no-padding">
                </div>
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script>
    var pass_id;
    function redirectDeleteRoll(id) {
        pass_id = id;

    }
</script>
<?= $this->render('label_form') ?>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- Page Script -->
<?php
//$this->registerJsFile("@web/assets/plugins/bootstrap/js/bootstrap.min.js", [
//]);
?>
