<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
?>

<div id="panel-1" class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong class="size-20">การจัดกรรมการคุมสอบ</strong> <!-- panel title -->
      </span>

    </div>
    <!-- panel content -->
    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-body">
        <strong style="padding-left: 18px;">ช่วงเวลาการจัดกรรมการคุมสอบ</strong>
        <div style="padding-left: 250px;">
            <div class="row">

                <div class="col-md-3">
                    <input type="text" name="startDate" id="startDate" class="form-control datepicker" value='<?php echo $exam_detail_date_start;?>' data-format="yyyy-mm-dd" data-lang="en"  data-RTL="false">
                </div>

                <div class="col-md-1">
                    <strong><center>ถึง</center></strong><br/>
                </div>

                <div class="col-md-3">
                    <input type="text" name="endDate" id="endDate" class="form-control datepicker" value="<?php echo $exam_detail_date_end; ?>" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <div style="margin-left: 430px;">
            <?= Html::a('ยืนยัน', ['process'], ['class'=>'btn btn-success btn-lg','data-method' => 'post']) ?>
        </div>

        <!--
              <br/><br/><br/><div id="chartContainer" style="height: 300px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                  </body>

            </div>
        </div> -->
        <?php ActiveForm::end(); ?>
        <script>
            window.onload = function () {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                    title:{
                        text: "กราฟแสดงการจัดกรรมการคุมสอบ"
                    },
                    axisY: {
                        title: "จำนวนห้อง"
                    },
                    data: [{
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        legendText: "วันที่สอบ",
                        dataPoints: [
                            { y: 20, label: "2/02/2018" },
                            { y: 15,  label: "3/02/2018" },
                            { y: 25,  label: "4/02/2018" },
                            { y: 15,  label: "5/02/2018" },
                            { y: 20,  label: "10/02/2018" },
                        ]
                    }]
                });
                chart.render();

            }
            //daterangepicker
            $(document).ready(function(){

                $("#startdate").datepicker({
                    todayBtn:  1,
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                    $('#enddate').datepicker('setStartDate', minDate);
                });

                $("#enddate").datepicker()
                    .on('changeDate', function (selected) {
                        var maxDate = new Date(selected.date.valueOf());
                        $('#startdate').datepicker('setEndDate', maxDate);
                    });

            });
            //daterangepicker
        </script>
