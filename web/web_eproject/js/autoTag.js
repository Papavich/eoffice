
$('#byAbstract').click(function(){
    $.ajax({
        url: '../tagging/abstract',
        type: 'post',
        data: {
            tool_data:$("#project-tools").select2("val"),
            theory_data:$("#project-theories").select2("val"),
            keyword:$('#project-abstract').val(),
            _csrf : yii.getCsrfToken()
        },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {
        data=data.responseJSON
            // $('#project-projecttypes').val(data.type).trigger('change');
            console.log(data)
            $('#project-tools').val(data.tool).trigger('change');
            $('#project-theories').val(data.theory).trigger('change');
          swal.close()
        }
    });

})
$('#byProposal').click(function(){
    $.ajax({
        url: '../tagging/proposal',
        type: 'post',
        data: {
            tool_data:$("#project-tools").select2("val"),
            theory_data:$("#project-theories").select2("val"),
            _csrf : yii.getCsrfToken()
        },
      beforeSend: function () {
        swalLoading()
      },
      complete: function (data, status) {

        data=data.responseJSON
            // $('#project-projecttypes').val(data.type).trigger('change');
            console.log(data)
            $('#project-tools').val(data.tool).trigger('change');
            $('#project-theories').val(data.theory).trigger('change');
        swal.close()
        }
    });

})