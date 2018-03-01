<?php
$colorSchema = $options['ncf_color_schema'];
if (empty($colorSchema)) {
	$colorSchema = array();
} else {
	$colorSchema = explode(',', $colorSchema);
}

$bg = $options['ncf_image_bg'];
$theme = $options['ncf_theme'];
$opacityLevel = $options['ncf_fade_content'] === 'light' ? 0.3 : ($options['ncf_fade_content'] === 'dark' ? 0.7 : 0);

//browser()->log($options);
?>
<style id="ncf_dynamic_styles">


body:not([class*=ncf_mobile]) .nks_cc_trigger_tabs.ncf_tab {
	top: <?php echo $options['ncf_label_top'] ?> !important;
}

.ncf_mobile .nks_cc_trigger_tabs.ncf_tab {
	top: <?php echo $options['ncf_label_top_mob'] ?> !important;
}

.ncf_exposed #ncf-overlay {
	opacity: <?php echo $opacityLevel; ?>;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $opacityLevel * 100; ?>)";
}

<?php if($opacityLevel != 0): ?>
.ncf_exposed #ncf-overlay:hover {
	cursor: pointer;
	cursor: url("<?php echo plugins_url('/img/', __FILE__);?>close2.png") 16 16,pointer;
}
<?php endif; ?>



<?php if(isset($bg) && strpos($bg, 'none') === FALSE): ?>
#ncf_sidebar.ncf_imagebg_<?php echo $bg; ?> {
	background-image: url(<?php echo plugins_url('/img/bg/' . $bg . '.jpg', __FILE__) ; ?>);
}
<?php if(strpos($bg, 'blur') !== FALSE || ($theme === 'aerial' && strpos($bg, 'none') !== FALSE)): ?>
#ncf_sidebar {
	background-repeat: no-repeat;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	background-size: cover;
	background-position: 0 0;
}
<?php endif; ?>
<?php endif; ?>

<?php if(isset($colorSchema[0])): ?>
.ncf_color1, #ncf_sidebar .ncf_button:before {
	background-color: <?php echo $colorSchema[0]; ?> !important ;
}

#ncf_sidebar.ncf_aerial input[type=text],
#ncf_sidebar.ncf_aerial input[type=email],
#ncf_sidebar.ncf_aerial input[type=date],
#ncf_sidebar.ncf_aerial input[type=tel],
#ncf_sidebar.ncf_aerial textarea,
.ncf_aerial .ncf_user_firstname,
.ncf_aerial .ncf_user_lastname,
#ncf_sidebar.ncf_aerial .ncf_user_bio,
#ncf_sidebar.ncf_aerial .wpcf7,
#ncf_sidebar.ncf_aerial .ncf_select_wrap select,
#ncf_sidebar .ncf_select_wrap:before,
#ncf_sidebar input[type=checkbox]:checked + label:before,
#ncf_sidebar input[type=radio]:checked + label:before {
	color:  <?php echo $colorSchema[0]; ?> !important;
}

#ncf_sidebar.ncf_minimalistic .wpcf7 p, #ncf_sidebar.ncf_minimalistic .wpcf7-response-output {
	color:  <?php echo $colorSchema[0]; ?>;

}

.ncf_minimalistic .ncf_form_res_message {
	color:  <?php echo $colorSchema[0]; ?> !important;
}

.ncf_minimalistic .ncf_sidebar_socialbar li a:hover {
	background-color: <?php echo $colorSchema[0]; ?> !important ;
}
.ncf_minimalistic input:focus,
.ncf_minimalistic textarea:focus
{
	color: <?php echo isset($colorSchema[4]) ? $colorSchema[4] : $colorSchema[0] ; ?> !important;
}

#ncf_sidebar .ncf_err_msg, #ncf_sidebar .ncf_form_btn_wrapper .ncf_btn_close {
<!--	color: --><?php //echo $colorSchema[0]; ?><!-- !important;-->
}

