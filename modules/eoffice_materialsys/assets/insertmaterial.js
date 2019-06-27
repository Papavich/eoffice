//Onload render list item
$(document).ready(function () {
    $("#material_pass").click(function () {
        $("#mat-pass").slideToggle();
    });
    //Change Detail
    var boxid_old3 = "D3004";
    $('#detail3').change(function () {
        var boxid3 = $("#detail3 option:selected").val();
        if (boxid_old3 != null) {
            $("div[name=" + boxid_old3 + "]").slideToggle(500);
            $("div[name=" + boxid3 + "]").slideDown(500);
        } else {
            $("div[name=" + boxid3 + "]").slideDown(500);
        }
        boxid_old3 = boxid3;
    });
    //get Home url
    var homeurl = $("#homeurl").val();

    //Render list item
    $.ajax({
        type: "POST",
        url: "listmaterial",
        cache: false,
        beforeSend: function () {
            var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
            $('#list-material').prepend(animation);
        },
        success: function (output) {
            $('#list-material').children().remove();
            $('#list-material').prepend(output);
            var amount_list = $("#valueamount").val();
            var price = $("#priceoutput").val();
            $("#amount-list").text(amount_list);
            $("#price").text(price);
        }
    });

    //Detail Bill
    $(".text-bill").on('click', function () {
        $('.detail-bill').slideToggle(200, function () {
            $('#detail_bill').toggleClass(" fa-minus-circle fa-plus-circle");
        });
    });

    //Add material to session $("#addmattosession").attr('disabled', false);
    $("#addmattosession").click(function () {
        var amount = $("#amount").val();
        var price_unit = $("#price_unit").val();
        var material_id = $("#mat_id").val();
        if (amount === '') {
            $("#amount").addClass('error-notfound');
        } else {
            $("#amount").removeClass('error-notfound');
        }
        if (price_unit === '') {
            $("#price_unit").addClass('error-notfound');
        } else {
            $("#price_unit").removeClass('error-notfound');
        }
        if (amount !== '' && price_unit !== '') {
            $.ajax({
                type: "POST",
                url: "creatematerialsession",
                cache: false,
                data: $("#formaddmat").serialize(),
                success: function (output) {
                    if (output === "1") {
                        var success = "<img class=\"loading\" src=\""+image_path+"/components/loading/ok.png\" alt=\"loading\">";
                        var success_text = "<div class=\"loading-text\" >เพิ่มรายการสำเร็จ</div>";
                        $("#addmattosession").attr('disabled', true);
                        $("#obj-material").children().remove();
                        $("#obj-material").prepend(success_text);
                        $("#obj-material").prepend(success);
                        setTimeout(function () {
                            $("#close").click();
                        }, 1000);
                    }
                }
            });
        }
    });

    //Delete item
    $("#commit-delete").click(function () {
        var id = $(this).attr('name');
        $.ajax({
            type: "POST",
            url: "deleteitem",
            cache: false,
            data: {
                id:id
            },
            success: function (output) {
                $('#list-material').children().remove();
                $.ajax({
                    type: "POST",
                    url: "listmaterial",
                    cache: false,
                    beforeSend: function () {
                        var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
                        $('#list-material').prepend(animation);
                    },
                    success: function (output) {
                        $('#list-material').children().remove();
                        $('#list-material').prepend(output);
                        var amount_list = $("#valueamount").val();
                        var price = $("#priceoutput").val();
                        $("#amount-list").text(amount_list);
                        $("#price").text(price);
                    }
                });

                // $('#list-material').children().remove();
                // $('#list-material').prepend(output);
                // var amount_list = $("#valueamount").val();
                // var price = $("#priceoutput").val();
                // $("#amount-list").text(amount_list);
                // $("#price").text(price);
            }
        });
    });

    //Edit confirm
    $("#edit-confirm").click(function () {
        var amount = $("#amount_edit").val();
        var price_unit = $("#price_unit_edit").val();
        var material_id = $("#mat_id_edit").val();
        if (amount === '') {
            $("#amount_edit").addClass('error-notfound');
        } else {
            $("#amount_edit").removeClass('error-notfound');
        }
        if (price_unit === '') {
            $("#price_unit_edit").addClass('error-notfound');
        } else {
            $("#price_unit_edit").removeClass('error-notfound');
        }
        if (amount !== '' && price_unit !== '') {
            $.ajax({
                type: "POST",
                url: "confirmedit",
                cache: false,
                data: $("#formedit").serialize(),
                success: function (output) {
                    $("#close").click();
                    $("#close_edit").click();
                }
            });
        }
    });

    //Event input search
    $("input[id='searchmat']").on("input", function () {
        $("button[name='btn-select-material']").attr('disabled', false);
        $("#searchmat").removeClass('success-input');
        $("#errorEnter").addClass('hidden');
        $("#searchmat").removeClass('error-input');
        $("#errorNotfound").addClass('hidden');

        $('#browsers2').children().remove();
        var value = $(this).val();
        var result = value.search("ไม่พบข้อมูล");
        if (result === 0) {
            $("input[id='searchmat']").val('');
        }
        $.ajax({
            type: "POST",
            url: "searchmaterial",
            cache: false,
            data: "value=" + value,
            success: function (output) {
                $('#browsers2').prepend(output);
            }
        });
        // .done(function (e) {
        //         $('#browsers2').prepend(e);
        //     })

    });

    //Clear search input
    $("#addmat").click(function () {
        $("button[name='btn-select-material']").attr('disabled', false);
        $("#search_mat").removeClass('success-input');
        $("input[id='searchmat']").val('');
        $("#addmattosession").attr('disabled', true);
        $("#obj-material").children().remove();
    });
    //Clear search input
    $("#list-material").on("click", function () {
        $("button[name='btn-select-material']").attr('disabled', false);
        $("#search_mat").removeClass('success-input');
        $("input[id='searchmat']").val('');
        $("#addmattosession").attr('disabled', true);
        $("#obj-material").children().remove();
    });
    //Clear search input when Click button "cancel"
    $("#cancel").click(function () {
        $("#obj-material").children().remove();
        $("input[id='searchmat']").val();
    });

    //Render list items when add item success
    $("#close").click(function () {
        $("#list-material").children().remove();
        $.ajax({
            type: "POST",
            url: "listmaterial",
            cache: false,
            beforeSend: function () {
                var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
                $('#list-material').prepend(animation);
            },
            success: function (output) {
                $('#list-material').children().remove();
                $('#list-material').prepend(output);
                var amount_list = $("#valueamount").val();
                var price = $("#priceoutput").val();
                $("#amount-list").text(amount_list);
                $("#price").text(price);
            }
        });
    });

    //Event click cancel order list
    $("#cancel-list").on('click', function () {
        $("#modalcancel").modal('show');
    });
    //Commit cancel bill
    $("#commit-cancel").on('click',function () {
        $.ajax({
            type: "POST",
            url: "cancelbill",
            cache: false,
            success: function (output) {
                window.location.href = window.location.href;
            }
        });
    });

    //SELECT Material
    $("button[name='btn-select-material']").on("click", function () {
        var value = $("#search_mat").select2('val');
        if (value === null) {
            $("#errorEnter").removeClass('hidden-text');
            $("#select1  .select2").addClass('error-input');
        } else {
            $("#errorEnter").addClass('hidden-text');
            $(".select2").removeClass('error-input');
            $.ajax({
                type: "POST",
                url: "checksearchmaterial",
                cache: false,
                data: "value=" + value,
                beforeSend: function () {
                    var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
                    $('#obj-material').prepend(animation);
                },
                success: function (output) {
                    if (output === "find") {
                        $("#obj-material").children().remove();
                        var find = "<div style='text-align: center'><h3><i class=\"fa fa-exclamation-triangle fa-2x\" style='vertical-align: middle;color: #ecd945' aria-hidden=\"true\"></i>มีวัสดุอยู่ในรายการแล้ว</h3></div>";
                        $('#obj-material').prepend(find);
                    } else {
                        $("#addmattosession").attr('disabled', false);
                        $("#obj-material").children().remove();
                        $("button[name='btn-select-material']").attr('disabled', true);
                        $("#searchmat").addClass('success-input');
                        $.ajax({
                            type: "POST",
                            url: "creatematerialtostock",
                            cache: false,
                            data: "value=" + value,
                            beforeSend: function () {
                                var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
                                $('#obj-material').prepend(animation);
                            },
                            success: function (output) {
                                $('#obj-material').children().remove();
                                $('#obj-material').prepend(output);
                            }
                        });
                    }
                }
            });
        }
    });
    //
    $("#detail-bill input").on('change', function () {
        $(this).removeClass('has-error-valid');
    });

    $("#search_user").change(function () {
        $("#errorEnter_user").addClass('hidden-text');
    });
    //Commit to stock
    $("#commit").click(function (){
        var amount = $("#amount-list").text();
        var resultfilecheck = checkFile();
        var valid = 0;
        var check = 0;
        var user_status = 0;
        var mat_pass = $("#material_pass:checkbox:checked").length;
        var order_detail = '';
        var order_detail_name = '';
        var order_detail_name_id = '';
        $.ajax({
            type: "POST",
            url: "checkvalid",
            dataType: 'json',
            async: false,
            data: $("#detail-bill").serialize(),
            success: function (response) {
                $.each(response, function (key, value) {
                    valid++;
                    var id_input = "#" + key;
                    $(id_input).addClass('has-error-valid');
                });

                if(mat_pass === 1) {
                    var detail_id = $("#detail3").val();
                    if (detail_id === 'D3001') {
                        order_detail = $("div[name='D3001']").find("textarea[name='order_detail']").val();
                        order_detail_name = $("div[name='D3001']").find("input[name='order_detail_name']").val();
                        order_detail_name_id = $("div[name='D3001']").find("input[name='order_detail_name_id']").val();
                        if (order_detail === '' || order_detail_name === '' || order_detail_name_id === '') {
                            if (order_detail === '') {
                                $("div[name='D3001']").find("textarea[name='order_detail']").addClass('error');
                            }
                            if (order_detail_name === '') {
                                $("div[name='D3001']").find("input[name='order_detail_name']").addClass('error')
                            }
                            if (order_detail_name_id === '') {
                                $("div[name='D3001']").find("input[name='order_detail_name_id']").addClass('error')
                            }
                            check++;
                        }
                    } else if (detail_id === 'D3002') {
                        order_detail = $("div[name='D3002']").find("textarea[name='order_detail']").val();
                        order_detail_name = $("div[name='D3002']").find("input[name='order_detail_name']").val();
                        order_detail_name_id = $("div[name='D3002']").find("input[name='order_detail_name_id']").val();
                        if (order_detail === '' || order_detail_name === '' || order_detail_name_id === '') {
                            if (order_detail === '') {
                                $("div[name='D3002']").find("textarea[name='order_detail']").addClass('error');
                            }
                            if (order_detail_name === '') {
                                $("div[name='D3002']").find("input[name='order_detail_name']").addClass('error')
                            }
                            if (order_detail_name_id === '') {
                                $("div[name='D3002']").find("input[name='order_detail_name_id']").addClass('error')
                            }
                            check++;
                        }
                    } else if (detail_id === 'D3003') {
                        order_detail = $("div[name='D3003']").find("textarea[name='order_detail']").val();
                        order_detail_name = $("div[name='D3003']").find("input[name='order_detail_name']").val();
                        order_detail_name_id = '';
                        if (order_detail === '' || order_detail_name === '') {
                            if (order_detail === '') {
                                $("div[name='D3003']").find("textarea[name='order_detail']").addClass('error');
                            }
                            if (order_detail_name === '') {
                                $("div[name='D3003']").find("input[name='order_detail_name']").addClass('error')
                            }
                            check++;
                        }
                    } else {
                        order_detail = $("div[name='D3004']").find("textarea[name='order_detail']").val();
                        order_detail_name = '';
                        order_detail_name_id = '';
                        if (order_detail === '') {
                            if (order_detail === '') {
                                $("div[name='D3004']").find("textarea[name='order_detail']").addClass('error');
                            }
                            check++;
                        }
                    }
                    var user_name = $("#search_user").val();
                    if (user_name === null) {
                        $("#errorEnter_user").removeClass('hidden-text');
                        user_status++;
                    }
                }
            }
        });
        if ( amount > 0 && resultfilecheck === "1" && valid === 0 && check === 0 && user_status === 0) {
            if(mat_pass === 0){
                $("#myDropzone").removeClass('error-notfound');
                $("#dropfile-help").addClass('hidden-text');
                $.ajax({
                    type: "POST",
                    url: "preview",
                    cache: false,
                    data: $("#detail-bill").serialize(),
                    beforeSend: function (xhr, settings) {
                        settings.data += '&company='+$("#matsysbillmaster-company_id option:selected").text();
                        $("#preview-content").children().remove();
                        var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
                        $('#preview-content').prepend(animation);
                        $("#preview").modal('show');
                    },
                    success: function (response) {
                        $("#preview-content").children().remove();
                        // $("#preview-content").children().remove();
                        $("#preview-content").append(response);
                        // $("#preview").modal('show');
                    }
                });
            }else{
                $("#myDropzone").removeClass('error-notfound');
                $("#dropfile-help").addClass('hidden-text');
                var id_user = $("#search_user").val();
                $.ajax({
                    type: "POST",
                    url: "previewpass",
                    cache: false,
                    data: $("#detail-bill").serialize(),
                    beforeSend: function (xhr, settings) {
                        settings.data += '&company='+$("#matsysbillmaster-company_id option:selected").text();
                        settings.data += '&id_user='+id_user;
                        settings.data += '&order_detail='+order_detail;
                        settings.data += '&order_detail_name='+order_detail_name;
                        settings.data += '&order_detail_name_id='+order_detail_name_id;
                        $("#preview-content").children().remove();
                        var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
                        $('#preview-content').prepend(animation);
                        $("#preview").modal('show');
                    },
                    success: function (response) {
                        $("#preview-content").children().remove();
                        // $("#preview-content").children().remove();
                        $("#preview-content").append(response);
                        // $("#preview").modal('show');
                    }
                });

            }
        } else if(resultfilecheck !== "1") {
            $("#myDropzone").addClass('error-notfound');
            $("#dropfile-help").removeClass('hidden-text');
        }
        if(amount  < 1){
            $('#list-material h2').effect( "shake" );
        }

    });

    //Submit to Database
    $("#submit-database").click(function () {
        var check = 0;
        var order_detail = '';
        var order_detail_name = '';
        var order_detail_name_id = '';
        var detail_id = $("#detail3").val();
        if (detail_id === 'D3001') {
            order_detail = $("div[name='D3001']").find("textarea[name='order_detail']").val();
            order_detail_name = $("div[name='D3001']").find("input[name='order_detail_name']").val();
            order_detail_name_id = $("div[name='D3001']").find("input[name='order_detail_name_id']").val();
            if (order_detail === '' || order_detail_name === '' || order_detail_name_id === '') {
                if (order_detail === '') {
                    $("div[name='D3001']").find("textarea[name='order_detail']").addClass('error');
                }
                if (order_detail_name === '') {
                    $("div[name='D3001']").find("input[name='order_detail_name']").addClass('error')
                }
                if (order_detail_name_id === '') {
                    $("div[name='D3001']").find("input[name='order_detail_name_id']").addClass('error')
                }
                check++;
            }
        } else if (detail_id === 'D3002') {
            order_detail = $("div[name='D3002']").find("textarea[name='order_detail']").val();
            order_detail_name = $("div[name='D3002']").find("input[name='order_detail_name']").val();
            order_detail_name_id = $("div[name='D3002']").find("input[name='order_detail_name_id']").val();
            if (order_detail === '' || order_detail_name === '' || order_detail_name_id === '') {
                if (order_detail === '') {
                    $("div[name='D3002']").find("textarea[name='order_detail']").addClass('error');
                }
                if (order_detail_name === '') {
                    $("div[name='D3002']").find("input[name='order_detail_name']").addClass('error')
                }
                if (order_detail_name_id === '') {
                    $("div[name='D3002']").find("input[name='order_detail_name_id']").addClass('error')
                }
                check++;
            }
        } else if (detail_id === 'D3003') {
            order_detail = $("div[name='D3003']").find("textarea[name='order_detail']").val();
            order_detail_name = $("div[name='D3003']").find("input[name='order_detail_name']").val();
            order_detail_name_id = '';
            if (order_detail === '' || order_detail_name === '') {
                if (order_detail === '') {
                    $("div[name='D3003']").find("textarea[name='order_detail']").addClass('error');
                }
                if (order_detail_name === '') {
                    $("div[name='D3003']").find("input[name='order_detail_name']").addClass('error')
                }
                check++;
            }
        } else {
            order_detail = $("div[name='D3004']").find("textarea[name='order_detail']").val();
            order_detail_name = '';
            order_detail_name_id = '';
            if (order_detail === '') {
                if (order_detail === '') {
                    $("div[name='D3004']").find("textarea[name='order_detail']").addClass('error');
                }
                check++;
            }
        }
        var id_user = $("#search_user").val();
        var mat_pass = $("#material_pass:checkbox:checked").length;
        $.ajax({
            type: "POST",
            url: "savematerial",
            data: $("#detail-bill").serialize(),
            beforeSend: function (xhr, settings) {
                settings.data += '&mat_pass='+mat_pass;
                settings.data += '&id_user='+id_user;
                settings.data += '&order_detail='+order_detail;
                settings.data += '&order_detail_name='+order_detail_name;
                settings.data += '&order_detail_name_id='+order_detail_name_id;
                settings.data += '&detail_id='+detail_id;
                $("#preview-content").children().remove();
                var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
                $('#preview-content').prepend(animation);
                $("#preview").modal('show');
            },
            success: function (response) {
                if(response === "success"){
                    $("#preview-content").children().remove();
                    var success = "<img class=\"loading\" src=\""+image_path+"/components/loading/ok.png\" alt=\"loading\"><div class=\"loading-text\" >ทำรายการสำเร็จ</div>";
                    $("#preview-content").append(success);
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1000);
                }else{
                    $('#preview').modal('toggle');
                    $("#ErrorDatabase").modal('show');
                }
            }
        });
    });
});

//Disable enter key
$(document).on("keypress", 'form', function (e) {
    var code = e.keyCode;
    if (code === 13) {
        e.preventDefault();
        return false;
    }
});

//function set id for delete
function setDeleteList(id) {
    $("#commit-delete").attr('name', id);
}

//function set id for edit
function setEditlist(id) {
    $.ajax({
        type: "POST",
        url: "editlist",
        cache: false,
        data: "id=" + id,
        beforeSend: function () {
            var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
            $('#modalEdit').prepend(animation);
        },
        success: function (output) {
            $("#modalEdit").children().remove();
            $("#modalEdit").append(output);
        }
    });
}

//check file PDF
function checkFile() {
    var resultfilecheck = null;
    $.ajax({
        type: "POST",
        url: "checkfile",
        cache: false,
        async: false,
        success: function (output) {
            resultfilecheck = output;
        }
    });
    return resultfilecheck;
}

$(document).delegate("#layout-ModalCreate .error", "keyup", function () {
    $(this).removeClass('error');
});