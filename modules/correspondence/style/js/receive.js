$(document).ready(function () {
    var listmail = [];
    var countSubmit = 0, idDept;
    $('#money').hide();
    $("#docRefModalDetail").hide();
    $('#checkId').val(1);
    //Wizard change tab process bar
    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }

    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }

    function createDocDept(name) {
        $.ajax({
            url: '../doc-dept/create-docdept',
            type: 'POST',
            data: {
                'name': name
            },
            success: function (response) {
               // console.log(response);
                idDept = response;
            }
        });
    }

    function createReceive(form) {
        //console.log(form.serialize());
        $.ajax({
            url: 'createreceive',
            type: 'POST',
            async: true,
            data: form.serialize(),
            success: function (response) {
                 //console.log(response);
                if (response == "success") {
                    countSubmit++;
                    $("#subjectInUploadFile").text($("#cmsdocument-doc_subject").val());
                    $("#typeInUploadFile").text($("#cmsdocument-type_id option:selected").text());
                    var active = $('.wizard .nav-tabs li.active');
                    active.next().removeClass('disabled');
                    nextTab(active);
                    return true;
                }else {
                    $(".field-datetimepickerrecevie p").append(response);
                    $(".field-datetimepickerrecevie").removeClass('has-success').addClass('has-error');
                }
            }
        });
    }

    function updateReceive(form, idDoc, docRollId, docDoIng) {
        $.ajax({
            url: 'update-receive-in-create-receive-book?id=' + idDoc,
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                //console.log(response);
                if (response == "success") {
                    $.ajax({
                        url: 'update-doc-roll-receive',
                        type: 'GET',
                        data: {
                            'doc_roll_id': docRollId,
                            'doc_roll_doing': docDoIng
                        },
                        success: function (response) {

                        }
                    });
                    $("#subjectInUploadFile").text($("#cmsdocument-doc_subject").val());
                    $("#typeInUploadFile").text($("#cmsdocument-type_id option:selected").text());
                    let active = $('.wizard .nav-tabs li.active');
                    active.next().removeClass('disabled');
                    nextTab(active);
                    return false;
                }else {
                    $(".field-datetimepickerrecevie p").append(response);
                    $(".field-datetimepickerrecevie").removeClass('has-success').addClass('has-error');
                }

            }
        });
        console.log("");
    }

    //create receive book
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
                        console.log('');
                        createReceive(form);
                    }
                });
            } else { //submit ไปแล้วกลับมาแก้ไข
                    let name = $("#keyword").val();
                    let docRollId = $("#cmsdocrollreceive-doc_roll_receive_id").val();
                    let docDoIng = $("#cmsdocrollreceive-doc_roll_receive_doing").val();
                    let idDoc = $('#cmsdocument-doc_id').val();
                $.ajax({
                    url: '../doc-dept/create-docdept',
                    type: 'POST',
                    data: {
                        'name': name
                    },
                    success: function (response) {
                        $('#dept_id').val(response);
                        console.log();
                        updateReceive(form, idDoc, docRollId, docDoIng);

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
    //add class select2
    //$('#cmsdocument-address_id').addClass('select2');
    //$( '#cmsdocument-address_id' ).css( {"display":"block"});
    // $(".next-step").click(function () {
    //     let n = $('#doc_id').val().lastIndexOf("/");
    //     if (!$('#doc_id').val().charAt(n + 1)) {
    //         alert("เลขที่(หนังสือ) จะต้องมีเลขต่อจากกเครื่องหมาย / ด้วย");
    //         $('#doc_id').focus();
    //         return false;
    //     }
    // });
    //get approve value
    $('.approve').change(function () {
        //console.log($(this).val());
        $('#checkId').val($(this).val());
    });
    //get value from class listceo
    $('input[name="ceomail"]').change(function () {
        listmail.push(this.value);
        //console.log(listmail);
    });

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var target = $(e.target);

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
});
