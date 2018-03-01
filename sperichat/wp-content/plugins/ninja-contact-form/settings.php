<?php

//add_action( 'admin_init', 'ncf_register_settings' );

function ncf_register_settings() {

	$options = ncf_get_options();
	//register_setting( 'ncf_options', 'ncf_options', 'ncf_options_validate' );

	add_settings_section('ncf_sidebar', 'General', 'ncf_colors_text', 'ncf');
	add_settings_field('ncf_test_mode', "Test mode during setup", 'ncf_test_mode_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_use_admin_email', "Use admin email as message sender", 'ncf_use_admin_email_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_sidebar_type', "The way sidebar appears", 'ncf_sidebar_type_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_sidebar_pos', "Sidebar position", 'ncf_sidebar_pos_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_display', "Display rules", 'ncf_display_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_fade_content', "Fade out main content", 'ncf_fade_content_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_enable_test', "Human Test", 'ncf_enable_test_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_autoresponder', "Autoresponse to sender", 'ncf_autoresponder_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_mc_token', "Subscribe user", 'ncf_mc_token_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_mc_lists', "MailChimp lists", 'ncf_mc_lists_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_sub_question', "Subscribe question", 'ncf_sub_question_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_togglers', "Additional element to toggle Form", 'ncf_togglers_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_scroll', "Scroll behavior", 'ncf_scroll_str', 'ncf', 'ncf_sidebar');
	add_settings_field('ncf_body', "Disable position:relative for BODY children", 'ncf_body_str', 'ncf', 'ncf_sidebar');

	add_settings_section('ncf_form_settings', 'Forms', 'ncf_colors_text', 'ncf');
	add_settings_field('ncf_forms', "Forms", 'ncf_forms_str', 'ncf', 'ncf_form_settings', array('hidden' => true));

//browser()->log('NCF');
//browser()->log($options);

	for ($i = 1; $i <= $options['ncf_forms']; $i++) {

		add_settings_field('ncf_form_status_' . $i, "Status", 'ncf_form_status_str', 'ncf', 'ncf_form_settings', array('hidden' => true, 'index' => $i));

		if ($options['ncf_form_status_' . $i] == 'deleted') {
			continue;
		}

		add_settings_field('ncf_email_' . $i, "Email address to send messages to", 'ncf_email_str', 'ncf', 'ncf_form_settings', array('index' => $i, 'before' => '<div class="form-instance-wrapper" data-index=' .$i .'>'));
		add_settings_field('ncf_email_title_' . $i, "Title for emails received", 'ncf_email_title_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_additional_fields_' . $i, "Additional fields", 'ncf_additional_fields_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_form7_' . $i, "Shortcode of another form", 'ncf_form7_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_userpic_' . $i, 'Your Profile picture or logo', 'ncf_userpic_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_user_firstname_' . $i, 'Profile thin first line', 'ncf_user_firstname_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_user_lastname_' . $i, 'Profile bold second line', 'ncf_user_lastname_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_user_title_' . $i, 'Profile third line', 'ncf_user_title_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_user_bio_' . $i, 'Message to sender', 'ncf_user_bio_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_success_message_' . $i, "Form submission success message", 'ncf_success_message_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_is_default_' . $i, "Make this form default on checked pages", 'ncf_is_default_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_callback_' . $i, 'JavaScript code after submit', 'ncf_callback_str', 'ncf', 'ncf_form_settings', array('index' => $i));

		add_settings_field('ncf_facebook_' . $i, "Facebook URL", 'ncf_facebook_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_twitter_' . $i, "Twitter URL", 'ncf_twitter_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_pinterest_' . $i, "Pinterest URL", 'ncf_pinterest_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_youtube_' . $i, "YouTube URL", 'ncf_youtube_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_instagram_' . $i, "Instagram URL", 'ncf_instagram_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_linkedin_' . $i, "Linkedin URL", 'ncf_linkedin_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_gplus_' . $i, "Google Plus URL", 'ncf_gplus_str', 'ncf', 'ncf_form_settings', array('index' => $i));
		add_settings_field('ncf_rss_' . $i, "RSS URL", 'ncf_rss_str', 'ncf', 'ncf_form_settings', array('index' => $i, 'after' => '</div>'));
	}

	add_settings_section('ncf_theme', 'Theme', 'ncf_colors_text', 'ncf');
	add_settings_field('ncf_theme', "Form Theme", 'ncf_layout_theme_str', 'ncf', 'ncf_theme');
	add_settings_field('ncf_base_color', "Sidebar Base Color", 'ncf_base_color_str', 'ncf', 'ncf_theme');
	add_settings_field('ncf_image_bg', 'Choose Background Image', 'ncf_image_bg_str', 'ncf', 'ncf_theme');
	add_settings_field('ncf_custom_bg', 'Your custom background', 'ncf_custom_bg_str', 'ncf', 'ncf_theme');
	add_settings_field('ncf_userpic_style', "Profile picture style:", 'ncf_userpic_style_str', 'ncf', 'ncf_theme');
	add_settings_field('ncf_invert_style', "Button style:", 'ncf_invert_style_str', 'ncf', 'ncf_theme');
	add_settings_field('ncf_show_social', "Show social bar:", 'ncf_show_social_str', 'ncf', 'ncf_theme');
	add_settings_field('ncf_flat_socialbar', 'Social bar position:', 'ncf_flat_socialbar_str', 'ncf', 'ncf_theme');
	add_settings_field('ncf_color_schema', "Schema", 'ncf_color_schema_str', 'ncf', 'ncf_theme', array('hidden' => true));
	add_settings_field('ncf_rgba', "Rgba", 'ncf_rgba_str', 'ncf', 'ncf_theme', array('hidden' => true));

	add_settings_section('ncf_button', 'Button', 'ncf_colors_text', 'ncf');
	add_settings_field('ncf_label_color', "Button color", 'ncf_label_color_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_label_style', "Button icon", 'ncf_label_style_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_label_shape', "Button shape", 'ncf_label_shape_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_metro', "Metro-style shape", 'ncf_metro_str', 'ncf', 'ncf_button');

	add_settings_field('ncf_label_size', "Button size", 'ncf_label_size_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_label_tooltip', "Button tooltip", 'ncf_label_tooltip_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_label_tooltip_text', "Button tooltip text", 'ncf_label_tooltip_text_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_tooltip_color', "Button tooltip color", 'ncf_tooltip_color_str', 'ncf', 'ncf_button');

	add_settings_field('ncf_label_invert', "Button colors invert", 'ncf_label_invert_str', 'ncf', 'ncf_button');
	//add_settings_field('ncf_label_stroke', "Buttons' shape stroke:", 'ncf_label_stroke_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_label_top', "Button position 'top' value", 'ncf_label_top_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_label_top_mob', "CSS 'top' value for mobiles", 'ncf_label_top_mob_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_label_vis', "Button visibility", 'ncf_label_vis_str', 'ncf', 'ncf_button');
	add_settings_field('ncf_label_mouseover', "Mouseover opening", 'ncf_label_mouseover_str', 'ncf', 'ncf_button');


	add_settings_section('ncf_css', 'CSS', 'ncf_colors_text', 'ncf');
	add_settings_field('ncf_custom_css', "Custom CSS", 'ncf_custom_css_str', 'ncf', 'ncf_css');
//	add_settings_section('ncf_other', 'Other', 'ncf_colors_text', 'ncf');

}

function ncf_colors_text() {
}

