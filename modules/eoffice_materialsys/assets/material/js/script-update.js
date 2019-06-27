$(document).ready(function () {
    $("#addfile").click(function () {
        var file_data = $('#uploadform-imagefile' +
            '').prop('files')[0];
        var file_name = $('#uploadform-imagefile').val().replace(/C:\\fakepath\\/i, '');
        var div = $("div.i-file").attr('class');
        var search_result = div.search('has-success');
        if(search_result !== -1){
            var form_data = new FormData();
            form_data.append("file", file_data);
            $.ajax({
                url: "upfile",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (data) {
                    if(data === 'true'){
                        var path = home_path+"web_mat/temp/"+file_name;
                        $('#image-product').attr('src',path);
                    }
                }
            });
        }
    });
    $("#cancelfile").click(function () {
        var file_name = $("#temp_image").val();
        var path = home_path+"web_mat/images/"+file_name;
        $('#image-product').attr('src',path);
        $('#uploadform-imagefile').val('');
        $('div.i-file').removeClass('has-success');
        $.ajax({
            url:"cleartemp",
            type:"POST"
        })
    });
});