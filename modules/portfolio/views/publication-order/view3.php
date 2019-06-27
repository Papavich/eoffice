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
    <h1>รายละเอียดผลงานตีพิมพ์</h1>
    <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li><a href="#">ผลงานตีพิมพ์</a></li>
        <li class="active">รายละเอียดผลงานตีพิมพ์</li>
    </ol>
</header>
<div class="project-view">
<br><br>

    <center><?= Html::a('สร้างผลงานตีพิมพ์', ['publication-insert/create3'], ['class' => 'btn btn-success']) ?></center>
    <br>

    <div class="panel-body">

        <?php /* @var $row \app\modules\portfolio\models\PublicationOrder*/
        foreach ( $query2 as $row) { ?>

            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">


                <thead>

                <tr>
                    <th><?php
                        echo $row->publicationPub->pub_name_thai;
                        echo '  &nbsp  &nbsp   &nbsp;';
                        echo  $row->publicationPub->pub_name_eng;


                         ?></th>
                  <th>
                    <?php
                    echo '<center>';
                    if($row->publications_type_pub_type_id === 1) {
                        echo '<a class="btn btn-xs btn-default btn-bordered" >
                            <i class="et-megaphone" ></i >
                             บทความทางวิชาการ</span >
                           </a >';

                    }
                    else {
                        echo '<a class="btn btn-xs btn-default btn-bordered" >
                            <i class="et-megaphone" ></i >
                             การประชุมวิชาการ</span >
                           </a >';
                    } echo '</center>';
                    ?>
                  </th>
                </tr>

                </thead>

            </table>

            <div class="col-md-5 col-sm-5">
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                    <tbody>
                    <tr>ชื่อหนังสือ/ชื่อวารสาร : <?php


                        echo $row->publicationPub->book_name_thai; echo '<br/>';



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>ผู้ให้ข้อมูล : <?php


                        echo $row->publicationPub->dataindex;



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>
                        วันเดือนปีที่พิมพ์ :<?php  {
                            echo $row->publicationPub->date;

                        } ?></tr>
                    <br>
                    <tr>ประเภทผลงานตีพิมพ์ :<?php
                            //print_r($row3);
                            //  var_dump($row3);

                            //exit;
                            echo $row->publicationsTypePubType->pub_type_name;



                        ?></tr>
                    <br>
                    <tr>    หน้าแรก-หน้าสุดท้าย :&nbsp;&nbsp;<?php   {
                            echo $row->publicationPub->page_number;

                        } ?></tr>

                    </tbody>

                </table>

            </div>
            <div class="col-md-4 col-sm-4">
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                    <tbody>
                    <tr>รหัสหนังสือ : <?php


                        echo $row->publicationPub->ISBN;



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>DOI : <?php


                        echo $row->publicationPub->doi;



                        ?>&nbsp;


                    </tr>
                    <br>

                    <tr>
                        เล่มที่:<?php  {
                            echo $row->publicationPub->number;

                        } ?></tr>
                    <br>
                    <tr>ฉบับที่ :<?php
                            //print_r($row3);
                            //  var_dump($row3);

                            //exit;
                            echo $row->publicationPub->issuance;



                        ?></tr>
                    <br>
                    <tr>    Impact Factor :&nbsp;&nbsp;<?php
                            echo $row->publicationPub->impact_factor;

                         ?>&nbsp;&nbsp;</tr>

                    </tbody>

                </table>

            </div>
            <div class="box box-info box">


            <div class="col-md-3col-sm-8">
                <table >


                    <tr><h5  class="text-center">ลำดับผู้เขียน</h5></tr>



                     <th><?php
                        if($row->author_level_auth_level_id !== null) {
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



                         if ($row->authorLevelAuthLevel !== null) {
                             echo ' <center>';  echo $row->authorLevelAuthLevel->auth_level_name;echo ' </center>';

                            }
                            if ($row->authorLevelAuthLevel  == null)
                                echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';

                            if ($row->person_id !== null) {
                                $person = Yii::$app->getDb()->createCommand('select person_fname_th,person_lname_th from view_pis_user WHERE id =' . $row->person_id)->queryOne();
                                echo ' <center>';
                                echo $person['person_fname_th'] . '' . $person['person_lname_th'];
                                echo ' </center>';


                            }
                           // echo '<br/>';
                        if ($row->contributor_contributor_id1 == 1) {

                           echo ' <center>';   echo $row->contributorContributorId1->contributor_name;echo ' </center>';


                       }else{
                                 echo ' <center>'; echo 'สมาชิก'; echo ' </center>';
                       }











                    ?>


                </table>
            </div>


            </div>
        <?php  }?>
    </div>

    <!-- /panel content -->


</div>



