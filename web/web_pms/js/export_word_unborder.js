// jQuery(document).ready(function($) {
//     $("a.word-export").click(function() {
//         alert("asdasdad");
//         $("#page-content").wordExport();
//     });
// });
$(document).ready(function() {
    $("a.jquery-word-export").click(function(e) {
        //$('#content').css("font-family", "THSarabunNew");

        $(".table_border").css({"border-collapse": "collapse",
            "width":"100%"});
        $(".padding").css({"padding-left": "180px"});
        $("#page-content").wordExport();
        //$("body").css("font-family", "");
    });
});