function ncf_display_str() {
	$options = ncf_get_options();
	$user_opts = json_decode($options['ncf_display']);
	$locations = $options['locations'];
	//browser()->log('tab ' .$index . ' opts');
	//browser()->log($user_opts);

	?>
	<p>
		<input id='ncf_display' name='ncf_options[ncf_display]' type='hidden' value='<?php echo $options['ncf_display']?>' />
	<div class='loc_popup'>
		<p>
			<label for="ncf_user_status"><?php _e('Show Form for:', 'ninja-contact-form') ?></label>
			<select name="display_user_status" id="ncf_user_status" class="widefat">
				<option value="everyone" <?php echo selected( $user_opts->user->everyone, '1' ) ?>><?php _e('Everyone', 'ninja-contact-form') ?></option>
				<option value="loggedout" <?php echo selected( $user_opts->user->loggedout, '1' ) ?>><?php _e('Logged-out users', 'ninja-contact-form') ?></option>
				<option value="loggedin" <?php echo selected( $user_opts->user->loggedin, '1' ) ?>><?php _e('Logged-in users', 'ninja-contact-form') ?></option>
			</select>
		</p>

		<p>
			<label for="ncf_display_mobile"><?php _e('Show on mobiles:', 'ninja-contact-form') ?></label>
			<select name="display_mobile" id="ncf_display_mobile" class="widefat">
				<option value="yes" <?php echo selected( $user_opts->mobile->yes, '1' ) ?>><?php _e('Show', 'ninja-contact-form') ?></option>
				<option value="no" <?php echo selected( $user_opts->mobile->no, '1' ) ?>><?php _e('Don\'t show', 'ninja-contact-form') ?></option>
			</select>
		</p>

		<p>
			<label for="ncf_user_status"><?php _e('Display rule:', 'ninja-contact-form') ?></label>

			<select name="display_rule" id="display_rule" class="widefat">
				<option value="exclude" <?php echo selected( $user_opts->rule->exclude, '1' ) ?>><?php _e('Hide on checked pages', 'ninja-contact-form') ?></option>
				<option value="include" <?php echo selected( $user_opts->rule->include, '1' ) ?>><?php _e('Show on checked pages', 'ninja-contact-form') ?></option>
			</select>
		</p>

		<div style="height:150px; overflow:auto; border:1px solid #dfdfdf; padding:5px; margin-bottom:5px;">
			<h4 class="dw_toggle" style="cursor:pointer;margin-top:0;"><?php _e('Default WP pages', 'ninja-contact-form') ?></h4>
			<div class="dw_collapse">
				<?php foreach ($locations->wp_pages as $key => $label){
					?>
					<p><input class="checkbox" type="checkbox" value="<?php echo $key?>" <?php checked(isset($user_opts->location->wp_pages->$key) ? $user_opts->location->wp_pages->$key : false, true) ?> id="display_wp_page_<?php echo $key?>" name="display_wp_page_<?php echo $key?>" />
						<label for="display_wp_page_<?php echo $key?>"><?php echo $label .' '. __('Page', 'ninja-contact-form') ?></label></p>
				<?php
				}
				?>
			</div>

			<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Pages') ?></h4>
			<div class="dw_collapse">
				<?php foreach ( $locations->pages as $page ) {
					//$instance['page-'. $page->ID] = isset($instance['page-'. $page->ID]) ? $instance['page-'. $page->ID] : false;
					$id = $page->ID;
					$p_title = apply_filters('the_title', $page->post_title, $page->ID);
					if ( $page->post_parent ) {
						$parent = get_post($page->post_parent);

						$p_title .= ' ('. apply_filters('the_title', $parent->post_title, $parent->ID);

						if ( $parent->post_parent ) {
							$grandparent = get_post($parent->post_parent);
							$p_title .= ' - '. apply_filters('the_title', $grandparent->post_title, $grandparent->ID);
							unset($grandparent);
						}
						$p_title .= ')';

						unset($parent);
					}
					//browser()->log($p_title);

					?>
					<p><input class="checkbox" type="checkbox" value="<?php echo $id?>" <?php checked(isset($user_opts->location->pages->$id), true) ?> id="display_page_<?php echo $id ?>" name="display_page_<?php echo $id ?>" />
						<label for="display_page_<?php echo $id?>"><?php echo $p_title ?></label></p>
					<?php   unset($p_title);
				}  ?>
			</div>

			<?php if ( !empty($locations->cposts) ) { ?>
				<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Custom Post Types', 'ninja-contact-form') ?> +/-</h4>
				<div class="dw_collapse">
					<?php foreach ( $locations->cposts as $post_key => $custom_post ) {
						?>
						<p><input class="checkbox" type="checkbox" value="<?php echo $post_key?>" <?php checked(isset($user_opts->location->cposts->$post_key), true) ?> id="display_cpost_<?php echo $post_key?>" name="display_cpost_<?php echo $post_key?>" />
							<label for="display_cpost_<?php echo $post_key?>"><?php echo stripslashes($custom_post->labels->name) ?></label></p>
						<?php
						unset($post_key);
						unset($custom_post);
					} ?>
				</div>

				<!--<h4 class="dw_toggle" style="cursor:pointer;"><?php /*_e('Custom Post Type Archives', 'ninja-contact-form') */?> +/-</h4>
				<div class="dw_collapse">
					<?php /*foreach ( $this->cposts as $post_key => $custom_post ) {
						if ( !$custom_post->has_archive ) {
							// don't give the option if there is no archive page
							continue;
						}
						$instance['type-'. $post_key .'-archive'] = isset($instance['type-'. $post_key .'-archive']) ? $instance['type-'. $post_key .'-archive'] : false;
						*/?>
						<p><input class="checkbox" type="checkbox" <?php /*checked($instance['type-'. $post_key.'-archive'], true) */?> id="<?php /*echo $widget->get_field_id('type-'. $post_key .'-archive'); */?>" name="<?php /*echo $widget->get_field_name('type-'. $post_key .'-archive'); */?>" />
							<label for="<?php /*echo $widget->get_field_id('type-'. $post_key .'-archive'); */?>"><?php /*echo stripslashes($custom_post->labels->name) */?> <?php /*_e('Archive', 'ninja-contact-form') */?></label></p>
					<?php /*} */?>
				</div>-->
			<?php } ?>

			<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Categories') ?></h4>
			<div class="dw_collapse">
				<?php foreach ( $locations->cats as $cat ) {
					$catid = $cat->cat_ID;
					?>
					<p><input class="checkbox" type="checkbox"  value="<?php echo $catid?>" <?php checked(isset($user_opts->location->cats->$catid), true) ?> id="display_cat_<?php echo $catid?>" name="display_cat_<?php echo $catid?>" />
						<label for="display_cat_<?php echo $catid?>"><?php echo $cat->cat_name ?></label></p>
					<?php
					unset($cat);
				}
				?>
			</div>

			<?php /*if ( !empty($this->taxes) ) { */?><!--
				<h4 class="dw_toggle" style="cursor:pointer;"><?php /*_e('Taxonomies', 'ninja-contact-form') */?> +/-</h4>
				<div class="dw_collapse">
					<?php /*foreach ( $this->taxes as $tax ) {
						$instance['tax-'. $tax] = isset($instance['tax-'. $tax]) ? $instance['tax-'. $tax] : false;
						*/?>
						<p><input class="checkbox" type="checkbox" <?php /*checked($instance['tax-'. $tax], true) */?> id="<?php /*echo $widget->get_field_id('tax-'. $tax); */?>" name="<?php /*echo $widget->get_field_name('tax-'. $tax); */?>" />
							<label for="<?php /*echo $widget->get_field_id('tax-'. $tax); */?>"><?php /*echo str_replace(array('_','-'), ' ', ucfirst($tax)) */?></label></p>
						<?php
			/*						unset($tax);
								}
								*/?>
				</div>
			--><?php /*} */?>

			<?php if ( !empty($locations->langs) ) { ?>
				<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Languages', 'ninja-contact-form') ?></h4>
				<div class="dw_collapse">
					<?php foreach ( $locations->langs as $lang ) {
						$key = $lang['language_code'];
						?>
						<p><input class="checkbox" type="checkbox" value="<?php echo $key?>" <?php checked(isset($user_opts->location->langs->$key), true) ?> id="display_lang_<?php echo $key?>" name="display_lang_<?php echo $key?>" />
							<label for="display_lang_<?php echo $key?>"><?php echo $lang['native_name'] ?></label></p>

						<?php
						unset($lang);
						unset($key);
					}
					?>
				</div>
			<?php } ?>

			<p><label for="display_ids"><?php _e('Comma Separated list of IDs of posts not listed above', 'ninja-contact-form') ?>:</label>
				<input type="text" value="<?php echo implode(",", $user_opts->location->ids); ?>" name="display_ids" id="display_ids" />
			</p>
		</div>

		<button name='Submit' type='submit' id='sbmt_ncf_popup' class='display-sbmt button-primary' value='Save'>Save Display Options</i></button>

	</div>
	</p>
<?php
}

function ncf_callback_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	$val = htmlentities($options['ncf_callback_'.$index], ENT_QUOTES);
	echo "<h6>Code to execute after user successfully submits form, eg. GA tracking (syntax errors here can break plugin).</h6><textarea cols='100' rows='10' id='ncf_callback_{$index}' placeholder='Valid JS code' name='ncf_options[ncf_callback_{$index}]'>".$val."</textarea>";
}

function ncf_forms_str() {
	$options = ncf_get_options();
	echo " <input id='ncf_forms' name='ncf_options[ncf_forms]' size='40' type='hidden' value='{$options['ncf_forms']}' style='' />";
}
function ncf_form_status_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_form_status_{$index}' name='ncf_options[ncf_form_status_{$index}]' size='40' type='hidden' value='{$options['ncf_form_status_'.$index]}' style='' />";
}

function ncf_email_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo "<h6>Separate by comma if multiple.</h6><input id='ncf_email_{$index}' name='ncf_options[ncf_email_{$index}]' size='40' type='text' value='{$options['ncf_email_'.$index]}' style='' />";
}

function ncf_mc_token_str() {
	$options = ncf_get_options();
	echo "<h6>You can add here your VALID MailChimp token and subscription checkbox will be added to form.</h6><input id='ncf_mc_token' name='ncf_options[ncf_mc_token]' size='40' type='text' value='{$options['ncf_mc_token']}' style='' />";
}

function ncf_sub_question_str() {
	$options = ncf_get_options();
    $val = htmlentities($options['ncf_sub_question'], ENT_QUOTES);
    echo "<h6>Question that is near subscription checkbox.</h6><input id='ncf_sub_question' name='ncf_options[ncf_sub_question]' size='40' type='text' value='{$val}' style='' />";
}

function ncf_mc_lists_str() {
	$options = ncf_get_options();
	
	if (empty($options['ncf_mc_token'])) {
		 echo '<p>Add MailChimp token first to see available lists</p><input type="hidden" name="ncf_options[ncf_mc_lists]" value="">';
	} else {
		if (empty($options['ncf_mc_lists'])) {
			$lists = ncf_get_MC_lists($options['ncf_mc_token']);
			$options['ncf_mc_lists'] = json_encode($lists);
		} else {
			$lists = json_decode($options['ncf_mc_lists']);
		}

		echo "<input type='hidden' name='ncf_options[ncf_mc_lists]' value='{$options['ncf_mc_lists']}'>";

		echo '<h6>Choose list to send opt-in in case of subscription.</h6>';
		echo '<select name="ncf_options[ncf_mc_list_id]">';
		for ($i = 0, $len = sizeof($lists); $i < $len; $i++) {
			echo '<option value="' . $lists[$i][0] . '" '. ($options['ncf_mc_list_id'] == $lists[$i][0] ? 'selected=selected' : '') .'>' . $lists[$i][1] . '</option>';
		}
		echo '</select>';

	}
}

function ncf_form7_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo "<h6>Will replace default form. Any simple form should work here. Eg. you can use shortcode from Contact Form 7, Gravity Forms.</h6><input id='ncf_form7_{$index}' name='ncf_options[ncf_form7_{$index}]' size='40' type='text' value='{$options['ncf_form7_'.$index]}' style='' />";
}

function ncf_additional_fields_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	$fields = json_decode($options['ncf_additional_fields_'.$index], true);

	//dirty migration
	if (isset($fields['address']) && !isset($fields['address']['on'])) {
		$options['ncf_additional_fields_'.$index] = '{"company" : {"on":false,"required":false}, "phone" : {"on":false,"required":false}, "address" : {"on":false,"required":false}, "subject" : {"on":false,"required":false}}';
		$fields = json_decode($options['ncf_additional_fields_'.$index], true);
	}

	$first_checked = isset($fields['company']) && !empty($fields['company']['on']) ? 'checked="checked"' : '';
	$sec_checked = isset($fields['phone']) && !empty($fields['phone']['on']) ? 'checked="checked"' : '';
	$third_checked = isset($fields['address']) && !empty($fields['address']['on']) ? 'checked="checked"' : '';
	$forth_checked = isset($fields['subject']) && !empty($fields['subject']['on']) ? 'checked="checked"' : '';

	$req1 = isset($fields['company']) && !empty($fields['company']['required']) ? 'checked="checked"' : '';
	$req2 = isset($fields['phone']) && !empty($fields['phone']['required']) ? 'checked="checked"' : '';
	$req3 = isset($fields['address']) && !empty($fields['address']['required']) ? 'checked="checked"' : '';
	$req4 = isset($fields['subject']) && !empty($fields['subject']['required']) ? 'checked="checked"' : '';

	echo "<h6>Besides Name, Email and Message.</h6>
			<p data-id='company'><input id='ncf_additional_company_{$index}' data-type='on' name='ncf_options[ncf_additional_company_{$index}]' type='checkbox' value='yes' {$first_checked} style='' /> <label for='ncf_additional_company_{$index}'>Company</label> <input data-type='required' id='ncf_required_company_{$index}' name='ncf_options[ncf_required_company_{$index}]' type='checkbox' value='yes' {$req1} style='' /> <label for='ncf_required_company_{$index}'>Required field?</label> </p>
			<p data-id='phone'><input id='ncf_additional_phone_{$index}' data-type='on' name='ncf_options[ncf_additional_phone_{$index}]' type='checkbox' value='yes' {$sec_checked} style='' /> <label for='ncf_additional_phone_{$index}'>Phone</label> <input data-type='required' id='ncf_required_phone_{$index}' name='ncf_options[ncf_required_phone_{$index}]' type='checkbox' value='yes' {$req2} style='' /> <label for='ncf_required_phone_{$index}'>Required field?</label></p>
			<p data-id='address'><input id='ncf_additional_address_{$index}' data-type='on' name='ncf_options[ncf_additional_address_{$index}]' type='checkbox' value='yes' {$third_checked} style='' /> <label for='ncf_additional_address_{$index}'>Address</label> <input data-type='required' id='ncf_required_address_{$index}' name='ncf_options[ncf_required_address_{$index}]' type='checkbox' value='yes' {$req3} style='' /> <label for='ncf_required_address_{$index}'>Required field?</label></p>
			<p data-id='subject'><input id='ncf_additional_subject_{$index}' data-type='on' name='ncf_options[ncf_additional_subject_{$index}]' type='checkbox' value='yes' {$forth_checked} style='' /> <label for='ncf_additional_subject_{$index}'>Subject</label> <input data-type='required' id='ncf_required_subject_{$index}' name='ncf_options[ncf_required_subject_{$index}]' type='checkbox' value='yes' {$req4} style='' /> <label for='ncf_required_subject_{$index}'>Required field?</label></p>
			<input type='hidden' id='ncf_additional_fields_{$index}' name='ncf_options[ncf_additional_fields_{$index}]' value='{$options['ncf_additional_fields_'.$index]}'>
	<script>
	jQuery('.settings-form-row.ncf_additional_fields_{$index} input').change(function() {
		var t = jQuery(this);
		var inp = jQuery('#ncf_additional_fields_{$index}');
		var storage = JSON.parse(inp.val());

		var id = t.parent().attr('data-id');
		var type = t.attr('data-type');

		if (this.checked) {
			storage[id][type] = true;
		} else {
			storage[id][type] = false;
		}

		inp.val(JSON.stringify(storage))

	});
	</script>
	";
}


