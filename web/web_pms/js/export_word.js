// jQuery(document).ready(function($) {
//     $("a.word-export").click(function() {
//         alert("asdasdad");
//         $("#page-content").wordExport();
//     });
// });



$(document).ready(function() {


    $("a.jquery-word-export").click(function(e) {
        // $('#content').css("font-family", "TH Sarabun New");
        // $('#content').css("font-size", "10px");
        // e.preventDefault();
        // $("#gg").addClass("ko");
        //$("#gg").removeClass("ko");
        // $(".table_border").addClass("table_css");
        // $(".th_border").addClass("th_css");
        // $(".td_border").addClass("td_css");
        //


        // $(".table_border").removeClass("table_css");
        // $(".th_border").removeClass("th_css");
        // $(".td_border").removeClass("td_css");

        //$('#content').css("font-family", "THSarabunNew");
        $(".table_border").css({"border-collapse": "collapse",
            "width":"100%"});
        $(".th_border").css({"border-color": "black",
            "border-width":"2px",
            "border-style":"solid"});
        $(".td_border").css({"border-color": "black",
            "border-width":"2px",
            "border-style":"solid"});

        $("#page-content").wordExport();
        // $('#content').css("font-family", "");
        // $('#content').css("font-size", "");
        //$("body").css("font-family", "");
        $(".th_border").css({"border-color": "",
            "border-width":"",
            "border-style":""});
        $(".td_border").css({"border-color": "",
            "border-width":"",
            "border-style":""});

    });

});