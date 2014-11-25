$(function(){
   $("input[type=button],input[type=submit], button").button();
   
   $(".radio").buttonset();
   
   $(".selectmenu").selectmenu();
   
   $("#towns")
        .selectmenu()
        .selectmenu( "menuWidget" )
            .addClass("overflow");
});