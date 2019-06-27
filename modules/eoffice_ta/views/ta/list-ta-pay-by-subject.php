<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 14/9/2560
 * Time: 19:38
 */
use app\modules\eoffice_ta\assets\AppAssetAsset;
AppAssetAsset::register($this);
?>
<!-- page title -->
<header id="page-header">
    <h1>ตรวจสอบค่าตอบแทน TA</h1>
    <ol class="breadcrumb">
        <li><a href="#">รายการค่าตอบแทนTA</a></li>
        <li class="active">ตามรายวิชา</li>
    </ol>
</header>
<!-- /page title -->


<div id="content" class="padding-5">

    <div class="row">

        <div class="col-md-10 col-lg-9">

            <!-- -- -->
            <div id="panel-1" class="panel panel-info">

                <div class="panel-heading">

							<span class="elipsis"><!-- panel title -->
								<strong>ข้อมูลวิชา </strong><strong class="text-blue">  322114</strong>
							</span>

                    <!-- right options -->
                    <ul class="options pull-right list-inline">
                        <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
                        <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>

                    </ul>
                    <!-- /right options -->

                </div>

                <div class="panel-body">

                    <div class="alert alert-info margin-bottom-30"><!-- DEFAULT -->
                        <strong>วิชา :</strong> 	322437 การพัฒนาโปรแกรมประยุกต์บนเว็บด้วยภาษาจาวา <br>
                        <strong>อาจารย์ประจำวิชา :</strong> 	อ.ดร.ธีระยุทธ ทองเครือ <br>
                        <strong>จำนวนSec.:</strong>4 กลุ่ม<br>
                        <p><strong> ภาคปกติ :</strong> 2 กลุ่ม<br>
                            <strong>ภาคสมทบ :</strong> 2 กลุ่ม<br></p>
                        <strong>จำนวนนักศึกษา :</strong>156 คน<br>
                        <p><strong>ภาคปกติ :</strong>101 คน<br>
                            <strong>ภาคสมทบ</strong>55 คน</p>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-vertical-middle nomargin">
                            <thead>
                            <tr class="info">
                                <th ></center>รูป<center></th>
                                <th><center>รหัสนักศึกษา</center></th>
                                <th><center>ชื่อ-สกุล</center></th>
                                <th><center>ระดับ</center></th>
                                <th><center>Sec<br>ที่รับผิดชอบ</center></th>
                                <th><center>ค่าตอบแทน</center></th>
                                <th><center>หมายเหตุ</center></th>
                                <th><center>รายละเอียด</center></th>
                            </tr>
                            </thead>
                            <tbody>


                            <tr>
                                <td class="text-center"><img src="<?= Yii::$app->homeUrl; ?>assets/images/male.png" alt="" width="20"></td>
                                <td>573020420-9</td>
                                <td>นางสาวธัญญาภรณ์  สุขขาว</td>
                                <td>ปริญญาตรี</td>
                                <td>1</td>
                                <td>2,400.00</td>


                                <td><center><span class="label label-success">BN </span></center></td>
                                <td><a  href="check-workload-payTA.html"><img src='http://icons.iconarchive.com/icons/paomedia/small-n-flat/64/user-id-icon.png' width='40em'> </a></td>
                            </tr>

                            <tr>
                                <td class="text-center"><img src="<?= Yii::$app->homeUrl; ?>assets/images/male.png" alt="" width="20"></td>

                                <td>573020681-1</td>
                                <td>นายณพล ใสสะอาด</td>
                                <td>ปริญญาตรี</td>
                                <td>1</td>
                                <td>2,400.00</td>


                                <td><center><span class="label label-success">BN </span></center></td>

                                <td><a  href="check-workload-payTA.html"><img src='http://icons.iconarchive.com/icons/paomedia/small-n-flat/64/user-id-icon.png' width='40em'> </a></td>

                            </tr>
                            <tr>
                                <td class="text-center"><img src="<?= Yii::$app->homeUrl; ?>assets/images/male.png" alt="" width="20"></td>
                                <td>573020681-1</td>
                                <td>นายณพล ใสสะอาด</td>
                                <td>ปริญญาโท</td>
                                <td>1</td>
                                <td>2,400.00</td>


                                <td><center><span class="label label-info">GS</span></center></td>

                                <td><a  href="check-workload-payTA.html"><img src='http://icons.iconarchive.com/icons/paomedia/small-n-flat/64/user-id-icon.png' width='40em'> </a></td>
                            </tr>


                            </tbody>
                        </table><br>
                    <div align="lift">
                        <a href="list-subject-payTA.html" class="btn btn-3d btn-reveal btn-primary"><i class="glyphicon glyphicon-arrow-left"></i><span>BACK</span></a>
                    </div>



                    </div> </div></div> </div>


<div class="col-md-12 col-lg-3">

    <section class="panel panel-warning">
        <div class="panel-heading">
            <span class="elipsis"><!-- panel title -->
                <strong><i class="glyphicon glyphicon-pushpin"> เกณฑ์พิจารณาค่าตอบแทน</i></strong>
	 			</span>


        </div>
        <div class="panel-body noradius padding-5">

            <ul class="bullet-list list-unstyled">
                <li class="orange">
                    <h3 class="text-primary">ผู้ช่วยสอน ระดับ ป.ตรี</h3>
                    <strong class="text-red size-12">ภาคปกติ (BN) = ชั่วโมงละ 40 บาท</strong>
                    <strong class="text-red size-12">ภาคสมทบ(BS) = ชั่วโมงละ 50 บาท </strong>
                </li>

                <hr />
                <li class="orange">

                    <h3 class="text-primary">ผู้ช่วยสอน ระดับ ป.โท/ป.เอก</h3>
                    <strong class="text-red size-12">ภาคปกติ (GN)<br>=ไม่เกินเดือนละ3,000บาท/คน </strong>
                    <br><strong class="text-gray">----------------------------------------</strong><br>
                    <strong class="text-red size-12">ภาคสมทบ(GS)<br>=ไม่เกินเดือนละ 4,000 บาท/คน</strong>
                </li>
                <hr />
            </ul>

        </div>

    </section>
</div>
</div>



