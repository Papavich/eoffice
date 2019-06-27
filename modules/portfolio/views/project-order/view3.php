<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\portfolio\models\PublicationsType;

use app\modules\portfolio\models\PublicationOrder;
use app\modules\portfolio\models\Publication;
/* @var $this yii\web\View */
use yii\bootstrap\Modal;



?>
<header id="page-header">
    <h1>รายละเอียดโครงการวิจัย</h1>
    <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li><a href="#">โครงการวิจัย</a></li>
        <li class="active">รายละเอียดโครงการวิจัย</li>
    </ol>
</header>
<div class="project-view">
    <br><br>

    <center><?= Html::a('สร้างโครงการวิจัย', ['project-insert/create'], ['class' => 'btn btn-success']) ?></center>
    <?= Html::a('ออกรายงาน PDF', ['project/pdf'], ['class' => 'btn btn-primary']) ?>
    <br>

    <div class="panel-body">

        <?php /* @var $row \app\modules\portfolio\models\ProjectOrder*/
        //        print_r($query2);
        //        exit();
        foreach ( $query2 as $row) { ?>


            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">


                <thead>

                <tr>
                    <th><?php
                        echo $row->projectProject->project_name_eng;
                        echo '  &nbsp  &nbsp   &nbsp;';
                        echo $row->projectProject->project_name_eng;


                        ?></th>

                    <?php
                    // foreach ($row->proPubs !== null) {

                    // echo <a class="btn btn-xs btn-default btn-bordered" >
                    //  <i class="et-megaphone" ></i >
                    //  ผลงานตีพิมพ์</span >
                    //  </a >;
                    // } ?>

                </tr>

                </thead>

            </table>

            <div class="col-md-5 col-sm-5">
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                    <tbody>
                    <tr>หัวหน้าโครงการ :<?php

                        if($row->project_role_project_role_id = 1){
                            $person = Yii::$app->getDb()->createCommand('select person_fname_th,person_lname_th,student_fname_th,student_lname_th from view_pis_user WHERE id ='.$row->person_id)->queryOne();
//                          var_dump($person);
//
//                          exit;

                            echo $person['person_fname_th'] . '' . $person['person_lname_th'] ;
                            echo $person['student_fname_th'] . '  ' . $person['student_lname_th'] ;

                        } else {
                            echo $row->projectMemberProMember->member_name . '' . $row->projectMemberProMember->member_lname;
                        }



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>ผู้สนันสนุน <?php


                        echo $row->sponsorSponsor->sponsor_name;



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>
                        วันที่เริ่มโครงการ :<?php  {
                            echo $row->projectProject->project_start;

                        } ?></tr>
                    <br>
                    <tr>วันที่สิ้นสุดโครงการ:<?php
                        //print_r($row3);
                        //  var_dump($row3);

                        //exit;
                        echo $row->projectProject->project_end;



                        ?></tr>
                    <br>
                    <tr>    ค่าใช้จ่าย:&nbsp;&nbsp;<?php   {
                            echo $row->projectProject->repayment;

                        } ?></tr>

                    </tbody>

                </table>

            </div>
            <div class="col-md-4 col-sm-4">
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                    <tbody>
                    <tr>เว็บไซต์ : <?php


                        echo $row->projectProject->project_url;



                        ?>&nbsp;


                    </tr>
                    <br>





                    </tbody>

                </table>

            </div>
            <div class="box box-info box">


                <div class="col-md-3col-sm-8">
                    <table >






                        <th><?php
                            if($row->project_role_project_role_id !== 1) {
                                if ($row->person_id !== null) {
                                    $person = Yii::$app->getDb()->createCommand('select id,person_fname_th,person_lname_th from view_pis_user WHERE id =' . $row->person_id)->queryOne();

                                    echo $person['id'] . '' . $person['person_fname_th'] . '     ' . $person['person_lname_th'];
                                } else {
                                    echo $row->projectMemberProMember->member_name . '     ' . $row->projectMemberProMember->member_lname;
                                }
                                echo ' <br/>';



                            }
                            ?></th>

                        <?php




                        // echo '<br/>';
                        if ($row->contributor_contributor_id == 1) {

                            echo ' <center>';   echo $row->contributorContributor->contributor_name;echo ' </center>';



                        }else{
                            echo ' <center>'; echo 'สมาชิกโครงการ'; echo ' </center>';
                        }











                        ?>


                    </table>
                </div>


            </div>
        <?php  }?>
    </div>

    <!-- /panel content -->


</div>



