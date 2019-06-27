<!-- page title -->
<header id="page-header">
    <h1>รายการเพิ่มวัสดุ</h1>
</header>
<!-- /page title -->


<div id="content" class="padding-20">

    <div class="row">

        <div class="col-md-12">

            <!-- ------ -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>แบบฟอร์มการทำรายการ</strong>
                </div>

                <div class="panel-body">

                    <form class="validate" action="php/contact.php" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send"/>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <label>ชื่อวัสดุ</label>
                                        <input type="text" name="mat_name" value="กาแฟ 3 in 1" class="form-control required" disabled>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>ชื่อแบรนด์</label> <br>
                                        <textarea name="mat_detail" row="4" class="form-control required"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <label>จำนวน</label>
                                        <input type="number" name="mat_price" value="12" class="form-control required" disabled>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <label>ราคา/หน่วย</label>
                                        <input type="number" name="mat_name" value="169.00" class="form-control required" disabled>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <label>หน่วยนับ</label>
                                        <input type="text" name="mat_amount" value="บาท" class="form-control required" disabled>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-6">
                                        <label>ยอดรวม</label>
                                        <input type="number" name="mat_name" value="1629.00" class="form-control required" disabled>
                                    </div>
                                </div>
                            </div>

                        </fieldset>

                        <span class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <button type="button" class="btn btn-3d btn-success btn-block margin-top-30">
                                             <i class="glyphicon glyphicon-edit" aria-hidden="false"></i>บันทึก
                                        </button>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                        <button type="ิbutton" class="btn btn-3d btn btn-danger btn-block margin-top-30">
                                             <i class="glyphicon glyphicon-remove" aria-hidden="false"></i>ยกเลิก
                                        </button>
                                    </div>
                                </span>

                    </form>

                </div>

            </div>
            <!-- /----- -->

        </div>

    </div>
</div>