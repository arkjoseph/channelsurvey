// DOM Ready? Fire jquery
$(document).ready(function(){
    // Assign variables
    var searchContainer = $(".view-channel-search-no-autocomplete");
    var searchSubmit = $(".view #edit-title");
    var tableData = $(".view-content");
    var error = $(".view-empty");
    var s = $("button#edit-submit");
    var h = $("#webform-component-other_channel_request_not_mentioned_above");
    
    // Hide and move search field
    $(searchContainer).hide().appendTo(".searchHere").show();
    $(h).hide();
    
    // Disable submition by return/enter key
    $(searchSubmit).keypress(function(e) {
    	var code = null;
    	code = (e.keyCode ? e.keyCode : e.which);
    	return (code == 13) ? false : true;
    });    
    
    // Submit form on change/tab
    $(searchSubmit).change(function() {
	if(!$.trim(this.value).length) { // zero-length string AFTER a trim
	    $(s).attr("disabled", "disabled");
	    } else {
    	    $("form .views-exposed-widget button").submit();
	}
    }); 
    

});

(function($) {
    	// we need to add some variables to the ajaxComplete()
    	// callback function. The one we are most concerned with
    	// is the 3rd, 'settings'
    	$(document).ajaxComplete(function(e, xhr, settings)	{
    	    var searchSubmit = $(".view #edit-title");
    	    var tableData = $(".view-content");
    	    var error = $(".view-empty");
    	    var e = ($(searchSubmit).val());
    	    var unknown = $("#edit-submitted-other-channel-request-not-mentioned-above-wrapper input");
    	    var s = $("button#edit-submit");
    	    
    	    // Disable submition by return/enter key
            $(searchSubmit).keypress(function(e) {
            	var code = null;
            	code = (e.keyCode ? e.keyCode : e.which);
            	return (code == 13) ? false : true;
            });    
            
    	    $(searchSubmit).change(function() {
    		if(!$.trim(this.value).length) { // zero-length string AFTER a trim
    		    $(s).attr("disabled", "disabled");
    		    } else {
    	    	    $("form .views-exposed-widget button").submit();
    		}
    	    });
    	    
    	    // If channel is not found, pass to next field for submission. 
    	    if ($(error).length) {
    		$(s).removeAttr("disabled");
    		$(".view-channel-search-no-autocomplete .view-empty small").fadeIn("30000");
    		unknown.val( unknown.val() + e + ',');
    	    } else {
    		
    		// Initialize colorbox
    		$(tableData).addClass("initCbox");    
        	
    		// Open colorbox
                $(".initCbox").each(function(){    		
        		$.colorbox({
        		    width: 800,
        		    height: 420,
        		    top: "2%",
        		    initialWidth: "400px",
        		    initialHeight: "350px",
        		    opacity: 0,
        		    fixed: false,
        	       //   transition: "elastic",
        		    speed: 450,
        		    scrolling: false,
        		    inline: true,
        		    href: ".initCbox",
        		    onOpen: function(){
        			$(tableData).fadeIn();
        			$("#cboxContent").addClass("resultsData");
        			$("ul.results:last-child").addClass("last-child");
        			$(s).css("z-index", "10000");
        		    },
        		    onLoad: function() {
        		    },
        		    onComplete: function() {
        			$(s).removeAttr("disabled");        			
        		    },
        		    onCleanup: function() {
        		    },
    			    onClosed: function() {
    			    }
        		 
        		});
        	    });                		
    	    }
    	    
    	    
            
            $(".view-empty small div").each(function(){
        	$(this).fadeOut(1000);
            });

    	});
}(jQuery));