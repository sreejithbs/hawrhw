<?php
/*
Plugin Name: Ninja Kick: Contact Form
Plugin URI: contactform.looks-awesome.com
Description: Push/Sliding Contact Form on every page of your site.
Version: 3.4.3
Author: Looks Awesome
Author URI: http://looks-awesome.com
License: Commercial License
Text Domain: ninja-contact-form
Domain Path: /lang
*/


global $ncf_options;

load_plugin_textdomain('ninja-contact-form', false, basename( dirname( __FILE__ ) ) . '/lang' );

if (!defined('NCF_VERSION_KEY')) {
    define('NCF_VERSION_KEY', 'ncf_version');
}

if (!defined('NCF_VERSION_NUM')) {
    define('NCF_VERSION_NUM', '3.4.3');
}

add_option(NCF_VERSION_KEY, NCF_VERSION_NUM);


// if user signed in
add_action( 'wp_ajax_ncf_send_message', 'ncf_send_message' );
// if user not signed in
add_action( 'wp_ajax_nopriv_ncf_send_message', 'ncf_send_message' );


add_action( 'admin_menu', 'ncf_menu' );


function ncf_menu() {
    add_options_page( 'NK: Contact Form', '<span style="display: inline-block;border-left:3px solid #48ab7c; padding-left:3px;position: relative;left: -6px;">NK: Contact Form</span>', 'manage_options', 'ninja-contact-form-options', 'ninja_contact_form_page' );
}

add_action( 'admin_init', 'ncf_register_settings_page' );

function ncf_register_settings_page () {
    register_setting( 'ncf_options', 'ncf_options', 'ncf_options_validate' );
}

function ncf_options_validate($plugin_options) {


    for ($i = 1; $i <= $plugin_options['ncf_forms']; $i++) {

        if (isset($plugin_options['ncf_form_status_' . $i]) && $plugin_options['ncf_form_status_' . $i] == 'deleted') {
            // TODO for loop
            unset($plugin_options['ncf_email_' . $i]);
            unset($plugin_options['ncf_email_title_' . $i]);
            unset($plugin_options['ncf_additional_fields_' . $i]);
            unset($plugin_options['ncf_form7_' . $i]);
            unset($plugin_options['ncf_userpic_' . $i]);
            unset($plugin_options['ncf_user_firstname_' . $i]);
            unset($plugin_options['ncf_user_lastname_' . $i]);
            unset($plugin_options['ncf_user_title_' . $i]);
            unset($plugin_options['ncf_user_bio_' . $i]);
            unset($plugin_options['ncf_success_message_' . $i]);
            unset($plugin_options['ncf_show_social_' . $i]);
            unset($plugin_options['ncf_facebook_' . $i]);
            unset($plugin_options['ncf_twitter_' . $i]);
            unset($plugin_options['ncf_pinterest_' . $i]);
            unset($plugin_options['ncf_instagram_' . $i]);
            unset($plugin_options['ncf_linkedin_' . $i]);
            unset($plugin_options['ncf_gplus_' . $i]);
            unset($plugin_options['ncf_rss_' . $i]);

//			  browser()->log($plugin_options);
//			  die();

        } else if (isset($_FILES['ncf_pic_'.$i]) && ($_FILES['ncf_pic_'.$i]['size'] > 0)) {
            // Get the type of the uploaded file. This is returned as "type/extension"
            $arr_file_type = wp_check_filetype(basename($_FILES['ncf_pic_'.$i]['name']));
            $uploaded_file_type = $arr_file_type['type'];

            // Set an array containing a list of acceptable formats
            $allowed_file_types = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');

            // If the uploaded file is the right format
            if (in_array($uploaded_file_type, $allowed_file_types)) {

                // Options array for the wp_handle_upload function. 'test_upload' => false
                $upload_overrides = array('test_form' => false);

                add_filter('wp_handle_upload_prefilter', 'ncf_upload_filter' );

                //delete previous
                //if (isset($plugin_options['ncf_userpic'])) unlink($plugin_options['ncf_userpic']);

                // Handle the upload using WP's wp_handle_upload function. Takes the posted file and an options array
                $uploaded_file = wp_handle_upload($_FILES['ncf_pic_'.$i], $upload_overrides);

                // If the wp_handle_upload call returned a local path for the image
                if (isset($uploaded_file['file'])) {
                    // The wp_insert_attachment function needs the literal system path, which was passed back from wp_handle_upload
                    $file_name_and_location = $uploaded_file['file'];
                    $wp_upload_dir = wp_upload_dir();
                    $plugin_options['ncf_userpic_'.$i] = $wp_upload_dir['url'] . '/' . basename ($file_name_and_location);
                } else { // wp_handle_upload returned some kind of error. the return does contain error details, so you can use it here if you want.
                    $upload_feedback = 'There was a problem with your upload.';
                }

            } else { // wrong file type
                $upload_feedback = 'Please upload only image files (jpg, gif or png).';
            }

        }
    }
    if (isset($_FILES['ncf_custom_bg']) && ($_FILES['ncf_custom_bg']['size'] > 0)) {

        // Get the type of the uploaded file. This is returned as "type/extension"
        $arr_file_type = wp_check_filetype(basename($_FILES['ncf_custom_bg']['name']));
        $uploaded_file_type = $arr_file_type['type'];

        // Set an array containing a list of acceptable formats
        $allowed_file_types = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');

        // If the uploaded file is the right format
        if (in_array($uploaded_file_type, $allowed_file_types)) {

            // Options array for the wp_handle_upload function. 'test_upload' => false
            $upload_overrides = array('test_form' => false);


            //delete previous
            //if (isset($plugin_options['ncf_custom_bg'])) unlink($plugin_options['ncf_custom_bg']);

            $uploaded_file = wp_handle_upload($_FILES['ncf_custom_bg'], $upload_overrides);

            // If the wp_handle_upload call returned a local path for the image
            if (isset($uploaded_file['file'])) {
                // The wp_insert_attachment function needs the literal system path, which was passed back from wp_handle_upload
                $file_name_and_location = $uploaded_file['file'];
                $wp_upload_dir = wp_upload_dir();
                $plugin_options['ncf_custom_bg'] = $wp_upload_dir['url'] . '/' . basename($file_name_and_location);
            } else { // wp_handle_upload returned some kind of error. the return does contain error details, so you can use it here if you want.
                $upload_feedback = 'There was a problem with your upload.';
            }

        } else { // wrong file type
            $upload_feedback = 'Please upload only image files (jpg, gif or png).';
        }

    } else { // No file was passed
        $upload_feedback = false;
    }
    return $plugin_options;
}



