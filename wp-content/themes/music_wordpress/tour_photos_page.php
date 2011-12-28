<?php
/*
Template Name: Tour Photos Page
*/
?>

<?php get_header(); ?>

		<h2><?php the_title(); ?></h2>
		
		<ul id="tour_albums">
			<?php query_posts(array('post_type' => 'photo_albums', 'showposts' => 1000000)); ?>
						
			<?php $i = 1; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<?php
			  $custom_fields = get_post_custom();
			  
			  $compdata_custom_field = $custom_fields['compdata'][0];
			  $imagepaths_custom_field = $custom_fields['imagepaths'][0];
			  $imagepaths_list_array = explode("\n", $imagepaths_custom_field);
			  $imagepaths_limit = max(array_keys($imagepaths_list_array));
			?>
			
			<?php if($i%5 == 0) : ?>
				<li class="last_row_item">
			<?php else : ?>
				<li>
			<?php endif; ?>
				<h3><?php the_title(); ?></h3>
				
				<img src="<?php echo $imagepaths_list_array[0]; ?>" alt="Photo Album Cover" />
				
				<p class="album_date"><span class="important">Date:</span> <?php echo $compdata_custom_field; ?></p>
				
				<div class="photo_container"><!-- Images loaded from folders whose names correspond to position of li, KEEP DIV AS LAST ELEMENT INSIDE OF LI -->
					<div class="exit_container">
						<a class="exit" href="#">CLOSE</a>
					</div>
					
					<div class="photo_buffer">
						<?php $j = 0; while($j <= $imagepaths_limit) : ?>
							<a class="fancybox" href="<?php echo $imagepaths_list_array[$j]; ?>" rel="<?php the_title(); ?>_gallery"><img src="<?php echo $imagepaths_list_array[$j]; ?>" alt="<?php the_title(); ?>" /></a>
						<?php $j++; endwhile; ?>
					</div>
					
					<div class="album_controls">
						<a class="up_control" href="#"></a>
						<a class="down_control" href="#"></a>
					</div>
				</div>
			</li>
			
			<?php $i++; endwhile; endif; wp_reset_query(); ?>
		</ul>
		
		<div class="clear_div"></div>
<?php get_footer(); ?>