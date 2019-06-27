<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\personsystem\controllers;
?>
<!-- page title -->
<header id="page-header">
    <h1><?= controllers::t( 'label','Report Teacher'); ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Report</a></li>
        <li class="active">Report Teacher Infomation</li>
    </ol>
</header>
<!-- /page title -->
<?php
//$model = \app\models\Person::findAll();
?>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <!-- ------ -->
            <div class="panel panel-default">

                <div class="panel-body">
                    <br>
                    <center>
                        <form method="post" action="multiple_select.html" onsubmit="multipleSelectOnSubmit()">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-3" align="left">
                                    <fieldset>
                                        <label><b>เลือกอาจารย์ประจำสาขา</b></label>
                                        <select  name="select" id="select">
                                            <option value="CS">วิทยาการคอมพิวเตอร์</option>
                                            <option value="ICT">เทคโนโลยีสารสนเทศ</option>
                                            <option value="GIS">ภูมิศาสตร์สารสนเทศ</option>
                                            <option value="ALL">อาจารย์ทั้งหมด</option>
                                        </select>
                                    </fieldset>
                                    <br>
                                    <label><b>เลือกข้อมูลที่ต้องการออกรายงาน</b></label>
                                    <fieldset>
                                        <select multiple name="fromBox" id="fromBox">
                                            <option value="person_mobile">เบอร์โทรศัพท์มือถือ</option>
                                            <option value="person_fax">เบอร์โทรสาร</option>
                                            <option value="person_citizen_id">รหัสบัตรประชาชน</option>
                                            <option value="lecturer">อาจารย์ประจำสาขา</option>
                                            <option value="prefix_id">คำนำหน้าชื่อ</option>
                                            <option value="person_name_eng">ชื่อ-นามสกุล(ภาษาอังกฤษ)</option>
                                        </select>
                                        <select multiple name="toBox" id="toBox">
                                            <option value="academic_positions_abb">ตำแหน่งทางวิชาการ</option>
                                            <option value="person_name">ชื่อ-นามสกุล(ภาษาไทย)</option>
                                            <option value="person_email">อีเมล</option>

                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-3"></div>
                            </div>


                        </form>
                        <div class="btn-group"><br/>
                            <button class="btn btn-success btn-3d" id="word" ><span class="fa fa-file-word-o"></span> Word</button>
                            <button class="btn btn-success btn-3d" id="excel" ><span class="fa fa-file-excel-o"></span> Excel</button>
                        </div>

                    </center>
                    <br> <br>
                    <br>

                    <script type="text/javascript">
                        createMovableOptions("fromBox","toBox",600,300,'Available','Selected');
                    </script>


                </div>
            </div>
        </div>
    </div>

</div>
<script>
  $(document).ready(function() {
    "use strict";
    $('#excel').click(function (e) {
      e.preventDefault();
      var arayval = new Array();
      var araytext = new Array();
      var araySelect = new Array();
      var y = document.getElementById("select");
      var x = document.getElementById("toBox");
         //alert(y.value); //CS ICT GIS
      var i,j;
      var test = y.value;
        //ลูป for วนiคือเอาค่า academic_positions_abb(ค่าใน Database) วนjคือเอาค่า อีเมล (ค่าใน Select)
      for (i = 0; i < x.length; i++) {
        arayval[i] = x.options[i].value;
        // alert(arayval[i]); //academic_positions_abb
        //.value .text
      }
      for (j = 0; j < x.length; j++) {
        araytext[j] = x.options[j].text;
        // alert(araytext[j]); //อีเมล
      }
        //  alert(test);
        // ส่งค่าไปยัง Controller
      $.ajax({
          url: '../report/tobox-teacher',
          data: {
            'toVal': arayval,
            'toText': araytext,
            'toSelect': test,
          },
          type: "get",
          success: function (data) {
            if (data) {
              //alert(data);
            window.location.href ="../../ReportTeacher.xlsx";
            }
          }
        });
    });
      $('#word').click(function (e) {
          e.preventDefault();
          var arayval = new Array();
          var araytext = new Array();
          var araySelect = new Array();
          var y = document.getElementById("select");
          var x = document.getElementById("toBox");
          //alert(y.value); //CS ICT GIS
          var i,j;
          var test = y.value;
          //ลูป for วนiคือเอาค่า academic_positions_abb(ค่าใน Database) วนjคือเอาค่า อีเมล (ค่าใน Select)
          for (i = 0; i < x.length; i++) {
              arayval[i] = x.options[i].value;
              // alert(arayval[i]); //academic_positions_abb
              //.value .text
          }
          for (j = 0; j < x.length; j++) {
              araytext[j] = x.options[j].text;
              // alert(araytext[j]); //อีเมล
          }
          //  alert(test);
          // ส่งค่าไปยัง Controller
          $.ajax({
              url: '../report/tobox-teacher-word',
              data: {
                  'toVal': arayval,
                  'toText': araytext,
                  'toSelect': test,
              },
              type: "get",
              success: function (data) {
                  if (data) {
                      //alert(data);
                      window.location.href ="../../ReportTeacher.docx";
                  }
              }
          });
      });
  });
</script>
