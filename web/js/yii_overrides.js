/**
 * Override the default yii confirm dialog. This function is
 * called by yii when a confirmation is requested.
 *
 * @param message the message to display
 * @param okCallback triggered when confirmation is true
 * @param cancelCallback callback triggered when cancelled
 */
yii.confirm = function (message, okCallback, cancelCallback) {
    swal({
        title: message,
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: true,
        allowOutsideClick: true,
        buttons: true,
        dangerMode: true,
    },function() {
        $.ajax({
            url: "student/admin-delete-student",
            method: "POST",
            data: {
                id: '613020037'
            },
            success: function() {
                swal("Deleted!", "The selected items have been deleted.", "success");
            }
        });
    });

};