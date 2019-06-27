$(document).ready(function () {
    $("#search_user").select2({
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
        templateResult: formatRepo,
        templateSelection: formatRepoSelection,
        language: {
            inputTooShort: tooShort,
            errorLoading:fotmatError,
        }
    });
    function tooShort() {
        var markup;
        markup = "<div>กรุณากรอกชื่อหรือรหัสผู้ใช้</div>";
        return markup;
    }
    function fotmatError(){
        var markup;
        markup = "<div><span class='select2-notfound pull-left'>ไม่พบวื่อหรือรหัสผู้ใช้</span></div>";
        return markup;
    }

    function formatRepo (repo) {
        if (repo.loading) {
            return repo.text;
        }
        var markup;
        markup = "<div class='select2-result-repository__title'>" + repo.user_name + "<span class=\"pull-right\"> "+repo.id+"</span></div>";

        return markup;
    }
    function formatRepoSelection (repo) {
        return repo.user_name;
    }
});