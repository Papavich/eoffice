$(document).ready(function () {
    var url = home_path + "eoffice_materialsys/orderstatus/amountstatus";
    var url_amount_mat = home_path + "eoffice_materialsys/material/amountcheck";
    $.ajax({
        url: url,
        type: "GET",
        success:function (data) {
            var status = '';
            if(data !== ''){
                status = "<span style='background-color: #ffa200' class=\"badge pull-right\">"+data+"</span>";
            }else{
                status = "<span class=\"badge pull-right\">0</span>";
            }
            $(".fa-check-square-o").parent().prepend(status);
        }
    });
    $.ajax({
        url: url_amount_mat,
        type: "GET",
        success:function (data) {
            var status = '';
            if(data !== ''){
                status = "<span style='background-color: #ffa200' class=\"badge pull-right\">"+data+"</span>";
            }else{
                status = "<span class=\"badge pull-right\">0</span>";
            }
            $(".fa-cubes").parent().prepend(status);
        }
    });

    $(".nav-list ul").css('display', 'none');
    $(".cs-admin").parent().attr('style', 'cursor: default !important;padding-top:50px !important;padding-bottom:30px !important');
    $(".cs-admin").parent().parent().click(false);
    ;
    //Change Detail
    var boxid_old = "D004";
    $('#detail').change(function () {
        var boxid = $("#detail option:selected").val();
        if (boxid_old !== null) {
            $("div[name=" + boxid_old + "]").slideToggle(500);
            $("div[name=" + boxid + "]").slideDown(500);
        } else {
            $("div[name=" + boxid + "]").slideDown(500);
        }
        boxid_old = boxid;
    });

    $("button[data-target='layout-ModalCreate']").click(function () {
        $("#layout-ModalCreate").appendTo("body").modal('show');
    });

    //Create Order Master
    $("#createOrdermaster").click(function () {
        var check = 0;
        var detail_id = $("#detail").val();

        var order_detail = '';
        var order_detail_name = '';
        var order_detail_name_id = '';
        if (detail_id === 'D001') {
            order_detail = $("div[name='D001']").find("textarea[name='order_detail']").val();
            order_detail_name = $("div[name='D001']").find("input[name='order_detail_name']").val();
            order_detail_name_id = $("div[name='D001']").find("input[name='order_detail_name_id']").val();
            if (order_detail === '' || order_detail_name === '' || order_detail_name_id === '') {
                if (order_detail === '') {
                    $("div[name='D001']").find("textarea[name='order_detail']").addClass('error');
                }
                if (order_detail_name === '') {
                    $("div[name='D001']").find("input[name='order_detail_name']").addClass('error')
                }
                if (order_detail_name_id === '') {
                    $("div[name='D001']").find("input[name='order_detail_name_id']").addClass('error')
                }
                check++;
            }
        } else if (detail_id === 'D002') {
            order_detail = $("div[name='D002']").find("textarea[name='order_detail']").val();
            order_detail_name = $("div[name='D002']").find("input[name='order_detail_name']").val();
            order_detail_name_id = $("div[name='D002']").find("input[name='order_detail_name_id']").val();
            if (order_detail === '' || order_detail_name === '' || order_detail_name_id === '') {
                if (order_detail === '') {
                    $("div[name='D002']").find("textarea[name='order_detail']").addClass('error');
                }
                if (order_detail_name === '') {
                    $("div[name='D002']").find("input[name='order_detail_name']").addClass('error')
                }
                if (order_detail_name_id === '') {
                    $("div[name='D002']").find("input[name='order_detail_name_id']").addClass('error')
                }
                check++;
            }
        } else if (detail_id === 'D003') {
            order_detail = $("div[name='D003']").find("textarea[name='order_detail']").val();
            order_detail_name = $("div[name='D003']").find("input[name='order_detail_name']").val();
            order_detail_name_id = '';
            if (order_detail === '' || order_detail_name === '') {
                if (order_detail === '') {
                    $("div[name='D003']").find("textarea[name='order_detail']").addClass('error');
                }
                if (order_detail_name === '') {
                    $("div[name='D003']").find("input[name='order_detail_name']").addClass('error')
                }
                check++;
            }
        } else {
            order_detail = $("div[name='D004']").find("textarea[name='order_detail']").val();
            order_detail_name = '';
            order_detail_name_id = '';
            if (order_detail === '') {
                if (order_detail === '') {
                    $("div[name='D004']").find("textarea[name='order_detail']").addClass('error');
                }
                check++;
            }
        }
        if (check === 0) {
            $("#createOrdermaster").attr('disabled', true);
            $.ajax({
                type: "POST",
                url: "../widen/createordermaster",
                data: {
                    order_detail: order_detail,
                    order_detail_name: order_detail_name,
                    order_detail_name_id: order_detail_name_id,
                    detail_id: detail_id
                },
                success: function (data) {
                    if (data === 'pass') {
                        $("#ModalCreate").toggle();
                        $("#ModalSuccessCreate").modal('show');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                }
            })
        }
    });


});
$(document).delegate("#layout-ModalCreate .error", "keyup", function () {
    $(this).removeClass('error');
});