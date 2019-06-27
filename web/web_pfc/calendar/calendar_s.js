
var user = {};
var GoogleAuth;
var SCOPE = 'https://www.googleapis.com/auth/calendar';

var CAL_ID_XD = null;
var EVENT_ID_XD = null;
var START_XD = null;
var END_XD = null;
var SUMMARY_XD = null;
var DESCRIPTION_XD = null;
var EmailComp1 = null;
var EmailComp2 = null;
var cid = null;
var em1 = null;
var em2=null;
var day=null;
var Tday=null;
var Wday=null;
var REMINDER_XD =null;
var email_check = "<?php Print($email); ?>";


function handleClientLoad() {
    // Load the API's client and auth2 modules.
    // Call the initClient function after the modules load.
    gapi.load('client:auth2', initClient);
}

function initClient() {

    // Retrieve the discovery document for version 3 of Google Drive API.
    // In practice, your app can retrieve one or more discovery documents.
//        var discoveryUrl = 'https://www.googleapis.com/discovery/v1/apis/drive/v3/rest';
    var discoveryUrl = 'https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest';

    // Initialize the gapi.client object, which app uses to make API requests.
    // Get API key and client ID from API Console.
    // 'scope' field specifies space-delimited list of access scopes.
    gapi.client.init({

        'apiKey': 'AIzaSyCg2nd4tlvs3xGu4ugXIRu_Hmzn6mBpWrQ',
        'discoveryDocs': [discoveryUrl],
        'clientId': '6316704372-3vifm1qd136c29ujbop9g0ubdfvg6n43.apps.googleusercontent.com',
        'scope': SCOPE
    }).then(function () {
        GoogleAuth = gapi.auth2.getAuthInstance();

        // Listen for sign-in state changes.
        GoogleAuth.isSignedIn.listen(updateSigninStatus);
        //listUpcomingEvents();

        // Handle initial sign-in state. (Determine if user is already signed in.)
        user = GoogleAuth.currentUser.get();
        setSigninStatus();


        // Call handleAuthClick function when user clicks on
        //      "Sign In/Authorize" button.
        $('#sign-in-or-out-button').click(function () {
            handleAuthClick();
        });
        $('#revoke-access-button').click(function () {
            revokeAccess();
        });
    });
}

function handleAuthClick() {
    if (GoogleAuth.isSignedIn.get()) {

        // User is authorized and has clicked 'Sign out' button.
        GoogleAuth.signOut();
    } else {
        // User is not signed in. Start Google auth flow.
        GoogleAuth.signIn();
    }
}

function revokeAccess() {
    GoogleAuth.disconnect();
    location.reload();

}


function Delete(calId) {
    var request = gapi.client.calendar.calendarList.delete({
        'calendarId': calId,
    });

    request.execute(function(resp) {
        if (typeof resp.code === 'undefined') {
            alert("Calendar was successfully removed!");
            location.reload();
        }else{
            alert('An error occurred... Error code: '+ resp.code +' - Message: '+resp.message);
        }

    });



}

function privaterole(calId) {
    request = gapi.client.calendar.acl.update({
        calendarId: calId,
        ruleId: 'default',
        scope: {
            type: "default"
        },
        role: "freeBusyReader",

    });


    request.execute(function (calendar) {
        location.reload()
//            console.log(calId)

    })
}
document.getElementById('accept').onclick = function () {
    request = gapi.client.calendar.events.update({
        calendarId: CAL_ID_XD,
        ruleId: 'default',
        eventId: EVENT_ID_XD,
        "start": {
            "dateTime": START_XD
        },
        "end": {
            "dateTime": END_XD
        },
        status: "confirmed",
        summary: SUMMARY_XD + "(✔)",
        description: DESCRIPTION_XD,
        "reminders": {
            "overrides": [
                {
                    "method": "email",
                    "minutes": 1
                },
                {
                    "method": "email",
                    "minutes": 1440
                }
            ],
            "useDefault": false
        }
    });

    request.execute(function (calendar) {
        location.reload();
    })
};

document.getElementById('cancelled').onclick = function () {
    request = gapi.client.calendar.events.update({
        calendarId: CAL_ID_XD,
        ruleId: 'default',
        eventId: EVENT_ID_XD,
        "start": {
            "dateTime": START_XD
        },
        "end": {
            "dateTime": END_XD
        },
        status: "tentative",
        summary: SUMMARY_XD + "(✘)",
        description: DESCRIPTION_XD
    });
    request.execute(function (calendar) {
        console.log(status)
        location.reload()
    })
};
document.getElementById('cancelled2').onclick = function () {
    request = gapi.client.calendar.events.update({
        calendarId: CAL_ID_XD,
        ruleId: 'default',
        eventId: EVENT_ID_XD,
        "start": {
            "dateTime": START_XD
        },
        "end": {
            "dateTime": END_XD
        },
        status: "tentative",
        summary: SUMMARY_XD + "(✘)",
        description: DESCRIPTION_XD
    });
    request.execute(function (calendar) {
        console.log(status);
        location.reload()
    })
};

