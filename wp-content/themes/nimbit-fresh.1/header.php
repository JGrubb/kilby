<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type='text/javascript'>
jQuery(document).ready(function() {
jQuery("#nav ul").css({display: "none"});
jQuery("#nav li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show();
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		});
});
</script>

<!--[if IE]>
<style type="text/css">
#menulist a:hover {
	background: gray;
}

</style>
<![endif]--> 
</head>
<body>

<div id="wrapper">
	<div id="shadow">

	<div id="toparea">
		<div id="header">
			<div class="title-description">
				<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
				<h2><?php bloginfo('description'); ?></h2>
			</div><!-- .title-description -->


		<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
			<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'primary-menu', 'container_id' => 'menulist', 'menu_id' => 'nav' ) ); ?>
		<?php } else { ?>
			<div id="menulist">
				<ul id="nav">
					<li><a href="<?php echo get_option('home'); ?>/">Home</a></li>
					<?php wp_list_pages('title_li='); ?>
				</ul>
			</div><!-- #menulist -->
		</div><!-- #header -->
		<?php } ?>	

	</div><!-- #toparea -->