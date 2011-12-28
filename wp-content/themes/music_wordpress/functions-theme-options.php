<?php

/**
 * Creates a theme options panel for settings such as
 * your twitter account, flickr feed, tour schedule, etc.
 */
 
$themename = "Music WordPress";
$shortname = "mwt";

$categories = get_categories( 'hide_empty=0&orderby=name' );

$wp_cats = array();

foreach ( $categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

array_unshift($wp_cats, "Choose a category"); 

$options = array (
 
array( 
	"name" => $themename." Options",
	"type" => "title"
	),

	array( 
		"name" => "General Settings",
		"type" => "section"
		),
	
		array( 
			"type" => "open"
			),
		
			array( 
				"name" => "Twitter Account",
				"desc" => "Enter the account name of your twitter account (not the full link path), must be a public account",
				"id"   => $shortname."_twitter_account",
				"type" => "text",
				"std"  => ""
				),
				
			array( 
				"name" => "Twitter Area Title",
				"desc" => "Enter the title you want to appear above the tweet itself.",
				"id"   => $shortname."_twitter_area_title",
				"type" => "text",
				"std"  => "Band Twitter Feed"
				),
				
			array( 
				"name" => "Flickr Feed",
				"desc" => 'Enter your Flickr ID. You can obtain it here: <a href="http://idgettr.com/" target="_blank">idGettr</a>',
				"id"   => $shortname."_flickr_feed",
				"type" => "text",
				"std"  => "46743070@N06"
				),
				
			array( 
				"name" => "Custom Favicon",
				"desc" => "Enter a full path for a favicon (including http://). The image should be 16px by 16px.",
				"id"   => $shortname."_fav_icon",
				"type" => "text",
				"std"  => ""
				),	
		
		array( 
			"type" => "close"
			),
	
	array( 
		"name" => "Homepage Settings",
		"type" => "section"
		),
		
		array( 
			"type" => "open"
			),
		
			array( 
				"name" => "Homepage Band Image",
				"desc" => "Enter the link (full path including http://) for the mainpage image",
				"id"   => $shortname."_band_feat_img",
				"type" => "text",
				"std"  => ""
				),
				
			array( 
				"name" => "Band Bio Summary",
				"desc" => "Enter a summary that will appear below the homepage image",
				"id"   => $shortname."_home_bio_desc",
				"type" => "textarea",
				"std"  => "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque blandit tincidunt accumsan. Sed facilisis elementum felis,a suscipit turpis pretium vestibulum. Suspendisse faucibus pulvinar metus, non aliquet felis ultricies in. Duis vitae tortor urna, alaoreet erat. Proin sit amet felis dui, vitae ultricies orci. Mauris ac vestibulum mauris.</p>\n\n<p>Vivamus non blandit nibh. Phasellus tincidunt urna et lorem ornare vel pharetra dui faucibus. Maecenas imperdiet fringilla risus, a laoreet tortor tincidunt ut. Donec euismod ligula at ipsum egestas sagittis. Maecenas pulvinar aliquam dui, a egestas arcu vulputate ac. Integer pellentesque venenatis iaculis. Aenean facilisis lobortis nisi, quis hendrerit felis scelerisque eu.</p>"
				),
				
			array( 
				"name" => "Accordion Title One",
				"desc" => "Enter the title for the first accordion item",
				"id"   => $shortname."_accordion_title_one",
				"type" => "text",
				"std"  => "Upcoming Concert"
				),
				
			array( 
				"name" => "Accordion Image One",
				"desc" => "Enter the link (full path including http://) for the first accordion image",
				"id"   => $shortname."_accordion_image_one",
				"type" => "text",
				"std"  => ""
				),
				
			array( 
				"name" => "Accordion Desc One",
				"desc" => "Enter a description for first accordion item. Formatting tags such as &lt;strong&gt; and &lt;em&gt; are optional, but <strong>please use &lt;p&gt tags for blocks of text</strong>",
				"id"   => $shortname."_accordion_desc_one",
				"type" => "textarea",
				"std"  => '<p><strong>Location:</strong> New York, NY</p> <p><strong>Price:</strong> $30.00</p> <p><strong>When:</strong> March 31st, 2010</p> <a class="list_link" href="#">Buy Tickets</a> <a class="list_link" href="#">Other Concerts</a> <a class="list_link" href="#">Tour Photos</a>'
				),
				
			array( 
				"name" => "Accordion Title Two",
				"desc" => "Enter the title for the second accordion item",
				"id"   => $shortname."_accordion_title_two",
				"type" => "text",
				"std"  => "New Album Released!"
				),
				
			array( 
				"name" => "Accordion Image Two",
				"desc" => "Enter the link (full path including http://) for the second accordion image",
				"id"   => $shortname."_accordion_image_two",
				"type" => "text",
				"std"  => ""
				),
				
			array( 
				"name" => "Accordion Desc Two",
				"desc" => "Enter a description for second accordion item. Formatting tags such as &lt;strong&gt; and &lt;em&gt; are optional, but <strong>please use &lt;p&gt tags for blocks of text</strong>",
				"id"   => $shortname."_accordion_desc_two",
				"type" => "textarea",
				"std"  => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus volutpat, risus sit amet suscipit sollicitudin, libero justo gravida ligula, et tristique eros est ut sem.</p> <a class="list_link" href="#">Buy on iTunes</a> <a class="list_link" href="#">Buy on Amazon</a> <a class="list_link" href="#">Buy Amazon CD</a>'
				),
				
			array( 
				"name" => "Accordion Title Three",
				"desc" => "Enter the title for the third accordion item",
				"id"   => $shortname."_accordion_title_three",
				"type" => "text",
				"std"  => "New Single: Lorem Ipsum"
				),
				
			array( 
				"name" => "Accordion Image Three",
				"desc" => "Enter the link (full path including http://) for the third accordion image",
				"id"   => $shortname."_accordion_image_three",
				"type" => "text",
				"std"  => ""
				),
				
			array( 
				"name" => "Accordion Desc Three",
				"desc" => "Enter a description for third accordion item. Formatting tags such as &lt;strong&gt; and &lt;em&gt; are optional, but <strong>please use &lt;p&gt tags for blocks of text</strong>",
				"id"   => $shortname."_accordion_desc_three",
				"type" => "textarea",
				"std"  => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus volutpat, risus sit amet suscipit sollicitudin, libero justo gravida ligula, et tristique eros est ut sem.</p> <a class="list_link" href="#">Buy on iTunes</a> <a class="list_link" href="#">Buy on Amazon</a>'
				),
	
		array( 
			"type" => "close"
			),
	
	array( 
		"name" => "Tour Date Settings",
		"type" => "section"
		),
		
		array( 
			"type" => "open"
			),
			
			array( 
				"name" => "Buy Tickets Text",
				"desc" => "Enter the text for all the buy tickets links",
				"id"   => $shortname."_root_tickets_desc",
				"type" => "text",
				"std"  => "Buy Concert Tickets"
				),
			
			array( 
				"name" => "Featured Concert Image",
				"desc" => "Please enter the link (full path including http://) for the featured concert image",
				"id"   => $shortname."_feat_concert_img",
				"type" => "text",
				"std"  => ""
				),
				
			array( 
				"name" => "Featured Concert Title",
				"desc" => "Please enter the title for the featured concert (normally the location)",
				"id"   => $shortname."_feat_concert_title",
				"type" => "text",
				"std"  => "Upcoming Concert - New York, NY"
				),
				
			array( 
				"name" => "Featured Concert Text",
				"desc" => "Please enter a description for the featured concert. <strong>Make sure to keep the paragraph tags for separating paragraphs</strong>",
				"id"   => $shortname."_feat_concert_desc",
				"type" => "textarea",
				"std"  => "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque blandit tincidunt accumsan. Sed facilisis elementum felis, a suscipit turpis pretium vestibulum. Suspendisse faucibus pulvinar metus, non aliquet felis ultricies in.</p> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque blandit tincidunt accumsan. Sed facilisis elementum felis, a suscipit turpis pretium vestibulum.</p>"
				),
				
			array( 
				"name" => "Buy Tickets Link",
				"desc" => "Please enter the link to where customers can purchase tickets for the main concert<strong>including http://</strong>",
				"id"   => $shortname."_tickets_link_one",
				"type" => "text",
				"std"  => "#"
				),
				
			array( 
				"name" => "Secondary Concert One Title",
				"desc" => "Please enter the title for the first secondary concert (top, left side of Tour Info)",
				"id"   => $shortname."_secondary_concert_title_one",
				"type" => "text",
				"std"  => "Chicago, IL"
				),
				
			array( 
				"name" => "Secondary Concert One Date",
				"desc" => "Date for first secondary concert",
				"id"   => $shortname."_secondary_concert_date_one",
				"type" => "text",
				"std"  => "February 2nd, 2010"
				),
				
			array( 
				"name" => "Secondary Concert One Description",
				"desc" => "Short description for the first secondary concert (keep it to about one or two sentences)",
				"id"   => $shortname."_secondary_concert_desc_one",
				"type" => "textarea",
				"std"  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
				),
				
			array( 
				"name" => "Buy Tickets Link",
				"desc" => "Please enter the link to where customers can purchase tickets for the first secondary concert<strong>including http://</strong>",
				"id"   => $shortname."_tickets_link_two",
				"type" => "text",
				"std"  => "#"
				),
				
			array( 
				"name" => "Secondary Concert Two Title",
				"desc" => "Please enter the title for the second secondary concert (bottom, left side of Tour Info)",
				"id"   => $shortname."_secondary_concert_title_two",
				"type" => "text",
				"std"  => "Miami, FL"
				),
				
			array( 
				"name" => "Secondary Concert Two Date",
				"desc" => "Date for second secondary concert",
				"id"   => $shortname."_secondary_concert_date_two",
				"type" => "text",
				"std"  => "February 18th, 2010"
				),
				
			array( 
				"name" => "Secondary Concert Two Description",
				"desc" => "Short description for the second secondary concert (keep it to about one or two sentences)",
				"id"   => $shortname."_secondary_concert_desc_two",
				"type" => "textarea",
				"std"  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
				),
				
			array( 
				"name" => "Buy Tickets Link",
				"desc" => "Please enter the link to where customers can purchase tickets for the second secondary concert<strong>including http://</strong>",
				"id"   => $shortname."_tickets_link_three",
				"type" => "text",
				"std"  => "#"
				),
				
			array( 
				"name" => "Other Tour Dates",
				"desc" => "Enter the date of the concert followed by a ; then the city followed by another ; then the link to buy tickets with no spaces in between the semicolon (;). Add a third ; followed by sold_out if the concert is sold out. Do this for each concert on a separate line, follow the example already shown.",
				"id"   => $shortname."_tour_list",
				"type" => "textarea",
				"std"  => "March 31, 2010;Des Moines, IA;#\nApril 5th, 2010;Springfield, IL;#\nApril 12, 2010;Jonesburg, AR;#\nApril 29, 2010;Memphis, TN;#;sold_out\nMay 10, 2010;Providence, RH;#\nMay 19, 2010;Kansas City, KS;#\nJune 1, 2010;St. Louis, MI;#;sold_out\nJune 14, 2010;Phoenix, AZ;#\nJune 26, 2010;Atlanta, GA;#\nJuly 3, 2010;Boston MA;#"
				),	
	
		array( 
			"type" => "close"
			),
	
	array( 
		"name" => "Contact Page Settings",
		"type" => "section"
		),
	
		array(
			"type" => "open"
			),
		
			array( 
				"name" => "Contact Sidebar Title",
				"desc" => "Enter a title for the contact page sidebar",
				"id"   => $shortname . "_contact_sidebar_title",
				"type" => "text",
				"std"  => "Send Us Mail"
				),
			
			array( 
				"name" => "Contact Sidebar Description",
				"desc" => "Enter some text for the contact page sidebar",
				"id"   => $shortname . "_contact_sidebar_desc",
				"type" => "textarea",
				"std"  => "Would you rather send us mail the old fashioned way? If you prefer, you can send us mail to: P.O. Box: 12345 Lorem Street, New York NY, 55555 United States"
				),
		
		array( 
			"type" => "close"
			),
	
	array( 
		"name" => "Footer Settings",
		"type" => "section"
		),
		
		array( 
			"type" => "open"
			),
			
			array( 
				"name" => "Google Analytics Code",
				"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
				"id"   => $shortname."_ga_code",
				"type" => "textarea",
				"std"  => ""
				),
				
			array( 
				"name" => "Footer Header One",
				"desc" => "Enter the title of the first footer section (the links are taken care of in the links section, read help file for more information).",
				"id"   => $shortname."_footer_title_one",
				"type" => "text",
				"std"  => "Theme Name"
				),
				
			array( 
				"name" => "Footer Header Two",
				"desc" => "Enter the title of the second footer section.",
				"id"   => $shortname."_footer_title_two",
				"type" => "text",
				"std"  => "Pages"
				),
				
			array( 
				"name" => "Footer Header Three",
				"desc" => "Enter the title of the third footer section.",
				"id"   => $shortname."_footer_title_three",
				"type" => "text",
				"std"  => "Find Us"
				),
				
			array( 
				"name" => "Footer Header Four",
				"desc" => "Enter the title of the fourth footer section.",
				"id"   => $shortname."_footer_title_four",
				"type" => "text",
				"std"  => "Bands We Like"
				),
	
		array( 
			"type" => "close" 
			)
);

function mytheme_add_admin() {
	global $themename, $shortname, $options;
	 
	if ( $_GET['page'] == basename(__FILE__) ) {
	 
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
			}
	 
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
				} 
				
				else { 
					delete_option( $value['id'] ); 
				} 
			}
	 
			header( "Location: admin.php?page=functions-theme-options.php&saved=true" );
			
			die;
		}
		
		else if( 'reset' == $_REQUEST['action'] ) {
		 
			foreach ($options as $value) {
				delete_option( $value['id'] ); 
			}
		 
			header( "Location: admin.php?page=functions-theme-options.php&reset=true" );
	
			die;	 
		}
	}
	 
	add_menu_page( $themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin' );
}

