<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 4/1/2561
 * Time: 15:13
 */

use app\modules\eoffice_ta\controllers;
?>
<?php
$title = "Dashboard";
$back = controllers::t( 'label', 'Back' );
$this->title = $title;
?>

<div id="panel-1" class="panel panel-clean">
        <div class="panel-heading">
                <span class="title elipsis">
                    <strong>Dashboard</strong> <!-- panel title -->
                    <small class="size-12 weight-300 text-mutted hidden-xs"></small>
                </span>
        </div>
        <!-- panel content -->
        <div class="panel-body">
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
        <!-- /panel content -->
    </div>
<!-- panel content -->

    <div id="panel-2" class="panel panel-clean">
    <div class="panel-heading">
                <span class="title elipsis">
                    <strong>Table</strong> <!-- panel title -->
                    <small class="size-12 weight-300 text-mutted hidden-xs"></small>
                </span>
    </div>
        <div class="panel-body">

            <div class="table-responsive">
                <table class="table table-bordered table-vertical-middle nomargin">
                    <thead>
                    <tr>
                        <th class="width-30">Img</th>
                        <th>กิจกรรม</th>
                        <th>Ratings</th>
                        <th>Progress</th>
                        <th>Share</th>
                        <th>Column name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center"><img src="assets/images/male.png" alt="" width="20"></td>
                        <td>ร้องขอผู้ช่วยสอน</td>
                        <td><div class="rating rating-0 size-13 width-100"><!-- rating-0 ... rating-5 --></div></td>
                        <td>
                            <div class="progress progress-xxs margin-bottom-0">
                                <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%; min-width: 2em;">
                                    <span class="sr-only">80% Complete</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <ul class="list-inline nomargin size-12">
                                <li><a href="#" class="icon-facebook margin-top-6" data-toggle="tooltip" data-placement="top" title="Facebook"></a></li>
                                <li><a href="#" class="icon-twitter margin-top-6" data-toggle="tooltip" data-placement="top" title="Twitter"></a></li>
                                <li><a href="#" class="icon-gplus margin-top-6" data-toggle="tooltip" data-placement="top" title="Google Plus"></a></li>
                                <li><a href="#" class="icon-linkedin margin-top-6" data-toggle="tooltip" data-placement="top" title="Linkedin"></a></li>
                                <li><a href="#" class="icon-pinterest margin-top-6" data-toggle="tooltip" data-placement="top" title="Pinterest"></a></li>
                            </ul>
                        </td>
                        <td><span class="label label-success">Approved </span></td>
                    </tr>

                    <tr>
                        <td class="text-center"><img src="assets/images/male.png" alt="" width="20"></td>
                        <td>กำหนดภาระงาน</td>
                        <td><div class="rating rating-0 size-13 width-100"><!-- rating-0 ... rating-5 --></div></td>
                        <td>
                            <div class="progress progress-xxs margin-bottom-0">
                                <div class="progress-bar progress-bar-default" role="progressbar"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 50%; min-width: 2em;">
                                    <span class="sr-only">50% Complete</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <ul class="list-inline nomargin size-12">
                                <li><a href="#" class="icon-facebook margin-top-6" data-toggle="tooltip" data-placement="top" title="Facebook"></a></li>
                                <li><a href="#" class="icon-twitter margin-top-6" data-toggle="tooltip" data-placement="top" title="Twitter"></a></li>
                                <li><a href="#" class="icon-gplus margin-top-6" data-toggle="tooltip" data-placement="top" title="Google Plus"></a></li>
                                <li><a href="#" class="icon-linkedin margin-top-6" data-toggle="tooltip" data-placement="top" title="Linkedin"></a></li>
                                <li><a href="#" class="icon-pinterest margin-top-6" data-toggle="tooltip" data-placement="top" title="Pinterest"></a></li>
                            </ul>
                        </td>
                        <td><span class="label label-success">Approved </span></td>
                    </tr>
                    <tr>
                        <td class="text-center"><img src="assets/images/female.png" alt="" width="20"></td>
                        <td>ผู้สมัคร</td>
                        <td><div class="rating rating-1 size-13 width-100"><!-- rating-0 ... rating-5 --></div></td>
                        <td>
                            <div class="progress progress-xxs margin-bottom-0">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%; min-width: 2em;">
                                    <span class="sr-only">80% Complete</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <ul class="list-inline nomargin size-12">
                                <li><a href="#" class="icon-facebook margin-top-6" data-toggle="tooltip" data-placement="top" title="Facebook"></a></li>
                                <li><a href="#" class="icon-twitter margin-top-6" data-toggle="tooltip" data-placement="top" title="Twitter"></a></li>
                                <li><a href="#" class="icon-gplus margin-top-6" data-toggle="tooltip" data-placement="top" title="Google Plus"></a></li>
                                <li><a href="#" class="icon-linkedin margin-top-6" data-toggle="tooltip" data-placement="top" title="Linkedin"></a></li>
                                <li><a href="#" class="icon-pinterest margin-top-6" data-toggle="tooltip" data-placement="top" title="Pinterest"></a></li>
                            </ul>
                        </td>
                        <td><span class="label label-info">Pending </span></td>
                    </tr>
                    <tr>
                        <td class="text-center"><img src="assets/images/female.png" alt="" width="20"></td>
                        <td>ลงบันทึกปฏิบัติงาน</td>
                        <td><div class="rating rating-1 size-13 width-100"><!-- rating-0 ... rating-5 --></div></td>
                        <td>
                            <div class="progress progress-xxs margin-bottom-0">
                                <div class="progress-bar progress-bar-danger"
                                     role="progressbar" aria-valuenow="80"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 0%; min-width: 2em;">
                                    <span class="sr-only">0% Complete</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <ul class="list-inline nomargin size-12">
                                <li><a href="#" class="icon-facebook margin-top-6" data-toggle="tooltip" data-placement="top" title="Facebook"></a></li>
                                <li><a href="#" class="icon-twitter margin-top-6" data-toggle="tooltip" data-placement="top" title="Twitter"></a></li>
                                <li><a href="#" class="icon-gplus margin-top-6" data-toggle="tooltip" data-placement="top" title="Google Plus"></a></li>
                                <li><a href="#" class="icon-linkedin margin-top-6" data-toggle="tooltip" data-placement="top" title="Linkedin"></a></li>
                                <li><a href="#" class="icon-pinterest margin-top-6" data-toggle="tooltip" data-placement="top" title="Pinterest"></a></li>
                            </ul>
                        </td>
                        <td><span class="label label-info">Pending </span></td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
        <!-- /panel content -->

</div>