<?php

use app\modules\eproject\components\AuthHelper;
use app\modules\eproject\controllers;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\timeago\TimeAgo;
use yii\widgets\DetailView;

/* @var $this yii\web\View */

$this->title = controllers::t( 'label', 'Student Information' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">
    <!-- Collapsible -->
    <div id="panel-misc-portlet-r1" class="panel panel-clean">

        <div class="panel-heading">
            <span class="elipsis"><!-- panel title --><span class="fa fa-user"></span>
             <strong><?= controllers::t( 'label', 'Student Detail' ) ?></strong>
            </span>
            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                       data-placement="bottom"></a></li>
            </ul>
            <!-- /right options -->
        </div>

        <!-- panel content -->
        <div class="panel-body" style="background-color: #f1fbe5">
            <div class=" nomargin">
                <div class="col-md-6">
                    <div class="panel-body">


                        <h4>
                            <span style="color:#428bca;"><?= controllers::t( 'label', 'General Information' ) ?></span>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Person ID' ) ?></b></label>
                                    <div class="line" name="person_id">
                                        <?= $modelStudent->STUDENTID; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Student Code' ) ?></b></label>
                                    <div class="line" name="student_code">
                                        <?= $modelStudent->STUDENTCODE; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Prefix' ) ?></b></label>
                                    <div class="line" name="prefix">
                                        <?= $modelStudent->PREFIXNAME; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'ID Card' ) ?></b></label>
                                    <div class="line" name="card_id">
                                        <?= $modelStudent->CITIZENID; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Name' ) ?></b></label>
                                    <div class="line" name="person_name">
                                        <?= $modelStudent->STUDENTNAME; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Surname' ) ?></b></label>
                                    <div class="line" name="person_surname">
                                        <?= $modelStudent->STUDENTSURNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Name (Eng)' ) ?></b></label>
                                    <div class="line" name="person_name_eng">
                                        <?= $modelStudent->STUDENTNAMEENG; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Surname (Eng)' ) ?></b></label>

                                    <div class="line" name="person_surname_eng">
                                        <?= $modelStudent->STUDENTSURNAMEENG; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Birth Date' ) ?></b></label>
                                    <div class="line" name="blood_type">
                                        <?= $modelStudent->BIRTHDATE; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Religion' ) ?></b></label>
                                    <div class="line" name="religion">
                                        <?= $modelStudent->RELIGIONNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Nation' ) ?></b></label>

                                    <div class="line" name="nationality">
                                        <?= $modelStudent->NATIONNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------------------- ข้อมูลติดต่อ ----------------------------------------------------------------->
                        <br><h4><span
                                    style="color:#428bca;"><?= controllers::t( 'label', 'Contact Information' ) ?></span>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Phone Number' ) ?></b></label>

                                    <div class="line" name="mobile_phone_register">
                                        <?= $modelStudent->STUDENTMOBILE; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Email' ) ?></b></label>
                                    <div class="line" name="person_email_register">
                                        <?= $modelStudent->STUDENTEMAIL; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------------------- บุคคลที่สามารถติดต่อได้ ----------------------------------------------------------------->
                        <br><h4><span
                                    style="color:#428bca;"><?= controllers::t( 'label', 'Person Contact' ) ?></span>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Name' ) ?></b></label>
                                    <div class="line" name="person_contact_name">
                                        <?= $modelStudent->CONTACTPERSON; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Relation' ) ?></b></label>
                                    <div class="line" name="person_contact_relationship">
                                        <?= $modelStudent->CONTACTRELATION; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Phone Number' ) ?></b></label>
                                    <div class="line" name="person_contact_mobile_register">
                                        <?= $modelStudent->CONTACTPHONENO; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">

                    <div class="panel-body">
                        <!------------------------------------------- ข้อมูลการศึกษา ----------------------------------------------------------------->
                        <h4>
                            <span style="color:#428bca;"><?= controllers::t( 'label', 'Education Information' ) ?></span>
                        </h4>
                        <hr>
                        <div class="col-md-12 col-sm-12">
                            <?php if ($modelStudent->student_img != "<span style='color:red'>N/A</span>") { ?>
                                <img src="<?= Yii::getAlias( '@web' ) ?>/web_personal/upload/System/<?= $modelStudent->student_img ?>">
                            <?php } else { ?>
                                <img width="150" height="150" alt=""
                                     src="<?= Yii::getAlias( '@web' ) ?>/web_personal/upload/noavatar.jpg">
                            <?php } ?></div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <br><label><b><?= controllers::t( 'label', 'Student Status' ) ?></b></label>
                                    <div class="line" name="student_status">
                                        <?= $modelStudent->STUDENTSTATUS; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <br><label><b><?= controllers::t( 'label', 'Adviser' ) ?></b></label>
                                    <div class="line" name="advisor">
                                        <?= $modelStudent->OFFICERNAME . " " . $modelStudent->OFFICERSURNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Faculty Name' ) ?></b></label>
                                    <div class="line" name="facalty_name">
                                        <?= $modelStudent->FACULTYNAME; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Level Name' ) ?></b></label>
                                    <div class="line" name="level_name">
                                        <?= $modelStudent->LEVELNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label><b><?= controllers::t( 'label', 'Program' ) ?></b></label>
                                    <div class="line" name="program_name">
                                        <?= $modelStudent->PROGRAMNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Admit Year' ) ?></b></label>
                                    <div class="line" name="admit_academic_year">
                                        <?= $modelStudent->ADMITACADYEAR; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Admit Semester' ) ?></b></label>
                                    <div class="line" name="admit_academic_semester">
                                        <?= $modelStudent->ADMITSEMESTER; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Entry Degree' ) ?></b></label>
                                    <div class="line" name="pre_certificate">
                                        <?= $modelStudent->ENTRYDEGREE; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'Entry GPA' ) ?></b></label>
                                    <div class="line" name="pre_certificate_grade">
                                        <?= $modelStudent->ENTRYGPA; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'School' ) ?></b></label>
                                    <div class="line" name="graduated_from">
                                        <?= $modelStudent->SCHOOLNAME; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------------------- ผลการศึกษา ----------------------------------------------------------------->
                        <br><h4><span
                                    style="color:#428bca;"><?= controllers::t( 'label', 'Transcript' ) ?></span>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <label><b><?= controllers::t( 'label', 'GPA' ) ?></b></label>

                                    <div class="line" name="gpa">
                                        <?= $modelStudent->GPA; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------------------------------------- ข้อมูลผู้ปกครอง ----------------------------------------------------------------->
                    </div>

                </div>
            </div>

        </div>
        <!-- /panel content -->

    </div>
    <!-- /Collapsible -->
    <!-- Collapsible -->
    <div id="panel-misc-portlet-r2" class="panel panel-clean">

        <div class="panel-heading">
            <span class="elipsis"><!-- panel title --><span class="fa fa-user"></span>
             <strong><?= controllers::t( 'label', 'Request For Adviser' ) ?></strong>
            </span>
            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                       data-placement="bottom"></a></li>
            </ul>
            <!-- /right options -->
        </div>

        <!-- panel content -->
        <div class="panel-body">
            <div class=" nomargin">
                <?php
                if (count( $modelAdviserRequest ) == 0) { ?>
                    <div align="center" class="main-container">
                        <?= controllers::t( 'label', 'No Requesting' ) ?>

                    </div>
                <?php } else { ?>
                    <table class="table table-bordered nomargin">

                        <thead>

                        <tr class="active">
                            <th><p align="center" style="margin: 0px">#</th>
                            <th><p style="margin: 0px"><?= controllers::t( 'label', 'Topic' ) ?></th>
                            <th><p style="margin: 0px"><?= controllers::t( 'label', 'Status' ) ?></th>
                            <th><p style="margin: 0px"><?= controllers::t( 'label', 'To' ) ?></th>
                            <th><p style="margin: 0px"><?= controllers::t( 'label', 'Time' ) ?></th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php

                        foreach ($modelAdviserRequest

                                 as $key => $item) { ?>
                            <tr>
                                <td align="center"><?= $key + 1 ?></td>
                                <td><b><?php echo $item->topic ?></b></td>
                                <td><?php
                                    if ($item->status == 0) {
                                        echo controllers::t( 'label', 'Pending' );
                                    } else if ($item->status == 1) {
                                        echo controllers::t( 'label', 'Accepted' );
                                    } else if ($item->status == 2) {
                                        echo controllers::t( 'label', 'Rejected' );
                                    } else if ($item->status == 3) {
                                        echo controllers::t( 'label', 'Canceled' );
                                    } else if ($item->status == 4) {
                                        echo controllers::t( 'label', 'Waiting' );
                                    }
                                    if ($item->comment != null) echo ' <a style="color:blue"
                                                              onclick="alertComment(\'' . $item->comment . '\')"
                                                              class=\'fa fa-commenting-o\'></a>';
                                    ?>
                                </td>
                                <td>
                                    <b>
                                        <?php echo $item->adviser->name ?>
                                    </b>
                                </td>
                                <td style="margin: 0px"><?php echo TimeAgo::widget( ['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language] ) ?></td>
                            </tr>

                        <?php } ?>

                        </tbody>
                    </table>
                <?php } ?>
            </div>

        </div>
        <!-- /panel content -->

    </div>
    <!-- /Collapsible -->
    <!-- Collapsible -->
    <div id="panel-misc-portlet-r2" class="panel panel-clean">

        <div class="panel-heading">
            <span class="elipsis"><!-- panel title --><span class="fa fa-bank"></span>
             <strong><?= controllers::t( 'label', 'Project' ) ?></strong>
            </span>
            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                       data-placement="bottom"></a></li>
            </ul>
            <!-- /right options -->
        </div>

        <!-- panel content -->
        <div class="panel-body">
            <div class=" nomargin">
                <?php
                if (count( $projects ) == 0) { ?>
                    <div align="center" class="main-container">
                        <?= controllers::t( 'label', 'No Requesting' ) ?>

                    </div>
                <?php } else { ?>
                    <table class="table table-bordered nomargin">

                        <thead>

                        <tr class="active">
                            <th><p align="center" style="margin: 0px">#</th>
                            <th><p style="margin: 0px"><?= controllers::t( 'label', 'Topic' ) ?></th>
                            <th><p style="margin: 0px"><?= controllers::t( 'label', 'Year' ) ?></th>
                            <th><p style="margin: 0px"><?= controllers::t( 'label', 'Semester' ) ?></th>
                            <th><p style="margin: 0px"><?= controllers::t( 'label', 'Adviser' ) ?></th>
                            <th><p style="margin: 0px" align="center"><?= controllers::t( 'label', 'Requesting' ) ?></th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php

                        foreach ($projects
                                 as $key => $item) { ?>
                            <tr>
                                <td align="center"><?= ($key + 1) ?></td>
                                <td ><?= $item->name ?></td>
                                <td><b><?php echo $item->year_id ?></b></td>
                                <td><?= $item->semester_id ?>
                                </td>
                                <td>
                                    <b>
                                        <?php
                                        if ($item->mainAdviser) {
                                            echo $item->mainAdviser->name;
                                        }
                                        ?>
                                    </b>
                                </td>
                                <td style="margin: 0px" align="center">
                                    <a href="../project/log?id=<?=$item->id?>" title="ดู" aria-label="ดู"
                                       data-pjax="0">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>

                        </tbody>
                    </table>
                <?php } ?>
            </div>

        </div>
        <!-- /panel content -->

    </div>
    <!-- /Collapsible -->
</div>
<script>
  function alertComment (data) {
    swal({
      icon: 'info',
      text: data,

    })
  }
</script>
