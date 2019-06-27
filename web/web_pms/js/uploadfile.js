/*globals $:false */
$(document).ready(function() {
    "use strict";
    $("div").delegate("a", "click",function () {
        var name = $(this).attr("data");
        var id_compact = $('#id_compact').val();
            $.ajax({
            url: '../addprosubresult/delete-filesystem',
            data: {
                'name': name,
                'id_compact':id_compact,
            },
            type: "get",
            success: function (data) {
                if(data){
                    $('#showdoc').html(data);
                }
            }
        });
    });

});

