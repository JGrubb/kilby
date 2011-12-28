<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>

<h2><?php the_title(); ?></h2>

<p id="template_path_contact"><?php bloginfo('template_directory'); ?></p>

<div id="contact_area">
	
	<div id="first_contact_section" class="contact_form_area"> <!-- ID's correspond to contact_ui.js functions -->
		<div class="contact_form">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
			
				<h3><?php the_title(); ?></h3>
			
				<?php the_content(); ?>
			<?php endwhile; endif; ?>
		</div>
		
		<div class="contact_other_info_first">
			<h3><?php echo stripslashes(get_option('mwt_contact_sidebar_title')); ?></h3>
			
			<p><?php echo stripslashes(get_option('mwt_contact_sidebar_desc')); ?></p>
		</div>
		
		<div class="clear_div"></div>
	</div>
</div>

<?php get_footer(); ?>