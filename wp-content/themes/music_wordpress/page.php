<?php

get_header(); ?>

<h2><?php the_title(); ?></h2>

<div id="main_column">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
	
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>