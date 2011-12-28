<?php 
	global $options; foreach ($options as $value) {
		if (get_settings( $value['id']) === FALSE) {
			$$value['id'] = $value['std']; 
		} 
		else { 
			$$value['id'] = stripslashes(get_settings( $value['id'] )); 
		} 
	} 
?>