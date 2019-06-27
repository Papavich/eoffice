$(document).ready(function () {
    $("#matsysbillmaster-company_id").select2();
    $("#search_mat").select2({
        id: function(bond){ return bond.material_name; },
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
        markup = "<div>กรุณากรอกรหัสสินค้าและบริการ</div>";
        return markup;
    }
    function fotmatError(){
        var markup;
        markup = "<div><span class='select2-notfound pull-left'>ไม่พบวัสดุในคลัง</span><a href='"+home_path+"eoffice_materialsys/material' target='_blank' class='btn btn-success btn-sm pull-right'>สร้างวัสดุ</a></div>";
        return markup;
    }

    function formatRepo (repo) {
        if (repo.loading) {
            return repo.text;
        }
        var markup;
        markup = "<div class='select2-result-repository__title'>" + repo.material_name + "<span class=\"pull-right\"> "+repo.id+"</span></div>";

        return markup;
    }
    function formatRepoSelection (repo) {
        return repo.material_name;
    }


});