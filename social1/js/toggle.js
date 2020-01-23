  /*------Make the 3 lines at the top right corner change content on click----- */
  $(function() {
    $(".toggle").on("click", function(){
           if($(".item").hasClass("active")){
                $(".item").removeClass("active")                
           } else {
            $(".item").addClass("active")
           }
       })
  });