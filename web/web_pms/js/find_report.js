/*globals $:false */
$(document).ready(function() {
    "use strict";
    $('.get_status').click(function () {
        var id = $(this).attr("data");
        $.ajax({
            url: '../tablepro/getstatus-js',
            data: {
                'id': id
            },
            type: "get",
            success: function (data) {
                if(data){
                    $('#show_status').html(data);
                }
            }
        });
    });


    $('#find').click(function (e) {
        e.preventDefault();
        var format = $('#format').val();
        var year = $('#year').val();
        if(format == ""){
            $('#format_alert').html("กรุณากรอกข้อมูล!");
        }else {
            $('#format_alert').html("");
        }
        if(year == ""){
            $('#year_alert').html("กรุณากรอกข้อมูล!");
        }else {
            $('#year_alert').html("");
        }

        if(format != "" && year != ""){
            $('#find_report').submit();
        }

    });

    $('#year').change(function () {
        var year = 0;
        var year = $('#year').val();
        $.ajax({
            url: '../report/findreport-js',
            data: {
                'year': year,
            },
            type: "get",
            success: function (data) {
                if(data){
                    $('#id').html(data);
                    $('#id').val('0').trigger('change.select2');
                }
            }
        });
    });

    $('#format').change(function () {
        var format = $('#format').val();
        if(format == 6){
            $('#report_hide').hide();
            // $.ajax({
            //     url: '../report/report-of-year',
            //     data: {
            //         'format': format,
            //     },
            //     type: "get",
            //     success: function (data) {
            //         alert(data);
            //     }
            // });
        }else{
            $('#report_hide').show();
        }

    });


});