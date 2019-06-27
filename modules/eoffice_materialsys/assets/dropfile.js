//Insert Material XML
var res;
var res_value;
var res_search;
$(document).ready(function () {
    //show detail

    // Submit Material
    $("button[name='confirm']").on('click', function () {

    });
    // Render XMl file
    $("#next-btn").on('click', function () {
        $('#contentxml').children().remove();
        $.ajax({
            type: "POST",
            url: "renderxml",
            cache: false,
            async: false,
            beforeSend: function () {
                var animation = "<img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\">";
                $('#contentxml').prepend(animation);
            },
            success: function (output) {
                $('#contentxml').children().remove();
                $("#contentxml").prepend(output);
                var dropfile_id = $('#id_dropfile').text();
                var search_id = $('#id_searchmat').text();
                res = dropfile_id.split("/");
                res_search = search_id.split("/");
                //Config Select2
                $.each(res_search, function (key2, value2) {
                    res_value = value2.split("+");
                    $.each(res_value, function (key3, value3) {
                        if(value3 !== ''){
                            var id_search = "#search_mat"+value3;
                            // alert(id_search);

                            $("select[name='search-user']").select2({
                                id: function(bond){ return bond.user_name; },
                                ajax: {
                                    method: "GET",
                                    url: "searchuserjax",
                                    dataType: 'json',
                                    delay: 250,
                                    data: function (params) {
                                        return {
                                            value: params.term
                                        };
                                    },
                                    processResults: function (data, params) {
                                        var array = data.resultajax; //depends on your JSON
                                        return { results: array };
                                    },
                                    cache: true
                                },
                                placeholder: 'Search for a repository',
                                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                                minimumInputLength: 1,
                                templateResult: formatRepo2,
                                templateSelection: formatRepoSelection2,
                                language: {
                                    inputTooShort: tooShort2,
                                    errorLoading:fotmatError2,
                                }
                            });
                            $(id_search).select2({
                                id: function (bond) {
                                    return bond.material_name;
                                },
                                ajax: {
                                    method: "GET",
                                    url: "searchmaterialajax",
                                    dataType: 'json',
                                    delay: 250,
                                    data: function (params) {
                                        return {
                                            value: params.term
                                        };
                                    },
                                    processResults: function (data, params) {
                                        var array = data.resultajax; //depends on your JSON
                                        return {results: array};
                                    },
                                    cache: true
                                },
                                placeholder: 'Search for a repository',
                                escapeMarkup: function (markup) {
                                    return markup;
                                }, // let our custom formatter work
                                minimumInputLength: 1,
                                templateResult: formatRepo,
                                templateSelection: formatRepoSelection,
                                language: {
                                    inputTooShort: tooShort,
                                    errorLoading: fotmatError,
                                }
                            });

                            $(id_search).on('select2:select',function () {
                                $(id_search).parent().children('.select2').removeClass('error-notfound');
                            });

                            function tooShort() {
                                var markup;
                                markup = "<div>กรุณากรอกข้อมูล</div>";
                                return markup;
                            }

                            function fotmatError() {
                                var markup;
                                markup = "<div><span class='select2-notfound pull-left'>ไม่พบวัสดุในคลัง</span><a href='"+home_path+"eoffice_materialsys/material' target='_blank' class='btn btn-success btn-sm pull-right'>สร้างวัสดุ</a></div>";
                                return markup;
                            }

                            function formatRepo(repo) {
                                if (repo.loading) {
                                    return repo.text;
                                }
                                var markup;
                                markup = "<div class='select2-result-repository__title'>" + repo.material_name + "<span class=\"pull-right\"> " + repo.id + "</span></div>";

                                return markup;
                            }

                            function formatRepoSelection(repo) {
                                return repo.material_name;
                            }

                            //User
                            function tooShort2() {
                                var markup;
                                markup = "<div>กรุณากรอกชื่อหรือรหัสผู้ใช้</div>";
                                return markup;
                            }
                            function fotmatError2(){
                                var markup;
                                markup = "<div><span class='select2-notfound pull-left'>ไม่พบวื่อหรือรหัสผู้ใช้</span></div>";
                                return markup;
                            }
                            function formatRepo2 (repo) {
                                if (repo.loading) {
                                    return repo.text;
                                }
                                var markup;
                                markup = "<div class='select2-result-repository__title'>" + repo.user_name + "<span class=\"pull-right\"> "+repo.id+"</span></div>";

                                return markup;
                            }
                            function formatRepoSelection2 (repo) {
                                return repo.user_name;
                            }
                        }
                    });
                });
                //Config Dropzone
                $.each(res, function (key, value) {
                    myAwesomeDropzone = new Dropzone("#myDropzonepdf" + value,{
                        maxFiles: 1,
                        maxFilesize: 10, // MB
                        init: function () {
                            this.on("maxfilesexceeded", function (file) {
                                $("#filenamesize").text(file.name);
                                $('#ErrorModalmaxFile').modal('show');
                                this.removeFile(file);
                            });
                            this.on("addedfile", function (file) {
                                var _this = this;
                                if (file.name) {
                                    var extension = openFilepdf(file.name);
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
                                    } else {
                                        $("#myDropzonepdf" + value).removeClass('require-file');
                                        $("#myDropzone").removeClass('error-notfound');
                                        $("#dropfile-help").addClass('hidden-text');

                                        var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-default fullwidth margin-top-10'>Remove file</button>");

                                        // Listen to the click event
                                        removeButton.addEventListener("click", function (e) {
                                            // Make sure the button click doesn't submit the form:
                                            e.preventDefault();
                                            e.stopPropagation();

                                            // Remove the file preview.
                                            _this.removeFile(file);
                                            // If you want to the delete the file on the server as well,
                                            // you can do the AJAX request here.

                                        });
                                        // Add the button to the file preview element.
                                        file.previewElement.appendChild(removeButton);
                                    }

                                }
                            });
                        }
                    });
                });
            }
        });
    });
    //Check Valid
    $("#success-btn").on('click',function () {
        var checkfile = 0;
        var checkSelect2 = 0;
        var checkuser = 0;
        var check_detail = 0;
        //Check PDf File
        $.each(res, function (key, value) {
            if(value !== ''){
                var elm_name = $("#myDropzonepdf" + value).children('.dz-preview').children('.dz-details').children('.dz-filename').children().text();
                if(elm_name === ''){
                    checkfile++;
                    $("#myDropzonepdf" + value).addClass('require-file');
                }
            }
        });
        //Check SELECT2
        $.each(res_search, function (key2, value2) {
            res_value = value2.split("+");
            $.each(res_value, function (key3, value3) {
                if(value3 !== '') {
                    var id_search = "#search_mat" + value3;
                    if($(id_search).val() === null){
                        checkSelect2++;
                        $(id_search).parent().children('.select2').addClass('error-notfound');
                    }
                }
            });
        });
        $("#contentxml").find("div[name='block']").each(function () {
            var mat_pass = $(this).find("input[name='material_pass']:checkbox:checked").length;
            if(mat_pass === 1){
                var val_user = $(this).find("select[name='search-user']").val();
                if(val_user === null){
                    checkuser++;
                    $(this).find("select[name='search-user']").parent().children('.select2').addClass('error-notfound');
                }
                var detail_id = "#"+$(this).find("select[name='detail']").val();
                //Check Input
                $(this).find(detail_id).find("input").each(function () {
                    if($(this).val() === ''){
                        check_detail++;
                        $(this).addClass('error-notfound');
                    }
                });
                //Check Textarea
                $(this).find(detail_id).find("textarea").each(function () {
                    if($(this).val() === ''){
                        check_detail++;
                        $(this).addClass('error-notfound');
                    }
                });
            }
        });

        if(checkfile === 0 && checkSelect2 === 0 && checkuser === 0 && check_detail === 0){
            $('#Modalconfirm').modal('show');
        }
    });

});

