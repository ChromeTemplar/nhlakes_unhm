$(function(){
   $("input[type=button],input[type=submit], button").button();
   
   $(".radio").buttonset();
   
   $(".selectmenu").selectmenu();
   
   $("#towns")
        .selectmenu()
        .selectmenu( "menuWidget" )
            .addClass("overflow");
    
    $("#navigation").find("a").hover(
        function() {
            //$(this).parent("li").stop(true,true).animate({backgroundColor: "#058"},100);
            $(this).stop(true,true).animate({color: "#058"}, 100); 
        },function() {
            //$(this).parent("li").stop(true,true).animate({backgroundColor: "#FFF"},100);
            $(this).stop(true,true).animate({color: "#000"}, 100); 
        }
    );
                
    $("#header-title").hover(
        function() {
            //$(this).parent("li").stop(true,true).animate({backgroundColor: "#058"},100);
            $(this).stop(true,true).animate({color: "#FFF"}, 100); 
        },function() {
            //$(this).parent("li").stop(true,true).animate({backgroundColor: "#FFF"},100);
            $(this).stop(true,true).animate({color: "#000"}, 100); 
        }         
    );
    
    
});