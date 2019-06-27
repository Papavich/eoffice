<?php

/* @var $this yii\web\View */

use app\modules\eproject\components\AuthHelper;
use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\timeago\TimeAgo;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = controllers::t( 'label', 'Logs' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean">

    <div class="panel-heading">
            <span class="elipsis"><!-- panel title --><span class="fa fa-bank"></span>
             <strong> <?= controllers::t( 'label', 'Project Detail' ) ?></strong>
            </span>
        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                   data-placement="bottom"></a>
            </li>
        </ul>
        <!-- /right options -->
    </div>

    <!-- panel content -->

    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Image' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"> <?php if ($model->image == "") {
                    echo Html::img( '@web/images/demo/portfolio/thumb/small_a5.png', ['style' => 'max-width:150px;max-height:150px;'] );
                } else {
                    echo Html::img( '@web/web_eproject/uploads/project_images/' . $model->image, ['style' => 'max-width:150px;max-height:150px;'] );
                } ?>
            </div>
        </div>
        <div class="row">
            <br>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Project Number' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"> <?= ($model->number != "") ? $model->major->code . ' ' . $model->number . '/' . $model->year_id : '-' ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Project Name (Thai)' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"><?= $model->name_th ?></div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Project Name (English)' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"><?= $model->name_en ?></div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Owner' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->students as $item) { ?>
                    <a href="#"> <?= $item->name ?></a><br>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Adviser' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->advises as $projectXAdviser) { ?>
                    <p style="margin: 0px"><?= $projectXAdviser->adviser->name ?>
                    <?php if ($projectXAdviser->adviser_type_id == 1) { ?>
                        (<?= controllers::t( 'label', 'Main Adviser' ) ?>)</p>
                    <?php } else if ($projectXAdviser->adviser_type_id == 2) { ?>
                        (<?= controllers::t( 'label', 'Co-Adviser' ) ?>)</p>
                    <?php } ?><?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Project Type' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->projectTypes as $item) { ?>
                    <a href="#"> <?= $item->name ?></a>,
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Theories' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->theories as $item) { ?>
                    <a href="#"> <?= $item->name ?></a>,
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Tools' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9">
                <?php foreach ($model->tools as $item) { ?>
                    <a href="#"> <?= $item->name ?></a>,
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-md-3" style="font-weight: bold"
                 align="right"><?= controllers::t( 'label', 'Abstract' ) ?> :
            </div>
            <div class="col-xs-8 col-md-9"> <?= $model->abstract ?>
            </div>
        </div>

    </div>
    <!-- /panel content -->

</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean">

    <div class="panel-heading">
            <span class="elipsis"><!-- panel title --><span class="fa fa-file-text-o"></span>
             <strong> <?= controllers::t( 'label', 'Change Topic Request' ) ?></strong>
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
            if (count( $modelChangeTopic ) == 0) { ?>
                <div align="center" class="main-container">
                    <?= controllers::t( 'label', 'No Requesting' ) ?>
                </div>
            <?php } else { ?>
                <table class="table table-bordered nomargin">
                    <thead>

                    <tr class="active">
                        <th><p align="center" style="margin: 0px">#</th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'To' ) ?></th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'Status' ) ?></th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'Time' ) ?></th>
                        <!--                    <th><p style="margin: 0px">Detail</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($modelChangeTopic as $key => $item) { ?>
                        <tr>
                            <td align="center"><?= $key + 1 ?></td>
                            <td><b><?php if (Yii::$app->language == "en") {
                                        echo $item->pro_name_en;
                                    } else {
                                        echo $item->pro_name_th;
                                    } ?></b></td>
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
                                ?></td>

                            <td
                                    style="margin: 0px"><?php echo TimeAgo::widget( ['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language] ) ?></td>
                            <!--                        <td><b>--><?php //echo $item->id ?><!--</b></td>-->
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
<div id="panel-misc-portlet-r1" class="panel panel-clean">

    <div class="panel-heading">
            <span class="elipsis"><!-- panel title --><span class="fa fa-user"></span>
             <strong> <?= controllers::t( 'label', 'Change Adviser Request' ) ?></strong>
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
            if (count( $modelChangeAdviser ) == 0) { ?>
                <div align="center" class="main-container">
                    <?= controllers::t( 'label', 'No Requesting' ) ?>

                </div>
            <?php } else { ?>
                <table class="table table-bordered nomargin">
                    <thead>

                    <tr class="active">
                        <th><p align="center" style="margin: 0px">#</th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'From' ) ?></th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'To' ) ?></th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'Status' ) ?></th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'Time' ) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($modelChangeAdviser as $key => $item) { ?>
                        <tr>
                            <td align="center"><?= $key + 1 ?></td>
                            <td><b><?php echo $item->from0->name ?></b></td>

                            <td><b><?php echo $item->to0->name ?></b></td>
                            <td><?php
                                if ($item->status == 0 || $item->status == 1) {
                                    echo controllers::t( 'label', 'Pending' );
                                } else if ($item->status == 2) {
                                    echo controllers::t( 'label', 'Accepted' );
                                } else if ($item->status == 3) {
                                    echo controllers::t( 'label', 'Rejected' );
                                } else if ($item->status == 4) {
                                    echo controllers::t( 'label', 'Canceled' );
                                } else if ($item->status == 5) {
                                    echo controllers::t( 'label', 'Waiting' );
                                } else if ($item->status == 6) {
                                    echo controllers::t( 'label', 'Waiting' );
                                }
                                if ($item->comment != null) echo ' <a style="color:blue"
                                                              onclick="alertComment(\'' . $item->comment . '\')"
                                                              class=\'fa fa-commenting-o\'></a>';
                                ?></td>
                            <td
                                    style="margin: 0px"><?php echo TimeAgo::widget( ['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language] ) ?></td>
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
<div id="panel-misc-portlet-r1" class="panel panel-clean">

    <div class="panel-heading">
            <span class="elipsis"><!-- panel title --><span class="fa fa-users"></span>
             <strong> <?= controllers::t( 'label', 'Change Member Request' ) ?></strong>
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
            if (count( $modelChangeMember ) == 0) { ?>
                <div align="center" class="main-container">
                    <?= controllers::t( 'label', 'No Requesting' ) ?>

                </div>
            <?php } else { ?>
                <table class="table table-bordered nomargin">
                    <thead>

                    <tr class="active">
                        <th><p align="center" style="margin: 0px">#</th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'Owner' ) ?></th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'Status' ) ?></th>
                        <th><p style="margin: 0px"><?= controllers::t( 'label', 'Time' ) ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($modelChangeMember as $key => $item) { ?>
                        <tr>
                            <td align="center"><?= $key + 1 ?></td>
                            <td><b><?php echo $item->to ?></b></td>

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
                                ?></td>
                            <td
                                    style="margin: 0px"><?php echo TimeAgo::widget( ['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language] ) ?></td>
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
<script>
  function alertComment (data) {
    swal({
      icon: 'info',
      text: data,

    })
  }
</script>

