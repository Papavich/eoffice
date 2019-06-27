/**
 * Created by VaraPhon on 1/23/2018.
 */
$(document).ready(function () {
    $.ajax({ //call API
        url: '../main-user/index',
        success: function (response) {
            //console.log(response);\
            var current_page_URL = window.location.href;
            var current_page_URL2 = window.location.href;
            //  console.log(current_page_URL.substr(-8));
            if (current_page_URL.substr(-12) != "receive-form" && current_page_URL2.substr(-8) != "testmail") {
                $.ajax({
                    url: 'check-receiver',
                    type: 'get',
                    data: {
                        id: $('#updateId').val()
                    },
                    success: function (response) {
                        console.log(response);
                        //var obj = $.parseJSON(response);
                        console.log(response);
                        appendContractList(response);

                    }
                });
            } else {
                console.log(response);
                appendContractListInCreateReceive(response);
            }
        }
    });

    function appendContractList(person) {
        for (var i = 0; i < person.length; i++) {
            if (person[i].person_position_type == "อาจารย์") {
                if (person[i].major_id == 1) {
                    $('#listOfCS').append('<input type="checkbox" name="list_mail[]" value="' + person[i].id + '"' +
                        'class="listcs" />' + person[i].person_name + " " + person[i].person_surname +
                        '<br>');
                } else if (person[i].major_id == 2) {
                    $('#listOfICT').append('<input type="checkbox" name="list_mail[]" value="' + person[i].id + '"' +
                        'class="listict" />' + person[i].person_name + " " + person[i].person_surname +
                        '<br>');
                } else if (person[i].major_id == 3) {
                    $('#listOfGIS').append('<input type="checkbox" name="list_mail[]" value="' + person[i].id + '"' +
                        'class="listgis" />' + person[i].person_name + " " + person[i].person_surname +
                        '<br>');
                }
            }

        }
    }

    function appendContractListInCreateReceive(person) {
        for (var i = 0; i < person.data.length; i++) {
            if (person.data[i].person_fname_th && person.data[i].prefix_en != "Mr." && person.data[i].prefix_en != "Miss"
            ) {
                if (person.data[i].major_id == "1") {
                    $('#listOfCS').append('<input type="checkbox" name="list_mail[]" value="' + person.data[i].id + '"' +
                        'class="listcs" />' + person.data[i].prefix_th + person.data[i].person_fname_th + " "
                        + person.data[i].person_lname_th +
                        '<br>');
                } else if (person.data[i].major_id == "2") {
                    $('#listOfICT').append('<input type="checkbox" name="list_mail[]" value="' + person.data[i].id + '"' +
                        'class="listict" />'  + person.data[i].prefix_th
                        + person.data[i].person_fname_th + " "+ person.data[i].person_lname_th +
                        '<br>');
                } else if (person.data[i].major_id == "3") {
                    $('#listOfGIS').append('<input type="checkbox" name="list_mail[]" value="' + person.data[i].id + '"' +
                        'class="listgis" />'  + person.data[i].prefix_th
                        + person.data[i].person_fname_th + " " + person.data[i].person_lname_th +
                        '<br>');
                }
            } else if (person.data[i].person_fname_th && person.data[i].prefix_en == "Mr."
                && person.data[i].prefix_en !== "Miss") {
                $('#listOfStaff').append('<input type="checkbox" name="list_mail[]" value="' + person.data[i].id + '"' +
                    'class="listcs" />' + person.data[i].prefix_th + person.data[i].person_fname_th + " "
                    + person.data[i].person_lname_th +
                    '<br>');

            }
        }
    }
});

