<?php
//
//
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;
//use kartik\depdrop\DepDrop;
//// use kartik\widgets\DepDrop;
//use yii\widgets\DetailView;
//use yii\helpers\Url;
//use yii\helpers\Json;
//use app\modules\eoffice_repair\models\RepairDescription;
////use yii\bootstrap\ActiveField;
?>
<!-- Sales Chart -->
<div id="panel-graphs-flot-c1" class="panel panel-default">
    <div class="panel-heading">
            <span class="elipsis"><!-- panel title -->
            <strong> สถิติการแจ้งซ่อม </strong>
            </span>
    </div>
</div>

<?php
$data = array(
    '1' => $assetCount[0]['COUNT'],
    '2' => $assetCount[1]['COUNT'],
    '3' => $assetCount[2]['COUNT'],
    '4' => $assetCount[3]['COUNT'],
    '5' => $assetCount[4]['COUNT'],
    '6' => $assetCount[5]['COUNT'],
    '7' => $assetCount[6]['COUNT'],
    '8' => $assetCount[7]['COUNT'],
    '9' => $assetCount[8]['COUNT'],
    '10' => $assetCount[9]['COUNT'],
);
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
                text: 'แบ่งตามประเภทของครุภัณฑ์'
            },
            xAxis: {
                categories: [
                    'เครื่องแสกนบัตร',
                    'เครื่องคอมพิวเตอร์สมรรถนะสูง',
                    'โต๊ะ',
                    'อุปกรณ์ Workgroup Switch แบบที่ 1',
                    'อุปกรณ์ กล้องแบบไอพี เครือข่าย',
                    'คอมพิวเตอร์ตั้งโต๊ะ',
                    'คอมพิวเตอร์ตั้งโต๊ะAser',
                    'ชักโครก',
                    'ประตูห้อง',
                    'คอมพิวเตอร์พกพา',
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
                name: 'ครุภัณฑ์',
                data: [<?php echo $mydata; ?>]
            }]
        });
    });


</script>
    <P>
        <?= Html::a('EXCEL', ['excel'], ['class' => 'btn btn-danger  pull-right']) ?>
    </P>
