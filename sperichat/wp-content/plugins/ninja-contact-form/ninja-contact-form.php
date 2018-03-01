<?php
	  $bg = $options['ncf_image_bg'];
		$theme = $options['ncf_theme'];
?>

<div id="ncf_sidebar" class="ncf_<?php echo $theme . ' ncf_imagebg_' . $bg . ' ncf_up_style_'  . $options['ncf_userpic_style'] . (!empty($options['ncf_invert_style']) ? ' ncf_' . $options['ncf_invert_style'] : '' ) ;?>">
    <div class="ncf_sidebar_cont_scrollable">
        <div class="ncf_sidebar_cont ncf_shrinked">

	        <?php

	        $post_id = get_queried_object_id();

//	        if (function_exists('nks_cc_get_options')) {
//		        //browser()->log(nks_cc_get_options());
//	        } else {
//
//	        }
	        for ($i = 1; $i <= $options['ncf_forms']; $i++) {

		        //browser()->log('indi');
		        //browser()->log($nks_init);
		        if ($options['ncf_form_status_' . $i] !== 'deleted') {
			        $fields = json_decode($options['ncf_additional_fields_' . $i], true);

			        $isDefault = ncf_check_location(json_decode($options['ncf_is_default_' . $i]), $post_id);
                    if (!empty($options['ncf_userpic_' . $i])) {
                        $img = is_ssl() ? str_replace('http:', 'https:', $options['ncf_userpic_' . $i]) :str_replace('https:', 'http:', $options['ncf_userpic_' . $i]) ;
                    }

			        ?>
			        <div class="ncf_form_wrapper ncf_form_<?php echo $i; if ($isDefault) { echo " ncf_default_form"; }; ?>" data-index="<?php echo $i?>">
			        <?php if($options['ncf_theme'] === 'flat'): ?>
				        <div class="ncf_sidebar_header ncf_color1">
					        <div class="ncf_sidebar_socialbar">
						        <ul>
							        <li class="ncf_color1"></li>
							        <li class="ncf_color2"></li>
							        <li class="ncf_color3"></li>
							        <li class="ncf_color4"></li>
							        <li class="ncf_color5"></li>
							        <li class="ncf_color6"></li>
							        <li class="ncf_color7"></li>
							        <li class="ncf_color8"></li>
						        </ul>
					        </div>
					        <?php if(!empty($options['ncf_user_firstname_' . $i]) ||
						        !empty($options['ncf_user_lastname_' . $i]) ||
						        !empty($img) ||
						        !empty($options['ncf_user_title_' . $i])): ?>
						        <div class="ncf_sidebar_header_userinfo ncf_color1">
							        <div class="ncf_userpic"><?php if(isset($img)): ?><img src="<?php echo $img; ?>" alt=""><?php endif; ?></div>
							        <div class="ncf_user_credentials">
								        <span class="ncf_user_firstname"><?php echo $options['ncf_user_firstname_' . $i]; ?></span>
								        <span class="ncf_user_lastname"><?php echo $options['ncf_user_lastname_' . $i]; ?></span>
								        <span class="ncf_user_title"><?php echo $options['ncf_user_title_' . $i]; ?></span>
							        </div>
						        </div>
					        <?php endif; ?>

				        </div>
			        <?php endif; ?>
			        <?php if($theme === 'minimalistic'): ?>
				        <div class="ncf_sidebar_header">

					        <?php if(!empty($options['ncf_user_firstname_' . $i]) ||
						        !empty($options['ncf_user_lastname_' . $i]) ||
						        !empty($options['ncf_userpic_' . $i]) ||
						        !empty($options['ncf_user_title_' . $i])): ?>
						        <div class="ncf_sidebar_header_userinfo">
							        <div class="ncf_userpic"><?php if(isset($img)):
                                            ?><img src="<?php echo $img; ?>" alt=""><?php endif; ?></div>
							        <div class="ncf_user_credentials">
								        <span class="ncf_user_firstname"><?php echo $options['ncf_user_firstname_' . $i]; ?></span>
								        <span class="ncf_user_lastname"><?php echo do_shortcode($options['ncf_user_lastname_' . $i]); ?></span>
								        <span class="ncf_user_title"><?php echo $options['ncf_user_title_' . $i]; ?></span>
							        </div>
						        </div>
					        <?php endif; ?>
					        <div class="ncf_sidebar_socialbar">
						        <ul>
							        <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
						        </ul>
					        </div>

				        </div>
			        <?php endif; ?>

			        <?php if($theme === 'aerial'): ?>
				        <div class="ncf_sidebar_header">
					        <div class="ncf_sidebar_socialbar">
						        <ul>
							        <li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li>
						        </ul>
					        </div>
					        <?php if(!empty($options['ncf_user_firstname_' . $i]) ||
						        !empty($options['ncf_user_lastname_' . $i]) ||
						        !empty($options['ncf_userpic_' . $i]) ||
						        !empty($options['ncf_user_title_' . $i])): ?>
						        <div class="ncf_sidebar_header_userinfo">
							        <div class="ncf_userpic"><?php if(isset($img)): ?><img src="<?php echo $img; ?>" alt=""><?php endif; ?></div>
							        <div class="ncf_user_credentials">
								        <span class="ncf_user_firstname"><?php echo $options['ncf_user_firstname_' . $i]; ?></span>
								        <span class="ncf_user_lastname"><?php echo $options['ncf_user_lastname_' . $i]; ?></span>
								        <span class="ncf_user_title"><?php echo $options['ncf_user_title_' . $i]; ?></span>
							        </div>
						        </div>
					        <?php endif; ?>
				        </div>
			        <?php endif; ?>

			        <div class="ncf_sidebar_content">
				        <div class="ncf_user_bio"><?php echo $options['ncf_user_bio_' . $i]; ?>
				        </div>
				        <?php if(empty($options['ncf_form7_' . $i])): ?>
					        <form class="ncf_form" action="" id="nk_form_<?php echo $i; ?>">
						        <input type="hidden" name="action" value="ncf_send_message" />
						        <input type="hidden" name="ncf_form_index" value="<?php echo $i; ?>" />

						        <div class="ncf_form_input_wrapper ncf_name_field ncf_ph">
							        <input type="text" name="ncf_name_field" id="ncf_name_field" data-rules="required|min[2]|max[32]" data-name="<?php _e( "Your name", 'ninja-contact-form' ); ?>"><label for="ncf_name_field"><?php _e( "Your name", 'ninja-contact-form' ); ?> *</label>
						        </div>
						        <?php if($fields['company']['on']): ?>
							        <div class="ncf_form_input_wrapper ncf_company_field ncf_ph" >
								        <input type="text" name="ncf_company_field" id="ncf_company_field" <?php if($fields['company']['required']) echo 'data-rules="required" ';?>data-name="<?php _e( "Your company", 'ninja-contact-form' ); ?>"><label for="ncf_company_field"><?php _e( "Your company", 'ninja-contact-form' ); ?><?php if($fields['company']['required']) echo ' *';?></label>
							        </div>
						        <?php endif; ?>
						        <?php if($fields['phone']['on']): ?>
							        <div class="ncf_form_input_wrapper ncf_phone_field ncf_ph" >
								        <input type="text" name="ncf_phone_field" id="ncf_phone_field" <?php if($fields['phone']['required']) echo 'data-rules="required|numeric" ';?>data-name="<?php _e( "Your phone", 'ninja-contact-form' ); ?>"><label for="ncf_phone_field"><?php _e( "Your phone", 'ninja-contact-form' ); ?><?php if($fields['phone']['required']) echo ' *';?></label>
							        </div>
						        <?php endif; ?>
						        <?php if($fields['address']['on']): ?>
							        <div class="ncf_form_input_wrapper ncf_address_field ncf_ph" >
								        <input type="text" name="ncf_address_field" id="ncf_address_field" <?php if($fields['address']['required']) echo 'data-rules="required" ';?>data-name="<?php _e( "Your address", 'ninja-contact-form' ); ?>"><label for="ncf_address_field"><?php _e( "Your address", 'ninja-contact-form' ); ?><?php if($fields['address']['required']) echo ' *';?></label>
							        </div>
						        <?php endif; ?>
						        <div class="ncf_form_input_wrapper ncf_email_field ncf_ph" >
							        <input type="email" name="ncf_email_field" id="ncf_email_field" data-rules="required|email" data-name="<?php _e( "Your e-mail", 'ninja-contact-form' ); ?>"><label for="ncf_email_field"><?php _e( "Your e-mail", 'ninja-contact-form' ); ?> *</label>
						        </div>
						        <?php if($fields['subject']['on']): ?>
							        <div class="ncf_form_input_wrapper ncf_subject_field ncf_ph" >
								        <input type="text" name="ncf_subject_field" id="ncf_subject_field" <?php if($fields['subject']['required']) echo 'data-rules="required" ';?>data-name="<?php _e( "Email subject", 'ninja-contact-form' ); ?>"><label for="ncf_subject_field"><?php _e( "Email subject", 'ninja-contact-form' ); ?><?php if($fields['subject']['required']) echo ' *';?></label>
							        </div>
						        <?php endif; ?>
						        <div class="ncf_form_input_wrapper ncf_message_field ncf_ph">
							        <textarea name="ncf_message_field" id="ncf_message_field" cols="30" rows="10"  data-rules="required" data-name="<?php _e( "Your message", 'ninja-contact-form' ); ?>"></textarea><label for="ncf_message_field"><?php _e( "Your message", 'ninja-contact-form' ); ?> *</label>
						        </div>
						        <?php if(!empty($options['ncf_mc_token']) && !empty($options['ncf_mc_lists']) && !empty($options['ncf_mc_list_id'])): ?>
							        <div class="ncf_form_input_wrapper ncf_noselect">
								        <input type="checkbox" name="ncf_subscriber_<?php echo $i?>" id="ncf_subscriber_<?php echo $i?>"><label for="ncf_subscriber_<?php echo $i?>"><?php _e( $options['ncf_sub_question'], 'ninja-contact-form' ); ?></label>
							        </div>
						        <?php endif; ?>
						        <div class="ncf_form_btn_wrapper">
							        <?php if(!empty($options['ncf_enable_test'])): ?>
								        <div class="ncf_question_wrapper ncf_ph"><input type="text" name="ncf_answer_field" id="ncf_answer_field"  maxlength="2" data-rules="required|numeric" data-name="<?php _e( "Answer", 'ninja-contact-form' ); ?>"><label id="ncf_question" for="ncf_answer_field">3 + 4 = </label>
								        </div>
							        <?php endif; ?>
							        <a class="ncf_button <?php echo $theme === 'flat' ? 'ncf_color8' : 'ncf_color1'; ?>" href="#"><span><?php _e( "Send", 'ninja-contact-form' ); ?></span></a>
							        <input type="submit" value="Send"/>
						        </div>
					        </form>
				        <?php else : ?> <?php echo do_shortcode($options['ncf_form7_' . $i]); ?>
				        <?php endif; ?>

				        <div class="ncf_form_result"></div>
			        </div>
			        </div>
	            <?php
		        }
	        }
	        ?>
        </div>
    </div>
</div>
<div id="ncf-overlay-wrapper"><div id="ncf-overlay"></div></div>