function ncf_test_mode_str() {
	$options = ncf_get_options();
	$style = $options['ncf_test_mode'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><h6>Will be visible only for logged-in admins.</h6><input id='ncf_test_mode' name='ncf_options[ncf_test_mode]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='ncf_test_mode'></label></p>
	";
}
function ncf_body_str() {
	$options = ncf_get_options();
	$style = $options['ncf_body'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><h6>Can help if you experience layout issues with activated plugin.</h6><input id='ncf_body' name='ncf_options[ncf_body]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='ncf_body'></label></p>
	";
}

function ncf_email_title_str ($args) {
	$options = ncf_get_options();
	$index = $args["index"];
  echo '<h6>if Subject field is not used.</h6>' . get_bloginfo('name') . " <input id='ncf_email_title_{$index}' name='ncf_options[ncf_email_title_{$index}]' size='100' type='text' value='{$options['ncf_email_title_'.$index]}' style='' />";
}


function ncf_is_default_str($args) {
	$options = ncf_get_options();
	$locations = $options['locations'];
	$index = $args["index"];
	$user_opts = json_decode($options['ncf_is_default_' . $index]);

	//browser()->log('tab ' .$index . ' opts');
	//browser()->log($user_opts);

	?>
	<h6>Will show up when button is clicked.</h6>
	<p>
		<input id='ncf_is_default_<?php echo $index?>' name='ncf_options[ncf_is_default_<?php echo $index?>]' type='hidden' value='<?php echo $options['ncf_is_default_'.$index]?>' />
	<div class='loc_popup'>

		<div style="height:150px; overflow:auto; border:1px solid #dfdfdf; padding:5px; margin-bottom:5px;">
			<h4 class="dw_toggle" style="cursor:pointer;margin-top:0;"><?php _e('Default WP pages', 'ninja-contact-form') ?></h4>
			<div class="dw_collapse">
				<?php foreach ($locations->wp_pages as $key => $label){
					?>
					<p><input class="checkbox" type="checkbox" value="<?php echo $key?>" <?php checked(isset($user_opts->location->wp_pages->$key) ? $user_opts->location->wp_pages->$key : false, true) ?> id="display_wp_page_<?php echo $key . '_' . $index?>" name="display_wp_page_<?php echo $key . '_' . $index?>" />
						<label for="display_wp_page_<?php echo $key . '_' . $index?>"><?php echo $label .' '. __('Page', 'ninja-contact-form') ?></label></p>
				<?php
				}
				?>
			</div>

			<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Pages') ?></h4>
			<div class="dw_collapse">
				<?php foreach ( $locations->pages as $page ) {
					//$instance['page-'. $page->ID] = isset($instance['page-'. $page->ID]) ? $instance['page-'. $page->ID] : false;
					$id = $page->ID;
					$p_title = apply_filters('the_title', $page->post_title, $page->ID);
					if ( $page->post_parent ) {
						$parent = get_post($page->post_parent);

						$p_title .= ' ('. apply_filters('the_title', $parent->post_title, $parent->ID);


						if ( $parent->post_parent ) {
							$grandparent = get_post($parent->post_parent);
							$p_title .= ' - '. apply_filters('the_title', $grandparent->post_title, $grandparent->ID);
							unset($grandparent);
						}
						$p_title .= ')';

						unset($parent);
					}
					//browser()->log($p_title);

					?>
					<p><input class="checkbox" type="checkbox" value="<?php echo $id?>" <?php checked(isset($user_opts->location->pages->$id), true) ?> id="display_page_<?php echo $id . '_' . $index?>" name="display_page_<?php echo $id . '_' . $index?>" />
						<label for="display_page_<?php echo $id . '_' . $index?>"><?php echo $p_title ?></label></p>
					<?php   unset($p_title);
				}  ?>
			</div>

			<?php if ( !empty($locations->cposts) ) { ?>
				<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Custom Post Types', 'ninja-contact-form') ?> +/-</h4>
				<div class="dw_collapse">
					<?php foreach ( $locations->cposts as $post_key => $custom_post ) {
						?>
						<p><input class="checkbox" type="checkbox" value="<?php echo $post_key?>" <?php checked(isset($user_opts->location->cposts->$post_key), true) ?> id="display_cpost_<?php echo $post_key . '_' . $index?>" name="display_cpost_<?php echo $post_key . '_' . $index?>" />
							<label for="display_cpost_<?php echo $post_key . '_' . $index?>"><?php echo stripslashes($custom_post->labels->name) ?></label></p>
						<?php
						unset($post_key);
						unset($custom_post);
					} ?>
				</div>

				<!--<h4 class="dw_toggle" style="cursor:pointer;"><?php /*_e('Custom Post Type Archives', 'ninja-contact-form') */?> +/-</h4>
				<div class="dw_collapse">
					<?php /*foreach ( $this->cposts as $post_key => $custom_post ) {
						if ( !$custom_post->has_archive ) {
							// don't give the option if there is no archive page
							continue;
						}
						$instance['type-'. $post_key .'-archive'] = isset($instance['type-'. $post_key .'-archive']) ? $instance['type-'. $post_key .'-archive'] : false;
						*/?>
						<p><input class="checkbox" type="checkbox" <?php /*checked($instance['type-'. $post_key.'-archive'], true) */?> id="<?php /*echo $widget->get_field_id('type-'. $post_key .'-archive'); */?>" name="<?php /*echo $widget->get_field_name('type-'. $post_key .'-archive'); */?>" />
							<label for="<?php /*echo $widget->get_field_id('type-'. $post_key .'-archive'); */?>"><?php /*echo stripslashes($custom_post->labels->name) */?> <?php /*_e('Archive', 'ninja-contact-form') */?></label></p>
					<?php /*} */?>
				</div>-->
			<?php } ?>

			<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Categories') ?></h4>
			<div class="dw_collapse">
				<?php foreach ( $locations->cats as $cat ) {
					$catid = $cat->cat_ID;
					?>
					<p><input class="checkbox" type="checkbox"  value="<?php echo $catid?>" <?php checked(isset($user_opts->location->cats->$catid), true) ?> id="display_cat_<?php echo $catid . '_' . $index?>" name="display_cat_<?php echo $catid . '_' . $index?>" />
						<label for="display_cat_<?php echo $catid . '_' . $index?>"><?php echo $cat->cat_name ?></label></p>
					<?php
					unset($cat);
				}
				?>
			</div>

			<?php /*if ( !empty($this->taxes) ) { */?><!--
				<h4 class="dw_toggle" style="cursor:pointer;"><?php /*_e('Taxonomies', 'ninja-contact-form') */?> +/-</h4>
				<div class="dw_collapse">
					<?php /*foreach ( $this->taxes as $tax ) {
						$instance['tax-'. $tax] = isset($instance['tax-'. $tax]) ? $instance['tax-'. $tax] : false;
						*/?>
						<p><input class="checkbox" type="checkbox" <?php /*checked($instance['tax-'. $tax], true) */?> id="<?php /*echo $widget->get_field_id('tax-'. $tax); */?>" name="<?php /*echo $widget->get_field_name('tax-'. $tax); */?>" />
							<label for="<?php /*echo $widget->get_field_id('tax-'. $tax); */?>"><?php /*echo str_replace(array('_','-'), ' ', ucfirst($tax)) */?></label></p>
						<?php
			/*						unset($tax);
								}
								*/?>
				</div>
			--><?php /*} */?>

			<?php if ( !empty($locations->langs) ) { ?>
				<h4 class="dw_toggle" style="cursor:pointer;"><?php _e('Languages', 'ninja-contact-form') ?></h4>
				<div class="dw_collapse">
					<?php foreach ( $locations->langs as $lang ) {
						$key = $lang['language_code'];
						?>
						<p><input class="checkbox" type="checkbox" <?php checked(isset($user_opts->location->langs->$key), true) ?> id="display_lang_<?php echo $key . '_' . $index?>" value="<?php echo $key?>" name="display_lang_<?php echo $index?>" />
							<label for="display_lang_<?php echo $key . '_' . $index?>"><?php echo $lang['native_name'] ?></label></p>

						<?php
						unset($lang);
						unset($key);
					}
					?>
				</div>
			<?php } ?>

			<p><label for="display_ids"><?php _e('Comma Separated list of IDs of posts not listed above', 'ninja-contact-form') ?>:</label>
				<input type="text" value="<?php echo implode(",", $user_opts->location->ids); ?>" name="display_ids" id="display_ids" />
			</p>
		</div>

		<button name='Submit' type='submit' id='sbmt_ncf_popup' class='display-sbmt button-primary' value='Save'>Save Display Options</i></button>

	</div>
	</p>
<?php
}

function ncf_base_color_str() {
	$options = ncf_get_options();
    $basecolor = json_decode($options['ncf_base_color']);
    $theme = $options['ncf_theme'];
		$currentBase = $basecolor -> $theme;
    $previewpic = empty($options['ncf_userpic']) ? plugins_url('/img/wolf.jpg', __FILE__) : $options['ncf_userpic'];
    $previewname = empty($options['ncf_user_firstname']) ? 'John' : $options['ncf_user_firstname'];
    $previewname2 = empty($options['ncf_user_firstname']) ? '' : $options['ncf_user_firstname'];
    $previewlastname = empty($options['ncf_user_lastname']) ? 'Appleseed' : $options['ncf_user_lastname'];
    $previewtitle = empty($options['ncf_user_title']) ? 'Blog Awesome Author' : $options['ncf_user_title'];
    $previewbio = empty($options['ncf_user_bio']) ? 'Hello lovely visitor! Send me a message and you will have my answer.' : $options['ncf_user_bio'];
    $position = $options['ncf_flat_socialbar'];
		$url = plugins_url('/img', __FILE__);
		$bgimage = $options['ncf_image_bg'];
		$userpic = $options['ncf_userpic_style'];

		if ($bgimage !== 'none') {
			if($bgimage === 'custom') {
				$bgstyle = 'background-image: url(' . $options['ncf_custom_bg'] . ')';
			} else {
				$bgstyle = 'background-image: url(' . plugins_url('/img/bg/' . $options['ncf_image_bg']. '.jpg', __FILE__) . ')';
			}
		} else {
			$bgstyle = '';
		}

		echo "<div class='colorswrap'><p>Choose theme base color...</p><span class='colorsliders cs_flat' data-theme='flat'></span><span class='colorsliders cs_minimalistic' data-theme='minimalistic'></span><span class='colorsliders cs_aerial' data-theme='aerial'></span><p>...or enter color in HEX format here:</p></div>";
    echo "<input id='ncf_base_color' name='ncf_options[ncf_base_color]' type='hidden' value='{$options['ncf_base_color']}' style='' />";
    echo "<input id='base_color_flat' name='base_color_flat' data-color-format='hex' size='40' type='text' value='{$basecolor -> flat}' style='display: none;' />";
    echo "<input id='base_color_minimalistic' name='base_color_minimalistic' data-color-format='hex' size='40' type='text' value='{$basecolor -> minimalistic}' style='display: none;' />";
    echo "<input id='base_color_aerial' name='base_color_aerial' data-color-format='hex' size='40' type='text' value='{$basecolor -> aerial}' style='display: none;' />
	<div id='ncf_theme_preview' class='ncf_up_style_{$userpic}'>
        <p>Theme demo:</p>
        <div class='ncf_theme_preview_flat'>
            <div class='ncf_flat' style='{$bgstyle}'>
                <div class='ncf_sidebar_cont_scrollable'>
                    <div class='ncf_sidebar_cont shrinked'>
                        <div class='ncf_sidebar_header'>
                            <div class='ncf_sidebar_socialbar'>
                                <ul>
                                    <li class='ncf_bg_color1'><a href='' class='ncf_rss'></a></li>
                                    <li class='ncf_bg_color2'><a href='' class='ncf_gplus'></a></li>
                                    <li class='ncf_bg_color3'><a href='' class='ncf_linkedin'></a></li>
                                    <li class='ncf_bg_color4'><a href='' class='ncf_instagram'></a></li>
                                    <li class='ncf_bg_color5'><a href='' class='ncf_youtube'></a></li>
                                    <li class='ncf_bg_color6'><a href='' class='ncf_pinterest'></a></li>
                                    <li class='ncf_bg_color7'><a href='' class='ncf_twitter'></a></li>
                                    <li class='ncf_bg_color8'><a href='' class='ncf_facebook'></a></li>
                                </ul>
                            </div>
                            <div class='ncf_sidebar_header_userinfo ncf_bg_color1'>
                                <div class='ncf_userpic'>
                                        <img src='{$previewpic}' alt=''>

                                </div>
                                <div class='ncf_user_credentials'>
                                    <span class='ncf_user_lastname'>{$previewlastname}</span>
                                    <span class='ncf_user_title ncf_text_color9'>{$previewtitle}</span>
                                </div>
                            </div>
                        </div>
                        <div class='ncf_sidebar_content'>
                            <div class='ncf_user_bio'>{$previewbio}</div>
                            <div class='ncf_form_input_wrapper ncf_name_field'>
                                <input type='text' class='ncf_border_color5' name='ncf_name_field' id='ncf_name_field' placeholder='Your name *' data-rules='required|min[2]|max[16]'>
                            </div>
                             <div class='ncf_form_input_wrapper ncf_email_field'>
                                <input type='text'  name='ncf_name_field' id='ncf_name_field1-1' placeholder='Your e-mail *'>
                            </div>
                            <div class='ncf_form_btn_wrapper'>
                                <a class='ncf_button ncf_bg_color8 ncf_boxshadow_color3' data-box-shadow='0 2px 0px 2px' href='#'>Send</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class='ncf_theme_preview_minimalistic'>
            <div class='ncf_minimalistic' style='{$bgstyle}'>
                <div class='ncf_sidebar_cont_scrollable'>
                    <div class='ncf_sidebar_cont shrinked'>
        								<div class='ncf_sidebar_header'>
                        <div class='ncf_sidebar_header_userinfo'>
                            <div class='ncf_userpic'>
                                <img src='{$previewpic}' alt=''>
                            </div>
                            <div class='ncf_user_credentials'>
                                <span class='ncf_user_firstname ncf_text_color1'>{$previewname2}</span>
                                <span class='ncf_user_lastname'>{$previewlastname}</span>
                                <span class='ncf_user_title'>{$previewtitle}</span>
                            </div>
		                        </div>

                              <div class='ncf_sidebar_socialbar'>
	                               <ul>
	                               		<li><a class='ncf_facebook' href='https://www.facebook.com/'></a></li><li><a class='ncf_twitter ncf_bg_color1' href='https://www.facebook.com/'></a></li><li><a class='ncf_pinterest' href='https://www.facebook.com/'></a></li><li><a class='ncf_youtube' href='https://www.facebook.com/'></a></li><li><a class='ncf_instagram' href='https://www.facebook.com/'></a></li><li><a class='ncf_linkedin' href='https://www.facebook.com/'></a></li><li><a class='ncf_gplus' href='https://www.facebook.com/'></a></li><li><a class='ncf_rss' href='https://www.facebook.com/'></a></li>
	                               </ul>
	                           </div>
                    			</div>

                    <div class='ncf_sidebar_content'>
                        <div class='ncf_user_bio'>{$previewbio}</div>

                            <div class='ncf_form_input_wrapper ncf_name_field'>
                                <input type='text' class='ncf_border_color5 ncf_boxshadow_color4'  data-box-shadow='inset 0px -4px 0px 0px' name='ncf_name_field' id='ncf_name_field2' placeholder='Your name *'>
                            </div>
                             <div class='ncf_form_input_wrapper ncf_email_field'>
                                <input type='text' class=''  data-box-shadow='inset 0px -4px 0px 0px' name='ncf_name_field' id='ncf_name_field2-1' placeholder='Your e-mail *'>
                            </div>
                            <div class='ncf_form_btn_wrapper'>
                                <a class='ncf_button ncf_bg_color1 ncf_boxshadow_color5' data-box-shadow='0 2px 0px 2px' href='#'>Send</a>
                            </div>

                    </div>
	</div>
	</div>
	</div>
	</div>

	<div class='ncf_theme_preview_aerial'>
            <div class='ncf_aerial' style='{$bgstyle}'>
                <div class='ncf_sidebar_cont_scrollable'>
                    <div class='ncf_sidebar_cont'>
        								<div class='ncf_sidebar_header'>
        								<div class='ncf_sidebar_socialbar'>
                           <ul>
                              <li><a class='ncf_facebook' href='https://www.facebook.com/'></a></li><li><a class='ncf_twitter' href='https://www.facebook.com/'></a></li><li><a class='ncf_pinterest' href='https://www.facebook.com/'></a></li><li><a class='ncf_youtube' href='https://www.facebook.com/'></a></li><li><a class='ncf_instagram' href='https://www.facebook.com/'></a></li><li><a class='ncf_linkedin' href='https://www.facebook.com/'></a></li><li><a class='ncf_gplus' href='https://www.facebook.com/'></a></li><li><a class='ncf_rss' href='https://www.facebook.com/'></a></li>
                           </ul>
                        </div>
                        <div class='ncf_sidebar_header_userinfo'>
                            <div class='ncf_userpic'>
                                <img src='{$previewpic}' alt=''>
                            </div>
                            <div class='ncf_user_credentials'>
                                <span class='ncf_user_firstname ncf_text_color1'>{$previewname2}</span>
                                <span class='ncf_user_lastname ncf_text_color1'>{$previewlastname}</span>
                                <span class='ncf_user_title ncf_text_color2'>{$previewtitle}</span>
                            </div>
		                        </div>
                    			</div>

                    <div class='ncf_sidebar_content'>
                        <div class='ncf_user_bio ncf_text_color1'>{$previewbio}</div>

                            <div class='ncf_form_input_wrapper ncf_name_field'>
                                <input type='text' class='ncf_text_color1 ncf_bg_rgb_color1' name='ncf_name_field' id='ncf_name_field3' placeholder='Your name *' value='Your name *'>
                            </div>
                            <div class='ncf_form_input_wrapper ncf_email_field'>
                                <input type='text' class='ncf_text_color1 ncf_bg_rgb_color1' name='ncf_email_field' id='ncf_email_field' placeholder='Your email *' value='Your email *'>
                            </div>
                            <div class='ncf_form_btn_wrapper'>
                                <a class='ncf_button ncf_bg_color1 ncf_boxshadow_color5' data-box-shadow='0 2px 0px 2px' href='#'>Send</a>
                            </div>

                    </div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<script>
	jQuery('.colorswrap').closest('.settings-form-wrapper').addClass('{$theme}');
	jQuery(document).ready(function($) {

        var colors = {
        	flat: {
        	 	baseColor: '{$basecolor->flat}',
        		colorSchema: {
              'color1' : {h: 0, s: 0, v: 0},
              'color2' : {h: 0, s: -5, v: +6},
              'color3' : {h: 0, s: +5, v: +5},
              'color4' : {h: +5, s: -6, v: +10},
              'color5' : {h: 0, s: -9, v: +3},
              'color6' : {h: 0, s: +6, v: -2},
              'color7' : {h: +11, s: -4, v: +16},
              'color8' : {h: 0, s: -4, v: +16},
              'color9' : {h: 0, s: +18, v: -39},
              'color10' : {h: -143, s: +20, v: +25}
            },
            swatches: [
              '#2B93C0',
              '#c0392b',
              '#a3503c',
              '#925873',
              '#927758',
              '#589272',
              '#588c92',
              '#2bb1c0',
              '#2b8ac0',
              '#e96701',
            ]
        	},

        	minimalistic: {
        	  baseColor: '{$basecolor->minimalistic}',
        		colorSchema: {
              'color1' : {h: 0, s: 0, v: 0},
              'color2' : {h: 0, s: -30, v: -65},
              'color3' : {h: -1, s: -55, v: -25},
              'color4' : {h: -1, s: -42, v: +10},
              'color5' : {h: -3, s: -9, v: -8}
            },
            swatches: [
              '#50e3c2',
              '#7f2566',
              '#9c9a2d',
              '#2d9c92',
              '#920f2a'
            ]
        	},
        	aerial: {
        	  baseColor: '{$basecolor->aerial}',
        		colorSchema: {
              'color1' : {h: 0, s: 0, v: 0},
              'color2' : {h: 0, s: 0, v: +5}
            },
            swatches: [
              '#292929',
              '#ffffff'
            ]
        	}
        }

        var theme = '{$theme}';
        var baseColorInput = $('#ncf_base_color');
        var baseColorRGB = $('#ncf_rgba');
        var colorSchemaInput = $('#ncf_color_schema');

				$('.colorsliders').each(function(i, el){

						var slidertheme = $(this).attr('data-theme');
						var colorInput = $('input#base_color_' + slidertheme);
						var opts = {
		            flat: true,
		            previewformat: 'hex',
		            color:  colors[slidertheme]['baseColor'],
		            connectedinput: colorInput,
		            order: {
		                hsl: 1,
		                preview: 2
		            },
		            customswatches: 'swatches_' + slidertheme,
		            swatches: colors[slidertheme]['swatches'],
		            onchange: function(container, color) {
		                var currentBaseColor = colorInput.val();
		                var RGB = tinycolor(currentBaseColor).toRgb();
		                try {
		                    var colorJSON = JSON.parse(baseColorInput.val());
		                    colorJSON[slidertheme] = currentBaseColor;
		                    baseColorInput.val(JSON.stringify(colorJSON))

		                } catch (e) {
		                }

		                colorSchemaInput.val(applySchema(currentBaseColor, slidertheme));
		                baseColorRGB.val([RGB.r, RGB.g, RGB.b].join(','));

		            }
		        };
						$(this).ColorPickerSliders(opts);
				});

				colorSchemaInput.val(applySchema($('input#base_color_' + theme).val(), theme));

        function applySchema (baseColor, theme) {
            var colorItemsSelector = '#ncf_theme_preview .ncf_theme_preview_' + theme + ' [class*=color]';
            var colorItems = $(colorItemsSelector);

            var hsvBase = tinycolor(baseColor).toHsv();
            var colorArr = [];

            if (!hsvBase) return;

						var themeSchemas = colors[theme]['colorSchema'];
						var color, newHsv, newColor, schema;
            for (color in themeSchemas) {

               schema = themeSchemas[color];
               newHsv = {
                 h: hsvBase.h + schema.h,
                 s: hsvBase.s + schema.s * 0.01,
                 v: hsvBase.v + schema.v * 0.01
               };

               // normalize
               newHsv = normalize(newHsv);
               newColor = '#' + tinycolor(newHsv).toHex();
               colorArr.push(newColor);
            };
						colorItems.each(function(i,el){
                var jqEl = $(el);
                var classN = el.className;
                var color = classN.match(/color(\d{1,2})/g);
                var i, len, index;
                var newColor;

                if (color) {
                	for (i = 0, len = color.length; i < len;i++) {
                    index = color[i].match(/\d{1,2}/);
                    if (index && (index = index[0])){
                    	colorize(jqEl, colorArr[index - 1], index);
                    }
                  }
                }
            });
            //console.log('SCHEMA', colorArr);
            return colorArr;
        }

        function colorize (jqEl, color, index){

           if (!color) return;

           if (jqEl.is('.ncf_text_color' + index)) {
               jqEl.css('color', color);
           }

           else if (jqEl.is('.ncf_bg_color' + index)) {
               jqEl.css('backgroundColor', color);
           }

           else if (jqEl.is('.ncf_border_color' + index)) {
               jqEl.css('borderColor', color);
           }

           else if (jqEl.is('.ncf_boxshadow_color' + index)) {
               jqEl.css('boxShadow', jqEl.attr('data-box-shadow') + ' ' + color);
           }

           else if (jqEl.is('.ncf_outline_color' + index)) {
               jqEl.css('outlineColor', color);
           }
           if (jqEl.is('.ncf_bg_rgb_color' + index)) {
           			var RGB = tinycolor(color).toRgb();
               jqEl.css('backgroundColor', 'rgba(' + [RGB.r, RGB.g, RGB.b].join(',') + ',0.1)');
           }
        }

        function normalize (hsvObj) {
            if (hsvObj.h > 360) hsvObj.h = 360;
            else if (hsvObj.h < 0) hsvObj.h = 0;

            if (hsvObj.s > 1) hsvObj.s = 1;
            else if (hsvObj.s < 0) hsvObj.s = 0;

            if (hsvObj.v > 1) hsvObj.v = 1;
            else if (hsvObj.v < 0) hsvObj.v = 0;

            return hsvObj;
        }

				var preview = $('#ncf_theme_preview');
        var sidebars = $('.ncf_theme_preview_flat .ncf_flat, .ncf_theme_preview_minimalistic .ncf_minimalistic, .ncf_theme_preview_aerial .ncf_aerial')
        var socialbarpos = '{$position}';
        var cont = $('.ncf_theme_preview_flat .ncf_sidebar_header, .ncf_theme_preview_aerial .ncf_sidebar_header');
        var custom = $('.ncf_custom_bg');

        if (socialbarpos === 'bottom') {
        		cont.each(function(){
	            var t = $(this);
	            t.append(t.find('.ncf_sidebar_socialbar'));
        		})
        } else {
        		cont.each(function(){
	            var t = $(this);
	            t.prepend(t.find('.ncf_sidebar_socialbar'));
        		})
        }

        $('#ncf_flat_socialbar').change(function(){
            var val = $(this).val();
            if (val === 'bottom') {
              cont.each(function(){
		            var t = $(this);
		            t.append(t.find('.ncf_sidebar_socialbar'));
	            })
            } else if (val === 'top') {
              cont.each(function(){
		            var t = $(this);
		            t.prepend(t.find('.ncf_sidebar_socialbar'));
	            })
            }
       	})

          $('#ncf_image_bg').change(function(){
               var val = $(this).val();
               var style;

               if (val === 'none') {
                 	sidebars.css('backgroundImage', '');
                 	custom.fadeOut(200);

               } else if (val === 'custom') {
               		style = 'url({$options['ncf_custom_bg']})';
               		if (/jpeg|jpg|png|gif/.test(style)) {
               		   sidebars.css('backgroundImage', style);
               		} else {
               		   sidebars.css('backgroundImage', 'none');
               		}
                  custom.fadeIn(200);
               } else {
									sidebars.css('backgroundImage', 'url({$url}/bg/' + val + '.jpg)');
									custom.fadeOut(200);

               }
          });

          showActiveTheme(theme);
          $('select#ncf_theme').change(function(){
          	var selectedTheme = $(this).val();
          	console.log(selectedTheme)
          	showActiveTheme(selectedTheme);
          	colorSchemaInput.val(applySchema($('input#base_color_' + selectedTheme).val(), selectedTheme));

          });

          function showActiveTheme (theme) {
            $('#ncf_theme_preview [class*=ncf_theme_preview], .colorsliders, input[id^=base_color]').hide();
        		$('.ncf_theme_preview_' + theme + ', .colorsliders.cs_' + theme + ', #base_color_' + theme).show();
        		//console.log(theme)
        		$('.ncf_theme').removeClass('minimalistic aerial flat').addClass(theme);
          }

          $('input[id*=ncf_userpic_style]').change(function(){
	          var val = $(this).val();
	          if (val === 'theme_custom') {
							preview.addClass('ncf_up_style_theme_custom');
	          } else {
	          	preview.removeClass('ncf_up_style_theme_custom');
	          }
          })
	});
	</script>
	";
}

function ncf_color_schema_str () {
    $options = ncf_get_options();
    echo "<input id='ncf_color_schema' name='ncf_options[ncf_color_schema]' type='text' value='{$options['ncf_color_schema']}' style='' />";
}

function ncf_rgba_str () {
    $options = ncf_get_options();
    echo "<input id='ncf_rgba' name='ncf_options[ncf_rgba]' type='text' value='{$options['ncf_rgba']}' style='' />";
}

function ncf_layout_theme_str () {
    $options = ncf_get_options();
		$theme = $options['ncf_theme'];
		echo "
		<select id='ncf_theme' name='ncf_options[ncf_theme]'>
		<option value='minimalistic' " . ($theme === 'minimalistic' ? 'selected="selected"' : '') . ">Minimalistic White</option>
	    <option value='flat' " . ($theme === 'flat' ? 'selected="selected"' : '') . ">Flat Dark</option>" .
/*	  <option value='cube' " . ($theme === 'cube' ? 'selected="selected"' : '') . ">Cube</option> */
		  "<option value='aerial' " . ($theme === 'aerial' ? 'selected="selected"' : '') . ">Aerial</option>
	  </select>
    ";
}

function ncf_scroll_str () {
    $options = ncf_get_options();
		$scroll = $options['ncf_scroll'];
		echo "
		<h6>When form is opened.</h6>
		<select id='ncf_scroll' name='ncf_options[ncf_scroll]'>
		<option value='custom' " . ($scroll === 'custom' ? 'selected="selected"' : '') . ">Disable scroll of main content</option>
	    <option value='standard' " . ($scroll === 'standard' ? 'selected="selected"' : '') . ">Enable scroll of main content</option>
	  </select>
    ";
}

function ncf_enable_test_str() {
	$options = ncf_get_options();

	if(@$options['ncf_enable_test'] == "enable") {
		$ncf_enable_test = "checked='checked'" ;
	} else {
        $ncf_enable_test = '';
    }

	echo "<h6>Enable simple captcha to help prevent spam.</h6><input id='ncf_enable_test' name='ncf_options[ncf_enable_test]' class='switcher' type='checkbox' value='enable' {$ncf_enable_test} style='' /> <label for='ncf_enable_test'></label><br>
	";
}

function ncf_autoresponder_str() {
	$options = ncf_get_options();

	if(@$options['ncf_autoresponder'] == "enable") {
		$ncf_autoresponder = "checked='checked'" ;
	} else {
        $ncf_autoresponder = '';
    }

	echo "<h6>User will receive copy of own message if checked.</h6><input id='ncf_autoresponder' name='ncf_options[ncf_autoresponder]' class='switcher' type='checkbox' value='enable' {$ncf_autoresponder} style='' /> <label for='ncf_autoresponder'></label><br>
	";
}

function ncf_sidebar_type_str () {
	$options = ncf_get_options();
	$checked1 = $options['ncf_sidebar_type'] === 'push' ? 'checked="checked"' : '';
	$checked2 = $options['ncf_sidebar_type'] === 'slide' ? 'checked="checked"' : '';

	echo "<p><input id='ncf_sidebar_type_push' name='ncf_options[ncf_sidebar_type]' type='radio' {$checked1} value='push' /> <label for='ncf_sidebar_type_push'>Pushing page content and revealing itself under it</label></p>";
	echo "<p><input id='ncf_sidebar_type_slide' name='ncf_options[ncf_sidebar_type]' type='radio' {$checked2} value='slide' /> <label for='ncf_sidebar_type_slide'>Sliding itself on the top of page content</label></p>";
}

function ncf_use_admin_email_str() {
	$options = ncf_get_options();

	if($options['ncf_use_admin_email'] == "enable") {
		$ncf_use_admin_email = "checked='checked'";
	} else {
		$ncf_use_admin_email = '';
	}

	echo "<h6>When hosting restricts sending emails from another domains.</h6>	<input id='ncf_use_admin_email' name='ncf_options[ncf_use_admin_email]' class='switcher' type='checkbox' value='enable' {$ncf_use_admin_email} style='' /> <label for='ncf_use_admin_email'></label><br>
	";

	echo "<p>
	<input type='text' id='test_email_to' placeholder='Email address'><span id='test_email'>Send test e-mail</span></p>
  <br>
  <h6>Strongly recommended to test e-mail sending while using both states of above setting. If you don't see emails, <a href='http://contactform.looks-awesome.com/docs/FAQ/Why_Dont_I_Receive_Emails'>troubleshoot the problem</a>, most likely email server is not setup.</h6>";
}

function ncf_calltoaction_str() {
	$options = ncf_get_options();
	echo " <input id='ncf_calltoaction' name='ncf_options[ncf_calltoaction]' size='40' type='text' value='{$options['ncf_calltoaction']}' style='' />";
}

function ncf_success_message_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
    $val = htmlentities($options['ncf_success_message_'.$index], ENT_QUOTES, "UTF-8");

    echo " <input id='ncf_success_message_{$index}' name='ncf_options[ncf_success_message_{$index}]' size='100' type='text' value='{$val}' style='' />
	";
}

function ncf_userpic_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo "<h6>Automatically resized to 110x110px.</h6>";
    if (empty($options['ncf_userpic_'.$index])) {
        echo "<input id='ncf_userpic_file_" . $index . "' type='file' name='ncf_pic_{$index}' value='{$options['ncf_userpic_'.$index]}' /> <input name='Submit' type='submit' class='button-primary' value='Upload' />";
    } else {
        echo '<div class="ncf_userpic"><img width="110" height="110" src="' . $options['ncf_userpic_'.$index] . '" alt=""/></div>';
        echo '<p><input  style="margin-top: 0;" type="submit" class="button-secondary" id="ncf_remove_pic_'. $index . '" value="Remove this pic"/></p>';
        echo "<script>
             var index = " . $index . ";
             console.log('#ncf_remove_pic_' + index);
         (function(){
             jQuery('#ncf_remove_pic_' + index).on('click keydown', function(){
                  jQuery('#ncf_userpic_' + index).val('');
             })
           })()
           </script>
       ";
        echo "<span>...or upload new one</span><br><input id='ncf_userpic_file_{$index}' type='file' name='ncf_pic_{$index}' value='{$options['ncf_userpic_'.$index]}' /> <input name='Submit' type='submit' class='button-primary' value='Upload' />";
    }
    echo " <input id='ncf_userpic_{$index}' name='ncf_options[ncf_userpic_{$index}]' size='100' type='hidden' value='{$options['ncf_userpic_'.$index]}' style='' />";
}