/**
 * Settings page in the WP Admin
 */
function ninja_contact_form_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'ninja-contact-form' ) );
    }

    include_once(dirname(__FILE__) . '/settings.php');
    if(!class_exists('NCF_MailChimp')) include_once('include/Mailchimp.php');

    ncf_register_settings();

    wp_enqueue_script("jquery");
    wp_enqueue_script( 'ncf_tinycolor', plugins_url('/js/tinycolor.js', __FILE__) );
    wp_enqueue_script( 'ncf_colorpickersliders', plugins_url('/js/jquery.colorpickersliders.js', __FILE__) );
    wp_enqueue_script( 'ncf_admin', plugins_url('/js/admin.js', __FILE__) );

    //wp_register_style('open-sans-font', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300' );
    wp_register_style('ncf_lato_font', '//fonts.googleapis.com/css?family=Lato:300normal,400normal,400italic,600normal&subset=all' );

    wp_enqueue_style( 'ncf_lato_font' );
    wp_register_style('colorpickersliders-ui-css', plugins_url('/css/jquery.colorpickersliders.css', __FILE__));
    wp_enqueue_style( 'colorpickersliders-ui-css' );

    wp_register_style('ncf-admin-css', plugins_url('/css/admin.css', __FILE__));
    wp_enqueue_style( 'ncf-admin-css' );

    include_once(dirname(__FILE__) . '/options-page.php');
}


add_filter('plugin_action_links_ninja-contact-form/main.php', 'ncf_plugin_action_links', 10, 1);

function ncf_plugin_action_links($links) {
    $settings_page = add_query_arg(array('page' => 'ninja-contact-form-options'), admin_url('options-general.php'));
    $settings_link = '<a href="'.esc_url($settings_page).'">'.__('Settings', 'ninja-contact-form' ).'</a>';
    array_unshift($links, $settings_link);
    return $links;
}

add_action('wp_enqueue_scripts', 'ncf_scripts');

add_action('wp_head', 'ncf_dynamic_css');
add_action('wp_footer', 'ncf_main_html');

