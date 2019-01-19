<?php
?>
<div class="wrap">
<div class="icon32" id="icon-options-general"></div>
<h2><?php echo __("JL LikePro Settings", 'jl-like-pro'); ?></h2>

<div
    class="updated fade" <?php if (!isset($_REQUEST['jllikepro_bttn_plgn_form_submit']) || $error != "") echo "style=\"display:none\""; ?>>
    <p>
        <strong><?php echo $message; ?></strong>
    </p>
</div>

<div class="error" <?php if ("" == $error) echo "style=\"display:none\""; ?>>
    <p>
        <strong><?php echo $error; ?></strong>
    </p>
</div>

<div>
<div class="card">
	<p><?php echo __("You went into the settings plugin JL Like PRO - social plug buttons for WordPress.", 'jl-like-pro'); ?></p>
	<p><?php echo __("To display on the shortcode you can use the tag", 'jl-like-pro'); ?> <b>[jllikepro_buttons]</b>.</p>
	<p><?php echo __("Developer", 'jl-like-pro'); ?> <a href="<?php echo __("http://joomline.org/wordpress/395-wllikepro.html", 'jl-like-pro'); ?>">Joomline</a></p>
</div>
<form name="form1" method="post" action="admin.php?page=jl-like-pro"
      enctype="multipart/form-data">
	  
