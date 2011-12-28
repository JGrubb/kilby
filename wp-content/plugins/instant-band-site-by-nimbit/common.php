<?php

// wrapper for add_option & update_option functions that keeps
// track of option names used so they can be easily deleted.
//
function set_option($name, $value, $autoload = null)
{
	if (is_null($autoload)) update_option($name, $value); else
	{
		add_option($name, $value, $deprecated, $autoload);
	}

	if (!in_array($name, $names = explode(',', get_option('nimbit_option_names'))))
	{
		$names[] = $name;

		update_option('nimbit_option_names', implode(',', $names));
	}
}

function default_option($name, $default_value)
{
  strlen(get_option($name)) or update_option($name, $default_value);
  return get_option($name);
}

function delete_options()
{
	foreach (explode(',', get_option('nimbit_option_names')) as $name) delete_option($name);
}

// used to allow plugin to point to dev and qa
// environments but default to production values
//
function dashboard_host()
{
  return default_option('dashboard_host', 'members.nimbit.com');
}
//
function nimbitmusic_host()
{
  return default_option('nimbitmusic_host', 'www.nimbitmusic.com');
}

// return a hash of those options pertinent to the installed store's
// configuration or, optionally, just the names of those options
//
function nimbit_store_options($namesOnly = false)
{
  $options = array('nimbit_image_size'=>'', 'nimbit_transparency_color'=>'', 'nimbit_custom_css'=>'');

  if (!$namesOnly) foreach ($options as $k=>$v) $options[$k] = get_option($k);

  return $namesOnly ? array_keys($options) : $options;
}

function nimbit_store_css($includeCustom = false, $options = null)
{
  $host = nimbitmusic_host();

  extract($options ? $options : nimbit_store_options());

  if ($nimbit_transparency_color)
  {
    $foreground = $nimbit_transparency_color == '#000000' ? '#ffffff' : '#000000';
    $dropshadow = $nimbit_transparency_color == '#000000' ? '#cccccc' : '#333333';

    if ($nimbit_transparency_color == '#000000')
    {
      $image = 'background:url("http://'.$host.'/images/configcart.png") no-repeat scroll right 3px transparent;';
    }
    else
    {
      $image = 'background:url("http://'.$host.'/images/configcartBLK.png") no-repeat scroll right 3px transparent;';
    }
  }

  if (!preg_match('/px$/', $nimbit_image_size)) $nimbit_image_size .= 'px';

  if (!$includeCustom) $nimbit_custom_css = '';

  $css = <<<EOT

.button,
.dialogCloseBtn,
.lyricsBtn a,
a.button,
.nrt_store,
#nhs_wrapper a.categoryLink,
#nhs_wrapper #headerLinks a
{
  color:$foreground;
}

.htmlImage .c1
{
  background-color:$foreground;
}

.yui-panel,
.nrt_store .transparency
{
  background-color:$nimbit_transparency_color;
}

#nhs_wrapper .product .image img
{
  border-color:$dropshadow;
}

#nhs_wrapper .product .title_and_price,
#nhs_wrapper .product .buyButton span,
#nhs_wrapper .button
{
  border-color:#d4dae8;
}

#nhs_wrapper .product .image,
#nhs_wrapper .product .image img
{
  width:$nimbit_image_size;
}

#nhs_header #headerCart
{
  $image;
}
EOT;

  return trim($css) == trim($nimbit_custom_css) ? $css : "$css\n\n$nimbit_custom_css";
}

function nimbit_content_wrapper($title, $content)
{
  $warning = 'IMPORTANT: Do not edit the following script tag.  Instead, login to your Nimbit dashboard at nimbit.com to edit the content.';

  return "<!-- Begin$title - $warning -->\n".trim($content)."\n<!-- End$title -->";
}

function nimbit_store_content()
{
  $script  = '<div style="margin-top:-30px;"><script src="http://'.nimbitmusic_host().'/tags/javascript/artists/'.get_option('nimbit_artist').'/store"></script>';

  $script .= '<script>var nimbit_options = '.json_encode($options = nimbit_store_options()).';</script></div>';

  // note: mustn't have carraige returns in css as wordpress replaces them with <p> tags that are invalid in css
  // see: http://wordpress.org/support/topic/unwanted-ltpgt-tags-added-to-pages
  //
  return nimbit_content_wrapper('MyStore', $script.'<style>'.str_replace("\n", ' ', nimbit_store_css(true, $options)).'</style>');
}

function nimbit_update_post($title)
{
  if ($post_id = floor(get_option("nimbit_page_ids_$title")))
  {
    $old_post = get_post($post_id);
    $new_post = array('ID'=>$post_id);

    $new_post['post_content'] = preg_replace("/<!-- Begin$title.*?End$title -->/s", nimbit_get_content($title), $old_post->post_content);
    
    wp_update_post($new_post);
  }
}

function nimbit_fetch($url)
{
  if (ini_get('allow_url_fopen') == '1') return file_get_contents($url); else
  {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
  }
}

?>
