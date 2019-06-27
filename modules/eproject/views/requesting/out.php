<?php

/* @var $this yii\web\View */

use app\modules\eproject\components\AuthHelper;
use app\modules\eproject\controllers;
use yii\helpers\Html;
use yii\timeago\TimeAgo;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = controllers::t( 'label', 'Petition' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean">

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

                                    $form = ActiveForm::begin( ['options' => ['style' => 'all:initial'], 'action' => 'cancel-request'] );
                                    echo Html::input( 'hidden', 'type', 'RA' );
                                    echo Html::input( 'hidden', 'id', $item->id );
                                    echo " <button type='submit'> <span class='' style='color: red'> [" . controllers::t( 'label', 'Cancel' ) . "]</span></button>";
                                    ActiveForm::end();


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
                            <td><b><?php echo $item->adviser->name ?></b></td>
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

                                    $form = ActiveForm::begin( ['options' => ['style' => 'all:initial'], 'action' => 'cancel-request'] );
                                    echo Html::input( 'hidden', 'type', 'CT' );
                                    echo Html::input( 'hidden', 'id', $item->id );
                                    echo " <button type='submit'> <span class='' style='color: red'> [" . controllers::t( 'label', 'Cancel' ) . "]</span></button>";
                                    ActiveForm::end();


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
            <span class="elipsis"><!-- panel title --><span class="fa fa-users"></span>
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
                                    if ($item->status == 0) {
                                        $form = ActiveForm::begin( ['options' => ['style' => 'all:initial'], 'action' => 'cancel-request'] );
                                        echo Html::input( 'hidden', 'type', 'CA' );
                                        echo Html::input( 'hidden', 'id', $item->id );
                                        echo " <button type='submit'> <span class='' style='color: red'> [" . controllers::t( 'label', 'Cancel' ) . "]</span></button>";
                                        ActiveForm::end();
                                    }
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

                                    $form = ActiveForm::begin( ['options' => ['style' => 'all:initial'], 'action' => 'cancel-request'] );
                                    echo Html::input( 'hidden', 'type', 'CM' );
                                    echo Html::input( 'hidden', 'id', $item->id );
                                    echo " <button type='submit'> <span class='' style='color: red'> [" . controllers::t( 'label', 'Cancel' ) . "]</span></button>";
                                    ActiveForm::end();

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

