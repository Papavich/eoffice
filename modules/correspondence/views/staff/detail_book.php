<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . 'รายละเอียดหนังสือ';
?>

<section id="middle" style="color: black">
    <div class="wizard" style="padding: 20px">

        <div align="center" id="detail-text">
            รายละเอียดหนังสือ
        </div>

        <div class="col-lg-7">
            <iframe src="https://research.google.com/pubs/archive/44678.pdf" height="700" width="600"></iframe>
        </div>

        <p><b>เลขที่รับเข้า :</b> 003</p>
        <p><b>วันที่รับเข้า :</b> 19 ก.ย. 2560, 16:24</p>
        <p><b>ลงวันที่(หนังสือ) :</b> 19 ก.ย. 2560, 16:24</p>
        <p><b>เลขที่(หนังสือ):</b> ศธ.0514.2.1.3/332</p>
        <p><b>ชั้นความลับ :</b> ปกติ</p>
        <p><b>ชั้นความเร็ว :</b> ปกติ</p>
        <p><b>ชื่อเรื่อง:</b> รายงานการประชุมเกี่ยวกับ...</p>
        <p><b>ส่งมาจาก:</b> คณะวิทยาศาสตร์</p>
        <p><b>ประเภทหนังสือ :</b> หนังสือภายใน</p>
        <p><b>สถานที่เก็บต้นฉบับ :</b> 8506 ชั้น4 </p>
        <p><b>ไฟล์หนังสือ : </b>
            <a href="#">
                &nbsp
                <i href="#" class="fa fa-file-pdf-o" style="font-size:30px;color:red"></i>
                &nbsp ดาวน์โหลด
            </a>
        </p>
        <p><b>ส่งถึง : </b> <br>
            อาจารย์ A &nbsp สถานะ : <span style="color: green">อ่านแล้ว</span><br>
            อาจารย์ B &nbsp สถานะ : <span style="color: red">ยังไม่อ่าน</span><br>
            อาจารย์ C &nbsp สถานะ : <span style="color: green">อ่านแล้ว</span><br>
        </p>
        <br>

        <div class="row padding-50" align="center">
            <h1 class="page-header comment">Comments</h1>
            <section class="comment-list">
                <!-- First Comment -->
                <article class="row nopadding">
                    <div class="col-md-2 col-sm-2 hidden-xs">
                        <figure class="thumbnail">
                            <img class="img-responsive"
                                 src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bf8f1610.png"
                            width="100"/>
                            <figcaption class="text-center">อาจารย์ ก</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <div class="panel panel-default arrow left">
                            <div class="panel-body">
                                <header class="text-left">
                                    <div class="comment-user"><i class="fa fa-user"></i>นางสาว กอไก่ ขอไข่</div>
                                    <time class="comment-date" datetime="16-12-2014 01:05"><i
                                                class="fa fa-clock-o"></i>
                                        15 กันยายน 2560 01:05
                                    </time>
                                </header>
                                <div class="comment-post">
                                    <p>
                                        กรุณาตอบกลับด่วนที่สุด
                                    </p>
                                </div>
                               <!-- <p class="text-right "><a href="#" class="btn btn-success btn-sm"><i
                                                class="fa fa-reply"></i> ตอบกลับ</a></p>-->
                            </div>
                        </div>
                    </div>
                </article>
                <div style="border: 2px solid black; margin: 0 0 2% 0"></div>
                <!-- Second Comment -->
                <article class="row">
                    <div class="col-md-2 col-sm-2 hidden-xs">
                        <figure class="thumbnail">
                            <img class="img-responsive"
                                 src="https://cdn1.iconfinder.com/data/icons/user-pictures/100/female1-512.png" width="100"/>
                            <figcaption class="text-center">อาจารย์ ข</figcaption>
                        </figure>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <div class="panel panel-default arrow left">
                            <div class="panel-body">
                                <header class="text-left">
                                    <div class="comment-user"><i class="fa fa-user"></i>นางสาวกนิษฐา  พูลลาภ</div>
                                    <time class="comment-date" datetime="16-12-2014 01:05">
                                        <i class="fa fa-clock-o"></i>
                                        19 กันยายน 2560 01:05
                                    </time>
                                </header>
                                <div class="comment-post">
                                    <p>
                                       ตอบรับเอกสาร
                                    </p>
                                </div>
                                <!--<p class="text-right"><a href="#" class="btn btn-success btn-sm"><i
                                                class="fa fa-reply"></i> ตอบกลับ</a></p>-->
                            </div>
                        </div>
                    </div>
                </article>
                <div style="border: 2px solid black; margin: 0 0 2% 0"></div>
            </section>
        </div>
    </div>
</section>