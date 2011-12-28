<?php require_once 'common.php';?>
<div class="wrap ngg-wrap" style="min-height:676px">
	<div id="dashboard-widgets-wrap" class="ngg-overview"> 
		<div id="dashboard-widgets" class="metabox-holder"> 
			<div id="post-body"> 
				<div id="dashboard-widgets-main-content" style="border-left:1px solid #CCCCCC;"> 
					<div class="postbox-container" style="width:49%;"> 
						<div id="left-sortables" class="meta-box-sortables">
							<div id="dashboard_right_now" class="postbox " > 
								<div class="handlediv" title="Click to toggle"><br /></div>
								<h3 class='hndle'><span>Your Site</span></h3> 
								<div class="inside" style="padding:12px;"> 
								<table>
									<tr>
										<td><strong>Step 1:</strong>  Your Nimbit Username is <strong><?php print(get_option('nimbit_username')); ?></strong>.<p></td>
									</tr>
									<tr>
										<td><strong>Step 2:</strong>  Your Nimbit Artist is: <strong><?php print(get_option('nimbit_name')); ?></strong>.</p></td>
									</tr>
									<tr>
										<td><strong>Step 3:</strong>  Select which pages you would like to create:</p></td>
									<tr>
									<tr>
									<td><strong>NOTE: "edit content" links take you to your Nimbit account to update information.</strong></td>
									</tr>
									</table>
									<table><?php
									
									//used to keep track of which pages should be set as checked in check box
									$checked = array('Store'=>'','Events'=>'','Photos'=>'','Bio'=>'','News'=>'');
									//used to keep track of ids of pages created
									$id = array('Store'=>'','Events'=>'','Photos'=>'','Bio'=>'','News'=>'');
									
									
									if(get_option('nimbit_pages')=='somepages'){
									//create the pages that were checked
										$pages = get_option('nimbit_page');
										if (is_array($pages)) foreach($pages as $page){
											$this_content = nimbit_get_content($page);
											create_given_page($page, $this_content);
											
										}
									
										//insert the pages that exist into the $checked and $id array
										$arguments = array();
										$arguments['meta_key']= 'pagetype';
										$arguments['meta_value']= 'nimbitplug';
										$results = get_pages($arguments);
										if(!empty($results)){
											foreach($results as $res){
												$page_id = $res->ID;
												$meta_value = get_post_meta($page_id, 'pagename', true);
												$checked[$meta_value]='checked';
												$id[$meta_value]=$page_id;
											}
										}
										print('<p style="color: #FF0000;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<strong>Your pages have been created.</strong></p>');
										update_option('nimbit_pages', 'nopages');
									}
									
									//delete page with given id
									if(isset($_GET['del'])){
										wp_delete_post($_GET['del'], $force_delete = false);
									}
									
									
									if(get_option('nimbit_pages')=='nopages'){
									$arguments = array();
									$arguments['meta_key']= 'pagetype';
									$arguments['meta_value']= 'nimbitplug';
									$results = get_pages($arguments);
									if(!empty($results)){
										foreach($results as $res){
											$page_id = $res->ID;
											$meta_value = get_post_meta($page_id, 'pagename', true);
											$checked[$meta_value]='checked';
											$id[$meta_value]=$page_id;
										}
									}
									
									}
									
								//below are the check boxes for each page
								//if the page already exists it is checked and disabled and a link to edit and delete show up next to it
								//the edit links take you to the Nimbit dashboard where you can edit that specific content tag
								//the delete links delete that specific page
								?><tr><td><form method="post" action="options.php"><?php wp_nonce_field('update-options');

foreach ($checked as $k=>$v) if ($v == 'checked') ${"disabled$k"} = 'disabled'; // assigns 'disabled' to variables of the form $disabled<pagename>, for example, $disabledStore

$linkMyStore = ' <a href="http://'.dashboard_host().'/dashboard/main/store_appearance.php">edit content</a> <a href="admin.php?page=nimbit-admin&del='.$id['MyStore'].'">delete</a>';
$linkStore   = ' <a href="http://'.dashboard_host().'/dashboard/main/store_appearance.php">edit content</a> <a href="admin.php?page=nimbit-admin&del='.$id['Store'].'">delete</a>';
$linkEvents  = ' <a href="http://'.dashboard_host().'/dashboard/main/events.php">edit content</a> <a href="admin.php?page=nimbit-admin&del='.$id['Events'].'"> delete</a>';
$linkPhotos  = ' <a href="admin.php?page=nimbit-admin&del='.$id['Photos'].'">delete</a>';
$linkBio     = ' <a href="http://'.dashboard_host().'/dashboard/main/basicinfo.php">edit content</a> <a href="admin.php?page=nimbit-admin&del='.$id['Bio'].'">delete</a>';
$linkNews    = ' <a href="http://'.dashboard_host().'/dashboard/main/news.php">edit content</a> <a href="admin.php?page=nimbit-admin&del='.$id['News'].'">delete</a>';
?>