function mytheme_admin() {
	global $themename, $shortname, $options;
	$i=0;
 
	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>

<div class="wrap rm_wrap">
	<h2><?php echo $themename; ?> Settings</h2>
 
	<div class="rm_opts">

		<form method="post">
			<?php foreach ($options as $value) {
				switch ( $value['type'] ) {
	 
				case "open" :
			?>
	 
			<?php break;
				case "close" :
			?>
 
	</div>
</div>

<br />
 
<?php break;
	case "title":
?>

<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>
 
<?php break;
	case 'text' :
?>

	<div class="rm_input rm_text">
		<label for="<?php echo $value['id']; ?>">
			<?php echo $value['name']; ?>
		</label>
		
	 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
	 
	 	<small>
	 		<?php echo $value['desc']; ?>
	 	</small>
	 	
	 	<div class="clearfix"></div>
	 
	</div>

<?php
	break;
 
	case 'textarea' :
?>

	<div class="rm_input rm_textarea">
		<label for="<?php echo $value['id']; ?>">
			<?php echo $value['name']; ?>
		</label>
		
	 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows="">
	 		<?php 
	 			if ( get_settings( $value['id'] ) != "") { 
		 			echo stripslashes(get_settings( $value['id']) ); 
		 		} 
		 		
		 		else { 
		 			echo $value['std']; 
		 		} 
	 		?>
	 	</textarea>
	 	
		<small>
			<?php echo $value['desc']; ?>
		</small>
		
		<div class="clearfix"></div>
	 
	</div>
  
<?php
	break;
 
	case 'select' :
?>

	<div class="rm_input rm_select">
		<label for="<?php echo $value['id']; ?>">
			<?php echo $value['name']; ?>
		</label>
		
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $option) { ?>
				<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
					<?php echo $option; ?>
				</option>
			<?php } ?>
		</select>
	
		<small>
			<?php echo $value['desc']; ?>
		</small>
		
		<div class="clearfix"></div>
	</div>

<?php
	break;
 
	case "checkbox" :
?>

	<div class="rm_input rm_checkbox">
		<label for="<?php echo $value['id']; ?>">
			<?php echo $value['name']; ?>
		</label>
		
		<?php 
			if( get_option( $value['id'] ) ) { 
				$checked = "checked=\"checked\""; 
			}
		
			else { 
				$checked = "";
			} 
		?>
		
		<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	
		<small>
			<?php echo $value['desc']; ?>
		</small>
		
		<div class="clearfix"></div>
	</div>

<?php 
	break;
	 
	case "section" :

	$i++;
?>

	<div class="rm_section">
		<div class="rm_title">
			<h3>
				<img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt=""">

				<?php echo $value['name']; ?>
			</h3>

			<span class="submit">
				<input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
			</span>

			<div class="clearfix"></div>
		</div>
	<div class="rm_options">

 
<?php break;
 
}
}
?>
 
			<input type="hidden" name="action" value="save" />
		</form>
		
		<form method="post">
			<p class="submit">
				<input name="reset" type="submit" value="Reset" />

				<input type="hidden" name="action" value="reset" />
			</p>
		</form>
	</div>

<?php
}
?>