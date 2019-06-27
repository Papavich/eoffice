$(document).ready(function () {
    $('#money').hide();
    $("#docRefModalDetail").hide();
    $('#hidden-input').hide();

    //set format datetimepicker2
    // $('#datetimepickerrecevie').datetimepicker({
    //     format: 'YYYY-MM-DD HH:mm:ss'
    // });
    $("#datetimepickerrecevie").datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'

    });

    $("#doc_id").click(function () {
        $("#doc_id").val("ศธ.0514.2.1.3/");
    });

    //add doc reg
    $("a[href='#docRefModal']").click(function () {
        $("#docRefModalDetail").toggle();
    });
    //get doc reg
    $('#docRefList').click(function () {
        var inps = $("input[name='docIdRef[]']:checked").map(function () {
            return $(this).val();
        }).get();
        //console.log(inps);
        $('#docRef').val(inps);
    });

    //ตอนเข้าหน้าเว็บจะเช็ดค่าของหมวดหมู่เพื่อเลือกการเสนอผล
    if ($("#subtype-id option:selected").text() === "การเงิน" || $("#subtype-id option:selected").text() === "พัสดุ") {
        $('#money').show();

    } else {
        $('#money').hide();
       // $('#cms_money').val("");

    }
    //check Tel input is number
    $('#cmsdocument-doc_tel').change( function (e) {
        if (!$(this).val()==""){
            if (!$.isNumeric($('#cmsdocument-doc_tel').val())) {

                swal(phoneNumberMustBeNumbersOnly,{
                    icon: "error"
                });
                $("#cmsdocument-doc_tel").css('background-color','red');
                return false;
            }else{
                $("#cmsdocument-doc_tel").css('background-color','');
            }
        }

    });

});

