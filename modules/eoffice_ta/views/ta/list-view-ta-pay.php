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

<div id="panel-1" class="panel panel-default">
    <div class="panel-heading">

							<span class="elipsis"><!-- panel title -->
								<strong>ตรวจสอบค่าตอบแทน TA </strong>
							</span>

        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
            <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
            <li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
        </ul>
        <!-- /right options -->


    </div>

    <!-- panel content -->

    <div class="panel-body">

        <div class="col-md-6 col-lg-6">

            <!-- ค้นหา -->
            <div class="col-md-3 col-sm-5">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ปีการศึกษา</strong><br><br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>  ภาคเรียน</strong>
                <br><br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>สาขา</strong>
            </div>
            <div class="col-md-8 col-sm-6">
                <!-- classic select2 -->
                <select class="form-control select2">
                    <option value="">----- ปีการศึกษา -----</option>
                    <option value="1">2560</option>
                    <option value="2">2559</option>
                    <option value="3">2558</option>
                </select>
                <br> <br>
                <select class="form-control select2">
                    <option value="">----- ภาคเรียน -----</option>
                    <option value="1">1/2559</option>
                    <option value="2">2/2559</option>
                    <option value="3">1/2560</option>
                    <option value="3">2/2560</option>
                </select>
                <br><br>

                <select class="form-control select2">
                    <option value="">-----  สาขา -----</option>
                    <option value="1">CS</option>
                    <option value="2">IT</option>
                    <option value="3">GIS</option>
                </select>

            </div>

        </div>

        <div class="col-md-4 col-lg-12">
            <div class="table-responsive"><br> <br>
                <table class="table table-bordered table-vertical-middle nomargin" width="40">
                    <thead>
                    <tr class="info">
                        <th  width="1%"><center>ลำดับ</center></th>
                        <th  width="10%"><center>วิชา</center></th>
                        <th  width="3%"><center>หน่วยกิต</center></th>
                        <th  width="5%"><center>อาจารย์ผู้สอน</center></th>
                        <th  width="20%"><center>ดูรายละเอียด</center></th>

                    </tr>
                    </thead>
                    <?php

                    $regissubjs = Subject::find()->all();
                    $n=1;

                    foreach ($regissubjs as $subj ){

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
                            <td align="center">
                                <a href="<?= Url::to(['list-ta-pay-by-subject','id'=>$subj->subject_id]) ?>">
                                    <img src='http://icons.iconarchive.com/icons/paomedia/small-n-flat/64/post-it-icon.png' width='40em'>
                                </a>
                            </td>


                        </tr>
                        <?php  $n++;?>
                        </tbody>

                        <?php

                    }?>

                </table>

            </div>
            <br><br>
        </div>

