$(document).ready(function () {
    $("a[data-target='#deleteModal']").click(function () {
       $("input[id='id']").attr("value",$(this).attr('id'));
    });
});
$("#cehck").addCss()