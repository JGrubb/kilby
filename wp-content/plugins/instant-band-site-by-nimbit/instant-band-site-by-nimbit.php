<?php
/*
 Plugin Name: Instant Band Site by Nimbit
 Plugin URI: http://wordpress.org/extend/plugins/instant-band-site-by-nimbit/
 Description: With the Nimbit Instant Band Site plug-in, it's easier than ever to create and maintain and artist website that provides the perfect showcase and storefront to connect with fans.
 Version: 0.2.6
 Author: Nimbit
 Author URI:
 License: GPL2
 
 Copyright 2010 Sarah Sprague of Nimbit (email : sarah@nimbit.com)
 This file is part of Instant Band Sites by Nimbit.
 
 Instant Band Site by Nimbit is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 2 of the License, or
 (at your option) any later version.

 Instant Band Site by Nimbit is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Instant Band Site by Nimbit.  If not, see <http://www.gnu.org/licenses/>.
*/

/*
 IMPORTANT: 
 IF YOU WANT TO EDIT YOUR NIMBIT CONTENT TOOLS YOU CANNOT DO IT HERE
 YOU MUST SIGN INTO YOUR NIMBIT ACCOUNT AND EDIT THE CONTENT IN YOUR DASHBOARD
*/

/* function : if the user is an admin then set up Nimbit admin menu
*/

require_once 'common.php';

if ( is_admin() ){
	//Call the html code 
	add_action('admin_menu', 'nimbit_admin_menu');

	// Call the Plugin Interface Page Code
	add_action('admin_menu', 'nimbit_admin_menu');

	//create Nimbit admin menu
	function nimbit_admin_menu() {
		add_menu_page('Nimbit', 'Nimbit', 'administrator', 'nimbit-admin', 'nimbit_plugin_page', plugins_url($path = '/instant-band-site-by-nimbit').'/images/whitelogo.jpg');
		add_submenu_page( 'nimbit-admin', 'Install / Reset Nimbit Storefront', 'Install / Reset' , 'administrator', 'nimbit-admin');
		add_submenu_page( 'nimbit-admin', 'Nimbit Storefront Style', 'Storefront Style' , 'administrator', 'nimbit-mystore-style', 'nimbit_mystore_style');
		add_submenu_page( 'nimbit-admin', 'Advanced Style', 'Advanced Style' , 'administrator', 'nimbit-advanced', 'nimbit_advanced');
		//add_submenu_page( 'nimbit-admin', 'Nimbit Storefront Style', 'Storefront Style' , 'administrator', 'admin.php?page=instant-band-site-by-nimbit/nimbit_style.php');
		//add_submenu_page( 'nimbit-admin', 'nimbit-dash', 'Nimbit Dash' , 'administrator', 'nimbit-dash', 'nimbit_dash');
	}
}


add_action('wp_dashboard_setup', 'nimbit_wp_dashboard_setup');

// define and install hook to update installed store configuration
//
function nimbit_update_store($unknown_arg1 = '', $unknown_arg2 = '')
{
  nimbit_update_post('MyStore');
}
//
foreach (nimbit_store_options(true) as $option) add_action("update_option_$option", 'nimbit_update_store');

/**
 * add Dashboard Widget via function wp_add_dashboard_widget()
 */
function nimbit_wp_dashboard_setup() {
	wp_add_dashboard_widget( 'nimbit_wp_dashboard', __( 'Nimbit Plugin' ), 'nimbit_wp_dashboard' );
}

/**
 * Content of Dashboard-Widget
 */
function nimbit_wp_dashboard() {
	require('nimbit-dash.php');
}


/* input : title and content of page you would like to create
   output : none
   function : this function is called once the user checks which
   pages they would like to create.  It checks to make sure that
   Nimbit hasn't already created the same page for the user first
*/
function create_given_page($pagetitle, $pagecontent){
	//check if they already have this Nimbit page
	$arguments = array();
	$arguments['meta_key']= 'pagetype';
	$arguments['meta_value']= 'nimbitplug';
	$results = get_pages($arguments);
	$check = 0;
	if(!empty($results)){
		foreach($results as $res){
			$meta_value = get_post_meta($res->ID, 'pagename', true);
			if($meta_value == $pagetitle){
				$check = 1;
			}
		}
	}
	if ($check==0){ //if this page doesn't already exist then create page 
		//create page object
		$given_page = array();
		$given_page['comment_status'] = ($pagetitle == 'MyStore' || $pagetitle == 'Store') ? 'closed' : 'open';
		$given_page['post_content'] = trim($pagecontent)."\n";
		$given_page['post_status'] = 'publish';
		$given_page['post_title'] = $pagetitle;
		$given_page['post_type'] = 'page';
		//insert page
		$page_id = wp_insert_post($given_page);
		//create custom field in order to be able to check later
		add_post_meta($page_id, 'pagetype', 'nimbitplug');
		add_post_meta($page_id, 'pagename', $pagetitle);
		//maintain mapping from page name/title to id
		set_option("nimbit_page_ids_$pagetitle", $page_id);
	}
}