document.getElementById('delete1').onclick = function () {
    var request = gapi.client.calendar.events.delete({
        calendarId: CAL_ID_XD,
        ruleId: 'default',
        eventId: EVENT_ID_XD
    });
    request.execute(function (calendar) {
        console.log(calendar)
        location.reload();
    })
};
document.getElementById('delete2').onclick = function () {
    var request = gapi.client.calendar.events.delete({
        calendarId: CAL_ID_XD,
        ruleId: 'default',
        eventId: EVENT_ID_XD
    });
    request.execute(function (calendar) {
        console.log(calendar)
        location.reload();
    })
};
document.getElementById('insert').onclick = function () {
    $('#eee').modal();
};
document.getElementById('Sub').onclick = function () {
    cid = $('#cid').val();
    console.log(cid)

    var request = gapi.client.calendar.calendarList.insert({
        "id": cid,
        colorRgbFormat: true
    });


    request.execute(function(resp) {
        if (typeof resp.code === 'undefined') {
            alert("Calendar was successfully subscribed!");
        }else{
            alert('An error occurred... Error code: '+ resp.code +' - Message: '+resp.message);
        }

    });
    // }else {
    //     alert("กรุณากรอก Gmail ให้ตรงกับคำแนะนำ");
    // }

};



document.getElementById('qwe').onclick = function () {
    $('#www').modal();
};
document.getElementById('con').onclick = function () {
    em1 =  $('#em1').val();
    em2 =  $('#em2').val();
    summa = $('#summa').val();
    console.log(em2,em1,summa)
    var request = gapi.client.calendar.calendars.insert({
        summary: summa,
        'timeZone': 'Asia/Bangkok',
    });

    request.execute(function (calendar) {

        request = gapi.client.calendar.acl.insert({
            calendarId: calendar.id,
            role: "owner",
            scope: {
                type: "group",
                value: em1
            },
        });

        request.execute(function (calendar) {
        });
        request = gapi.client.calendar.acl.insert({
            calendarId: calendar.id,
            role: "owner",
            scope: {
                type: "group",
                value: em2
            },
        });
        request.execute(function (calendar) {
        });
        request = gapi.client.calendar.acl.insert({
            calendarId: calendar.id,
            rule: "public",
            scope: {
                type: "default"
            },
            role: "reader"
        });

        request.execute(function (calendar) {
            console.log(calendar)
//                                location.reload();
        })
    });
};


$('#mytime .time').timepicker({
    'showDuration': true,
    'timeFormat': 'H:i'
});


$('#mytime').datepair();

$('#detailModalnormal').click(function () {
    $('#title-xd').html(SUMMARY_XD);
    $('#description-xd').html(DESCRIPTION_XD);
    $('#time-start-xd').html(moment(new Date(START_XD)).format('HH:mm'));
    $('#time-end-xd').html(moment(new Date(END_XD)).format('HH:mm'));
});

$('#detailModal').click(function () {
    $('#title-xd').html(SUMMARY_XD);
    $('#description-xd').html(DESCRIPTION_XD);
    $('#time-start-xd').html(moment(new Date(START_XD)).format('HH:mm'));
    $('#time-end-xd').html(moment(new Date(END_XD)).format('HH:mm'));
});
$('#detailModal2').click(function () {
    $('#title-xd').html(SUMMARY_XD);
    $('#description-xd').html(DESCRIPTION_XD);
    $('#time-start-xd').html(moment(new Date(START_XD)).format('HH:mm'));
    $('#time-end-xd').html(moment(new Date(END_XD)).format('HH:mm'));
});
$('#selfModal').click(function () {
    $('#title-xd').html(SUMMARY_XD);
    $('#description-xd').html(DESCRIPTION_XD);
    $('#time-start-xd').html(moment(new Date(START_XD)).format('HH:mm'));
    $('#time-end-xd').html(moment(new Date(END_XD)).format('HH:mm'));
});
$('#cancelledModal').click(function () {
    $('#title-xd').html(SUMMARY_XD);
    $('#description-xd').html(DESCRIPTION_XD);
    $('#time-start-xd').html(moment(new Date(START_XD)).format('HH:mm'));
    $('#time-end-xd').html(moment(new Date(END_XD)).format('HH:mm'));
});
$('#accepted').click(function () {
    $('#title-xd').html(SUMMARY_XD);
    $('#description-xd').html(DESCRIPTION_XD);
    $('#time-start-xd').html(moment(new Date(START_XD)).format('HH:mm'));
    $('#time-end-xd').html(moment(new Date(END_XD)).format('HH:mm'));
});