#ncf_sidebar.ncf_aerial .ncf_ph label {
	color: <?php echo $colorSchema[0]; ?> !important;
}

#ncf_sidebar input[type=checkbox] + label:before,
#ncf_sidebar input[type=radio] + label:before {
}


#ncf_sidebar.ncf_minimalistic input[type=submit],
#ncf_sidebar.ncf_aerial input[type=submit] {
	background-color: <?php echo $colorSchema[0]; ?>;
}

#ncf_sidebar.ncf_aerial input[type=submit] {
	background-color: <?php echo $colorSchema[0]; ?> !important;
	background-image: none !important;
	text-shadow: none;

}
<?php endif; ?>

<?php if(isset($colorSchema[1])): ?>
.ncf_color2 {
	background-color: <?php echo $colorSchema[1]; ?> !important ;
}
.ncf_minimalistic .ncf_user_bio, .ncf_minimalistic .wpcf7 p {
	color:  <?php echo $colorSchema[1]; ?> !important;
}

#ncf_sidebar.ncf_aerial .ncf_user_title{
	color: <?php echo $colorSchema[1]; ?>;
}

<?php endif; ?>

<?php if(isset($colorSchema[2])): ?>
.ncf_minimalistic .ncf_user_title{
	color:  <?php echo $colorSchema[2]; ?> !important;
}
.ncf_color3 {
	background-color: <?php echo $colorSchema[2]; ?> !important;
}
#ncf_sidebar.ncf_flat a.ncf_button,
#ncf_sidebar.ncf_flat  input[type=submit],
#ncf_sidebar.ncf_minimalistic  input[type=submit] {
	-webkit-box-shadow: 0 2px 0px 2px <?php echo $colorSchema[2]; ?>;
	-moz-box-shadow: 0 2px 0px 2px <?php echo $colorSchema[2]; ?>;
	box-shadow: 0 2px 0px 2px <?php echo $colorSchema[2]; ?>;
}

#ncf_sidebar.ncf_flat  a.ncf_button:active,
#ncf_sidebar.ncf_flat  input[type=submit]:active,
#ncf_sidebar.ncf_minimalistic input[type=submit]:active {
	-webkit-box-shadow: 0 1px 0px 2px <?php echo $colorSchema[2]; ?>;
	-moz-box-shadow: 0 1px 0px 2px <?php echo $colorSchema[2]; ?>;
	box-shadow: 0 1px 0px 2px <?php echo $colorSchema[2]; ?>;
}

<?php endif; ?>

<?php if(isset($colorSchema[3])): ?>
.ncf_color4 {
	background-color: <?php echo $colorSchema[3]; ?> !important ;
}

#ncf_sidebar.ncf_minimalistic input[type=text]:focus,
#ncf_sidebar.ncf_minimalistic input[type=email]:focus,
#ncf_sidebar.ncf_minimalistic input[type=date]:focus,
#ncf_sidebar.ncf_minimalistic input[type=tel]:focus,
#ncf_sidebar.ncf_minimalistic textarea:focus {
	border-color: <?php echo $colorSchema[4]; ?>;
	box-shadow: inset 0px -4px 0px 0px <?php echo $colorSchema[3]; ?>;
}

#ncf_sidebar .ncf_ph input:focus + label,
#ncf_sidebar .ncf_has_value label,
#ncf_sidebar .ncf_ph textarea:focus + label {
	color: <?php echo $colorSchema[4]; ?>;
}

<?php endif; ?>

<?php if(isset($colorSchema[4])): ?>
.ncf_color5 {
	background-color: <?php echo $colorSchema[4]; ?> !important ;
}


#ncf_sidebar.ncf_minimalistic a.ncf_button,
#ncf_sidebar.ncf_flat  input[type=submit],
#ncf_sidebar.ncf_minimalistic  input[type=submit] {
	box-shadow: 0 2px 0px 2px <?php echo $colorSchema[4]; ?>;
}

