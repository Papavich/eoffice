
<!-- page title -->
<header id="page-header">
    <h1><?= \app\modules\personsystem\controllers::t( 'label','Report Staff'); ?></h1>
    <ol class="breadcrumb">
        <li><a href="#">Report</a></li>
        <li class="active">Report Staff Infomation</li>
    </ol>
</header>
<!-- /page title -->
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <center>
                        <form method="post" action="multiple_select.html" onsubmit="multipleSelectOnSubmit()">
                            <fieldset>
                                <select multiple name="fromBox" id="fromBox">
                                    <option value="person_mobile" >เบอร์โทรศัพท์มือถือ</option>
                                    <option value="person_fax" >เบอร์โทรสาร</option>
                                    <option value="person_email" >อีเมล</option>
                                    <option value="person_position_type">ตำแหน่ง</option>
                                    <option value="person_citizen_id" >รหัสบัตรประชาชน</option>
                                </select>
                                <select multiple name="toBox" id="toBox">
                                    <option value="person_name" >ชื่อ-นามสกุล(ภาษาไทย)</option>
                                    <option value="person_name_eng" >ชื่อ-นามสกุล(ภาษาอังกฤษ)</option>
                                    <option value="prefix_id" >คำนำหน้า</option>

                                </select>
                            </fieldset>
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
      var x = document.getElementById("toBox");
      //alert(y.value); //CS ICT GIS
      var i,j;


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
        url: '../report/tobox-staff',
        data: {
          'toVal': arayval,
          'toText': araytext,

        },
        type: "get",
        success: function (data) {
          if (data) {
            //alert(data);
            window.location.href ="../../ReportStaff.xlsx";
          }
        }
      });
    });
      $('#word').click(function(e){
          e.preventDefault();

          var arayval = new Array();
          var araytext = new Array();
          var araySelect = new Array();
          var x = document.getElementById("toBox");
          //alert(y.value); //CS ICT GIS
          var i,j;


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
              url: '../report/tobox-staff-word',
              data: {
                  'toVal': arayval,
                  'toText': araytext,

              },
              type: "get",
              success: function (data) {
                  if (data) {
                      //alert(data);
                      window.location.href ="../../ReportStaff.docx";
                  }
              }
          });
      });
      });
</script>
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