////////fix role////////


/////////INSERT NEW CALENDAR////////
document.getElementById('xqc').onclick = function () {
    console.log(gapi)

    var summa = prompt('กรอกชื่อปฏิทิน');
    var request = gapi.client.calendar.calendars.insert({
        summary: summa,
        'timeZone': 'Asia/Bangkok',
    });

    request.execute(function (calendar) {

        request = gapi.client.calendar.acl.insert({
            calendarId: calendar.id,
            rule: "public",
            scope: {
                type: "default"
            },
            role: "reader"
        });

        request.execute(function (calendar) {
            console.log(calendar)
//                                location.reload();
        })

        console.log(calendar);

    });

    console.log(5555)
}


////////CALENDAR////////
function calendar(ARRAY) {
    console.log(gapi.client.calendar.calendarList.get)
    $('#calendar').fullCalendar({
        googleCalendarApiKey: 'AIzaSyCg2nd4tlvs3xGu4ugXIRu_Hmzn6mBpWrQ',
        selectable: true,
        selectHelper: true,
        eventLimit: true,
        header: {
            left: 'prev,next Calendar',
            center: 'title',
            right: 'listDay,listWeek,listMonth,month'
        },
        views: {
            listDay:{ buttonText: 'List Day' },
            listWeek: { buttonText: 'List Week' },
            listMonth: { buttonText: 'List Month' },
            month: {buttonText: 'Calendar'},
        },

        ////Event Detail////
        eventClick: function (Event,ARRAY,Calendar) {


            $('#title-xd').html(Event.title);
            $('#description-xd').html(Event.description);
            $('#time-start-xd').html(moment(new Date(Event.start)).format('HH:mm'));
            $('#time-end-xd').html(moment(new Date(Event.end)).format('HH:mm'));
            // $('#time-remind-xd').html(Event.reminders);
            console.log(Event.source.ajaxSettings.summary);
            CAL_ID_XD = Event.source.googleCalendarId;
            EVENT_ID_XD = Event.id;
            START_XD = Event.start._i;
            END_XD = Event.end._i;
            SUMMARY_XD = Event.title;
            DESCRIPTION_XD = Event.description;
            // REMINDER_XD = Event.reminders;
            var buffet_pls = $('#buffet-pls').html();

            if (Event.title.endsWith('(✔)')) {
                $('#modal-accepted-lul').html(buffet_pls);
                $('#accepted').modal();
                $('#modal-accepted-lul').click();
//                                    console.log(SUMMARY_XD, DESCRIPTION_XD)
                return false
            } else if (CAL_ID_XD.includes('holiday')) {
//                                    console.log('wp')
            } else if (Event.title.endsWith('(✘)')) {
                $('#modal-cancel-lul').html(buffet_pls);
                $('#cancelledModal').modal();
                $('#modal-cancel-lul').click();
//                                    console.log(SUMMARY_XD, DESCRIPTION_XD)
            } else if (CAL_ID_XD == EmailComp1) {
                $('#modal-detailself-lul').html(buffet_pls);
                $('#selfModal').modal();
                $('#modal-detailself-lul').click();
//                                    console.log(SUMMARY_XD, DESCRIPTION_XD)
            } else {
                if (Event.source.googleCalendarId.includes('@group.calendar')){
                    if (Event.description.endsWith(EmailComp1)) {
                        $('#modal-detail2-lul').html(buffet_pls);
                        $('#detailModal2').modal();
                        $('#modal-detail2-lul').click();
                    } else if(Event.source.ajaxSettings.summary.includes('csc')){
                        $('#modal-detail-lul').html(buffet_pls);
                        $('#detailModal').modal();
                        $('#modal-detail-lul').click();
                    }else {
                        $('#modal-normal-lul').html(buffet_pls);
                        $('#detailModalnormal').modal();
                        $('#modal-normal-lul').click();
                    }
                } else  {
                    $('#modal-normal-lul').html(buffet_pls);
                    $('#detailModalnormal').modal();
                    $('#modal-normal-lul').click();
                }
            }


            // change the border color just for fun
            $(this).css('border-color', 'red');

            return false;

        },
        ////////create event //////////
        select: function (start, end, discription, jsEvent, view) {
            $(".modal").on("calendarModal", function(){
                $(".calendarModal").html("");
            });
            $('#calendarModal').modal();
            $('#create').click(function () {
                startts = $('#mytime_start').val();
                endte = $('#mytime_end').val();
                calId = $('#cal_select').find(':selected').val();
                description = $('#description').val();
                summary = $('#summary').val();
                Emails = EmailComp1;
                var event = {

                    'summary': summary,
                    'description': description + "      ผู้สร้าง : " + Emails,
                    'start': {
                        'dateTime': moment(start).format() + "T" + startts + ":00",
                        'timeZone': 'Asia/Bangkok',
                    },
                    'end': {
                        'dateTime': moment(start).format() + "T" + endte + ":00",
                        'timeZone': 'Asia/Bangkok',
                    },
                    'status': "tentative",
                    "reminders": {
                        "overrides": [
                            {
                                "method": "email",
                                "minutes": 1
                            },
                            //             {
                            //                 "method": "email",
                            //                 "minutes": 1440
                            //             },
                            //             if(Tday == "1"){
                            //     {
                            //         "method": "email",
                            //         "minutes": 4320
                            //     },
                            // }
                            //             if(Wday == "1"){
                            //     {
                            //         "method": "email",
                            //         "minutes": 10080
                            //     },
                            // }
                        ],
                        "useDefault": false
                    }

                };


//                                console.log(user.w3.U3);

                var request = gapi.client.calendar.events.insert({

                    'calendarId': calId,
                    'resource': event,

                });


                request.execute(function (resp,event) {
                    if (typeof resp.code === 'undefined') {
                        alert("สร้างข้อมูลสำเร็จ");
                        location.reload();
                    }else{
                        alert("ผิดพลาดในการสร้างข้อมูล โปรดตรวจสอบปฏิทินที่เลือก");
                        location.reload();
                    }


                });



            });



        },
        eventSources: ARRAY



    });
    TEMP = $('#calendar').fullCalendar('getEventSources')

}
///////sort by name//////////
function compare(a, b) {
    if (a.summary.toLowerCase() < b.summary.toLowerCase())
        return -1;
    if (a.summary.toLowerCase() > b.summary.toLowerCase())
        return 1;
    return 0;
}


