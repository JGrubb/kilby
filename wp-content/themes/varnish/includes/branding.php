<?php global $options; foreach ($options as $value) { if (get_settings( $value['id']) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = stripslashes(get_settings( $value['id'] )); } } ?>
<div id="branding">
	<div id="branding-inner">
		<div id="intro"><?php echo $mb_tagline; ?></div>
		<div id="name" style="font-size:<?php echo $mb_name_size; ?>em;">
			<a href="<?php bloginfo('home'); ?>"><?php if ($mb_name_first) { ?><?php echo $mb_name_first; ?><?php } if ($mb_name_last) { ?> <?php echo $mb_name_last; ?><?php } ?></a>
		</div>
		<div id="desc"><?php bloginfo('description'); ?></div>
	</div>
</div>