#ncf_sidebar.ncf_minimalistic  a.ncf_button:active,
#ncf_sidebar.ncf_flat  input[type=submit]:active,
#ncf_sidebar.ncf_minimalistic  input[type=submit]:active {
	-webkit-box-shadow: 0 1px 0px 2px <?php echo $colorSchema[4]; ?>;
	-moz-box-shadow: 0 1px 0px 2px <?php echo $colorSchema[4]; ?>;
	box-shadow: 0 1px 0px 2px <?php echo $colorSchema[4]; ?>;
}



<?php endif; ?>


<?php if(isset($colorSchema[5])): ?>
.ncf_color6 {
	background-color: <?php echo $colorSchema[5]; ?> !important ;
}


<?php endif; ?>


<?php if(isset($colorSchema[6])): ?>
.ncf_color7 {
	background-color: <?php echo $colorSchema[6]; ?> !important ;
}
<?php endif; ?>


<?php if(isset($colorSchema[7])): ?>
.ncf_color8 {
	background-color: <?php echo $colorSchema[7]; ?> !important ;
}
#ncf_sidebar.ncf_flat input[type=text]:focus,
#ncf_sidebar.ncf_flat input[type=email]:focus,
#ncf_sidebar.ncf_flat input[type=date]:focus,
#ncf_sidebar.ncf_flat input[type=tel]:focus,
#ncf_sidebar.ncf_flat textarea:focus {
	border-color:<?php echo $colorSchema[7]; ?>;
}

#ncf_sidebar.ncf_flat input[type=submit] {
	background-color: <?php echo $colorSchema[7]; ?>;
}

#ncf_sidebar.ncf_flat .ncf_button:before {
	background-color: <?php echo $colorSchema[7]; ?> !important ;
}
<?php endif; ?>

<?php if(isset($colorSchema[8])): ?>
.ncf_color9 {
	background-color: <?php echo $colorSchema[8]; ?> !important ;
}
.ncf_flat .ncf_user_title {
	color: <?php echo $colorSchema[8]; ?> !important;
}
<?php endif; ?>

<?php if(isset($options['ncf_custom_bg'])): ?>
.ncf_imagebg_custom {
	background-image: url(<?php echo $options['ncf_custom_bg']; ?>) !important;
}
<?php endif; ?>
<?php if(isset($options['ncf_show_social']) && $options['ncf_show_social'] === 'hide'): ?>
.ncf_flat .ncf_sidebar_socialbar,
.ncf_minimalistic .ncf_sidebar_socialbar,
.ncf_minimalistic .ncf_sidebar_cont > .ncf_line_sep,
.ncf_aerial .ncf_sidebar_socialbar {
	display: none !important;
}
<?php endif; ?>

<?php if($theme === 'aerial' && !empty($options['ncf_rgba'])): ?>
#ncf_sidebar.ncf_aerial input[type=text],
#ncf_sidebar.ncf_aerial input[type=email],
#ncf_sidebar.ncf_aerial input[type=date],
#ncf_sidebar.ncf_aerial input[type=tel],
#ncf_sidebar.ncf_aerial textarea,
.ncf_aerial .ncf_sidebar_header:after,
#ncf_sidebar.ncf_aerial .ncf_select_wrap,
#ncf_sidebar.ncf_aerial #ncf_answer_field {
	background-color: rgba(<?php echo $options['ncf_rgba']; ?>, 0.2) !important;
}

#ncf_sidebar.ncf_aerial input[type=checkbox] + label:before,
#ncf_sidebar.ncf_aerial input[type=radio] + label:before {
	background-color: rgba(<?php echo $options['ncf_rgba']; ?>, 0.2) !important;
}

<?php endif; ?>
<?php
	$col = (!empty($options['ncf_label_invert'])) ? 'white' : $options['ncf_label_color'];

		if(isset($options['ncf_label_color'])) {
			echo ".nks_cc_trigger_tabs .ncf-tab-icon .fa:before  {
			color: " . $options['ncf_label_color'] ."!important;
		}
		";

		if (isset($col)) {
			echo ".nks_cc_trigger_tabs.nks_metro .ncf-tab-icon .fa-stack-2x {
			background-color: " . $col .";
			}";
		}
	}
