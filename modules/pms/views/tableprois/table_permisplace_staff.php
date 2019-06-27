<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 8/3/2561
 * Time: 15:22
 */
?>

<?php

use app\modules\pms\models\LogPermisInSystem;
use app\modules\pms\models\model_main\EofficeCentralViewPisUser;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

?>
<?=HTML::csrfMetaTags()?>

<header id="page-header">
    <h1>โครงการที่รออนุมัติจัดโครงการ</h1>
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

    ?>
</header>
<style>
    nav.pagination-container {
        text-align: center;
        padding-top: 2px;
    }
</style>


<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="col-md-12" style="margin-top: 20px">
                        <table id="table_compact_place" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="15%">วันที่จัดโครงการ</th>
                                <th width="30%">ชื่อโครงการ</th>
                                <th width="10%">หมายเหตุ</th>
                                <th width="20%">ผู้รับผิดชอบโครงการ</th>
                                <th width="10%"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($prosub as $key => $rows){
                                if($rows['prosub_status_place']=="รอฝ่ายพัฒนานักศึกษาตรวจสอบ") {
                                    $i = $key + 1;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo YearThai($rows['compact_start_date']);
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?= $rows['prosub_name'] ?>
                                        </td>
                                        <td>
                                            <span>
                                                <?php
                                                $comment = LogPermisInSystem::find()->where(['pms_project_sub_prosub_code'=>$rows['prosub_code'],'status_process'=>2])->orderBy(['id'=>SORT_DESC])->one();
                                                if($comment){
                                                    echo $comment->comment;
                                                }
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $datar = EofficeCentralViewPisUser::find()->where(['id'=>$rows['prosub_responsible_id']])->one();
                                            echo $datar->PREFIXNAME.$datar->person_fname_th." ".$datar->person_lname_th;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo "<a href=\"../detailcompactplace/detail-staff?id=".$rows['prosub_code']."\"><i class=\"glyphicon glyphicon-eye-open\"></i></a> ";
?>
                                            | <a href="../permissionplace/permis-staff?id=<?=$rows['prosub_code']?>"><i class="glyphicon glyphicon-check"></i></a>
                                            </td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="showstatus" role="dialog" hidden="">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 850px;">
                        <div class="modal-body">
                            <table class="table table-striped">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th width="25%">สถานะ</th>
                                        <th width="25%">วันที่</th>
                                        <th width="20%">ผู้ดำเนินการ</th>
                                        <th width="30%">หมายเหตุ</th>
                                    </tr>
                                    </thead>
                                    <tbody id="show_status">


                                    </tbody>
                                </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

