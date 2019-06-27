<?php include "frame.php" ?>
<html>
<head>
    <title>รายงานหนังสือส่งภายใน</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment.min.js"></script>
</head>

<body>
<section id="middle" style="color: black">
    <div id="content" class="padding-30">
        <div id="panel-2" class="panel panel-default">
            <div class="panel-heading">
                <span class="title elipsis">
                    <strong>รายงานหนังสือส่งภายใน</strong> <!-- panel title -->
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
                  <th>เลขทะเบียนส่ง</th>
                  <th>ว/ด/ป</th>
                  <th>จาก</th>
                  <th>ถึง</th>
                  <th>เรื่อง</th>
                  <th>การปฏิบัติ</th>
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
                    from, to, druation,test;
              
                from = moment(fromDate, 'YYYY-MM-DD'); // format in which you have the date
                to = moment(toDate, 'YYYY-MM-DD');     // format in which you have the date
                test = moment(fromDate, 'DD/MM/YYYY');
                /* using diff */
                duration = to.diff(from, 'days')     
                var iNum = parseInt(duration) + 1;
                /* show the result */
                //$('#result').text(duration + ' days');
                var dteSplit = fromDate.split("-");
                var yr = dteSplit[0][2] + dteSplit[0][3]; //special yr format, take last 2 digits
                var month = dteSplit[1];
                var day = parseInt(dteSplit[2]);

                var dteSplit2 = toDate.split("-");
                var yr2 = dteSplit[0][2] + dteSplit[0][3]; //special yr format, take last 2 digits
                var month2 = dteSplit[1];
                var day2 = parseInt(dteSplit[2]);


                for(var i = 0; i < iNum; i++){
                    $('#tableReport').append('<tr><td>000'+(i+1)+'</td><td>'+(day+i)+'/'+month+'/'+yr+'</td>'
                        +'<td>นายทดลอง</td><td>ระบบ</td><td>สมมติเรื่องที่'+(i+1)+'</td><td>'
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
                $("#createReport").hide();
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