?>
<?php if($options['ncf_label_tooltip'] == 'visible'): ?>
.nks_cc_trigger_tabs .ncf-tab-icon:after {
	font-family: inherit;
	content: '<?php _e($options['ncf_label_tooltip_text'], 'ninja-contact-form') ?>';
	position: absolute;
	top: -10%;
	font-size: 20px;
	left: 50%;
	line-height: 28px;
	-webkit-transform: rotate(-90deg);
	-moz-transform: rotate(-90deg);
	-ms-transform: rotate(-90deg);
	-o-transform: rotate(-90deg);
	transform: rotate(-90deg);
	-webkit-transform-origin: left top 0;
	-moz-transform-origin: left top 0;
	-ms-transform-origin: left top 0;
	-o-transform-origin: left top 0;
	transform-origin: left top 0;
	color: #FFF;
	padding: 6px 14px;
	margin-left: -20px;
	white-space: nowrap;
	background-color: <?php echo $options['ncf_tooltip_color'] ?>;
	border-radius: 20px;
	-moz-border-radius: 20px;
	-webkit-border-radius: 20px;
	-webkit-backface-visibility: hidden;
}

.ncf_hidden .nks-hover .fa-stack-1x.fa-inverse:before  {
	color: white !important;
}

.nks_cc_trigger_tabs.nks_metro .ncf-tab-icon:after {
	left: 0;
	top: 0;
	margin-left: 0px;
	border-radius: 0px;
	-moz-border-radius: 0px;
	-webkit-border-radius: 0px;
}

.nks_cc_trigger_tabs.nks_metro .ncf-tab-icon.fa-3x:after {
	padding: 21px;
	font-size: 24px;
}

.nks_cc_trigger_tabs.nks_metro .ncf-tab-icon.fa-2x:after {
	padding: 10px 21px;
}

.nks_cc_trigger_tabs.nks_metro .ncf-tab-icon.fa-2x:after {
	font-size: 18px;
}


<?php endif; ?>

<?php if($options['ncf_body'] != 'yes'): ?>
body.ncf_sidebar_push > * {
    position: relative;
}
<?php endif; ?>
<?php if($options['ncf_label_tooltip'] == 'hover'): ?>

.ncf_mobile .nks_cc_trigger_tabs .ncf-tab-icon:after {
	display: none!important;
}
.nks_cc_trigger_tabs .ncf-tab-icon:after {
	opacity: 0;
	visibility: hidden;
	content: '<?php echo $options['ncf_label_tooltip_text'] ?>';
	background-color: <?php echo $options['ncf_tooltip_color'] ?>;
	position: absolute;
	padding: 6px 14px;
	font-size: 14px;
	top: 50%;
	margin-top: -20px;
	left: 110%;
	font-family: inherit;
	line-height: 28px;
	white-space: nowrap;
	border-radius: 20px;
	-moz-border-radius: 20px;
	-webkit-border-radius: 20px;
	color: #FFF;
	-webkit-transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1), visibility 0s 0.25s;
	-moz-transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1), visibility 0s 0.25s;
	-ms-transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1), visibility 0s 0.25s;
	-o-transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1), visibility 0s 0.25s;
	transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1), visibility 0s 0.25s;
	-webkit-backface-visibility: hidden;
}

body:not([class*=ncf_exposed]):not([class*=ncf_transitioning]) .nks_cc_trigger_tabs .ncf-tab-icon:hover:after {
	opacity: 1;
	visibility: visible;
	-webkit-transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
	-moz-transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
	-ms-transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
	-o-transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
	transition: opacity 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
}