<div id="dashboard-widgets-wrap">	
	<div id="dashboard-widgets" class="metabox-holder">
		<div id="postbox-container-1" class="postbox-container">
			<div id="normal-sortables" class="meta-box-sortables">
				<div id="dashboard_right_now" class="postbox ">
					<div class="inside">
						<div class="main">
	<table class="form-table">
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable Facebook", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='addfacebook'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options['addfacebook'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable VKontakte", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='addvk'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['addvk'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable Twitter", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='addtw'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['addtw'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable Odnoclassniki", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='addod'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['addod'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable Google +", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='addgp'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['addgp'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable Mail.ru", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='addmail'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['addmail'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable LinkedIn", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='addlin'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['addlin'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable Pinterest", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='addpi'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['addpi'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable All Counter", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='addall'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['addall'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
    </table>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div id="postbox-container-2" class="postbox-container">
			<div id="normal-sortables" class="meta-box-sortables">
				<div id="dashboard_right_now" class="postbox ">
					<div class="inside">
						<div class="main">
	<table class="form-table">
        <tr valign="top">
            <th scope="row">
                <?php _e("jQuery load", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='jqload'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['jqload'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Buttons Alignment", 'jl-like-pro'); ?>
            </th>
            <td>
                <select name="position_content" style="width:200px;">
                    <option <?php if ($jllikepro_plgn_options ['position_content'] == 0) echo 'selected="selected"'; ?>
                        value="0"><?php echo __("Left", 'jl-like-pro'); ?></option>
                    <option <?php if ($jllikepro_plgn_options ['position_content'] == 1) echo 'selected="selected"'; ?>
                        value="1"><?php echo __("Right", 'jl-like-pro'); ?></option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Buttons Location", 'jl-like-pro'); ?>
            </th>
            <td>
                <select name="shares_position" style="width:200px;">
                    <option <?php if ($jllikepro_plgn_options ['shares_position'] == 'before') echo 'selected="selected"'; ?>
                        value="before"><?php echo __("Before", 'jl-like-pro'); ?></option>
                    <option <?php if ($jllikepro_plgn_options ['shares_position'] == 'after') echo 'selected="selected"'; ?>
                        value="after"><?php echo __("After", 'jl-like-pro'); ?></option>
                    <option <?php if ($jllikepro_plgn_options ['shares_position'] == 'shortcode') echo 'selected="selected"'; ?>
                        value="shortcode"><?php echo __("Shortcode", 'jl-like-pro'); ?></option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Allow in Category", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='allow_in_category'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['allow_in_category'] == 1) echo 'checked="checked"'; ?>
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Disable_more_likes", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='disable_more_likes'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['disable_more_likes'] == 1) echo 'checked="checked"'; ?>
                />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Enable opengraph", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='enable_opengraph'
                    type='checkbox'
                    value='1'
                    <?php if ($jllikepro_plgn_options ['enable_opengraph'] == 1) echo 'checked="checked"'; ?>
                />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Type of transmission", 'jl-like-pro'); ?>
            </th>
            <td>
                <select name="typesget" style="width:200px;">
                    <option <?php if ($jllikepro_plgn_options ['typesget'] == 0) echo 'selected="selected"'; ?>
                        value="0"><?php echo __("File Get Contents", 'jl-like-pro'); ?></option>
                    <option <?php if ($jllikepro_plgn_options ['typesget'] == 1) echo 'selected="selected"'; ?>
                        value="1"><?php echo __("curl", 'jl-like-pro'); ?></option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Domen", 'jl-like-pro'); ?>
            </th>
            <td>
                <select name="pathbase" style="width:200px;">
                    <option <?php if ($jllikepro_plgn_options ['pathbase'] == '') echo 'selected="selected"'; ?>
                        value=""><?php echo __("Without www", 'jl-like-pro'); ?></option>
                    <option <?php if ($jllikepro_plgn_options ['pathbase'] == 'www.') echo 'selected="selected"'; ?>
                        value="www."><?php echo __("With www", 'jl-like-pro'); ?></option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Description one source", 'jl-like-pro'); ?>
            </th>
            <td>
                <select name="desc_source_one" style="width:200px;">
                    <option <?php if ($jllikepro_plgn_options ['desc_source_one'] == 'desc') echo 'selected="selected"'; ?>
                        value="desc"><?php echo __("Description", 'jl-like-pro'); ?></option>
                    <option <?php if ($jllikepro_plgn_options ['desc_source_one'] == 'full') echo 'selected="selected"'; ?>
                        value="full"><?php echo __("Full text", 'jl-like-pro'); ?></option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Description two source", 'jl-like-pro'); ?>
            </th>
            <td>
                <select name="desc_source_two" style="width:200px;">
                    <option <?php if ($jllikepro_plgn_options ['desc_source_two'] == 'full') echo 'selected="selected"'; ?>
                        value="full"><?php echo __("Description", 'jl-like-pro'); ?></option>
                    <option <?php if ($jllikepro_plgn_options ['desc_source_two'] == 'desc') echo 'selected="selected"'; ?>
                        value="desc"><?php echo __("Full text", 'jl-like-pro'); ?></option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Text before buttons", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='button_text'
                    type='text'
                    value='<?php echo $jllikepro_plgn_options ['button_text']; ?>'
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Buttons contayner", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='buttons_contayner'
                    type='text'
                    value='<?php echo $jllikepro_plgn_options ['buttons_contayner']; ?>'
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Buttons parent contayner", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='parent_contayner'
                    type='text'
                    value='<?php echo $jllikepro_plgn_options ['parent_contayner']; ?>'
                    />
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Image Source", 'jl-like-pro'); ?>
            </th>
            <td>
                <select name="img_source" style="width:200px;">
                    <option <?php if ($jllikepro_plgn_options ['img_source'] == 'text') echo 'selected="selected"'; ?>
                        value="text"><?php echo __("Text", 'jl-like-pro'); ?></option>
                    <option <?php if ($jllikepro_plgn_options ['img_source'] == 'thumb') echo 'selected="selected"'; ?>
                        value="thumb"><?php echo __("Thumbnail", 'jl-like-pro'); ?></option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">
                <?php _e("Default Image", 'jl-like-pro'); ?>
            </th>
            <td>
                <input
                    name='default_image'
                    id='default_image'
                    type='text'
                    value='<?php echo $jllikepro_plgn_options ['default_image']; ?>'
                    />
                <?php do_action( 'media_buttons', 'default_image' ); ?>
            </td>
        </tr>

    </table>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
</div>
<table>
<tr>
    <td colspan="2">
        <input type="hidden" name="jllikepro_bttn_plgn_form_submit" value="submit"/>
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"/>
    </td>
</tr>
</table>
<?php wp_nonce_field(plugin_basename(JL_LIKE_PRO_BASE), 'jllikepro_bttn_plgn_nonce_name'); ?>
</form>
</div>
