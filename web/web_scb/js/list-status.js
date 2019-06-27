/**
 * Created by PzPavilion on 30/3/2561.
 */
$(document).ready(function () {
  $('#check_all').click(function (e) {

    var sum = $('#sum').val();
    var status = $('#check_all').val();
    if(status == 1){
      $(".check").prop("checked",true);
      for(var i = 0 ;i < sum ;i++){
        var key = i+1;
        var id = "id_card"+key;
        $('#'+key).val($('#'+id).val());
      }
      $('#check_all').val("0");
    }else{
      $(".check").prop("checked",false);
      for(var i = 0 ;i < sum ;i++){
        var key = i+1;
        $('#'+key).val("on");
      }
      $('#check_all').val("1");
    }
  });
  $()

  $('.status_check').click(function () {
    var status = $(this).attr("data");
    $('#status_sent').val(status);
    $('#list_by_sc').submit();
  });

  $('.check').click(function () {
    var li = $(this).prop("id");
    if($(this).val() == "on"){
      var id = "id_card"+li;
      $(this).val($('#'+id).val());
    }else{
      $(this).val("on");
    }
  });
});

