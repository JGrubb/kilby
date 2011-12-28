<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */

get_header(); ?>

	<h2>Search Results</h2>
	
	<div id="main_column">

	<?php if (have_posts()) : ?>

		<!-- <?php next_posts_link('&laquo; Older Entries') ?>  <?php previous_posts_link('Newer Entries &raquo;') ?> -->

		<?php while (have_posts()) : the_post(); ?>

			<div class="blog_post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				
				<div class="blog_post_info">
					<ul>
						<li>Posted By: <?php the_author() ?></li>
						<li>On: <?php the_time('F jS, Y') ?></li>
					
						<li class="info_last"><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></li>
					</ul>
				</div>
				
				<?php the_content('<p class="read_more">Read More &raquo;</p>'); ?>
				
				<?php if(has_tag()) : ?>
			
				<div class="post_tags">
					<?php the_tags('<p>Tags: </p>', ' '); ?>
				</div>
				
				<div class="post_shadow"></div>
				
				<?php endif; ?>
				
				<!--<p><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p> -->
			</div>

		<?php endwhile; ?>

		<?php if (next_posts_link() || previous_posts_link()): ?>
			<?php next_posts_link('&laquo; Older Entries') ?> | <?php previous_posts_link('Newer Entries &raquo;') ?>
		<?php endif ?>
		
	<?php else : ?>

		<h3>No posts found.</h3>
		<p>We're sorry, we could not find what you were looking for. If you would like to make another search, please refill out the form to the right.</p>
		<p>You may also have better luck searching by category or date. The categories and archives sections under the searchbar may be of use to you.</p>

	<?php endif; ?>
	
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>