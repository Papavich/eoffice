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



    $('.get_comment').click(function () {
        var id = $(this).attr("data");
        $.ajax({
            url: '../tablepro/getcomment-js',
            data: {
                'id': id
            },
            type: "get",
            success: function (data) {
                if(data){
                    $('#show_comment').html(data);
                }
            }
        });
    });



    $('.get_status_place').click(function () {
        var id = $(this).attr("data");
        $.ajax({
            url: '../tableprois/getstatusplace-js',
            data: {
                'id': id
            },
            type: "get",
            success: function (data) {
                if(data){
                    $('#show_status_place').html(data);
                }
            }
        });
    });

    $('.get_status_budget').click(function () {
        var id = $(this).attr("data");
        $.ajax({
            url: '../tableprois/getstatusbudget-js',
            data: {
                'id': id
            },
            type: "get",
            success: function (data) {
                if(data){
                    $('#show_status_budget').html(data);
                }
            }
        });
    });

    $('.get_status_pandb').click(function () {
        var id = $(this).attr("data");
        $.ajax({
            url: '../tableprois/getstatuspandb-js',
            data: {
                'id': id
            },
            type: "get",
            success: function (data) {
                if(data){
                    $('#show_status_pandb').html(data);
                }
            }
        });
    });

    $('.get_status_summary').click(function () {
        var id = $(this).attr("data");
        $.ajax({
            url: '../tableprois/getstatussummary-js',
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

    $('.get_doc_compact').click(function () {
        var id = $(this).attr("data");
        $.ajax({
            url: '../tablepro/doc-compact-js',
            data: {
                'id': id
            },
            type: "get",
            success: function (data) {
                if(data){
                    $('#show_doc').html(data);
                }
            }
        });
    });




});