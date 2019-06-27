/**
 * Created by VaraPhon on 1/23/2018.
 */
$(document).ready(function () {
    /* show and hide list of user */

//$("#addOtherType").hide();
    $("#hidden-input").hide();
    $("#listOfCEO").hide();
    $("#listOfStaff").hide();
    $("#listOfCS").hide();
    $("#listOfICT").hide();
    $("#listOfGIS").hide();
    $("#contarct-box").hide();
//เลือกทั้งหมด
    $("#allContract").click(function () {
        $("#contarct-box").show();
        $("#checkAll2").hide();
        $("#check3").hide();
        $("#listOfCEO").toggle();
        $("#listOfStaff").toggle();
        $("#listOfCS").toggle();
        $("#listOfICT").toggle();
        $("#listOfGIS").toggle();
        $(':checkbox.checkedAll').prop('checked', this.checked);
        $(':checkbox.listceo').prop('checked', this.checked);
        $(':checkbox.liststaff').prop('checked', this.checked);
        $(':checkbox.listcs').prop('checked', this.checked);
        $(':checkbox.listict').prop('checked', this.checked);
        $(':checkbox.listgis').prop('checked', this.checked);
    });

    var temp = []; //เอาไว้เก็บว่าเลือกรายชื่อกลุ่มไหนบ้าง
//เลือกรายชื่ออื่นๆ ที่ไม่ใช่เลือกทั้งหมด
    $(".checkedAll").click(function () {
        $("#contarct-box").show();
        $("#checkAll2").show();
        $("#check3").show();

        if ($(this).attr('id') == "ceo") {
            $("#listOfCEO").toggle();
            temp.push($(this).attr('id'));
        } else if ($(this).attr('id') == "staff") {
            $("#listOfStaff").toggle();
            temp.push($(this).attr('id'));
        } else if ($(this).attr('id') == "cs") {
            $("#listOfCS").toggle();
            temp.push($(this).attr('id'));
        } else if ($(this).attr('id') == "ict") {
            $("#listOfICT").toggle();
            temp.push($(this).attr('id'));
        } else if ($(this).attr('id') == "gis") {
            $("#listOfGIS").toggle();
            temp.push($(this).attr('id'));
        }
        for (var i = 0; i < temp.length; i++) {
            var index = temp.indexOf(temp[i]);
            if (!$('#cs').is(':checked') && temp[i] == 'cs') {
                temp.splice(index, 1);
                $(':checkbox.listcs').prop('checked', false);
            }
            if (!$('#ict').is(':checked') && temp[i] == 'ict') {
                temp.splice(index, 1);
                $(':checkbox.listict').prop('checked', false);
            }
            if (!$('#gis').is(':checked') && temp[i] == 'gis') {
                temp.splice(index, 1);
                $(':checkbox.listgis').prop('checked', false);
            }
            if (!$('#ceo').is(':checked') && temp[i] == 'ceo') {
                temp.splice(index, 1);
                $(':checkbox.listceo').prop('checked', false);
            }
            if (!$('#staff').is(':checked') && temp[i] == 'staff') {
                temp.splice(index, 1);
                $(':checkbox.liststaff').prop('checked', false);
            }
        }

    });
    $("#checkAll2").click(function () {
        //console.log(temp,'before');
        for (var i = 0; i < temp.length; i++) {
            var index = temp.indexOf(temp[i]);
            if (!$('#cs').is(':checked') && temp[i] == 'cs') {
                temp.splice(index, 1);
            }
            if (!$('#ict').is(':checked') && temp[i] == 'ict') {
                temp.splice(index, 1);
            }
            if (!$('#gis').is(':checked') && temp[i] == 'gis') {
                temp.splice(index, 1);
            }
            if (!$('#ceo').is(':checked') && temp[i] == 'ceo') {
                temp.splice(index, 1);
            }
            if (!$('#staff').is(':checked') && temp[i] == 'staff') {
                temp.splice(index, 1);
            }

            $(':checkbox.list' + temp[i]).prop('checked', this.checked);
        }
        //console.log(temp,'after');
    });
// $("#ceo").click(function () {
//     $("#listOfCEO").toggle();
// });
// $("#staff").click(function () {
//     $("#listOfStaff").toggle();
// });
// $("#cs").click(function () {
//     $("#listOfCS").toggle();
// });
// $("#ict").click(function () {
//     $("#listOfICT").toggle();
// });
// $("#gis").click(function () {
//     $("#listOfGIS").toggle();
// });
    $('#checkAllCEO').click(function () {
        $(':checkbox.listceo').prop('checked', this.checked);
    });
    $('#checkAllStaff').click(function () {
        $(':checkbox.liststaff').prop('checked', this.checked);
    });
    $('#checkAllCS').click(function () {
        $(':checkbox.listcs').prop('checked', this.checked);
    });
    $('#checkAllICT').click(function () {
        $(':checkbox.listict').prop('checked', this.checked);
    });
    $('#checkAllGIS').click(function () {
        $(':checkbox.listgis').prop('checked', this.checked);
    });
});
