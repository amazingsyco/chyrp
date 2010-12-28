<?php
    define('JAVASCRIPT', true);
    require_once "../../../includes/common.php";
    error_reporting(0);
    header("Content-Type: application/x-javascript");
?>
<!-- --><script>

$(function(){
    if(!window["console"]){
        window.console = {};
    }
    if(!window.console["log"]){
        window.console.log = function(){};
    }
    
    $(".notice, .warning, .message").
        append("<span class=\"sub\"><?php echo __("(click to hide)", "theme"); ?></span>").
        click(function(){
            $(this).fadeOut("fast");
        })
        .css("cursor", "pointer");

    if ($.browser.safari)
        $("input#search").attr({
            placeholder: "<?php echo __("Search...", "theme"); ?>"
        });

    if ($("#debug").size())
        $("#wrapper").css("padding-bottom", $("#debug").height());

    $("#debug .toggle").click(function(){
        if (Cookie.get("hide_debug") == "true") {
            Cookie.destroy("hide_debug");
            $("#debug h5:first span").remove();
            $("#debug").animate({ height: "33%" });
        } else {
            Cookie.set("hide_debug", "true", 30);
            $("#debug").animate({ height: 15 });
            $("#debug ul li").each(function(){
                $("<span class=\"sub\"> | "+ $(this).html() +"</span>").appendTo("#debug h5:first");
            })
        }
    })

    $("input#slug").live("keyup", function(e){
        if (/^([a-zA-Z0-9\-\._:]*)$/.test($(this).val()))
            $(this).css("background", "")
        else
            $(this).css("background", "#ff2222")
    })

    if (Cookie.get("hide_debug") == "true") {
        $("#debug").height(15);
        $("#debug ul li").each(function(){
            $("<span class=\"sub\"> | "+ $(this).html() +"</span>").appendTo("#debug h5:first");
        })
    }

    (function($){
	    $(function(){
		    var searchButton = $("#searchButton");
		    searchButton.click(function(){
		    	$("#searchbar").css("visibility","visible").animate({opacity: 1.0}, function(){
		    		console.log("Focus! ",
			    		$("#searchTextField").focus()
		    		);
		    	});
		    	return false;
		    });
    
		    $("#searchbar-hide").click(function(){
		    	$("#searchbar").animate({opacity:0.0}, function(){$("#searchbar").css("visibility","hidden"); });
	    	});
	
			String.prototype.rot13 = function(){ //v1.0
				return this.replace(/[a-zA-Z]/g, function(c){
					return String.fromCharCode((c <= "Z" ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
				});
			};
	
			$("#contactLink").attr("href","mailto:" + ("qhofgrcmn@tznvy.pbz".rot13()));
			
			$(".wrap-more").each(function(){
			   var self = $(this);
			   var children = self.find(".sidebar-row");
			   console.log("Children: ",children.length," ",children);
			   
			   var moreElement = $("<a href='#'></a>");			   
			   var moreFunction = function(){
			       moreElement.text("Less");
    		       for(var idx=10; idx < children.length; idx++){
    		           $(children[idx]).css("display","block");
    			   }    			   
			   }
			   var lessFunction = function(){
			       moreElement.text("More");
			       for(var idx=10; idx < children.length; idx++){
    		           $(children[idx]).css("display","none");
    			   }
			   }
			   
			   moreElement.click(function(){
                   if(moreElement.text() == "More"){
                       moreFunction();
                   }else{
                       lessFunction();
                   }
                   return false;
			   });
			   
			   self.append(moreElement);
			   lessFunction();
			});

			$(function () {
				$('.bubbleInfo').each(function () {
					var distance = 10;
					var time = 250;
					var hideDelay = 500;
	
					var hideDelayTimer = null;
	
					var beingShown = false;
					var shown = false;
					var trigger = $('.trigger', this);
					var info = $('.popup', this).css('opacity', 0);
					
					$([trigger.get(0), info.get(0)]).mouseover(function () {
						if (hideDelayTimer) clearTimeout(hideDelayTimer);
						if (beingShown || shown) {
							// don't trigger the animation again
							return;
						} else {
							// reset position of info box
							beingShown = true;
			
							var offset = trigger.offset();
							var size = {width: trigger[0].offsetWidth, height: trigger[0].offsetHeight};
							console.log("Offset: ",trigger,size);
							info.css({
								top: offset.top,
								left: offset.left - (size.width * 3),
								display: 'block'
							}).animate({
								top: '+=' + distance + 'px',
								opacity: 1
							}, time, 'swing', function() {
								beingShown = false;
								shown = true;
							});
						}
	
						return false;
					}).mouseout(function () {
						if (hideDelayTimer) clearTimeout(hideDelayTimer);
						hideDelayTimer = setTimeout(function () {
							hideDelayTimer = null;
							info.animate({
								top: '+=' + distance + 'px',
								opacity: 0
							}, time, 'swing', function () {
								shown = false;
								info.css('display', 'none');
							});
			
						}, hideDelay);
			
						return false;
					});
				});
			});

	    });
    })(jQuery);
})
<!-- --></script>