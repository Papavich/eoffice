var status_id = window.location.href; //get current url
// activeTab(status_id);
if (window.location.hash) { //URL have #
  activeTab(status_id);
}

$(".tabmenu a").click(function () {
  status_id = $(this).attr('href');
  window.location.hash = $(this).attr('href');
  activeTab(status_id);
});

function activeTab(staus) {
  //if current url == target url will add class active
  $(".tabmenu a").each(function () {
    var tab;
    var current_page_URL = window.location.href;

    if ($(this).attr("href") !== "#") { //get element tag a href
      staus = $(this).prop("href"); //get properties of tag a href

      if (staus == current_page_URL) {
        tab = $(this).attr("href"); //set value of href in tag a working
        $(this).parent('li').addClass('active');
        $(this).attr("aria-expanded", "true");
        $(tab).addClass('active');
      } else if (staus != current_page_URL) {
        var tab2 = $(this).attr("href");
        $(this).parent('li').removeClass('active');
        $(this).attr("aria-expanded", "false");
        $(tab2).removeClass('active');
      }
    } else {
      // $("div #jtab1_nobg").addClass('active');
    }
  });
}/**
 * Created by Dell on 19/4/2561.
 */
