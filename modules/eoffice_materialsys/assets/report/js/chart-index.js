$(document).ready(function () {
    //LINE PAGE LEVEL SCRIPTS
    var order_month = [];
    //BAR PAGE LEVEL SCRIPTS
    var pie_label =[];
    var pie_value =[];
    //PIE PAGE LEVEL SCRIPTS
    var color = ["#a6c7ea","#a9dcd3","#f2f1b0","#cbac8f","#89bbe0","#f9a485","#ceb3d4","#f8b2bd","#6899aa","#c0c0c0","#b4b3db","#88bdab","#f59597","#f7f48d"];
    var bars= [];
    var text = "";
    $.ajax({
        url:"renderchart",
        type:"GET",
        dataType: "json",
        async: false,
        success:function (data) {
            $.each(data[0].order, function( index, value ) {
                order_month.push(value);
            });
            $.each(data[1].items,function (index, value) {
                pie_label.push(value.material_name);
                pie_value.push(value.material_amount_result);
            });
            $.each(data[2].major,function (index, value) {
                var bar = {
                    value: value.price,
                    color: color[index]
                }
                text += "<li><span class=\"color-major\" style=\"background-color: "+color[index]+"\"></span>"+value.major+"</li>";
                bars.push(bar);
            });
        }
    });
    //LINE PAGE LEVEL SCRIPTS
    var lineChartCanvas = {
        labels: ["ตุลาคม", "พฤศจิกายน", "ธันวาคม","มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "สิงหาคม", "กันยายน"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: order_month
            }
        ]
    };
    var ctx3 = document.getElementById("lineChartCanvas").getContext("2d");
    new Chart(ctx3).Line(lineChartCanvas);

    //BAR PAGE LEVEL SCRIPTS
    var barChartCanvas = {
        labels: pie_label,
        datasets: [
            {
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data: pie_value
            }
        ]
    };
    var ctx2 = document.getElementById("barChartCanvas").getContext("2d");
    new Chart(ctx2).Bar(barChartCanvas);

    //PAGE LEVEL SCRIPTS
    var pieChartCanvas = bars;
    var ctx = document.getElementById("pieChartCanvas").getContext("2d");
    new Chart(ctx).Pie(pieChartCanvas);
    $("#major").children().remove();
    $("#major").append(text);
    $.ajax({
        url:"rendertable",
        type:"GET",
        beforeSend:function () {
            var animation = "<div class='divload'><img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\"></div>";
            $("#loading").append(animation);
        },
        success:function (data) {
            $("#loading").children().remove();
            $("tbody[name='export-tbody']").append(data);
        }
    })
});