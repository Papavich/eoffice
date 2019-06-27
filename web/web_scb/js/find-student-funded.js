/*globals $:false */
$(document).ready(function() {
  "use strict";
  $('#scbfunded-student_id').keyup(function (e) {
    e.preventDefault();
    var std = $('#scbfunded-student_id').val();
    console.log(std);
    $.ajax({
      url: '../funded-grant/getstd',
      data: {
        'student': std
      },
      type: "get",
      success: function (data) {
        if(data){
          $('#show').html(data);
        }
      }
    });
  });

  $('#student_id').keyup(function (e) {
    e.preventDefault();
    var std = $('#student_id').val();
    console.log(std);
    $.ajax({
      url: '../funded-grant/checkid',
      data: {
        'student': std
      },
      type: "get",
      success: function (data) {
        if(data){
          $('#show').html(data);
        }
      }
    });
  });

  $('#search-funded').click(function (e) {
    e.preventDefault();
    var key = $('#student_id').val();
    var sem = $('#semester').val();
    $.ajax({
      url: '../funded-grant/funded-js',
      data: {
        'key': key,
        'sem': sem,
      },
      type: "get",
      success: function (data) {
        if(data){
          $('#funded').html(data);
        }
      }
    });

    setTimeout(function() {
      $('pre').hide();
    }, 1500);
  });


});