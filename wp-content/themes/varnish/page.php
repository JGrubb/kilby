<?php get_header(); ?>
			
		<?php get_sidebar(); ?>
			
		</div>
		<!-- /sidebar-right -->
		
		<!-- content -->
		<div id="content" class="content">
		
			<?php include( TEMPLATEPATH . '/includes/branding.php' ); ?>
			
			<!-- blog -->
			<div id="blog">
				
				<?php while (have_posts()) : the_post(); ?>
				
				<!-- post -->
				<div class="post single">
					<h1><?php the_title(); ?></h1>
					<?php edit_post_link('Edit this Page','<div class="page-edit">','</div>'); ?>
					<?php the_content(); ?>
				</div>
				<!-- /post -->
				
				<?php endwhile; ?>
				
			</div>
			<!-- /blog -->
		
<?php get_footer(); ?>