function ncf_scripts() {
    global $ncf_show;
    $options = ncf_get_options();
    $post_id = get_queried_object_id();
    if ($options['ncf_test_mode'] === 'yes' && !current_user_can( 'manage_options' ) ) return;

    $ncf_show = ncf_check_display_rule(json_decode($options['ncf_display']), wp_is_mobile(), $post_id);

    if ($ncf_show) {

        wp_enqueue_script(
            'ncf_main_js',
//		  plugins_url('/js/ninja-contact-form.js', __FILE__),
           plugins_url('/js/ninja-contact-form.min.js', __FILE__),
            array( 'jquery' )
        );

        $social = array();

        $errors = array(
            "required" => __("* Please enter %%", 'ninja-contact-form' ),
            "min" => __("* %% must have at least %% characters.", 'ninja-contact-form' ),
            "max" => __("* %% can have at most %% characters.", 'ninja-contact-form' ),
            "matches" => __("* %% must match %%.", 'ninja-contact-form' ),
            "less" => __("* %% must be less than %%", 'ninja-contact-form' ),
            "greater" => __("* %% must be greater than %%.", 'ninja-contact-form' ),
            "numeric" => __("* %% must be numeric.", 'ninja-contact-form' ),
            "email" => __("* %% must be a valid email address.", 'ninja-contact-form' ),
            "ip" => __("* %% must be a valid ip address.", 'ninja-contact-form' ),
            "answer" => __("* Wrong %%", 'ninja-contact-form' )
        );

        $js_opts = array(
            'ajaxurl' => admin_url( 'admin-ajax.php', is_ssl() ),
            'sidebar_type' => $options['ncf_sidebar_type'],
            'theme' => $options['ncf_theme'],
            'sidebar_pos' => $options['ncf_sidebar_pos'],
            'flat_socialbar' => $options['ncf_flat_socialbar'],
            'base_color' => $options['ncf_base_color'],
            'humantest' => $options['ncf_enable_test'],
            'fade_content' => $options['ncf_fade_content'],
            'label' => $options['ncf_label_style'],
            'label_top' => $options['ncf_label_top'],
            'label_vis' => $options['ncf_label_vis'],
            'label_scroll_selector' => $options['ncf_label_vis_selector'],
            'label_mouseover' => $options['ncf_label_mouseover'],
            'bg' => $options['ncf_image_bg'],
            'togglers' => $options['ncf_togglers'],
            'path' => plugins_url('/img/', __FILE__),
            'scroll' => $options['ncf_scroll'],
            'send_more_text' => __( "Send more", 'ninja-contact-form' ),
            'try_again_text' => __( "Try again", 'ninja-contact-form' ),
            'close_text' => __( "Close", 'ninja-contact-form' ),
            'sending_text' => __( "Sending", 'ninja-contact-form' ),
            'msg_fail_text' => __( "Something went wrong while sending your message", 'ninja-contact-form' ),
            'errors' => $errors
        );

        for ($i = 1; $i <= $options['ncf_forms']; $i++) {
            if ($options['ncf_form_status_' . $i] !== 'live') continue;
            if (!empty($options['ncf_facebook_' . $i])) $social[$i]['ncf_facebook'] = $options['ncf_facebook_' . $i];
            if (!empty($options['ncf_twitter_' . $i])) $social[$i]['ncf_twitter'] = $options['ncf_twitter_' . $i];
            if (!empty($options['ncf_pinterest_' . $i])) $social[$i]['ncf_pinterest'] = $options['ncf_pinterest_' . $i];
            if (!empty($options['ncf_youtube_' . $i])) $social[$i]['ncf_youtube'] = $options['ncf_youtube_' . $i];
            if (!empty($options['ncf_instagram_' . $i])) $social[$i]['ncf_instagram'] = $options['ncf_instagram_' . $i];
            if (!empty($options['ncf_linkedin_' . $i])) $social[$i]['ncf_linkedin'] = $options['ncf_linkedin_' . $i];
            if (!empty($options['ncf_gplus_' . $i])) $social[$i]['ncf_gplus'] = $options['ncf_gplus_' . $i];
            if (!empty($options['ncf_rss_' . $i])) $social[$i]['ncf_rss'] = $options['ncf_rss_' . $i];
            $js_opts['id'.$i]['success'] = $options['ncf_success_message_' . $i];
        }

        $js_opts['social'] = $social;
        $js_opts['plugin_ver'] = NCF_VERSION_NUM;

        wp_localize_script( 'ncf_main_js', 'NinjaContactFormOpts', $js_opts);

        wp_register_style('ncf_lato_font', '//fonts.googleapis.com/css?family=Lato:300normal,400normal,400italic,600normal,600italic&subset=all' );
        wp_enqueue_style( 'ncf_lato_font' );
        wp_register_style( 'ncf_styles', plugins_url('/css/ninja-contact-form.css', __FILE__) );
        wp_enqueue_style( 'ncf_styles' );
    }
}


function ncf_dynamic_css() {
    global $ncf_show;
    $options = ncf_get_options();
    if ($options['ncf_test_mode'] === 'yes' && !current_user_can( 'manage_options' ) ) return;

    if (isset($ncf_show) && $ncf_show) {
        include_once(dirname(__FILE__) . '/ncf-dynamic.php');
    }
}
function ncf_main_html() {
    global $ncf_show;
    $options = ncf_get_options();
    if ($options['ncf_test_mode'] === 'yes' && !current_user_can( 'manage_options' ) ) return;

    if (isset($ncf_show) && $ncf_show) {
        include_once(dirname(__FILE__) . '/ninja-contact-form.php');
    }
}

