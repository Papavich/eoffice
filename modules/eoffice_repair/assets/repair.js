window.onload = function() {
  $('#hide').css('display','none');
  $('#show').css('display','block');
};

$(document).ready(function(){
  $("input[type='radio'][value=1]").click(function(){
    $('#hide').css('display','none');
    $('#show').css('display','block');
  });

  $("input[type='radio'][value=2]").click(function(){
   $('#show').css('display','none');
   $('#hide').css('display','block');
  });

});
