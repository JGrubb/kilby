<?php
/*
Template Name: Album Page Without Song Links
*/
?>

<?php get_header(); ?>

	<h2><?php the_title(); ?></h2>
		
		<?php query_posts(array('post_type' => 'music_albums', 'showposts' => -1)); ?>
						
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<?php
			  $custom_fields = get_post_custom();
			  
			  $image_custom_field = $custom_fields['image'][0];
			  $music_custom_field = $custom_fields['music'][0];
			  $buy_custom_field = $custom_fields['buy'][0];
			  $release_custom_field = $custom_fields['release'][0];
			  $duration_custom_field = $custom_fields['duration'][0];
			  
			  $buy_list_array = explode("\n", $buy_custom_field);
			  $buy_limit = max(array_keys($buy_list_array));
			  
			  $music_list_array = explode("\n", $music_custom_field);
			  $music_limit = max(array_keys($music_list_array));
			  
			  $odd_even = "odd_song"
			?>
		<ul class="album_section">
			<li><img class="album_cover" src="<?php echo $image_custom_field; ?>" alt="<?php the_title(); ?>" /></li>
			<li>
				<h3><?php the_title(); ?></h3>
			</li>
			
			<?php if($buy_custom_field != '') : ?>
				<li class="buy_album">
					<?php $a = 0; while($a <= $buy_limit) : ?>
						<?php $buy_list_inner_array = explode(",", $buy_list_array[$a], 2); ?>
						
						<a href="<?php echo $buy_list_inner_array[1]; ?>"><?php echo $buy_list_inner_array[0]; ?></a>
					<?php $a++; endwhile; ?>
				</li>
			<?php endif; ?>
			
			<li><a class="open_album" href="#"></a></li> <!-- Fills entire width of intial album (before opened), but is hidden -->
			
			<li class="album_info">
				<ul class="album_extras">
					<li><h4>Album Info</h4></li>
					<li>
						<p class="important">Release Date</p>
						<p><?php echo $release_custom_field; ?></p>
					</li>
					
					<li>
						<p class="important">Runtime</p>
						<p><?php echo $duration_custom_field; ?></p>
					</li>
				</ul>
				
				<ul class="album_songs">
					<?php $b = 0; while($b <= $music_limit) : ?>
						<li class="<?php echo $odd_even; ?>"><?php echo $music_list_array[$b]; ?></li>
					
					<?php
						if ($odd_even == 'odd_song') {
							$odd_even = '';
						} else {
							$odd_even = 'odd_song';
						}
					?>
					
					<?php $b++; endwhile; ?>
				</ul>
			
				<div class="clear_div"></div>
			</li>
		</ul>
	<?php endwhile; endif; wp_reset_query(); ?>

<?php get_footer(); ?>