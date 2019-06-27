$(document).ready(function () {
    $("button[name='btn-cancel']").click(function () {
        $("#Modalcancel").modal('show');
    });

    $("button[name='btn-confirm']").click(function () {
        $("button[name='confirm']").attr('disabled',false);
        $("#ModalConfirm").modal('show');
    });

    $("button[name='confirm']").click(function () {
        $(this).attr('disabled',true);
        var order_id = $("#modal-order_id").text();
        var detail = $("textarea[name='detail']").val();
        var items = [];
        $.each($("#tbody").children(), function (index, value) {
            var item = {
                material_id: '',
                material_amount: 0,
                bill_master: ''
            };
            item.material_id = $(this).find("td[name='ta-material']").text();
            item.material_amount = $(this).find("input[name='ta-amount']").val();
            item.bill_master = $(this).find("input[name='bill_master']").val();
            items.push(item);
        });
        if (detail !== '') {
            $.ajax({
                url: "confirm",
                type: "POST",
                data: {
                    order_id: order_id,
                    items: items,
                    detail:detail
                },
                success: function (data) {
                    if (data === 'pass') {
                        $("button[data-id='" + order_id + "']").parent().parent().parent().remove();
                        $("#ModalConfirm").modal('toggle');
                    } else {
                        alert(data);
                    }
                }
            });
        } else {
            $("textarea[name='detail']").addClass('error');
        }
    });

    $("button[name='showdetail']").click(function () {
        var order = $(this).attr('data-id');
        var user_id = $(this).attr('data-iduser');
        $.ajax({
            url: "getdetailuser",
            type: "POST",
            dataType: "json",
            data: {
                user_id: user_id,
                order_id: order
            },
            success: function (data) {
                $("#modal-order_id").text(order);
                $("#modal-name").text(data[0].name);
                $("#modal-detail").text(data[3].detail);
                $("#modal-email").text(data[1].email);
                $("#modal-phone").text(data[2].phone);
                $.ajax({
                    url: "getorderlist",
                    type: "POST",
                    data: {
                        order_id: order,
                    },
                    success: function (data) {
                        $("#tbody").children().remove();
                        $("#tbody").append(data);
                        $("#ModalShowDetail").modal('show');
                    }
                });
            }
        });

    });

    $("textarea[name='detail-cancel']").keyup(function () {
        $(this).removeClass('error');
    });
    $("textarea[name='detail']").keyup(function () {
        $(this).removeClass('error');
    });

    $("button[name='cancel']").click(function () {
        var order_id = $("#modal-order_id").text();
        var detail = $("textarea[name='detail-cancel']").val();
        var items = [];
        $.each($("#tbody").children(), function (index, value) {
            var item = {
                material_id: '',
                material_amount: 0,
                bill_master:''
            };
            item.material_id = $(this).find("td[name='ta-material']").text();
            item.material_amount = $(this).find("input[name='ta-amount']").val();
            item.bill_master = $(this).find("input[name='bill_master']").val()
            items.push(item);
        });
        if (detail !== '') {
            $.ajax({
                url: "cancel",
                type: "POST",
                data: {
                    order_id: order_id,
                    items: items,
                    detail: detail
                },
                success: function (data) {
                    if (data === 'pass') {
                        $("button[data-id='" + order_id + "']").parent().parent().parent().remove();
                        $("#Modalcancel").modal('toggle');
                    } else {
                        alert(data);
                    }
                }
            });
        } else {
            $("textarea[name='detail-cancel']").addClass('error');
        }
    });
});
$(document).delegate("input", "change", function () {
    var val = $(this).val();
    var max = $(this).attr('max');
    if (parseFloat(val) > parseFloat(max)) {
        $(this).val(max);
    } else if (val < 1) {
        $(this).val(0);
    }

});