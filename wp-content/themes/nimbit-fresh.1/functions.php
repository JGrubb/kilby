<?php

//add theme styling menu
function nimbit_styling_menu(){
add_submenu_page('themes.php', 'Nimbit Styling', 'Styling', 'administrator', 'nimbit-style', 'nimbit_style' );
}
add_action('admin_menu', 'nimbit_styling_menu');
//styling menu
function nimbit_style(){
	require('nimbit-styling.php');
}
//load the color picker jquery script
function nimbitcolor_init_method() {
    wp_enqueue_script('mcolorpicker', 'http://plugins.meta100.com/mcolorpicker/javascripts/mColorPicker_min.js');            
}    
 
add_action('init', 'nimbitcolor_init_method');
// Sidebar widget
 if(function_exists('register_sidebar'))
	  register_sidebar(array(
	  	'name' => 'Sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
 ));

// Custom menu
add_action( 'init', 'register_my_menu' );

function register_my_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
}
?>
<?php
define('HEADER_IMAGE', '%s/images/header.png'); // %s is theme dir uri, set a default image
define('HEADER_IMAGE_WIDTH', 960); //  Default image width is actually the div's height
define('HEADER_IMAGE_HEIGHT', 250);  // Same for height
define('NO_HEADER_TEXT', true );

function header_style() {
    //  This function defines the style for the theme
    //  You can change these selectors to match your theme
?>
<style type="text/css">
#header {
    background: url(<?php header_image() ?>) no-repeat;
    height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
    width:<?php echo HEADER_IMAGE_WIDTH; ?>px;
}
.post-wrap{
	background:<?php echo BODY_COLOR; ?>;
}
.navigation .alignleft{
	background:<?php echo BODY_COLOR; ?>;
}
#shadow {
	background-color: <?php echo SHADOW_COLOR; ?>;
}
#page-wrap{
	background:<?php echo SIDEBAR_COLOR; ?>;
}
#menulist{
	background:<?php echo MENU_COLOR; ?>;
}
.post h2 a {
	color:<?php echo TITLE_COLOR; ?>;
}
#content h2{
	color:<?php echo TITLE_COLOR; ?>;
}
#wrapper .title-description h1 a{
    color:<?php echo HEADER_TEXTCOLOR; ?>;
}
#wrapper .title-description h2{
    color:<?php echo HEADER_TEXTCOLOR; ?>;
}
#wrapper .title-description h1 a{
    font-family: <?php echo HEADER_FONT; ?>;
}
#wrapper .title-description h2{
	font-family: <?php echo HEADER_FONT; ?>;
}
#nav li a {
	color:<?php echo NAV_LINKCOLOR; ?>;
}
#content{
	color:<?php echo CONTENT_TEXTCOLOR; ?>;
}
a{
	color:<?php echo LINK_COLOR; ?>;
}
#sidebar ul li h2 {
	color:<?php echo WIDGET_TITLECOLOR; ?>;
}
#sidebar .widget_calendar table caption {
	color:<?php echo WIDGET_TITLECOLOR; ?>;
}
#sidebar a{
	color:<?php echo WIDGET_LINKCOLOR; ?>;
}
#sidebar ul li ul a {
	color:<?php echo WIDGET_LINKCOLOR; ?>;
}
#sidebar .widget_tag_cloud a{
	color:<?php echo WIDGET_LINKCOLOR; ?>;
}
#sidebar h2 a{
	color:<?php echo WIDGET_LINKCOLOR; ?>;
}
.widget{
	color:<?php echo WIDGET_TEXTCOLOR; ?>;
}
body, h2{
	font-family:<?php echo MAIN_FONT; ?>;
}
#sidebar #searchsubmit {
	background: <?php echo SEARCH_BGCOLOR; ?>;
	color:<?php echo SEARCH_TEXTCOLOR; ?>;
	border: 1px solid <?php echo SEARCH_BGCOLOR; ?>;
}
</style><?php 
} 
function admin_header_style() {
    //  This function styles the admin page
?><style type="text/css">
#headimg {
    background: url(<?php header_image() ?>) no-repeat;
    height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
    width:<?php echo HEADER_IMAGE_WIDTH; ?>px;
    padding:0 0 0 18px;
    font-family: arial;
}
#headimg h1 {
    padding-top:50px;
    margin: 0;
}
#headimg h1 a, #desc {
    text-decoration: none;
    border-bottom: none;
}
#desc {
    padding-top: 15px;
    margin-right: 30px;
}
</style><?php 
}
add_custom_image_header('header_style', 'admin_header_style');

