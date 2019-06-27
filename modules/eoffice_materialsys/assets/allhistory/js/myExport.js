$(document).ready(function () {
    $("button[name='export']").click(function () {
        $("#exportExcel caption").remove();
        // TableExport.prototype.bootstrap = ["btn", "btn-default btn-sm pull-right", "btn-toolbar"];
        // $("#exportExcel").tableExport({
        //     formats: ["xlsx"],
        //     separator: "\t",
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

    $("#table-report tbody").css('display','none');
});