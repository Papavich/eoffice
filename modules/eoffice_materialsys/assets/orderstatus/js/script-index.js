$(document).ready(function () {
    // alert("cake");
    $(".glyphicon-zoom-in").click(function () {
        var id = $(this).attr('data-target');
        var res = id.replace("#myDetail", "");
        $.ajax({
            url:"updateread",
            type:"POST",
            data:{
                order_id:res
            },
            success:function (data) {
            }
        });
    });
});