<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\portfolio\models\ProjectMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-member-Show3">
    <!-- page title -->
    <header id="page-header">
        <h1>โครงการวิจัย</h1>
        <ol class="breadcrumb">
            <li><a href="#">กิจกรรม</a></li>
            <li class="active">โครงการวิจัย</li>
        </ol>
    </header>
    <!-- /page title -->

    <div id="content" class="padding-20">


        <div id="panel-1" class="panel panel-default">



            <!-- panel content -->
            <div class="panel-body">


                <?php /* @var $row app\modules\portfolio\models\Project*/
                foreach ($model2 as $row) { ?>

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                        <thead>

                        <tr>
                            <th><?php foreach ($row->projectMembers as $row4) {
                                    echo $row4->projectProject->project_name_eng;
                                    echo $row4->projectProject->project_name_thai;
                                    echo '<br/>';

                                } ?></th>
                            <th>
                                <a href="Expenses-namepublic.html" class="btn btn-xs btn-default btn-bordered">
                                    <i class="et-megaphone"></i>
                                    <span>ผลงานตีพิมพ์</span></a>

                            </th>
                        </tr>

                        </thead>

                    </table>
                    <div class="col-md-9 col-sm-8">
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                            <tbody>
                            <tr>หัวหน้าโครงการ : <?php foreach ($row->projectMembers as $row4) {
                                    if ($row4->project_role_project_role_id == 1) {
                                       // echo \app\modules\portfolio\models\Person::findOne($row4->person_id)->person_surname;
                                    }


                                } ?>&nbsp;

                                <?php
                                    echo $row->participation_participation_project_code;

                                } ?>
                            </tr>
                            <br>
                            <tr>ระยะเวลา :<?php  {
                                    echo $row->project_duration;

                                } ?></tr>
                            <th>
                                งบประมาณ :<?php  {
                                    echo $row->project_budget;

                                } ?></th>
                            <br>
                            <tr>
                                เว็บไซต์ :<?php  {
                                    echo $row->project_url;

                                } ?></tr>
                            <br>
                            <tr>ผู้ให้ทุนสนับสนุน :<?php foreach ($row->projectMembers as $row4) {
                                 //   echo $row->sponsorSponsor->sponsor_name;


                                } ?></tr>
                            <br>
                            <tr>ปีที่เริ่มต้น-ปีที่สิ้นสุด :&nbsp;&nbsp;<?php   {
                                    echo $row->project_start;

                                } ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php  {
                                    echo $row->project_end;

                                } ?></tr>

                            </tbody>

                        </table>

                    </div>
                    <div class="col-md-3col-sm-8">
                        <table>
                            <tr><h5>สมาชิกโครงการ</h5></tr>


                            <th><?php foreach ($row->projectMembers as $row2) {
                                    echo $row2->member_name.''.$row2->member_lname;
                                    echo '<br/>';

                                } ?></th>


                        </table>

                    </div>
                <?php  ?>
            </div>
            <!-- /panel content -->


        </div>

    </div>

</div>