// This theme allows users to set a custom background
add_custom_background();

//add these options when theme is installed
//the second parameter in the add_option function is the default value for the option
add_action('init','theme_install');
function theme_install(){
	add_option('nimbitfresh_bodybgcolor', '#000', 'yes');
	add_option('nimbitfresh_bodybordercolor', '#efefef', 'yes');
	add_option('nimbitfresh_sidebarbgcolor', '#000', 'yes');
	add_option('nimbitfresh_menubgcolor', '#000', 'yes');
	add_option('nimbitfresh_titlecolor', '#efefef', 'yes');
	add_option('nimbitfresh_headercolor', '#b7c3ff', 'yes');
	add_option('nimbitfresh_navcolor', '#efefef', 'yes');
	add_option('nimbitfresh_textcolor', '#efefef', 'yes');
	add_option('nimbitfresh_linkcolor', '#b7c3ff', 'yes');
	add_option('nimbitfresh_sbtitlecolor', '#efefef', 'yes');
	add_option('nimbitfresh_sblinkcolor', '#b7c3ff', 'yes');
	add_option('nimbitfresh_sbtextcolor', '#efefef', 'yes');
	add_option('nimbitfresh_headerfont', 'Verdana.Arial,Arial,Helvetica,sans-serif', 'yes');
	add_option('nimbitfresh_mainfont', 'Verdana,Arial,Helvetica,sans-serif',  'yes');
	add_option('nimbitfresh_searchbgcolor', '#efefef',  'yes');
	add_option('nimbitfresh_searchtextcolor', '#000',  'yes');
}
//defining nimbit theme options
$body_color = get_option('nimbitfresh_bodybgcolor');
define('BODY_COLOR', $body_color);
$shadow_color = get_option('nimbitfresh_bodybordercolor');
define('SHADOW_COLOR', $shadow_color);
$sidebar_color = get_option('nimbitfresh_sidebarbgcolor');
define('SIDEBAR_COLOR', $sidebar_color);
$menu_color = get_option('nimbitfresh_menubgcolor');
define('MENU_COLOR', $menu_color);
$title_color = get_option('nimbitfresh_titlecolor');
define('TITLE_COLOR', $title_color);
$header_color = get_option('nimbitfresh_headercolor');
define('HEADER_TEXTCOLOR', $header_color);
$nav_linkcolor = get_option('nimbitfresh_navcolor');
define('NAV_LINKCOLOR', $nav_linkcolor);
$content_textcolor = get_option('nimbitfresh_textcolor');
define('CONTENT_TEXTCOLOR', $content_textcolor);
$link_color = get_option('nimbitfresh_linkcolor');
define('LINK_COLOR', $link_color);
$widget_titlecolor = get_option('nimbitfresh_sbtitlecolor');
define('WIDGET_TITLECOLOR', $widget_titlecolor);
$widget_linkcolor = get_option('nimbitfresh_sblinkcolor');
define('WIDGET_LINKCOLOR', $widget_linkcolor);
$widget_textcolor = get_option('nimbitfresh_sbtextcolor');
define('WIDGET_TEXTCOLOR', $widget_textcolor);
$header_font = get_option('nimbitfresh_headerfont');
define('HEADER_FONT', $header_font);
$main_font = get_option('nimbitfresh_mainfont');
define('MAIN_FONT', $main_font);
$search_bgcolor = get_option('nimbitfresh_searchbgcolor');
define('SEARCH_BGCOLOR', $search_bgcolor);
$search_textcolor = get_option('nimbitfresh_searchtextcolor');
define('SEARCH_TEXTCOLOR', $search_textcolor);
?>