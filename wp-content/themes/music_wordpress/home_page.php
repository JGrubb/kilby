<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>

<div id="band_mini_bio">
	<img src="<?php echo stripslashes(get_option('mwt_band_feat_img')); ?>" alt="Band Pic" />
	
	<?php echo stripslashes(get_option('mwt_home_bio_desc')); ?>
</div>
	
<ul id="announcement"> <!-- Vertical Slider floated right -->
	<li id="current"> <!-- This class changes based on which link is clicked -->
		<a class="order" href="#">1 <span class="announce_title"><?php echo stripslashes(get_option('mwt_accordion_title_one')); ?></span></a>
						
		<div>
			<img src="<?php echo stripslashes(get_option('mwt_accordion_image_one')); ?>" alt="Upcoming Concert" />
			
			<?php echo stripslashes(get_option('mwt_accordion_desc_one')); ?>
		</div>
	</li>
	
	<li>
		<a class="order" href="#">2 <span class="announce_title"><?php echo stripslashes(get_option('mwt_accordion_title_two')); ?></span></a>
		
		<div>
			<img src="<?php echo stripslashes(get_option('mwt_accordion_image_two')); ?>" alt="New Album Released" />
			
			<?php echo stripslashes(get_option('mwt_accordion_desc_two')); ?>
		</div>
	</li>
	
	<li>
		<a class="order" href="#">3 <span class="announce_title"><?php echo stripslashes(get_option('mwt_accordion_title_three')); ?></span></a>
		
		<div>
			<img src="<?php echo stripslashes(get_option('mwt_accordion_image_three')); ?>" alt="New Single: Lorem Ipsum" />
			
			<?php echo stripslashes(get_option('mwt_accordion_desc_three')); ?>
		</div>
	</li>
</ul>

<div class="clear_div"></div>

<div class="column_first">
	<h3>Recent Posts</h3>
	
	<ul id="featured_post_slider">

		<?php
			$featured = new WP_Query();
			$featured->query('showposts=3');
			while($featured->have_posts()) : $featured->the_post();
			$wp_query->in_the_loop = true;
			$featured_ID = $post->ID;
		?>
	
		<li>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		
			<p><?php the_excerpt(); ?></p>
		</li>
	
		<?php endwhile; ?>
	</ul>
</div>

<div class="column_second">
	<h3>Flickr Photos</h3>
	
	<ul id="flickr_area"> <!-- Images loaded dynamically through json in jquery file home_ui.js -->
	</ul>
</div>

<div class="clear_div"></div>

<?php get_footer(); ?>