/* function : is called when plugin is activated and creates
   username and artist options so can be remembered inbetween 
   sessions by the DB
*/
function nimbit_install() {
	//Creates new database field via set_option function in common.php
	set_option('nimbit_pages', 'nopages', 'yes');
	set_option('nimbit_page', '', 'yes');
	set_option("nimbit_username", 'username', 'yes');
	set_option('nimbit_artist', 'yourartist', 'yes');
}
//call nimbit_install when plugin activated
register_activation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php','nimbit_install');

/* function : is called when plugin is deactivated and deletes the
   username and artist options that were created by plugin
   on activation
*/
function nimbit_remove() {
	//Deletes the database fields
	delete_options();
}
//call nimbit_remove when plugin deactivated
register_deactivation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', 'nimbit_remove' );

function image_size_input($size, $checked)
{
  $checked = $checked ? 'checked="true"' : '';

  $pixels = $size.'px';

  return <<<EOT
<input type="radio" name="nimbit_image_size" value="$size" $checked> $pixels
EOT;
}

function nimbit_mystore_style()
{
  strlen($nimbit_image_size  = get_option('nimbit_image_size')) or $nimbit_image_size = 300;

  $nimbit_transparency_color = get_option('nimbit_transparency_color');

  if ($custom_css = get_option('nimbit_custom_css'))
  {
    if (trim($custom_css) != trim(nimbit_store_css()))
    {
      $warning = "After saving these settings, please review your custom css in the advanced style tab. &nbsp;It may prevent them from taking effect.";
    }
  }

?>
<div class="wrap">

<h2 style="border-bottom:1px solid #CCCCCC;padding-bottom:0;"><a class="nav-tab nav-tab-active" href="admin.php?page=nimbit-mystore-style">Nimbit Storefront Style</a><a class="nav-tab" href="admin.php?page=nimbit-advanced">Advanced Style</a></h2>

<form method="post" action="options.php" style="border-left:1px solid #cccccc;padding-left:10px;">
<div style="padding:10px 10px 0px 10px;color:maroon;font-weight:bold;"><script>if (document.location.search && document.location.search.match(/updated/)) document.write('Your settings have been saved.');</script>&nbsp;</div>
<?php wp_nonce_field('update-options'); ?>
<table class="form-table">

<tr valign="top">
   <th scope="row">Image Size</th>
   <td width="120"><?php echo image_size_input( 50,  50 == $nimbit_image_size); ?></td>
   <td><?php echo image_size_input(350, 350 == $nimbit_image_size); ?></td>
</tr>

<tr valign="top">
   <th scope="row"></th>
   <td><?php echo image_size_input(100, 100 == $nimbit_image_size); ?></td>
   <td><?php echo image_size_input(400, 400 == $nimbit_image_size); ?></td>
</tr>

<tr valign="top">
   <th scope="row"></th>
   <td><?php echo image_size_input(150, 150 == $nimbit_image_size); ?></td>
   <td><?php echo image_size_input(450, 450 == $nimbit_image_size); ?></td>
</tr>

<tr valign="top">
   <th scope="row"></th>
   <td><?php echo image_size_input(200, 200 == $nimbit_image_size); ?></td>
   <td><?php echo image_size_input(500, 500 == $nimbit_image_size); ?></td>
</tr>

<tr valign="top">
   <th scope="row"></th>
   <td><?php echo image_size_input(250, 250 == $nimbit_image_size); ?></td>
   <td><?php echo image_size_input(550, 550 == $nimbit_image_size); ?></td>
</tr>

<tr valign="top">
   <th scope="row"></th>
   <td><?php echo image_size_input(300, 300 == $nimbit_image_size); ?></td>
   <td><?php echo image_size_input(600, 600 == $nimbit_image_size); ?></td>
</tr>

<tr valign="top">
<th scope="row"></th>
<td colspan="2">&nbsp;</td>
</tr>

<tr valign="top">
<th scope="row">Transparency</th>
<td colspan="2"><input type="radio" name="nimbit_transparency_color" value="#ffffff" <?php echo $nimbit_transparency_color == '#ffffff' ? 'checked="true"' : ''; ?> /> Light (with semi-transparent white background)</td>
</tr>

<tr valign="top">
<th scope="row"></th>
<td colspan="2"><input type="radio" name="nimbit_transparency_color" value="#000000" <?php echo $nimbit_transparency_color == '#000000' ? 'checked="true"' : ''; ?> /> Dark (with semi-transparent black background)</td>
</tr>

<tr valign="top">
<th scope="row"></th>
<td colspan="2"><input type="radio" name="nimbit_transparency_color" value="" <?php echo $nimbit_transparency_color == '' ? 'checked="true"' : ''; ?> /> Clear (with no background)</td>
</tr>

</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="nimbit_image_size,nimbit_transparency_color" />

<h3><?php echo $warning; ?></h3>
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
<?php
}