function ncf_send_message() {
    global $wpdb;
    $options = ncf_get_options();

    $blogname = htmlspecialchars_decode(get_bloginfo('name'));

    // writing log
    $time = date( "F jS Y, H:i", time()+25200 );
    $sender = $_POST['ncf_name_field'];
    //$msg = $_POST['ncf_message_field'];
    $msg = stripslashes($_POST['ncf_message_field']);
    $email = $_POST['ncf_email_field'];
    $subj = isset($_POST['ncf_subject_field']) && !empty($_POST['ncf_subject_field']) ? htmlspecialchars_decode($_POST['ncf_subject_field']) : FALSE;
    $company = isset($_POST['ncf_company_field']) && !empty($_POST['ncf_company_field']) ? $_POST['ncf_company_field'] : FALSE;
    $phone = isset($_POST['ncf_phone_field']) && !empty($_POST['ncf_phone_field']) ? $_POST['ncf_phone_field'] : FALSE;
    $address = isset($_POST['ncf_address_field']) && !empty($_POST['ncf_address_field']) ? $_POST['ncf_address_field'] : FALSE;
    $ban = "#$time\r\n"
        .   ($subj ? ('Subject: ' . $subj . "\r\n") : '')
        .   "Sender: $sender\r\n"
        .   ($company ? ('Company: ' . $company . "\r\n") : '')
        .   ($phone ? ('Phone: ' . $phone . "\r\n") : '')
        .   ($address ? ('Address: ' . $address . "\r\n") : '')
        . "User wants to subscribe: " . (isset($_POST['ncf_subscriber_' . $_POST['ncf_form_index']]) && !empty($_POST['ncf_subscriber_' . $_POST['ncf_form_index']]) ? 'Yes' . "\r\n" : 'No' . "\r\n")
        . "Email: $email\r\n"
        . "Message: $msg\r\n\r\n";
    $file = plugin_dir_path( __FILE__ ) . '/message_log.txt';
    $oldContents = file_get_contents($file);

    $oldLevel = error_reporting();
    error_reporting(E_ALL ^ E_WARNING);
    $fr = fopen($file, 'w');
    fwrite($fr, $ban);
    fwrite($fr, $oldContents);
//	$open = fopen( $file, "c" );
//	$write = fputs( $open, $ban );
    fclose( $fr );
    error_reporting($oldLevel);

    $subscriber = 'no subscriber';

    if (isset($_POST['ncf_subscriber_' . $_POST['ncf_form_index']]) && !empty($_POST['ncf_subscriber_' . $_POST['ncf_form_index']])) {
        if (!class_exists('NCF_MailChimp')) include_once('include/Mailchimp.php'); // new API
        $exploded = explode(' ', $sender);

        if (isset($exploded[0]) && isset($exploded[1])) {
            $lastname = str_replace($exploded[0] + ' ', '', $sender);
        }
        $subscriber = ncf_add_subscriber($email, $options['ncf_mc_token'], $options['ncf_mc_list_id'], isset($exploded[0]) ? $exploded[0] : $sender, isset($lastname) ? $lastname : '');
    }

    //$lists = ncf_get_MC_lists();

    // get the submitted parameters
    $headers = array();
    $headers[] = 'From: ' . ($options['ncf_use_admin_email'] === 'enable' ? $blogname . ' Admin' : $sender) . ' <' . str_replace(array("\r", "\n", "\n", "\t", ",", ";"), '', ($options['ncf_use_admin_email'] === 'enable' ? get_bloginfo('admin_email') : $email)). ">\r\n";
    $headers[] = 'Content-type: text/html';
    $headers[] = 'Reply-To: ' . $email;
    $ip = ncf_get_ip_address();
    $server = array_merge(array('HTTP_HOST'=>null, 'REQUEST_URI'=>null, 'HTTP_REFERER'=>null, 'HTTP_USER_AGENT'=>null), $_SERVER);

    $subject = $subj ? $subj : (htmlspecialchars_decode($blogname) . ' ' . @$options['ncf_email_title_' . $_POST['ncf_form_index']]);
    $header = '<html>
				<head>
					<title>'. $subject .'</title>
				</head>
				<body>
				<div id="email_container" style="background: #F1F1F1;padding: 40px 20px;">
				<div style="width:90%; padding:8px 20px 8px 20px; background:#fff; margin:0 auto;box-sizing: border-box;
				moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; color:#454545;line-height:1.5em; " id="email_content">';

    $footer = '<div style="text-align:center; border-top:1px solid #eee;padding:5px 0 0 0;" id="email_footer">
						<small style="font-size:11px; color:#999; line-height:14px;">
							' . __('Sent via Ninja Kick: Contact Form plugin', 'ninja-contact-form') . '
						</small>
					</div>
				</div>
			</div>
		</body>
	</html>';
    $footer = '';



    $result = wp_mail( 'manu@mailinator.com', 'test if mail works', 'hurray' );
    // wp_mail(
    //     isset($_POST['send_to']) ? $_POST['send_to'] : $options['ncf_email_' . $_POST['ncf_form_index']],
    //     $subj ? $subj : ($blogname . ' ' . @$options['ncf_email_title_' . $_POST['ncf_form_index']] . ': ' . $sender),
    //     $header .
    //     '<p><strong>'.__('Name', 'ninja-contact-form') . '</strong>: ' .  $sender  . "</p>" .
    //     ($company ? ('<p><strong>'.__('Company', 'ninja-contact-form') . '</strong>: ' . $company . "</p>") : '') .
    //     ($phone ? ('<p><strong>'.__('Phone', 'ninja-contact-form') . '</strong>: ' . $phone . "</p>") : '') .
    //     ($address ? ('<p><strong>'.__('Address', 'ninja-contact-form') . '</strong>: ' . $address . "</p>") : '') .
    //     '<p><strong>'.__('Email', 'ninja-contact-form') . '</strong>: ' .  $email  . "</p>" .
    //     '<p><strong>'.__('Sent from page', 'ninja-contact-form') . '</strong>: ' . ($server['HTTP_REFERER'] ? $server['HTTP_REFERER'] : 'Page not detected') . "</p>" .
    //     '<p><strong>'.__('Subscription', 'ninja-contact-form') . '</strong>: ' .  (isset($_POST['ncf_subscriber_' . $_POST['ncf_form_index']]) && !empty($_POST['ncf_subscriber_' . $_POST['ncf_form_index']]) ?  'Agreed' : 'Not agreed')  . "\n" .
    //     '<p><strong>'.__('IP', 'ninja-contact-form') . '</strong>: ' . (isset($ip) ? $ip : 'IP not detected') . "</p>" .
    //     '<p><strong>'.__('Browser info', 'ninja-contact-form') . '</strong>: ' . ($server['HTTP_USER_AGENT'] ? $server['HTTP_USER_AGENT'] : 'Browser not detected') . "</p>" .
    //     "<p style='border-top:1px solid #eee;padding:20px 0 0 0;'><strong>".__('Message', 'ninja-contact-form') . "</strong>: </p>" .
    //     "<p>" . $msg . "</p>" .
    //     $footer,
    //     $headers
    // );

    var_dump($result);

    if ($options['ncf_autoresponder'] === 'enable') {
        $headers = array();
        $headers[] = 'From: ' . $blogname . ' Admin' . ' <' . str_replace(array("\r", "\n", "\n", "\t", ",", ";"), '', ($options['ncf_use_admin_email'] === 'enable' ? get_bloginfo('admin_email') : $email)). ">\r\n";
        $headers[] = 'Content-type: text/html';
        $headers[] = 'Reply-To: ' . get_bloginfo('admin_email');
        $copy = wp_mail(
            $email,
            'Your contact form submission to ' . get_bloginfo('name'),
            $header .
            '<p><strong>Name</strong>: ' .  $sender  . "</p>" .
            ($company ? ('<p><strong>Company</strong>: ' . $company . "</p>") : '') .
            ($phone ? ('<p><strong>Phone</strong>: ' . $phone . "</p>") : '') .
            ($address ? ('<p><strong>Address</strong>: ' . $address . "</p>") : '') .
            '<p><strong>Email</strong>: ' .  $email  . "</p>" .
            "<p><strong>Message</strong>:</p>" .
            "<p>" . $msg . "</p>" .
            $footer,
            $headers
        );
    }

    if($result) {
        echo json_encode(array('success' => true, 'result' => $result, 'sub' => $subscriber ));
        die();
    }

    echo json_encode(array('success' => false, 'message' => __("Message not sent. An unknown error occurred.", 'ninja-contact-form' ), 'result' => $result));
    die();

}

