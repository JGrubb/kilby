<?php global $options; foreach ($options as $value) { if (get_settings( $value['id']) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = stripslashes(get_settings( $value['id'] )); } } ?>

<?php if (function_exists('aktt_sidebar_tweets')) { ?><!-- twitter -->
<div id="twitter">
	<?php if (!$mb_twitter_bird_hide) { ?><img src="<?php bloginfo('template_directory'); ?>/images/twitter-<?php echo $mb_twitter_bird; ?>.png" alt="Twitter" /><?php } ?>
	<h2>What I’ve Been Up To Lately</h2>
	<?php aktt_sidebar_tweets(); ?>
	<?php if($mb_social_twitter) { ?><p><a href="<?php echo $mb_social_twitter; ?>" class="button">Follow Me on Twitter</a></p><?php } ?>	
</div>
<!-- /twitter --><?php } ?>