function nimbit_advanced()
{
  $nimbit_custom_css = get_option('nimbit_custom_css') or $nimbit_custom_css = nimbit_store_css();

?>
<div class="wrap">

<h2 style="border-bottom:1px solid #CCCCCC;padding-bottom:0;"><a class="nav-tab" href="admin.php?page=nimbit-mystore-style">Nimbit Storefront Style</a><a class="nav-tab nav-tab-active" href="admin.php?page=nimbit-advanced">Advanced Style</a></h2>

<form method="post" action="options.php" style="border-left:1px solid #cccccc;padding-left:10px;">
<div style="padding:10px 10px 0px 10px;color:maroon;font-weight:bold;"><script>if (document.location.search && document.location.search.match(/updated/)) document.write('Your css has been saved.');</script>&nbsp;</div>
<?php wp_nonce_field('update-options'); ?>

<table class="form-table">

<tr valign="top">
<th scope="row">&nbsp;Custom CSS &nbsp; &nbsp; &nbsp; &nbsp;<span style="color:maroon;font-weight:bold;">We plan many updates in the near future. &nbsp;Beware that custom changes could be unusable with future upgrades.</span></th>
</tr>
<tr>
<td><textarea name="nimbit_custom_css" style="width:94%;height:318px"><?php echo $nimbit_custom_css; ?></textarea></td>
</tr>

</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="nimbit_custom_css" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
<input type="submit" class="button-primary" value="<?php _e('Reset Stylesheet') ?>" onclick="if (confirm('Are you sure you want to reset the stylesheet?')) this.form.nimbit_custom_css.value=''; else return false;" />
</p>

</form>
</div>
<?php
}

/* function : create main plugin page
*/

