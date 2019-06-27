<?php
/**
 * Created by PhpStorm.
 * User: Pink
 * Date: 3/8/2560
 * Time: 11:25
 */


use app\modules\eoffice_ta\models\TaNews;

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\eoffice_ta\assets\AppAssetAsset;
AppAssetAsset::register($this);
?>

<div class="ta-news-news">

<div class="nav nav-tabs"></div>
<div id="panel-1" class="panel panel-primary">
    <div class="panel-heading">
                <span class="title elipsis">
                    <strong>Dashboard</strong> <!-- panel title -->
                    <small class="size-12 weight-300 text-mutted hidden-xs"></small>
                </span>
        <!-- right options -->
        <ul class="options pull-right list-inline">
            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                   data-placement="bottom"></a></li>
            <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"
                   data-placement="bottom"><i class="fa fa-expand"></i></a></li>
        </ul>
        <!-- /right options -->
    </div>
    <!-- panel content -->
    <div class="panel-body">

    </div>
    <!-- /panel content -->
</div>
<div id="content" class="dashboard padding-5">
    <header id="page-header">
        <center><h3>ประกาศ</h3></center>
    </header>

    <div id="panel-2" class="panel panel-info">
        <div class="panel-body">

            <div class="row">
                <!-- LEFT -->
                <div class="col-md-10">

                    <!-- Default -->
                    <?php
                    $model = TaNews::find()->all();
                    foreach ($model as $row){

                        ?>

                        <div id="panel-misc-portlet-l1" class="panel panel-info">

                            <div class="panel-heading">
                                <span class="label label-info"><i class="fa fa-bullhorn size-15"></i></span>
                                <span class="elipsis"><!-- panel title -->
									&nbsp;<strong><?=$row->ta_news_name ?></strong>
									</span>
                                <!-- right options -->
                                <ul class="options pull-right list-inline">
                                    <li ><a href=" <?= Url::to(['ta-news/detail','id'=>$row->ta_news_id]) ?>" class="btn btn-success btn-xs white"><i class="glyphicon glyphicon-eye-open"></i>view</a></li>

                                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                                </ul>
                                <ul class="options pull-lift list-inline">
                                    <li><a class="size-13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-time"></i>&nbsp;&nbsp;<?= Yii::$app->formatter->format($row->crtime, 'relativeTime') ?></a></li>
                                </ul>
                                <!-- /right options -->

                            </div>

                            <!-- panel content -->
                            <div class="panel-body">
                                <div class="col-md-5">
                                    <?= Html::img($row->photoViewer,['class'=>'img-thumbnail','style'=>'width:400px;'])?>
                                </div> <br>
                                <div class="col-md-6">
                                    <strong class="text-black size-14">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $row->ta_news_detail ?>
                                    </strong>
                                </div>
                            </div>
                            <!-- /panel content -->

                        </div>
                        <!-- /Default -->
                    <?php  }  ?>



                </div>






            </div>


        </div>


    </div>
</div>
</div>


