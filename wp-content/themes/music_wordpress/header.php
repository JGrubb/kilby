<?php
/* Built on the Starkers Reset Foundation */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
		<title><?php wp_title('&ndash;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/js/fancybox/jquery.fancybox-1.3.4.css"/>
		
		<link rel="shortcut icon" href="<?php echo stripslashes(get_option('mwt_fav_icon')); ?>" type="image/x-icon" />
		
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/ie/ie.css" />
		<![endif]-->
	
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
	
		<div id="header_wrapper">
			<div id="header">
			
				<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
				
				<?php if(!wp_nav_menus) : ?>
					<ul id="linkbar">
						<?php wp_list_pages('title_li='); ?>
					</ul>
				<?php else : ?> 
					<?php wp_nav_menu('menu=main&menu_id=linkbar'); ?>
				<?php endif; ?>
			</div>
		</div>
		
		<div id="content">
			<p id="flickr_feed_url" class="hidden_object"><?php echo stripslashes(get_option('mwt_flickr_feed')); ?></p>
			<p id="twitter_account" class="hidden_object"><?php echo stripslashes(get_option('mwt_twitter_account')); ?></p>