function nimbit_plugin_page() {
	print('<div class="wrap">');
	print('<h2 style="border-bottom:1px solid #CCCCCC;padding-bottom:0;"><a class="nav-tab nav-tab-active" href="admin.php?page=nimbit-admin">Create Your Site</a></h2>');

	//called when a user wants to change Nimbit username and delete all Nimbit pages to start over
	if(isset($_POST['reset'])){
		update_username_option();
		$arguments = array();
		$arguments['meta_key']= 'pagetype';
		$arguments['meta_value']= 'nimbitplug';
		$results = get_pages($arguments);
		foreach ($results as $page){
			wp_delete_post($page->ID, $force_delete = false);
		}
	}

	if(isset($_POST['change'])){ //clear nimbit username
		update_username_option();
	}

	echo '<div style="border-left:1px solid #CCCCCC;padding:10px;">';
	
	//if a nimbit username hasn't been entered yet 
	//then display text box for user to enter it
	if(get_option('nimbit_username')=='username'){?><div id="poststuff"> 
	<p><strong>Once you are done you will have combined the smartest website software with the best music business platform.</strong></p>
	<div class="postbox"> 
		    <h3 class="hndle"><span>Connect Your Nimbit Account</span></h3> 
		    <div class="inside">
		<form method="post" action="options.php"><?php wp_nonce_field('update-options'); 
		?>
    <table>
		<tr>
			<td colspan="2"><strong>Step 1</strong></td>
		</tr>
		<tr id="host1" style="visibility:collapse;display:none">
		   <td>Enter the Nimbit Music Host:</td>
		   <td><input name="nimbitmusic_host" type="text" id="nimbitmusic_host" value="<?php echo nimbitmusic_host(); ?>" style="width:200px" /></td>
		</tr>
		<tr id="host2" style="visibility:collapse;display:none">
		   <td>Enter the Nimbit Dash Host:</td>
		   <td><input name="dashboard_host" type="text" id="dashboard_host" value="<?php echo dashboard_host(); ?>" style="width:200px" /></td>
		</tr>
		<tr>
			<td width="200">Enter Your Nimbit Username:</td>
			<td nowrap="on"><input name="nimbit_username" type="text" id="nimbit_username" value="<?php echo get_option('nimbit_username'); ?>" style="width:200px" onfocus="this.select()" />

			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="nimbit_username" />

			<input class='button-primary' type="submit" value="<?php _e('Continue') ?>" onclick="return handle_submit(event, this.form)"/>
		        <script>

function handle_submit(evt, form)
{
  if ((evt = evt || window.event || window.Event) && evt.shiftKey)
  {
    var s1 = document.getElementById('host1').style;
    var s2 = document.getElementById('host2').style;

    s1.display = s1.visibility = s2.display = s2.visibility = '';

    var e = form.elements['page_options'];

    if (!e.value.match(/nimbitmusic_host/)) e.value += ',nimbitmusic_host';
    if (!e.value.match(  /dashboard_host/)) e.value += ',dashboard_host';

    return false;
  }
}
		        </script>
      &nbsp;
			Sign up for a free Nimbit account <a href="http://www.nimbit.com/instant-band-site-login/">here</a>.
			</td>
		</tr>
		</table>
		</p>
		</form>
		</div>
	</div><?php
	}else{//otherwise give them the option to change their username and select which artist they would like
	if(get_option('nimbit_artist')=='yourartist'){//if haven't chosen artist yet
		print('<p><strong>Once you are done you will have combined the smartest website software with the best music business platform.</strong></p><div id="poststuff"> 
	<div class="postbox"> 
		    <h3 class="hndle"><span>Connect Your Nimbit Account</span></h3> 
		    <div class="inside"><table><tr><td width="100"><strong>Step 1</strong></td></tr><tr><td width="300">Your Nimbit username is ');
?><strong><?php print(get_option('nimbit_username')); ?></strong>.</td>
		<form action='admin.php?page=nimbit-admin' method='post'>
		<input type="hidden" name='change' value='true' />
		<td><input class="button-primary" type="submit" value="change username" /></td>
		</tr>
		</form>
		</table><?php
		//finds artist names associated with Nimbit username
		$bandname = get_option('nimbit_username');
		$jsonurl = 'http://'.nimbitmusic_host().'/nrp/foldername.php?partner=myspace&username='.$bandname.'';
		$json = nimbit_fetch($jsonurl);
		$jsonresult = json_decode($json, true);
		$count = 0;
		$artistname = array();
		$dirname = array();
		$skin = array();
		$plan = array();
		foreach ($jsonresult as $key => $value){
			$artistname[$count] = $value['artist_name'];
			$dirname[$count] = $value['dirname'];
			$skin[$value['dirname']] = $value['skin'];
			$plan[$value['dirname']] = $value['plan'];
			$name[$value['dirname']] = $value['artist_name'];
			$count++;
		}
		if($count > 0){ //if there are artists associated with this username then create drop down menu
		?><form method="post" action="options.php"><?php
		wp_nonce_field('update-options'); ?><table>
			<tr>
				<td width="100"><strong>Step 2</strong></td>
			</tr>
			<tr>
				<td width="100" scope="row">Select Your Artist:</td>
				<td width="200"><select name="nimbit_artist" id="nimbit_username"><?php
				foreach($artistname as $a => $artist){
					?><option value="<?php print($dirname[$a]);?>"><?php print($artist); ?></option><?php
				}
				?></select></td>
				<td>
				      <input type="hidden" name="action" value="update" />
				      <input type="hidden" name="page_options" value="nimbit_artist,nimbit_skin,nimbit_plan,nimbit_name" />
				      <input type="hidden" name="nimbit_skin" />
				      <input type="hidden" name="nimbit_plan" />
				      <input type="hidden" name="nimbit_name" />
				      <input class="button-primary" type="submit" value="<?php _e('continue') ?>" onclick="update_skin(this.form)"/>
				      <script>

var artist_skin = <?php echo json_encode($skin); ?>;
var artist_plan = <?php echo json_encode($plan); ?>;
var artist_name = <?php echo json_encode($name); ?>;

function update_skin(form)
{
  var select  = form.elements['nimbit_artist'];
  var dirname = select.options[select.selectedIndex].value;

  form.elements['nimbit_skin'].value = window.artist_skin[dirname];
  form.elements['nimbit_plan'].value = window.artist_plan[dirname];
  form.elements['nimbit_name'].value = window.artist_name[dirname];
}
				      </script>
				      </td></tr>
				</table>
			</form>
		</div>
	</div>
</div><?php
		}else{ //if not inform user there are no artists
			print('</div></div></div><div id="poststuff"> 
	<div class="postbox"> 
		    <h3 class="hndle"><span>Sorry</span></h3> 
		    <div class="inside"><p id="alert_no_artist" ><strong>There are no activated artists associated with this username.</strong></p><p> You can either sign into your Nimbit dashboard to activate these accounts <a target="_blank" href="http://'.dashboard_host().'/dashboard/">here</a> or change the username above.</p></div></div></div>');
		}
		
	}else{//once the user has selected an artist and clicks continue they are brought to the main page where they can select what pages they want to create
		require('admin-page.php');
			}
	}

	echo '</div>';
}
	

/* resets nimbit_username option and nimbit_artist option
*/
function update_username_option(){
	set_option('nimbit_username' , 'username');
	set_option('nimbit_artist', 'yourartist');
	set_option('nimbit_pages', 'nopages');
}


/* input: the title of the page you are creating
   output: the content tag of the page you are creating
   function: generates content tags for given artist
   called upon activation
   IMPORTANT: CHANGING THESE CONTENT TAGS WILL NOT CHANGE YOUR NIMBIT CONTENT, IT WILL BREAK THEM
   IF YOU WOULD LIKE TO CHANGE THESE TAGS LOGIN TO YOUR NIMBIT DASHBOARD
*/
function nimbit_get_content($pagetitle){

	if ($pagetitle == 'MyStore') return nimbit_store_content();

	$bandname = get_option('nimbit_artist');
	$photo = '<script src="http://'.nimbitmusic_host().'/tags/javascript/artists/'.$bandname.'/photo/original/"></script>';
	$bio = '<p><script src="http://'.nimbitmusic_host().'/tags/javascript/artists/'.$bandname.'/profile"></script></p>';
	$calendar = '<script src="http://'.nimbitmusic_host().'/tags/javascript/artists/'.$bandname.'/calendar?nrt_mode=true&previous=-2&direction=1"></script>';
	$news = '<script src="http://'.nimbitmusic_host().'/tags/javascript/artists/'.$bandname.'/news"></script>';
	$skin = '<div id="embed_parent">
 <script src="http://'.nimbitmusic_host().'/nrp/includes/javascript/flashembed.js"></script>
 <script>expandedStore(\'embed_parent\', \'http://'.nimbitmusic_host().'/nes/'.$bandname.'/stores/ES\', 600, 600);</script>
 <noscript>
  <embed src=\'http://'.nimbitmusic_host().'/nes/'.$bandname.'/stores/ES\'
         pluginspage=\'http://www.macromedia.com/go/getflashplayer\' wmode=\'transparent\'
         allowScriptAccess=\'always\' type=\'application/x-shockwave-flash\' width=\'600\' height=\'600\'></embed>
 </noscript>
</div>';
	$content = array();
	$content['Store'] = $skin;
	$content['Events'] = $calendar;
	$content['Photos'] = '';
	$content['Bio'] = $photo.$bio;
	$content['News'] = $news;

	return nimbit_content_wrapper($pagetitle, $content[$pagetitle]);
}

//Nimbit Subscribe Widget
//error_reporting(E_ALL);
add_action("widgets_init", array('nimbit_subscribe', 'register'));
register_activation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_subscribe', 'activate'));
register_deactivation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_subscribe', 'deactivate'));
class nimbit_subscribe {
	function activate(){
		set_option('nimbit_subscribe', array('title'=>'Email Signup','subtitle'=>'enter a subtitle here'));
	}
	function deactivate(){
		delete_option('nimbit_subscribe');
	}
	
	function control(){
	$data = get_option('nimbit_subscribe');
	?><p>Title: <input name="nimbit_subscribe_title" type="text" value="<?php print $data['title']; ?>" /></p>
	  <p>Subtitle: <input name="nimbit_subscribe_subtitle" type="text" size="25" value="<?php print $data['subtitle']; ?>" /></p><?php
		if (isset($_POST['nimbit_subscribe_title'])){
			$data['title'] = attribute_escape($_POST['nimbit_subscribe_title']);
			set_option('nimbit_subscribe', $data);
		}if (isset($_POST['nimbit_subscribe_subtitle'])){
			$data['subtitle'] = attribute_escape($_POST['nimbit_subscribe_subtitle']);
			set_option('nimbit_subscribe', $data);
		}

	}
	
	function widget($args){
		$data = get_option('nimbit_subscribe');
	$username = get_option('nimbit_username');
	$dirname = get_option('nimbit_artist');
	$jsonurl = 'http://'.nimbitmusic_host().'/nrp/foldername.php?partner=myspace&username='.$username.'';
	$json = nimbit_fetch($jsonurl);
	$jsonresult = json_decode($json, true);
	$id;
	foreach ($jsonresult as $key => $value){
		if($value[dirname]==$dirname){
			$id = $value['artist_id'];
		}	
	}
		echo $args['before_widget'];
		echo $args['before_title'] . $data['title'] . $args['after_title'];
		$dirname = get_option('nimbit_artist');
		echo $data['subtitle'];
		echo '<style>.nmbt_js th { display:none }</style>
<script src="http://www.nimbitmusic.com/nrp/includes/javascript/email_signup/open_nmbt_form.js"></script>
<form id="nmbt_form" target="_blank" method="post" action="http://www.nimbitmusic.com/nrp/controllers/artist_subscriber.php">
<input type="hidden" name="artist_id" value="'.$id.'"/>
<input type="hidden" name="confirm"   value="1"/>
<input type="hidden" name="digital_id" />
<input type="hidden" name="hash"     />
<table cellpadding="1" cellspacing="1" border="0">
<td><input type="text"   name="email_address" placeholder="your email" style="width:120px;" id="nmbt_email"/></td>
<td><input type="submit" name="join" value="Join" style="width:60px;"  id="nmbt_join"/></td>
</tr>
</table>
</form>
<script src="wp-content/plugins/instant-band-site-by-nimbit/close_nmbt_form.js"></script>';

		echo $args['after_widget'];
	}
	function register(){
		register_sidebar_widget('Nimbit Email Signup', array('nimbit_subscribe', 'widget'));
		register_widget_control('Nimbit Email Signup', array('nimbit_subscribe', 'control'));
	}
}

//Nimbit Next Gig Widget
add_action("widgets_init", array('nimbit_nextgig', 'register'));
register_activation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_nextgig', 'activate'));
register_deactivation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_nextgig', 'deactivate'));
class nimbit_nextgig {
	function activate(){
		set_option('nimbit_nextgig', array('title'=>'Next Gig'));
	}
	function deactivate(){
		delete_option('nimbit_nextgig');
	}
	function control(){
	$data = get_option('nimbit_nextgig');
	?><p>Title: <input name="nimbit_nextgig_title" type="text" value="<?php print $data['title']; ?>" /></p><?php
		if (isset($_POST['nimbit_nextgig_title'])){
			$data['title'] = attribute_escape($_POST['nimbit_nextgig_title']);
			set_option('nimbit_nextgig', $data);
		}
	}
	function widget($args){
		$data = get_option('nimbit_nextgig');
		echo $args['before_widget'];
		echo $args['before_title'] . $data['title'] . $args['after_title'];
		$data = get_option('nimbit_artist');
		echo '<script src="http://'.nimbitmusic_host().'/tags/javascript/artists/'.$data.'/calendar?nrt_mode=true&previous=-2&upcoming=-1"></script>';
		echo $args['after_widget'];
	}
	function register(){
		register_sidebar_widget('Nimbit Next Gig', array('nimbit_nextgig', 'widget'));
		register_widget_control('Nimbit Next Gig', array('nimbit_nextgig', 'control'));
	}
}
//promo widget
add_action("widgets_init", array('nimbit_promo', 'register'));
register_activation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_promo', 'activate'));
register_deactivation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_promo', 'deactivate'));
class nimbit_promo {
	function activate(){
		set_option('nimbit_promo', array('title'=>'Promo Code','subtitle'=>'enter a subtitle here'));
	}
	function deactivate(){
		delete_option('nimbit_promo');
	}
	function control(){
	$data = get_option('nimbit_promo');
	?><p>Title: <input name="nimbit_promo_title" type="text" value="<?php print $data['title']; ?>" /></p>
	  <p>Subtitle: <input name="nimbit_promo_subtitle" type="text" size="25" value="<?php print $data['subtitle']; ?>" /></p><?php
		if(isset($_POST['nimbit_promo_title'])){
			$data['title'] = attribute_escape($_POST['nimbit_promo_title']);
			set_option('nimbit_promo', $data);
		}if(isset($_POST['nimbit_promo_subtitle'])){
			$data['subtitle'] = attribute_escape($_POST['nimbit_promo_subtitle']);
			set_option('nimbit_promo', $data);
		}
	}
	function widget($args){
	$data = get_option('nimbit_promo');
	$dirname = get_option('nimbit_artist');

		echo $args['before_widget'];
		echo $args['before_title'] . $data['title'] . $args['after_title'];
		echo $data['subtitle'];
		echo '<form method="post" action="http://'.nimbitmusic_host().'/nrp/controllers/download_card.php">
				<input type="hidden" name="dirname" value="'.$dirname.'"/>
				<input type="text" size="20" name="code" placeholder="promo code"/>
				<input type="submit" value="Redeem" />
			</form>';
		echo $args['after_widget'];
	}
	function register(){
		register_sidebar_widget('Nimbit Promo Code', array('nimbit_promo', 'widget'));
		register_widget_control('Nimbit Promo Code', array('nimbit_promo', 'control'));
	}
}
//facebook widget
add_action("widgets_init", array('nimbit_fb', 'register'));
register_activation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_fb', 'activate'));
register_deactivation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_fb', 'deactivate'));
class nimbit_fb {
	function activate(){
		set_option('nimbit_fb', array( 'option1'=>'Default value'));
	}
	function deactivate(){
		delete_option('nimbit_fb');
	}
	function control(){
	}
	function widget($args){
		echo $args['before_widget'];
		echo $args['before_title'] . '' . $args['after_title'];
		$data = get_option('nimbit_artist');
		echo '<iframe src="http://www.facebook.com/widgets/like.php?href='.get_bloginfo('wpurl').'"
        scrolling="no" frameborder="0"
        style="border:none; width:100%; height:30px"></iframe>
			</form>';
		echo $args['after_widget'];
	}
	function register(){
		register_sidebar_widget('Nimbit Facebook', array('nimbit_fb', 'widget'));
		register_widget_control('Nimbit Facebook', array('nimbit_fb', 'control'));
	}
}
//player widget
add_action("widgets_init", array('nimbit_player', 'register'));
register_activation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_player', 'activate'));
register_deactivation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_player', 'deactivate'));
class nimbit_player {
	function activate(){
		set_option('nimbit_player', array('option1'=>'yes'));
	}
	function deactivate(){
		delete_option('nimbit_player');
	}
	function control(){
		$data = get_option('nimbit_player');
		$checked = array('yes'=>'','no'=>'');
		if($data['option1']=='yes'){
			$checked['yes']='CHECKED';
			$checked['no']='';
		}else{
			$checked['no']='CHECKED';
			$checked['yes']='';
		}
		?>

<p>Installs a XSPF Player in the sidebar of your site. &nbsp;The player automatically accesses all of the music samples from your Nimbit catalog.</p><?php
	}	
	function widget($args){
	$artist = get_option('nimbit_artist');
	$data = get_option('nimbit_player');
		
	// create doctype
$dom = new DOMDocument("1.0");

// create root element
$root = $dom->createElement("playlist");
$dom->appendChild($root);
$dom->formatOutput=true;

// create version attribute node
$version = $dom->createAttribute("version");
$root->appendChild($version);

// create version attribute value node
$versionValue = $dom->createTextNode("1");
$version->appendChild($versionValue);

// create xmlns attribute node
$xmlns = $dom->createAttribute("xmlns");
$root->appendChild($xmlns);

// create xmlns attribute value node
$xmlnsValue = $dom->createTextNode("http://xspf.org/ns/0/");
$xmlns->appendChild($xmlnsValue);

// create title child element
$title = $dom->createElement("title");
$root->appendChild($title);

// create title text node
$titleText = $dom->createTextNode("Delta Generators");
$title->appendChild($titleText);

// create tracklist child element
$tracklist = $dom->createElement("trackList");
$root->appendChild($tracklist);

$songs = '';
		$url = 'http://'.nimbitmusic_host().'/artistdata/'.$artist.'/stores/PS/';
		$xml = simplexml_load_string(nimbit_fetch($url));

		$count = 0;
$resulttwo = $xml->xpath('//response/RecordCompany/Artist/Catalog/Product/SongTitles/SongTitle/Name');
$resultthree = $xml->xpath('//response/RecordCompany/Artist/Catalog/Product/SongTitles/SongTitle/SampleFile');
foreach($resultthree as $r => $result){
	$count++;
	// create track child element
	$track = $dom->createElement("track");
	$tracklist->appendChild($track);
	
	// create location child element
	$location = $dom->createElement("location");
	$track->appendChild($location);

	// create location text node
	$locationText = $dom->createTextNode('http://'.nimbitmusic_host().$resultthree[$r]);
	$location->appendChild($locationText);
	
	// create song title child element
	$songtitle = $dom->createElement("title");
	$track->appendChild($songtitle);

	// create song title text node
	$songtitleText = $dom->createTextNode($resulttwo[$r]);
	$songtitle->appendChild($songtitleText);
	}	

	// save tree to file
	$dom->save("wp-content/plugins/instant-band-site-by-nimbit/test.xspf");

	
	if(is_home()){
	$player_code='<object type="application/x-shockwave-flash" width="250" height="170"
					data="wp-content/plugins/instant-band-site-by-nimbit/xspf_player.swf?playlist_url=./wp-content/plugins/instant-band-site-by-nimbit/test.xspf&autoload=1&autoresume=1">
					<param name="movie" value="wp-content/plugins/instant-band-site-by-nimbit/xspf_player.swf?playlist_url=./wp-content/plugins/instant-band-site-by-nimbit/test.xspf&autoload=1&autoresume=1"/></object>';
	}else{
		$player_code='<object type="application/x-shockwave-flash" width="250" height="170"
					data="../wp-content/plugins/instant-band-site-by-nimbit/xspf_player.swf?playlist_url=../wp-content/plugins/instant-band-site-by-nimbit/test.xspf&autoload=1&autoresume=1">
					<param name="movie" value="../wp-content/plugins/instant-band-site-by-nimbit/xspf_player.swf?playlist_url=../wp-content/plugins/instant-band-site-by-nimbit/test.xspf&autoload=1&autoresume=1"/></object>';
	}
	echo $args['before_widget'];
    echo $args['before_title'] . '' . $args['after_title'];
	echo $player_code;
    echo $args['after_widget'];
	}
	function register(){
		register_sidebar_widget('Nimbit Player', array('nimbit_player', 'widget'));
		register_widget_control('Nimbit Player', array('nimbit_player', 'control'));
	}
}
//social networking
add_action("widgets_init", array('nimbit_social', 'register'));
register_activation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_social', 'activate'));
register_deactivation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_social', 'deactivate'));
class nimbit_social {
	function activate(){
		set_option('nimbit_social', array('title'=>'', 'twitter'=>'no', 'twitteruser'=>'', 'myspace'=>'no', 'myspaceuser'=>'', 'facebook'=>'no', 'facebookuser'=>'', 'youtube'=>'no', 'youtubeuser'=>''));
	}
	function deactivate(){
		delete_option('nimbit_social');
	}
	function control(){
		$data = get_option('nimbit_social');
		$twitter = array('yes'=>'','no'=>'');
		if($data['twitter']=='yes'){
			$twitter['yes']='CHECKED';
			$twitter['no']='';
		}else{
			$twitter['no']='CHECKED';
			$twitter['yes']='';
		}
		$myspace = array('yes'=>'','no'=>'');
		if($data['myspace']=='yes'){
			$myspace['yes']='CHECKED';
			$myspace['no']='';
		}else{
			$myspace['no']='CHECKED';
			$myspace['yes']='';
		}
		$facebook = array('yes'=>'','no'=>'');
		if($data['facebook']=='yes'){
			$facebook['yes']='CHECKED';
			$facebook['no']='';
		}else{
			$facebook['no']='CHECKED';
			$facebook['yes']='';
		}
		$youtube = array('yes'=>'','no'=>'');
		if($data['youtube']=='yes'){
			$youtube['yes']='CHECKED';
			$youtube['no']='';
		}else{
			$youtube['no']='CHECKED';
			$youtube['yes']='';
		}
		?><p>Title: <input type="text" name="nimbit_social_title" value="<?php print default_option($data['title'], 'Connect With Me'); ?>" /></p>
		<p>Which sites do you want to link to?</p><p><strong>Facebook: </strong><label>Yes<input name="nimbit_social_facebook" type="radio" value="yes"<?php print $facebook['yes']; ?>/></label>
		<label>No<input name="nimbit_social_facebook" type="radio" value="no"<?php print $facebook['no']; ?>/></label>http://facebook.com/<input size='10' type='text' name='nimbit_social_facebookuser' value="<?php print $data['facebookuser']; ?>"/></p>
		<p><strong>Twitter: </strong><label>Yes<input name="nimbit_social_twitter" type="radio" value="yes"<?php print $twitter['yes']; ?>/></label>
		<label>No<input name="nimbit_social_twitter" type="radio" value="no"<?php print $twitter['no']; ?>/></label>http://twitter.com/<input size='10' type='text' name='nimbit_social_twitteruser' value="<?php print $data['twitteruser']; ?>"/></p>
		<p><strong>MySpace: </strong><label>Yes<input name="nimbit_social_myspace" type="radio" value="yes"<?php print $myspace['yes']; ?>/></label>
		<label>No<input name="nimbit_social_myspace" type="radio" value="no"<?php print $myspace['no']; ?>/></label>http://myspace.com/<input size='10' type='text' name='nimbit_social_myspaceuser' value="<?php print $data['myspaceuser']; ?>"/></p>
		<p><strong>YouTube: </strong><label>Yes<input name="nimbit_social_youtube" type="radio" value="yes"<?php print $youtube['yes']; ?>/></label>
		<label>No<input name="nimbit_social_youtube" type="radio" value="no"<?php print $youtube['no']; ?>/></label>http://youtube.com/user/<input size='5' type='text' name='nimbit_social_youtubeuser' value="<?php print $data['youtubeuser']; ?>"/></p><?php
		if (isset($_POST['nimbit_social_twitter'])){
			$data['twitter'] = $_POST['nimbit_social_twitter'];
			$data['myspace'] = $_POST['nimbit_social_myspace'];
			$data['facebook'] = $_POST['nimbit_social_facebook'];
			$data['youtube'] = $_POST['nimbit_social_youtube'];
			$data['title'] = attribute_escape($_POST['nimbit_social_title']);
			$data['twitteruser'] = attribute_escape($_POST['nimbit_social_twitteruser']);
			$data['myspaceuser'] = attribute_escape($_POST['nimbit_social_myspaceuser']);
			$data['facebookuser'] = attribute_escape($_POST['nimbit_social_facebookuser']);
			$data['youtubeuser'] = attribute_escape($_POST['nimbit_social_youtubeuser']);
			set_option('nimbit_social', $data);
		}
	}	
	function widget($args){
	$data = get_option('nimbit_social');
	$twitter_code='';
	$myspace_code='';
	$facebook_code='';
	$youtube_code='';
	if($data['twitter']=='yes'){
		$twitter_code='<a href="http://twitter.com/'.$data['twitteruser'].'"><img src="'.plugins_url($path = '/instant-band-site-by-nimbit').'/images/twitter.png" /></a>';
	}
	if($data['myspace']=='yes'){
		$myspace_code='<a href="http://myspace.com/'.$data['myspaceuser'].'"><img src="'.plugins_url($path = '/instant-band-site-by-nimbit').'/images/myspace.png" /></a>';
	}
	if($data['facebook']=='yes'){
		$facebook_code='<a href="http://facebook.com/'.$data['facebookuser'].'"><img src="'.plugins_url($path = '/instant-band-site-by-nimbit').'/images/facebook.png" /></a>';
	}
	if($data['youtube']=='yes'){
		$youtube_code='<a href="http://youtube.com/user/'.$data['youtubeuser'].'"><img src="'.plugins_url($path = '/instant-band-site-by-nimbit').'/images/youtube.png" /></a>';
	}
	echo $args['before_widget'];
    echo $args['before_title'] . $data['title'] . $args['after_title'];
	echo $facebook_code.$twitter_code.$myspace_code.$youtube_code;
    echo $args['after_widget'];
	}
	function register(){
		register_sidebar_widget('Nimbit Social Sites', array('nimbit_social', 'widget'));
		register_widget_control('Nimbit Social Sites', array('nimbit_social', 'control'));
	}
}

require_once 'fp-widget.php';

?>