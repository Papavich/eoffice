<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\portfolio\models\Sponsor;
use app\modules\portfolio\models\Project;
use app\modules\portfolio\models\ProjectSearch;
use app\modules\portfolio\models\ProjectOrder;

/* @var $this yii\web\View */


?>
<header id="page-header">
    <h1>รายละเอียดโครงการวิจัย</h1>
    <ol class="breadcrumb">
        <li><a href="#">หน้าหลัก</a></li>
        <li><a href="#">โครงกาวิจัย</a></li>
        <li class="active">รายละเอียดโครงการวิจัย</li>
    </ol>
</header>
<div class="project-view">

    <p>
    <center><?= Html::a('สร้างผลงานโครงการวิจัย', ['project-insert/create'], ['class' => 'btn btn-success']) ?></center>
    </p>

    <div class="panel-body">

        <?php /* @var $row \app\modules\portfolio\models\Project */
        foreach ($projects as $row) { ?>

            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                <thead>

                <tr>
                    <th><?php
                        echo $row->project_name_thai;
                        echo '  &nbsp  &nbsp   &nbsp;';
                        echo $row->project_name_eng;


                        ?></th>
                    <th>
                        <?php
                        // foreach ($row->proPubs !== null) {

                        // echo <a class="btn btn-xs btn-default btn-bordered" >
                        //  <i class="et-megaphone" ></i >
                        //  ผลงานตีพิมพ์</span >
                        //  </a >;
                        // } ?>

                    </th>
                </tr>

                </thead>

            </table>
            <div class="col-md-9 col-sm-8">
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                    <tbody>
                    <tr>หัวหน้าโครงการ : <?php foreach ($row->projectOrders as $row4) {
                            if ($row4->project_role_project_role_id === 1) {
                                if ($row4->person_id != null) {
                                    $person = Yii::$app->getDb()->createCommand('select id,person_fname_th,person_lname_th from view_pis_user WHERE id =' . $row4->person_id)->queryOne();

                                    echo $person['id'] . '' . $person['person_name'] . '   ' . $person['person_lname_th'];
                                } else {
                                    echo $row4->projectMemberProMember->member_name . '     ' . $row4->projectMemberProMember->member_lname;
                                }
                            }


                        } ?>&nbsp;


                    </tr>
                    <br>

                    <tr>
                        เว็บไซต์ :<?php {
                            echo $row->project_url;

                        } ?></tr>
                    <br>
                    <tr>ผู้ให้ทุนสนับสนุน :<?php foreach ($row->projectOrders as $row3) {
                            //print_r($row3);
                            //  var_dump($row3);

                            //exit;
                          echo $row3->sponsorSponsor->sponsor_name;
                        }


                        ?></tr>
                    <br>
                    <tr>ปีที่เริ่มต้น-ปีที่สิ้นสุด :&nbsp;&nbsp;<?php {
                            echo $row->project_start;

                        } ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php {
                            echo $row->project_end;

                        } ?></tr>

                    </tbody>

                </table>

            </div>
            <div class="box box-info box">

                <div class="text-center">
                    <div class="col-md-3col-sm-8">
                        <table>

                            <tr><h5>สมาชิกโครงการ</h5></tr>


                            <th><?php foreach ($row->projectOrders as $row2) {
                                    if ($row2->project_role_project_role_id !== 1) {
                                        if ($row2->person_id != null) {
                                            $person = Yii::$app->getDb()->createCommand('select id,person_fname_th,person_lname_th from view_pis_user WHERE id =' . $row2->person_id)->queryOne();

                                            echo $person['id'] . '' . $person['person_fname_th'] . '     ' . $person['person_lname_th'];
                                        } else {
                                            echo $row2->projectMemberProMember->member_name . '     ' . $row2->projectMemberProMember->member_lname;
                                        }
                                        echo ' <br/>';

                                    }

                                }
                                ?></th>


                        </table>
                    </div>

                </div>
            </div>
        <?php } ?>
    </div>

    <!-- /panel content -->


</div>


