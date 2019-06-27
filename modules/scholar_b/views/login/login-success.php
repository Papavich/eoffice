<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 21/1/2561
 * Time: 16:48
 */


$session = Yii::$app->session;
$session->open();

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
<div class="panel-body">
    <?php
    echo "<h4>";
    echo "ยินดีต้อนรับ ";
    echo $session['prefix'] . ' ' . $session['firstname'] . ' ' . $session['lastname'];
    echo "</h4>";
    ?>
    <section class="container">
        <div class="section first">
            <div class="cont_title">
                <!--<div class="letter-container">
                  <p class="lettering">Alaska, USA</p>
                </div>-->
                <a href="../scholarship/detail-scb1"><h1>ทุนช้างเผือก</h1></a>
            </div>
            <div class="cont_desc">
                <a href="../scholarship/detail-scb1"><p>รายละเอียดคลิก</p></a>
            </div>
        </div>
        <div class="section">
            <div class="cont_title">
                <h1>ผู้มีความสามารถพิเศษ (ทุน)</h1>
            </div>
            <div class="cont_desc">
                <a href="#"><p>รายละเอียดคลิก</p></a>
            </div>
        </div>
        <div class="section">
            <div class="cont_title">
                <h1>ผู้มีความสามารถพิเศษ (รับเข้า)</h1>
            </div>
            <div class="cont_desc">
                <a href="#"><p>รายละเอียดคลิก</p></a>
            </div>
        </div>
        <div class="section">
            <div class="cont_title">
                <h1>ทุนคณะ</h1>
            </div>
            <div class="cont_desc">
                <a href="#"><p>รายละเอียดคลิก</p></a>
            </div>
        </div>
        <div class="section">
            <div class="cont_title">
                <h1>ทุนมหาวิทยาลัย</h1>
            </div>
            <div class="cont_desc">
                <a href="#"><p>รายละเอียดคลิก</p></a>
            </div>
        </div>
    </section>
</div>
