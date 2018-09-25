$(document).ready(function()
{
  var height = 0.8*$(document).height();

  $('.loader').fadeOut("slow");
  $('#main').css({height: height});
});

function myFunction()
{
    var x = $("#topnav");

    if(x.attr("class") === "topnav") x.addClass("responsive");
    else x.removeClass("responsive");
}