function ncf_get_MC_lists($token)
{
    $mailLists = array();

    try {
        $mc = new NCF_MailChimp($token);
        $lists = $mc->get('lists');

        if ( $mc->success() ) {
            foreach ($lists['lists'] as $listItem) {
                array_push($mailLists, array($listItem['id'], str_replace("'", '`', str_replace('"', '`', $listItem['name']))));
            }
        } else {
            array_push($mailLists, array('xxxxxx', 'Token is invalid, no lists pulled'));
        }

    }catch(Exception $e){
        array_push($mailLists, array('xxxxxx', 'Token is invalid, no lists pulled'));
    }

    return $mailLists;
}

function ncf_add_subscriber($email, $token, $list,  $first_name = '', $last_name = '', $phone = NULL, $city = NULL)
{
    $response = array();

    if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $mc = new NCF_MailChimp($token);

            try {
                //$response = $mc->lists->subscribe($list, array('email' => $email, 'FNAME' => $first_name, 'LNAME' => $last_name), 'html', false, true, true, true);
                $response = $mc->post("lists/" . $list . "/members", array(
                    'email_address' => $email,
                    'status'        => 'subscribed',
                    'merge_fields' => array('FNAME'=>$first_name, 'LNAME'=>$last_name)
                ));
                $ml_last_error = '';
            } catch (Exception $e) {
                $response['error'] = 'Error in subscription.';
                $ml_last_error = 'already_subscribed';
            }

        }catch(Exception $e){
            $response['error'] = 'Exception during the call.';
            print_r("<!-- NINJA ERROR \n\n\n".var_export($e, true)."\n\n\n-->");
        }
    } else {
        $response['error'] = 'Invalid email address.';
    }

    $response['fname'] = $first_name;
    $response['lname'] = $last_name;

    return $response;
}

function ncf_get_ip_address() {
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                    return $ip;
                }
            }
        }
    }
}

function ncf_is_mobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function ncf_get_lang_id($id, $type = 'page') {
    if ( function_exists('icl_object_id') ) {
        $id = icl_object_id($id, $type, true);
    }

    return $id;
}

function ncf_check_location ($opt, $post_id) {

    if ( is_home() ) {

        //browser()->log  ( 'home' );

        $show = isset($opt->location->wp_pages->home);
        if ( !$show && $post_id ){
            $show = isset($opt->location->pages->$post_id);
        }

        // check if blog page is front page too
        if ( !$show && is_front_page() /*&& isset($opt['page-front'])*/ ) {
            //browser()->log  ( 'home front' );
            $show = isset($opt->location->wp_pages->front);
        }

    } else if ( is_front_page() ) {
        //browser()->log  ( 'front' );

        $show = isset($opt->location->wp_pages->front);
        if ( !$show && $post_id ) {
            $show = isset($opt->location->pages->$post_id);
        }
    } else if ( is_category() ) {
        //browser()->log  ( 'cat' );
        //browser()->log  ( get_query_var('cat') );
        $catid = get_query_var('cat');
        $show = isset($opt->location->cats->$catid);
    } /*else if ( is_tax() ) {
				$term = get_queried_object();
				$tax = $term->taxonomy;
				$show = isset($opt->location->cats->$tax);
				unset($term);
				unset($tax);
			} else if ( is_post_type_archive() ) {
				$type = get_post_type();
				$show = isset($opt['type-'. $type .'-archive']) ? $opt['type-'. $type .'-archive'] : false;
			}*/ else if ( is_archive() ) {
        //browser()->log  ( 'archive' );

        $show = isset($opt->location->wp_pages->archive);
    } else if ( is_single() ) {
        //browser()->log  ( 'single' );

        $type = get_post_type();
        $show = isset($opt->location->wp_pages->single);

        if ( !$show  && $type != 'page' && $type != 'post') {
            $show = isset($opt->location->cposts->$type);
        }

        if ( !$show ) {
            $cats = get_the_category();
            foreach ( $cats as $cat ) {
                if ($show) break;
                $c_id = ncf_get_lang_id($cat->cat_ID, 'category');
                $show = isset($opt->location->cats->$c_id);
                unset($c_id);
                unset($cat);
            }
        }

    } else if ( is_404() ) {
        $show = isset($opt->location->wp_pages->forbidden);
        //browser()->log  ( '404' );
        //browser()->log  ( isset($opt->location->wp_pages->forbidden));

    } else if ( is_search() ) {
        //browser()->log  ( 'search' );

        $show = isset($opt->location->wp_pages->search);
    } else if ( $post_id ) {
        //browser()->log  ( 'post id' );

        $show = isset($opt->location->pages->$post_id);
    } else {
        //browser()->log  ( 'super else' );

        $show = false;
    }

    if ( $post_id && !$show && isset($opt->location->ids) && !empty($opt->location->ids) ) {
        //browser()->log  ( 'ids' );

        $other_ids = $opt->location->ids;
        foreach ( $other_ids as $other_id ) {
            if ( $post_id == (int) $other_id ) {
                $show = true;
            }
        }
    }

    if ( !$show && defined('ICL_LANGUAGE_CODE') ) {
        // check for WPML widgets
        $lang = ICL_LANGUAGE_CODE;
        $show = isset($opt->location->langs->$lang );
    }

    if ( !isset($show) ) {
        //browser()->log  ( '!isset($show)' );
        $show = false;
    }

    return $show;
}

