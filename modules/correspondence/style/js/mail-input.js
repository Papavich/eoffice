$(document).ready(function () {
    $('.mail-header-tools').show();
    $('#add-label-error').hide();
    $('#edit-label-error').hide();
    $('.mail-table').dataTable({
        "pageLength": 13
    });
    $("#example_filter input").prop('id', 'search_box');
    $("#example_filter").detach().appendTo('#new-search-area');
    $('.dataTables_length').remove();
    $('.dataTables_filter #example_filter').remove();
    $('.dataTables_info').remove();
    $('#list-labels a').click(function () {
        var tab = $(this).attr('href');
        console.log(tab.substr(1));
        if ($(this).find('span').text() == "0") {
            //console.log( $(this).find('span').text());
            $('#' + tab.substr(1)).find('input').remove();
            $('#' + tab.substr(1)).find('label').remove();
        } else {
            $('#' + tab.substr(1)).find('input').remove();
            $('#' + tab.substr(1)).find('label').remove();
        }
    });
    if($(".label-name").length !== 0)
    {
        $("#manage-labels").show();
    }
//in label page when user click label will show button to manage this label
    $(".label-name").click(function () {
       //console.log($(this).children('a').children('span').attr('id'));
        $('#manage-labels').show();
    });
//copy example_paginate
    $("#example_paginate").clone().appendTo("#example_paginate-top");
    $('#example th').each(function () {
        $(this).removeClass('sorting_asc');
        $(this).removeClass('sorting');
        $(this).removeClass('sorting_desc');
    });
//$(".dataTables_empty").empty();
    $(".dataTables_empty").text("");

    $('#manage-labels-table').DataTable();
    $('#manage-labels-table_filter').remove();
    $('#manage-labels-table th').each(function () {
        $(this).removeClass('sorting_asc');
        $(this).removeClass('sorting');
        $(this).removeClass('sorting_desc');
    });
//reload this page
    $('.button-refresh').click(function () {
        window.location.reload();
    });

//Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
        //console.log("click");
        let clicks = $(this).data('clicks');
        if (clicks) {
            //Uncheck all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            //$('.mail-header-tools').hide();
        } else {
            //Check all checkboxes
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            //$('.mail-header-tools').show();

        }
        $(this).data("clicks", !clicks);
    });
    $(".mailbox-messages input[type='checkbox']").click(function () {
        //$('.mail-header-tools').toggle();
    });
    $('#show-details-receiver').click(function () {
        console.log("click");
    });
    $('.pagination').css('margin', '0px');
    let filterMail = window.location.href;
    let result = (filterMail.split('/'));
    let result1 = result[result.length - 1].toString().split('&');
    let sortBy = result1[0].toString().split('?');
    if (sortBy[1] == "sort=-secret") {
        $('#filterMail').html('ชั้นความลับ');
    } else if (sortBy[1] == "sort=-speed") {
        $('#filterMail').html('ชั้นความเร็ว');
    } else if (sortBy[1] == "sort=-inbox_time") {
        $('#filterMail').html('ใหม่ไปเก่า');
    } else if (sortBy[1] == "sort=inbox_time") {
        $('#filterMail').html('เก่าไปใหม่');
    }
});
