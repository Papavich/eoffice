/*globals $:false */
$(document).ready(function() {
    $("#submit_executeb").click(function (e) {
        e.preventDefault();
        var form = $(".execute-budget").serialize();
        var datas = "";
        $.ajax({
            url: "../compact/rulebuget",
            type: 'get',
            async:false,
            data: form,
            success: function (data) {
                datas = data;
                console.log(data);
            }
        });

         if(datas == "true"){
             $(".execute-budget").submit();
             return true;
         }else {
             alert(datas);
             return false;
         }
    });

    $("#submit_executepandb").click(function (e) {
        e.preventDefault();
        var form = $(".execute-pandb").serialize();
        var datas = "";
        $.ajax({
            url: "../compact/rulebuget",
            type: 'get',
            async:false,
            data: form,
            success: function (data) {
                datas = data;
                console.log(data);
            }
        });

        if(datas == "true"){
            $(".execute-pandb").submit();
            return true;
        }else {
            alert(datas);
            return false;
        }

    });
});