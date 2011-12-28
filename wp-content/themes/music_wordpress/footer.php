<?php ?>

	<div class="clear_div"></div>
	</div> <!-- End of Content Div -->

	<div id="footer">
		<div class="footer_section">
			<ul>
				<li><span class="important"><?php echo stripslashes(get_option('mwt_footer_title_one')); ?></span></li>
				<li><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></li>
			</ul>
		</div>
	
		<div class="footer_section">
			<ul>
				<li><span class="important"><?php echo stripslashes(get_option('mwt_footer_title_two')); ?></span></li>
				<?php wp_list_pages('title_li=&depth=-1'); ?>
			</ul>
		</div>
		
		<div class="footer_section">
			<ul>
				<li><span class="important"><?php echo stripslashes(get_option('mwt_footer_title_three')); ?></span></li>
				<?php wp_list_bookmarks('title_li=&categorize=&category_name=Social Networking'); ?>
			</ul>
		</div>
			
		<div class="footer_section">
			<ul>
				<li><span class="important"><?php echo stripslashes(get_option('mwt_footer_title_four')); ?></span></li>
				<?php wp_list_bookmarks('title_li=&categorize=&category_name=Blogroll&orderby=rating'); ?>
			</ul>
		</div>
		
		<div id="twitter_feed">
			<ul>
				<li id="twitter_bird"></li>
				<li><span class="important"><?php echo stripslashes(get_option('mwt_twitter_area_title')); ?></span></li>
				<li id="twitter_content"></li>
			</ul>
		</div>
		
		<div class="clear_div"></div>
	</div>
		
	<?php wp_footer(); ?>
	
	<script type="text/javascript"> <!-- Assign PUBLIC GOTHIC font to any element you want here -->
		Cufon.replace('h1');
		Cufon.replace('h2');
		Cufon.replace('h3');
		Cufon.replace('h4');
		Cufon.replace('.announce_title');
	</script>
	
	<?php echo stripslashes(get_option('mwt_ga_code')); ?>

	</body>

</html>