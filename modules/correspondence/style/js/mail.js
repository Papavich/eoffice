$(document).ready(function () {
    function updateData(url, json) {
        $.ajax({
            url: url,
            type: 'post',
            data: {data: json},
            success: function (response) {
                // window.location.reload();
            }
        });
    }

    //read all
    $("#readAll").click(function () {
        let inps = $("input[name='listmails[]']:checked").map(function () {
            return $(this).val();
        }).get();
        let jsonString = JSON.stringify(inps);
        $.ajax({
            url: 'update-read-all',
            type: 'POST',
            data: {
                'id': jsonString
            },
            success: function (response) {
                window.location.reload();
            }, complete: function (responce) {
                // console.log(responce);
            }
        });
    });
    //update fav mail
    $(".mailbox-star").click(function () {
        //detect type glyphicon-star
        let x = $(this).find("a > i");
        let glyph = $(this).hasClass("glyphicon");
        let fa = $(this).hasClass("fa");
        //Switch states
        x.toggleClass("fa-star");
        x.toggleClass("fa-star-o");
        let jsonString = JSON.stringify([pass_id]);
        $.ajax({
            url: 'update-favmail',
            type: 'POST',
            data: {
                'id': jsonString
            },
            success: function (response) {
                //    console.log(pass_id);
            }
        });
    });
    $("#starAll").click(function () {
        let inps = $("input[name='listmails[]']:checked").map(function () {
            return $(this).val();
        }).get();
        let jsonString = JSON.stringify(inps);
        $.ajax({
            url: 'update-favmail',
            type: 'POST',
            data: {
                'id': jsonString
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });
    $("#unstarAll").click(function () {
        let inps = $("input[name='listmails[]']:checked").map(function () {
            return $(this).val();
        }).get();
        let jsonString = JSON.stringify(inps);
        $.ajax({
            url: 'update-unfavmail',
            type: 'POST',
            data: {
                'id': jsonString
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });
    //update trash
    $(".button-trash").click(function (e) {
        let form = $(this);
        let inps = $("input[name='listmails[]']:checked").map(function () {
            return $(this).val();
        }).get();
        let jsonString = JSON.stringify(inps);
        let current_page_URL = window.location.href;
        let url;
        url = (current_page_URL.split('/'));
        // console.log(url[url.length-1]);
        if (url[url.length - 1] === "junkmail") {
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
                                url: 'delete-junkmail',
                                type: 'post',
                                data: {
                                    mail: jsonString
                                },
                                success: function (response) {
                                    //console.log(response);
                                    window.location.reload();
                                }
                            });
                        }
                    }
                )
            ;
            inps = "";
        } else if (url[url.length - 1] === "sent-mail") {
            inps.push('sent-mail');
            jsonString = JSON.stringify(inps);
            updateData('update-junkmail', jsonString);
            window.location.reload();
        } else {
            updateData('update-junkmail', jsonString);
            window.location.reload();
        }

        return false;
    });
    //update trash read mail
    $("#trashMailReadPage").submit(function (e) {
        var inps = $("input[name='listmails[]']").map(function () {
            return $(this).val();
        }).get();
        var json = JSON.stringify(inps);
        //console.log(json);
        $.ajax({
            url: 'update-junkmail',
            type: 'post',
            data: {data: json},
            success: function (response) {
                //console.log(response);
                window.location.reload();
            }
        });
        return false;
    });
    /*
    *
    * History API
    *
    **/
    // var dynamic = true;
    // $(function () {
    //     if (dynamic == true) {
    //         $('.gallery-list a').click(function () {
    //             var title = $(this).attr('title'),
    //                 href = $(this).attr('href'),
    //                 src = $(this).find('img').attr('src'),
    //                 data = {
    //                     title: title,
    //                     src: src
    //                 }
    //             getImage(data);
    //             window.history.pushState(data, title, href);
    //             $('.feedback').addClass('dynamic').html('<p>Dynamic loaded</p>');
    //             return false;
    //         });
    //     }
    // });
    //
    // function getImage(data) {
    //     var image = '<img src="' + data.src + '" alt="' + data.title + '">';
    //     document.getElementById('gallery-container').innerHTML = image;
    // }
    //
    // window.addEventListener('popstate', function (event) {
    //     var state = event.state;
    //     if (state !== null) {
    //         getImage(state);
    //     }
    // });


    $("#form_mail").submit(function (e) {
        let form = $(this);
        let doc_id = $("#cmsdocument-doc_id").val();
        //console.log(form.serialize());
        //send notification to user
        $.ajax({
            url: '../mail/create-inbox?id=' + doc_id,
            type: "POST",
            data: form.serialize(),
            beforeSend: function () {
                //ใส่ Effect loading

                // $('body').loading({
                //     stoppable: false,
                //     theme: 'light',
                //     message: 'กรุณารอสักครู่..'
                // });
                //sendMail(form);
            },
            success: function (msg) {
                //console.log(msg);
                // window.location = 'detail_book?id='+$('#cmsdocument-doc_id').val();
                //$.pjax.reload({container: "#content-container", async:false});

                //$.pjax.reload({container: "#mail-progress-container"});
            }
            , complete: function (jqXHR, textStatus) {
                //console.log(jqXHR);
                // console.log(textStatus);
            }
        });
        return false;
    });

    function sendMail(form) {
        //console.log("sendMail");
        $.ajax({
            url: '../mail/send-mail',
            type: 'POST',
            data: form.serialize(),
            beforeSend: function () {
                //ใส่ Effect loading
                $('#toast-container').show();
            },
            success: function (response) {
                // $.pjax.reload({container: "#mail-progress-container"});
                // $('#mail-progress-container').show();
                //$('#toast-container').hide();
            }, complete: function (jqXHR, textStatus) {
                //console.log(jqXHR);
                // console.log(textStatus);
            }
        });
    }

    /*
     *
     *
     * LABEL
     *
     *
     */
    var count2 = null; //กำหนดให้เรียก ajax แค่ครั้งเดียว
    $('#mail-labels-create').submit(function (e) {
        //e.preventDefault();
        let form = $(this);
        let currentUrl = window.location.href;
        let inps = $("input[name='listmails[]']:checked").map(function () {
            return $(this).val();
        }).get();
        let json = JSON.stringify(inps); //ทำให้อยู่ในรูปของ json
        //ถ้า action '../cms-inbox-label/create-label' ถูกต้องจะเพิ่มค่า
        if (count2 == null) {
            $.ajax({
                url: '../cms-inbox-label/create',
                type: 'post',
                data: form.serialize(),
                success: function (response) {
                    count2 = null;
                    console.log('');
                    if (response == "1") {
                        $.ajax({
                            url: '../cms-inbox-label/create-label',
                            type: 'get',
                            data: {
                                inboxId: json,
                                labelId: $('#cmsinboxlabel-inbox_label_id').val()

                            }, success: function (response) {
                                count2 = 1;
                                if (response == "1") {
                                    $('#add-label-error').hide();
                                    window.location.href = currentUrl;
                                } else {
                                    //if this inbox have label already
                                    swal(errorAddLabelHeader, errorAddLabelContent, {
                                        icon: "error"
                                    });
                                }
                            }
                        });
                    } else if (response == "ชื่อป้ายกำกับจะต้องไม่ซ้ำกัน") {
                        $('#cmsinboxlabel-label_name').parent('div').addClass('has-error');
                        $('.field-cmsinboxlabel-label_name').children('div .help-block')
                            .html(errorLabelNotUnique);
                        // $('#add-label-error').show();
                    }
                }
            });
        }
        count2 = 1;
        return false;
    });
    $('.addInboxInLabel').click(function (e) {
        //console.log($(this).attr('href').substr(4));
        let inps = $("input[name='listmails[]']:checked").map(function () {
            return $(this).val();
        }).get();
        let json = JSON.stringify(inps); //ทำให้อยู่ในรูปของ json
        let currentUrl = window.location.href;
        //console.log(json);
        //console.log($(this).children().text());
        if (inps != "") {
            e.preventDefault();
            $.ajax({
                url: '../cms-inbox-label/update-label',
                type: 'post',
                data: {
                    inboxId: json,
                    labelName: $(this).children().text()

                }, success: function (response) {
                    //console.log(response);
                    if (response == "") {
                        $('#add-label-error').hide();
                        window.location.href = currentUrl;
                    } else {
                        //if this inbox have label already
                        swal({
                            title: errorAddLabelHeader,
                            text: response+"   "+errorAddLabelContent,
                            icon: "error",
                            dangerMode: true,
                        })
                            .then(willDelete => {
                                    if (willDelete) {
                                        window.location.reload();
                                    }
                                }
                            );
                    }
                }
            });
            return false;
        }

    });
    $('.remove-label').click(function () {
        //console.log($(this).attr('href').substr(4));
        let inps = $("input[name='listmails[]']:checked").map(function () {
            return $(this).val();
        }).get();
        if (inps != "") {
            $.ajax({
                url: '../cms-inbox-label/delete-message-in-label',
                type: 'post',
                data: {
                    inboxId: inps,

                }, complete: function (response) {
                    //   console.log(response);
                    window.location.reload();
                }
            });
        }

    });
    //เมื่อคนรับที่หน้า edit receive
    // $('#next_tab2').click(function () {
    //     var inps = $("input[name='list_mail[]']:checked").map(function () {
    //         return $(this).val();
    //     }).get();
    //     var jsonString = JSON.stringify(inps); //ทำให้อยู่ในรูปของ json
    //     $.ajax({ //call API
    //         url: '../',
    //         complete: function (response) {
    //             consoloe.log(response);
    //         }
    //     });
    // });
    $('#manage-labels a').click(function () {
        // console.log("ssss");
        $('#manage-labels-tab').toggle();
    });
    $('.label-edit').click(function () {
        $.ajax({
            url: '../cms-inbox-label/set-id',
            type: 'GET',
            data: {
                'id': pass_id
            },
            success: function (data) {
                // $("#loading").removeClass("se-pre-con");
                //console.log(data);
                let obj = $.parseJSON(data);
                //console.log(obj);
                //console.log(obj.inbox_label_id + obj.label_name);
                $('#inbox_label_id').val(obj.inbox_label_id);
                $('#label_name').val(obj.label_name);
                $('#user_id').val(obj.user_id);

            }
        });
    });
    $('#mail-labels-edit-modal').submit(function (e) {
        e.preventDefault();
        let url = '../cms-inbox-label/update?id=' + $('#inbox_label_id').val();
        let name = $('#label_name').val();
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                'label_name': name
            },
            complete: function (data) {
                // $("#loading").removeClass("se-pre-con");
            }, success: function (data) {
                if (data != "1") {
                    $('#edit-label-error').show();
                    return false;
                } else {
                    window.location.reload();
                }
            }
        });

    });
    // var commentlist = [];
    // var i = 0;
    // $('.undoSend').each(function () {
    //     commentlist.push($(this).attr('id')); //นำไอดีของคอมเม้นแต่ละแถวมันเก็บไว้
    //     //console.log(commentlist);
    // });
    // setInterval(function () {
    //     $('.comment-dateTime').each(function () {
    //         var timeComment = $(this).attr('id'); //get element datetime
    //         var comment = $(this).val(); //get element inbox_id
    //         var now2 = moment();
    //         var ms = moment(now2.format('YYYY-MM-DD HH:mm:ss')).diff(moment(timeComment)); //find time diff
    //         var d = moment.duration(ms);
    //         // console.log(comment+" "+timeComment);
    //         if ((d.minutes() >= 1 && d.years() >= 0 && d.months() >= 0 && d.days()
    //                 >= 0 && d.hours() >= 0) && comment == commentlist[i]) {
    //             //check time diff and check id comment
    //             $('#' + comment).detach();
    //         } else {
    //             $('#' + comment).show();
    //             $('#' + comment).css('color', '');
    //         }
    //         i++;
    //         if (i >= commentlist.length) i = 0;
    //     });
    // }, 1000);

    // $('article').readmore({
    //     afterToggle: function(trigger, element, expanded) {
    //         if(! expanded) { // The "Close" link was clicked
    //             $('html, body').animate( { scrollTop: element.offset().top }, {duration: 100 } );
    //         }
    //     }
    // });

});

