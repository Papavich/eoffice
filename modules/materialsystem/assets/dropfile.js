$(document).ready(function () {
    $('button[name="show"]').click(
        function () {
            $.ajax({
                type: "POST",
                url: "viewfile",
                cache: false,
                // data: "name=John&location=Boston",
                success: function(msg){
                    $('#datatable_sample').prepend(msg);
                }
            });

        }
    );
    $('button[name="commit"]').click(
        function () {
            $.ajax({
                    type: "POST",
                    url: "destroysession",
                    cache: false,
                    success: function (msg) {
                        // alert(msg);
                    }
                }
            );
        }
    );
});


