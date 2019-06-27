$(document).ready(function () {


    //Delete Material
    $("a[name='btn-delete']").click(function () {
        var mat_id = $(this).attr('data-id');
        $("#ConfirmModalDelete").modal('show');
        $("#ConfirmModalDelete").find("a[name='confirm-delete']").attr('data-id', mat_id);
    });
    $("a[name='confirm-delete']").click(function () {
        var mat_id = $(this).attr('data-id');
        $.ajax({
            url: 'delete',
            type: 'POST',
            data: {
                id: mat_id
            },
            success: function (data) {
                if (data === 'false') {
                    $("#ErrorModalDelete").modal('show');
                } else {
                    $("#SuccessModalDelete").modal('show');
                    setTimeout(function () {
                        window.location.href = "listmaterial";
                    }, 1000);
                }

            }
        });
    });

    var thaiYear = function (ct) {
        var leap=3;
        var dayWeek=["พฤ.", "ศ.", "ส.", "อา.","จ.", "อ.", "พ."];
        if(ct){
            var yearL=new Date(ct).getFullYear()-543;
            leap=(((yearL % 4 == 0) && (yearL % 100 != 0)) || (yearL % 400 == 0))?2:3;
            if(leap==2){
                dayWeek=["ศ.", "ส.", "อา.", "จ.","อ.", "พ.", "พฤ."];
            }
        }
        this.setOptions({
            i18n:{ th:{dayOfWeek:dayWeek}},dayOfWeekStart:leap,
        })
    };

    $("#datesearch").datetimepicker({
        timepicker:false,
        format:'d-m-Y',  // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000
        lang:'th',  // แสดงภาษาไทย
        onChangeMonth:thaiYear,
        onShow:thaiYear,
        yearOffset:543,  // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
        closeOnDateSelect:true,
    });
});