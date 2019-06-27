<?php
use yii\helpers\Html;

$this->title = Html::encode($this->title) . 'จดหมายติดดาว';

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
                <br>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
<?= $this->render('label_form') ?>
<script>
    var pass_id;
    function redirectDeleteRoll(id) {
        pass_id = id;
    }
</script>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
<!-- Page Script -->
<?php

$this->registerJs(<<<JS

JS
);

?>
