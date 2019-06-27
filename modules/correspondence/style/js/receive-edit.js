$(document).ready(function () {
    $('#sendMore').hide();
    var idDept;

    function createNewInbox() {
        //เมื่อคนรับที่หน้า edit receive
        if ($('#checkNeedToSendMore').is(':checked')) {
            var inps = $("input[name='list_mail[]']:checked").map(function () {
                return $(this).val();
            }).get();
            var jsonString = JSON.stringify(inps); //ทำให้อยู่ในรูปของ json
            //console.log(jsonString);
            $.ajax({
                url: '../mail/create-new-inbox-from-edit-receive',
                type: 'POST',
                data: {
                    userList: jsonString,
                    docId: $('#updateId').val()
                },
                success: function () {

                }
            });
        }
        return false;
    }

    var count2 = null;
    $("#w0").submit(function (e) {
        e.preventDefault();
        let url = 'update-receive?id=' + $('#updateId').val();
        if (count2 == null) {
            if (!$('#cmsdocument-doc_tel').val() == "") {
                if (!$.isNumeric($('#cmsdocument-doc_tel').val())) {

                    swal(phoneNumberMustBeNumbersOnly, {
                        icon: "error"
                    });
                    $("#cmsdocument-doc_tel").css('background-color', 'red');
                    return false;
                }
            }
            if (!$('#keyword2').val() == "") {
                $('#keyword2').parent('div').addClass('has-success');
                $(".field-dept_id-error").hide();
                let form = $(this);
                let name = $("#keyword2").val();
                $.ajax({
                    url: '../doc-dept/create-docdept',
                    type: 'POST',
                    data: {
                        'name': name
                    },
                    success: function (response) {
                        $('#dept_id').val(response);
                        createNewInbox();
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: form.serialize(),
                            success: function (response) {
                                // window.location = "detail_book?id=" + $('#updateId').val();
                                if (response == "success") {
                                    window.location = "detail_book?id=" + $('#updateId').val();
                                    return false;
                                } else {
                                    var obj = $.parseJSON(response);
                                    displayInvalidDate(obj);
                                    return false;
                                }

                            }
                        });
                    }
                });
            }
        }
        count2 = 1;
    });

    function displayInvalidDate(obj){
        if(obj.data[0].doc_date != "" && obj.data[1].receive_date != ""){
            $(".field-datetimepicker2 div .help-block").html(obj.data[1].receive_date);
            $(".field-datetimepicker2").removeClass('has-success').addClass('has-error');
            $(".field-datetimepicker3 div .help-block").html(obj.data[0].doc_date);
            $(".field-datetimepicker3").removeClass('has-success').addClass('has-error');
            swal({
                title: giveCorrectDate,
                text: '',
                icon: "error",
                dangerMode: true,
            });
        }
        else if(obj.data[0].doc_date != ""){
            $(".field-datetimepicker3 div .help-block").html(obj.data[0].doc_date);
            $(".field-datetimepicker3").removeClass('has-success').addClass('has-error');
            swal({
                title: giveCorrectDate,
                text: '',
                icon: "error",
                dangerMode: true,
            });
        }else if(obj.data[1].receive_date != ""){
            $(".field-datetimepicker2 div .help-block").html(obj.data[1].receive_date);
            $(".field-datetimepicker2").removeClass('has-success').addClass('has-error');
            swal({
                title: giveCorrectDate,
                text: '',
                icon: "error",
                dangerMode: true,
            });
        }
    }
    /*
    var count2 = null;
    $("#w0").submit(function (e) {
        let form = $(this);
        let url = 'update-receive?id=' + $('#updateId').val();
        let n = $('#doc_id').val().lastIndexOf("/");
        if(e.originalEvent){
            if (!$('#doc_id').val().charAt(n + 1)) {
                alert("เลขที่(หนังสือ) จะต้องมีเลขต่อจากกเครื่องหมาย / ด้วย");
                $('#doc_id').focus();
                return false;
            } else {
                if (!$("#keyword2").val() == "" && count2 == null) {
                    $(this).parent('div').addClass('has-success');
                    if ($("#pname").has('option').length == 0 || $("#keyword2").val() != $("#oldDept").val()) {
                        var name = $("#keyword2").val();
                        $.ajax({
                            url: '../doc-dept/create-docdept',
                            type: 'POST',
                            data: {
                                'name': name
                            },
                            success: function (response) {
                                $('#dept_id').val(response);
                                createNewInbox();
                                $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data: form.serialize(),
                                    success: function (response) {
                                        // window.location = "detail_book?id=" + $('#updateId').val();
                                        console.log(response);
                                    }
                                });
                            }
                        });
                    } else { //มีหน่วยงานอยู่แล้ว
                        //console.log($('#dept_id').val(idDept));
                        createNewInbox();
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: form.serialize(),
                            success: function (response) {
                            }
                        });
                    }
                } else {
                    $("#keyword2").parent('div').addClass('has-error');
                }
            }

            count2 = 1;
        }
        return false;
    });*/

    //check user add file to upload or not
    $("#next_tab2").click(function () {
        var active;
        if ($(".preview").length > 0) {
            if ($("td:eq( 3 )").find('button').length === 2) {
                alert("กรุณาปุ่ม Start เพื่อทำการอัปโหลดไฟล์");
                return false;
            }
        }
        let n = $('#doc_id').val().lastIndexOf("/");
        let doc_id = $('#doc_id').val();
        if (doc_id.charAt(n + 1) == "") {
            $('div.form-group.field-doc_id.required div div div').empty();
            $("#doc_id").parent('div').addClass('has-error');
            $('div.form-group.field-doc_id.required div div div').html('เลขที่(หนังสือ) จะต้องมีเลขต่อจากกเครื่องหมาย / ด้วย');
            //$('#doc_id').val("");
            $('#doc_id').focus();
            return false;
        }
        if ($('#keyword2').val() == "") {
            //หน่วยงานว่าง
            $('#dept_id').val("");
            $("#keyword2").parent('div').addClass('has-error');
            $(".field-dept_id-error").show();
            return false;
        }

    });

    $("#subtype-id").change(function () {
        var id = $("#subtype-id").val();
        if ($("#subtype-id option:selected").text() === "การเงิน" || $("#subtype-id option:selected").text() === "พัสดุ") {
            $('#money').show();
        } else {
            $('#money').hide();
            var test = parseInt("0");
            $('#cms_money').val(test);
            // console.log($('#cms_money').val());
        }
        $.ajax({
            url: '../address/get-address-to-show',
            type: 'GET',
            data: {
                'subtype_id': id
            },
            success: function (response) {
                //console.log(response);
                // var obj = eval(response);
                $("#cmsdocument-address_id").empty();
                $("#cmsdocument-address_id").append("<option value=''>--- กรุณาเลือกสถานที่เก็บต้นฉบับ ---</option>");
                var obj = $.parseJSON(response);
                for (i = 0; i < obj.length; i++) {
                    //  alert(obj[i].address_id);
                    //  console.log(obj);
                    $("#cmsdocument-address_id").append("<option value=" + obj[i].address_id + ">" + obj[i].address_name + "</option>");
                }
            }
        });
    });
    var listmail2 = [];
    //user key up input to forward mail
    $('#keyword-user').on('input', function () {
        var userText = $(this).val();
        //get value user ต้องการ forward ถึงใครบ้าง
        $("#username").find("option").each(function () {
            if ($(this).val() == userText) {
                listmail2.push($(this).data('customvalue'));
                //console.log(listmail);
                $("#receiver").append("<span style='box-sizing: border-box;  border: 1px solid black; margin-right: 10px; padding: 10px;'" +
                    "id='" + $(this).data('customvalue') + "' class='listForward'>"
                    + $(this).val() + "<span style='padding-left: 15px'><i class='fa fa-remove'></i></span></span>");
            }
        })
    });
    $('#checkNeedToSendMore').click(function () {
        $('#sendMore').toggle();
        if ($('#checkNeedToSendMore').is(':checked')) {
            //console.log('aaa');
        }
    });
    $('#keyword2').on('input', function () {
        let value = $(this).val();
        //noinspection JSAnnotator
        //$("#pname").attr('selected', '');
        $('#pname').find('option').each(function () {
            //return this.value === value;
            //console.log($(this).val());
            if ($(this).val() == value) {
                deptId = $('#dept_id').val($(this).data('customvalue'));
                //  console.log("dept_id = " + $('#dept_id').val());
            }
        });
        if ($('#keyword2').val() == "") {
            //หน่วยงานว่าง
            $('#dept_id').val("");
            $("#keyword2").parent('div').addClass('has-error');
            $(".field-dept_id-error").show();
            return false;
        } else {
            $("#keyword2").parent('div').addClass('has-success');
            $(".field-dept_id-error").hide();
        }
    });
});

