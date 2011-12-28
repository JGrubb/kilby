<?php

// REGISTER SIDEBARS AND WIDGETS
//===========================================================================================================

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Left',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="heading">',
		'after_title' => '</h2>',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Right',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="heading">',
		'after_title' => '</h2>',
	));

if( function_exists( 'register_sidebar_widget' ) ) {
	register_sidebar_widget('Ad: BigBox','mb_bigbox');
	register_sidebar_widget('Ad: Buttons','mb_buttons');
	register_sidebar_widget('Ad: Skyscraper','mb_skyscraper');
	register_sidebar_widget('Ad: Skyscraper 2','mb_skyscraper2');
	register_sidebar_widget('Twitter','mb_twitter');
}

function mb_bigbox() { include(TEMPLATEPATH . '/widgets/ad-bigbox.php'); }
function mb_buttons() {	include(TEMPLATEPATH . '/widgets/ad-buttons.php'); }
function mb_skyscraper() { include(TEMPLATEPATH . '/widgets/ad-skyscraper.php'); }
function mb_skyscraper2() { include(TEMPLATEPATH . '/widgets/ad-skyscraper2.php'); }
function mb_twitter() {include(TEMPLATEPATH . '/widgets/twitter.php'); }

// POST THUMBNAILS
//===========================================================================================================

if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
}

// MENUS
//===========================================================================================================

function mb_addmenus() {
	register_nav_menus(
		array(
			'main_nav' => 'Main Nav',
		)
	);
}
add_action( 'init', 'mb_addmenus' );

function mb_nav() {
	if ( function_exists( 'wp_nav_menu' ) )
		wp_nav_menu( 'menu=main_nav&fallback_cb=mb_nav_fallback&depth=2' );
	else
		mb_nav_fallback();
}

function mb_nav_fallback() {
	wp_page_menu( 'show_home=Home&depth=2&title_li=&depth=2&exclude=' . $mb_exclude_pages . '' );
}

// POST CUSTOM FIELDS UI
//===========================================================================================================

$post_custom_fields =
array(
	"post_image" => array(
		"name" => "post_image",
		"std" => "",
		"title" => "Post Image Path (eg. /wp-content/uploads/image-name.jpg):",
		"description" => ""
	)
);

function post_custom_fields() {
	global $post, $post_custom_fields;

	foreach($post_custom_fields as $meta_box) {
		$meta_box_value = stripslashes(get_post_meta($post->ID, $meta_box['name'].'_value', true));

		if($meta_box_value == "")
			$meta_box_value = $meta_box['std'];

			echo '<p style="margin-bottom:10px;">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			echo'<strong>'.$meta_box['title'].'</strong>';
			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.attribute_escape($meta_box_value).'" style="width:98%;" /><br />';
			echo '</p>';
	}
}

function create_meta_box() {
	global $theme_name;
		if ( function_exists('add_meta_box') ) {
			add_meta_box( 'new-meta-boxes', 'Additional Information', 'post_custom_fields', 'post', 'normal', 'high' );
	}
}

function save_postdata( $post_id ) {
	global $post, $post_custom_fields;

	foreach($post_custom_fields as $meta_box) {
		// Verify
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
			return $post_id;
	}

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
	}

	$data = $_POST[$meta_box['name'].'_value'];

	if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
		add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
	elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
		update_post_meta($post_id, $meta_box['name'].'_value', $data);
	elseif($data == "")
		delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	}
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

// THEME SETTINGS PANEL
//===========================================================================================================