function ncf_image_bg_str() {
    $options = ncf_get_options();
    $bg = $options['ncf_image_bg'];
		$isCustom = $bg === 'custom';
    echo "<select id='ncf_image_bg' name='ncf_options[ncf_image_bg]'>
    <option value='none' " . ($bg === 'none' ? 'selected="selected"' : '') . ">Default</option>
    <option value='custom' " . ($bg === 'custom' ? 'selected="selected"' : '') . ">My custom background</option>
    <option value='blur1' " . ($bg === 'blur1' ? 'selected="selected"' : '') . ">Blurred #1</option>
    <option value='blur2' " . ($bg === 'blur2' ? 'selected="selected"' : '') . ">Blurred #2</option>
    <option value='blur3' " . ($bg === 'blur3' ? 'selected="selected"' : '') . ">Blurred #3</option>
    <option value='blur4' " . ($bg === 'blur4' ? 'selected="selected"' : '') . ">Blurred #4</option>
    <option value='blur5' " . ($bg === 'blur5' ? 'selected="selected"' : '') . ">Blurred #5</option>
    <option value='blur6' " . ($bg === 'blur6' ? 'selected="selected"' : '') . ">Blurred #6</option>
    <option value='blur7' " . ($bg === 'blur7' ? 'selected="selected"' : '') . ">Blurred #7</option>
    <option value='blur8' " . ($bg === 'blur8' ? 'selected="selected"' : '') . ">Blurred #8</option>
    <option value='blur9' " . ($bg === 'blur9' ? 'selected="selected"' : '') . ">Blurred #9</option>
    <option value='blur10' " . ($bg === 'blur10' ? 'selected="selected"' : '') . ">Blurred #10</option>
    <option value='blur11' " . ($bg === 'blur11' ? 'selected="selected"' : '') . ">Blurred #11</option>
    <option value='blur12' " . ($bg === 'blur12' ? 'selected="selected"' : '') . ">Blurred #12</option>
    <option value='blur13' " . ($bg === 'blur13' ? 'selected="selected"' : '') . ">Blurred #13</option>
    <option value='blur14' " . ($bg === 'blur14' ? 'selected="selected"' : '') . ">Blurred #14</option>
    <option value='blur15' " . ($bg === 'blur15' ? 'selected="selected"' : '') . ">Blurred #15</option>
    <option value='pattern1' " . ($bg === 'pattern1' ? 'selected="selected"' : '') . ">Pattern #1</option>
    <option value='pattern2' " . ($bg === 'pattern2' ? 'selected="selected"' : '') . ">Pattern #2</option>
    <option value='pattern3' " . ($bg === 'pattern3' ? 'selected="selected"' : '') . ">Pattern #3</option>
    <option value='pattern4' " . ($bg === 'pattern4' ? 'selected="selected"' : '') . ">Pattern #4</option>
    <option value='pattern5' " . ($bg === 'pattern5' ? 'selected="selected"' : '') . ">Pattern #5</option>
    <option value='pattern6' " . ($bg === 'pattern6' ? 'selected="selected"' : '') . ">Pattern #6</option>
    <option value='pattern7' " . ($bg === 'pattern7' ? 'selected="selected"' : '') . ">Pattern #7</option>
    <option value='pattern8' " . ($bg === 'pattern8' ? 'selected="selected"' : '') . ">Pattern #8</option>
    <option value='pattern9' " . ($bg === 'pattern9' ? 'selected="selected"' : '') . ">Pattern #9</option>
    <option value='pattern10' " . ($bg === 'pattern10' ? 'selected="selected"' : '') . ">Pattern #10</option>
    <option value='pattern11' " . ($bg === 'pattern11' ? 'selected="selected"' : '') . ">Pattern #11</option>
    <option value='pattern12' " . ($bg === 'pattern12' ? 'selected="selected"' : '') . ">Pattern #12</option>
    <option value='pattern13' " . ($bg === 'pattern13' ? 'selected="selected"' : '') . ">Pattern #13</option>
    <option value='pattern14' " . ($bg === 'pattern14' ? 'selected="selected"' : '') . ">Pattern #14</option>
    <option value='pattern15' " . ($bg === 'pattern15' ? 'selected="selected"' : '') . ">Pattern #15</option>
    </select>";
		echo "
	  <script>
	  jQuery(function($){
        var isCustomBG = !!'{$isCustom}';
        var custom = $('.ncf_custom_bg');
				if (isCustomBG) {
					custom.show();
				}
	  })

    </script>
    ";
}