function ncf_check_display_rule($opt, $isMobile, $post_id) {

    $show = ncf_check_location($opt, $post_id);

    //browser()->log  ( '>>>> inclusion' );
    //browser()->log  ( $show );

    if ($show && $opt->rule->exclude || !$show && $opt->rule->include ) {
        $show = false;
    } else  {
        $show = true;
    }

    $user_ID = is_user_logged_in();
    //browser()->log  ( '>>>> loggedin' );
    //browser()->log  ( $user_ID );
    //browser()->log  ( '>>>> checked' );
    //browser()->log  ( $show );

    if ( ( $opt->user->loggedout && $user_ID ) || ( $opt->user->loggedin && !$user_ID ) ) {
        $show = false;
    }

    if ( $opt->mobile->no && $isMobile) {
        $show = false;
    }

    return $show;
}

function ncf_upload_filter( $file ){
    $arr = wp_check_filetype(basename($file['name']));
    $type = $arr['type'];
    $file['name'] = 'ncf_userpic.' . str_replace('image/', '', $type);
    return $file;
}

function ncf_debug_to_console($data) {
    if(is_array($data) || is_object($data))
    {
        echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
    } else {
        echo("<script>console.log('PHP: ".$data."');</script>");
    }
}

global $ncf_cached_opts;

