<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Html::encode($this->title) . 'หน้าแรก';
?>
<section id="middle">
    <div id="content" class="nopadding-top nopadding-bottom padding-50">

        <div id="panel-1" class="panel panel-default">
            <!-- BOXES -->
            <div class="col-md-1" style="width: 13%">

            </div>
            <div class="row">
                <!-- Online Box -->
                <div class="col-md-3 col-sm-6">

                    <!-- BOX -->
                    <div class="box success"><!-- default, danger, warning, info, success -->
                        <?= Html::a("<div class=\"box-title\"><!-- add .noborder class if box-body is removed -->
                            <h3>250 หนังสือทั้งหมด</h3> 
                            <i class=\"fa fa-globe\"></i>
                        </div>", ['staff-receive/receive-in']) ?>

                    </div>
                    <!-- /BOX -->

                </div>
                <!-- Profit Box -->
                <div class="col-md-3 col-sm-6">
                    <!-- BOX -->
                    <div class="box warning"><!-- default, danger, warning, info, success -->
                        <?= Html::a("<div class=\"box-title\"><!-- add .noborder class if box-body is removed -->
                            <h3>360 หนังสือรับ</h3>                            
                          <i class=\"fa fa-book\"></i>
                        </div>", ['staff-receive/receive-in']) ?>
                    </div>
                    <!-- /BOX -->
                </div>
                <!-- Feedback Box -->
                <div class="col-xs-6 col-sm-3">
                    <!-- BOX -->
                    <div class="box danger"><!-- default, danger, warning, info, success -->
                        <?= Html::a("<div class=\"box-title\"><!-- add .noborder class if box-body is removed -->
                            <h3>280 หนังสือส่ง</h3>                            
                          <i class=\"fa fa-send\"></i>
                        </div>", ['staff-send/send-roll']) ?>
                    </div>
                    <!-- /BOX -->
                </div>
            </div>
            <!-- /BOXES -->
            <div class="row">
                <div class="col-md-12">
                    <div id="panel-3" class="panel panel-default">
                        <div class="panel-heading">
									<span class="title elipsis">
										<strong>เอกสารประจำวัน</strong> <!-- panel title -->
									</span>
                        </div>
                        <!-- panel content -->
                        <div class="panel-body">

                            <ul class="list-unstyled list-hover slimscroll height-300" data-slimscroll-visible="true">

                                <li class="notficationsize">
                                    <span class="label label-danger"><i class="fa fa-bullhorn size-15"></i></span>
                                    <a href="#" style="color: black">
                                        <b>สถาบัน</b>
                                        ขอเรียนเชิญเข้าร่วมโครงการ <br>
                                        ระดับความเร่งด่วน:: <b>ด่วนที่สุด</b> / ชั้นความลับ:: <b>ปกติ</b><br>
                                        <span style="font-size: 10px;" align="right">
                                        28 เม.ย. 2010 11:38 น.
                                    </span>
                                    </a>
                                </li>

                                <li class="notficationsize">
                                    <span class="label label-success"><i class="fa fa-user size-15"></i></span>
                                    <a href="#" style="color: black">
                                        <b>หน่วยสารบรรณ</b>
                                        ขอความอนุเคราะห์ประชาสัมพันธ์การรับสมัครงาน <br>
                                        ระดับความเร่งด่วน:: <b>ปกติ</b> / ชั้นความลับ:: <b>ปกติ</b><br>
                                        <span style="font-size: 10px;" align="right">
                                        28 เม.ย. 2010 11:38 น.
                                    </span>
                                    </a>
                                </li>

                                <li class="notficationsize">
                                    <span class="label label-warning"><i class="fa fa-comment size-15"></i></span>
                                    <a href="#" style="color: black">
                                        <b>หน่วยสารบรรณ</b>
                                        ขอเรียนเชิญเข้าร่วมโครงการ <br>
                                        ระดับความเร่งด่วน:: <b>ด่วน</b> / ชั้นความลับ:: <b>ปกติ</b><br>
                                        <span style="font-size: 10px;" align="right">
                                        28 เม.ย. 2010 11:38 น.
                                    </span>
                                    </a>
                                </li>

                                <li class="notficationsize">
                                    <span class="label label-default"><i class="fa fa-briefcase size-15"></i></span>
                                    <a href="#" style="color: black">
                                        <b>สภาบันมาตรวิทยาแห่งชาติ</b>
                                        ขอเรียนเชิญเข้าร่วมโครงการ <br>
                                        ระดับความเร่งด่วน:: <b>ด่วนที่สุด</b> / ชั้นความลับ:: <b>ปกติ</b><br>
                                        <span style="font-size: 10px;" align="right">
                                        28 เม.ย. 2010 11:38 น.
                                    </span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                        <!-- /panel content -->

                    </div>
                    <!-- /PANEL -->

                </div>
            </div>

        </div>
</section>
<?php
$this->registerJsFile("@web/assets/plugins/bootstrap/js/bootstrap.min.js", [
]);
?>
