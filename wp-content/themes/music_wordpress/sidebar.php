<ul id="side_column">

	<?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

	<li>
		<h3>Search</h3>
	</li>
	
	<li>
		<ul>
			<li><?php get_search_form(); ?></li>
		</ul>	
	</li>
	
	<li>
		<h3>Categories</h3>
	</li>
	
	<li>
		<ul>
			<?php wp_list_categories('title_li=&orderby=name'); ?>
		</ul>
	</li>
	
	<li>
		<h3>Archives</h3>
	</li>
	
	<li>
		<ul>
			<?php wp_get_archives('type=monthly&limit=7'); ?>
		</ul>
	</li>
	<?php endif; ?>
</ul>