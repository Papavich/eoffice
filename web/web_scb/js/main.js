$(function () {

  $(document).on('click', '.fc-day', function () {
    var date = $(this).attr('data-date');

    $.get('calendar.php?calendar/create', {'date': date}, function (data) {
      $('#modal').modal('show')
        .find('#modalContent')
        .html(data);
    });
  });

  //get the click of the create button
  $('#modalButton').click(function () {
    $('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));

  });

});
