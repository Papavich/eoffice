$(document).ready(function () {
    var deptId;
    $('#datetimepicker2').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });
    $('#datetimepicker3').datetimepicker({
        dateFormat: 'yy-mm-dd',
        timeFormat: 'HH:mm:ss'
    });
    $('#keyword').on('input', function () {
        var value = $(this).val();
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

    });

    function updateSend(form, url) {
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                if (response != "success") {
                    var obj = $.parseJSON(response);
                    displayInvalidDate(obj);
                    return false;
                } else {
                    window.location = "detail_book?id=" + $('#updateId').val();
                }
            }
        });
        return 0;
    }

    $("#w0").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let url = 'update-send?id=' + $('#updateId').val();
        let docRollId = $("#cmsdocrollsend-doc_roll_send_id").val();
        let docDoIng = $("#cmsdocrollsend-doc_roll_send_doing").val();
        //console.log(docRollId + " " + docDoIng);
        //check user add file to upload or not
        if (!$('#cmsdocument-doc_tel').val() == "") {
            if (!$.isNumeric($('#cmsdocument-doc_tel').val())) {
                swal(phoneNumberMustBeNumbersOnly, {
                    icon: "error"
                });
                $("#cmsdocument-doc_tel").css('background-color', 'red');
                return false;
            }
        }
        if ($("#pname").has('option').length == 0 || $("#keyword").val() != $("#oldDept").val()) {
            var name = $("#keyword").val();
            if(name == ""){
                $("#keyword").parent('div').addClass('required has-error');
                $(".field-dept_id-error").show();
                return false;
            }else {
                $("#keyword").parent('div').addClass('required has-success');
                $(".field-dept_id-error").hide();
            }
            $.ajax({
                url: '../doc-dept/create-docdept',
                type: 'POST',
                data: {
                    'name': name
                },
                success: function (response) {
                    $('#dept_id').val(response);
                    updateSend(form,url);
                }
            });
        }else if ($('#keyword').val() == "" && e.originalEvent) {
            $("#keyword").parent('div').addClass('has-error');
            $(".field-dept_id-error").show();
        } else {
            /*$.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                success: function (response) {
                    // window.location = "detail_book?id=" + $('#updateId').val();
                    //console.log(response);
                }
            });*/
            updateSend(form, url);
        }
        //   return false;
    });

    function displayInvalidDate(obj) {
        if (obj.data[0].doc_date != "" && obj.data[1].sent_date != "") {
            $(".field-datetimepicker2 div .help-block").html(obj.data[1].sent_date);
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
        else if (obj.data[0].doc_date != "") {
            $(".field-datetimepicker3 div .help-block").html(obj.data[0].doc_date);
            $(".field-datetimepicker3").removeClass('has-success').addClass('has-error');
            swal({
                title: giveCorrectDate,
                text: '',
                icon: "error",
                dangerMode: true,
            });
        } else if (obj.data[1].sent_date != "") {
            $(".field-datetimepicker2 div .help-block").html(obj.data[1].sent_date);
            $(".field-datetimepicker2").removeClass('has-success').addClass('has-error');
            swal({
                title: giveCorrectDate,
                text: '',
                icon: "error",
                dangerMode: true,
            });
        }
    }

//ajax onchange subtype
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
                    $("#cmsdocument-address_id").append("<option value=" + obj[i].address_id + ">" + obj[i].address_name + "</option>");
                }
            }
        });
    });
    $('#keyword').on('input', function () {
        let value = $(this).val();
        $(this).parent('div').removeClass('has-error');
        $(this).parent('div').addClass('has-success');
        $('.field-dept_id-error').hide();

    });
    //check user add file to upload or not
    $("#saveEditSend").click(function () {
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
        if ($('#keyword').val() == "") {
            //หน่วยงานว่าง
            $('#dept_id').val("");
            $("#keyword").parent('div').addClass('has-error');
            $(".field-dept_id-error").show();
            return false;
        }

    });
});