$themename = "Varnish";
$shortname = "mb";
$path = get_bloginfo('template_directory');
$options = array (

		array(  "name" => "Style Preferences",
            "id" => $shortname."_style_prefs",
            "std" => "",
            "type" => "heading"),

		array(	"name"	=> "Center the Site",
						"id"	=>	$shortname . "_center",
						"desc" => "Center the site in your browser window.  Aligned to the left by default.",
						"std"	=>	"",
						"status" => 'checked',
						"type"	=>	"checkbox"),

		array(  "name" => "Colour Scheme",
						"id" => $shortname."_scheme",
						"desc" => "Choose from one of the bundled colour schemes.",
						"std" => "",
						"type" => "select",
						"options" => array("backinblack","annie","blue","converseotech","coralreef","darkelf","denim","dinte","forgotten","fusionroyale","hippiechick","knitknots","monk","neo","oldflowers","oldlacquer","plumtree","ponderosa","riverbed","seriously","suitup","trench","vulnerability"),),

		array(  "name" => "Background Pattern",
						"id" => $shortname."_bg_pattern",
						"desc" => "Choose a pattern to be applied to the background of your site.",
						"std" => "",
						"type" => "select",
						"options" => array("none","brushedmetal","butterflies","clouds","concrete","dots-large","dots-small","flowerhearts","grunge","grunge-2","hardwood","ice-diamonds","leather","metal-dots","retro-curves","starfield","stripes","urban-circles","water","woodgrain","woodgrain-2"),),

		array(  "name" => "Background Position",
						"id" => $shortname."_bg_position",
						"desc" => "Have the background pattern stay in one place (fixed) or scroll with the rest of the page.",
						"std" => "",
						"type" => "select",
						"options" => array("scroll","fixed"),),

		array(	"name"	=> "Custom Colour Scheme",
						"id"	=>	$shortname . "_custom",
						"desc" => "Select this option if you'd like to specify custom colours, then use the following set of fields to create your own colour scheme.",
						"std"	=>	"",
						"status" => 'checked',
						"type"	=>	"checkbox"),
	
		array(  "name" => "Background Colour",
	          "id" => $shortname."_colour_bg",
	          "std" => "#222",
	          "type" => "colour"),
	
		array(  "name" => "Main Text Colour",
	          "id" => $shortname."_colour_text",
	          "std" => "#999",
	          "type" => "colour"),
	
		array(  "name" => "Light Text Colour",
	          "id" => $shortname."_colour_light",
	          "std" => "#ccc",
	          "type" => "colour"),
	
		array(  "name" => "Dark Text Colour",
	          "id" => $shortname."_colour_dark",
	          "std" => "#777",
	          "type" => "colour"),
	
		array(  "name" => "Link Colour",
	          "id" => $shortname."_colour_link",
	          "std" => "#777",
	          "type" => "colour"),
	
		array(  "name" => "Link:hover Colour",
	          "id" => $shortname."_colour_hover",
	          "std" => "#fff",
	          "type" => "colour"),
	
		array(  "name" => "Accent Colour",
	          "id" => $shortname."_colour_accent",
	          "std" => "#d65d7b",
	          "type" => "colour"),

		array(  "name" => "Twitter Bird",
						"id" => $shortname."_twitter_bird",
						"std" => "",
						"type" => "select",
						"options" => array("nola","roger","spritz","squidge","wallace"),),

		array(	"name"	=> "Hide Twitter Bird",
						"id"	=>	$shortname . "_twitter_bird_hide",
						"std"	=>	"",
						"status" => 'checked',
						"type"	=>	"checkbox"),

		array(  "name" => "Save",
            "id" => $shortname."_save",
            "std" => "",
            "type" => "save"),

		array(  "name" => "Miscellaneous Settings",
            "id" => $shortname."_misc_settings",
            "std" => "",
            "type" => "heading"),

		array(	"name"	=> "Disable Image Resizing",
						"id"	=>	$shortname . "_resize",
						"desc" => "If you're having trouble with post images, try disabling image resizing to see if the script is the problem.",
						"std"	=>	"",
						"status" => 'checked',
						"type"	=>	"checkbox"),

		array(  "name" => "Photo Path",
	          "id" => $shortname."_photo_path",
						"desc" => "The location of the photo you would like to use in the top left corner.  You can use the full path starting with http://",
	          "std" => "",
	          "type" => "text"),
	
		array(  "name" => "Tagline",
	          "id" => $shortname."_tagline",
						"desc" => "The line of text that appears above your name in the header.",
	          "std" => "The Personal Blog of...",
	          "type" => "text"),
	
		array(  "name" => "First Name",
	          "id" => $shortname."_name_first",
	          "std" => "",
	          "type" => "text"),
	
		array(  "name" => "Last Name",
	          "id" => $shortname."_name_last",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Name Size",
						"id" => $shortname."_name_size",
						"desc" => "Specify the size your name should be displayed at in the header.",
						"std" => "",
						"type" => "select",
						"options" => array("3.8","3.6","3.4","3.2","3.0","2.8","2.6","2.4","2.2","2.0","1.8","1.6","1.4","1.2","1.0"),),
	
		array(  "name" => "RSS Feed Replacement URL",
	          "id" => $shortname."_subscribe_feed",
						"desc" => "If you use a service like FeedBurner, enter your feed URL here.",
	          "std" => "",
	          "type" => "text"),
	
		array(  "name" => "Email Subscription URL",
	          "id" => $shortname."_subscribe_email",
						"desc" => "Some services like FeedBurner offer email subscriptions. Enter the URL for the form here. Opens in a lightbox window.",
	          "std" => "",
	          "type" => "text"),	

		array(  "name" => "Save",
            "id" => $shortname."_save",
            "std" => "",
            "type" => "save"),				

		array(  "name" => "Social Profiles",
            "id" => $shortname."_social_profiles",
            "std" => "",
            "type" => "heading"),

		array(  "name" => "Delicious",
	          "id" => $shortname."_social_delicious",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Digg",
	          "id" => $shortname."_social_digg",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Facebook",
	          "id" => $shortname."_social_facebook",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Flickr",
	          "id" => $shortname."_social_flickr",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "FriendFeed",
	          "id" => $shortname."_social_friendfeed",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Last.fm",
	          "id" => $shortname."_social_lastfm",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "LinkedIn",
	          "id" => $shortname."_social_linkedin",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Mixx",
	          "id" => $shortname."_social_mixx",
	          "std" => "",
	          "type" => "text"),
	
		array(  "name" => "MySpace",
	          "id" => $shortname."_social_myspace",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Reddit",
	          "id" => $shortname."_social_reddit",
	          "std" => "",
	          "type" => "text"),	

		array(  "name" => "Stumble Upon",
	          "id" => $shortname."_social_stumbleupon",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Technorati",
	          "id" => $shortname."_social_technorati",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Tumblr",
	          "id" => $shortname."_social_tumblr",
	          "std" => "",
	          "type" => "text"),
	
		array(  "name" => "Twitter",
	          "id" => $shortname."_social_twitter",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Vimeo",
	          "id" => $shortname."_social_vimeo",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "YouTube",
	          "id" => $shortname."_social_youtube",
	          "std" => "",
	          "type" => "text"),

		array(  "name" => "Save",
            "id" => $shortname."_save",
            "std" => "",
            "type" => "save"),

		array(  "name" => "Ad Management",
            "id" => $shortname."_ad_management",
            "std" => "",
            "type" => "heading"),

		array(  "name" => "&lsaquo;head&rsaquo; Include Code",
	          "id" => $shortname."_head_include",
						"desc" => "Some ads require a chunk of code in the <head>. You can dump that and any other code that needs to be placed in the <head> in this field.",
	          "std" => "",
	          "type" => "textarea"),

		array(  "name" => "Footer Include Code",
	          "id" => $shortname."_footer_include",
						"desc" => "Most stat tracking code needs to be placed in the footer. Paste that code in this field.",
	          "std" => "",
	          "type" => "textarea"),

		array(  "name" => "Bigbox (300x250)",
            "id" => $shortname."_bigbox",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Banner (468x60)",
            "id" => $shortname."_banner",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Skyscraper (120x600)",
            "id" => $shortname."_skyscraper",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Skyscraper (160x600)",
            "id" => $shortname."_skyscraper2",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Button 1 (125x125)",
            "id" => $shortname."_button_1",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Button 2 (125x125)",
            "id" => $shortname."_button_2",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Button 3 (125x125)",
            "id" => $shortname."_button_3",
            "std" => "",
            "type" => "textarea"),

		array(  "name" => "Button 4 (125x125)",
            "id" => $shortname."_button_4",
            "std" => "",
            "type" => "textarea")

);

