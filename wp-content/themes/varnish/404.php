<?php get_header(); ?>
			
		<?php get_sidebar(); ?>
			
		</div>
		<!-- /sidebar-right -->
		
		<!-- content -->
		<div id="content" class="content">
		
			<?php include( TEMPLATEPATH . '/includes/branding.php' ); ?>
								
			<!-- post -->
			<div class="post single">
				<h1>Page Not Found (Error 404)</h1>
				<p>The file may have been removed or renamed. Be sure to check your spelling.  If all else fails, you can <a href="javascript:history.back()">go back to the page you came from</a>, return to the <a href="<?php echo get_option('home'); ?>/">homepage</a>, or try searching (top right).</p>
			</div>
			<!-- /post -->
		
<?php get_footer(); ?>