function ncf_custom_bg_str() {
    $options = ncf_get_options();
    if (empty($options['ncf_custom_bg'])) {
        echo "<input id='ncf_custom_bg' type='file' name='ncf_custom_bg' value='{$options['ncf_custom_bg']}' /> <input name='Submit' type='submit' class='button-primary' value='Upload' />";
        echo "<br><br><label for='ncf_custom_bg_url'>or use URL:</label> <input id='ncf_custom_bg_url' name='ncf_options[ncf_custom_bg]' size='100' type='text' value='{$options['ncf_custom_bg']}' style='' />";
    } else {
        echo '<div class="ncf_custom_bg" ><img src="' . $options['ncf_custom_bg'] . '" alt=""/></div>';
        echo "<span>...or upload new one</span><br><input id='ncf_custom_bg' type='file' name='ncf_custom_bg' value='{$options['ncf_custom_bg']}' /><input name='Submit' type='submit' class='button-primary' value='Upload' />";
	      echo "<br><br><label for='ncf_custom_bg_url'>Background image URL:</label><br><input id='ncf_custom_bg_url' name='ncf_options[ncf_custom_bg]' size='100' type='text' value='{$options['ncf_custom_bg']}' style='' />";
    }
    //echo " <input id='ncf_custom_bg' name='ncf_options[ncf_custom_bg]' size='100' type='hidden' value='{$options['ncf_custom_bg']}' style='' />";
}

