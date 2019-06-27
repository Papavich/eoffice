<?php

/* @var $this yii\web\View */

use app\modules\eproject\controllers;
use yii\helpers\Url;
use yii\timeago\TimeAgo;

$this->title = controllers::t( 'label', 'Home' );
//$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean">

    <div class="panel-heading">
            <span class="elipsis"><!-- panel title --><span class="fa fa-newspaper-o"></span>
             <strong><?= controllers::t( 'label', 'News' ) ?></strong>
            </span>


        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Collapse"
                   data-placement="bottom"></a></li>
        </ul>
        <!-- /right options -->

    </div>

    <!-- panel content -->
    <div class="panel-body">

        <?php
        foreach ($news as $item) { ?>
            <a href="<?php echo Url::toRoute( ['news/view', 'id' => $item->id] ); ?>">
                <div class="alert alert-bordered-dotted margin-bottom-3 padding-3"><!-- DEFAULT -->
                    <strong> <?php echo $item->title; ?> </strong>
                    <span style="color: black"><?= controllers::t( 'label', 'By' ) ?> <?php echo $item->crbyObj->name ?>
                        ( <i><?php echo TimeAgo::widget( ['timestamp' => $item->crtime . "GMT+7", 'language' => Yii::$app->language] ) ?></i> )</span>
                </div>
            </a>
        <?php } ?>

    </div>
    <!-- /panel content -->

</div>
<!-- /Collapsible -->
<!-- Collapsible -->
<div id="panel-misc-portlet-r1" class="panel panel-clean">

    <div class="panel-heading">
        <span class="elipsis"><span class="fa fa-commenting-o"></span></span>
        <strong><?= controllers::t( 'label', 'Broadcast' ) ?></strong></span>
        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Collapse"
                   data-placement="bottom"></a></li>
        </ul>
        <!-- /right options -->
    </div>

    <!-- panel content -->
    <div class="panel-body">
        <?php
        foreach ($broadcasts as $broadcast) { ?>
            <a href="<?php echo Url::toRoute( ['adviser/broadcast-view', 'id' => $broadcast->id] ); ?>">
                <div class="alert alert-bordered-dotted margin-bottom-3 padding-3"><!-- DEFAULT -->
                    <strong> <?php echo $broadcast->topic; ?> </strong>
                    <span style="color: black"><?= controllers::t( 'label', 'By' ) ?> <?php echo $broadcast->crbyObj->name ?>
                        ( <i><?php echo TimeAgo::widget( ['timestamp' => $broadcast->udtime . "GMT+7", 'language' => Yii::$app->language] ) ?></i> )</span>
                </div>
            </a>
        <?php } ?>


    </div>
    <!-- /panel content -->

</div>
<!-- /Collapsible -->
<!-- /LEFT -->


