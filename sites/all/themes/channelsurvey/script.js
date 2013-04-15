/**
 * Autocomplete function over ride
 * Positions the suggestions popup and starts a search
 */
Drupal.jsAC.prototype.populatePopup = function () {
  // Show popup
  if (this.popup) {
    $(this.popup).remove();
  }
  this.selected = false;
  this.popup = document.createElement('div');
  this.popup.id = 'autocomplete';
  this.popup.owner = this;
  $(this.popup).css({
    marginTop: this.input.offsetHeight +'px',
    width: (this.input.offsetWidth - 4) +'px',
    display: 'none'
  });
  $(this.input).before(this.popup);

  // Do search
  this.db.owner = this;
  
  // Custom condition to check for 3 characters prior to Popup autocomplete
  if ($(".view input").val().length >= 3) {
 //     console.log("mark this");
     this.db.search(this.input.value);
  }
};

// Auto Complete and Colorbox function on DOM ready
$(function(){
    // Assign variables
    var searchContainer = $(".view-channel-search-field");
    var fieldData = $(".view input");
    var tableData = $(".view-content");
    var s = $("button#edit-submit");
    var h = $("#webform-component-other_channel_request_not_mentioned_above");
  
    // Hide and move search field
   $(searchContainer).hide().appendTo(".searchHere").show();
   $(h).hide();
   
    var h = $("#webform-component-other_channel_request_not_mentioned_above");
    var save = ($(h).find("input"));	
    var option = [];

    $.fn.initSubmit = function(){
	   if ($(this).val().length >= 3) {
	       $("button#edit-submit-channel-search-field").submit();
	       console.log("submit now!");
	   } else if (!$.trim(this.value).length){
//	       $(".searchHere").removeClass("initCboxContent");
	       console.log("sorry!");
	       $(s).attr("disabled", "disabled");
	   } else {
	       console.log("not enough characters");
	       $(s).attr("disabled", "disabled");
	   }
      	    return false;
    }
    // Submit the form and initialize colorbox function. 
    $(fieldData).change(function() {
	$(this).initSubmit();
	// Colorbox init with timeout delay
	setTimeout(function() {
	    // Open colorbox only if condition == false
	    if ($(".view-empty").length) {
		return false;
//		console.log("true");
	    } else {
		$(".searchHere").addClass("initCboxContent");
		$(this).cboxInit();
//		console.log("false");
	       }
	}, 1000);
    });
    
    // Populate option array from all pull down menus
    $("#webform-component-general_interest option,#webform-component-sports option,#webform-component-international option,#webform-component-spanish option,#webform-component-hd_channels option").each(
	    function() {
		option.push($.trim($(this).text()).toLowerCase());
    });
    $(fieldData).change(function() {
	    // Check if value/array exists logic
	    if( $.inArray((this.value.toLowerCase()), option) > 0) {
	    	$(save).val("");
	    }  else if ($("#autocomplete ul li div").hasClass(".reference-autocomplete")) {
		$(save).val("");
	    }  else {
	    	var newVal = (this.value);
	    	$(save).val(newVal);
	    }
    });
   // Disable Return key
   $.fn.lockKey = function(e){var code = null;code = (e.keyCode ? e.keyCode : e.which);return (code == 13) ? false : true;}	 
    
    // Colorbox function cboxInit
    $.fn.cboxInit = function(){
	$.colorbox({width: 800,height: 475,top: "2%",initialWidth: "400px",opacity: 0,fixed: false,speed: 250,scrolling: false,inline: true,
	    // Open results container
	    href: ".initCboxContent .view-content",
	    onOpen: function(){
		$("#cboxContent").addClass("resultsData");
	    },
	    onComplete: function() {
		$(tableData).fadeIn();
		$("ul.results:last-child").addClass("last-child");
		$(s).removeAttr("disabled");    
		$("#edit-title").removeClass("throbbing");
	    },
	    onCleanup: function() {
	    },
	    onClosed: function() {
		$(".initCboxContent .view-content").remove();
		$(".searchHere").removeClass("initCboxContent");
	    }
	});
    }
	    
    // Disable submition by return/enter key
    $(fieldData).keypress(function(e) {
	$(this).lockKey(e);
    });
});

$(document).ajaxStart(function(e, xhr, settings){
    $("body").addClass("wait");
    console.log("ajax start");
});


$(document).ajaxComplete(function(e, xhr, settings) {
	    var fieldData = $(".view input");
	    var tableData = $(".view-content");
	    var s = $(".views-submit-button button");
	    var h = $("#webform-component-other_channel_request_not_mentioned_above");
	    var search = ($(fieldData).val());
	   
	    var save = ($(h).find("input"));	
	    var option = [];
	    
	    // Submit the form and initialize colorbox function. 
	    $(fieldData).change(function() {
		$(this).initSubmit();
		// Colorbox init with timeout delay
		setTimeout(function() {
		    // Open colorbox only if condition == false
		    if ($(".view-empty").length) {
			return false;
//			console.log("true");
		    } else {
			$(".searchHere").addClass("initCboxContent");
			$(this).cboxInit();
//			console.log("false");
		       }
		}, 1000);
	    });

	    // Populate option array from all pull down menus
	    $("#webform-component-general_interest option,#webform-component-sports option,#webform-component-international option,#webform-component-spanish option,#webform-component-hd_channels option").each(
		    function() {
			option.push($.trim($(this).text()).toLowerCase());
	    });
	    $(fieldData).change(function() {
		// Check if value/array exists logic
		if( $.inArray((this.value.toLowerCase()), option) > 0) {
	    		$(save).val("");
		}  else if ($("#autocomplete ul li div").hasClass(".reference-autocomplete")) {
		    $(save).val("");
		}  else {
    	    		var newVal = (this.value);
    	    		$(save).val(newVal);
		}
	    });
	    
	    // Submit view form on mouse click selection
	    $(".reference-autocomplete").live("click", function(){
		       $("button#edit-submit-channel-search-field").submit();
		       console.log("submit now!");

			setTimeout(function() {
			    // Open colorbox only if condition == false
			    if ($(".view-empty").length) {
				return false;
//				console.log("true");
			    } else {
				$(".searchHere").addClass("initCboxContent");
				$(this).cboxInit();
//				console.log("false");
			       }
			}, 1000);
	    });

	    
	    // 2nd cbox for zip search
	    $(".searchZip").colorbox({
		iframe:true,
		width: "996px",
		height: "1058px",
		innerWidth: "976px",
		initialWidth: "300px",
		initialHeight: "300px",		
		close: "Close",
		onOpen: function(){
		}
       });
});

$(document).ajaxStop(function(e, xhr, settings){
    $("body").removeClass("wait");
//    console.log("ajax end");

    
});	