var canhide=0;
var timer;
var timer_status=0;
var canshow=1;

function set_menu_js(){
   $(".menuUser").mouseover(function(){
        $(this).addClass("menuUser_over")
         $(this).removeClass("menuUser")
   });
    $(".menuUser").mouseout(function(){
        $(this).addClass("menuUser")
         $(this).removeClass("menuUser_over")
   });
   $(".ObjElem").each(function(){
       
       $(this).addClass("MenuElem");  
        $(this).children("table").each(function(){
            $(this).addClass("MenuElem"); 
        });
       
       $(this).mouseover(function(){
           $(this).removeClass("MenuElem");
           $(this).addClass("MenuElem_over");
           $(this).children("table").each(function(){
                $(this).removeClass("MenuElem");
                $(this).addClass("MenuElem_over"); 
           });
           
       });
       
       $(this).mouseout (function(){
           $(this).removeClass("MenuElem_over");
           $(this).addClass("MenuElem");  
           $(this).children("table").each(function(){
                $(this).removeClass("MenuElem_over");
                $(this).addClass("MenuElem"); 
           });
           
       });
       
   });
  
}


function hide_enable_menu(){
    canhide=1;   
    timer=clearInterval(timer);
    
}

function show_menu(){
    if(canshow){
        canshow=0;
        $(".menuButton").bind('mouseover',false);
        timer=clearInterval(timer);
        canhide=0;
        timer_status=0;
        $(".menu").show();
        $(".menuButton").css("left","163px"); 
    }
}

$(document).ready(function(){
   
   set_menu_js();
   
   $("#main").mousemove(function(){
       if(canhide){
            canhide=0;
             $(".menuButton").animate(
            {
                left: -6
            });
            $(".menu").animate(
            {
                left: -170
            },
            function(){
                $(".menu").css("left","0px");
                $(".menu").hide();
                canshow=1;
            }
            );
      } 
   }); 
    $(".menu").mouseover(function(){
        if(!timer_status){
            timer=setInterval("hide_enable_menu()",500);
            canhide=0;
            timer_status=1;
        }
        
    });
   $(".menuButton").mouseover(function(){
        show_menu()        
   });
});