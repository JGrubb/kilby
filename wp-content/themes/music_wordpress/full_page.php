<?php
/*
Template Name: Full Page
*/
?>

<?php get_header(); ?>

<h2><?php the_title(); ?></h2>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
<?php get_footer(); ?>