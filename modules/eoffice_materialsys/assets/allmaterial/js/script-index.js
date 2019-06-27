$(document).ready(function () {
    //Scheck Chang
    $("input[name='amount']").change(function () {
        $(this).removeClass('error');
        var val = $(this).val();
        var max = $(this).attr('max');
        if (parseFloat(val) > parseFloat(max)) {
            $(this).val(max);
        }
        if (parseFloat(val) <= 0) {
            $(this).val(1);
        }
    });
    //Select Type
    $("#selectType").change(function () {
        var val = $(this).val();
        if (getUrlParameter('view') != null) {
            window.location.href = "?type=" + val + "&view=" + getUrlParameter('view');
        } else {
            window.location.href = "?type=" + val
        }
    });
    //View Type
    $("input[name='view']").change(function () {
        var val = $(this).val();
        if (getUrlParameter('type') != null ) {
            window.location.href = "?type=" + getUrlParameter('type') + "&view=" + val;
        } else {
            window.location.href = "?view=" + val
        }
    });
    //Add item
    $("button[name='addItem']").click(function () {
        if (status_cart) {
            var material_id = $(this).parent().parent().find(".text-tbody").find("span[name='material_id']").text();
            var material_name = $(this).parent().parent().find(".text-tbody").find("span[name='material_name']").text();
            var material_detail = $(this).parent().parent().find(".text-tbody").find("span[name='material_detail']").text();
            var all_amount = $(this).parent().parent().find(".text-tbody").find("span[name='material_all']").text();
            var material_unit = $(this).parent().parent().find(".text-tbody").find("span[name='material_unit']").text();
            var src_image = $(this).parent().parent().find(".image").attr('src');
            var material_type = $(this).parent().parent().find("span[name='material_type']").text();
            $.ajax({
                url: "checkmaterialinorder",
                type: "POST",
                data: {
                    material_id: material_id,
                    order_id: order_id
                },
                success: function (data) {
                    if (data === 'pass') {
                        $("span[name='modal-material_name']").text(material_name);
                        $("span[name='modal-material_id']").text(material_id);
                        $("span[name='modal-material_detail']").text(material_detail);
                        $("span[name='modal-material_allamount']").text(all_amount);
                        $("span[name='modal-material_unit']").text(material_unit);
                        $("input[name='amount']").attr('max', all_amount);
                        $(".image-in-modal").attr('src', src_image);
                        $("span[name='modal-material_type']").text(material_type);
                        $("#ModalAddItem").modal('show');
                    } else {
                        //Show model error
                        $("#ModalErrorrepeatedly").modal("show");
                    }
                }
            });
        } else {
            $("#layout-ModalCreate").appendTo("body").modal('show');
        }
    });
    //Add item to Order
    $("#additemtoorder").click(function () {
        var material_id = $("span[name='modal-material_id']").text();
        var amount = $("input[name='amount']").val();
        if (amount > 0) {
            $.ajax({
                type: "POST",
                url: "additem",
                data: {
                    material_id: material_id,
                    amount: amount
                },
                success: function (data) {
                    if (data === 'pass') {
                        $("#ModalAddItem").modal('toggle');
                        var old_amount = $("tr[data-key='" + material_id + "']").find("span[name='material_all']").text();
                        $("tr[data-key='" + material_id + "']").find("span[name='material_all']").text(parseFloat(old_amount) - parseFloat(amount));
                        updateCart();
                    } else {
                        alert(data);
                    }
                }
            });
        } else {
            $("input[name='amount']").addClass('error');
        }

    });
});

function updateCart() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "updatecart",
        success: function (data) {
            var amount = data[0].amount;
            var div = "";
            for (var key in data[1].item) {
                div += data[1].item[key];
            }
            ;
            $(".my-badge").text(amount);
            $("#layout-cart-tbody").children().remove();
            $("#layout-cart-tbody").append(div);
            $("#myCart").click();
        }
    });
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};