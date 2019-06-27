<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 11/5/2561
 * Time: 0:54
 */

use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use app\modules\pms\models\PmsCompactHasExecute;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsExecuteHasCost;

?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        border: 1px solid black;
        text-align: center;
        padding: 3px !important;
    }

    td {
        border: 1px solid black;
        padding: 3px !important;

    }
    th.no{
        width: 5% !important;
    }

</style>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h3 style="display: inline-block" class="pull-left">สรุปรายงานประจำปีงบประมาณ <?=$year?></h3>
    </div>
</div>
<div class="table-responsive">
    <table id="" class="table table-bordered nomargin">
        <thead>
        <tr>
            <th class="no" width="2%">ลำดับ</th>
            <th width="20%">โครงการย่อย</th>
            <th width="20%">กิจกรรม</th>
            <th width="9%">งบประมาณ</th>
            <th width="9%">ยอดที่ใช้</th>
            <th width="10%">ยอดคงเหลือ</th>
            <th width="13%">สถานะโครงการ</th>
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
                            $status = "<span class=\"label label-success\">ดำเนินการเสร็จสิ้น</span>";
                        }else{
                            $status = "<span class=\"label label-info\">อยู่ระหว่างดำเนินการ</span>";
                        }
                    }else{
                        if($row->compact_save == "true"){
                            $status = "<span class=\"label label-info\">อยู่ระหว่างดำเนินการ</span>";
                        }else if ($row->compact_save == "false"){
                            $status = "<span class=\"label label-default\">ยังไม่ดำเนินการ</span>";
                        }else if ($row->compact_save == "true_pb"){
                            $status = "<span class=\"label label-default\">ยังไม่ดำเนินการ</span>";
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