function ncf_get_options()
{
    global $ncf_cached_opts;

    if (isset($ncf_cached_opts)) return $ncf_cached_opts;

    $options = get_option('ncf_options');

    if (empty($options['ncf_forms'])) {
        $options['ncf_forms'] = 1;
    }

    if (empty($options['ncf_test_mode'])) {
        $options['ncf_test_mode'] = '';
    }
    if (empty($options['ncf_body'])) {
        $options['ncf_body'] = '';
    }

    if (empty($options['ncf_mc_token'])) {
        $options['ncf_mc_token'] = '';
    }
    if (empty($options['ncf_mc_lists'])) {
        $options['ncf_mc_lists'] = '';
    }
    if (empty($options['ncf_mc_list_id'])) {
        $options['ncf_mc_list_id'] = '';
    }
    if (empty($options['ncf_sub_question'])) {
        $options['ncf_sub_question'] = 'Subscribe to our news?';
    }

    $options['locations'] = ncf_get_locations();

    // FORMS

    if (!isset($options['ncf_is_default_1'])) {

        $options['ncf_is_default_1'] = (object)array(
            "location" => (object)array(
                    "pages" => (object)array(),
                    "cposts" => (object)array(),
                    "cats" => (object)array(),
                    "taxes" => (object)array(),
                    "langs" => (object)array(),
                    "wp_pages" => (object)array(),
                    "ids" => array()
                )
        );

        foreach ($options['locations']->wp_pages as $key => $label) {
            $options['ncf_is_default_1']->location->wp_pages->$key = true;
        }

        foreach ( $options['locations']->pages as $page ) {
            $id = $page->ID;
            $options['ncf_is_default_1']->location->pages->$id = true;
        }

        if ( !empty($options['locations']->cposts) ) {
            foreach ( $options['locations']->cposts as $post_key => $custom_post ) {
                $options['ncf_is_default_1']->location->cposts->$post_key = true;
                unset($post_key);
                unset($custom_post);
            }
        }

        foreach ( $options['locations']->cats as $cat ) {
            $catid = $cat->cat_ID;
            $options['ncf_is_default_1']->location->cats->$catid = true;
            unset($cat);
        }

        if ( !empty($options['locations']->langs) ) {
            foreach ( $options['locations']->langs as $lang ) {
                $key = $lang['language_code'];
                $options['ncf_is_default_1']->location->langs->$key = true;
                unset($lang);
                unset($key);
            }
        }

        $options['ncf_is_default_1'] =  json_encode($options['ncf_is_default_1']);
    }

    for ($i = 1; $i <= $options['ncf_forms']; $i++) {

        if (!empty($options['ncf_form_status_' . $i]) && $options['ncf_form_status_' . $i] === 'deleted') {
            continue;
        }

        if (empty($options['ncf_form_status_' . $i])) {
            $options['ncf_form_status_' . $i] = 'live';
        }

        if (empty($options['ncf_email_' . $i])) {
            $options['ncf_email_' . $i] = get_bloginfo('admin_email');
        }

        if (empty($options['ncf_email_title_' . $i])) {
            $options['ncf_email_title_' . $i] = __( " Contact Form Submission", 'ninja-contact-form' );
        }

        if (empty($options['ncf_form7_' . $i])) {
            $options['ncf_form7_' . $i] = '';
        }

        if (empty($options['ncf_callback_' . $i])) {
            $options['ncf_callback_' . $i] = '';
        }

        if (empty($options['ncf_additional_fields_' . $i])) {
            $options['ncf_additional_fields_' . $i] = '{"company" : {"on":false,"required":false}, "phone" : {"on":false,"required":false}, "address" : {"on":false,"required":false}, "subject" : {"on":false,"required":false}}';
        }

        if (empty($options['ncf_additional_company_' . $i])) {
            $options['ncf_additional_company_' . $i] = '';
        }

        if (empty($options['ncf_additional_phone_' . $i])) {
            $options['ncf_additional_phone_' . $i] = '';
        }

        if (empty($options['ncf_scroll'])) {
            $options['ncf_scroll'] = 'custom';
        }

        if (empty($options['ncf_additional_address_' . $i])) {
            $options['ncf_additional_address_' . $i] = '';
        }

        if (empty($options['ncf_additional_subject_' . $i])) {
            $options['ncf_additional_subject_' . $i] = '';
        }

        if (empty($options['ncf_required_company_' . $i])) {
            $options['ncf_required_company_' . $i] = '';
        }

        if (empty($options['ncf_required_phone_' . $i])) {
            $options['ncf_required_phone_' . $i] = '';
        }

        if (empty($options['ncf_required_address_' . $i])) {
            $options['ncf_required_address_' . $i] = '';
        }

        if (empty($options['ncf_required_subject_' . $i])) {
            $options['ncf_required_subject_' . $i] = '';
        }

        // PROFILE
        if (empty($options['ncf_userpic_' . $i])) {
            $options['ncf_userpic_' . $i] = '';
        }

        if (empty($options['ncf_user_firstname_' . $i])) {
            $options['ncf_user_firstname_' . $i] = '';
        }

        if (empty($options['ncf_user_lastname_' . $i])) {
            $options['ncf_user_lastname_' . $i] = '';
        }

        if (empty($options['ncf_user_title_' . $i])) {
            $options['ncf_user_title_' . $i] = '';
        }

        if (empty($options['ncf_user_bio_' . $i])) {
            $options['ncf_user_bio_' . $i] = '';
        }

        // SOCIAL

        if (empty($options['ncf_facebook_' . $i])) {
            $options['ncf_facebook_' . $i] = '';
        }
        if (empty($options['ncf_twitter_' . $i])) {
            $options['ncf_twitter_' . $i] = '';
        }
        if (empty($options['ncf_pinterest_' . $i])) {
            $options['ncf_pinterest_' . $i] = '';
        }
        if (empty($options['ncf_youtube_' . $i])) {
            $options['ncf_youtube_' . $i] = '';
        }
        if (empty($options['ncf_instagram_' . $i])) {
            $options['ncf_instagram_' . $i] = '';
        }
        if (empty($options['ncf_linkedin_' . $i])) {
            $options['ncf_linkedin_' . $i] = '';
        }
        if (empty($options['ncf_gplus_' . $i])) {
            $options['ncf_gplus_' . $i] = '';
        }
        if (empty($options['ncf_rss_' . $i])) {
            $options['ncf_rss_' . $i] = '';
        }

        if (empty($options['ncf_success_message_' . $i])) {
            $options['ncf_success_message_' . $i] = __("Your message was successfully sent!", 'ninja-contact-form' );
        }

        if (empty($options['ncf_form_status_' . $i])) {
            $options['ncf_form_status_' . $i] = 'live';
        }

        if (empty($options['ncf_is_default_' . $i])) {
            $opts = (object)array(
                "location" => (object)array(
                        "pages" => (object)array(),
                        "cposts" => (object)array(),
                        "cats" => (object)array(),
                        "taxes" => (object)array(),
                        "langs" => (object)array(),
                        "wp_pages" => (object)array(),
                        "ids" => array()
                    )
            );
            $options['ncf_is_default_' . $i] =  json_encode($opts);
        }
    }
    // THEME
    if (empty($options['ncf_theme'])) {
        $options['ncf_theme'] = 'minimalistic';
    }

    if (empty($options['ncf_flat_socialbar'])) {
        $options['ncf_flat_socialbar'] = 'top';
    }

    if (empty($options['ncf_invert_style'])) {
        $options['ncf_invert_style'] = '';
    }

    if (empty($options['ncf_custom_css'])) {
        $options['ncf_custom_css'] = '';
    }

    if (empty($options['ncf_base_color'])) {
        $options['ncf_base_color'] = '{"flat": "#2B93C0", "cube": "#c0392b", "minimalistic": "#50E3C2", "aerial": "#292929"}';
    }

    if (empty($options['ncf_color_schema'])) {
        $options['ncf_color_schema'] = '#c0392b,#cf4739,#cd3424,#d9593e,#c84c3f,#bb2d1f,#e96d3d,#e94e3d,#2f1420';
    }

    if (empty($options['ncf_rgba'])) {
        $options['ncf_rgba'] = '';
    }

    if (empty($options['ncf_image_bg'])) {
        $options['ncf_image_bg'] = 'none';
    }

    if (empty($options['ncf_custom_bg'])) {
        $options['ncf_custom_bg'] = '';
    }

    if (empty($options['ncf_show_social'])) {
        $options['ncf_show_social'] = 'yes';
    }

    if (empty($options['ncf_userpic_style'])) {
        $options['ncf_userpic_style'] = 'theme_custom';
    }

    // GENERAL
    if (empty($options['ncf_sidebar_type'])) {
        $options['ncf_sidebar_type'] = 'push';
    }

    if (empty($options['ncf_display'])) {
        $opts = (object)array(
            "user" => (object)array(
                    "everyone" => 1,
                    "loggedin" => 0,
                    "loggedout" => 0
                ),
            "mobile" => (object)array(
                    "yes" => 1,
                    "no" => 0
                ),
            "rule" => (object)array(
                    "include" => 0,
                    "exclude" => 1
                ),
            "location" => (object)array(
                    "pages" => (object)array(),
                    "cposts" => (object)array(),
                    "cats" => (object)array(),
                    "taxes" => (object)array(),
                    "langs" => (object)array(),
                    "wp_pages" => (object)array(),
                    "ids" => array()
                )
        );
        $options['ncf_display'] =  json_encode($opts);
    }

    if (empty($options['ncf_enable_test'])) {
        $options['ncf_enable_test'] = false;
    }

    if (empty($options['ncf_autoresponder'])) {
        $options['ncf_autoresponder'] = false;
    }

    if (empty($options['ncf_use_admin_email'])) {
        $options['ncf_use_admin_email'] = false;
    }

    if (empty($options['ncf_fade_content'])) {
        $options['ncf_fade_content'] = 'light';
    }

    if (empty($options['ncf_sidebar_pos'])) {
        $options['ncf_sidebar_pos'] = 'left';
    }

    if (empty($options['ncf_label_color'])) {
        $options['ncf_label_color'] = 'rgb(255, 88, 115)';
    }



    if (empty($options['ncf_label_style'])) {
        $options['ncf_label_style'] = '1';
    }
    if (empty($options['ncf_label_size'])) {
        $options['ncf_label_size'] = '2x';
    }

    if (empty($options['ncf_label_tooltip'])) {
        $options['ncf_label_tooltip'] = 'hover';
    }

    if (empty($options['ncf_label_tooltip_text'])) {
        $options['ncf_label_tooltip_text'] = 'Contact us';
    }

    if (empty($options['ncf_tooltip_color'])) {
        $options['ncf_tooltip_color'] = 'rgba(0, 0, 0, 0.7)';
    }

    if (empty($options['ncf_label_shape'])) {
        $options['ncf_label_shape'] = 'circle';
    }

    if (empty($options['ncf_metro'])) {
        $options['ncf_metro'] = '';
    }

    if (empty($options['ncf_label_invert'])) {
        $options['ncf_label_invert'] = '';
    }

    if (empty($options['ncf_label_top'])) {
        $options['ncf_label_top'] = '50%';
    }

    if (empty($options['ncf_label_top_mob'])) {
        $options['ncf_label_top_mob'] = '100px';
    }

    if (empty($options['ncf_label_vis'])) {
        $options['ncf_label_vis'] = 'visible';
    }
    if (empty($options['ncf_label_vis_selector'])) {
        $options['ncf_label_vis_selector'] = '';
    }

    if (empty($options['ncf_label_mouseover'])) {
        $options['ncf_label_mouseover'] = '';
    }

    if (empty($options['ncf_togglers'])) {
        $options['ncf_togglers'] = '';
    }



    $ncf_cached_opts = $options;

//	delete_option('ncf_options');
    return $options;
}

