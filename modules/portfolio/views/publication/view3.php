<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\portfolio\models\PublicationsType;
use app\modules\portfolio\models\Project;
use app\modules\portfolio\models\ProjectSearch;
use app\modules\portfolio\models\ProjectOrder;

/* @var $this yii\web\View */



?>
<header id="page-header">
    <h1>รายละเอียดผลงานตีพิมพ์</h1>
    <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li><a href="#">ผลงานตีพิมพ</a></li>
        <li class="active">รายละเอียดผลงานตีพิมพ</li>
    </ol>
</header>
<div class="project-view">
<br><br>

    <center><?= Html::a('สร้างผลงานตีพิมพ์', ['publication-insert/create'], ['class' => 'btn btn-success']) ?></center>
    <br>

    <div class="panel-body">

        <?php /* @var $row \app\modules\portfolio\models\Publication*/
        foreach ( $query2 as $row) { ?>

            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                <thead>

                <tr>
                    <th><?php
                        echo $row->pub_name_thai;
                        echo '  &nbsp  &nbsp   &nbsp;';
                        echo  $row->pub_name_eng;


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
                    <tr>ชื่อหนังสือ/ชื่อวารสาร : <?php


                        echo $row->book_name;



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>ผู้ให้ข้อมูล : <?php


                        echo $row->dataindex;



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>
                        วันเดือนปีที่พิมพ์ :<?php  {
                            echo $row->date;

                        } ?></tr>
                    <br>
                    <tr>ประเภทผลงานตีพิมพ์ :<?php foreach ($row->publicationOrders  as $row3) {
                            //print_r($row3);
                            //  var_dump($row3);

                            //exit;
                            echo $row3->publicationsTypePubType->pub_type_name;
                        }


                        ?></tr>
                    <br>
                    <tr>    หน้าแรก-หน้าสุดท้าย :&nbsp;&nbsp;<?php   {
                            echo $row->page_number;

                        } ?></tr>

                    </tbody>

                </table>

            </div>
            <div class="col-md-4 col-sm-4">
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                    <tbody>
                    <tr>รหัสหนังสือ : <?php


                        echo $row->ISBN;



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>DOI : <?php


                        echo $row->doi;



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>
                        เล่มที่:<?php  {
                            echo $row->number;

                        } ?></tr>
                    <br>
                    <tr>ฉบับที่ :<?php
                            //print_r($row3);
                            //  var_dump($row3);

                            //exit;
                            echo $row->issuance;



                        ?></tr>
                    <br>
                    <tr>    Impact Factor :&nbsp;&nbsp;<?php
                            echo $row->impact_factor;

                         ?>&nbsp;&nbsp;</tr>

                    </tbody>

                </table>

            </div>
            <div class="box box-info box">


            <div class="col-md-3col-sm-8">
                <table >


                    <tr><h5  class="text-center">ลำดับผู้เขียน</h5></tr>



                     <th><?php foreach ($row->publicationOrders as $row2) {
                        if($row2->author_level_auth_level_id !== null) {
                            if ($row->person_id !== null) {
                                $person = Yii::$app->getDb()->createCommand('select id,person_fname_th,person_lname_th from view_pis_user WHERE id =' . $row->person_id)->queryOne();

                                echo $person['id'] . '' . $person['person_fname_th'] . '     ' . $person['person_lname_th'];
                            } else {
                               echo $row2->projectMemberProMember->member_name . '     ' . $row2->projectMemberProMember->member_lname;
                            }
                            echo ' <br/>';

                        }

                        }
                        ?></th>

                    <?php
                    foreach ($row->publicationOrders as $projectMember) {


                         if ($projectMember->authorLevelAuthLevel !== null) {
                             echo ' <center>';  echo $projectMember->authorLevelAuthLevel->auth_level_name;echo ' </center>';

                            }
                            if ($projectMember->authorLevelAuthLevel  == null)
                                echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';

                            if ($row->person_id !== null) {
                                $person = Yii::$app->getDb()->createCommand('select person_fname_th,person_lname_th from view_pis_user WHERE id =' . $row->person_id)->queryOne();
                                echo ' <center>' ;  echo $person['person_fname_th'] . '' . $person['person_lname_th'];echo ' </center>';


                            }
                           // echo '<br/>';
                        if ($projectMember->contributor_contributor_id == 1) {
                            echo ' <center>';   echo $projectMember->contributorContributor->contributor_name;echo ' </center>';


                       }else{
                                 echo ' <center>'; echo 'สมาชิก'; echo ' </center>';
                            }









                    }
                    ?>


                </table>
            </div>


            </div>
        <?php } ?>
    </div>

    <!-- /panel content -->


</div>


