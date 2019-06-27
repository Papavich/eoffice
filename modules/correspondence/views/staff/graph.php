<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\correspondence\models\CmsDocType;
use app\modules\correspondence\controllers;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . '- รายงานหนังสือ';

function Start($strDate)
{
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));

    return "$strDay $strMonth $strYear $strHour:$strMinute";
}

?>
<?php

?>
    <style>
        .input-group-addon {
            background-color: #e3e3e3;
            border: 2px solid grey;
        }

        .input-group-addon:last-child {
            border: 2px solid grey;
            border-radius: 5px 5px 5px 5px;
        }
    </style>
    <section id="middle" style="color: black">
        <div id="content" class="padding-30">
            <div id="panel-2" class="panel panel-default">
                <div class="panel-heading">
                <span class="title elipsis">
                    <strong><?= controllers::t('menu', 'The report documents') ?></strong> <!-- panel title -->
                </span>
                </div>
                <?php
                date_default_timezone_set("Asia/Bangkok");

                $dateend = date("Y-m-d H:i:s"); ?>
                <div class="panel-body" align="center">
                    <!--<select class="form-control">
                        <?php
/*                        $person = \app\modules\correspondence\models\ViewTest::find()->all();
                        foreach ($person as $item) {
                            echo "<option value='" . $item['person_id'] . "'>" . $item['person_name']. " &nbsp &nbsp".$item['person_surname'] . "</option>";
                        }
                        */?>
                    </select>-->
                    <br>

                        <form class="form-inline" method="get">


                            <!--date picker-->


                                <script type="text/javascript">

                                    $(function(){
                                        $("#dateStart").datetimepicker({
                                            dateFormat: 'yy-mm-dd',
                                            timeFormat: 'HH:mm:ss'

                                        });
                                        $("#dateEnd").datetimepicker({
                                            dateFormat: 'yy-mm-dd',
                                            timeFormat: 'HH:mm:ss'

                                        });
                                    });

                                </script>
                               <!-- <input type="text" name="dateInput" id="dateInput" value="" />-->


                            <div class="form-group">
                                <label><?= controllers::t('menu', 'Book Date') ?> : </label>
                                <input type="text" class="form-control dategraph input-group-addon"
                                       placeholder="ตั้งแต่"
                                       name="dateStart" id="dateStart">
                            </div>
                            <div class="form-group">
                                <label><?= controllers::t('menu', 'To') ?> : </label>
                                <input type="text" class="form-control dategraph input-group-addon"
                                       placeholder="ถึง"
                                       id="dateEnd" name="dateEnd">
                            </div>
                            <div class="form-group" id="searchByType">
                                <label><?= controllers::t('menu', 'Document type') ?> : </label>
                                <select class="form-control" id="booktype" name="booktype">
                                    <option value=1>หนังสือรับ</option>
                                    <option value=2>หนังสือส่ง</option>
                                    <option value=3>หนังสือทำลาย</option>
                                </select>
                            </div>
                            <div class="form-group" id="searchBySubType">
                                <label><?= controllers::t('menu', 'Category') ?> : </label>
                                <select class="form-control" id="subtype" name="subtype">
                                    <option value="ทั้งหมด">ทั้งหมด</option>
                                    <?php
                                    $type = \app\modules\correspondence\models\CmsDocSubType::find()->all();
                                    foreach ($type as $item) {
                                        echo "<option value='" . $item['sub_type_name'] . "'>" . $item['sub_type_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>

                    <br>
                    <div class="form-group" id="SelectTypeFile">
                        <label class="control-label " style="text-align: center; "><?= controllers::t('menu', 'Select file') ?>: </label>

                            <?= Html::a(' <i class="fa fa-file-excel-o" style="font-size:40px;color:green"></i>', ['excel'], ['class' => '','target' => '_blank']) ?>
                            <?= Html::a(' <i class="fa fa-file-pdf-o"  style="font-size:40px;color:red"></i>', ['pdf'], ['class' => '','target' => '_blank']) ?>

                    </div>
                    <div class="form-group">

                        <button type="button" class="btn btn-success" name="createReport" id="createReport"><?= controllers::t('menu', 'Report now') ?>
                        </button>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover editTable" id="graph" style="font-size: 16px;">

                    </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php

$this->registerJs(<<<JS
    $('.example').DataTable();

     ///set format datetimepicker2
  /* $('#dateStart').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
    $('#dateEnd').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });    */
     var count = 0,iNum,xx;
        function calDate(){
            var fromDate = $('#dateStart').val(),
                toDate = $('#dateEnd').val(),
                from, to, druation;
            xx = fromDate;
            from = moment(fromDate, 'YYYY-MM-DD'); // format in which you have the date
            to = moment(toDate, 'YYYY-MM-DD');     // format in which you have the date

            /* using diff */
            duration = to.diff(from, 'days')
            iNum = parseInt(duration) + 1;
            /* show the result */
            //$('#result').text(duration + ' days');
                        

        }
        $("#SelectTypeFile").hide();
        //Enable check and uncheck all functionality
        $("#createReport").click(function () {
            if($("#dateStart").val() == "" && $("#dateEnd").val() == ""){
                alert("กรุณาระบุวันที่ที่ท่านต้องการออกรายงาน");
            }else{
                $("#SelectTypeFile").show();
                //$("#createReport").hide();
                count++;
                calDate();


            }
        });

        $('#dateStart').bind('input',function(){
            $('#dateEnd').bind('input',function(){
                calDate();
            });

        });
        $("#createReport").click(function(){
               var datestart =  $('#dateStart').val();
                var dateend=  $('#dateEnd').val();
                 var booktype =  $('#booktype').val();
                 var subtype = $('#subtype').val();
            $.ajax({
                url: '../staff/graphsearch',
                data: {
                    'datestart': datestart,
                    'dateend': dateend,
                    'booktype': booktype,
                    'subtype': subtype
                },
                type: "get",
                beforeSend: function(){
                     $('#graph').html('');
                },
                success: function(data){
                    if(data){
                        $('#graph').html(data);
                       
                    }
                }
            });
        });

JS
);
?>