var ARRAY;
var TEMP;

function checkbox(ev) {
    console.log(ev)
    if (!$(this).is(':checked'))
        console.log("not")
    else console.log("check")
}


function setSigninStatus(isSignedIn) {

    user = GoogleAuth.currentUser.get();
    var isAuthorized = user.hasGrantedScopes(SCOPE);




    if (isAuthorized) {
//            if (user.w3.U3 == email_check){
        $('#ggez').attr('class', 'row')
        $('#insert').css('display','inline');
        $('#qwe').css('display','inline');
        $('#sign-in-or-out-button').css('display', 'none');
        $('#revoke-access-button').css('display', 'inline');
        $('#GoBtn').css('display', 'inline');
        $('#auth-status').html('You are currently signed in and have granted ' +
            'access to this app.');
        console.log(user);
        ARRAY = [];
        gapi.client.calendar.calendarList.list().then(function (resp) {
//                                console.log(resp)
            EmailComp1 = user.w3.U3
//                                console.log(user.w3.U3)
            var list = $("#list");
            var select = $("#cal_select");
            resp.result.items = resp.result.items.sort(compare);   //////resp.result.items[o].summary

            for (o = 1; o < resp.result.items.length; o++) {
                list.append('<div class="rcorners4" style="color: ' + resp.result.items[o].backgroundColor + '">' +
                    '<input  type="checkbox" value="' + (o - 1) + '" checked>' +
                    '<div style="cursor:pointer" id="please"  data-toggle="popover" ' +
                    'title="<button onclick=Delete(\'' + resp.result.items[o].id + '\') value=resp.result.items[o].id()>Remove</button>" ' +
                    'data-content="">' +
                    resp.result.items[o].summary + '</div>' + '<div>');
                list.append('<br>');
                select.append('<option value="' + resp.result.items[o].id + '">' + resp.result.items[o].summary + '</option>');
                ARRAY.push({
                    summary: resp.result.items[o].summary,
                    backgroundColor: resp.result.items[o].backgroundColor,
                    googleCalendarId: resp.result.items[o].id,
                    className: ""
                })
            }
//                                console.log(ARRAY)


            $('[data-toggle="popover"]').popover({html: true, button: true});


            $("input:checkbox").click(function () {
                var HAHAHA = $('#calendar').fullCalendar('getEventSources');
                if ($(this).is(':checked')) {
                    HAHAHA[$(this).val()].className[0] = "";
                    $('#calendar').fullCalendar('addEventSource', HAHAHA);
                } else {
                    HAHAHA[$(this).val()].className[0] = "hidden";
                }
                $('#calendar').fullCalendar('addEventSource', HAHAHA);
                $('#calendar').fullCalendar('rerenderEvents');

            });
            calendar(ARRAY);

        })
//            }else{
//                revokeAccess().click();
//            }
    } else {
        $('#ggez').attr('class', 'row hidden')
        $('#sign-in-or-out-button').html('Connect To Calendar');
        $('#revoke-access-button').css('display', 'none');
        $('#GoBtn').css('display', 'none');
        $('#auth-status').html('You have not authorized this app or you are ' +
            'signed out.');

    }
}
function updateSigninStatus(isSignedIn) {

    setSigninStatus();
}