.ncf_sidebar_pos_right .nks_cc_trigger_tabs .ncf-tab-icon:after {
	right: 110%;
	left: auto;
}

.nks_cc_trigger_tabs.nks_metro .ncf-tab-icon:after {
	left: 100%;
	border-radius: 0px;
	-moz-border-radius: 0px;
	-webkit-border-radius: 0px;
}

.ncf_sidebar_pos_right .nks_cc_trigger_tabs.nks_metro .ncf-tab-icon:after {
	right: 100%;
	left: auto;
}

.nks_cc_trigger_tabs.nks_metro .ncf-tab-icon.fa-2x:after {
	padding: 10px 14px;
	margin-top: -24px;
}

.nks_cc_trigger_tabs.nks_metro .ncf-tab-icon.fa-3x:after {
	padding: 21px 14px;
	margin-top: -35px
}
<?php endif; ?>
<?php if(isset($options['ncf_custom_css'])): ?>
<?php echo $options['ncf_custom_css']; ?>
<?php endif; ?>
.ncf_exposed #ns-overlay {
	opacity: <?php echo $opacityLevel; ?>;
}
/* set up the keyframes */
@keyframes bodyArrived {
	from { opacity: 0.99; }
	to { opacity: 1; }
}

@-moz-keyframes bodyArrived {
	from { opacity: 0.99; }
	to { opacity: 1; }
}

@-webkit-keyframes bodyArrived {
	from { opacity: 0.99; }
	to { opacity: 1; }
}

@-ms-keyframes bodyArrived {
	from { opacity: 0.99; }
	to { opacity: 1; }
}

@-o-keyframes bodyArrived {
	from { opacity: 0.99; }
	to { opacity: 1; }
}

