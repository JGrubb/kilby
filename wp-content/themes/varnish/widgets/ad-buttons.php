<?php global $options; foreach ($options as $value) { if (get_settings( $value['id']) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = stripslashes(get_settings( $value['id'] )); } } ?>

<?php if(!$mb_button_1) echo''; else { ?>
<!-- widget -->
<div class="widget" id="ad-buttons">
	<?php if($mb_button_1) echo '<div>'. $mb_button_1 .'</div>'; ?>
	<?php if($mb_button_2) echo '<div>'. $mb_button_2 .'</div>'; ?>
	<?php if($mb_button_3) echo '<div>'. $mb_button_3 .'</div>'; ?>
	<?php if($mb_button_4) echo '<div>'. $mb_button_4 .'</div>'; ?>
</div>
<!-- /widget -->
<?php } ?>