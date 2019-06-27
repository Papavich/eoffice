$(document).ready(function () {
    $("#success-btn").click(function () {
        var bill_masters = [];
        var count = $("#contentxml div[name='block']").length;
        $("#contentxml div[name='block']").each(function () {
            var datetemp = $(this).find("#matsysbillmaster-bill_master_date").val();
            var date = genDate(datetemp);
            var bill_master = {
                bill_master_date: date,
                bill_master_id: $(this).find("#matsysbillmaster-bill_master_id").val(),
                bill_mater_record: $(this).find("#matsysbillmaster-bill_mater_record").val(),
                bill_master_check: $(this).find("#matsysbillmaster-bill_master_check").val(),
                bill_master_id_no: $(this).find("#matsysbillmaster-bill_master_id_no").val(),
                bill_master_pdf: $(this).find(".dz-filename").children().text(),
                company_id: $(this).find("#matsysbillmaster-company_id").val()
            };
            bill_masters.push(bill_master);
        });
    });
});

function genDate(date) {
    var date_temp = date.split("/");
    var year = parseInt(date_temp[2]) - 543;
    return year + "-" + date_temp[1] + "-" + date_temp[0];
}