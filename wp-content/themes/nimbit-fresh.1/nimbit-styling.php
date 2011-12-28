<?php
$select = array(
"Arial" => "<option value=\"Arial,Arial,Helvetica,sans-serif\">Arial</option>",
"Arial Black" => "<option value=\"Arial Black,Arial Black,Gadget,sans-serif\">Arial Black</option>",
"Comic Sans MS" => "<option value=\"Comic Sans MS,Comic Sans MS,cursive\">Comic Sans MS</option>",
"Courier New" => "<option value=\"Courier New,Courier New,Courier,monospace\">Courier New</option>",
"Georgia" => "<option value=\"Georgia,Georgia,serif\">Georgia</option>",
"Impact" => "<option value=\"Impact,Charcoal,sans-serif\">Impact</option>",
"Lucida Console" => "<option value=\"Lucida Console,Monaco,monospace\">Lucida Console</option>",
"Palatino Linotype" => "<option value=\"Palatino Linotype,Book Antiqua,Palatino,serif\">Palatino Linotype</option>",
"Tahoma" => "<option value=\"Tahoma,Geneva,sans-serif\">Tahoma</option>",
"Times New Roman" => "<option value=\"Times New Roman,Times,serif\">Times New Roman</option>",
"Trebuchet MS" => "<option value=\"Trebuchet MS,Helvetica,sans-serif\">Trebuchet MS</option>",
"Verdana" => "<option value=\"Verdana,Geneva,sans-serif\">Verdana</option>");

$piecesone = explode(",", get_option('nimbitfresh_headerfont'));
$pieces = explode(",", get_option('nimbitfresh_mainfont'));


?><div class="wrap ngg-wrap"> 
	<div id="dashboard-widgets-wrap" class="ngg-overview"> 
		<div id="dashboard-widgets" class="metabox-holder"> 
			<div id="post-body"> 
				<div id="dashboard-widgets-main-content"> 
					<div class="postbox-container" style="width:49%;"> 
						<div id="left-sortables" class="meta-box-sortables">
							<div id="dashboard_right_now" class="postbox " > 
								<div class="handlediv" title="Click to toggle"><br /></div>
								<h3 class='hndle'><span>Nimbit Fresh Theme Styling Page</span></h3> 
								<div class="inside"> 
									<form method="post" action="options.php"><?php wp_nonce_field('update-options');
									?><h2>Header and Menu</h2>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Site Title Color: <input type="color" name="nimbitfresh_headercolor" hex="true" value="<?php echo get_option('nimbitfresh_headercolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Site Title Font: <select name="nimbitfresh_headerfont"><?php
										print($select[$piecesone[0]]);
										foreach($select as $n=>$sel){
											if($n != $piecesone[0]){
												print $select[$n];
											}
										}										
									?></select></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Menu Background Color: <input type="color" name="nimbitfresh_menubgcolor" hex="true" value="<?php echo get_option('nimbitfresh_menubgcolor') ?>"/></p>
								<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Menu Link Color: <input type="color" name="nimbitfresh_navcolor" hex="true" value="<?php echo get_option('nimbitfresh_navcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <strong>NOTE:</strong> if you want to change your header image you can do it <a href="<?php echo get_bloginfo('wpurl'); ?>/wp-admin/themes.php?page=custom-header">here</a>.</p>
									<h2>Body</h2>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Body Background Color: <input type="color" name="nimbitfresh_bodybgcolor" hex="true" value="<?php echo get_option('nimbitfresh_bodybgcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Body Border Color: <input type="color" name="nimbitfresh_bodybordercolor" hex="true" value="<?php echo get_option('nimbitfresh_bodybordercolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Blog Post Title Color: <input type="color" name="nimbitfresh_titlecolor" hex="true" value="<?php echo get_option('nimbitfresh_titlecolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Main Text Color: <input type="color" name="nimbitfresh_textcolor" hex="true" value="<?php echo get_option('nimbitfresh_textcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Main Text Font: <select name="nimbitfresh_mainfont"><?php
										print($select[$pieces[0]]);
										foreach($select as $n=>$sel){
											if($n != $pieces[0]){
												print $select[$n];
											}
										}									
									?></select></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Link Color: <input type="color" name="nimbitfresh_linkcolor" hex="true" value="<?php echo get_option('nimbitfresh_linkcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <strong>NOTE:</strong> if you want to change the website background color or background image you can do so <a href="<?php echo get_bloginfo('wpurl'); ?>/wp-admin/themes.php?page=custom-background">here</a>.</p>
									<h2>Sidebar</h2>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sidebar Background Color: <input type="color" name="nimbitfresh_sidebarbgcolor" hex="true" value="<?php echo get_option('nimbitfresh_sidebarbgcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sidebar Title Color: <input type="color" name="nimbitfresh_sbtitlecolor" hex="true" value="<?php echo get_option('nimbitfresh_sbtitlecolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sidebar Text Color: <input type="color" name="nimbitfresh_sbtextcolor" hex="true" value="<?php echo get_option('nimbitfresh_sbtextcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sidebar Link Color: <input type="color" name="nimbitfresh_sblinkcolor" hex="true" value="<?php echo get_option('nimbitfresh_sblinkcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Search Button Color: <input type="color" name="nimbitfresh_searchbgcolor" hex="true" value="<?php echo get_option('nimbitfresh_searchbgcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Search Text Color: <input type="color" name="nimbitfresh_searchtextcolor" hex="true" value="<?php echo get_option('nimbitfresh_searchtextcolor') ?>"/></p>
									
									
									
									<input type="hidden" name="action" value="update" />
									<input type="hidden" name="page_options" value="nimbitfresh_bodybgcolor,nimbitfresh_bodybordercolor,nimbitfresh_sidebarbgcolor,nimbitfresh_menubgcolor,nimbitfresh_titlecolor, nimbitfresh_headercolor, nimbitfresh_headerfont, nimbitfresh_navcolor, nimbitfresh_textcolor, nimbitfresh_mainfont, nimbitfresh_linkcolor, nimbitfresh_sbtitlecolor, nimbitfresh_sblinkcolor, nimbitfresh_sbtextcolor, nimbitfresh_searchbgcolor, nimbitfresh_searchtextcolor" />
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="<?php _e('Save Styling') ?>" /></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
