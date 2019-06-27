/*globals $:false */
$(document).ready(function() {
  "use strict";
  $("#score_candidate").click(function(){
    var sci =  $('#sci').val();
    var math=  $('#math').val();
    var com =  $('#com').val();
    var id =  $('#id').val();

    $.ajax({
      url: '../candidate/createscore',
      data: {
        'sci': sci,
        'math': math,
        'com': com,
        'id': id
      },
      type: "get" ,
      success: function(data){
        if(data){
          $('#graph').html(data);
        }
      }
    });
  });

});