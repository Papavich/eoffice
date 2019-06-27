<?php

use yii\widgets\ActiveForm;

?>


<!--JS-->

<?= $this->render('_formjs') ?>

<!--JS-->

<!--header-->

<header id="page-header">
    <h1>กลุ่มเรียนแต่ละวิชา</h1>
    <ol class="breadcrumb">
        <li><a href="index">หน้าแรก</a></li>
        <li><a href="javascript:history.go(-1)">เลือกการจัดตาราง</a></li>
        <li class="active">รายการกลุ่มต่างๆ</li>
    </ol>
</header>
<!--header-->
<!--MAIN STUDY SCHEDULE-->
<div id="main_table" class="padding-20">
    <div class="panel panel-default ">
        <div id="section-to-print">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>ข้อมูลกลุ่มเรียนของ <strong style="color: red">ปีการศึกษา <?=$year_of?></strong><strong style="color: red"> ภาคการศึกษา <?=$semester?></strong></strong>
                </span>
            </div>
            <!--SHOW TEACH TABLE-->
            <?= $this->render('_formgrouplist_table', [
                'array_render_view' => $array_render_view,
                'Arrlen' => $Arrlen,
                'semester' => $semester,
                'year_of' => $year_of
            ]) ?>
            <!--SHOW TEACH TABLE-->
        </div>

    </div>
</div>
<!--MAIN STUDY SCHEDULE-->










