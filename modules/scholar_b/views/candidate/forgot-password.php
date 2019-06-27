<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 13/1/2561
 * Time: 18:53
 */

$this->title = 'Change Password';
?>

<div id="content" class="padding-20">
    <div class="row">
        <div class="panel-body">
            <section class="content">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">

                                <div class="body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12  col-sm-12">
                                            <div class="widget widget-nopad">
                                                <div class="widget-header box-header bg-teal">
                                                    <h3><i class="fa fa-question-circle" aria-hidden="true"></i>
                                                        ลืมรหัสผ่าน สำหรับนักเรียน
                                                    </h3>
                                                </div>

                                                <div class="widget-content">
                                                    <div class="widget big-stats-container">
                                                        <div class="widget-content widget-padding">


                                                            <form class="form-horizontal" action="" method="post">

                                                                <fieldset>
                                                                    <input type="hidden" name="_csrf"
                                                                           value="<?php echo Yii::$app->request->getCsrfToken() ?>"/>

                                                                    <legend>โปรดระบุข้อมูลเพื่อใช้ยืนยันตัวตน</legend>

                                                                    <br/>

                                                                    <br/>
                                                                    <div class="form-group">
                                                                        <label class="col-md-4 control-label"
                                                                               for="citizenid">รหัสประจำตัวประชาชน</label>
                                                                        <div class="col-md-4">
                                                                            <div class="form-line">
                                                                                <input id="id_card" name="id_card"
                                                                                       type="text"
                                                                                       placeholder="รหัสประจำตัวประชาชน 13 หลัก"
                                                                                       class="form-control input-md"
                                                                                       maxlength="13" autocomplete="off"
                                                                                       value=""
                                                                                       required="">
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-4 control-label"
                                                                               for="email">อีเมล</label>
                                                                        <div class="col-md-4">
                                                                            <div class="form-line">
                                                                                <input id="email" name="email"
                                                                                       type="text"
                                                                                       placeholder="อีเมลที่นักเรียนได้ลงทะเบียนไว้"
                                                                                       maxlength="50" autocomplete="off"
                                                                                       value=""
                                                                                       class="form-control input-md"
                                                                                       required="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-4 control-label"></label>
                                                                        <div class="col-md-4">
                                                                            <button type="submit"
                                                                                    class="btn btn-lg btn-success">
                                                                                <i class="fa fa-check-square"></i>
                                                                                ตรวจสอบข้อมูล
                                                                            </button>
                                                                            <a href="../candidate/login">กลับสู่หน้าเข้าสู่ระบบ</a>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>