// Material
$(document).ready(function () {

    //Delete Material
    $("a[name='btn-delete']").click(function () {
        var mat_id = $(this).attr('data-id');
        $("#ConfirmModalDelete").modal('show');
        $("#ConfirmModalDelete").find("a[name='confirm-delete']").attr('data-id', mat_id);
    });
    $("a[name='confirm-delete']").click(function () {
        var mat_id = $(this).attr('data-id');
        $.ajax({
            url: 'delete',
            type: 'POST',
            data: {
                id: mat_id
            },
            success: function (data) {
                if (data === 'false') {
                    $("#ErrorModalDelete").modal('show');
                } else {
                    $("#SuccessModalDelete").modal('show');
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1000);
                }

            }
        });
    });


    $('#submit-database').on('click', function () {
        $('#detail-material').submit();
    });
    $('#detail-material').submit(function (event) {
        var dz = $('#myDropzone').attr('class');
        var n = dz.search("ef-dz-suc");
        var ch_input = $("#detail-material").children();
        var stu_input = 0;
        $.each(ch_input, function (key, value) {
            if (key > 0 && key <= 5) {
                var ch_input_attr = $(this).attr('class');
                var stu_search = ch_input_attr.search('has-success');
                if (stu_search === -1) {
                    stu_input++;
                }
            }
        });
        if (n === -1) {
            $('#myDropzone').addClass('ef-dz-fa');
            return false;
        } else if (stu_input > 0) {
            return false;
        } else {
            var material_id = $("#matsysmaterial-material_id").val();
            $.ajax({
                type:"POST",
                url:"checkidmaterial",
                data:{
                    material_id:material_id
                },
                success:function (data) {
                    if(data==='pass'){
                        $.ajax({
                            type: "POST",
                            url: "ajaxcreate",
                            data: $("#detail-material").serialize(),
                            success: function (output) {
                                var succsee = "<div style=\"text-align: center;\"><img class=\"loading\" src=\"" + home_path + "web_mat/loading/ok.png\" alt=\"loading\"><h2>ทำรายการสำเร็จ</h2></div>";
                                $("#preview-content").children().remove();
                                $("#preview-content").prepend(succsee);
                                $("button").prop("disabled", true);
                                setTimeout(function () {
                                    window.location.href = window.location.href;
                                }, 800);
                            }
                        });
                        return false;
                    }else{
                        $("#ModalErrorrepeatedly").modal('show');
                        return false;
                    }
                }

            });
            return false;
        }
    });
});