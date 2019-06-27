<?php include "frame.php" ?>
<html>
<head>
    <title>รายงานหนังสือรับภายใน</title>
</head>

<body>
<section id="middle" style="color: black">
    <div id="content" class="padding-30">
        <div id="panel-2" class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>รายงานหนังสือรับภายใน</strong> <!-- panel title -->
                </span>
            </div>
            <div class="panel-body" align="center">
                <form class="form-horizontal" action="#" method="post">
                    <br><br>
                    <!-- date book -->
                    <div class="form-group">
                        <label class="control-label col-sm-4">วันที่ในหนังสือ : </label>

                        <div class="col-sm-2">
                            <input type="text" class="form-control datepicker"
                                   placeholder="ตั้งแต่"
                                   data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" id="dateStart">
                        </div>

                        <div class="col-xs-1">
                            <label class="control-label col-xs-1">ถึง</label>
                        </div>

                        <div class="col-sm-2">
                            <input type="text" class="form-control datepicker"
                                   placeholder="ถึงวันที่"
                                   data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" id="dateEnd">
                        </div>
                    </div>
                    <div class="form-group" id="SelectTypeFile">
                        <label class="control-label col-xs-4">เลือกไฟล์</label>
                        <div class="col-sm-3">
                        <a href="report.php?typeFile=PDF">
                        <i class="fa fa-file-pdf-o" style="font-size:30px;color:red"></i > 
                        </a>
                        <a href="report.php?typeFile=Excel">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-file-excel-o" style="font-size:30px;color:green"></i>
                        </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <br>
                            <button type="button" class="btn btn-success" id="createReport">ออกรายงาน</button>
                    </div>
                </form>
                <table class="table table-bordered" id="tableReport">
                  <th>เลขทะเบียนรับ</th>
                  <th>ที่</th>
                  <th>ลงวันที่</th>
                  <th>จาก</th>
                  <th>ถึง</th>
                  <th>เรื่อง</th>
                  <th>หมายเหตุ</th>
                </table>                
            </div>
            
        </div>
    </div>
    </div>
</section>
<script type="text/javascript">

    $(function () {
        function calDate(){
                var fromDate = $('#dateStart').val(), 
                    toDate = $('#dateEnd').val(), 
                    from, to, druation;
              
                from = moment(fromDate, 'YYYY-MM-DD'); // format in which you have the date
                to = moment(toDate, 'YYYY-MM-DD');     // format in which you have the date
              
                /* using diff */
                duration = to.diff(from, 'days')     
                var iNum = parseInt(duration) + 1;
                /* show the result */
                //$('#result').text(duration + ' days');
                for(var i = 0; i < iNum; i++){
                    $('#tableReport').append('<tr><td>000'+(i+1)+'</td><td>ศธ.0514.'+(i+1)+'</td>'
                        +'<td>'+fromDate+'</td><td>นายทดลอง</td><td>ระบบ</td><td>สมมติเรื่องที่'+(i+1)
                        +'</td><td></td></tr>');
                    //console.log("aaaaaaaaaaa");
                }            
        }
        $("#SelectTypeFile").hide();
        //Enable check and uncheck all functionality
        $("#createReport").click(function () {
            if($("#dateStart").val() == "" && $("#dateEnd").val() == ""){
                alert("กรุณาระบุวันที่ที่ท่านต้องการออกรายงาน");
            }else{
                $("#SelectTypeFile").show();
                //$("#createReport").hide();
                calDate();

                           
            }
        });

        $('#dateStart').bind('input',function(){
        $('#dateEnd').bind('input',function(){ 
               calDate();
        });
               
        });


    });
</script>
</body>
</html>