function mb_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { 
											if( $value['type'] == 'checkbox' ) {
												if( $value['status'] == 'checked' ) {
													update_option( $value['id'], 1 );
												} else { 
													update_option( $value['id'], 0 ); 
												}	
											} elseif( $value['type'] != 'checkbox' ) {
												update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
											} else { 
												update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
											}
										}
									}

                header("Location: admin.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: admin.php?page=functions.php&reset=true");
            die;

        }
    }

    add_menu_page($themename." Settings", "Theme Settings", 'edit_themes', basename(__FILE__), 'mb_admin');

}

function mb_admin() {

    global $themename, $shortname, $options, $path;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    
?>
<div class="wrap">
	
<h2><?php echo $themename; ?> Settings <span style="font-size:.75em;">- <a href="<?php echo $path; ?>/help/" target="_blank">Help Documentation</a></span></h2>

<form method="post">

	<table class="form-table" style="margin-top:-15px;">

		<?php foreach ($options as $value) { if ($value['type'] == "text") { ?>

		<tr valign="top" style="border-bottom:1px solid #eee;"> 
		    <th scope="row" style="width:275px;">
					<?php echo $value['name']; ?>
					<br/><span style="color:#999; font-size:11px;"><?php echo $value['desc']; ?></span>
				</th>
		    <td>
		        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes (get_settings( $value['id'] )); } else { echo $value['std']; } ?>" size="50" style="width:450px;" />
		    </td>
		</tr>

		<?php } elseif ($value['type'] == "textarea") { ?>

		    <tr valign="top" style="border-bottom:1px solid #eee;"> 
		        <th scope="row">
							<?php echo $value['name']; ?>
							<br/><span style="color:#999; font-size:11px;"><?php echo $value['desc']; ?></span>
						</th>
		        <td>
		            <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" rows="8" cols="50" style="width:450px;"><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes (get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea>
		        </td>
		    </tr>

		<?php } elseif ($value['type'] == "checkbox") { ?>

		    <tr valign="top" style="border-bottom:1px solid #eee;"> 
		        <th scope="row">
							<?php echo $value['name']; ?>
							<br/><span style="color:#999; font-size:11px;"><?php echo $value['desc']; ?></span>
						</th>
		        <td>
								<?php
									if ( get_option( $value['id'] ) != "" ) { 
										$status= get_option( $value['id'] );
									} else { 
										$status= $value['std']; 
									}
								?>
		            <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" <?php if( $status == 1 ) { echo 'checked'; } ?>/>
		        </td>
		    </tr>

		<?php } elseif ($value['type'] == "select") { ?>

		    <tr valign="top" style="border-bottom:1px solid #eee;"> 
		        <th scope="row">
							<?php echo $value['name']; ?>
							<br/><span style="color:#999; font-size:11px;"><?php echo $value['desc']; ?></span>
						</th>
		        <td>
		            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
		                <?php foreach ($value['options'] as $option) { ?>
		                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
		                <?php } ?>
		            </select>
		        </td>
		    </tr>

				<?php } elseif ($value['type'] == "colour") { ?>

		    <tr valign="top" style="border-bottom:1px solid #eee;">
			 			<th scope="row">
							<?php echo $value['name']; ?>
							<br/><span style="color:#999; font-size:11px;"><?php echo $value['desc']; ?></span>
						</th>
		        <td>
		            <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes (get_settings( $value['id'] )); } else { echo $value['std']; } ?>" size="50" style="width:75px; border:0;" class="color {hash:true,caps:false}" />
		        </td>
		    </tr>

				<?php } elseif ($value['type'] == "heading") { ?>

		    <tr valign="top" style="border-bottom:1px solid #eee;"> 
		        <td colspan="2">
		            <h2 style="font-size:1.8em; font-style:normal;"><?php echo $value['name']; ?></h2>
		        </td>
		    </tr>
		
				<?php } elseif ($value['type'] == "save") { ?>
					
				<tr valign="top"> 
		        <td colspan="2" class="submit" style="padding-top:12px;">
								<input name="save" type="submit" value="Save Changes" class="button" />    
								<input type="hidden" name="action" value="save" />
		        </td>
		    </tr>

		<?php 
			} 
		}
		?>

	</table>

	<p class="submit">
		<input name="save" type="submit" value="Save Changes" class="button-primary" />    
		<input type="hidden" name="action" value="save" />
	</p>
