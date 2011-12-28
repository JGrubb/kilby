<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */

get_header();
?>

<h2>Band Blog</h2>

<div id="main_column">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!--<?php previous_post_link('&laquo; %link') ?> | <?php next_post_link('%link &raquo;') ?> -->

		<div class="blog_post" id="post-<?php the_ID(); ?>">
			<h3><?php the_title(); ?></h3>
			
			<div class="blog_post_info">
				<ul>
					<li>Posted By: <?php the_author() ?></li>
					<li>On: <?php the_time('F jS, Y') ?></li>
					
					<li class="info_last"><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></li> <!-- Floated right -->
				</ul>
			</div>
			
			<?php the_content(); ?>

			<p>

				<?php if ( comments_open() ) {
				// Both Comments and Pings are open 
				?>

				<?php } elseif ( !comments_open() ) {
				// Neither Comments, nor Pings are open ?>
				Comments Closed

				<?php } edit_post_link('Edit this entry'); ?>

			</p>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>