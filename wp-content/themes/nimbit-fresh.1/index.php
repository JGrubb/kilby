<?php get_header(); ?>

	<div id="page-wrap">

		<div id="content">
		
			<div class="post-wrap">

			<?php if (have_posts()) : ?>

				<?php while (have_posts()) : the_post(); ?>

					<div class="post" id="post-<?php the_ID(); ?>">
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<small><?php the_time('F jS, Y') ?> by <?php the_author(); ?></small>
						
						<div class="entry">
							<?php the_content('Read the rest of this entry &raquo;'); ?>
						</div>		
			
						<p class="postmetadata"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> / <?php the_tags('Tags: ', ', ', ' / '); ?> Posted in <?php the_category(', ') ?> <?php edit_post_link('Edit', ' / ', ''); ?></p>	
					</div>
					

				<?php endwhile; ?>

				<div class="navigation">
					<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
					<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				</div>
				
				<div class="clear"></div>

			<?php else : ?>

				<h2 class="center">Not Found</h2>
				<p class="center">Sorry, but you are looking for something that isn't here.</p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>

			<?php endif; ?>
			
			</div><!-- .post-wrap -->

		</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
