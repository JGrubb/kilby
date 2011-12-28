<?php

/**
 * Creates custom post types for music albums
 * and photo albums
 */
 
// 1. PHOTO ALBUMS

add_action('init', 'product_register');

function product_register() {
   	$args = array(
       	'labels' => array(
       		'name' => __('Photo Albums'),
       		'singular_name' => __('Photo Album')
       	),
       	'public' => true,
       	'publicly_queryable' => true,
       	'show_ui' => true,
		'exclude_from_search' => true,
       	'menu_position' => 5,
       	'capability_type' => 'post',
       	'hierarchical' => false,
       	'rewrite' => true,
		'query_var' => true,
       	'supports' => array('title', 'thumbnail')
       );

   	register_post_type( 'photo_albums' , $args );
}

	add_action("admin_init", "admin_init");
	add_action('save_post', 'save_info');

	function admin_init() {
		add_meta_box("prodInfo-meta", "Photo Album Details", "meta_options", "photo_albums", "normal", "low");
	}

	function meta_options() {
		global $post;
		$custom = get_post_custom($post->ID);
		$compdata = $custom["compdata"][0];
		$imagepaths = $custom["imagepaths"][0];
?>

	<p style="margin:10px 0px 10px 6px;">
		<span style="color:#888;font-size:11px;">Please fill out both forms below (all required). First image inputed will be used as a cover image. Each image needs to have a full path (including http://) and also needs to be on its own line.</span>
	</p>
	
	<p>Album Date</p>
	
	<input name="compdata" value="<?php echo $compdata; ?>" style="width:97%;height:25px;margin:0px 0px 10px 6px;border:1px solid #eee;-webkit-border-radius:3px;-mozkit-border-radius:3px;border-radius:3px;" />
	
	<p>Images (Full path, each on its own line)</p>
	
	<textarea name="imagepaths"style="width:97%;height:400px;margin:0px 0px 10px 6px;border:1px solid #eee;-webkit-border-radius:3px;-mozkit-border-radius:3px;border-radius:3px;resize:none;" /><?php echo $imagepaths; ?></textarea>
	
<?php
	}

function save_info() {
	global $post;
	update_post_meta($post->ID, "compdata", $_POST["compdata"]);
	update_post_meta($post->ID, "imagepaths", $_POST["imagepaths"]);
}

// 2. MUSIC ALBUMS

add_action('init', 'music_albums');

function music_albums() {
   	$args = array(
       	'labels' => array(
       		'name' => __('Music Albums'),
       		'singular_name' => __('Music Album')
       	),
       	'public' => true,
       	'publicly_queryable' => false,
       	'show_ui' => true,
		'exclude_from_search' => true,
       	'menu_position' => 5,
       	'capability_type' => 'post',
       	'hierarchical' => true,
       	'rewrite' => true,
		'query_var' => true,
       	'supports' => array('title', 'thumbnail')
       );

   	register_post_type( 'music_albums' , $args );
}

	add_action("admin_init", "admin_init_music");
	add_action('save_post', 'save_info_music');

	function admin_init_music() {
		add_meta_box("prodInfo-meta", "Music Album Details", "meta_options_music", "music_albums", "normal", "low");
	}

	function meta_options_music() {
		global $post;
		$custom = get_post_custom($post->ID);
		$image = $custom["image"][0];
		$music = $custom["music"][0];
		$buy = $custom["buy"][0];
		$release = $custom["release"][0];
		$duration = $custom["duration"][0];
?>
	<p style="margin:10px 0px 10px 6px;">
		<span style="color:#888;font-size:11px;">Please fill out the forms below along with the title form above. All fields are required except for buy links and buy titles (you can choose not to fill out any of the forms you like, but they might show up as empty spaces on the page).</span>
	</p>
	
	<p>Album Image</p>
	
	<input name="image" value="<?php echo $image; ?>" style="width:97%;height:25px;margin:0px 0px 10px 6px;border:1px solid #eee;-webkit-border-radius:3px;-mozkit-border-radius:3px;border-radius:3px;" />
	
	<p>Song List and Links (Enter each song title on its own line. The songs will be pulled from the music folder in the template folder, if you are using the album page template without links, no songs will be linked)</p>
	
	<textarea name="music"style="width:97%;height:400px;margin:0px 0px 10px 6px;border:1px solid #eee;-webkit-border-radius:3px;-mozkit-border-radius:3px;border-radius:3px;resize:none;" /><?php echo $music; ?></textarea>
	
	<div style="width: 48%; float: left;">
		<p>Enter buy links each on their own line (Enter the Name followed by a comma (,) then the link)</p>
		
		<textarea name="buy" style="width:97%;height:200px;margin:0px 0px 10px 6px;border:1px solid #eee;-webkit-border-radius:3px;-mozkit-border-radius:3px;border-radius:3px;resize:none;" /><?php echo $buy; ?></textarea>
	</div>
	
	<div style="width: 49%; float: left;">
		<p>Release Date</p>
		
		<input name="release" value="<?php echo $release; ?>" style="width:99%;height:25px;margin:0px 0px 10px 6px;border:1px solid #eee;-webkit-border-radius:3px;-mozkit-border-radius:3px;border-radius:3px;" />
		
		<p>Duration</p>
		
		<input name="duration" value="<?php echo $duration; ?>" style="width:99%;height:25px;margin:0px 0px 10px 6px;border:1px solid #eee;-webkit-border-radius:3px;-mozkit-border-radius:3px;border-radius:3px;" />
	</div>
	
	<div style="clear:both;"></div>
<?php
	}

function save_info_music() {
	global $post;
	update_post_meta($post->ID, "image", $_POST["image"]);
	update_post_meta($post->ID, "music", $_POST["music"]);
	update_post_meta($post->ID, "buy", $_POST["buy"]);
	update_post_meta($post->ID, "release", $_POST["release"]);
	update_post_meta($post->ID, "duration", $_POST["duration"]);
}
?>