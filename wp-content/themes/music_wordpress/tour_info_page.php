<?php
/*
Template Name: Tour Info Page
*/
?>

<?php get_header(); ?>

	<h2><?php the_title(); ?></h2>
	
	<div id="main_concert">
		<img src="<?php echo stripslashes(get_option('mwt_feat_concert_img')); ?>" alt="Concert Image" />
		
		<h3><?php echo stripslashes(get_option('mwt_feat_concert_title')); ?></h3>
		
		<?php echo stripslashes(get_option('mwt_feat_concert_desc')); ?>
		
		<a class="list_link" href="<?php echo stripslashes(get_option('mwt_tickets_link_one')); ?>"><?php echo stripslashes(get_option('mwt_root_tickets_desc')); ?></a>
	</div>
	
	<div id="upcoming_concerts">
		<div class="summary_concert">
			<h4><?php echo stripslashes(get_option('mwt_secondary_concert_title_one')); ?></h4>
			
			<p><span class="important">Date:</span> <?php echo stripslashes(get_option('mwt_secondary_concert_date_one')); ?></p>
			
			<p><?php echo stripslashes(get_option('mwt_secondary_concert_desc_one')); ?></p>
			
			<a class="list_link" href="<?php echo stripslashes(get_option('mwt_tickets_link_two')); ?>"><?php echo stripslashes(get_option('mwt_root_tickets_desc')); ?></a>
		</div>
		<div class="summary_concert">
			<h4><?php echo stripslashes(get_option('mwt_secondary_concert_title_two')); ?></h4>
			
			<p><span class="important">Date:</span> <?php echo stripslashes(get_option('mwt_secondary_concert_date_two')); ?></p>
			
			<p><?php echo stripslashes(get_option('mwt_secondary_concert_desc_two')); ?></p>
			
			<a class="list_link" href="<?php echo stripslashes(get_option('mwt_tickets_link_three')); ?>"><?php echo stripslashes(get_option('mwt_root_tickets_desc')); ?></a>
		</div>
	</div>
	
	<?php $tour_check = stripslashes(get_option('mwt_tour_list')); if($tour_check == '') : ?>
	<?php else : ?>
	<ul id="list_tour_dates">
		<!-- Each section (date, price, and location) of each li has its own span for positioning -->
		
		<?php
			$tour_list = stripslashes(get_option('mwt_tour_list'));
			$tour_list_array = explode("\n", $tour_list);
			$tour_limit = max(array_keys($tour_list_array));
			
			$odd_even = "odd";
		?>
		
		<?php for ($i = 0; $i <= $tour_limit; $i++) : ?>
		
			<?php 
				$tour_list_array_complex = explode(";", $tour_list_array[$i]);
			?>

			<li class="<?php echo $odd_even; ?> <?php echo $tour_list_array_complex[3]; ?>">
				<span class="first_category"><?php echo $tour_list_array_complex[0]; ?></span>
				<span class="second_category"><?php echo $tour_list_array_complex[1]; ?></span>
				<span class="third_category"><?php if($tour_list_array_complex[3]) : ?>sold out<?php else : ?><a href="<?php echo $tour_list_array_complex[2]; ?>"><?php echo stripslashes(get_option('mwt_root_tickets_desc')); ?></a><?php endif; ?></span>
			</li>
			
			<?php
				if ($odd_even == 'odd') {
					$odd_even = '';
				} else {
					$odd_even = 'odd';
				}
			?>
					
		<?php endfor; ?>
	</ul>
	
	<?php endif; ?>
	
	<div class="clear_div"></div>
<?php get_footer(); ?>