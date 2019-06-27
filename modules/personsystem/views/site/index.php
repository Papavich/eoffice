<?php
use app\modules\personsystem\controllers;
?>
    <div id="content" class="padding-20">
<!--        <div id="panel-graphs-morris-c1" class="panel panel-default">-->
<!--            <div class="panel-heading">-->
<!--							<span class="title elipsis">-->
<!--								<strong>-->
<!--                                  <i class="fa fa-edit"></i> --><?//= controllers::t('label', 'Edit Teacher') ?>
<!--                                </strong>-->
<!--							</span>-->
<!--                <ul class="options pull-right list-inline">-->
<!--                    <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"-->
<!--                           data-placement="bottom"></a></li>-->
<!--                    <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"-->
<!--                           data-placement="bottom"><i class="fa fa-expand"></i></a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--            </div>-->
<!--        </div>-->
        <div class="row">
            <div class="col-md-6">
                <!-- Area Graph -->
                <div class="panel panel-default">
                    <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
										<strong><?= controllers::t("label", "Number of student (Bachelor)") ?></strong>
									</span>
                        <!-- right options -->
                        <ul class="options pull-right list-inline">
                            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a></li>

                        </ul>
                        <!-- /right options -->
                    </div>
                    <!-- panel content -->
                    <div class="panel-body">
                        <canvas class="chartjs fullwidth height-300" id="barChartCanvas" width="721" height="375"
                                style="width: 577px; height: 300px;"></canvas> </br>  </br> </br>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Area Graph -->
                <div class="panel panel-default">
                    <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
										<strong><?= controllers::t("label", "Number of student") ?></strong>
									</span>
                        <!-- right options -->
                        <ul class="options pull-right list-inline">
                            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a></li>
                        </ul>
                        <!-- /right options -->
                    </div>
                    <!-- panel content -->
                    <div class="panel-body">
                        <canvas class="chartjs height-300" id="pieChartCanvas" width="547" height="300"></canvas>
                        </br>  </br>
                       <span style="color:#1E73BE">▲</span> <?= controllers::t("label", "Bachelor") ?>
                        <span style="color:#69D2E7">▲</span> <?= controllers::t("label", "Master") ?>
                        <span style="color:#F38630">▲</span> <?= controllers::t("label", "PhD") ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Area Graph -->
                <div class="panel panel-default">
                    <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
										<strong><?= controllers::t("label", "Number of student (Master)") ?></strong>
									</span>
                        <!-- right options -->
                        <ul class="options pull-right list-inline">
                            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a></li>

                        </ul>
                        <!-- /right options -->
                    </div>
                    <!-- panel content -->
                    <div class="panel-body">
                        <canvas class="chartjs fullwidth height-300" id="barChartCanvas2" width="721" height="375"
                                style="width: 577px; height: 300px;"></canvas> </br>  </br> </br>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Area Graph -->
                <div class="panel panel-default">
                    <div class="panel-heading">
									<span class="elipsis"><!-- panel title -->
										<strong><?= controllers::t("label", "Number of student (PhD)") ?></strong>
									</span>
                        <!-- right options -->
                        <ul class="options pull-right list-inline">
                            <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a></li>

                        </ul>
                        <!-- /right options -->
                    </div>
                    <!-- panel content -->
                    <div class="panel-body">
                        <canvas class="chartjs fullwidth height-300" id="barChartCanvas3" width="721" height="375"
                                style="width: 577px; height: 300px;"></canvas> </br>  </br> </br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var plugin_path = "<?=Yii::getAlias("@web")?>";
    </script>
<?php
$this->registerJs(<<<JS
        loadScript(plugin_path+"../js/Chart.min.js", function() {
            var barChartCanvas = {
                labels:["","","CS","IT","GIS","",""],
                datasets:[
                    {
                        fillColor : "#82bbef96",
                        strokeColor : "#82bbef96",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data : ["","",$BachelorCS,$BachelorIT,$BachelorGIS]
                    }
                ]
            };

            var ctx = document.getElementById("barChartCanvas").getContext("2d");
            new Chart(ctx).Bar(barChartCanvas);
        });
    loadScript(plugin_path+"../js/Chart.min.js", function() {
	var pieChartCanvas = [
		{
			value: $studentBachelor,
			color:"#1E73BE"
		},
		{
			value : $studentMaster,
			color : "#69D2E7"
		},
		{
			value : $studentPhD,
			color : "#F38630"
		}
	];

	var ctx = document.getElementById("pieChartCanvas").getContext("2d");
	new Chart(ctx).Pie(pieChartCanvas);
});
       loadScript(plugin_path+"../js/Chart.min.js", function() {
            var barChartCanvas = {
                labels:["","","CS","IT","GIS","",""],
                datasets:[
                    {
                        fillColor : "#46bfbda6",
                        strokeColor : "#46bfbda6",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data : ["","",$MasterCS,$MasterIT,$MasterGIS]
                    }
                ]
            };

            var ctx = document.getElementById("barChartCanvas2").getContext("2d");
            new Chart(ctx).Bar(barChartCanvas);
        });
              loadScript(plugin_path+"../js/Chart.min.js", function() {
            var barChartCanvas = {
                labels:["","","CS","IT","GIS","",""],
                datasets:[
                    {
                        fillColor : "#fdb45cb8",
                        strokeColor : "#fdb45cb8",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data : ["","",$PhDCS,$PhDIT,$PhDGIS]
                    }
                ]
            };

            var ctx = document.getElementById("barChartCanvas3").getContext("2d");
            new Chart(ctx).Bar(barChartCanvas);
        });
JS
    , \yii\web\View::POS_END
);
?>