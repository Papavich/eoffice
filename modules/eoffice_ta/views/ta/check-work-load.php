<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 9/9/2560
 * Time: 22:57
 */
use app\modules\eoffice_ta\models\Subject;
use app\modules\eoffice_ta\models\TaRegisterSubject;
use app\modules\eoffice_ta\models\TaRegisterSection;
use app\modules\eoffice_ta\models\Person;
use app\modules\eoffice_ta\models\TaWorkLoad;

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\assets\AppAssetAsset;
AppAssetAsset::register($this);
?>

<div id="panel-1" class="panel panel-info">
    <div class="panel-heading">

							<span class="elipsis"><!-- panel title -->
								<strong>ตรวจสอบภาระงาน TA </strong>
							</span>

        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
        </ul>
        <!-- /right options -->



        <div class="col-md-4 col-lg-12">
            <div class="table-responsive"><br> <br>
                <table class="table table-bordered table-vertical-middle nomargin" width="40">
                    <thead>
                    <tr class="info">
                        <th  width="1%"><center>ลำดับ</center></th>
                        <th  width="10%"><center>วิชา</center></th>
                        <th  width="3%"><center>หน่วยกิต</center></th>
                        <th  width="5%"><center>อาจารย์ผู้สอน</center></th>
                        <th  width="20%"><center>ดูภาระงาน</center></th>

                    </tr>
                    </thead>
                    <?php

                    $subjs = Subject::find()->all();
                    $n=1;

                    foreach ($subjs as $subj ){

                        ?>
                        <tbody>
                        <tr>
                            <td align="center"><?= $n?></td>
                            <td ><?php $teacher=$subj->teacher?>
                                <?= $subj->subject_id?>&nbsp;&nbsp; <?= $subj->subject_name?>
                            </td>

                            <td align="center"><?= $subj->credit?></td>

                            <td align="center">
                                <?php $secs = Person::find()->where(['Person_id'=>$teacher])->all();
                                foreach ($secs as $sec) {?>
                                    <?= "<span class='label label-warning size-14'>".$sec->prefix." ".$sec->fname_th. " ".$sec->lname_th."</span>";?>

                                <?php }?>
                            </td>
                        <?php
                        $regsubs = TaRegisterSubject::find()->where(['subject_id'=>$subj->subject_id])->all();
                        foreach ($regsubs as $regsub) {

                            ?>
                            <td align="center">


                                    <?php
                                    $Wloads = TaWorkLoad::find()->where(['ta_register_subject_id'=>$regsub->ta_register_subject_id])->all();
                                    foreach ($Wloads as $Wload) {  ?>
                                        <?php if(empty($Wload)){  ?>

                                            <?php
                                            // $wid= $Wload->ta_register_subject_id;
                                        } }
                                    if (!empty($Wloads)){ // เช็คว่าวิชานี้ได้แจ้งภาระงานหรือยัง กรณีถ้าแสดงเงื่อนไขนี้แสดงว่ายังไม่แจ้งภาระงาน?>

                                        <a href="<?= Url::to(['ta-work-load/work-load-view','id'=>$Wload->ta_work_load_id]) ?>" class='btn btn-3d btn-reveal btn-brown'>
                                            <i class='glyphicon glyphicon-briefcase'></i><span>ดูภาระงาน</span></a><br>
                                    <?php }else{
                                        ?>
                                        <a href="" class='btn btn-3d btn-reveal btn-danger'>
                                            <i class='glyphicon glyphicon-exclamation-sign'></i><span>ยังไม่แจ้งภาระงาน</span></a>
                                    <?php }?>

                            </td>
                            <?php } ?>
                        </tr>
                        <?php  $n++;?>
                        </tbody>

                    <?php

                    }?>

                </table>

            </div>
            <br><br>
        </div>

    </div>

    <!-- panel content -->

</div>