</form>

<?php
}

function mb_wp_head() {
	$path= get_bloginfo('template_directory');
	$mb_head_include= stripslashes(get_option('mb_head_include'));
	echo $mb_head_include;
	global $options;
	foreach ( $options as $value ) {
	    if ( get_settings( $value['id'] ) === FALSE ) { 
			$$value['id'] = $value['std']; 
		} else { 
			$$value['id'] = get_settings( $value['id'] ); 
		} 
	} if ($mb_custom == 1) { ?>
	
	<style type="text/css">
		body { color: <?php echo $mb_colour_text; ?>; background: <?php echo $mb_colour_bg; ?> url("<?php echo $path; ?>/images/bg.png") repeat-y 0 0; }
		body.centerit { color: <?php echo $mb_colour_text; ?>; background: <?php echo $mb_colour_bg; ?> url("<?php echo $path; ?>/images/bg-center.png") repeat-y 50% 0; }
		#intro { color: <?php echo $mb_colour_dark; ?>; }
		#name { color: <?php echo $mb_colour_dark; ?>; }
		#name a { color: <?php echo $mb_colour_accent; ?>; }
		#name a:hover { color: <?php echo $mb_colour_hover; ?>; }
		#desc { color: <?php echo $mb_colour_text; ?>; }
		#nav li a { color: <?php echo $mb_colour_link; ?>; }
		#nav li a:hover { color: <?php echo $mb_colour_hover; ?>; }
		#nav li.current_page_item a { color: <?php echo $mb_colour_hover; ?>; }
		#social li a { color: <?php echo $mb_colour_link; ?>; }
		#social li a:hover { color: <?php echo $mb_colour_hover; ?>; }
		#search #s { color: <?php echo $mb_colour_dark; ?>; }
		#search #s:focus { color: <?php echo $mb_colour_bg; ?>; }
		#twitter h2 { color: <?php echo $mb_colour_accent; ?>; }
		.content a:link, .content a:visited, .content a:active { color: <?php echo $mb_colour_link; ?>; }
		.content a:hover { color: <?php echo $mb_colour_hover; ?>; }
		.content h1, .content h2, .content h3, .content h4, .content h5, .content h6 { color: <?php echo $mb_colour_light; ?>; }
		#archive-title h2 { color: <?php echo $mb_colour_text; ?>; }
		#archive-title h2 strong { color: <?php echo $mb_colour_light; ?>; }
		.content h2 { color: <?php echo $mb_colour_accent; ?>; }
		.content h2 a:link, .content h2 a:visited, .content h2 a:active { color: <?php echo $mb_colour_light; ?>; }
		.content h2 a:hover { color:<?php echo $mb_colour_hover; ?>; }
		.content h3 { color: <?php echo $mb_colour_accent; ?>; }
		.content .wp-caption p { color: <?php echo $mb_colour_dark; ?>; }
		a:link.button, a:visited.button, a:active.button { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_accent; ?>; border: 3px solid <?php echo $mb_colour_bg; ?>; }
		a:hover.button { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_accent; ?>; border: 3px solid <?php echo $mb_colour_bg; ?>; }
		#content .navigation a { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_accent; ?>; border: 3px solid <?php echo $mb_colour_bg; ?>; }
		#content .navigation a:hover { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_accent; ?>; border: 3px solid <?php echo $mb_colour_bg; ?>; }
		.content .wp-pagenavi a, .content .wp-pagenavi a:link, .content .wp-pagenavi a:visited, .content .wp-pagenavi a:active { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_dark; ?>; }
		.content .wp-pagenavi a:hover { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_text; ?>; }
		.content .wp-pagenavi span.pages { color: <?php echo $mb_colour_dark; ?>; }
		.content .wp-pagenavi span.current, .content .wp-pagenavi span.extend { color: <?php echo $mb_colour_text; ?>; background-color: <?php echo $mb_colour_bg; ?>; }
		.content .wp-pagenavi span.current { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_accent; ?>; }
		.post-date span { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_accent; ?>; }
		.post-categories { color: <?php echo $mb_colour_dark; ?>; }
		#comments .bypostauthor > div > div > .avatar { background: <?php echo $mb_colour_accent; ?>; }
		#comments h2 { color: <?php echo $mb_colour_accent; ?>; }
		#commentform label small span { color: <?php echo $mb_colour_dark; ?>; }
		#commentform input, #commentform textarea { color: <?php echo $mb_colour_text; ?>; background: <?php echo $mb_colour_bg; ?>; border: 1px solid <?php echo $mb_colour_dark; ?>; }
		#commentform input:focus, #commentform textarea:focus { color: <?php echo $mb_colour_bg; ?>; background: <?php echo $mb_colour_light; ?>; border: 1px solid <?php echo $mb_colour_light; ?>; }
		#commentform #submit { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_accent; ?>; border: 3px solid <?php echo $mb_colour_bg; ?>; }
		#commentform #submit:hover { color: <?php echo $mb_colour_bg; ?>; background-color: <?php echo $mb_colour_accent; ?>; border: 3px solid <?php echo $mb_colour_bg; ?>; }
		#footer { color: <?php echo $mb_colour_dark; ?>; }
		#footer a:link, #footer a:visited, #footer a:active { color: <?php echo $mb_colour_dark; ?>; }
		#footer a:hover { color: <?php echo $mb_colour_text; ?>; }
	</style>
	
	<?php } else { ?><link rel="stylesheet" href="<?php echo $path; ?>/css/scheme-<?php echo $mb_scheme; ?>.css" type="text/css" media="screen, projection" />
	
<?php } }

function mb_admin_head() {
	$path= get_bloginfo('template_directory');
	echo '<script type="text/javascript" src="' . $path . '/js/colorpicker/jscolor.js"></script>';
?>

<?php }
add_action('wp_head', 'mb_wp_head');
add_action('admin_head', 'mb_admin_head');
add_action('admin_menu', 'mb_add_admin');	
?>