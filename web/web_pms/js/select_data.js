/*globals $:false */
$(document).ready(function() {
    "use strict";
    $('#id').change(function (e) {
        e.preventDefault();
        var prosub = 0;
        var prosub = $('#id').val();
        $.ajax({
            url: '../addprosubresult/result-select-js',
            data: {
                'prosub': prosub
            },
            type: "get",
            success: function (data) {
                if(data){
                    $('#compact_show').html(data);
                }
            }
        });
    });
});