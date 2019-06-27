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
            $("#modal-date").text(date);
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
