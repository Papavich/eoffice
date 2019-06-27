$(document).ready(function () {
    //Remove Error
    $("input[name='dateFirst']").change(function () {
        $(this).removeClass('error');
    });
    $("input[name='dateSecond']").change(function () {
        $(this).removeClass('error');
    });
    $("input[name='budget']").keyup(function () {
        $(this).removeClass('error');
    });

    //Budget Search
    $("button[name='submit-budget']").click(function () {
        $("#exportExcel caption").remove();
        var budget = $("input[name='budget']").val();
        if (budget !== '') {

        } else {
            $("input[name='budget']").addClass('error');
        }
    });
    //Date Chart
    $("button[name='submit-date']").click(function () {
        $("#exportExcel caption").remove();
        var dateFirst = $("input[name='dateFirst']").val();
        var dateSecond = $("input[name='dateSecond']").val();
        if (dateFirst !== '' && dateSecond !== '') {
            if (dateFirst <= dateSecond) {

            } else {
                $("#ModalErrorrdate").modal('show');
            }
        } else if (dateFirst === '' && dateSecond === '') {
            $("input[name='dateFirst']").addClass('error');
            $("input[name='dateSecond']").addClass('error');
        } else if (dateFirst === '') {
            $("input[name='dateFirst']").addClass('error');
        } else if (dateSecond === '') {
            $("input[name='dateSecond']").addClass('error');
        }
    });
});