<?php global $options; foreach ($options as $value) { if (get_settings( $value['id']) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = stripslashes(get_settings( $value['id'] )); } } ?>

<?php if( !$mb_skyscraper ) echo''; else { ?>
<!-- widget -->
<div class="widget" id="ad-skyscraper">
	<?php echo $mb_skyscraper; ?>
</div>
<!-- /widget -->
<?php } ?>