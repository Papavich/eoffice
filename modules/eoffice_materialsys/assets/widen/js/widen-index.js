$(document).ready(function () {
    $("#layout-cart").remove();
    //Set money
    $.fn.digits = function () {
        return this.each(function () {
            $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        })
    }
    updatePrice();
    //Change Detail
    // var boxid_old = "D004";
    var boxid_old2 = "D2004";
    // $('#detail').change(function () {
    //     var boxid = $("#detail option:selected").val();
    //     if (boxid_old !== null) {
    //         $("div[name=" + boxid_old + "]").slideToggle(500);
    //         $("div[name=" + boxid + "]").slideDown(500);
    //     } else {
    //         $("div[name=" + boxid + "]").slideDown(500);
    //     }
    //     boxid_old = boxid;
    // });
    $('#detail2').change(function () {
        var boxid = $("#detail2 option:selected").val();
        if (boxid_old2 !== null) {
            $("div[name=" + boxid_old2 + "]").slideToggle(500);
            $("div[name=" + boxid + "]").slideDown(500);
        } else {
            $("div[name=" + boxid + "]").slideDown(500);
        }
        boxid_old2 = boxid;
    });

    //Show Header
    $("#panel-1 .panel-heading").click(function () {
        $(this).parent().children(".panel-body").slideToggle(200);
        $("#type_header").toggleClass('glyphicon-minus glyphicon-plus');
    });

    //Confirm Delete
    $("#confirm-delete-list").click(function () {
        var data_material = $("#delte-list-material").serialize();
        var material_id = $("input[name='delete-material_id']").val();
        $.ajax({
            url: "deletelist",
            type: "POST",
            data: data_material,
            success: function (data) {
                if (data === 'pass') {
                    var select_mat = "#mat-" + material_id;
                    $(select_mat).remove();
                    setNo();
                    updatePrice();
                }
            }
        })
    });

    //Create Order Master
    $("#createOrdermasterview").click(function () {
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
            $("#createOrdermasterview").attr('disabled', true);
            $.ajax({
                type: "POST",
                url: "createordermaster",
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
                            window.location.href = 'widenlist';
                        }, 1000);
                    }
                }
            })
        }
    });

    //Add Item
    $("button[name='add-amount-use']").click(function () {
        $("button[name='add-amount-use']").attr('disabled', true);
        var amount = $("input[name='amount-use']").val();
        var material_id = $("#searchMaterial").val();
        var order_id = $("input[name='delete-bill_id']").val();
        if (amount <= 0) {
            $("button[name='add-amount-use']").attr('disabled', false);
            $("input[name='amount-use']").attr('disabled', false);
            $("input[name='amount-use']").addClass('error');
        } else {
            $.ajax({
                url: "checkmaterialinorder",
                type: "POST",
                data: {
                    material_id: material_id,
                    order_id: order_id
                },
                success: function (data) {
                    if (data === 'pass') {
                        $.ajax({
                            url: "additem",
                            type: "POST",
                            data: {
                                amount: amount,
                                material_id: material_id
                            },
                            success: function (data) {
                                $("#tbody-items").append(data);
                                $("input[name='amount-use']").val(0).attr('disabled', true);
                                setNo();
                                updatePrice();
                            }
                        })
                    } else {
                        //Show model error
                        $("#ModalErrorrepeatedly").modal("show");
                    }
                }
            });

        }
    });
    //Remove input error on
    $("input[name='amount-use']").change(function () {
        if ($(this).val() > 0) {
            $(this).removeClass('error');
        }
    });

    //SetMax
    $("input[name='amount-use']").keyup(function () {
        if (parseInt($(this).val()) > parseInt($(this).attr('max'))) {
            $(this).val($(this).attr('max'));
        }
    });

    //Confirm Edit
    $("#btn-confirmEdit").click(function () {
        var material_id = $("input[name='c-material_id']").val();
        var new_amount = $("input[name='c-newAmount']").val();
        var order_id = $("input[name='c-billId']").val();
        $("#ModalEditamount").children().remove();
        $.ajax({
            type: "POST",
            url: "editamount",
            data: {
                material_id: material_id,
                new_amount: new_amount,
                order_id: order_id
            },
            success: function (data) {
                if (data === 'pass') {
                    $("#ModalSuccessEdit").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    location.reload();
                } else {
                    alert("error" + data);
                }
            }
        })
    });
    //Unconfirm Edit
    $("#btn-unconfirmEdit").click(function () {
        var material_id = "#mat-" + $("input[name='c-material_id']").val();
        var old_amount = $("input[name='c-oldAmount']").val();
        $(material_id).find("input").val(old_amount);
    });

    //Before Confirm Order
    $("#btn-confirmOrder").click(function () {
        if($("#tbody-items").children().length !== 0) {
            var check = 0;
            var detail_id = $("#detail2").val();

            var order_detail = '';
            var order_detail_name = '';
            var order_detail_name_id = '';

            if (detail_id === 'D2001') {
                order_detail = $("div[name='D2001']").find("textarea[name='order_detail']").val();
                order_detail_name = $("div[name='D2001']").find("input[name='order_detail_name']").val();
                order_detail_name_id = $("div[name='D2001']").find("input[name='order_detail_name_id']").val();
                if (order_detail === '' || order_detail_name === '' || order_detail_name_id === '') {
                    if (order_detail === '') {
                        $("div[name='D2001']").find("textarea[name='order_detail']").addClass('error');
                    }
                    if (order_detail_name === '') {
                        $("div[name='D2001']").find("input[name='order_detail_name']").addClass('error')
                    }
                    if (order_detail_name_id === '') {
                        $("div[name='D2001']").find("input[name='order_detail_name_id']").addClass('error')
                    }
                    check++;
                }
            } else if (detail_id === 'D2002') {
                order_detail = $("div[name='D2002']").find("textarea[name='order_detail']").val();
                order_detail_name = $("div[name='D2002']").find("input[name='order_detail_name']").val();
                order_detail_name_id = $("div[name='D2002']").find("input[name='order_detail_name_id']").val();
                if (order_detail === '' || order_detail_name === '' || order_detail_name_id === '') {
                    if (order_detail === '') {
                        $("div[name='D2002']").find("textarea[name='order_detail']").addClass('error');
                    }
                    if (order_detail_name === '') {
                        $("div[name='D2002']").find("input[name='order_detail_name']").addClass('error')
                    }
                    if (order_detail_name_id === '') {
                        $("div[name='D2002']").find("input[name='order_detail_name_id']").addClass('error')
                    }
                    check++;
                }
            } else if (detail_id === 'D2003') {
                order_detail = $("div[name='D2003']").find("textarea[name='order_detail']").val();
                order_detail_name = $("div[name='D2003']").find("input[name='order_detail_name']").val();
                order_detail_name_id = '';
                if (order_detail === '' || order_detail_name === '') {
                    if (order_detail === '') {
                        $("div[name='D2003']").find("textarea[name='order_detail']").addClass('error');
                    }
                    if (order_detail_name === '') {
                        $("div[name='D2003']").find("input[name='order_detail_name']").addClass('error')
                    }
                    check++;
                }
            } else {
                order_detail = $("div[name='D2004']").find("textarea[name='order_detail']").val();
                order_detail_name = '';
                order_detail_name_id = '';
                if (order_detail === '') {
                    if (order_detail === '') {
                        $("div[name='D2004']").find("textarea[name='order_detail']").addClass('error');
                    }
                    check++;
                }
            }
            if (check === 0) {
                $("#ModalConfirmOrder").modal('show');
            }
        }else{
            $("#ModalErrorNoMaterial").modal('show');
        }
    });
    //Confirm Order
    $("#btn-con-confirm").click(function () {
        var order_id = $("input[name='con-billId']").val();

        var detail_id = $("#detail2").val();
        var order_detail = '';
        var order_detail_name = '';
        var order_detail_name_id = '';

        if (detail_id === 'D2001') {
            order_detail = $("div[name='D2001']").find("textarea[name='order_detail']").val();
            order_detail_name = $("div[name='D2001']").find("input[name='order_detail_name']").val();
            order_detail_name_id = $("div[name='D2001']").find("input[name='order_detail_name_id']").val();
        } else if (detail_id === 'D2002') {
            order_detail = $("div[name='D2002']").find("textarea[name='order_detail']").val();
            order_detail_name = $("div[name='D2002']").find("input[name='order_detail_name']").val();
            order_detail_name_id = $("div[name='D2002']").find("input[name='order_detail_name_id']").val();
        } else if (detail_id === 'D2003') {
            order_detail = $("div[name='D2003']").find("textarea[name='order_detail']").val();
            order_detail_name = $("div[name='D2003']").find("input[name='order_detail_name']").val();
            order_detail_name_id = '';
        } else {
            order_detail = $("div[name='D2004']").find("textarea[name='order_detail']").val();
            order_detail_name = '';
            order_detail_name_id = '';
        }
        $("#ModalConfirmOrder").children().remove();
        $.ajax({
            url:"confirmorder",
            type:"POST",
            data:{
                order_id:order_id,
                detail_id:detail_id,
                order_detail:order_detail,
                order_detail_name:order_detail_name,
                order_detail_name_id:order_detail_name_id
            },
            success:function (data) {
                if(data === 'pass'){
                    $("#ModalSuccessConfirmOrder").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    setTimeout(function () {
                        location.reload();
                    },500);
                }else{
                    alert("error"+data);
                }
            }
        });
    });

    //Confirm cancel
    $("#btn-can-confirm").click(function () {
        var order_id = $("input[name='can-billId']").val();
        $("#ModalConfirmCancel").children().remove();
        $.ajax({
            type:"POST",
            url:"cancelorder",
            data:{
                order_id:order_id
            },
            success:function (data) {
                if(data.search('pass') !== -1){
                    $("#ModalSuccessConfirmCancel").modal('show');
                    setTimeout(function () {
                        location.reload();
                    },500);
                }else{
                    alert("Error : "+data);
                }
            }
        });
    });

    //Select2 Material
    $("#searchMaterial").select2({
        id: function (bond) {
            return bond.material_name;
        },
        ajax: {
            method: "GET",
            url: "searchproductjson",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    value: params.term
                };
            },
            processResults: function (data, params) {
                var array = data.resultajax; //depends on your JSON
                return {results: array};
            },
            cache: true
        },
        placeholder: 'Search for a repository',
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection,
        language: {
            inputTooShort: tooShort,
            errorLoading: fotmatError,
        }
    });

    function tooShort() {
        var markup;
        markup = "<div>กรุณากรอกชื่อหรือรหัสวัสดุ</div>";
        return markup;
    }

    function fotmatError() {
        var markup;
        markup = "<div><span class='select2-notfound pull-left'>ไม่พบวัสดุในคลัง</span></div>";
        return markup;
    }

    function formatRepo(repo) {
        if (repo.loading) {
            return repo.text;
        }
        var markup;
        markup = "<div class='select2-result-repository__title'>" + repo.material_name + "<span class=\"pull-right\">(คงเหลือ " + repo.material_amount_all + " " + repo.material_unit_name + ") " + repo.id + "</span></div>";

        return markup;
    }

    function formatRepoSelection(repo) {
        var markup = null;
        if (repo.material_name !== undefined) {
            markup = repo.material_name + "<div name='select2-amount'>" + repo.material_amount_all + "</div>";
        } else {
            markup = "กรุณากรอกชื่อหรือรหัสวัสดุ";
        }
        return markup;
    }
});
//Remove input error on keyup
$(document).delegate("#ModalCreate .error", "keyup", function () {
    $(this).removeClass('error');
});
//Select2 Material on select
$(document).delegate("#searchMaterial", "change", function () {
    var id = $(this).val();
    var amount = $("div[name='select2-amount']").text();
    if (amount !== '0') {
        $("input[name='amount-use']").attr('disabled', false).attr('max', amount);
        $("button[name='add-amount-use']").attr('disabled', false);
    } else {
        $("#ModalErroramount").modal('show');
    }
});
//Confirm modal Delete
$(document).delegate("button[data-target='#ModalConfrimdelete']", 'click', function () {
    var material_name = $(this).parent().parent().parent().find("td[data-id='tb-material_name']").text();
    var material_id = $(this).parent().parent().parent().find("td[data-id='tb-material_id']").text();
    $("#modal-confirmDelete-name").text(material_name);
    $("input[name='delete-material_id']").val(material_id);
});
//Set NO.
function setNo() {
    var no_id = $("#tbody-items").children();
    var count = 1;
    $.each(no_id, function (key, value) {
        $(this).children().first().text(count);
        count++;
    })
}
//Update Price and count
function updatePrice() {
    var count = 0;
    var mat_count = $("#tbody-items").children();
    $.each(mat_count, function (key, value) {
        count++;
    });
    $("#count-material").text(count);

    var allprice = 0;
    $("td[name='allprice-material']").each(function (key, value) {
        var res = $(this).text().split(',');
        var price = '';
        $.each(res, function (key2, value2) {
            price += value2
        });
        allprice += parseFloat(price);
    });
    $("#allprice-allmaterial").text(allprice.toFixed(2)).digits();

}
//Change Amount Material
$(document).delegate("#tbody-items input", "change", function () {
    var amount_new = $(this).val();
    var amount_old = $(this).attr('data-id');
    var max = $(this).attr('max');
    var material_id = $(this).parent().parent().find("td[data-id='tb-material_id']").text();
    if (parseFloat(amount_new) > parseFloat(max)) {
        amount_new = max;
        $(this).val(amount_new);
    }
    $("#ModalEditamount").find("input[name='c-newAmount']").val(amount_new);
    $("#ModalEditamount").find("input[name='c-oldAmount']").val(amount_old);
    $("#ModalEditamount").find("input[name='c-material_id']").val(material_id);
    $("#ModalEditamount").modal({
        backdrop: 'static',
        keyboard: false
    });;
});