/*
   *
   * Forward AND Reply
   *
*/
var initializeForwardAndReply = function () {
    let listmail = [];
    //Check send option
    if ($("#sendOption").val() === "reply") {
        $("#replyTo").show();
        $("#forwadTo").hide();
    }
    $("#sendOption").change(function () {
        //console.log($(this).val());
        $("#replyTo").toggle();
        $("#forwadTo").toggle();
    });
    //user key up input to forward mail
    $('#keyword-forward').on('input', function () {
        let userText = $(this).val();
        //get value user ต้องการ forward ถึงใครบ้าง
        $("#forward-name").find("option").each(function () {
            if ($(this).val() == userText) {
                listmail.push($(this).data('customvalue'));
                //console.log(listmail);
                $("#receiver").append("<span style='box-sizing: border-box;  border: 1px solid black; margin-right: 10px; padding: 10px;'" +
                    "id='" + $(this).data('customvalue') + "' class='listForward'>"
                    + $(this).val() + "<span style='padding-left: 15px'><i class='fa fa-remove'></i></span></span>");
            }
        })
    });
    //user ลบรายชื่อที่ต้องการ forward ออก
    $(document).on('click', '.listForward', function () {
        let transaction_id = $(this).attr('id');
        //console.log(transaction_id);
        if (transaction_id === $(this).attr('id')) {
            $(this).remove(); //delete box user
            for (let i = listmail.length; i--;) {
                if (listmail[i] == transaction_id) {
                    listmail.splice(i, 1);
                    //console.log(listmail);
                }
            }
        }
    });

    //user ต้องการตอบกลับ หรือส่งต่อ
    function forWardMail(json, inbox_id, comment) {
        $.ajax({
            url: 'forward-mail',
            type: 'post',
            data: {
                listmail: json,
                inbox_id: inbox_id,
                comment: comment
            },
            beforeSend: function () {
                $('body').loading({
                    stoppable: false,
                    theme: 'light',
                    message: 'กรุณารอสักครู่..'
                });
            },
            complete: function (response) {
                // console.log(response);
            },
            success: function (msg) {
                window.location.reload();
            }
        });
    }

    function replyMail(url, inbox_id, comment, sendType) {
        $.ajax({
            url: url,
            type: 'post',
            data: {
                inbox_id: inbox_id,
                comment: comment,
                sendType: sendType
            }, beforeSend: function () {
                $('body').loading({
                    theme: 'light',
                    message: 'กรุณารอสักครู่..'
                });
            },
            complete: function (data) {
                //  console.log(data);
            },
            success: function (msg) {
                //  console.log(msg);
                $('body').loading('stop');
                // get the current gridview page url
                $.pjax.reload({container: "#pjax-container", async: false});
                initializePlugins();
                //window.location.reload();
            }
        });
    }

    $('#submit').click(function (e) {
        let inbox_id = $('#inbox_id').val();
        let comment = $('#content').val();
        let sendType = $('#sendOption').val();
        if ($('#sendOption').val() == "forward" && comment != "") {
            $("#comment-error").hide();
            let json = JSON.stringify(listmail);
            //console.log(json);
            forWardMail(json, inbox_id, comment);
        } else if (comment != "") {
            $("#comment-error").hide();
            replyMail('reply-mail', inbox_id, comment, sendType);
        } else {
            $("#content").parent('div').addClass('has-error');
            $("#comment-error").show();
        }
    });
    //user ตอบกลับจากหน้า read-send-mail
    $('#submitReadSentPage').click(function (e) {
        var inbox_id = $('#inbox_id').val();
        var comment = $('#content').val();
        var sendType = $('#sendOption').val();
        // console.log(sendType);
        if ($('#sendOption').val() == "forward" && comment != "") {
            var json = JSON.stringify(listmail);
            forWardMail(json, inbox_id, comment);
        } else {
            if (comment != "") {
                replyMail('reply-mail-from-sent-page', inbox_id, comment, sendType);
            }
        }
    });
    //mailApproveForm
    $('#submitApprove').click(function (e) {
        var inbox_id = $('#inbox_id').val();
        var comment = $('#content').val();
        var sendType = $('#sendApproveOption').val();
        replyMail('approve-book', inbox_id, comment, sendType);
    });
};
var initializePlugins = function () {

    //$('.comment-dateTime').hide();
    var commentlist = [];
    var i = 0;
    let url;
    let current_page_URL = window.location.href;
    url = (current_page_URL.split('/'));
    // console.log(url[url.length-1]);
    $(".undoSend").click(function () {
        //var r = confirm("ต้องการยกเลิกข้อความใช่หรือไม่ ?");
        swal({
            title: "ท่านต้องการยกเลิกการตอบกลับใช่หรือไม่?",
            text: "ท่านไม่สามารถกู้คืนได้หากยกเลิก",
            icon: "warning",
            dangerMode: true,
            buttons: ["ไม่ ฉันไม่ต้องการ", "ใช่ ฉันต้องการ"],
        })
            .then(willDelete => {
                    if (willDelete) {
                        swal("Deleted!", {icon: "success", button: false,});
                        return $.ajax({
                            url: 'cancel-message',
                            type: 'get',
                            data: {
                                message: message,
                                inbox: inbox,
                                url: url[url.length - 1]
                            }, success: function () {
                                window.location.reload();
                            }
                        });
                    }
                }
            );
    });

    $('.undoSend').each(function () {
        commentlist.push($(this).attr('id')); //นำไอดีของคอมเม้นแต่ละแถวมันเก็บไว้
    });
    setInterval(function () {
        $('.comment-dateTime').each(function () {
            let timeComment = $(this).attr('id'); //get element datetime
            let comment = $(this).val(); //get element inbox_id
            //let now2 = moment();
            //let ms = moment(now2.format('YYYY-MM-DD HH:mm:ss')).diff(moment(timeComment)); //find time diff
            //let d = moment.duration(ms);
            // if ((d.minutes() == 0 && d.hours() == 0) && comment == commentlist[i]) {
            //     //check time diff and check id comment
            //     $('#' + comment).show();
            // } else if ((d.minutes() > 0 && d.hours() >= 0) && comment == commentlist[i]) {
            //     $('#' + comment).detach();
            // }
            // i++;
            // if (i >= commentlist.length){
            //     i = 0;
            // }
            // if($('.undoSend').length >= 1)
            // {
            //     $('#textCancel').show();
            // }else {
            //     $('#textCancel').hide();
            // }
            /* let serverTime = moment();
             let ms = moment(serverTime.format('YYYY-MM-DD HH:mm:ss')).diff(moment(timeComment)); //find time diff
             let d = moment.duration(ms);*/
            //console.log(today+" "+timeComment.substring(0,10)+ " "+comment);
            //console.log(serverTime);
            //console.log( d.years(), d.months(),d.days(), d.hours(), d.minutes(), d.seconds());
            $.ajax({
                type: "GET",
                data: {
                    'timeComment': timeComment
                },
                url: "ajax-get-server-time",
                success: function (result) {
                    if ((result == "true") && comment == commentlist[i]) {
                        //check time diff and check id comment
                        $('#' + comment).show();
                        $('#' + comment).css({display:''});
                    } else if ((result == "false") && comment == commentlist[i]) {
                        $('#' + comment).detach();
                    }
                    i++;
                    if (i >= commentlist.length) i = 0;
                }
            });
            if($('.undoSend').length >= 1)
            {
                $('#textCancel').show();
            }else {
                $('#textCancel').hide();
            }
        });
    }, 2000);
    $('.pagination').addClass('pull-right');

};