jQuery(document).ready(function($) {
    
    // Dropdown links for main menu
    $("#linkbar").ptMenu();
    
    // for breadcrumb navigation; adds double arrow symbol to each li except for the last (the page you're on)
    $("#bread_crumbs ul li").not("li:last").append(" &raquo;"); 
    
    // Deletes and replaces input values
    $("input, textarea").not("#submit, .submit, #searchsubmit").each(function() {
	   var default_value = this.value;
	   $(this).focus(function() {
	       if(this.value == default_value) {
	           this.value = '';
	       }
	   });
	   $(this).blur(function() {
	       if(this.value == '') {
	           this.value = default_value;
	       }
	   });
	});
	
	var twitter_account = $("#twitter_account").text();
	
	$("#twitter_content").tweetable({
		username: twitter_account,
		limit: 1,
		time: false
	});
	
	
		
	$(".fancybox").fancybox({
		'overlayOpacity' : .7,
		'overlayColor' : '#000'
	});
	
	// Each section below is for different pages of the template
	
	// Home Page
	
	// Vertical Accordion Effects
	
	lastBlock = $("#current");
    maxHeight = 458;
    minHeight = 50;
    
    $("#announcement li:last").css({
    	"border-bottom" : "0px"
    });

    $("#announcement li .order").click(function() {
        $(lastBlock).animate({
        	height: minHeight+"px"
        }, { queue:false, duration:403 }).attr("id", "");
        
	$(this).parent().animate({
		height: maxHeight+"px"
	}, { queue:false, duration:398}).attr("id", "current");
		
	lastBlock = $(this).parent();
		
	return false;
    });
    
    // Recent Posts Fade
    
    $("#featured_post_slider").innerfade({
		continuous: true,
		auto: true,
		speed: 800,
		timeout: 3000
	});
    
    // Flickr Code
	
	// Adapted from tutorial: http://www.richardshepherd.com/how-to-use-jquery-with-a-json-flickr-feed-to-display-photos/
	
	apiKey = $("#flickr_feed_url").text();
	
	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=" + apiKey + "&lang=en-us&format=json&jsoncallback=?", displayImages);
	
	function displayImages(data) {
	
	    // Start putting together the HTML string
	    var htmlString = "";
	    
	    // Now start cycling through our array of Flickr photo details
	    $.each(data.items, function(i,item) {
	    
	        // I only want the ickle square thumbnails
	        var sourceSquare = (item.media.m).replace("_m.jpg", "_s.jpg");
	        
	        // Here's where we piece together the HTML
	        htmlString += '<li><a href="' + item.link + '" target="_blank">';
	        htmlString += '<img title="' + item.title + '" src="' + sourceSquare;
	        htmlString += '" alt="'; htmlString += item.title + '" />';
	        htmlString += '</a></li>';
	        
	        if(i == 9) return false; // Limits number of items to 10
	    });
	    
	    // Pop our HTML in the #images DIV
	    $('#flickr_area, #widget_flickr_stream').html(htmlString);
	    
	    // Close down the JSON function call
	}
	
	// Albums Page
	
	$(".open_album").hover(function() {
		parent_element = $(this).parent().parent();
		
		$(".album_section").not(parent_element).animate({ // All album_sections except current one lower opacity
			"opacity" : ".5"
		}, { queue:false, duration: 300 });
		
	}, function() {
		
		$(".album_section").not(parent_element).animate({
			"opacity" : "1"
		}, { queue:false, duration:300 });
		
		return false;
	});
	
	// H3 closes current section, so hovering over it changes the cursor to a pointer
	$(".album_section h3").hover(function() {
		
		$(this).css({
			"cursor" : "pointer"
		});
		
	}, function() {
		
		$(this).css({
			"cursor" : "auto"
		});
	});
	
	$(".open_album").click(function() {
		
		// Get height of album_info to know what height to animate album_section to
		element_height = $(this).parent().parent().children(".album_info").height();
		
		$(this).hide();
		
		// currently_viewing class is added to open elements to close them when another album is opened
		$(".currently_viewing").animate({
			"height" : "100px"
		}, { queue:false, duration: 300});
		
		$(".currently_viewing").children("li").children(".open_album").show();
		
		$(".currently_viewing").removeClass("currently_viewing");
		
		$(this).parent().parent().animate({
			"height" : element_height + 120 + "px"
		}, { queue:false, duration: 300 });
		
		$(this).parent().parent().addClass("currently_viewing");
		
		return false;
	});
	
	$(".album_section h3").click(function() {
		
		$(this).parent().parent().animate({
				"height" : "100px"
			}, { queue:false, duration: 300 });
			
		// Once the album is closed, the open_album element is reapplied
		$(this).parent().parent().children("li").children(".open_album").show();
	});
	
	
	
	// Tour Photos Page
	
	// On hover, li background is darker, and other li's fadeout slightly
	
	album_position = -150; // Used in up / down navigation at bottom
	album_position_down = 300;
	
	$("#tour_albums li").hover(function() {
		
		$(this).children("img").css({ "cursor" : "pointer" });

		$("#tour_albums li").not(this).animate({
			"opacity" : ".5"
		}, { queue:false, duration:300});
		
	}, function() {
		$("#tour_albums li").not(this).animate({
			"opacity" : "1"
		}, { queue:false, duration:300});
	});
	
	$("#tour_albums li img").click(function() {
		$(this).parent().children(":last-child").fadeIn("slow");
		
		image_items = $(this).parent().children(".photo_container").children(".photo_buffer").children("a.fancybox").children("img").size();
		
		if (image_items / 3 <= 5) { // Hides up / down controls if images fit onto page
			$(this).parent().children(".photo_container").children(".album_controls").hide();
		}
	});
	
	$("#tour_albums li .photo_container .exit").click(function() {
		
		$(this).parent().parent().fadeOut("slow");
		
		// Rest of this function resets controls for albums
		
		album_position = -150;
		
		$("#tour_albums li .photo_container .photo_buffer").css({
			"top" : "0px"
		});
		
		$(".album_controls .up_control").css({
			"background-position" : "-34px 0px",
			"cursor" : "default"
		});
		
		$(".album_controls .down_control").css({
			"background-position" : "0px 0px",
			"cursor" : "pointer"
		});
		
		return false;
	});
	
	$(".album_controls .up_control").click(function() {
		
		if(album_position >= -150) {
			$(this).css({
				"background-position" : "-34px 0px",
				"cursor" : "default"
			});
		}
		
		else if(album_position >= -300  && album_position < 0) {
			$(this).css({
				"background-position" : "-34px 0px",
				"cursor" : "default"
			});
			
			$(this).parent().parent().children(".photo_buffer").animate({
				"top" : album_position + album_position_down + "px"
			});
			
			album_position = album_position + 150;
		}
		
		else {
			$(this).css({
				"background-position" : "0px 0px",
				"cursor" : "pointer"
			});
			
			$(this).parent().parent().children(".photo_buffer").animate({
				"top" : album_position + album_position_down + "px"
			});
			
			album_position = album_position + 150;
		}
		
		$(this).parent().children(".down_control").css({
			"background-position" : "0px 0px",
			"cursor" : "pointer"
		});
		
		return false;
	});
	
	$(".album_controls .down_control").click(function() {
		
		album_images = $(this).parent().parent().parent().attr('class');
		
		end_value = (Math.ceil((image_items - 15) / 5) * -150); // has to be negative, only used for going down album
		
		if(album_position > end_value) {
			$(this).parent().parent().children(".photo_buffer").animate({
				"top" : album_position + "px"
			});
			
			album_position = album_position - 150;
		}
		
		else if(album_position <= end_value + 150 && album_position >= end_value) {
			$(this).css({
				"background-position" : "-34px 0px",
				"cursor" : "default"
			});
			
			$(this).parent().parent().children(".photo_buffer").animate({
				"top" : album_position + "px"
			});
			
			album_position = album_position - 150;
		}
		
		else {
			$(this).css({
				"background-position" : "-34px 0px",
				"cursor" : "default"
			});
		}
		
		$(this).parent().children(".up_control").css({
			"background-position" : "0px 0px",
			"cursor" : "pointer"
		});
		
		return false;
	});
	
	
	
	
	
	// Contact Page
	
	// Active tab has lighter color and cannot be clicked
	$("#contact_nav li a.active_tab").css({
		"border" : "1px solid #f6f6f6",
		"border-bottom" : "0px",
		"cursor" : "default"
	});
	
	$("#contact_nav li a").not(".active_tab").css({ 
		"border" : "0px",
		"cursor" : "pointer"
	});
	
	$("#second_contact_section").css({ "display" : "none" });
	
	$("#contact_nav li a").eq(0).click(function() { // First <a> tag (numbering starts at zero)
		class_test = $(this).attr("class");
		
		if(class_test == "active_tab") {
			return false;
		}
		
		else {
			$("#second_contact_section").hide();
			$("#first_contact_section").fadeIn("fast");
			
			$("#contact_nav li a").eq(1).removeClass("active_tab");
			$(this).addClass("active_tab");
			
			$("#contact_nav li a.active_tab").css({ // CSS has to be written again due to the event happening after initial styling
				"border" : "1px solid #f6f6f6",
				"border-bottom" : "0px",
				"cursor" : "default"
			});
	
			$("#contact_nav li a").not(".active_tab").css({ 
				"border" : "0px",
				"cursor" : "pointer"
			});
		}
		
		return false;
	});
	
	$("#contact_nav li a").eq(1).click(function() { // Second <a> tag
		class_test = $(this).attr("class");
		
		if(class_test == "active_tab") {
			return false;
		}
		
		else {
			$("#first_contact_section").hide();
			$("#second_contact_section").fadeIn("fast");
			
			$("#contact_nav li a").eq(0).removeClass("active_tab");
			$(this).addClass("active_tab");
			
			$("#contact_nav li a.active_tab").css({
				"border" : "1px solid #f6f6f6",
				"border-bottom" : "0px",
				"cursor" : "default"
			});
	
			$("#contact_nav li a").not(".active_tab").css({ 
				"border" : "0px",
				"cursor" : "pointer"
			});
		}
		
		return false;
	});
	
	// Contact Form Validation
	// Adapted from Trevor Davis' code tutorial: http://trevordavis.net/blog/tutorial/ajax-forms-with-jquery/

	$(".submit").click(function() {
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		var senderNameVal = $(this).parent().children(".name").val();
		if(senderNameVal == '' || senderNameVal == ' ' || senderNameVal == 'Name...' || senderNameVal == 'Venue Name...') {
			$(this).parent().children(".name").css({ "border" : "1px solid #f00" });
			hasError = true;
		}
		
		var emailFromVal = $(this).parent().children(".emailFrom").val();
		if(emailFromVal == '') {
			$(this).parent().children(".emailFrom").css({ "border" : "1px solid #f00" });
			hasError = true;
		} else if(!emailReg.test(emailFromVal)) {	
			$(this).parent().children(".emailFrom").css({ "border" : "1px solid #f00" });
			hasError = true;
		}
		
		var subjectVal = $(this).parent().children(".subject").val();
		if(subjectVal == '' || subjectVal == ' ' || subjectVal == 'Subject...' || subjectVal == 'Location...') {
			$(this).parent().children(".subject").css({ "border" : "1px solid #f00" });
			hasError = true;
		}
		
		var messageVal = $(this).parent().children(".message").val();
		if(messageVal == '' || messageVal == ' ') {
			$(this).parent().children(".message").css({ "border" : "1px solid #f00" });
			hasError = true;
		}
		
		
		if(hasError == false) {	
			// Next four lines of code reverse the "red outline" error styling if there was any
			$(this).parent().children(".name, .emailFrom, .subject, .message").css({ "border" : "1px solid #ddd" });
			
			$(this).css({ 'opacity' : '.5', 'width' : 'auto' });
   						
			$(this).val('Message Sent!');
			
			emailType = $(this).parent().parent().attr('class'); // If you change the classes, change the values in the next if statement below
			
			template_path_contact = $("#template_path_contact").text(); // Used to get template_path which uses php code
			
		}
	});
});