function ncf_flat_socialbar_str() {
    $options = ncf_get_options();
    $position = $options['ncf_flat_socialbar'];
    echo "<select id='ncf_flat_socialbar' name='ncf_options[ncf_flat_socialbar]'>
    <option value='top' " . ($position === 'top' ? 'selected="selected"' : '') . ">Top</option>
    <option value='bottom' " . ($position === 'bottom' ? 'selected="selected"' : '') . ">Bottom</option>
    </select>";
}

function ncf_user_firstname_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	$val = htmlentities($options['ncf_user_firstname_'.$index], ENT_QUOTES, "UTF-8");

	echo " <h6>ex. First name.</h6><input id='ncf_user_firstname_{$index}' name='ncf_options[ncf_user_firstname_{$index}]' size='100' type='text' value='{$val}' style='' />";
}

function ncf_user_lastname_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	$val = htmlentities($options['ncf_user_lastname_'.$index], ENT_QUOTES, "UTF-8");

	echo " <h6>ex. Full name or Company name.</h6><input id='ncf_user_lastname_{$index}' name='ncf_options[ncf_user_lastname_{$index}]' size='100' type='text' value='{$val}' style='' />";
}

function ncf_user_title_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	$val = htmlentities($options['ncf_user_title_'.$index], ENT_QUOTES, "UTF-8");

	echo " <h6>ex. your Title or Company Motto.</h6><input id='ncf_user_title_{$index}' name='ncf_options[ncf_user_title_{$index}]' size='100' type='text' value='{$val}' style='' />";
}

function ncf_user_bio_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	$val = htmlentities($options['ncf_user_bio_'.$index], ENT_QUOTES, "UTF-8");
	echo "<h6>ex. Text with your short bio or company history.</h6><textarea cols='100' rows='10' id='ncf_user_bio_{$index}' name='ncf_options[ncf_user_bio_{$index}]' >" . $val . "</textarea>";
}
function ncf_avatar_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_avatar_{$index}' name='ncf_options[ncf_avatar_{$index}]' size='100' type='text' value='{$options['ncf_avatar_'.$index]}' style='' />";
}

function ncf_facebook_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_facebook_{$index}' name='ncf_options[ncf_facebook_{$index}]' size='100' type='text' value='{$options['ncf_facebook_'.$index]}' style='' />";
}

function ncf_twitter_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_twitter_{$index}' name='ncf_options[ncf_twitter_{$index}]' size='100' type='text' value='{$options['ncf_twitter_'.$index]}' style='' />";
}


function ncf_pinterest_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_pinterest_{$index}' name='ncf_options[ncf_pinterest_{$index}]' size='100' type='text' value='{$options['ncf_pinterest_'.$index]}' style='' />";
}
function ncf_youtube_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_youtube_{$index}' name='ncf_options[ncf_youtube_{$index}]' size='100' type='text' value='{$options['ncf_youtube_'.$index]}' style='' />";
}
function ncf_instagram_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_instagram_{$index}' name='ncf_options[ncf_instagram_{$index}]' size='100' type='text' value='{$options['ncf_instagram_'.$index]}' style='' />";
}
function ncf_linkedin_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_linkedin_{$index}' name='ncf_options[ncf_linkedin_{$index}]' size='100' type='text' value='{$options['ncf_linkedin_'.$index]}' style='' />";
}

function ncf_gplus_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_gplus_{$index}' name='ncf_options[ncf_gplus_{$index}]' size='100' type='text' value='{$options['ncf_gplus_'.$index]}' style='' />";
}
function ncf_rss_str($args) {
	$options = ncf_get_options();
	$index = $args["index"];
	echo " <input id='ncf_rss_{$index}' name='ncf_options[ncf_rss_{$index}]' size='100' type='text' value='{$options['ncf_rss_'.$index]}' style='' />";
}


function ncf_label_color_str() {
	$options = ncf_get_options();

	echo "<input id='ncf_label_color' data-color-format='rgba' name='ncf_options[ncf_label_color]' type='text' value='{$options['ncf_label_color']}' style='' />
	<script>

		jQuery(function(){
			var preview = jQuery('#ncf_button_preview');

			var opts = {
		     previewontriggerelement: true,
		     previewformat: 'rgba',
		     flat: false,
		     color: '{$options['ncf_label_color']}',
		     customswatches: 'label',
		     swatches: [
		       '#c0392b',
		       'a3503c',
		       '925873',
		       '927758',
		       '589272',
		       '588c92',
		       '2bb1c0',
		       '2b8ac0',
		       'e96701',
		       'c02b74'
		     ],
		     order: {
		         rgb: 1,
		         opacity: 2,
		         preview: 3
		     },
		     onchange: function(container, color) {
		      preview.find('.fa:not(.fa-inverse)').css('color', color.tiny.toRgbString())
		     }
   };
			jQuery('#ncf_label_color').ColorPickerSliders(opts);
		});

</script>
";

}

function ncf_tooltip_color_str() {
	$options = ncf_get_options();

	echo "<input id='ncf_tooltip_color' data-color-format='rgba' name='ncf_options[ncf_tooltip_color]' type='text' value='{$options['ncf_tooltip_color']}' style='' />
	<script>

		jQuery(function(){
			var preview = jQuery('#ncf_button_preview');

			var opts = {
		     previewontriggerelement: true,
		     previewformat: 'rgba',
		     flat: false,
		     color: '{$options['ncf_tooltip_color']}',
		     customswatches: 'tooltip',
		     swatches: [
		       '#c0392b',
		       'a3503c',
		       '925873',
		       '927758',
		       '589272',
		       '588c92',
		       '2bb1c0',
		       '2b8ac0',
		       'e96701',
		       'c02b74'
		     ],
		     order: {
		         rgb: 1,
		         opacity: 2,
		         preview: 3
		     }
   };
			jQuery('#ncf_tooltip_color').ColorPickerSliders(opts);
		});

</script>
";

}

