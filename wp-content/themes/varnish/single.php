<?php include( TEMPLATEPATH . '/includes/options.php' ); ?>
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
					<div class="post-date" title="<?php the_time('m/d/y') ?>"><span><?php the_time('m/d/y') ?></span></div>
					<h1><?php the_title(); ?></h1>
					<div class="post-categories"><?php the_category(', ') ?></div>
					<?php edit_post_link('Edit this Post','<div class="post-edit">','</div>'); ?>
					<?php if( $mb_bigbox ) { ?>
					<div id="ad-bigbox">
						<?php echo $mb_bigbox; ?>
					</div>
					<?php } ?>
					<?php the_content(); ?>
					<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
				</div>
				<!-- /post -->
				
				<?php if( $mb_banner ) include( TEMPLATEPATH . '/widgets/ad-banner.php' ); ?>
				
				<!-- comments -->
				<div id="comments">
					<?php comments_template(); ?>
				</div>
				<!-- /comments -->
				
				<?php endwhile; ?>
				
			</div>
			<!-- /blog -->
		
<?php get_footer(); ?>