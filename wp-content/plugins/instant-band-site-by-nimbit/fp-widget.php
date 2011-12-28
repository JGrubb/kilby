<?php
//featured product widget
add_action("widgets_init", array('nimbit_featured_product', 'register'));
register_activation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_featured_product', 'activate'));
register_deactivation_hook('instant-band-site-by-nimbit/instant-band-site-by-nimbit.php', array('nimbit_featured_product', 'deactivate'));
class nimbit_featured_product {

  function url($url = '')
	{
		$url = trim($url);
		$wpurl = get_bloginfo('wpurl');

		// if a url is provided just return it
		if ($url) if ($url != "$wpurl/") return $url;

		// lookup the MyStore page_id first then look for the Skin Store
		$page_id = floor(get_option('nimbit_page_ids_MyStore')) or $page_id = floor(get_option('nimbit_page_ids_Store'));

		return "$wpurl/".($page_id ? "?page_id=$page_id" : '');
	}

	function activate(){
		$data = array();
		$cds = array();
		$tickets = array();
		$details = array();
		$data = array('title'=>'Featured Product', 'select'=>'', 'height'=>'', 'url'=>nimbit_featured_product::url(), 'desc'=>'enter a subtitle here');

		set_option('nimbit_featured_product' , $data);
		set_option('nimbit_all_cds', $cds);
		set_option('nimbit_all_tickets', $tickets);
		set_option('nimbit_all_events', $details);
	}
	function deactivate(){
		delete_option('nimbit_featured_product');
		delete_option('nimbit_all_cds');
		delete_option('nimbit_all_tickets');
		delete_option('nimbit_all_events');
	}
	function control(){
		$cds = array();
		$tickets = array();
		$artist = get_option('nimbit_artist');
		$url1 = 'http://'.nimbitmusic_host().'/artistdata/';
		$url1 .= $artist;
		$url1 .= '/full_catalog/';
		$xml1 = @simplexml_load_string(nimbit_fetch($url1)); // @ sign prevents warnings from appearing in the widget settings if $artist is invalid

		if (!is_object($xml1)) return; // in case $artist is invalid, don't block entire widgets page from rendering

		$url2 = 'http://'.nimbitmusic_host().'/artistdata/'.$artist.'/calendar/';
                $xml2 = @simplexml_load_string(nimbit_fetch($url2));

		$dates = array();

		if (is_object($xml2))
		{
			$events = $xml2->xpath('//EventCalendar/Event');

			if (is_array($events)) foreach ($events as $e)
			{
				$dates[(string)$e->event_id] = date('m/d/Y', strtotime((string)$e->event_date)).' at '.$e->venue;
			}
		}

		$products = $xml1->xpath('//response/RecordCompany/Artist/Catalog/Product');

		if (is_array($products)) foreach ($products as $p)
    {
			$pid = floor((string)$p->ID);
			$id  = floor((string)$p->ImageId);

			if (preg_match('/Ticket/i', (string)$p->Type))
			{
				if ($id) $id = 'http://'.nimbitmusic_host().'/images/db/large/'.$id.'.jpg';
				else     $id = 'http://'.nimbitmusic_host().'/images/placeholder/ticket_photo.jpg';

				$tickets[$pid] = $id;
				$names[$pid] = $dates[(string)$p->Ticket[0]->EventId] or $names[$pid] = 'Ticket';
			}
			else
			{
				if ($id) $id = 'http://'.nimbitmusic_host().'/images/db/large/'.$id.'.jpg';
				else     $id = 'http://'.nimbitmusic_host().'/images/placeholder/product_photo.gif';

				$cds[$pid] = $id;
				$names[$pid] = $p->ProductName;
			}
		}

		set_option('nimbit_all_cds' , $cds);
		set_option('nimbit_all_tickets' , $tickets);
		set_option('nimbit_all_names', $names);

		$default = 0;
		foreach ($cds     as $pid=>$src) if ($default) break; else $default = $pid;
		foreach ($tickets as $pid=>$src) if ($default) break; else $default = $pid;
		
		$data = get_option('nimbit_featured_product');

		if ($data['select']) {} else
		{
			$data['select'] = $default;
			set_option('nimbit_featured_product', $data);
		}

		$selected = array($data['select']=>'selected');		

		?><p>Title: <input type="text" name="nimbit_featured_product_title" value="<?php print $data['title']; ?>" /></p>
		<p>Subtitle: <input type="text" name="nimbit_featured_product_subtitle" size="25" value="<?php print $data['desc']; ?>" /></p>
		<p>Choose From Your Nimbit Catalog:<?php
		//when catalog is empty
		if(empty($cds) & empty($tickets)){
			echo '<p style="text-align: center;"><strong>no product available</strong></p>';
		}else{
		
			echo '<select size="1" name="nimbit_featured_product_select" style="width:224px">';
			foreach ($cds     as $pid=>$src) echo '<option '.$selected[$pid].' value="'.$pid.'">'.$names[$pid].'</option>';
			foreach ($tickets as $pid=>$src) echo '<option '.$selected[$pid].' value="'.$pid.'">'.$names[$pid].'</option>';
		}
		?></select>
		</p>
		<br />
		<p>Square Image Dimensions: <br /><?php
		
		$selectedsize = array('100'=>'', '150'=>'','200'=>'','250'=>'','300'=>'');
		if($data['height'] != ""){
			$selectedsize[$data['height']] = 'selected';
		}
								?><select name="nimbit_featured_product_height">
													<option <?php print $selectedsize['100']; ?> value="100">100</option>
													<option <?php print $selectedsize['150']; ?> value="150">150</option>
													<option <?php print $selectedsize['200']; ?> value="200">200</option>
													<option <?php print $selectedsize['250']; ?> value="250">250</option>
													<option <?php print $selectedsize['300']; ?> value="300">300</option>
								</select> (px)
		</p>
		<br />
		<p>Storefront URL: <br /> <input size="40" type="text" name="nimbit_featured_product_url" value="<?php print nimbit_featured_product::url($data['url']); ?>" style="width:224px" />
		<span style="font-size: xx-small;">Paste in the URL of your Nimbit storefront</span></p>
		<?php
		if(isset($_POST['nimbit_featured_product_title'])){
			$data['title'] = attribute_escape($_POST['nimbit_featured_product_title']);
			set_option('nimbit_featured_product', $data);
		}if(isset($_POST['nimbit_featured_product_subtitle'])){
			$data['desc'] = (string)attribute_escape($_POST['nimbit_featured_product_subtitle']);
			set_option('nimbit_featured_product', $data);
		}
		if (isset($_POST['nimbit_featured_product_select'])){
			$data['select'] = (string)attribute_escape($_POST['nimbit_featured_product_select']);
			set_option('nimbit_featured_product', $data);
		}if (isset($_POST['nimbit_featured_product_height'])){
			$data['height'] = attribute_escape($_POST['nimbit_featured_product_height']);
			set_option('nimbit_featured_product', $data);
		}if (isset($_POST['nimbit_featured_product_url'])){
			$data['url'] = attribute_escape($_POST['nimbit_featured_product_url']);
			set_option('nimbit_featured_product', $data);
		}	
	}
	function widget($args)
  {
		$data = get_option('nimbit_featured_product');
		$cds = get_option('nimbit_all_cds');
		$names = get_option('nimbit_all_names');
		$tickets = get_option('nimbit_all_tickets');

		$src = $cds[$data['select']] or $src = $tickets[$data['select']] or $src = 'http://'.nimbitmusic_host().'/images/placeholder/product_photo.gif';

		echo $args['before_widget'];
		echo $args['before_title'] . $data['title'] . $args['after_title'];
		echo $data['desc'];
		echo "<br/><br/><a href='".nimbit_featured_product::url($data['url'])."' ><img src=\"$src\" width=\"".$data['height']."\" height=\"".$data['height']."\" /></a><br />";
		echo $args['after_widget'];
	}
	function register(){
		register_sidebar_widget('Nimbit Featured Product', array('nimbit_featured_product', 'widget'));
		register_widget_control('Nimbit Featured Product', array('nimbit_featured_product', 'control'));
	}
}
?>