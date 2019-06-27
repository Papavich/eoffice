$(document).ready(function(){

    // Step show event
    $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
        //alert("You are on step "+stepNumber+" now");
        if(stepNumber === 0) {
            $("#prev-btn").addClass('disabled');
            $("#next-btn").removeAttr("disabled").removeClass("disabled");
            $("#success-btn").addClass('disabled').attr("disabled","disabled");
        }else if(stepNumber === 1){
            $("#next-btn").addClass('disabled').attr("disabled","disabledza");
            $("#prev-btn").removeClass("disabled");
            $("#success-btn").removeClass('disabled').removeAttr("disabled","disabled");
        }else if(stepNumber === 2){
            $("#prev-btn").addClass("disabled").attr("disabled","disabled");
        }
    });
    // Smart Wizard
    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'default',
        transitionEffect:'fade',
        showStepURLhash: false,
        toolbarSettings: {toolbarPosition: 'none'},
        anchorSettings:{
            enableAnchorOnDoneStep:false,
        },
    });

    // External Button Events
    $("#confirm").on("click", function() {
        // Reset wizard
        var status = 0;
        var count = $("#contentxml div[name='block']").length;
        $("#contentxml div[name='block']").each(function () {
            var mat_pass = $(this).find("input[name='material_pass']:checkbox:checked").length;
            if(mat_pass !== 1) {
                var bill_masters = [];
                var datetemp = $(this).find("#matsysbillmaster-bill_master_date").val();
                var date = genDate(datetemp);
                var materials = [];
                var bill_master_id = $(this).find("#matsysbillmaster-bill_master_id").val();
                $(this).find("tbody tr").each(function (index, value) {
                    if (index > 0) {
                        var material = {
                            material_id: $(this).find("select[name='state']").val(),
                            bill_master_id: bill_master_id,
                            bill_detail_price_per_unit: $(this).find("span[name='unit_per_price']").text(),
                            bill_detaill_amount: $(this).find("span[name='amount']").text(),
                            bill_detail_use_amount: $(this).find("span[name='amount']").text(),
                            bill_detail_counter: 0
                        };
                        materials.push(material);
                    }
                });
                var bill_master = {
                    bill_master_id: bill_master_id,
                    bill_master_date: date,
                    bill_mater_record: $(this).find("#matsysbillmaster-bill_mater_record").val(),
                    bill_master_check: $(this).find("#matsysbillmaster-bill_master_check").val(),
                    bill_master_id_no: $(this).find("#matsysbillmaster-bill_master_id_no").val(),
                    bill_master_pdf: $(this).find(".dz-filename").children().text(),
                    company_id: $(this).find("#matsysbillmaster-company_id").val(),
                    materials: materials
                };
                bill_masters.push(bill_master);
                $.ajax({
                    type: "POST",
                    url: "confirmmaterial",
                    cache: false,
                    async:false,
                    data: {
                        bill_masters:bill_masters,
                    },
                    success: function (output) {
                        if(output !== 'pass'){
                            status++;
                        }
                    }
                });
            }else{
                var bill_masters2 = [];
                var datetemp2 = $(this).find("#matsysbillmaster-bill_master_date").val();
                var date2 = genDate(datetemp2);
                var materials2 = [];
                var bill_master_id2 = $(this).find("#matsysbillmaster-bill_master_id").val();
                $(this).find("tbody tr").each(function (index, value) {
                    if (index > 0) {
                        var material2 = {
                            material_id: $(this).find("select[name='state']").val(),
                            bill_master_id: bill_master_id,
                            bill_detail_price_per_unit: $(this).find("span[name='unit_per_price']").text(),
                            bill_detaill_amount: $(this).find("span[name='amount']").text(),
                            bill_detail_use_amount: $(this).find("span[name='amount']").text(),
                            bill_detail_counter: 0
                        };
                        materials2.push(material2);
                    }
                });
                var detail_id = $(this).find("select[name='detail']").val();
                var tempdetail_id = "#"+detail_id;
                var order_detail = '';
                var order_detail_name = '';
                var order_detail_name_id = '';
                if (detail_id === 'DF001') {
                    order_detail = $(this).find(tempdetail_id).find("textarea[name='order_detail']").val();
                    order_detail_name = $(this).find(tempdetail_id).find("input[name='order_detail_name']").val();
                    order_detail_name_id = $(this).find(tempdetail_id).find("input[name='order_detail_name_id']").val();
                } else if (detail_id === 'DF002') {
                    order_detail = $(this).find(tempdetail_id).find("textarea[name='order_detail']").val();
                    order_detail_name = $(this).find(tempdetail_id).find("input[name='order_detail_name']").val();
                    order_detail_name_id = $(this).find(tempdetail_id).find("input[name='order_detail_name_id']").val();
                } else if (detail_id === 'DF003') {
                    order_detail = $(this).find(tempdetail_id).find("textarea[name='order_detail']").val();
                    order_detail_name = $(this).find(tempdetail_id).find("input[name='order_detail_name']").val();
                    order_detail_name_id = '';
                } else {
                    order_detail = $(this).find(tempdetail_id).find("textarea[name='order_detail']").val();
                    order_detail_name = '';
                    order_detail_name_id = '';
                }
                var detail_id_c = detail_id.split("DF");
                var bill_master2 = {
                    user_id : $(this).find("select[name='search-user']").val(),
                    detail_id:"D"+detail_id_c[1],
                    order_detail:order_detail,
                    order_detail_name:order_detail_name,
                    order_detail_name_id:order_detail_name_id,
                    bill_master_id: bill_master_id2,
                    bill_master_date: date2,
                    bill_mater_record: $(this).find("#matsysbillmaster-bill_mater_record").val(),
                    bill_master_check: $(this).find("#matsysbillmaster-bill_master_check").val(),
                    bill_master_id_no: $(this).find("#matsysbillmaster-bill_master_id_no").val(),
                    bill_master_pdf: $(this).find(".dz-filename").children().text(),
                    company_id: $(this).find("#matsysbillmaster-company_id").val(),
                    materials: materials2
                };
                bill_masters2.push(bill_master2);
                $.ajax({
                    type: "POST",
                    url: "confirmmaterial_pass",
                    cache: false,
                    async:false,
                    data: {
                        bill_masters:bill_masters2,
                    },
                    success: function (output) {
                        if(output !== 'pass'){
                            status++;
                        }
                    }
                });
            }
        });
        if(status === 0){
            $('#smartwizard').smartWizard("next");
            setTimeout(function () {
                location.reload();
            },1500);
        }
        return true;
    });

    $("#prev-btn").on("click", function() {
        // Navigate previous
        $('#smartwizard').smartWizard("prev");
        return true;
    });

    $("#next-btn").on("click", function() {
        // Navigate next
        $.ajax({
            type: "POST",
            url: "checkfile",
            cache: false,
            success: function (output) {
                if(output){
                    $('#smartwizard').smartWizard("next");
                }else{
                    $('#myDropzonexml').addClass('require-file');
                }
            }
        });
        return true;
    });
});