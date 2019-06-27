$(document).ready(function () {
    var listmail = [];
    var countSubmit = 0, idDept, checkDept;
    $('#money').hide();
    $("#docRefModalDetail").hide();

    //Wizard change tab process bar
    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }

    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }

    function createSendRoll(form) {
        //console.log(form.serialize());
        $.ajax({
            url: 'create-send-roll',
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                // console.log(response);
                // console.log(countSubmit);
                if (response == "success") {
                    countSubmit++;
                    $("#subjectInUploadFile").text($("#cmsdocument-doc_subject").val());
                    $("#typeInUploadFile").text($("#cmsdocument-type_id option:selected").text());
                    var active = $('.wizard .nav-tabs li.active');
                    active.next().removeClass('disabled');
                    nextTab(active);

                } else if (response == "update success") {
                    var active = $('.wizard .nav-tabs li.active');
                    active.next().removeClass('disabled');
                    nextTab(active);
                }else {
                    $(".field-datetimepickerrecevie div .help-block").html(response);
                    $(".field-datetimepickerrecevie").removeClass('has-success').addClass('has-error');
                }
            }
        });
    }

    function updateSendRoll(form, idDoc, docRollId, docDoIng) {
        $.ajax({
            url: 'update-send-in-create-send-book?id=' + idDoc,
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                // console.log(response);
                if (response == "success") {
                    $("#subjectInUploadFile").text($("#cmsdocument-doc_subject").val());
                    $("#typeInUploadFile").text($("#cmsdocument-type_id option:selected").text());
                    var active = $('.wizard .nav-tabs li.active');
                    active.next().removeClass('disabled');
                    nextTab(active);

                } else if (response == "update success") {
                    var active = $('.wizard .nav-tabs li.active');
                    active.next().removeClass('disabled');
                    nextTab(active);
                }else {
                    $(".field-datetimepickerrecevie div .help-block").html(response);
                    $(".field-datetimepickerrecevie").removeClass('has-success').addClass('has-error');
                }
            }
        });
        //update การปฏิบัติ
        // console.log(docRollId);
        $.ajax({
            url: 'update-doc-roll-send',
            type: 'GET',
            data: {
                'doc_roll_id': docRollId,
                'doc_roll_doing': docDoIng
            },
            success: function (response) {

            }
        });
    }
    // $(".next-step").click(function () {
    //     let n = $('#doc_id').val().lastIndexOf("/");
    //     if (!$('#doc_id').val().charAt(n + 1)) {
    //         alert("เลขที่(หนังสือ) จะต้องมีเลขต่อจากกเครื่องหมาย / ด้วย");
    //         $('#doc_id').focus();
    //         return false;
    //     }
    // });

    $("#w0").submit(function (e) {
        let n = $('#doc_id').val().lastIndexOf("/");
        if (!$('#cmsdocument-doc_tel').val()==""){
            if (!$.isNumeric($('#cmsdocument-doc_tel').val())) {
                swal(phoneNumberMustBeNumbersOnly,{
                    icon: "error"
                });
                $("#cmsdocument-doc_tel").css('background-color','red');
                return false;
            }
        }
        if (!$('#keyword').val() == "" && e.originalEvent && $('#doc_id').val().charAt(n + 1)) {
            $('#keyword').parent('div').addClass('has-success');
            $(".field-dept_id-error").hide();
            let form = $(this);
            if (countSubmit == 0) {
                //ถ้าผู้ใช้กรอกหน่วยงานใหม่เข้ามา
                let name = $("#keyword").val();
                $.ajax({
                    url: '../doc-dept/create-docdept',
                    type: 'POST',
                    data: {
                        'name': name
                    },
                    success: function (response) {
                        $('#dept_id').val(response);
                        console.log();
                        createSendRoll(form);
                    }
                });
            } else { //submit ไปแล้วกลับมาแก้ไข
                let name = $("#keyword").val();
                let idDoc = $('#cmsdocument-doc_id').val();
                let docRollId = $("#cmsdocrollsend-doc_roll_send_id").val();
                let docDoIng = $("#cmsdocrollsend-doc_roll_send_doing").val();
                $.ajax({
                    url: '../doc-dept/create-docdept',
                    type: 'POST',
                    data: {
                        'name': name
                    },
                    success: function (response) {
                        $('#dept_id').val(response);
                        // console.log($('#dept_id').val());
                        updateSendRoll(form, idDoc, docRollId, docDoIng);
                    }
                });
            }
        }else if ($('#keyword').val() == ""  && e.originalEvent) {
            $("#keyword").parent('div').addClass('has-error');
            $(".field-dept_id-error").show();
        }
        //console.log("w0",countSubmit);
        //console.log(e.originalEvent,countSubmit);
        if (!$('#doc_id').val().charAt(n + 1)) {
            alert("เลขที่(หนังสือ) จะต้องมีเลขต่อจากกเครื่องหมาย / ด้วย");
            $('#doc_id').focus();
            return false;
        }
        return false;
    });

    //get value from class listceo
    $('input[name="ceomail"]').change(function () {
        listmail.push(this.value);
        //console.log(listmail);
    });
    //add last option in doc type
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        let target = $(e.target);

        if (target.parent().hasClass('disabled')) {
            return false;
        }
    });
    $(".next-step2").click(function (e) {
        var active = $('.wizard .nav-tabs li.active');
        active.next().removeClass('disabled');
        nextTab(active);
    });

    $(".prev-step").click(function (e) {

        var active = $('.wizard .nav-tabs li.active');
        prevTab(active);

    });

    $('#keyword').on('input', function () {
        let value = $(this).val();
        $(this).parent('div').removeClass('has-error');
        $(this).parent('div').addClass('has-success');
        $('.field-dept_id-error').hide();
        $('#pname').find('option').each(function () {
            if ($(this).val() == value) {
                $('#dept_id').val($(this).data('customvalue'));
                //console.log("dept_id = " + $('#dept_id').val());
                checkDept = false;
            } else {
                //console.log("true");
                checkDept = true;
            }
        });
    });

    $("#subtype-id").change(function () {
        if ($("#subtype-id option:selected").text() === "การเงิน" || $("#subtype-id option:selected").text() === "พัสดุ") {
            $('#money').show();
//set expire date book
            $('#docExpire').val(dateExpixe2);
            //console.log(dateExpixe2);
        } else {
            $('#money').hide();
            $('#cms_money').val("");
//set expire date book
            $('#docExpire').val(dateExpixe1);
        }
    });
    $("#saveSendButton").click(function () {
        window.location.href = 'detail_book?id=' + $('#cmsdocument-doc_id').val();
    });
    /* $("#saveReceiveButton").click(function (e) {
     var inps = $("input[name='ceomail[]']:checked").map(function(){return $(this).val();}).get();
     var type = "send";
     //console.log(inps);
     $.ajax({
     url: '../mail/createinbox',
     type: 'POST',
     data: {'ceomail': inps,
     'type' : type
     },
     success: function (response) {
     console.log(response);
     if (response == "success") {
     swal("ดำเนินการเสร็จสิ้น!", "", "success");
     window.setTimeout(function () {
     window.location.href = 'receive-roll';
     }, 1500);
     }
     }
     });
     return false;

     //check user add file to upload or not
     $("#saveSendButton").click(function () {
     // var active;
     // if ($(".preview").length > 0) {
     //     if ($("td:eq( 3 )").find('button').length === 2) {
     //         alert("กรุณาปุ่ม Start เพื่อทำการอัปโหลดไฟล์");
     //         active = $('.wizard .nav-tabs li.active');
     //         prevTab(active);
     //     } else {
     //         swal("ดำเนินการเสร็จสิ้น!", "", "success");
     //         window.setTimeout(function () {
     //
     //         }, 1500);
     //     }
     // }
     /*else{
     alert("กรุณาอัปโหลดไฟล์ก่อนไปขั้นตอนถัดไป");
     active = $('.wizard .nav-tabs li.active');
     prevTab(active);
     }
     window.location.href = 'detail_book?id='+$("#cmsdocument-doc_id").val();
     });
     });*/
});
