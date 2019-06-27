<!-- page title -->
<header id="page-header">
    <h1>เพิ่มโครงการวิจัย</h1>
    <ol class="breadcrumb">
        <li><a href="#"></a></li>
        <li class="active"></li>
    </ol>
</header>
<!-- /page title -->

<script language="javascript">

  function fncCal()

  {
    var tot = 0;

    var sum = 0;

    for(i=1;i<=document.form1.hdnLine.value;i++)

    {

      tot = parseInt(eval("document.form1.project_budget"+i+".value")) * parseInt(eval("document.form1.repayment"+i+".value"))
      eval("document.form1.project_url"+i+".value="+tot);

      sum = tot + tot;

      document.form1.txtSum.value=sum;

    }

  }

</script>


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

                    <form class="validate1" action="/cs-e-office/web/portfolio/portfolio/save" method="post"  data-success="Sent! Thank you!" data-toastr-position="top-right">
                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send" />

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Project ID</label>
                                        <input type="text" name="project_id" value="" class="form-control " ><!--disabled-->
                                    </div>



                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">






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


                        <fieldset>
                            <!-- required [php action request] -->
                            <input type="hidden" name="action" value="contact_send" />


                            <!------------------------------------------- ข้อมูลการศึกษา ----------------------------------------------------------------->
                            <h4>ข้อมูลโครงการ</h4>

                            <div class="row">
                                <div class="form-group">
                                    <!--<div class="col-md-6 col-sm-6">
                                        <label>แหล่งทุน</label>
                                        <input type="text" name="MobilePhone" value="" class="form-control">
                                    </div>--><?php
                                    //index.php

                                    $connect = new PDO("mysql:host=localhost;dbname=testing4", "root", "");
                                    function fill_unit_select_box($connect)
                                    {
                                        $output = '';
                                        $query = "SELECT * FROM tbl_unit ORDER BY unit_name ASC";
                                        $statement = $connect->prepare($query);
                                        $statement->execute();
                                        $result = $statement->fetchAll();
                                        foreach($result as $row)
                                        {
                                            $output .= '<option value="'.$row["unit_name"].'">'.$row["unit_name"].'</option>';
                                        }
                                        return $output;
                                    }

                                    ?>
                                    <!DOCTYPE html>
                                    <html>
                                    <head>
                                        <title>Add Remove Select Box Fields Dynamically using jQuery Ajax in PHP</title>
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
                                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                                    </head>
                                    <body>
                                    <br />
                                    <div class="container">
                                        <h3 align="center">Add Remove Select Box Fields Dynamically using jQuery Ajax in PHP</h3>
                                        <br />
                                        <h4 align="center">Enter Item Details</h4>
                                        <br />
                                        <form method="post" id="insert_form">
                                            <div class="table-repsonsive">
                                                <span id="error"></span>
                                                <table class="table table-bordered" id="item_table">
                                                    <tr>
                                                        <th>Enter Item Name</th>
                                                        <th>Enter Quantity</th>
                                                        <th>Select Unit</th>
                                                        <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
                                                    </tr>
                                                </table>
                                                <div align="center">
                                                    <input type="submit" name="submit" class="btn btn-info" value="Insert" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    </body>
                                    </html>

                                    <script>
                                      $(document).ready(function(){

                                        $(document).on('click', '.add', function(){
                                          var html = '';
                                          html += '<tr>';
                                          html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
                                          html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';
                                          html += '<td><select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
                                          html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                                          $('#item_table').append(html);
                                        });

                                        $(document).on('click', '.remove', function(){
                                          $(this).closest('tr').remove();
                                        });

                                        $('#insert_form').on('submit', function(event){
                                          event.preventDefault();
                                          var error = '';
                                          $('.item_name').each(function(){
                                            var count = 1;
                                            if($(this).val() == '')
                                            {
                                              error += "<p>Enter Item Name at "+count+" Row</p>";
                                              return false;
                                            }
                                            count = count + 1;
                                          });

                                          $('.item_quantity').each(function(){
                                            var count = 1;
                                            if($(this).val() == '')
                                            {
                                              error += "<p>Enter Item Quantity at "+count+" Row</p>";
                                              return false;
                                            }
                                            count = count + 1;
                                          });

                                          $('.item_unit').each(function(){
                                            var count = 1;
                                            if($(this).val() == '')
                                            {
                                              error += "<p>Select Unit at "+count+" Row</p>";
                                              return false;
                                            }
                                            count = count + 1;
                                          });
                                          var form_data = $(this).serialize();
                                          if(error == '')
                                          {
                                            $.ajax({
                                              url:"insert.php",
                                              method:"POST",
                                              data:form_data,
                                              success:function(data)
                                              {
                                                if(data == 'ok')
                                                {
                                                  $('#item_table').find("tr:gt(0)").remove();
                                                  $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
                                                }
                                              }
                                            });
                                          }
                                          else
                                          {
                                            $('#error').html('<div class="alert alert-danger">'+error+'</div>');
                                          }
                                        });

                                      });
                                    </script>



                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <img width="150" height="150" alt="" src="<?= Yii::getAlias('@web') ?>/images/noavatar.jpg" height="34" ALIGN=LEFT>
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