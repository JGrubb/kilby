<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

	<div id="page-wrap">

		<div id="content">
		
		<div class="post-wrap">
			
				<div class="post">
	
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>
					
					<h2>Archives by Month:</h2>
						<ul>
							<?php wp_get_archives('type=monthly'); ?>
						</ul>
					
					<h2>Archives by Subject:</h2>
						<ul>
							 <?php wp_list_categories(); ?>
						</ul>
	
				</div><!-- post -->

			</div><!-- post-wrap -->
	
		</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
