/*globals $:false */
$(document).ready(function () {
    "use strict";

    $("#submit_prosub").click(function (e) {
        e.preventDefault();
        var form = $(".prosub-valid-date").serialize();
        var datas = "";
        $.ajax({
            url: "../addprosub/rule-date",
            type: 'post',
            async: false,
            data: form,
            success: function (data) {
                datas = data;
                //console.log(data);
            }
        });

        if (datas == "true") {
            $(".prosub-valid-date").submit();
            return true;
        } else {
            alert(datas);
            return false;
        }
    });


    $("#submit_place").click(function (e) {
        e.preventDefault();
        var form = $(".compact_place-valid-date").serialize();
        var datas = "";
        $.ajax({
            url: "../addprosub/rule-date-place",
            type: 'post',
            async: false,
            data: form,
            success: function (data) {
                datas = data;
                console.log(data);
            }
        });

        if (datas == "true") {
            $(".compact_place-valid-date").submit();
            return true;
        } else {
            alert("กำหนดการจัดโครงกาไม่ถูกต้อง กรุณาตรวจสอบ");
            return false;
        }
    });

    $("#submit_pandb").click(function (e) {
        e.preventDefault();
        var form = $(".compact_pandb-valid-date").serialize();
        var datas = "";
        $.ajax({
            url: "../addprosub/rule-date-pandb",
            type: 'post',
            async: false,
            data: form,
            success: function (data) {
                datas = data;
                console.log(data);
            }
        });

        if (datas == "true") {
            $(".compact_pandb-valid-date").submit();
            return true;
        } else {
            alert("กำหนดการจัดโครงกาไม่ถูกต้อง กรุณาตรวจสอบ");
            return false;
        }
    });




});