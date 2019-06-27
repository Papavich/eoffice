$(document).ready(function () {
    //Remove Error Text
    $("input[name='budget']").keyup(function () {
        $(this).removeClass('error');
    });
    //Budget Chart
    $("button[name='submit-budget']").click(function () {
        $("#exportExcel caption").remove();
        var budget = $("input[name='budget']").val();
        if (budget !== '') {
            $("#budget").text(budget);
            var order_month = [];
            //BAR PAGE LEVEL SCRIPTS
            var pie_label = [];
            var pie_value = [];
            //PIE PAGE LEVEL SCRIPTS
            var color = ["#a6c7ea", "#a9dcd3", "#f2f1b0", "#cbac8f", "#89bbe0", "#f9a485", "#ceb3d4", "#f8b2bd", "#6899aa", "#c0c0c0", "#b4b3db", "#88bdab", "#f59597", "#f7f48d"];
            var bars = [];
            var text = "";
            $.ajax({
                url: "renderchartbudget",
                type: "POST",
                data: {
                    budget: budget,
                },
                dataType: "json",
                async: false,
                success: function (data) {
                    $.each(data[0].order, function (index, value) {
                        order_month.push(value);
                    });
                    $.each(data[1].items, function (index, value) {
                        pie_label.push(value.material_name);
                        pie_value.push(value.material_amount_result);
                    });
                    $.each(data[2].major, function (index, value) {
                        var bar = {
                            value: value.price,
                            color: color[index]
                        };
                        text += "<li><span class=\"color-major\" style=\"background-color: " + color[index] + "\"></span>" + value.major + "</li>";
                        bars.push(bar);
                    });
                }
            });
            //LINE PAGE LEVEL SCRIPTS
            var lineChartCanvas = {
                labels: ["ตุลาคม", "พฤศจิกายน", "ธันวาคม", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "สิงหาคม", "กันยายน"],
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
            $("#DivlineChartCanvas").children().remove();
            $("#DivlineChartCanvas").append("<canvas class=\"chartjs fullwidth height-300\" id=\"lineChartCanvas\" width=\"547\" height=\"300\"></canvas>");
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
            $("#DivbarChartCanvas").children().remove();
            $("#DivbarChartCanvas").append("<canvas class=\"chartjs fullwidth height-400\" id=\"barChartCanvas\" width=\"547\" height=\"400\"></canvas>");
            var ctx2 = document.getElementById("barChartCanvas").getContext("2d");
            new Chart(ctx2).Bar(barChartCanvas);

            //PAGE LEVEL SCRIPTS
            var pieChartCanvas = bars;
            $("#DivpieChartCanvas").children().remove();
            $("#DivpieChartCanvas").append("<canvas class=\"chartjs height-400 padding-20\" id=\"pieChartCanvas\" width=\"547\" height=\"400\" style=\"width:100%;\"></canvas>");
            var ctx = document.getElementById("pieChartCanvas").getContext("2d");
            new Chart(ctx).Pie(pieChartCanvas);
            $("#major").children().remove();
            $("#major").append(text);

            //Report
            $.ajax({
                type: "POST",
                url: "rendertablebudget",
                data: {
                    budget:budget
                },
                beforeSend:function () {
                    var animation = "<div class='divload'><img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\"></div>";
                    $("#export-tbody").children().remove();
                    $("#loading").append(animation);
                },
                success:function (data) {
                    $("#loading").children().remove();
                    $("#export-tbody").append(data);
                }
            });
        } else {
            $("input[name='budget']").addClass('error');
        }
    });

    //Remove Error
    $("input[name='dateFirst']").change(function () {
        $(this).removeClass('error');
    });
    $("input[name='dateSecond']").change(function () {
        $(this).removeClass('error');
    });
    //Date Chart
    $("button[name='submit-date']").click(function () {
        $("#exportExcel caption").remove();
        var dateFirst = $("input[name='dateFirst']").val();
        var dateSecond = $("input[name='dateSecond']").val();
        if (dateFirst !== '' && dateSecond !== '') {
            if (dateFirst <= dateSecond) {
                var time_date = "จากวันที่" + dateFirst + " ถึง " + dateSecond;
                $("#budget").text(time_date);
                //LINE PAGE LEVEL SCRIPTS
                var line_month = [];
                var line_price = [];
                //BAR PAGE LEVEL SCRIPTS
                var pie_label = [];
                var pie_value = [];
                //PIE PAGE LEVEL SCRIPTS
                var color = ["#a6c7ea", "#a9dcd3", "#f2f1b0", "#cbac8f", "#89bbe0", "#f9a485", "#ceb3d4", "#f8b2bd", "#6899aa", "#c0c0c0", "#b4b3db", "#88bdab", "#f59597", "#f7f48d"];
                var bars = [];
                var text = "";
                $.ajax({
                    type: "POST",
                    url: "renderchartdate",
                    dataType: "json",
                    async: false,
                    data: {
                        dateFirst: dateFirst,
                        dateSecond: dateSecond
                    },
                    success: function (data) {
                        $.each(data[0].line, function (index, value) {
                            line_month.push(value.month);
                            line_price.push(value.price);
                        });
                        $.each(data[1].bar, function (index, value) {
                            pie_label.push(value.material_name);
                            pie_value.push(value.material_amount_result);
                        });
                        $.each(data[2].pie, function (index, value) {
                            var bar = {
                                value: value.price,
                                color: color[index]
                            };
                            text += "<li><span class=\"color-major\" style=\"background-color: " + color[index] + "\"></span>" + value.major + "</li>";
                            bars.push(bar);
                        });
                    }
                });
                //LINE PAGE LEVEL SCRIPTS
                var lineChartCanvas = {
                    labels: line_month,
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: line_price
                        }
                    ]
                };
                $("#DivlineChartCanvas").children().remove();
                $("#DivlineChartCanvas").append("<canvas class=\"chartjs fullwidth height-300\" id=\"lineChartCanvas\" width=\"547\" height=\"300\"></canvas>");
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
                $("#DivbarChartCanvas").children().remove();
                $("#DivbarChartCanvas").append("<canvas class=\"chartjs fullwidth height-400\" id=\"barChartCanvas\" width=\"547\" height=\"400\"></canvas>");
                var ctx2 = document.getElementById("barChartCanvas").getContext("2d");
                new Chart(ctx2).Bar(barChartCanvas);

                //PAGE LEVEL SCRIPTS
                var pieChartCanvas = bars;
                $("#DivpieChartCanvas").children().remove();
                $("#DivpieChartCanvas").append("<canvas class=\"chartjs height-400 padding-20\" id=\"pieChartCanvas\" width=\"547\" height=\"400\" style=\"width:100%;\"></canvas>");
                var ctx = document.getElementById("pieChartCanvas").getContext("2d");
                new Chart(ctx).Pie(pieChartCanvas);
                $("#major").children().remove();
                $("#major").append(text);

                //Report
                $.ajax({
                    type: "POST",
                    url: "rendertabledate",
                    data: {
                        dateFirst:dateFirst,
                        dateSecond:dateSecond
                    },
                    beforeSend:function () {
                        var animation = "<div class='divload'><img class=\"loading\" src=\""+image_path+"/components/loading/Spinner.gif\" alt=\"loading\"></div>";
                        $("#export-tbody").children().remove();
                        $("#loading").append(animation);
                    },
                    success:function (data) {
                        $("#loading").children().remove();
                        $("#export-tbody").append(data);
                    }
                });
            } else {
                $("#ModalErrorrdate").modal('show');
            }
        } else if (dateFirst === '' && dateSecond === '') {
            $("input[name='dateFirst']").addClass('error');
            $("input[name='dateSecond']").addClass('error');
        } else if (dateFirst === '') {
            $("input[name='dateFirst']").addClass('error');
        } else if (dateSecond === '') {
            $("input[name='dateSecond']").addClass('error');
        }
    });

});