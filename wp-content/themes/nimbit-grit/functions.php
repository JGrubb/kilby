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
//add these options when theme is installed
//the second parameter in the add_option function is the default value for the option
add_action('init','theme_install');
function theme_install(){
	add_option('nimbitgrit_bodybgcolor', '#fff', 'yes');
	add_option('nimbitgrit_sidebarbgcolor', '#fff', 'this is nimbit', 'yes');
	add_option('nimbitgrit_menubgcolor', 'transparent', 'this is nimbit', 'yes');
	add_option('nimbitgrit_titlecolor', '#000', 'this is nimbit', 'yes');
	add_option('nimbitgrit_headercolor', '#fff', 'this is nimbit', 'yes');
	add_option('nimbitgrit_navcolor', '#000', 'this is nimbit', 'yes');
	add_option('nimbitgrit_textcolor', '#000', 'this is nimbit', 'yes');
	add_option('nimbitgrit_linkcolor', '#505050', 'this is nimbit', 'yes');
	add_option('nimbitgrit_sbtitlecolor', '#000', 'this is nimbit', 'yes');
	add_option('nimbitgrit_sblinkcolor', '#505050', 'this is nimbit', 'yes');
	add_option('nimbitgrit_sbtextcolor', '#000', 'this is nimbit', 'yes');
	add_option('nimbitgrit_headerfont', 'Arial,Arial,Helvetica,sans-serif', 'this is nimbit', 'yes');
	add_option('nimbitgrit_mainfont', 'Arial,Arial,Helvetica,sans-serif', 'this is nimbit', 'yes');
	add_option('nimbitgrit_searchbgcolor', '#000',  'yes');
	add_option('nimbitgrit_searchtextcolor', '#fff',  'yes');
}
//delete these options when theme is switched
/*function theme_switch(){
	delete_option('nimbitgrit_bodybgcolor');
	delete_option('nimbitgrit_sidebarbgcolor');
	delete_option('nimbitgrit_menubgcolor');
	delete_option('nimbitgrit_titlecolor');
	delete_option('nimbitgrit_headercolor');
	delete_option('nimbitgrit_navcolor');
	delete_option('nimbitgrit_textcolor');
	delete_option('nimbitgrit_linkcolor');
	delete_option('nimbitgrit_sbtitlecolor');
	delete_option('nimbitgrit_sblinkcolor');
	delete_option('nimbitgrit_sbtextcolor');
	delete_option('nimbitgrit_headerfont');
	delete_option('nimbitgrit_mainfont');
}
add_action('switch_theme','theme_switch');
*/
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
//defining nimbit theme options
$body_color = get_option('nimbitgrit_bodybgcolor');
define('BODY_COLOR', $body_color);
$sidebar_color = get_option('nimbitgrit_sidebarbgcolor');
define('SIDEBAR_COLOR', $sidebar_color);
$menu_color = get_option('nimbitgrit_menubgcolor');
define('MENU_COLOR', $menu_color);
$title_color = get_option('nimbitgrit_titlecolor');
define('TITLE_COLOR', $title_color);
$header_color = get_option('nimbitgrit_headercolor');
define('HEADER_TEXTCOLOR', $header_color);
$nav_linkcolor = get_option('nimbitgrit_navcolor');
define('NAV_LINKCOLOR', $nav_linkcolor);
$content_textcolor = get_option('nimbitgrit_textcolor');
define('CONTENT_TEXTCOLOR', $content_textcolor);
$link_color = get_option('nimbitgrit_linkcolor');
define('LINK_COLOR', $link_color);
$widget_titlecolor = get_option('nimbitgrit_sbtitlecolor');
define('WIDGET_TITLECOLOR', $widget_titlecolor);
$widget_linkcolor = get_option('nimbitgrit_sblinkcolor');
define('WIDGET_LINKCOLOR', $widget_linkcolor);
$widget_textcolor = get_option('nimbitgrit_sbtextcolor');
define('WIDGET_TEXTCOLOR', $widget_textcolor);
$header_font = get_option('nimbitgrit_headerfont');
define('HEADER_FONT', $header_font);
$main_font = get_option('nimbitgrit_mainfont');
define('MAIN_FONT', $main_font);
$search_bgcolor = get_option('nimbitgrit_searchbgcolor');
define('SEARCH_BGCOLOR', $search_bgcolor);
$search_textcolor = get_option('nimbitgrit_searchtextcolor');
define('SEARCH_TEXTCOLOR', $search_textcolor);


define('HEADER_IMAGE', '%s/images/header.jpg'); // %s is theme dir uri, set a default image
define('HEADER_IMAGE_WIDTH', 960); //  Default image width is actually the div's height
define('HEADER_IMAGE_HEIGHT', 350);  // Same for height
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
    /* RGBa with 0.1 opacity */
    background: rgba(255, 255, 255, 0.1);
    /* For IE 5.5 - 7*/
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#19ffffff, endColorstr=#19ffffff);
    /* For IE 8*/
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#19ffffff, endColorstr=#19ffffff)";
}
#page-wrap{
	background:<?php echo SIDEBAR_COLOR; ?>;
    /* RGBa with 0.6 opacity */
    background: rgba(255, 255, 255, 0.6);
    /* For IE 5.5 - 7*/
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99ffffff, endColorstr=#99ffffff);
    /* For IE 8*/
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99ffffff, endColorstr=#99ffffff)";
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
#header h1 a, #desc {
    color:<?php echo HEADER_TEXTCOLOR; ?>;
}
#header h1 a{
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
body{
	font-family:<?php echo MAIN_FONT; ?>;
}
#sidebar #searchsubmit {
	background: <?php echo SEARCH_BGCOLOR; ?>;
	color:<?php echo SEARCH_TEXTCOLOR; ?>;
}
</style><?php 
} 
function admin_header_style() {
    //  This function styles the admin page
?>
<style type="text/css">
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
    color: #<?php header_textcolor() ?>;
    text-decoration: none;
    border-bottom: none;
}
#desc {
    padding-top: 15px;
    margin-right: 30px;
}
<?php if ( 'blank' == get_header_textcolor() ) { ?>
#headimg h1, #headimg #desc {
    display: none;
}
#headimg h1 a, #headimg #desc {
    color:#<?php echo HEADER_TEXTCOLOR ?>;
}
<?php } ?>
</style>
<?php
}
//add custom header
add_custom_image_header('header_style', 'admin_header_style');
// This theme allows users to set a custom background
add_custom_background();
?>