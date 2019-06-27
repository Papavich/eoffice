<!-- page title -->
<header id="page-header">
    <h1>คำนวณค่านำ้หนัก</h1>
    <ol class="breadcrumb">
        <li><a href="#">ผลงานตีพิมพ์</a></li>
        <li class="active">คำนวณค่านำ้หนัก</li>
    </ol>
</header>
<!-- /page title -->

<br>



<center class="col-md-12">
    <!-- ------ -->
    <div class="panel panel-default">

        <div class="panel-body">


                    <form class="validate1" action="/cs-e-office/web/portfolio/portfolio/save" method="post"
                          data-success="Sent! Thank you!" data-toastr-position="top-right">

                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send"/>




            <!-- /----- -->







                    <!-- required [php action request] -->
                    <input type="hidden" name="action" value="contact_send"/>


                    <!------------------------------------------- ข้อมูลการศึกษา ----------------------------------------------------------------->

                            <!--<div class="col-md-6 col-sm-6">
                                <label>แหล่งทุน</label>
                                <input type="text" name="MobilePhone" value="" class="form-control">
                            </div>-->


                            <div class="col-md-4 col-sm-4">
                                <label>ค่านํ้าหนัก</label>
                                <input type="text" name="" id="t1" value="" class="form-control required">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label>จำนวนผลงาน</label>
                                <input type="text" name="" id="t2" value="" class="form-control required">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label>คะแนนถ่วงนํ้าหนัก</label>
                                <input type="text" name="data" id="t3" value="" class="form-control required">
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
    <center></center><div class="row">
        <div class="col-md-12 col-sm-12">

            <input type="submit" name="send" value="คำนวณ" id="submit" class="btn btn-default">

            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </div></center>


    </form>
</div>

