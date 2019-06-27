$(document).ready(function () {
    $("a[data-toggle='dropdown']").click(function(){
        $(this).parent().children(".dropdown-menu").slideToggle()
    });
});