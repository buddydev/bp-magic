 jQuery(document).ready(function() {
      // jquery for content slider
         jQuery("#slideMover").contentSlider({
                timeOut: 6000,         
                speed: 400, 
                registerButtons: true,
                autoStart: true	
            });
     
    //jquery for image slider
        jQuery(".slidyContainer").slidy({
            autoStart:true,
            speed:400
        });
 });