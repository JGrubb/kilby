<?php get_header(); ?>

	<div id="page-wrap">

		<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="post-wrap">

		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>

			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>	
				
				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>			
			</div>
		</div>
		
		<?php the_tags( '<p class="tags">Tags: ', ', ', '</p>'); ?>
		
	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

		</div><!-- .post-wrap -->

	</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
