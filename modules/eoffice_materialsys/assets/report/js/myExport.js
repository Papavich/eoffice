$(document).ready(function () {
    $("button[name='export']").click(function () {
        // $("#exportExcel caption").remove();
        // TableExport.prototype.bootstrap = ["btn", "btn-default btn-sm pull-right", "btn-toolbar"];
        // $("#exportExcel").tableExport({
        //     headers: true,                              // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
        //     footers: true,                              // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
        //     formats: ['xls', 'csv', 'txt'],             // (String[]), filetype(s) for the export, (default: ['xls', 'csv', 'txt'])
        //     filename: 'id',                             // (id, String), filename for the downloaded file, (default: 'id')
        //     bootstrap: false,                           // (Boolean), style buttons using bootstrap, (default: true)
        //     exportButtons: true,                        // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
        //     position: 'bottom',                         // (top, bottom), position of the caption element relative to table, (default: 'bottom')
        //     ignoreRows: null,                           // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
        //     ignoreCols: null,                           // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
        //     trimWhitespace: true
        // });
        $("#exportExcel").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: "สรุปงบประมาณประจำปี",
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
        });
    });
});