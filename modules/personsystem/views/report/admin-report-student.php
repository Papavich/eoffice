<?php
use app\modules\personsystem\controllers;

?>

<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t( 'label','Report Student'); ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Report</a></li>
        <li class="active">Report Student Infomation</li>
    </ol>
</header>
<!-- /page title -->
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <form>
                                <fieldset>
                                    <div class="form-group">

                                        <label><b><?= controllers::t('label','Select Major') ?></b></label>
                                        <select  name="select" id="select2"  class="form-control">
                                            <?php  foreach ($modelMajor as $key => $item) { ?>
                                                <option value="<?= $item->major_id ?>"><?= $item->major_name ?></option>
                                            <?php } ?>
                                            <option value="">ทั้งหมด</option>
                                        </select>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form>
                                <fieldset>
                                    <div class="form-group">
                                        <label ><b><?= controllers::t('label','Select Level') ?></b></label>
                                        <select  name="select" id="select4" class="form-control">
                                            <?php     foreach ($modelLevel as $key => $item) { ?>
                                                <option value="<?= $item->LEVELID ?>"><?= $item->LEVELNAME ?></option>
                                            <?php } ?>
                                            <option value="">ทั้งหมด</option>
                                        </select>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form>
                                <fieldset>
                                    <div class="form-group">
                                        <label ><b><?= controllers::t('label','Select Student Status') ?></b></label>
                                        <select  name="select" id="select1" class="form-control">
                                            <?php     foreach ($modelStatus as $key => $item) { ?>
                                                <option value="<?= $item->BYTECODE ?>"><?= $item->BYTEDES ?></option>
                                            <?php } ?>
                                            <option value="v">ทั้งหมด</option>
                                        </select>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="col-md-2">
                            <form>
                                <fieldset>
                                    <div class="form-group">
                            <label><b><?= controllers::t('label','Select Admit Year') ?></b></label>
                            <select name="graduate_year" id="select3" class="form-control">
                           <?php     foreach ($modelYear as $key => $item) { ?>
                                <option value="<?= $item->ADMITACADYEAR ?>"><?= $item->ADMITACADYEAR ?></option>
                                <?php } ?>
                            </select>
                                    </div>
                                </fieldset>
                            </form>
                    </div>
                    </div>
                    <center>
                        <form method="post" action="multiple_select.html" onsubmit="multipleSelectOnSubmit()">
                            <fieldset>
                                <select multiple name="fromBox" id="fromBox">
                                    <option value="student_mobile_phone">เบอร์โทร</option>
                                    <option value="student_email">อีเมล</option>
                                    <option value="adviser_id">ที่ปรึกษา</option>
                                    <option value="CITIZENID">รหัสบัตรประชาชน</option>
                                </select>
                                <select multiple name="toBox" id="toBox">
                                    <option value="STUDENTCODE">รหัสนักศึกษา</option>
                                    <option value="PREFIXID">คำนำหน้า</option>
                                    <option value="STUDENTNAME">ชื่อ-นามสกุล</option>
                                    <option value="PROGRAMID">สาขา</option>
                                    <option value="STUDENTYEAR">ชั้นปี</option>
                                </select>
                            </fieldset>
                        </form>
                        <div class="btn-group">
                            <br/>
                        <button class="btn btn-success btn-3d" id="word" ><span class="fa fa-file-word-o"></span> Word</button>
                        <button class="btn btn-success btn-3d" id="excel" ><span class="fa fa-file-excel-o"></span> Excel</button>
                        </div>
                    </center>
                    <script type="text/javascript">
                        createMovableOptions("fromBox","toBox",600,300,'Available','Selected');
                    </script>
                    <br><br>

                </div>
                <script>
                  $(document).ready(function(){
                    "use strict";
                    $('#excel').click(function(e){
                      e.preventDefault();
                        // 12,13,11 (สภาพนักศึกษา พ้นสภาพ,ลาพัก)
                      var arayval = new Array();
                      var araytext = new Array();
                      var araySelect = new Array();
                      var status = document.getElementById("select1");
                      var major = document.getElementById("select2");
                      var year = document.getElementById("select3");
                      var level = document.getElementById("select4");
                      var toBox = document.getElementById("toBox");
                     // alert(status.value);
                      var i,j;
                      var status1 = status.value;
                      var major1 = major.value;
                      var year1 = year.value;
                      var level1 = level.value;

                      //ลูป for วนiคือเอาค่า academic_positions_abb(ค่าใน Database) วนjคือเอาค่า อีเมล (ค่าใน Select)
                      for (i = 0; i < toBox.length; i++) {
                        arayval[i] = toBox.options[i].value; //VALUE //
                        //.value .text
                      }
                      for (j = 0; j < toBox.length; j++) {
                        araytext[j] = toBox.options[j].text; //TEXT // ชื่อ-นามสกุล,ชั้นปี,สาขา
                      }
                     // alert(araytext);
                      $.ajax({
                        url: '../report/tobox-student',
                        data: {
                          'toVal1': arayval,
                          'toText': araytext,
                          'status': status1,
                          'major': major1,
                          'year': year1,
                          'level': level1
                        },
                        type: "get",
                          beforeSend: function () {
                              swalLoading()
                          },
                        success: function (data) {
                          if (data) {
                         //  alert(data);
                           window.location.href ="../../ReportStudent.xlsx";
                          }else{
                              swal("ไม่มีข้อมูล!");
                          }
                            swal.close()
                        }
                      });
                    });
                      $('#word').click(function(e){
                          e.preventDefault();
                          // 12,13,11 (สภาพนักศึกษา พ้นสภาพ,ลาพัก)
                          var arayval = new Array();
                          var araytext = new Array();
                          var araySelect = new Array();
                          var status = document.getElementById("select1");
                          var major = document.getElementById("select2");
                          var year = document.getElementById("select3");
                          var level = document.getElementById("select4");
                          var toBox = document.getElementById("toBox");
                          // alert(status.value);
                          var i,j;
                          var status1 = status.value;
                          var major1 = major.value;
                          var year1 = year.value;
                          var level1 = level.value;

                          //ลูป for วนiคือเอาค่า academic_positions_abb(ค่าใน Database) วนjคือเอาค่า อีเมล (ค่าใน Select)
                          for (i = 0; i < toBox.length; i++) {
                              arayval[i] = toBox.options[i].value; //VALUE //
                              //.value .text
                          }
                          for (j = 0; j < toBox.length; j++) {
                              araytext[j] = toBox.options[j].text; //TEXT // ชื่อ-นามสกุล,ชั้นปี,สาขา
                          }
                          // alert(araytext);
                          $.ajax({
                              url: '../report/tobox-student-word',
                              data: {
                                  'toVal1': arayval,
                                  'toText': araytext,
                                  'status': status1,
                                  'major': major1,
                                  'year': year1,
                                  'level': level1
                              },
                              type: "get",
                              beforeSend: function () {
                                  swalLoading()
                              },
                              success: function (data) {
                                  if (data){
                                    // alert(data);
                                    //  window.location.href ="../report/tobox-student-word";
                                      swal("Download สำเร็จ!");
                                     window.location.href ="../../ReportStudent.docx";

                                  }else{
                                      swal("ไม่มีข้อมูล!");
                                  }
                                  swal.close()
                              }
                          });
                      });
                  });
                </script>

            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">var epro_path = "<?=Yii::getAlias( "@web" )?>";</script>
<?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
    <?php
    echo \kartik\widgets\Growl::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? \yii\helpers\Html::encode($message['title']) : 'Title Not Set!',
        'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
        'body' => (!empty($message['message'])) ? \yii\helpers\Html::encode($message['message']) : 'Message Not Set!',
        'showSeparator' => true,
        'delay' => 1, //This delay is how long before the message shows
        'pluginOptions' => [
            'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
            'placement' => [
                'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
            ]
        ]
    ]);
    ?>
<?php endforeach; ?>