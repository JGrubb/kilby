<div class="wrap ngg-wrap"> 
	<div id="dashboard-widgets-wrap" class="ngg-overview"> 
		<div id="dashboard-widgets" class="metabox-holder"> 
			<div id="post-body"> 
				<div id="dashboard-widgets-main-content"> 
					<div class="postbox-container" style="width:49%;"> 
						<div id="left-sortables" class="meta-box-sortables">
							<div id="dashboard_right_now" class="postbox " > 
								<div class="handlediv" title="Click to toggle"><br /></div>
								<h3 class='hndle'><span>Theme Styling Page</span></h3> 
								<div class="inside"> 
									<form method="post" action="options.php"><?php wp_nonce_field('update-options');
									?><p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Body Background Color: <input type="color" name="nimbitgrit_bodybgcolor" hex="true" value="<?php echo get_option('nimbitgrit_bodybgcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sidebar Background Color: <input type="color" name="nimbitgrit_sidebarbgcolor" hex="true" value="<?php echo get_option('nimbitgrit_sidebarbgcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Menu Background Color: <input type="color" name="nimbitgrit_menubgcolor" hex="true" value="<?php echo get_option('nimbitgrit_menubgcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Blog Post Title Color: <input type="color" name="nimbitgrit_titlecolor" hex="true" value="<?php echo get_option('nimbitgrit_titlecolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Site Title Color: <input type="color" name="nimbitgrit_headercolor" hex="true" value="<?php echo get_option('nimbitgrit_headercolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Site Title Font: <select name="nimbitgrit_headerfont">
										<option value='Arial,Arial,Helvetica,sans-serif'>Arial</option>
										<option value='Arial Black,Arial Black,Gadget,sans-serif'>Arial Black</option>
										<option value='Comic Sans MS,Comic Sans MS,cursive'>Comic Sans MS</option>
										<option value='Courier New,Courier New,Courier,monospace'>Courier New</option>
										<option value='Georgia,Georgia,serif'>Georgia</option>
										<option value='Impact,Charcoal,sans-serif'>Impact</option>
										<option value='Lucida Console,Monaco,monospace'>Lucida Console</option>
										<option value='Lucida Sans Unicode,Lucida Grande,sans-serif'>Lucida Sans Unicode</option>
										<option value='Palatino Linotype,Book Antiqua,Palatino,serif'>Palatino Linotype</option>
										<option value='Tahoma,Geneva,sans-serif'>Tahoma</option>
										<option value='Times New Roman,Times,serif'>Times New Roman</option>
										<option value='Trebuchet MS,Helvetica,sans-serif'>Trebuchet MS</option>
										<option value='Verdana,Geneva,sans-serif'>Verdana</option></select><?php 
										$piecesone = explode(",", get_option('nimbitgrit_headerfont'));
										print(' Your title\'s font is currently <strong>'.$piecesone[0].'</strong>.');
									?><p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Menu Link Color: <input type="color" name="nimbitgrit_navcolor" hex="true" value="<?php echo get_option('nimbitgrit_navcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Main Text Color: <input type="color" name="nimbitgrit_textcolor" hex="true" value="<?php echo get_option('nimbitgrit_textcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Main Text Font: <select name="nimbitgrit_mainfont">
										<option value='Arial,Arial,Helvetica,sans-serif'>Arial</option>
										<option value='Arial Black,Arial Black,Gadget,sans-serif'>Arial Black</option>
										<option value='Comic Sans MS,Comic Sans MS,cursive'>Comic Sans MS</option>
										<option value='Courier New,Courier New,Courier,monospace'>Courier New</option>
										<option value='Georgia,Georgia,serif'>Georgia</option>
										<option value='Impact,Charcoal,sans-serif'>Impact</option>
										<option value='Lucida Console,Monaco,monospace'>Lucida Console</option>
										<option value='Lucida Sans Unicode,Lucida Grande,sans-serif'>Lucida Sans Unicode</option>
										<option value='Palatino Linotype,Book Antiqua,Palatino,serif'>Palatino Linotype</option>
										<option value='Tahoma,Geneva,sans-serif'>Tahoma</option>
										<option value='Times New Roman,Times,serif'>Times New Roman</option>
										<option value='Trebuchet MS,Helvetica,sans-serif'>Trebuchet MS</option>
										<option value='Verdana,Geneva,sans-serif'>Verdana</option></select><?php 
										$pieces = explode(",", get_option('nimbitgrit_mainfont'));
										print(' Your title\'s font is currently <strong>'.$pieces[0].'</strong>.');
									?><p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Link Color: <input type="color" name="nimbitgrit_linkcolor" hex="true" value="<?php echo get_option('nimbitgrit_linkcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sidebar Title Color: <input type="color" name="nimbitgrit_sbtitlecolor" hex="true" value="<?php echo get_option('nimbitgrit_sbtitlecolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sidebar Link Color: <input type="color" name="nimbitgrit_sblinkcolor" hex="true" value="<?php echo get_option('nimbitgrit_sblinkcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Sidebar Text Color: <input type="color" name="nimbitgrit_sbtextcolor" hex="true" value="<?php echo get_option('nimbitgrit_sbtextcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Search Button Color: <input type="color" name="nimbitgrit_searchbgcolor" hex="true" value="<?php echo get_option('nimbitgrit_searchbgcolor') ?>"/></p>
									<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Search Text Color: <input type="color" name="nimbitgrit_searchtextcolor" hex="true" value="<?php echo get_option('nimbitgrit_searchtextcolor') ?>"/></p>
									<input type="hidden" name="action" value="update" />
									<input type="hidden" name="page_options" value="nimbitgrit_bodybgcolor,nimbitgrit_sidebarbgcolor,nimbitgrit_menubgcolor,nimbitgrit_titlecolor, nimbitgrit_headercolor, nimbitgrit_headerfont, nimbitgrit_navcolor, nimbitgrit_textcolor, nimbitgrit_mainfont, nimbitgrit_linkcolor, nimbitgrit_sbtitlecolor, nimbitgrit_sblinkcolor, nimbitgrit_sbtextcolor, nimbitgrit_searchbgcolor, nimbitgrit_searchtextcolor" />
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