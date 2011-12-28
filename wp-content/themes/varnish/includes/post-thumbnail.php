<?php 
	if (has_post_thumbnail() || get_post_meta($post->ID, 'post_image_value', true) || get_post_meta($post->ID, 'post_image_tnail_value', true)) {
		echo '<div class="post-tnail"><a href="'.get_permalink().'" title="'.get_the_title().'">';
		$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
		$postimage = get_post_meta($post->ID, 'post_image_value', true);
		if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail() && $mb_resize == 0)) {
			echo '<img src="'.get_bloginfo('template_url').'/thumb.php?src='.$thumbnail[0].'&amp;w=150&amp;h=113&amp;zc=1&amp;q=95" alt="'.get_the_title().'" />';
		} 
		else if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail() && $mb_resize == 1)) {
			echo '<img src="'.$thumbnail[0].'" alt="'.get_the_title().'" />';
		} 
		else if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 0) {
			if ($postimage) {
				echo '<img src="'.get_bloginfo('template_url').'/thumb.php?src='.$postimage.'&amp;w=150&amp;h=113&amp;zc=1&amp;q=95" alt="'.get_the_title().'" />';
			}
		} 
		else if (get_post_meta($post->ID, 'post_image_value', true) && $mb_resize == 1) {
			if ($postimage) {
				echo '<img src="'.$postimage.'" alt="'.get_the_title().'" />';
			}
		}
		echo '</a></div>';
	}
?>