//Show Content xml
$(document).delegate(".head-box", "click", function () {
    $(this).parent().children(".panel-body").slideToggle(200);
});

// Check Extension
function openFile(file) {
    var extension = file.substr((file.lastIndexOf('.') + 1));
    if (extension === 'xml' || extension === 'XML') {
        return 'pass';
    } else {
        return 'fail';
    }
}

// Config Dropzone
Dropzone.options.myDropzonexml = {
    maxFilesize: 10, // MB
    init: function () {
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
                } else {
                    $('#myDropzonexml').removeClass('require-file');
                    var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-default fullwidth margin-top-10'>Remove file</button>");
                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
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
                            url: "deletexml",
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
    }
};

// Check Extension
function openFilepdf(file) {
    var extension = file.substr((file.lastIndexOf('.') + 1));
    if (extension === 'pdf' || extension === 'PDF') {
        return 'pass';
    } else {
        return 'fail';
    }
};


function genDate(date) {
    var date_temp = date.split("/");
    var year = parseInt(date_temp[2]) - 543;
    return year + "-" + date_temp[1] + "-" + date_temp[0];
}
$(document).delegate("select[name='detail']","change",function () {
    $(this).parent().parent().find("div[name='boxdetail']").hide('slow');
    var id_box = "#"+$(this).val();
    $(this).parent().parent().find(id_box).toggle();
});

$(document).delegate("input[name='material_pass']","click",function () {
    $(this).parent().parent().parent().parent().parent().parent().find("div[name='material_pass']").slideToggle();
});

$(document).delegate("select[name='search-user']","change",function () {
   $(this).parent().children('.select2').removeClass('error-notfound');
});

$(document).delegate("div[name='boxdetail'] input","change",function () {
    $(this).removeClass('error-notfound');
});
$(document).delegate("div[name='boxdetail'] textarea","change",function () {
    $(this).removeClass('error-notfound');
});
