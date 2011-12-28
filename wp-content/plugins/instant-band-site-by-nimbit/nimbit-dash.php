<?php require_once 'common.php';?>

<p><strong>With the Nimbit Instant Band Site plug-in, it's easier than ever to create and maintain and artist website that provides the perfect showcase and storefront to connect with fans.</strong></p>
		<p><strong style="color: green;">Your Pages</strong></p>
		<?php	
		$arguments = array();
		$arguments['meta_key']= 'pagetype';
		$arguments['meta_value']= 'nimbitplug';
		$results = get_pages($arguments);
		$count_pages = 0;
		if(!empty($results)){
		$edit_content = array('Music'=>'http://'.dashboard_host().'/dashboard/main/store_appearance.php','Gigs'=>'http://'.dashboard_host().'/dashboard/main/events.php',
		'Photos'=>'','Bio'=>'http://'.dashboard_host().'/dashboard/main/basicinfo.php','News'=>'http://'.dashboard_host().'/dashboard/main/news.php');
			print('<table>');
			foreach($results as $res){
				$page_id = $res->ID;
				$meta_value = get_post_meta($page_id, 'pagename', true);
				$count++;
				if($meta_value != 'Photos'){
					?><tr><td width="15"></td><td><?php print($res->post_title);?><a href="<?php print($edit_content[$res->post_title]); ?>">  edit content</a></td></tr><?php
				}else{
					?><tr><td width="15"></td><td><?php print($res->post_title);?><a href="upload.php">  add media</a></td></tr><?php
				}
			}
			print('</table>');
?><p><strong>NOTE:</strong>
 Nimbit installed pages and widgets get their content automatically from your Nimbit account.&nbsp;
 If you have your Nimbit account open in another browser window, the edit links above will take you to the right pages to edit content.&nbsp;
 <a href="http://www.nimbit.com" target="_blank">Click here</a> to sign up for a Nimbit account, including NimbitFree.
</p>
<?php
		}else{
			?><p>You have not set up any pages with your Nimbit content yet.  Click <a href='admin.php?page=nimbit-admin'>here</a> to get started.</p><?php
		}
		?>
		<a href="http://www.nimbit.com/instant-band-site-login/" class="button-primary" style="background: #00CC00; outline: #00CC00;">Log into Nimbit</a>
