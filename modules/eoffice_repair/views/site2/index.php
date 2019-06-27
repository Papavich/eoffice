<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
// use kartik\widgets\DepDrop;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\Json;
//use yii\bootstrap\ActiveField;


//$this->registerJsFile('@path_assetmodule/repair.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


?>


<!-- <div class="panel panel-primary">
    <div class="panel-heading panel-heading-transparent">
        <strong>หน้าหลัก</strong>
    </div>
</div> -->

<!-- Sales Chart -->
<div id="panel-graphs-flot-c1" class="panel panel-default">
    <div class="panel-heading">
		<span class="elipsis"><!-- panel title -->
			<strong>สถิติการแจ้งซ่อม</strong>
        </span>
    <?php
        $data = array(
            '1' => $month1,
            '2' => $month2,
            '3' => $month3,
            '4' => $month4,
            '5' => $month5,
            '6' => $month6,
            '7' => $month7,
            '8' => $month8,
            '9' => $month9,
            '10' => $month10,
            '11' => $month11,
            '12' => $month12);
        $mymonth = "";
        $mydata = "";
        $i = 1;
        $j = count($data);
        foreach ($data as $k => $v) {
            if ($i < $j) {
                $c = ",";
            } else {
                $c = "";
            }
            $mymonth .= $k . $c;
            $mydata .= $v . $c;
            $i++;
        }
        ?>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <div id="chart_container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <script>
            $(function () {
                $('#chart_container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'กราฟแสดงจำนวนการแจ้งซ่อม'
                    },
                    subtitle: {
                        text: 'แบ่งตามเดือน'
                    },
                    xAxis: {
                        categories: [
                            'January',
                            'February',
                            'March',
                            'April',
                            'May',
                            'June',
                            'July',
                            'August',
                            'September',
                            'October',
                            'November',
                            'December'
                        ],
                    },
                    yAxis: [{
                        min: 0,
                        title: {
                            text: 'จำนวนการแจ้งซ่อม (ครั้ง)'
                        }
                    }],
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} ครั้ง</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Month',
                        data: [<?php echo $mydata; ?>]
                    }]
                });
            });


        </script>
</div></div>
<div>hi</div>
