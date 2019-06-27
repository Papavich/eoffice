<!-- page title -->
<header id="page-header">
    <h1>เพิ่มโครงการวิจัย</h1>
    <ol class="breadcrumb">
        <li><a href="#"></a></li>
        <li class="active"></li>
    </ol>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <div class="row">

        <div class="col-md-6">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">


                    <!------------------------------------------- Student form ----------------------------------------------------------------->
                    <strong></strong>
                </div>

                <div class="panel-body">

                    <form class="validate1" action="/cs-e-office/web/portfolio/portfolio/save" method="post"
                          data-success="Sent! Thank you!" data-toastr-position="top-right">
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send"/>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Project ID</label>
                                        <input type="text" name="project_id" value="" class="form-control ">
                                        <!--disabled-->
                                    </div>


                                </div>
                            </div>


                </div>
                <div class="col-md-6 col-sm-6">
                    <label>ชื่อโครงการ(ไทย)</label>
                    <input type="text" name="project_name_thai" value="" class="form-control required">
                </div>
                <div class="col-md-6 col-sm-6">
                    <label>ชื่อโครงการ(อังกฤษ)</label>
                    <input type="text" name="project_name_eng" value="" class="form-control required">
                </div>
                <div class="col-md-6 col-sm-6">
                    <label>ชื่อหัวหน้าโครงการ</label>
                    <input type="text" name="project_led_fname" value="" class="form-control required">
                </div>
                <div class="col-md-6 col-sm-6">
                    <br>
                    <input type="text" name="project_led_lname" value="" class="form-control required">
                </div>
            </div>
            <div class="row">
                <div class="form-group">


                    <div class="col-md-6 col-sm-6">
                        <label>สมาชิก</label>
                        <input type="text" name="project_name_thai" value="" class="form-control required">

                    </div>

                    <div class="col-md-6 col-sm-6">
                        <label></label>
                        <input type="text" name="project_name_eng" value="" class="form-control required">
                    </div>


                    <div class="row">
                        <div class="col-md-9 col-md-offset-8">

                            <input type="submit" name="send" value="เพิ่ม" id="submit" class="btn btn-default">

                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>

                    </fieldset>
                </div>
            </div>
            <!-- /----- -->

        </div>


        <div class="col-md-6">
            <!-- ------ -->
            <div class="panel panel-default">

                <div class="panel-body">


                    <!-- required [php action request] -->
                    <input type="hidden" name="action" value="contact_send"/>


                    <!------------------------------------------- ข้อมูลการศึกษา ----------------------------------------------------------------->
                    <h4>ข้อมูลโครงการ</h4>

                    <div class="row">
                        <div class="form-group">
                            <!--<div class="col-md-6 col-sm-6">
                                <label>แหล่งทุน</label>
                                <input type="text" name="MobilePhone" value="" class="form-control">
                            </div>-->
                            <div class="col-md-6 col-sm-6">
                                <label>ปีที่เริ่ม</label>
                                <input type="text" name="project_start" value="" class="form-control required">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>บีที่สิ้นสุด</label>
                                <input type="text" name="project_end" value="" class="form-control required">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>ระยะเวลา</label>
                                <input type="text" name="project_duration" value="" class="form-control required">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>งบประมาณ</label>
                                <input type="text" name="project_budget" id="t1" value="" class="form-control required">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>ผู้ใช้ทุน</label>
                                <input type="text" name="repayment" id="t2" value="" class="form-control required">
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label>เว็บไซต์</label>
                                <input type="text" name="repayment" id="t3" value="" class="form-control required">
                                <div class="row">
                                    <div class="form-group">
                                    </div>


                                    <script language="javascript">

                                      var t1 = 0

                                      var t2 = 0

                                      //trigger when type
                                      $('input[id^="t1"], input[id^="t2"]').keyup(function () {
                                        var id = $(this).attr('id')
                                        if (id === 't1') {
                                          t1 = parseFloat($(this).val())
                                        } else {
                                          t2 = parseFloat($(this).val())
                                        }
                                        $('#t3').val(t1 * t2)
                                      })


                                    </script>


                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <img width="150" height="150" alt=""
                                     src="<?= Yii::getAlias('@web') ?>/images/noavatar.jpg" height="34" ALIGN=LEFT>
                            </div>

                            <!--<div class="form-group">
                                <div class="sky-form">
                                    <div class="col-md-8">
                                        <label for="file" class="input input-file">
                                            <div class="button">
                                                <input type="file" id="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</div>
                                            <input type="text" readonly>
                                        </label>
                                        <a href="#" class="btn btn-danger btn-xs nomargin"><i class="fa fa-times"></i> Remove Current Image</a>
                                    </div>
                                </div>
                            </div>-->


                        </div>
                    </div>


                    </form>

                </div>

            </div>
            <!-- /----- -->

        </div>

    </div>

</div>