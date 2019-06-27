// Select Material ID ไปแก้ไขอังกอลิทึบด้วย
$(document).ready(function () {
    $('button[name="btn-select-material"]').click(function () {
        var material_id;
        if ($('#material option:selected').val() == 69 && $('#material2 option:selected').val() == 69) {
            alert("Please Select Material");
        } else {
            if ($('#material option:selected').val() == 69) {
                material_id = $('#material2 option:selected').val();
            } else {
                material_id = $('#material option:selected').val();
            }
            $.ajax({
                type: "POST",
                url: "insertmaterial/creatematerial",
                cache: false,
                data: "name=" + material_id,
                success: function (msg) {
                    $('#ajax_insert').prepend(msg);
                }
            });

        }
    });
});
