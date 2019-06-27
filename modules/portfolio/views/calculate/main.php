<div id="content" class="dashboard padding-20">

    <!--
        PANEL CLASSES:
            panel-default
            panel-danger
            panel-warning
            panel-info
            panel-success

        INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
                All pannels should have an unique ID or the panel collapse status will not be stored!
    -->
    <div id="panel-1" class="panel panel-default">
        <div class="panel-heading">
							<span class="title elipsis">
								<strong>DEMO E-OFFICE PROJECT</strong> <!-- panel title -->
								<small class="size-12 weight-300 text-mutted hidden-xs">2017</small>
							</span>

            <!-- right options -->
            <ul class="options pull-right list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
            </ul>
            <!-- /right options -->

        </div>

        <!-- panel content -->
        <div class="panel-body">

            <div id="flot-sales" class="fullwidth height-250"></div>

        </div>
        <!-- /panel content -->

        <!-- panel footer -->
        <div class="panel-footer">

            <!--
                .md-4 is used for a responsive purpose only on col-md-4 column.
                remove .md-4 if you use on a larger column
            -->
            <ul class="easypiecharts list-unstyled">
                <li class="clearfix">
                    <span class="stat-number">18.125</span>
                    <span class="stat-title">New Customers</span>

                    <span class="easyPieChart" data-percent="86" data-easing="easeOutBounce" data-barColor="#F8CB00" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
										<span class="percent"></span>
									</span>
                </li>
                <li class="clearfix">
                    <span class="stat-number">60%</span>
                    <span class="stat-title">Returning Customers</span>

                    <span class="easyPieChart" data-percent="59.83" data-easing="easeOutBounce" data-barColor="#F86C6B" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
										<span class="percent"></span>
									</span>
                </li>
                <li class="clearfix">
                    <span class="stat-number">12%</span>
                    <span class="stat-title">Canceled Orders</span>

                    <span class="easyPieChart" data-percent="12" data-easing="easeOutBounce" data-barColor="#98AD4E" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
										<span class="percent"></span>
									</span>
                </li>
                <li class="clearfix">
                    <span class="stat-number">97%</span>
                    <span class="stat-title">Positive Feedbacks</span>

                    <span class="easyPieChart" data-percent="97" data-easing="easeOutBounce" data-barColor="#0058AA" data-trackColor="#dddddd" data-scaleColor="#dddddd" data-size="60" data-lineWidth="4">
										<span class="percent"></span>
									</span>
                </li>
            </ul>

        </div>
        <!-- /panel footer -->

    </div>
    <!-- /PANEL -->



    <!-- BOXES -->
    <div class="row">

        <!-- Feedback Box -->
        <div class="col-md-3 col-sm-6">

            <!-- BOX -->
            <div class="box danger"><!-- default, danger, warning, info, success -->

                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                    <h4><a href="#">9866 Feedbacks</a></h4>
                    <small class="block">654 New fedbacks today</small>
                    <i class="fa fa-comments"></i>
                </div>

                <div class="box-body text-center">
									<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
									</span>
                </div>

            </div>
            <!-- /BOX -->

        </div>

        <!-- Profit Box -->
        <div class="col-md-3 col-sm-6">

            <!-- BOX -->
            <div class="box warning"><!-- default, danger, warning, info, success -->

                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                    <h4>$10M Profit</h4>
                    <small class="block">1,2 M Profit for this month</small>
                    <i class="fa fa-bar-chart-o"></i>
                </div>

                <div class="box-body text-center">
									<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
									</span>
                </div>

            </div>
            <!-- /BOX -->

        </div>

        <!-- Orders Box -->
        <div class="col-md-3 col-sm-6">

            <!-- BOX -->
            <div class="box default"><!-- default, danger, warning, info, success -->

                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                    <h4>58944 Orders</h4>
                    <small class="block">18 New Orders</small>
                    <i class="fa fa-shopping-cart"></i>
                </div>

                <div class="box-body text-center">
									<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
									</span>
                </div>

            </div>
            <!-- /BOX -->

        </div>

        <!-- Online Box -->
        <div class="col-md-3 col-sm-6">

            <!-- BOX -->
            <div class="box success"><!-- default, danger, warning, info, success -->

                <div class="box-title"><!-- add .noborder class if box-body is removed -->
                    <h4>3485 Online</h4>
                    <small class="block">78185 Unique visitors today</small>
                    <i class="fa fa-globe"></i>
                </div>

                <div class="box-body text-center">
									<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
										331,265,456,411,367,319,402,312,300,312,283,384,372,269,402,319,416,355,416,371,423,259,361,312,269,402,327
									</span>
                </div>

            </div>
            <!-- /BOX -->

        </div>

    </div>
    <!-- /BOXES -->





</div>