<blockquote>
  <p><input type="checkbox" name="nimbit_page[]" checked value="MyStore" <?php echo $disabledMyStore; ?>/> Store Front - Nimbit MyStore<?php if ($disabledMyStore) echo $linkMyStore; ?></p>

<?php if (get_option('nimbit_skin')) { ?>

  <p><input type="checkbox" name="nimbit_page[]" checked value="Store"   <?php echo $disabledStore;   ?>/> Store Front - Nimbit Skin<?php if ($disabledStore) echo $linkStore; ?></p>
<?php } ?>

  <p><input type="checkbox" name="nimbit_page[]" checked value="Events"  <?php echo $disabledEvents;  ?>/> Events      <?php if ($disabledEvents) echo $linkEvents; ?></p>
  <p><input type="checkbox" name="nimbit_page[]" checked value="Photos"  <?php echo $disabledPhotos;  ?>/> Photos      <?php if ($disabledPhotos) echo $linkPhotos; ?></p>
  <p><input type="checkbox" name="nimbit_page[]" checked value="Bio"     <?php echo $disabledBio;     ?>/> Bio         <?php if ($disabledBio)    echo $linkBio;    ?></p>

<?php if (get_option('nimbit_plan') == 'platinum') { ?>

  <p><input type="checkbox" name="nimbit_page[]" checked value="News"    <?php echo $disabledNews;    ?>/> News        <?php if ($disabledNews)   echo $linkNews;   ?></p>
<?php } ?>
</blockquote>
								<input type="hidden" name="action" value="update" />
								<input type="hidden" name="nimbit_pages" value="somepages" />
								<input type="hidden" name="page_options" value="nimbit_pages,nimbit_page" />
								</td></tr></table><table>
								<tr><td width="170"><p><input class="button-primary" type="submit" value="<?php _e('Create Selected Pages') ?>" /></p>
								</td><td></form>
								<!--clicking reset resets the nimbit username and artist in the DB and deletes all Nimbit pages-->
								<form action='admin.php?page=nimbit-admin' method='post'>
								<input type="hidden" name="reset" value="true" />
								<input type="submit" class="button-primary" style="background: #FF0000; outline: #FF0000;" value="Delete All Pages" />
								</form>
								</td></tr>
								</table>
								<br/>
                <strong>Step 4: </strong> &nbsp;Drag new Nimbit widgets into your sidebar
								<blockquote>
								  <p><strong>Social Sites</strong> Widget</p>
								  <p><strong>Promotion Code</strong> Widget (Indie and Pro Accounts only) <a href="http://<?php echo dashboard_host() ;?>/dashboard/main/promo_offers.php">add/edit promo codes</a></p>
								  <p><strong>Standard Email Form</strong> Widget</p>
								  <p><strong>Next Gig</strong> Widget <a href="http://<?php echo dashboard_host() ;?>/dashboard/main/events.php">add/edit gigs</a></p>
								  <p><strong>Facebook Like</strong> Widget</p>
								  <p><strong>Music Player</strong> (Plays all samples from your Nimbit Catalog)</p>
							    <p><strong>Featured Product</strong> Widget</p>
								</blockquote>
								<a class="button-primary" href="widgets.php">Install Sidebar Widgets</a>
								<br/><br/>
								<p><strong>How to edit Nimbit content:</strong></p><p>
 Nimbit installed pages and widgets get their content automatically from your Nimbit account.&nbsp;
 If you have your Nimbit account open in another browser window, the edit links above will take you to the right pages to edit content.&nbsp;
 <a href="http://www.nimbit.com" target="_blank">Click here</a> to sign up for a Nimbit account, including NimbitFree.
								<br/><br/>
                <a href="http://www.nimbit.com/instant-band-site-login/" class="button-primary" style="background: #00CC00; outline: #00CC00;">Log into Nimbit</a>
								<br/><br/>
							</div> 
							</div> 
						</div>						
					</div>
					<div class="postbox-container" style="width:29%;"> 
							<div id="dashboard_right_now" class="postbox" > 
								<div class="handlediv" title="Click to toggle"><br /></div>
								<h3 class='hndle'><span>Like This Plugin?</span></h3> 
								<div class="inside"> 
									<p>If you like this plugin please rate it <a href="http://wordpress.org/extend/plugins/instant-band-site-by-nimbit/">here</a>!!</p>
								</div> 
						</div>						
					</div>
					<div class="postbox-container" style="width:29%;"> 
							<div id="dashboard_right_now" class="postbox" > 
								<div class="handlediv" title="Click to toggle"><br /></div>
								<h3 class='hndle'><span>Feedback</span></h3> 
								<div class="inside"> 
									<p>Fill out this short feedback survey <a href="http://content.nimbit.com/machform/view.php?id=25" title="Instant Band Site Feedback Form">here</a> 
									 and let us know any problems you ran into or any ideas you have for future features you would love
									 for us to add to the plugin!</p>
								</div> 
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