function ncf_label_style_str() {
	$options = ncf_get_options();
	$val = $options['ncf_label_style'];

	echo "<div id='ncf_button_preview'><span class='fa-stack fa-lg fa-{$options['ncf_label_size']}'> <i class='fa icon-{$options['ncf_label_shape']} fa-stack-2x'></i> <i class='fa icon-mail-{$options['ncf_label_style']} fa-stack-1x fa-inverse'></i> </span></div>";
	echo "<select id='ncf_label_style' name='ncf_options[ncf_label_style]'>
		 <option value='1' " . ($val === '1' ? 'selected="selected"' : '') . ">Icon style 1</option>
		 <option value='4' " . ($val === '4' ? 'selected="selected"' : '') . ">Icon style 2</option>
		 <option value='3' " . ($val === '3' ? 'selected="selected"' : '') . ">Icon style 3</option>
		 <option value='6' " . ($val === '6' ? 'selected="selected"' : '') . ">Icon style 4</option>
		 <option value='7' " . ($val === '7' ? 'selected="selected"' : '') . ">Icon style 5</option>
		 <option value='alt' " . ($val === 'alt' ? 'selected="selected"' : '') . ">Icon style 6</option>
 </select>";
}

function ncf_label_tooltip_str() {
	$options = ncf_get_options();
	$val = $options['ncf_label_tooltip'];

	echo "<select id='ncf_label_tooltip' name='ncf_options[ncf_label_tooltip]'>
     <option value='hover' " . ($val === 'hover' ? 'selected="selected"' : '') . ">On button hover</option>
		 <option value='visible' " . ($val === 'visible' ? 'selected="selected"' : '') . ">Always visible</option>
 		 <option value='none' " . ($val === 'none' ? 'selected="selected"' : '') . ">None</option>

 </select>";
}

function ncf_label_tooltip_text_str() {
	$options = ncf_get_options();
	echo " <input id='ncf_label_tooltip_text' name='ncf_options[ncf_label_tooltip_text]' size='10' type='text' value='{$options['ncf_label_tooltip_text']}' style='' />";
}

