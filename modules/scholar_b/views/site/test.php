<?php
$this->registerCssFile('@web/web_scb/css/boxslide.css');
?>

<style>
    @import url('https://fonts.googleapis.com/css?family=Prompt');
</style>
<!-- page title -->
<header id="page-header">
    <h1>ประกาศ</h1>
    <ol class="breadcrumb">
        <li><a href="../site/index-other">หน้าหลัก</a></li>
        <li class="active">ประกาศทุน</li>
    </ol>
</header>
<!-- /page title -->

<section class="container">
    <div class="section first">
        <div class="cont_title">
            <?php $Scbtype = \app\modules\scholar_b\models\ScbScholarshipTypeHasYear::find()->all(); ?>
            <?php
            foreach ($Scbtype as $item) { ?>
                <a href="../scholarship/detail-scb1?id=<?php echo $item->scholarship_year . $item->scholarship_id ?>'"><h1>ทุนช้างเผือก</h1></a>
            <?php } ?>
        </div>
        <div class="cont_desc">
            <a href="../scholarship/detail-scb1"><p>รายละเอียดคลิกๆ</p></a>
        </div>
    </div>
    <div class="section">
        <div class="cont_title">
            <h1>ทุนไรดี</h1>
        </div>
        <div class="cont_desc">
            <a href="#"><p>รายละเอียดคลิกๆ</p></a>
        </div>
    </div>
    <div class="section">
        <div class="cont_title">
            <h1>ทุนไรดี</h1>
        </div>
        <div class="cont_desc">
            <a href="#"><p>รายละเอียดคลิกๆ</p></a>
        </div>
    </div>
    <div class="section">
        <div class="cont_title">
            <h1>ทุนไรดี</h1>
        </div>
        <div class="cont_desc">
            <a href="#"><p>รายละเอียดคลิกๆ</p></a>
        </div>
    </div>
    <div class="section">
        <div class="cont_title">
            <h1>ทุนไรดี</h1>
        </div>
        <div class="cont_desc">
            <a href="#"><p>รายละเอียดคลิกๆ</p></a>
        </div>
    </div>
</section>
