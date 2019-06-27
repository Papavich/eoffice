Dropzone.options.myDropzone = {
    maxFiles: 1,
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    init: function () {
        this.on("maxfilesexceeded", function(file) {
            $("#filenamesize").text(file.name);
            $('#ErrorModalmaxFile').modal('show');
            this.removeFile(file);
        });
        this.on("addedfile", function (file) {
            var _this = this;
            if (file.name) {
                var extension = openFile(file.name);
                // Check Extension
                if (extension !== 'pass') {
                    _this.removeFile(file);
                    $("#filename").text(file.name);
                    $('#ErrorModal').modal('show');
                    // Check File Size
                } else if (file.size > 5000000) {
                    _this.removeFile(file);
                    $("#filenamesize").text(file.name);
                    $('#ErrorModalSize').modal('show');
                }else {
                    $("#dropfile-help").addClass('hidden-text');
                    $("#myDropzone").removeClass('error-notfound');
                    $('#myDropzone').removeClass('ef-dz-fa');
                    $("#myDropzone").addClass('ef-dz-suc');

                    var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-default fullwidth margin-top-10'>Remove file</button>");

                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
                        $("#myDropzone").removeClass('ef-dz-suc');
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        _this.removeFile(file);
                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.

                        //Ajax Delete file
                        $.ajax({
                            type: "POST",
                            url: "deleteimage",
                            cache: false,
                            data: "filename=" + file.name,
                            success: function (output) {
                            }
                        });
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                }

            }
        });
    },
};
// Check Extension
function openFile(file) {
    var extension = file.substr((file.lastIndexOf('.') + 1));
    if (extension === 'png' || extension === 'jpg' || extension === 'PNG' || extension === 'JPG') {
        return 'pass';
    } else {
        return 'fail';
    }
};