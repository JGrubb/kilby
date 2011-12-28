<div id="sidebar">
	<ul>
	
		<li>
			<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		</li>
		
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(1) )  ?>
	
	</ul>
</div>

