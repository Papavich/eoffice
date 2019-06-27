$(document).ready(function () {
    $("#firstTab").addClass('active');
    var status_id = window.location.href; //get current url
    // activeTab(status_id);
    if (window.location.hash) { //URL have #
        activeTab(status_id);
    }

    $(".tabsetting a").click(function () {
        status_id = $(this).attr('href');
        window.location.hash = $(this).attr('href');
        activeTab(status_id);
    });

    function activeTab(staus) {
        //if current url == target url will add class active
        $(".tabsetting a").each(function () {
            var tab;
            var current_page_URL = window.location.href;

            if ($(this).attr("href") !== "#") { //get element tag a href
                staus = $(this).prop("href"); //get properties of tag a href

                if (staus == current_page_URL) {
                    tab = $(this).attr("href"); //set value of href in tag a working
                    $(this).parent('li').addClass('active');
                    $(this).attr("aria-expanded", "true");
                    $(tab).addClass('active');
                } else if (staus != current_page_URL) {
                    var tab2 = $(this).attr("href");
                    $(this).parent('li').removeClass('active');
                    $(this).attr("aria-expanded", "false");
                    $(tab2).removeClass('active');
                }
            }
        });
    }

    $(".confirmDeleteSpeed").click(function () {
        swal({
            title: titleSwal,
            text: textSwal,
            icon: "warning",
            dangerMode: true,
            buttons: [buttonCancelSwal, buttonConfirmSwal],
        })
            .then(willDelete => {
                    if (willDelete) {
                        swal(successSwal, {icon: "success", button: false,});
                        return $.ajax({
                            url: '../speed/delete',
                            type: 'POST',
                            data: {
                                'id': pass_id
                            },
                            success: function (data) {
                                window.location.reload();
                            }
                        });
                    }
                }
            );
    });
});
$(".confirmDeleteSecret").click(function () {
    swal({
        title: titleSwal,
        text: textSwal,
        icon: "warning",
        dangerMode: true,
        buttons: [buttonCancelSwal, buttonConfirmSwal],
    })
        .then(willDelete => {
                if (willDelete) {
                    swal(successSwal, {icon: "success", button: false,});
                    return $.ajax({
                        url: '../secret/delete',
                        type: 'POST',
                        data: {
                            'id': pass_id
                        }, success: function (data) {
                            window.location.reload();

                        }
                    });
                }
            }
        );
});
$(".confirmDeleteType").click(function () {
    swal({
        title: titleSwal,
        text: textSwal,
        icon: "warning",
        dangerMode: true,
        buttons: [buttonCancelSwal, buttonConfirmSwal],
    })
        .then(willDelete => {
                if (willDelete) {
                    swal(successSwal, {icon: "success", button: false,});
                    return $.ajax({
                        url: '../type/delete',
                        type: 'POST',
                        data: {
                            'id': pass_id
                        },
                        success: function (data) {
                            window.location.reload();
                        }
                    });
                }
            }
        );
});
$(".confirmDeleteFromDept").click(function () {
    swal({
        title: titleSwal,
        text: textSwal,
        icon: "warning",
        dangerMode: true,
        buttons: [buttonCancelSwal, buttonConfirmSwal],
    })
        .then(willDelete => {
                if (willDelete) {
                    swal(successSwal, {icon: "success", button: false,});
                    return $.ajax({
                        url: '../doc-dept/delete',
                        type: 'POST',
                        data: {
                            'id': pass_id,
                        },
                        complete: function (data) {
                            window.location.reload();
                        }

                    });
                }
            }
        );
});
$(".confirmDeleteAddress").click(function () {
    swal({
        title: titleSwal,
        text: textSwal,
        icon: "warning",
        dangerMode: true,
        buttons: [buttonCancelSwal, buttonConfirmSwal],
    })
        .then(willDelete => {
                if (willDelete) {
                    swal(successSwal, {icon: "success", button: false,});
                    return $.ajax({
                        url: '../address/delete',
                        type: 'POST',
                        data: {
                            'address_id': pass_id
                        },
                        success: function (data) {
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        }

                    });
                }
            }
        );
});

$(".confirmDeleteSubType").click(function () {
    swal({
        title: titleSwal,
        text: textSwal,
        icon: "warning",
        dangerMode: true,
        buttons: [buttonCancelSwal, buttonConfirmSwal],
    })
        .then(willDelete => {
                if (willDelete) {
                    swal(successSwal, {icon: "success", button: false,});
                    return $.ajax({
                        url: '../sub-type/delete',
                        type: 'POST',
                        data: {
                            'id': pass_id
                        },
                        success: function (data) {
                            window.location.reload();
                        }

                    });
                }
            }
        );
});
$('#address-submit').click(function(e) {
    let form = $('#w5').serialize();
    $.ajax({
        url: '../address/create',
        data: form,
        type: 'POST',
        success:function(responce) {
            if(responce == "false"){
                console.log(responce);
                $('#address-id-error').html(addressIdError).css({color: 'red'});

            }
            else {
                console.log("else");
                //window.location.href = "setting-document#ttab6_nobg";
                window.location.reload();
            }
        }
    });
    //return false;
});
