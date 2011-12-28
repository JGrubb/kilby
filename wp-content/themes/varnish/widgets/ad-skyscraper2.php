<?php global $options; foreach ($options as $value) { if (get_settings( $value['id']) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = stripslashes(get_settings( $value['id'] )); } } ?>

<?php if( !$mb_skyscraper2 ) echo''; else { ?>
<!-- widget -->
<div class="widget" id="ad-skyscraper2">
	<?php echo $mb_skyscraper2; ?>
</div>
<!-- /widget -->
<?php } ?>