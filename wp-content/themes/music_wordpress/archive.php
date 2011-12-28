<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */

get_header();
?>

	<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h2><?php single_cat_title(); ?>&#8217; Category</h2>
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	<h2>Posts Tagged: &#8216;<?php single_tag_title(); ?>&#8217;</h2>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h2>Archive for <?php the_time('F jS, Y'); ?></h2>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h2>Archive for <?php the_time('F, Y'); ?></h2>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h2>Archive for <?php the_time('Y'); ?></h2>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h2>Author Archive</h2>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h2>Blog Archives</h2>
	<?php } ?>
	
	<div id="main_column">
		<!--<?php next_posts_link('&laquo; Older Entries') ?> | <?php previous_posts_link('Newer Entries &raquo;') ?>-->

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

		<div class="blog_navigation">
			<?php if (next_posts_link() || previous_posts_link()): ?>
				<?php next_posts_link('&laquo; Older Entries') ?> <?php previous_posts_link('Newer Entries &raquo;') ?>
			<?php endif ?>
		</div>	
		
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h3>Sorry, but there aren't any posts in the %s category yet.</h3>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h3>Sorry, but there aren't any posts with this date.</h3>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h3>Sorry, but there aren't any posts by %s yet.</h3>", $userdata->display_name);
		} else {
			echo("<h3>No posts found.</h3>");
		}
		get_search_form();

	endif; ?>
	
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>