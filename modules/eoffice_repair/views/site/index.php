<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
// use kartik\widgets\DepDrop;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\Json;
//use yii\bootstrap\ActiveField;


//$this->registerJsFile('@path_assetmodule/repair.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


?>


<div class="panel panel-primary">
    <div class="panel-heading panel-heading-transparent">
        <strong>หน้าหลัก</strong>
    </div>
</div>

<!-- Sales Chart -->
<div id="panel-graphs-flot-c1" class="panel panel-default">
    <div class="panel-heading">
		<span class="elipsis"><!-- panel title -->
			<strong>สถิติการแจ้งซ่อม</strong>
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
    <div class="panel-body nopadding">

        <div id="flot-sales" class="flot-chart"><!-- FLOT CONTAINER --></div>

    </div>
    <!-- /panel content -->

</div>
<!-- /Sales Chart -->
