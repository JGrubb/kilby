<?php include( TEMPLATEPATH . '/includes/options.php' ); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>	
	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/reset.css" type="text/css" />	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/screen.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print" />
	<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
	<!--[if gte IE 7]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" type="text/css" media="screen, projection" /><![endif]-->
	<!--[if lte IE 6]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" type="text/css" media="screen, projection" />
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/unitpngfix.js"></script><![endif]-->	
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php if ( $mb_subscribe_feed ) { echo $mb_subscribe_feed; } else { bloginfo('rss2_url'); } ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
	
	<?php wp_head(); ?>
	
</head>

<body<?php if ($mb_center) { echo ' class="centerit"'; } ?>>

	<!-- wrapper -->
	<div id="wrapper" style="background:url('<?php bloginfo('template_directory'); ?>/images/pattern-<?php echo $mb_bg_pattern; ?>.png') <?php echo $mb_bg_position; ?> repeat 50% 0;">
		<div id="wrapper-inner">
		
			<!-- sidebar-left -->
			<div id="sidebar-left">
				
				<?php if ($mb_photo_path) { ?><div id="photo"><a href="<?php bloginfo('home'); ?>"><img src="<?php echo $mb_photo_path; ?>" alt="<?php echo $mb_name_first; ?> <?php echo $mb_name_last; ?>" /><div id="photo-center" style="background:url('<?php echo $mb_photo_path; ?>') no-repeat 50% 0">&nbsp;</div><span>&nbsp;</span></a></div><?php } ?>
				
				<div id="nav">
					<?php mb_nav(); ?>
				</div>
				
				<ul id="social">
					<?php if ($mb_social_delicious) { ?><li id="social-delicious"><a href="<?php echo $mb_social_delicious; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/delicious.png" alt="" />Delicious</a></li><?php } ?>
					<?php if ($mb_social_digg) { ?><li id="social-digg"><a href="<?php echo $mb_social_digg; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/digg.png" alt="" />Digg</a></li><?php } ?>
					<?php if ($mb_social_facebook) { ?><li id="social-facebook"><a href="<?php echo $mb_social_facebook; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/facebook.png" alt="" />Facebook</a></li><?php } ?>
					<?php if ($mb_social_flickr) { ?><li id="social-flickr"><a href="<?php echo $mb_social_flickr; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/flickr.png" alt="" />Flickr</a></li><?php } ?>
					<?php if ($mb_social_friendfeed) { ?><li id="social-friendfeed"><a href="<?php echo $mb_social_friendfeed; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/friendfeed.png" alt="" />Friendfeed</a></li><?php } ?>
					<?php if ($mb_social_lastfm) { ?><li id="social-lastfm"><a href="<?php echo $mb_social_lastfm; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/lastfm.png" alt="" />Last.fm</a></li><?php } ?>
					<?php if ($mb_social_linkedin) { ?><li id="social-linkedin"><a href="<?php echo $mb_social_linkedin; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/linkedin.png" alt="" />LinkedIn</a></li><?php } ?>
					<?php if ($mb_social_mixx) { ?><li id="social-mixx"><a href="<?php echo $mb_social_mixx; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/mixx.png" alt="" />Mixx</a></li><?php } ?>
					<?php if ($mb_social_myspace) { ?><li id="social-myspace"><a href="<?php echo $mb_social_myspace; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/myspace.png" alt="" />MySpace</a></li><?php } ?>
					<?php if ($mb_social_reddit) { ?><li id="social-reddit"><a href="<?php echo $mb_social_reddit; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/reddit.png" alt="" />Reddit</a></li><?php } ?>
					<?php if ($mb_social_stumbleupon) { ?><li id="social-stumbleupon"><a href="<?php echo $mb_social_stumbleupon; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/stumble.png" alt="" />Stumble Upon</a></li><?php } ?>
					<?php if ($mb_social_technorati) { ?><li id="social-technorati"><a href="<?php echo $mb_social_technorati; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/technorati.png" alt="" />Technorati</a></li><?php } ?>
					<?php if ($mb_social_tumblr) { ?><li id="social-tumblr"><a href="<?php echo $mb_social_tumblr; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/tumblr.png" alt="" />Tumblr</a></li><?php } ?>
					<?php if ($mb_social_twitter) { ?><li id="social-twitter"><a href="<?php echo $mb_social_twitter; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/twitter.png" alt="" />Twitter</a></li><?php } ?>
					<?php if ($mb_social_vimeo) { ?><li id="social-vimeo"><a href="<?php echo $mb_social_vimeo; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/vimeo.png" alt="" />Vimeo</a></li><?php } ?>
					<?php if ($mb_social_youtube) { ?><li id="social-youtube"><a href="<?php echo $mb_social_youtube; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/youtube.png" alt="" />YouTube</a></li><?php } ?>
				</ul>
				
				<div class="content">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar Left") ) : ?><?php endif; ?>
				</div>
				
				<div id="footer">
					<p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>.<br/>All Rights Reserved.</p>
					<p><a href="http://mattbrett.com">Designed &amp; Developed by Matt Brett</a></p>
					<p><a href="http://wordpress.org">Powered by WordPress</a></p>
				</div>
				
			</div>
			<!-- /sidebar-left -->
			
			<!-- sidebar-right -->
			<div id="sidebar-right" class="content">
			
				<!-- search -->
				<form id="search" method="get" action="<?php bloginfo('url'); ?>">
					<div>
						<input type="text" name="s" id="s" value="<?php the_search_query(); ?>" />
						<!--[if lte IE 6]><input type="submit" name="submit" id="submit" value="Search" /><![endif]-->
					</div>
				</form>
				<!-- /search -->
				
				<div id="subscribe">
					<ul>
						<li id="subscribe-feed"><a href="<?php if ($mb_subscribe_feed) echo $mb_subscribe_feed; else bloginfo('rss2_url'); ?>">Subscribe to My Feed</a></li>
						<?php if ($mb_subscribe_email) { ?><li id="subscribe-email"><a href="<?php echo $mb_subscribe_email; ?>">Get Email Updates</a></li><?php } ?>
					</ul>
				</div>