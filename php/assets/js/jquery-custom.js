$(document).ready(function () {
		jQuery.validator.addMethod('selectcheck', function (value) {
		    return (value != '-Select-');
		}, "please select");
	
	
       $("input[type=button],input[type=submit], button").button();

       $(".radio").buttonset();

       // removed this becuase is was messing up jquery validation
//        $(".selectmenu").selectmenu();
//       $("#towns, #waterbodies")
//            .selectmenu()
//            .selectmenu("menuWidget")
//                .addClass("overflow"); 
    
    $("#navigation").find("li").hover(
        function() {
            $(this).stop(true,true).animate({backgroundColor: "#058"},150);
            $(this).children("a").stop(true,true).animate({color: "#FFF"}, 150); 
        },function() {
            $(this).stop(true,true).animate({backgroundColor: "#FFF"},150);
            $(this).children("a").stop(true,true).animate({color: "#000"}, 150); 
        }
    );
                
    $("#header-title").hover(
        function() {
            //$(this).parent("li").stop(true,true).animate({backgroundColor: "#058"},150);
            $(this).stop(true,true).animate({color: "#FFF"}, 150); 
        },function() {
            //$(this).parent("li").stop(true,true).animate({backgroundColor: "#FFF"},150);
            $(this).stop(true,true).animate({color: "#000"}, 150); 
        }         
    );
     
    $(function() {
        $( "#datepicker" ).datepicker();
      });
    
    
     //check all jPList javascript options
    $('#data').jplist({				
       itemsBox: '.list' 
       ,itemPath: '.list-item' 
       ,panelPath: '.jplist-panel'	
    });
    
    // Validation rules for the boat ramp form
    $("#boatRampForm").validate({
       rules: {
            "ramp\[name\]" :
            {   
        	   required:true,
           	},
           "ramp\[longitude\]" : {
        	   required:true,
        	   number:true,
           },
           "ramp\[latitude\]" : {
        	   required:true,
        	   number:true,
           },
           "ramp\[owner\]" : {
        	   required:true,
        	},
            "ramp\[state\]" : {
               selectcheck: true
         	},
            "ramp\[townID\]" : {
                selectcheck: true
          	},
            "ramp\[waterbodyID\]" : {
                selectcheck: true
           	},
       },
       messages : {
            "ramp\[name\]": "Ramp Name is required!",
            "ramp\[state\]": "Please select a state!",
            "ramp\[townID\]" : "Please select a town!",
            "ramp\[waterbodyID\]": "Please select a body of water!"
        }
    });
    
    // Validation rules for the boat ramp form
    $("#surveySummaryForm").validate({
       rules: {
            "summary\[lakeHostName\]" :
            {   
        	   required:true,
           	},
           "summary\[summaryDate\]" : {
        	   required:true,
        	   
           },
           "summary\[localGroup\]" : {
        	   required:true,
        	   selectcheck: true
           },
           "summary\[town\]" : {
        	   required:true,
        	   selectcheck: true
           },  
           
           "summary\[totalInspections\]" : {
        	   required:true,
        	   
           },  
           
           "summary\[boatRampName\]" : {
        	   required:true,
        	   selectcheck: true 
           },  
       },
       messages : {
    	   "summary\[summaryDate\]": "Please enter the Date in this format: YYYY-M-D",
            
        }
    });
    
    
    
    
    // Validation rules for the water body form
    $("#waterbody-form").validate({
       rules: {
           "waterbody\[name\]" : "required"
       },
       messages : {
            "waterbody\[name\]": "Waterbody name is required!"
        }
    });
  
 
});
