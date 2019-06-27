<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . 'รายละเอียดข้อความ';
\Yii::setAlias('@webword', '@web/../modules/correspondence');
?>
<section id="middle" style="padding: 0px 5px 0px 5px">
    <div style="margin-top: 2%;">
        <!-- Menu mail  -->
        <?php
        /*        include "menumail.php";
                */ ?>
        <div class="col-md-12">
            <div class="box box-primary" style="color: black">
                <div class="box-tools pull-right">
                    <br>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i
                                class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i
                                class="fa fa-chevron-right"></i></a>
                </div>

                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3 style="color: black"> ประกาศการรับสมัครทุนการศึกษา ตามโครงการมหาวิทยาลัยวิจัยแห่งชาติ มหาวิทยาลัยขอนแก่น ประจำปี2553</h3>
                        <h5 style="color: black">จาก: correspondence@example.com
                            <span class="mailbox-read-time"> 28 เมษายน 2553 14:05</span></h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip"
                                    data-container="body" title="Delete">
                                <i class="fa fa-trash-o"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                    data-target="#ReplyModal"
                                    data-whatever="@mdo" id="modal" title="Reply">
                                <i class="fa fa-reply"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                    data-target="#ForwardModal"
                                    data-whatever="@mdo" id="modal2" title="Forward">
                                <i class="fa fa-share"></i></button>
                        </div>
                        <!-- /.btn-group -->

                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <div align="center" id="detail-text">
                            รายละเอียดหนังสือ
                        </div>

                        <div class="col-lg-7">
                            <iframe width="600px" height="850px"
                                    src="<?= Yii::getAlias('@webword').'/style/docc.pdf';?>" frameborder="0"></iframe>
                        </div>

                        <p><b>เลขที่รับเข้า :</b> 2208</p>
                        <p><b>วันที่รับเข้า : </b>28 เมษายน 2553 </p>
                        <p><b>ลงวันที่(หนังสือ) :</b> 28 เมษายน 2553 11:30:00</p>
                        <p><b>เลขที่(หนังสือ):</b> ศธ.0514.1.12/332</p>
                        <p><b>ชั้นความลับ :</b> ปกติ</p>
                        <p><b>ชั้นความเร็ว :</b> ปกติ</p>
                        <p><b>ชื่อเรื่อง:</b> ประกาศการรับสมัครทุนการศึกษา ตามโครงการมหาวิทยาลัยวิจัยแห่งชาติ มหาวิทยาลัยขอนแก่น ประจำปี2553</p>
                        <p><b>ส่งมาจาก:</b> สำนักงานอธิการบดี ฝ่ายิจัยและการถ่ายทอดเทคโนโลยี(ชั้น 1 สถาบันวิจัยและพัฒนา)</p>
                        <p><b>ประเภทหนังสือ :</b> หนังสือภายใน</p>
                        <p><b>สถานที่เก็บต้นฉบับ :</b> สารบรรณภาควิชาวิทยาการคอมพิวเตอร์</p>
                        <p><b>เอกสารที่เกี่ยวข้อง :</b> <?= Html::a("ศธ.0514.2.1.3/332", ['staff-receive/detail_book']) ?> </p>
                        <p><b>ไฟล์หนังสือ : </b><br/>
                            <a href="#">
                                &nbsp
                                <i href="#" class="fa fa-file-pdf-o" style="font-size:30px;color:red"></i>
                                &nbsp ศธ.0514.2.1.3/205
                            </a><br/>
                            <a href="#">
                                &nbsp
                                <i href="#" class="fa fa-file-pdf-o" style="font-size:30px;color:red"></i>
                                &nbsp ศธ.0514.2.1.3/300
                            </a><br/>
                            <a href="#">
                                &nbsp
                                <i href="#" class="fa fa-file-picture-o" style="font-size:30px;color:red"></i>
                                &nbsp เอกสารแนบ
                            </a><br/>
                        </p>
                        <p><b>ส่งถึง : </b> <br>
                            ผศ.ดร.สมเกียรติ ศรีจารนัย &nbsp สถานะ : <span style="color: green">อ่านแล้ว</span><br>
<!--                            ผศ.สันติ ทินตะนัย &nbsp สถานะ : <span style="color: green">อ่านแล้ว</span><br>
                            อาจารย์วชิราวุธ ธรรมวิเศษ &nbsp สถานะ : <span style="color: green">อ่านแล้ว</span><br>
                            ผศ.ดร.ธีระยุทธ ทองเครือ &nbsp สถานะ : <span style="color: green">อ่านแล้ว</span><br>
                            อ.ดร.ชิตสุธา สุ่มเล็ก &nbsp สถานะ : <span style="color: green">อ่านแล้ว</span><br>
                            อ.ดร.คำรณ สุนัติ &nbsp สถานะ : <span style="color: red">ยังไม่อ่าน</span><br>-->
                        </p>
                        <br> <br> <br>

                        <div class="row padding-50" align="center">
                            <h1 class="page-header comment">Comments</h1>
                            <section class="comment-list">
                                <!-- First Comment -->
                              <!--<article class="row margin-top-10">
                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive"
                                                 src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bf8f1610.png"
                                                 width="100"/>
                                            <figcaption class="text-center">ผศ.สันติ ทินตะนัย</figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="panel panel-default arrow left">
                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user"><i class="fa fa-user"></i> ผศ.สันติ
                                                        ทินตะนัย
                                                    </div>
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
                                                <p class="text-right "><a href="#" class="btn btn-success btn-sm"><i
                                                                 class="fa fa-reply"></i> ตอบกลับ</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </article>
