
<!--JS-->
<?= $this->render('/table/_formjs') ?>
<!--JS-->


<section>
    <!-- page title -->
    <header id="page-header">
        <h1>แก้ไขวิชา <b><?= $model->sub_id;?> <?= $model->sub_thainame;?></b></h1>
        <ol class="breadcrumb">
            <li><a href="addsubject">หน้าแรก</a></li>
            <li class="active">แก้ไขรายวิชา <?= $model->sub_id;?> <?= $model->sub_thainame;?></li>
        </ol>
    </header>
    <!-- /page title -->
    <!--    SHOW ADD SUBJECT-->
    <?= $this->render('_formaddsubject', ['model'=>$model]) ?>
    <!--    SHOW ADD SUBJECT-->
</section>