global $ncf_locations;

function ncf_get_locations () {
    global $ncf_locations;

    if (isset($ncf_locations)) return $ncf_locations;

    $locations = new stdClass();

    // pages on site
    $pages = array();
    $fields = array('post_title', 'ID');

    $posts = get_posts( array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'fields' => 'ids, titles'
    ));

    foreach($posts as $post) {
        $newPost = new stdClass();
        foreach($fields as $field) {
            $newPost->$field = $post->$field;
        }
        $pages[] = $newPost;
    }

    $locations->pages = $pages;

    // custom post types
    $locations->cposts = get_post_types( array(
        'public' => true,
    ), 'object');

    foreach ( array( 'revision', 'post', 'page', 'attachment', 'nav_menu_item' ) as $unset ) {
        unset($locations->cposts[$unset]);
    }

    foreach ( $locations->cposts as $c => $type ) {
        $post_taxes = get_object_taxonomies($c);
        foreach ( $post_taxes as $post_tax) {
            $locations->taxes[] = $post_tax;
        }
    }

    // categories
    $locations->cats = get_categories( array(
        'hide_empty'    => false,
        //'fields'        => 'id=>name', //added in 3.8
    ) );

    // WPML languages
    if (function_exists('icl_get_languages') ) {
        //browser()->log('detect langs');
        $locations->langs = icl_get_languages('skip_missing=0&orderby=code');
    }

    foreach ( $locations as $key => $val ) {

        if (!empty($val)) {
            $length = count($val);
            for ($i = 0; $i <= $length; $i++) {
                if (isset($val[$i])) {
                    //browser()->log  ( $val[$i] );
                }
            }
        }
    }

    $page_types = array(
        'front'     => __('Front', 'ninja-contact-form'),
        'home'      => __('Home/Blog', 'ninja-contact-form'),
        'archive'   => __('Archives'),
        'single'    => __('Single Post'),
        'forbidden' => '404',
        'search'    => __('Search'),
    );

    foreach ($page_types as $key => $label){
        //browser()->log  ( $key, $label );
        //$instance['page-'. $key] = isset($instance['page-'. $key]) ? $instance['page-'. $key] : false;
    }

    $locations->wp_pages = $page_types;

    $ncf_locations = $locations;
    return $locations;
}