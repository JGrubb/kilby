<?php get_header(); ?>

<h2>Band Blog</h2>

<div id="main_column">

	<?php if (have_posts()) : ?>
	
	<?php while (have_posts()) : the_post(); ?>
	
		<div class="blog_post" id="post-<?php the_ID(); ?>">
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			
			<div class="blog_post_info">
				<ul>
					<li>Posted By: <?php the_author() ?></li>
					<li><?php the_time('F jS, Y') ?></li>
					
					<li class="info_last"><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></li> <!-- Floated right -->
				</ul>
			</div>
				
			<?php the_content('<p class="read_more">Read More &raquo;</p>'); ?>
			
			<?php if(has_tag()) : ?>
			
			<div class="post_tags">
				<?php the_tags('<p>Tags: </p>', ' '); ?>
			</div>
			
			<div class="post_shadow"></div>
			
			<?php endif; ?>
		</div>
	
	<?php endwhile; ?>
	<div class="blog_navigation">
		<?php if (next_posts_link() || previous_posts_link()): ?>
			<?php next_posts_link('&laquo; Older Entries') ?> <?php previous_posts_link('Newer Entries &raquo;') ?>
		<?php endif ?>
	</div>	
	<?php else : ?>
	
	<h2>Not Found</h2>
	<p>Sorry, but you are looking for something that isn't here.</p>
	<?php get_search_form(); ?>
	
	<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>