-->
                              <!--  <div style="border: 2px dashed #c7254e; margin: 0 0 2% 10%"></div>

                                <article class="row">
                                    <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive"
                                                 src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bf8f1610.png"
                                                 width="100"/>
                                            <figcaption class="text-center">อาจารย์วชิราวุธ ธรรมวิเศษ</figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="panel panel-default arrow left">

                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user"><i class="fa fa-user"></i> อาจารย์วชิราวุธ
                                                        ธรรมวิเศษ
                                                    </div>
                                                    <time class="comment-date" datetime="16-12-2014 01:05"><i
                                                                class="fa fa-clock-o"></i> 15 กันยายน 2560 01:05
                                                    </time>
                                                </header>
                                                <div class="comment-post">
                                                    <p>
                                                        รับทราบ
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <div style="border: 2px dashed #c7254e; margin: 0 0 2% 10%"></div>

                                <article class="row">
                                    <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive"
                                                 src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bf8f1610.png"
                                                 width="100"/>
                                            <figcaption class="text-center">ผศ.ดร.ธีระยุทธ ทองเครือ</figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="panel panel-default arrow left">

                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user"><i class="fa fa-user"></i>
                                                        ผศ.ดร.ธีระยุทธ ทองเครือ
                                                    </div>
                                                    <time class="comment-date" datetime="16-12-2014 01:05"><i
                                                                class="fa fa-clock-o"></i> 15 กันยายน 2560 01:05
                                                    </time>
                                                </header>
                                                <div class="comment-post">
                                                    <p>
                                                        รับทราบ
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>-->

                                <!--<div style="border: 2px solid grey; margin: 0 0 1% 0"></div>-->
                                <article class="row margin-top-10">
                                    <div class="col-md-2 col-sm-2 hidden-xs">
                                        <figure class="thumbnail">
                                            <img class="img-responsive"
                                                 src="https://openclipart.org/image/2400px/svg_to_png/202776/pawn.png"
                                                 width="80"/>
                                            <figcaption class="text-center">ผศ.ดร.สมเกียรติ ศรีจารนัย</figcaption>
                                        </figure>
                                    </div>
                                    <div class="col-md-10 col-sm-10">
                                        <div class="panel panel-default arrow left">
                                            <div class="panel-body">
                                                <header class="text-left">
                                                    <div class="comment-user"><i class="fa fa-user"></i>
                                                        ผศ.ดร.สมเกียรติ ศรีจารนัย
                                                    </div>
                                                    <time class="comment-date" datetime="16-12-2014 01:05"><i
                                                                class="fa fa-clock-o"></i>
                                                        28 เมษายน 2553 14:05
                                                    </time>
                                                </header>
                                                <div class="comment-post">
                                                    <p>
                                                        รับทราบ
                                                    </p>
                                                </div>
                                                <!-- <p class="text-right "><a href="#" class="btn btn-success btn-sm"><i
                                                                 class="fa fa-reply"></i> ตอบกลับ</a></p>-->
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <div style="border: 2px solid grey; margin: 0 0 1% 0"></div>
                            </section>
                        </div>
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.box-body -->

                <!-- /.box-footer -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ReplyModal"
                                data-whatever="@mdo" id="modal"><i class="fa fa-reply"></i> ตอบกลับ
                        </button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ForwardModal"
                                data-whatever="@mdo" id="modal2"><i class="fa fa-share"></i> ส่งต่อ
                        </button>
                    </div>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>

</section>


<!-- Reply modal -->
<div class="modal fade" id="ReplyModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
                <h4 class="modal-title">ตอบกลับ</h4>
            </div>
            <div class="modal-body">
                <form id="ReplyForm" method="post">

                    <!-- <div class="form-group">
                         <label for="recipient-name" class="control-label" >E-mail:</label>
                         <input type="email" class="form-control" id="email" name="email">
                         <p id="emailError" style="color: red;"></p>
                         <p id="emailpattenError" style="color: red;"></p>
                     </div>-->
                    <div class="form-group">

                        <input type="checkbox" name="status" value="read"> อนุมัติ :
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" style="height: 200px"></textarea>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group" align="right">
                            <button type="submit" class="btn btn-success loginsubmit" style="width: 120px;"
                                    value="submit" name="submit" id="submit">ส่ง
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Reply modal -->

<!-- Forward modal -->
<div class="modal fade" id="ForwardModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
                <h4 class="modal-title">ส่งต่อ</h4>
            </div>
            <div class="modal-body">
                <form id="ForwardForm" method="post">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <p id="emailError" style="color: red;"></p>
                        <p id="emailpattenError" style="color: red;"></p>
                    </div>
                    <div class="form-group">
                        บุคคลที่เลือก :
                        <textarea class="form-control" style="height: 200px">corres@gmail.com , maam@kkumail.com , jqudo@gmail.com</textarea>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group" align="right">
                            <button type="submit" class="btn btn-success loginsubmit" value="submit"
                                    name="submitForward" id="submitForward" style="width: 120px;">ส่ง
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Forward modal -->
<?php

$this->registerJs(<<<JS
$(document).ready(function(){

    $("#compose-textarea").wysihtml5();
    $("#compose-textarea-forward").wysihtml5();
});
JS
);
?>

