<?php include( TEMPLATEPATH . '/includes/options.php' ); ?>
<?php get_header(); ?>
			
		<?php get_sidebar(); ?>
			
		</div>
		<!-- /sidebar-right -->
		
		<!-- content -->
		<div id="content" class="content">
		
			<?php include( TEMPLATEPATH . '/includes/branding.php' ); ?>
			
			<?php if(is_home() && function_exists('get_flickrRSS')) include( TEMPLATEPATH . '/includes/flickr.php' ); ?>
			
			<!-- blog -->
			<div id="blog">
				
				<?php $hit_count = $wp_query->found_posts; ?>				
				<?php if (is_month()) { ?>
				<div id="archive-title"><h2>Browsing all posts from <strong><?php the_time('F, Y') ?></strong>.</h2></div>
				<?php } else if (is_year()) { ?>
				<div id="archive-title"><h2>Browsing all posts from <strong><?php the_time('Y') ?></strong>.</h2></div>
				<?php } else if (is_category()) { ?>
				<div id="archive-title"><h2>Browsing all <?php echo $hit_count . ''; ?> posts in <strong><?php $current_category = single_cat_title("", true); ?></strong>.</h2></div>
				<?php } else if (is_tag()) { ?>
				<div id="archive-title"><h2>Browsing all posts tagged with <strong><?php wp_title('',true,''); ?></strong>.</h2></div>
				<?php } else if (is_author()) { ?>
				<div id="archive-title"><h2>Browsing all posts by <strong><?php wp_title('',true,''); ?></strong>.</h2></div>
				<?php } else if (is_search()) { ?>						
				<div id="archive-title"><h2>Your search for "<strong><?php the_search_query(); ?></strong>" returned <?php echo $hit_count . ' results.'; ?></h2></div>
				<?php } else if (is_404()) { ?>						
				<div id="archive-title"><h2><strong>Page Not Found</strong> (Error 404)</h2></div>
				<?php } ?>
				
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
				
				<!-- post -->
				<div class="post">
					<div class="post-date"><span><?php the_time('m/d/y') ?></span></div>
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<div class="post-comments"><?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?></div>
					<?php include( TEMPLATEPATH . '/includes/post-thumbnail.php' ); ?>
					<?php the_excerpt(); ?>
					<p class="more"><a href="<?php the_permalink() ?>" title="Continue reading <?php the_title_attribute(); ?>">Continue reading...</a></p>						
				</div>
				<!-- /post -->
				
				<?php endwhile; ?>

				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
				<div class="navigation">
					<div class="alignleft"><?php next_posts_link('&laquo; Older Posts') ?></div>
					<div class="alignright"><?php previous_posts_link('Newer Posts &raquo;') ?></div>
				</div>
				<?php } else : ?>

				<p>Sorry. No articles were found that match your criteria.</p>

				<?php endif; ?>
				
			</div>
			<!-- /blog -->
		
<?php get_footer(); ?>