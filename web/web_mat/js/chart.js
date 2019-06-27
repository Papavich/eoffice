loadScript(plugin_path + 'chart.chartjs/Chart.min.js', function() {

    var lineChartCanvas = {
        labels : ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"],
        datasets : [
/*            {
                label: "My First dataset",
                fillColor : "rgba(220,220,220,0.2)",
                strokeColor : "rgba(220,220,220,1)",
                pointColor : "rgba(220,220,220,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#fff",
                pointHighlightStroke : "rgba(220,220,220,1)",
                data : [65,59,90,81,56,55,40]
            },*/
            {
                label: "My Second dataset",
                fillColor : "rgba(151,187,205,0.2)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "#ffffff",
                pointHighlightStroke : "rgba(151,187,205,1)",
                data : [23000,11895,23656,35620,12450,21546,32462,34527,33231,42152,32152,23564],
            }
        ]
    };

    var barChartCanvas = {
        labels : ["กระดาษ A4","น้ำดื่ม","ปากกาไวท์บอร์ด","ลูกแม็ก","เทปกาวสองหน้า","กาแฟ","โอวัลติน","น้ำยาล้างจาน","ถ่านอัลคาไลน์","ยา"],
        datasets : [
            {
                fillColor : "rgba(220,220,220,0.5)",
                strokeColor : "rgba(220,220,220,0.8)",
                highlightFill: "rgba(220,220,220,0.75)",
                highlightStroke: "rgba(220,220,220,1)",
                data : [6210,4521,2130,1545,921,524,354,241,124,96],
            }
        ]
    };

    var radarChartCanvas = {
        labels : ["A","B","C","D","E","F","G"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [65,59,90,81,56,55,40]
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [28,48,40,19,96,27,100]
            }
        ]
    };

    var pieChartCanvas = [
        {
            value: 30,
            color:"#F38630"
        },
        {
            value : 50,
            color : "#E0E4CC"
        },
        {
            value : 100,
            color : "#69D2E7"
        },
        {
            value : 45,
            color : "#1E73BE"
        }
    ];

    var polarAreaChartCanvas = [
        {
            value : 62,
            color: "#D97041"
        },
        {
            value : 70,
            color: "#C7604C"
        },
        {
            value : 41,
            color: "#21323D"
        },
        {
            value : 24,
            color: "#9D9B7F"
        },
        {
            value : 55,
            color: "#7D4F6D"
        },
        {
            value : 18,
            color: "#584A5E"
        }
    ];

    var doughnutChartCanvas = [
        {
            value: 30,
            color:"#F7464A"
        },
        {
            value : 50,
            color : "#46BFBD"
        },
        {
            value : 100,
            color : "#FDB45C"
        },
        {
            value : 40,
            color : "#949FB1"
        },
        {
            value : 120,
            color : "#4D5360"
        }
    ];


    // lineChartCanvas
    var ctx = document.getElementById("lineChartCanvas").getContext("2d");
    new Chart(ctx).Line(lineChartCanvas);

    // barChartCanvas
    var ctx = document.getElementById("barChartCanvas").getContext("2d");
    new Chart(ctx).Bar(barChartCanvas);

    // radarChartCanvas
    var ctx = document.getElementById("radarChartCanvas").getContext("2d");
    new Chart(ctx).Radar(radarChartCanvas);

    // polarAreaChartCanvas
    var ctx = document.getElementById("polarAreaChartCanvas").getContext("2d");
    new Chart(ctx).PolarArea(polarAreaChartCanvas);

    // pieChartCanvas
    var ctx = document.getElementById("pieChartCanvas").getContext("2d");
    new Chart(ctx).Pie(pieChartCanvas);

    // doughnutChartCanvas
    var ctx = document.getElementById("doughnutChartCanvas").getContext("2d");
    new Chart(ctx).Doughnut(doughnutChartCanvas);

});