body {
	/*animation-duration: 0.001s;*/
	/*-o-animation-duration: 0.001s;*/
	/*-ms-animation-duration: 0.001s;*/
	/*-moz-animation-duration: 0.001s;*/
	/*-webkit-animation-duration: 0.001s;*/
	/*animation-name: bodyArrived;*/
	/*-o-animation-name: bodyArrived;*/
	/*-ms-animation-name: bodyArrived;*/
	/*-moz-animation-name: bodyArrived;*/
	/*-webkit-animation-name: bodyArrived;*/
}
</style>
<?php
if (isset($options['ncf_label_stroke']) && $options['ncf_label_stroke']) {
	$inverse = '';
} else {
	if ($options['ncf_label_invert']) {
		$inverse = '';
	} else {
		$inverse = 'fa-inverse';
	}
}
$metro = !empty($options['ncf_metro']) ? ' nks_metro' : '';
$style = $options['ncf_label_shape'];
?>
<script>
	(function($){

		NinjaContactFormOpts.callbacks = {
			<?php
			echo 'noop: function(){}';
			for ($i = 1; $i <= $options['ncf_forms']; $i++) {
				if ($options['ncf_form_status_' . $i] !== 'deleted') {
					echo ',"id'.$i.'" : function(){'.$options['ncf_callback_' . $i].'}';
				}
				}
			 ?>
		}

		var insertListener = function(event){
			if (event.animationName == "bodyArrived") {
				afterBodyArrived();
			}
		}
		var timer;

		if (document.addEventListener && false) {
			document.addEventListener("animationstart", insertListener, false);
			document.addEventListener("MSAnimationStart", insertListener, false);
			document.addEventListener("webkitAnimationStart", insertListener, false);
		} else {
			timer = setInterval(function(){
				if (document.body) {
					clearInterval(timer);
					afterBodyArrived();
				}
			},14);
		}

		function afterBodyArrived () {

			if (!window.NinjaContactFormOpts || window.NinjaSidebar) return;

			var opts = window.NinjaContactFormOpts;
			var nksopts = window.NKS_CC_Opts;
			var subopts = window.NKSubOpts;
			var $body = $('body');

			var TYPE = NinjaContactFormOpts.sidebar_type;
			var $bodybg = $('<div id="ncf-body-bg"/>').prependTo($body);
			var b = document.body;
			var bodyCss;

			$(function(){
				setTimeout(function() {

					if (!$bodybg.parent().is($body)) {
						$body.prepend($bodybg).prepend($('.nks_cc_trigger_tabs')).prepend($('#ncf_sidebar')).append($('#ncf-overlay-wrapper'));
					}

					if (TYPE === 'push') { $bodybg.css('backgroundColor', $body.css('backgroundColor')) }

				},0)
			});

			if (TYPE === 'push') {

				bodyCss = {
					'backgroundColor':$body.css('backgroundColor'),
					'backgroundImage':$body.css('backgroundImage'),
					'backgroundAttachment':$body.css('backgroundAttachment'),
					'backgroundSize':$body.css('backgroundSize'),
					'backgroundPosition':$body.css('backgroundPosition'),
					'backgroundRepeat':$body.css('backgroundRepeat'),
					'backgroundOrigin':$body.css('backgroundOrigin'),
					'backgroundClip':$body.css('backgroundClip')
				};

				if (bodyCss.backgroundColor.indexOf('(0, 0, 0, 0') + 1 || bodyCss.backgroundColor.indexOf('transparent') + 1 ) {
					bodyCss.backgroundColor = '#fff';
				}

				if (bodyCss.backgroundAttachment === 'fixed') {
					NinjaContactFormOpts.isBgFixed = true;
					bodyCss.position = 'fixed';
					bodyCss.bottom = 0;
					bodyCss.backgroundAttachment = 'scroll';
				} else {
					bodyCss.height = Math.max(
						b.scrollHeight, document.documentElement.scrollHeight,
						b.offsetHeight, document.documentElement.offsetHeight,
						b.clientHeight, document.documentElement.clientHeight
					)
				}

				$bodybg.css(bodyCss);

			} else {
				//$body.addClass('nks_sidebar_slide')
			}

			setTimeout(function(){
				$(function(){

					var $tabs = $('.nks_cc_trigger_tabs');
					var $btn;
					var sel;
					var nkspos = nksopts && nksopts.sidebar_pos;
					var subpos = subopts && subopts.sidebar_pos;

					if ( $tabs.length && (opts.sidebar_pos === nkspos || opts.sidebar_pos === subpos) ) {

						$btn = $('<?php
					echo '<span class="fa-stack fa-lg ncf-tab-icon fa-' . $options['ncf_label_size'] . '"> <i class="fa ncf-icon-' . $style . ' fa-stack-2x ' . (!empty($options['ncf_label_invert'])  ? 'fa-inverse' : '') . '"></i> <i class="fa ncf-icon-mail-' . $options['ncf_label_style'] . ' fa-stack-1x ' . $inverse . '"></i> </span>';
					?>');

						if (opts.sidebar_pos === nkspos) {
							$tabs.filter(':has(".nks-tab")').prepend($btn);
							triggerEvent();
							return;
						}

						if (opts.sidebar_pos === subpos) {
							$tabs.filter(':has(".nksub-tab-icon")').prepend($btn);
							triggerEvent();
							return;
						}


					} else {
						$tabs = $('<?php
					echo '<div class="nks_cc_trigger_tabs ncf_tab ncf_label_' . $options['ncf_label_vis'] . $metro . '">';
					echo '<span class="fa-stack ncf-tab-icon fa-lg fa-' . $options['ncf_label_size'] . '"> <i class="fa ncf-icon-' . $style . ' fa-stack-2x ' . (!empty($options['ncf_label_invert'])  ? 'fa-inverse' : '') . '"></i> <i class="fa ncf-icon-mail-' . $options['ncf_label_style'] . ' fa-stack-1x ' . $inverse . '"></i> </span></div>';
					?>');
						$body.append($tabs);
					}

					triggerEvent();
	//
				});
			});
		}

		function triggerEvent(){
				$(document).trigger('ncf_ready');
		}

	})(jQuery)

</script>