function ncf_metro_str() {
	$options = ncf_get_options();
	$style = $options['ncf_metro'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><h6>Overrides other shapes.</h6><input id='ncf_metro' name='ncf_options[ncf_metro]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='ncf_metro'></label></p>
	";
	echo "
	  <script>
	  jQuery(function(){

		var check = jQuery('#ncf_metro');

	  var icons = jQuery('#ncf_button_preview .fa-stack');
	  var init = true;
	  check.change(function() {
		  var checked = this.checked;
	    icons.each(function(){
	        var preview = jQuery(this);
	        var back = preview.find('i:first');
	        var fore = preview.find('i:last');
	        var color;
	        var css;

	        if(checked) {
	        	        	        	  jQuery('body').addClass('metro')

	            color = back.css('color');
	            css = {'background-color': color};
	            back.css(css);
	        } else {
	        	        	  jQuery('body').removeClass('metro')

	            color = fore.css('color');
	            back.css('background-color', '');
	        }

	        init = false;
	    })

	  });

	  			if (check.is(':checked')) check.change()

		 })
	   </script>
	   ";
}

function ncf_label_invert_str() {
	$options = ncf_get_options();
	$style = $options['ncf_label_invert'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><input id='ncf_label_invert' name='ncf_options[ncf_label_invert]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='ncf_label_invert'></label></p>
	";
	echo "
	  <script>
	  jQuery(function(){
	  	  var check = jQuery('#ncf_label_invert');

		  var icons = jQuery('#ncf_button_preview .fa-stack')
		  check.change(function() {
		  var checked = this.checked;

		  if (checked) {
		  	jQuery('#ncf_label_stroke').attr('checked', false).change();
		  }
	    icons.each(function(){
	        var preview = jQuery(this);
	        var back = preview.find('i:first');
	        var fore = preview.find('i:last');
	        var color;
	        if(checked) {
	        		jQuery('body').addClass('inverted')
	            color = back.css('color');
	            fore.removeClass('fa-inverse').css('color', color);
	            back.addClass('fa-inverse').css('color', '');
	        } else {
	        	  jQuery('body').removeClass('inverted')
	            color = fore.css('color');
	            back.removeClass('fa-inverse').css('color', color);
	            fore.addClass('fa-inverse').css('color', '');
	        }
	    })

	    });

			if (check.is(':checked')) check.change()

	  })
	   </script>
	   ";
}

function ncf_label_size_str() {
	$options = ncf_get_options();
	$val = $options['ncf_label_size'];

	echo "<select id='ncf_label_size' name='ncf_options[ncf_label_size]'>
		 <option value='1x' " . ($val === '1x' ? 'selected="selected"' : '') . ">1x</option>
		 <option value='2x' " . ($val === '2x' ? 'selected="selected"' : '') . ">2x</option>
		 <option value='3x' " . ($val === '3x' ? 'selected="selected"' : '') . ">3x</option>
 </select>";
}

function ncf_label_shape_str() {
	$options = ncf_get_options();
	$val = $options['ncf_label_shape'];

	echo "<select id='ncf_label_shape' name='ncf_options[ncf_label_shape]'>
		 <option value='circle' " . ($val === 'circle' ? 'selected="selected"' : '') . ">Circle</option>
		 <option value='square' " . ($val === 'square' ? 'selected="selected"' : '') . ">Rounded square</option>
 </select>";
}

function ncf_label_top_str() {
	$options = ncf_get_options();
	echo "<h6>Please enter CSS valid value for  ex. '50%' or '200px'.</h6><input id='ncf_label_top' name='ncf_options[ncf_label_top]' size='10' type='text' value='{$options['ncf_label_top']}' style='' />";
}

function ncf_label_top_mob_str() {
	$options = ncf_get_options();
	echo " <input id='ncf_label_top_mob' name='ncf_options[ncf_label_top_mob]' size='10' type='text' value='{$options['ncf_label_top_mob']}' style='' />";
}

function ncf_label_vis_str() {
	$options = ncf_get_options();
	$val = $options['ncf_label_vis'];
	$first_checked = $val == 'visible' ? 'checked="checked"' : '';
  $sec_checked = $val == 'hidden' ? 'checked="checked"' : '';
	$third_checked = $val == 'hidden_500' ? 'checked="checked"' : '';
	$forth_checked = $val == 'scroll' ? 'checked="checked"' : '';
	$fifth_checked = $val == 'scroll_into' ? 'checked="checked"' : '';

	echo "
	<p><input id='ncf_label_vis_visible' name='ncf_options[ncf_label_vis]'  type='radio' value='visible' {$first_checked} style='' /> <label for='ncf_label_vis_visible'>Visible</label></p>
	<p><input id='ncf_label_vis_hidden' name='ncf_options[ncf_label_vis]'  type='radio' value='hidden' {$sec_checked} style='' /> <label for='ncf_label_vis_hidden'>Don't show it</label></p>
	<p><input id='ncf_label_vis_hidden_500' name='ncf_options[ncf_label_vis]'  type='radio' value='hidden_500' {$third_checked} style='' /> <label for='ncf_label_vis_hidden_500'>Don't show button when screen is less than 500px wide</label></p>
	<p><input id='ncf_label_vis_scroll' name='ncf_options[ncf_label_vis]'  type='radio' value='scroll' {$forth_checked} style='' /> <label for='ncf_label_vis_scroll'>Fade in label only after user scrolls</label></p>
	<p><input id='ncf_label_vis_scroll_into' name='ncf_options[ncf_label_vis]'  type='radio' value='scroll_into' {$fifth_checked} style='' /> <label for='ncf_label_vis_scroll_into'>Fade in label only after element with selector scrolls into view.</label><br>
	<p style='padding-left: 20px;line-height: 26px;'>Please use any valid CSS selector like #id and .class (if field is empty label will be always visible)<br><input type='text' id='ncf_label_vis_selector' value='{$options['ncf_label_vis_selector']}' name='ncf_options[ncf_label_vis_selector]' value></p></p>
	";
}

function ncf_togglers_str()
{
	$options = ncf_get_options();
	echo "<h6>Valid CSS selector like #id or .class</h6><input id='ncf_togglers' name='ncf_options[ncf_togglers]' type='text' value='{$options['ncf_togglers']}' style='' />";
}

function ncf_label_mouseover_str() {
	$options = ncf_get_options();
	$style = $options['ncf_label_mouseover'];
	$first_checked = $style == 'yes' ? 'checked="checked"' : '';

	echo "
	<p><h6>When user hovers button.</h6><input id='ncf_label_mouseover' name='ncf_options[ncf_label_mouseover]' class='switcher' type='checkbox' value='yes' {$first_checked} style='' /> <label for='ncf_label_mouseover'></label></p>
	";
}
function ncf_userpic_style_str() {
	$options = ncf_get_options();
	$style = $options['ncf_userpic_style'];
	$first_checked = $style == 'theme_custom' ? 'checked="checked"' : '';
  $sec_checked = $style == 'none' ? 'checked="checked"' : '';

	echo "
	<p><input id='ncf_userpic_style_theme_custom' name='ncf_options[ncf_userpic_style]' type='radio' value='theme_custom' {$first_checked} style='' /> <label for='ncf_userpic_style_theme_custom'>Theme Custom</label></p>
	<p><input id='ncf_userpic_style_none' name='ncf_options[ncf_userpic_style]' type='radio' value='none' {$sec_checked} style='' /> <label for='ncf_userpic_style_none'>None</label></p>
	";
}

function ncf_invert_style_str() {
	$options = ncf_get_options();
	$style = $options['ncf_invert_style'];
	$first_checked = $style == 'invert' ? 'checked="checked"' : '';

	echo "
	<p><h6>Useful with light color schemes.</h6>
	<input id='ncf_invert_style' name='ncf_options[ncf_invert_style]' class='switcher' type='checkbox' value='invert' {$first_checked} style='' /> <label for='ncf_invert_style'></label></p>
	";
	echo "<script>
	jQuery('#ncf_invert_style').change(function() {
	var t = jQuery(this).closest('.settings-form-wrapper');
	    if(this.checked) {
	        t.addClass('ncf_invert');
	    } else {
	        t.removeClass('ncf_invert');
	    }
	}).change();
	</script>";
}

function ncf_show_social_str() {
	$options = ncf_get_options();
  $vis = $options['ncf_show_social'];
 echo "<select id='ncf_show_social' name='ncf_options[ncf_show_social]'>
 <option value='show' " . ($vis === 'show' ? 'selected="selected"' : '') . ">Yes</option>
 <option value='hide' " . ($vis === 'hide' ? 'selected="selected"' : '') . ">No</option>
 </select>";
	echo "<script>
	jQuery('#ncf_show_social').change(function() {
	var val = jQuery(this).val();
		var t = jQuery(this).closest('.settings-form-wrapper');
	    if(val === 'show') {
	        t.removeClass('ncf_hide_social');
	    } else {
	        t.addClass('ncf_hide_social');
	    }
	}).change();
	</script>";
}

function ncf_custom_css_str()
{
    $options = ncf_get_options();
    echo "<h6>Stored during updates.</h6><textarea cols='100' rows='10' id='ncf_custom_css' name='ncf_options[ncf_custom_css]' >" . $options['ncf_custom_css'] . "</textarea>";
}

function ncf_fade_content_str () {
    $options = ncf_get_options();
	  $light_checked = $options['ncf_fade_content'] == 'light' ? 'checked="checked"' : '';
    $dark_checked = $options['ncf_fade_content'] == 'dark' ? 'checked="checked"' : '';
    $none_checked = $options['ncf_fade_content'] == 'none' ? 'checked="checked"' : '';
	echo "<h6>When sidebar is exposed.</h6>";
	  echo "<p><input id='ncf_fade_content_light' name='ncf_options[ncf_fade_content]' type='radio' {$light_checked} value='light' style='' /> <label for='ncf_fade_content_light'>Light overlay</label></p>";
   	echo "<p><input id='ncf_fade_content_dark' name='ncf_options[ncf_fade_content]' type='radio' {$dark_checked} value='dark' style='' /> <label for='ncf_fade_content_dark'>Dark overlay</label></p>";
	  echo "<p><input id='ncf_fade_content_none' name='ncf_options[ncf_fade_content]' type='radio' {$none_checked} value='none' style='' /> <label for='ncf_fade_content_none'>Don't fade (recommended if you experience animation lags in Chrome browser on Windows)</label></p>";

}
function ncf_sidebar_pos_str () {
    $options = ncf_get_options();
    $left_checked = $options['ncf_sidebar_pos'] == 'left' ? 'checked="checked"' : '';
    $right_checked = $options['ncf_sidebar_pos'] == 'right' ? 'checked="checked"' : '';

   	echo "<p><input id='ncf_sidebar_pos_left' name='ncf_options[ncf_sidebar_pos]' type='radio' {$left_checked} value='left' style='' /> <label for='ncf_sidebar_pos_left'></label></p>";
   	echo "<p><input id='ncf_sidebar_pos_right' name='ncf_options[ncf_sidebar_pos]' type='radio' {$right_checked} value='right' style='' /> <label for='ncf_sidebar_pos_right'></label></p>";
}


if ( !function_exists('imsanity_get_source')) {

/*
Plugin Name: Imsanity
Plugin URI: http://verysimple.com/products/imsanity/
Description: Imsanity stops insanely huge image uploads
Author: Jason Hinkle
Version: 2.2.5
Author URI: http://verysimple.com/
*/

define('IMSANITY_VERSION','2.2.5');
define('IMSANITY_SCHEMA_VERSION','1.1');

define('IMSANITY_DEFAULT_MAX_WIDTH',110);
define('IMSANITY_DEFAULT_MAX_HEIGHT',110);
define('IMSANITY_DEFAULT_BMP_TO_JPG',1);
define('IMSANITY_DEFAULT_QUALITY',90);

define('IMSANITY_SOURCE_POST',1);
define('IMSANITY_SOURCE_LIBRARY',2);
define('IMSANITY_SOURCE_OTHER',4);


/**
 * Inspects the request and determines where the upload came from
 * @return IMSANITY_SOURCE_POST | IMSANITY_SOURCE_LIBRARY | IMSANITY_SOURCE_OTHER
 */
function imsanity_get_source()
{
	return array_key_exists('post_id', $_REQUEST)
		?  ($_REQUEST['post_id'] == 0 ? IMSANITY_SOURCE_LIBRARY : IMSANITY_SOURCE_POST)
		: IMSANITY_SOURCE_OTHER;
}

/**
 * Given the source, returns the max width/height
 *
 * @example:  list($w,$h) = imsanity_get_max_width_height(IMSANITY_SOURCE_LIBRARY);
 * @param int IMSANITY_SOURCE_POST | IMSANITY_SOURCE_LIBRARY | IMSANITY_SOURCE_OTHER
 */
function imsanity_get_max_width_height($source)
{
	$w = IMSANITY_DEFAULT_MAX_WIDTH;
	$h = IMSANITY_DEFAULT_MAX_HEIGHT;
	return array($w,$h);
}



/**
 * If the uploaded image is a bmp this function handles the details of converting
 * the bmp to a jpg, saves the new file and adjusts the params array as necessary
 *
 * @param array $params
 */
function imsanity_bmp_to_jpg($params)
{

	// read in the bmp file and then save as a new jpg file.
	// if successful, remove the original bmp and alter the return
	// parameters to return the new jpg instead of the bmp

	//include_once('libs/imagecreatefrombmp.php');

	$bmp = imagecreatefrombmp($params['file']);

	// we need to change the extension from .bmp to .jpg so we have to ensure it will be a unique filename
	$uploads = wp_upload_dir();
	$oldFileName = basename($params['file']);
	$newFileName = basename(str_ireplace(".bmp", ".jpg", $oldFileName));
	$newFileName = wp_unique_filename( $uploads['path'], $newFileName );

	$quality = IMSANITY_DEFAULT_QUALITY;

	if (imagejpeg($bmp,$uploads['path'] . '/' . $newFileName, $quality))
	{
		// conversion succeeded.  remove the original bmp & remap the params
		unlink($params['file']);

		$params['file'] = $uploads['path'] . '/' . $newFileName;
		$params['url'] = $uploads['url'] . '/' . $newFileName;
		$params['type'] = 'image/jpeg';
	}
	else
	{
		unlink($params['file']);

		return wp_handle_upload_error( $oldFileName,
			__("Oh Snap! Imsanity was Unable to process the BMP file.  "
			."If you continue to see this error you may need to disable the BMP-To-JPG "
			."feature in Imsanity settings.", 'imsanity' ) );
	}

	return $params;
}

/**
 * ################################################################################
 * UTILITIES
 * ################################################################################
 */

/**
 * Util function returns an array value, if not defined then returns default instead.
 * @param Array $array
 * @param string $key
 * @param variant $default
 */
function imsanity_val($arr,$key,$default='')
{
	return isset($arr[$key]) ? $arr[$key] : $default;
}

/**
 * output a fatal error and optionally die
 *
 * @param string $message
 * @param string $title
 * @param bool $die
 */
function imsanity_fatal($message, $title = "", $die = false)
{
	echo ("<div style='margin:5px 0px 5px 0px;padding:10px;border: solid 1px red; background-color: #ff6666; color: black;'>"
		. ($title ? "<h4 style='font-weight: bold; margin: 3px 0px 8px 0px;'>" . $title . "</h4>" : "")
		. $message
		. "</div>");

	if ($die) die();
}

/**
 * Replacement for deprecated image_resize function
 * @param string $file Image file path.
 * @param int $max_w Maximum width to resize to.
 * @param int $max_h Maximum height to resize to.
 * @param bool $crop Optional. Whether to crop image or resize.
 * @param string $suffix Optional. File suffix.
 * @param string $dest_path Optional. New image file path.
 * @param int $jpeg_quality Optional, default is 90. Image quality percentage.
 * @return mixed WP_Error on failure. String with new destination path.
 */
function imsanity_image_resize( $file, $max_w, $max_h, $crop, $suffix = null, $dest_path = null, $jpeg_quality = 90 ) {

	if (function_exists('wp_get_image_editor'))
	{
		// WP 3.5 and up use the image editor

		$editor = wp_get_image_editor( $file );
		if ( is_wp_error( $editor ) )
			return $editor;
		$editor->set_quality( $jpeg_quality );

		$resized = $editor->resize( $max_w, $max_h, $crop );
		if ( is_wp_error( $resized ) )
			return $resized;

		$dest_file = $editor->generate_filename( $suffix, $dest_path );

		// FIX: make sure that the destination file does not exist.  this fixes
		// an issue during bulk resize where one of the optimized media filenames may get
		// used as the temporary file, which causes it to be deleted.
		while (file_exists($dest_file)) {
			$dest_file = $editor->generate_filename('TMP', $dest_path );
		}

		$saved = $editor->save( $dest_file );

		if ( is_wp_error( $saved ) )
			return $saved;

		return $dest_file;
	}
	else
	{
		// wordpress prior to 3.5 uses the old image_resize function
		return image_resize( $file, $max_w, $max_h, $crop, $suffix, $dest_path, $jpeg_quality);
	}
}
}

/**
 * Handler after a file has been uploaded.  If the file is an image, check the size
 * to see if it is too big and, if so, resize and overwrite the original
 * @param Array $params
 */
function ncf_imsanity_handle_upload($params) {

	$options = ncf_get_options();
	for ($i = 1; $i <= $options['ncf_forms']; $i++) {
		if (isset($_FILES['ncf_pic_'.$i]) && ($_FILES['ncf_pic_'.$i]['size'] > 0)) {
			/* debug logging... */
			// file_put_contents ( "debug.txt" , print_r($params,1) . "\n" );

			/*	$option_convert_bmp = IMSANITY_DEFAULT_BMP_TO_JPG;

				if ($params['type'] == 'image/bmp' && $option_convert_bmp)
				{
					$params = imsanity_bmp_to_jpg($params);
				}*/

			// make sure this is a type of image that we want to convert and that it exists
			// @TODO when uploads occur via RPC the image may not exist at this location
			$oldPath = $params['file'];

			if ( (!is_wp_error($params)) && file_exists($oldPath) && in_array($params['type'], array('image/png','image/gif','image/jpeg')))
			{

				// figure out where the upload is coming from
				$source = imsanity_get_source();

				list($maxW,$maxH) = imsanity_get_max_width_height($source);

				list($oldW, $oldH) = getimagesize( $oldPath );

				/* HACK: if getimagesize returns an incorrect value (sometimes due to bad EXIF data..?)
				$img = imagecreatefromjpeg ($oldPath);
				$oldW = imagesx ($img);
				$oldH = imagesy ($img);
				imagedestroy ($img);
				//*/

				/* HACK: an animated gif may have different frame sizes.  to get the "screen" size
				$data = ''; // TODO: convert file to binary
				$header = unpack('@6/vwidth/vheight', $data );
				$oldW = $header['width'];
				$oldH = $header['width'];
				//*/

				if (($oldW > $maxW && $maxW > 0) || ($oldH > $maxH && $maxH > 0))
				{
					$quality = IMSANITY_DEFAULT_QUALITY;


					list($newW, $newH) = wp_constrain_dimensions($oldW, $oldH, $maxW, $maxH);

					// this is wordpress prior to 3.5 (image_resize deprecated as of 3.5)
					//$resizeResult = imsanity_image_resize( $oldPath, $newW, $newH, true, null, null, $quality);
					$resizeResult = imsanity_image_resize( $oldPath, $maxW, $maxH, true, null, null, $quality);

					/* uncomment to debug error handling code: */
					// $resizeResult = new WP_Error('invalid_image', __(print_r($_REQUEST)), $oldPath);

					// regardless of success/fail we're going to remove the original upload
					unlink($oldPath);

					if (!is_wp_error($resizeResult))
					{
						$newPath = $resizeResult;

						// remove original and replace with re-sized image
						rename($newPath, $oldPath);
					}
					else
					{
						// resize didn't work, likely because the image processing libraries are missing
						$params = wp_handle_upload_error( $oldPath ,
							sprintf( __("Oh Snap! Imsanity was unable to resize this image "
								. "for the following reason: '%s'
						.  If you continue to see this error message, you may need to either install missing server"
								. " components or disable the Imsanity plugin."
								. "  If you think you have discovered a bug, please report it on the Imsanity support forum.", 'imsanity' ) ,$resizeResult->get_error_message() ) );

					}
				}

			}
		}
	};




	return $params;

}

/* add filters to hook into uploads */
add_filter( 'wp_handle_upload', 'ncf_imsanity_handle_upload' );
