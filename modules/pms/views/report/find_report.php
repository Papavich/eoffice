<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 26/4/2561
 * Time: 19:18
 */

use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsCompactHasExecute;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsExecuteHasCost;
use app\modules\pms\models\PmsProjectSub;
use app\modules\pms\models\PmsProjectsubBudget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<?php
function YearThai($strDate){
    $result = validateDate($strDate);
    if($result == true){
        $dateTh = Yii::$app->formatter->asDate($strDate, 'medium');
        $date = substr($dateTh, -4,4);
        $year = $date+543;
        $reDate = str_replace($date,$year,$dateTh);
        return $reDate;
    }else{
        $strDate = Yii::$app->formatter->asDate($strDate, 'medium');
        return $strDate;
    }
}
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
$this->registerJsFile('@web/web_pms/js/find_report.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?=Html::csrfMetaTags()?>
<header id="page-header">
    <h1><strong>ออกรายงาน</strong></h1>
</header>
<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <form action="../report/findreport" method="post" id="find_report">
                        <div class="row">
                            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />

                            <div class="col-md-3 col-sm-3">
                                <select class="form-control " name="format" id="format">
                                    <option value="">เลือกรูปแบบรายงาน</option>
                                    <option value="1">เสนอโครงการ</option>
                                    <option value="2">ขอจัดโครงการ</option>
                                    <option value="3">ขอใช้งบประมาณ</option>
                                    <option value="4">ขอจัดโครงการและใช้งบประมาณ</option>
                                    <option value="5">สรุปโครงการ</option>
                                    <option value="6">รายงานประจำปี</option>
                                </select>
                                <span class='pull-right' style='color: #a94442' id="format_alert"><span>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <select class="form-control select2" name="year" id="year">
                                    <option value="">เลือกปีงบประมาณ</option>
                                    <?php
                                    $date  = date("Y")+545;
                                    for ($i = 2560;$i < $date;$i++){
                                        echo "<option value='".$i."'>".$i."</option>";
                                    }
                                    ?>
                                </select>
                                <span class='pull-right' style='color: #a94442' id="year_alert"><span>
                            </div>
                            <div class="col-md-6 col-sm-6" id="report_hide">
                                <select class="form-control select2" name="id" id="id">

                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <button type="submit" id="find" class="btn btn-info" href="" target="_blank"><i
                                            class="fa fa-search"></i> ค้นหา</button>
                            </div>
                        </div>
                    </form>
                    <?php
                        if(isset($format) && isset($year)){
                            if($format == 1){
                                echo "<h3>รายงานเสนอโครงการ ปีงบประมาณ ".$year."</h3>";
                            }else if ($format == 2){
                                echo "<h3>รายงานขอจัดโครงการ ปีงบประมาณ ".$year."</h3>";
                            }else if ($format == 3){
                                echo "<h3>รายงานขอใช้งบประมาณ ปีงบประมาณ ".$year."</h3>";
                            }else if ($format == 4){
                                echo "<h3>รายงานขอจัดโครงการและใช้งบประมาณ ปีงบประมาณ ".$year."</h3>";
                            }else if ($format == 5){
                                echo "<h3>รายงานสรุปโครงการ ปีงบประมาณ ".$year."</h3>";
                            }
                        }else{
                            echo "<h3>รายงานเสนอโครงการ ปีงบประมาณ ".$yearNow."</h3>";
                        }
                    ?>
                <?php

                if($dataList) {
                    if(isset($format) && $format == 6){
                        ?>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h3 style="display: inline-block" class="pull-left">สรุปรายงานประจำปีงบประมาณ <?=$year?></h3>
                                <a class="btn btn-danger btn-3d pull-right" href="../report/report-of-year?year=<?=$year?>"><i class="fa fa-file-pdf-o"></i>pdf</a>
                            </div>
                        </div>
                       <div class="table-responsive">
                            <table id="table_reportOfYear" class="table table-bordered nomargin">
                                <thead>
                                <tr>
                                    <th width="2%">ลำดับ</th>
                                    <th width="20%">โครงการย่อย</th>
                                    <th width="20%">กิจกรรม</th>
                                    <th width="9%">งบประมาณ</th>
                                    <th width="9%">ยอดที่ใช้</th>
                                    <th width="10%">ยอดคงเหลือ</th>
                                    <th width="11%">สถานะโครงการ</th>
                                    <th>ผู้รับผิดชอบโครงการ</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $round = 0;
                                    foreach ($dataList as $key => $row){
                                        $Execute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$row->prosub_code])->all();

                                        if($Execute){
                                            $rowExecute = sizeof($Execute);
                                            $first = 0;
                                            $round = $round +1;

                                            foreach ($Execute as $row_execute){
//                                                $command = Yii::$app->get('db_pms')->createCommand("SELECT SUM(budget_limit) FROM pms_projectsub_budget WHERE pms_projectsub_budget.pms_project_sub_prosub_code = '".$row_prosub->prosub_code."'");
//                                                $sumCostLimit = $command->queryScalar();
                                                $costCompact = 0;
                                                $modelCost = PmsExecuteHasCost::find()->where(['pms_execute_execute_id'=>$row_execute->execute_id])->all();
                                                if($modelCost){
                                                    foreach ($modelCost as $row_cost){
                                                        $costCompact = $costCompact + $row_cost->cost;
                                                    }
                                                }



                                                $costResult = $row_execute->execute_cost-$costCompact;

                                                //------- status execute start
                                                $status = "";
                                                $comHasExecute = PmsCompactHasExecute::find()->where(['pms_execute_execute_id'=>$row_execute->execute_id])->one();
                                                if($comHasExecute){
                                                    $comHasPro = PmsCompactHasProsub::findOne($comHasExecute->pms_compact_has_prosub_id);
                                                    if($comHasPro->status_result == "เสร็จสิ้น") {
                                                        $status = "<span class=\"label label-success\" style='width: 100px;display: inline-block'>ดำเนินการเสร็จสิ้น</span>";
                                                    }else{
                                                        $status = "<span class=\"label label-info\" style='width: 100px;display: inline-block'>อยู่ระหว่างดำเนินการ</span>";
                                                    }
                                                }else{
                                                    if($row->compact_save == "true"){
                                                        $status = "<span class=\"label label-info\" style='width: 100px;display: inline-block'>อยู่ระหว่างดำเนินการ</span>";
                                                    }else if ($row->compact_save == "false"){
                                                        $status = "<span class=\"label label-default\" style='width: 100px;display: inline-block'>ยังไม่ดำเนินการ</span>";
                                                    }else if ($row->compact_save == "true_pb"){
                                                        $status = "<span class=\"label label-default\" style='width: 100px;display: inline-block'>ยังไม่ดำเนินการ</span>";
                                                    }
                                                }




                                                //-------- status execute end


                                                $datar = EofficeCentralViewPisUser::find()->where(['id'=>$row->prosub_responsible_id])->one();
                                                if($first == 0){
                                                    echo "<tr><td rowspan='".$rowExecute."'>".$round."</td><td rowspan='".$rowExecute."'>".$row->prosub_name."</td><td>".$row_execute->execute_name."</td><td>".number_format($row_execute->execute_cost)."</td><td>".number_format($costCompact)."</td><td>".number_format($costResult)."</td><td>".$status."</td><td rowspan='".$rowExecute."'>".$datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th."</td></tr>";
                                                }else{
                                                    echo "<tr><td>".$row_execute->execute_name."</td><td>".number_format($row_execute->execute_cost)."</td><td>".number_format($costCompact)."</td><td>".number_format($costResult)."</td><td>".$status."</td></tr>";
                                                }
                                                $first++;
                                            }
                                        }
                                    }
                                ?>


                                </tbody>
                            </table>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="row margin-top-20">
                            <div class="col-md-12">

                                <table id="table_report"class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="15%">วันที่จัดโครงการ</th>
                                        <th width="35%">ชื่อโครงการ</th>
                                        <th width="15%">สถานะโครงการ</th>
                                        <th width="15%">ผู้รับผิดชอบโครงการ</th>
                                        <th width="10%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($dataList as $row) {
                                        ?>
                                        <tr>
                                            <td><?php
                                                if(isset($format)){
                                                    if($format == 1){
                                                        echo YearThai($row['prosub_start_date']);
                                                    }else if($format == 2){
                                                        echo YearThai($row['compact_start_date']);
                                                    }else if($format == 3){
                                                        echo "ครั้งที่ ".$row['round']." ".YearThai($row['compact_start_date']);
                                                    }else if($format == 4){
                                                        echo "ครั้งที่ ".$row['round']." ".YearThai($row['start_date']);
                                                    }else if($format == 5){
                                                        if($row['start_date'] == null){
                                                            echo "ครั้งที่ ".$row['round']." ".YearThai($row['prosub_start_date']);
                                                        }else{
                                                            echo "ครั้งที่ ".$row['round']." ".YearThai($row['start_date']);
                                                        }
                                                    }
                                                }else{
                                                    echo YearThai($row['prosub_start_date']);
                                                }
                                                ?></td>
                                            <td><?=$row['prosub_name']?></td>
                                            <td><?php
                                                if(isset($format)){
                                                    if($format == 1){
                                                        echo $row['prosub_status_offer'];
                                                    }else if($format == 2){
                                                        echo $row['prosub_status_place'];
                                                    }else if($format == 3){
                                                        echo $row['status_finance'];
                                                    }else if($format == 4){
                                                        echo $row['status_pandf'];
                                                    }else if($format == 5){
                                                        echo $row['status_result'];
                                                    }
                                                }else{
                                                    echo $row['prosub_status_offer'];
                                                }

                                                ?></td>
                                            <td>
                                                <?php
                                                $datar = EofficeCentralViewPisUser::find()->where(['id'=>$row['prosub_responsible_id']])->one();
                                                echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if(isset($format)){
                                                    if($format == 1){?>
                                                        <a href="../report/prosub?id=<?=$row['prosub_code']?>"><i class="glyphicon glyphicon-eye-open"></i></a>

                                                        <?php
                                                    }else if($format == 2){
                                                        ?>
                                                        <a href="../report/compactplace?id=<?=$row['prosub_code']?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                        <?php
                                                    }else if($format == 3){
                                                        ?>
                                                        <a href="../report/compactbudget?id=<?=$row['prosub_code']?>&compact=<?=$row['id']?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                        <?php
                                                    }else if($format == 4){
                                                        ?>
                                                        <a href="../report/compactpandb?id=<?=$row['prosub_code']?>&compact=<?=$row['id']?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                        <?php
                                                    }else if($format == 5){
                                                        ?>
                                                        <a href="../report/prosubresult?id=<?=$row['prosub_code']?>&id_compact=<?=$row['id']?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                        <?php
                                                    }
                                                }else{
                                                    ?>
                                                    <a href="../report/prosub?id=<?=$row['prosub_code']?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                    <?php
                                                }?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <?php

                    }

                    ?>



                <?php


                }else{
                    echo "<h2 class='text-center' style='color: #a94442'>ไม่พบข้อมูล!</h2>";
                }
                ?>


                </div>
            </div>
        </div>
    </div>
</div>
