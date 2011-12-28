<?php get_header(); ?>

	<div id="page-wrap">

		<div id="content">
		
		<div class="post-wrap">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_time('l, F jS, Y') ?></small>
				
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>
	
		<h2 class="pagetitle">No posts found. Try a different search?</h2>
	
		<div class="post">
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		</div>
	<?php endif; ?>

		</div><!-- post-wrap -->
		
		</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>