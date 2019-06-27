<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\pfc\models\Student;
use app\modules\pfc\models\Teacher;


$session = Yii::$app->session;
$session->remove('sesValue');


/* @var $this yii\web\View */
/* @var $model app\modules\pfc\models\Project */
/* @var $model app\modules\pfc\models\Student */
/* @var $form yii\widgets\ActiveForm */

$email = '1133';
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>

    <meta charset='utf-8'/>



    <link href='<?= Yii::$app->homeUrl ?>web_pfc/calendar/fullcalendar.min.css' rel='stylesheet'/>
    <link href='<?= Yii::$app->homeUrl ?>web_pfc/calendar/fullcalendar.print.min.css' rel='stylesheet' media='print'/>
    <script src='<?= Yii::$app->homeUrl ?>web_pfc/calendar/moment.min.js'></script>
    <script src='<?= Yii::$app->homeUrl ?>web_pfc/calendar/jquery.min.js'></script>
    <script src='<?= Yii::$app->homeUrl ?>web_pfc/calendar/fullcalendar.min.js'></script>
    <script src='<?= Yii::$app->homeUrl ?>web_pfc/calendar/jquery.datepair.min.js'></script>
    <script src='<?= Yii::$app->homeUrl ?>web_pfc/calendar/datepair.min.js'></script>
    <script src='<?= Yii::$app->homeUrl ?>web_pfc/calendar/calendar_s.js'></script>
    <script src="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css"/>
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
            crossorigin="anonymous"></script>

    <style>


        body {

            margin: 0px 0px;
            padding: 0;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
            font-size: 14px;

        }

        #calendar {
            position: absolute;
            width: 75%;
            /*max-width: 900px;*/
            margin-left: 250px;
            margin-bottom 100px;
        }

        #list {
            position: absolute;
            width: 235px;
            margin-left: 10px;
            margin-top: 10px;
        }

        #event {
            position absolute;
            width 10%;
            margin-left: 10px;
            margin-top: 10px;
        }

        #calendar, #list {
            float: left;

        }

        .rcorners2 {
            border-radius: 10px;
            border: 2px solid #73AD21;
            padding: 10px;
        }

        .rcorners3 {
            text-align: center;
            border-radius: 10px;
            border: 2px solid #73AD21;
            padding: 10px;
            width: 235px;
            height: auto;
            background-color: yellow;
        }

        .rcorners4 {
            border-radius: 10px;
            border: 2px solid #73AD21;
            background-color: yellow;
            width: 100%;
            padding: 4px;
        }

    </style>


        <header id="page-header">
            <h1>ปฎิทิน</h1>
            <ol class="breadcrumb">
                <li><a href="javascript:history.back(1)">หน้าหลัก</a></li>
                <li class="active">ปฎิทิน</li>
            </ol>
        </header>

        <div class="padding-20">
            <div class="row">

                <?php
                $session = Yii::$app->session;
                if($session->get('pfc_id') != null){
                    $teacher = Teacher::find()->where("teacher_id like :b", [":b" => $session->get('pfc_id')])->all();
                    $student = Student::find()->where("student_id like :b", [":b" => $session->get('pfc_id')])->all();

                    if($teacher != null){
                        $email = $teacher[0]->teacher_email;
                    }elseif($student != null){
                        $email = $student[0]->student_email;
                    }
                }
                ?>

                <button id="sign-in-or-out-button" class='btn btn-success'
                        style="margin-left: 25px">Sign In
                </button>

                <button id="revoke-access-button" class='btn btn-danger' hidden
                        style="display: none; margin-left: 25px">Sign Out
                </button>
                <button type="button" id="insert" class="btn btn-success" hidden
                        style="display: none; margin-left:30px">สมัครรับข้อมูลจากปฏิทินอื่น</button>
                <br>

                <button type='button' id='qwe' class='btn' data-dismiss='modal' style="display: none">
                    Simulate Input
                </button>





                <a href="../../../../controllers/GGController.php?email=test@gmail.com">

                </a>

                <button id="user2"
                        style="margin-left: 25px"></button>


                <?php
                echo '';
                ?>
                <div id="eee" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content modal-body">
                            <span>กรอก ID ของปฏิทิน : ตัวอย่าง Nawakorn.kao@gmail.com </span>
                            <br>
                            <br>
                            <input type='text' id='cid'/>
                            <br>
                            <br>
                            <button type='button' id='Sub' class='btn btn-success' data-dismiss='modal'>
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
                <div id="www" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content modal-body">
                            <span>ชื่อปฏิทิน</span>
                            <input type='text' id='summa'/>
                            <br>
                            <br>
                            <span>email 1 </span>
                            <input type='text' id = 'em1' />
                            <span>email 2</span>
                            <input type='text' id='em2'/>
                            <br>
                            <br>
                            <button type='button' id='con' class='btn btn-success' data-dismiss='modal'>
                                Simulate
                            </button>
                        </div>
                    </div>
                </div>

                <div id="calendarModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content modal-body">
                            <span>สร้างปฏิทิน</span>
                            <div id="event">
                                หัวข้อ
                                <input type="text" id="summary"/>
                                เลือกปฏิทินที่ต้องการ
                                <select id="cal_select">
                                </select>
                                <div id="mytime"><br/> เลือกช่วงเวลา
                                    <input type='text' id='mytime_start' class='time start'/> to
                                    <input type='text' id='mytime_end' class='time end'/>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $('body').on('hidden.bs.modal', '.modal', function () {
                        $(this).removeData('bs.modal');
                    });
                </script>

                <div id="selfModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content modal-body">
                            <span>ข้อมูลปฏิทิน</span>
                            <div id="modal-detailself-lul"></div>

                            <button type='button' id='delete1' class='btn btn-danger' data-dismiss='modal'>
                                ลบกิจกรรมนี้
                            </button>
                        </div>
                    </div>
                </div>

                <div id="detailModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content modal-body">
                            <span>ข้อมูลปฏิทิน</span>
                            <div id="modal-detail-lul"></div>

                            <span>สถานะ :<font color="#00008b">ยังไม่ตัดสินใจ</font></span>
                            <div>
                                <button type='button' id='cancelled' class='btn btn-danger' data-dismiss='modal'>ปฏิเสธ
                                </button>
                                <button type='button' id='accept' class='btn btn-success' data-dismiss='modal'>ยอมรับ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="detailModalnormal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content modal-body">
                            <span>ข้อมูลปฏิทิน</span>
                            <div id="modal-normal-lul"></div>
                        </div>
                    </div>
                </div>


                <div id="detailModal2" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content modal-body">
                            <span>ข้อมูลปฏิทิน</span>
                            <div id="modal-detail2-lul"></div>
                            <span>สถานะ :<font color="blue">ยังไม่ติดสินใจ</font></span>
                            <div>
                                <button type='button' id='cancelled2' class='btn btn-danger' data-dismiss='modal'>
                                    ยกเลิกการนัดหมาย
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="accepted" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content modal-body">
                            <span>ข้อมูลปฏิทิน</span>
                            <div id="modal-accepted-lul"></div>
                            <span>สถานะ :<font color="green">ยืนยันแล้ว</font></span>
                        </div>
                    </div>
                </div>

                <div id="cancelledModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content modal-body">
                            <span>ข้อมูลปฏิทิน</span>
                            <div id="modal-cancel-lul"></div>
                            <!--                            <div id="test1"></div>-->
                            <!--                            <div id="test2"></div>-->
                            <!--                            <div>จากช่วง-->
                            <!--                                <span id="test3"></span> ถึง-->
                            <!--                                <span id="test4"></span>-->
                            <!--                            </div>-->
                            <span>สถานะ : <font color="red">ปฏิเสธ</font></span>
                            <button type='button' id='delete2' class='btn btn-danger' data-dismiss='modal'>
                                ลบการนัดหมายนี้ถาวร
                            </button>

                        </div>

                    </div>
                </div>
                <div id="buffet-pls" class="hidden">
                    ชื่อหัวข้อ : <span id="title-xd"></span><br>
                    รายละเอียด : <span id="description-xd"></span>
                    <div> จากช่วง
                        <span id="time-start-xd">  </span> ถึง
                        <span id="time-end-xd"></span>
                    </div>
                </div>
            </div>

            <div id="ggez" class="row invisible">
                <label class="rcorners3" style="margin-left: 10px">ปฏิทินทั้งหมด</label><br>
                <div class="col-md-4 rcorners2" id="list">
                </div>
                <div class="col-md-8" id='calendar'>
                    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
                    <script async defer src="https://apis.google.com/js/api.js"
                            onload="this.onload=function(){};handleClientLoad()"
                            onreadystatechange="if (this.readyState === 'complete') this.onload()">
                    </script>

                    <script type='text/javascript' src='<?= Yii::$app->homeUrl ?>web_pfc/calendar/gcal.js'></script>
                </div>
            </div>
        </div>

</head>



<script>
    $(document).ready(function () {
        $("#mytime").append("<br><p style='margin-bottom: 0px;'>รายละเอียด</p> <textarea cols='50' style='margin-top: 10px;margin-bottom: 10px;' id='description'></textarea><br>" +
            "<button type='button' id='close' class='btn btn-danger' data-dismiss='modal'>Close</button> " +
            "<button type='button' id='create' class='btn btn-success' data-dismiss='modal'>Create</button>");
    });

</script>

</html>