<?php


?>
<div class="wrap">

<h2><a class="nav-tab nav-tab-active" href="instant-band-site-by-nimbit.php">Nimbit StoreManage Themes</a><a class="nav-tab" href="theme-install.php">Install Themes</a></h2>


<form method="post">
    <?php wp_nonce_field('update-options'); ?>

<table class="form-table">

<tr valign="top">
<th scope="row">New Option Name</th>
<td><input type="text" name="new_option_name" value="<?php echo get_option('new_option_name'); ?>" /></td>
</tr>
 
<tr valign="top">
<th scope="row">Some Other Option</th>
<td><input type="text" name="some_other_option" value="<?php echo get_option('some_other_option'); ?>" /></td>
</tr>

<tr valign="top">
   <th scope="row">Options, Etc.</th>
<td><input type="text" name="option_etc" value="<?php echo get_option('option_etc'); ?>" /></td>
</tr>

</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="new_option_name,some_other_option,option_etc" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
