<script>
	var ajax_url = '<?php echo admin_url( 'admin-ajax.php' )?>';
</script>

<div id="ns-options-wrap" class="widefat" style="opacity: 0;">
	<?php

	//ncf_register_settings();

	function custom_do_settings_sections($page) {
		global $wp_settings_sections, $wp_settings_fields;

		if ( !isset($wp_settings_sections) || !isset($wp_settings_sections[$page]) )
			return;

		foreach( (array) $wp_settings_sections[$page] as $section ) {
			echo "<div class='postbox' id='{$section['id']}'><h3 class='hndle'><span>{$section['title']}</span></h3>\n";
			call_user_func($section['callback'], $section);
			if ( !isset($wp_settings_fields) ||
				!isset($wp_settings_fields[$page]) ||
				!isset($wp_settings_fields[$page][$section['id']]) )
				continue;
			echo '<div class="settings-form-wrapper '. $section['id'] . '">';
			custom_do_settings_fields($page, $section['id']);
			echo "<input name='Submit' type='submit' id='sbmt_{$section['id']}' class='button-primary' value='Save Changes' />";
			echo "<input name='Submit' type='submit' id='delete_{$section['id']}' class='button-primary button-delete' value='Delete form' /> ";
			echo '</div></div>';
		}
	}

	function custom_do_settings_fields($page, $section) {
		global $wp_settings_fields;

		if ( !isset($wp_settings_fields) ||
			!isset($wp_settings_fields[$page]) ||
			!isset($wp_settings_fields[$page][$section]) )
			return;

		foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
			if (!empty($field['args']['before'])) {
				echo $field['args']['before'];
			}
			echo '<div class="settings-form-row'. (!empty($field['args']['hidden']) ? ' hidden-row' : '') . ' ' . $field['id'] .'">';
			if ( !empty($field['args']['label_for']) ) {
				echo '<p><label for="' . $field['args']['label_for'] . '">' . $field['title'] . '</label><br />';
			}
			else {
				echo '<p class="'. (!empty($field['args']['header_hidden']) ? 'header_hidden' : '') . '"><span class="field-title">' . $field['title'] . '</span>';
			}
			call_user_func($field['callback'], $field['args']);
			echo '</p></div>';
			if (!empty($field['args']['after'])) {
				echo $field['args']['after'];
			}
		}
	}

	screen_icon();
	?>

	<h2 class="form-title">Ninja Kick: Contact Form settings</h2>
	<form method="post" action="options.php" enctype="multipart/form-data">
		<ul id="tabs-copy" class="section-tabs"></ul>
		<ul id="tabs" class="section-tabs"></ul>

		<?php settings_fields('ncf_options');
		ncf_debug_to_console('here');
		//wp_die('err');
		?>
		<?php


		try {
			custom_do_settings_sections('ncf');
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

		?>

	</form>
	<div id="fade-overlay">
		<div class="svg-wrapper">
			<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100px" height="120px" viewBox="0 0 100 120" style="enable-background:new 0 0 50 50;" xml:space="preserve">
    <rect x="0" y="0" width="10" height="35" fill="#333" transform="translate(0 19.2561)">
	    <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 25; 0 0" begin="0" dur="0.6s" repeatCount="indefinite"></animateTransform>
    </rect>
				<rect x="20" y="0" width="10" height="35" fill="#333" transform="translate(0 5.92276)">
					<animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 25; 0 0" begin="0.2s" dur="0.6s" repeatCount="indefinite"></animateTransform>
				</rect>
				<rect x="40" y="0" width="10" height="35" fill="#333" transform="translate(0 7.41058)">
					<animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 25; 0 0" begin="0.4s" dur="0.6s" repeatCount="indefinite"></animateTransform>
				</rect>
  </svg>
		</div>

	</div>
	<a class="la" href="http://www.looks-awesome.com/"><!--by Looks Awesome--></a>

</div>
<script type="text/javascript">
(function(){
	var $ = window.jQuery;
	var current;
	var $tabs;
	var $active;
	var $content;
	var $wrap;
	var $saved;
	var $sbmt;
	var offset;
	var $win;
	var isLS = 'sessionStorage' in window && window['sessionStorage'] !== null;

	function showLoadingView () {
		$('#fade-overlay').addClass('loading').find('svg')[0].unpauseAnimations();
	}

	if($ != null) {

		try {
			$wrap = $('#ns-options-wrap')
			$tabs = $('#tabs');
			$win = $(window);

			$('#fade-overlay').find('svg')[0].pauseAnimations()

			$(function(){

				$('#ns-options-wrap .postbox').each(function(i ,el) {
					var $t = $(this);
					var txt = $t.find('h3').text();
					var active = isLS && sessionStorage.getItem('nks-section') && $t.attr('id') === sessionStorage.getItem('nks-section').replace('for_', '') ? 'active' : '';
					$tabs.append('<li id="for_'+  $t.attr('id') + '" class="'+ active + '"><span data-hover="'+txt+'">' + txt + '</span></li>');
				});

//				$('#wpcontent').prepend('<div class="ninja"></div>');
				$tabs.append('<li id="save-tab"><span>Save Changes</span></li>')

				// $('.ninja').css('left', $('#adminmenuwrap').width())

				if (isLS) {

					current = sessionStorage.getItem('ncf-section');

					$active = current ? $('#tabs li#' + current) : $('#tabs li:first');
					$content = $wrap.find('#' + $active.attr('id').replace('for_', ''))

					if ($active.is('#for_ncf_button')) {
						setTimeout(function(){$('#ncf_button_preview').css('opacity', 1)}, 0)
					} else {
						$('#ncf_button_preview').css('opacity', 0)
					}

					$content.add($active).addClass('active');
					//$wrap.height($content.outerHeight() + 150)

					// chrome fix
					//setTimeout(function(){$wrap.height($content.outerHeight() + 150)}, 500)

					current = sessionStorage.getItem('ncf-section-scroll');

					if (current) {
						$('html, body').scrollTop(current);
						setTimeout(function(){$('html, body').scrollTop(current)}, 0);
					}

				}

				$tabs.find('li').not('#save-tab').click(function () {
					var $t = $(this);
					var $content = $('#ns-options-wrap #' + $t.attr('id').replace('for_', ''));

					if ($saved) $saved.hide();

					$wrap.find('.postbox, #tabs li' ).removeClass('active')
					$t.add($content).addClass('active');

					if ($t.is('#for_ncf_button')) {
						setTimeout(function(){$('#ncf_button_preview').css('opacity', 1)}, 0)
					} else {
						$('#ncf_button_preview').css('opacity', 0)
					}


					//$wrap.css('transition', 'none').height($content.outerHeight() + 150);
					setTimeout(function(){$wrap.css('transition', 'height 0.3s ease')}, 0)

					if (isLS) {
						sessionStorage.setItem('ncf-section', $t.attr('id'));
					}


				})

				var lastFocusTextarea = false;

				$wrap.find('textarea').focus(function (e) {
					$(this).addClass('focus');
					var c = $wrap.height()
					if (!lastFocusTextarea) {
						//$wrap.height(c + 240)
					}
					lastFocusTextarea = true;
				}).blur(function () {
					var $t = $(this);
					setTimeout(function () {
						var target = document.activeElement;

						if ($(document.activeElement).is('button')) return;

						var c = $wrap.height()
						if (!lastFocusTextarea) {
							//$wrap.height(c - 240);
						}
						lastFocusTextarea = true;
						$t.removeClass('focus');

						if (!$(target).is('textarea')) {
							var c = $wrap.height()
							//$wrap.height(c - 240);
							lastFocusTextarea = false
						}
					}, 1);
				})

				if (isLS) {
					$(window).unload(function (e) {
						sessionStorage.setItem('ncf-section-scroll', $('body').scrollTop() || $('html').scrollTop());
					});

					$wrap.find(':submit').click(function(){
						showLoadingView();
						sessionStorage.setItem('ncf-section-submit', $(this).attr('id'));
					});

					if (sessionStorage.getItem('ncf-section-submit')) {
						//$saved = $('<div id="saved"><i class="fa fa-check"></i> Saved!</div>');
						$sbmt = $('#' + sessionStorage.getItem('ncf-section-submit'));

						if ($sbmt.length) {
							//$('body').append($saved);
							offset = $sbmt.offset();
							setTimeout(function(){$saved.addClass('hide')}, 1000);

							//$saved.css({top: offset.top + 5, left: $sbmt.outerWidth() + offset.left + 10})

						}
						sessionStorage.setItem('ncf-section-submit', '');

					}

					var $fwrap = $('<ul id="form-tabs"></ul>').prependTo($('.ncf_form_settings'));
					$('.form-instance-wrapper').each(function(i, el) {
						var $t = $(this);
						var index = $t.attr('data-index');
						$fwrap.append('<li data-index='+index+'>Form #' + index +'</li>')
					})


					$fwrap.children('li').click(function(e){

						var index = $fwrap.find('li').index(this);
						$fwrap.find('.active').add('.form-instance-wrapper.active').removeClass('active');
						$fwrap.find('li:eq(' + index + ')').add('.form-instance-wrapper:eq(' + index + ')').addClass('active');
						if (isLS) sessionStorage.setItem('ncf-form-active', index);
					})

					$fwrap.find('li:eq(' + (isLS && sessionStorage.getItem('ncf-form-active') || 0) +')').add('.form-instance-wrapper:eq(' + (isLS && sessionStorage.getItem('ncf-form-active') || 0) +')').addClass('active').end().end().append('<li id="add-form">+ Add form</li>');

				}


				var formsLi = $('#form-tabs li[data-index]');

				$( document ).delegate('#add-form', 'click', function(){
					var val = parseInt($('#ncf_forms').val());
					$('#ncf_forms').val(val + 1);

					showLoadingView();
					if (window['sessionStorage'] && sessionStorage.getItem('ncf-form-active')) {
						sessionStorage.setItem('ncf-form-active', $('#form-tabs li[data-index]').length)
					}
					$(this).closest('form').submit();
				})

				$('#delete_ncf_form_settings').on( 'click', function(){
					var index = parseInt($('#form-tabs li.active').attr('data-index'));

					if (!isNaN(index)) {
						if (!confirm('Are you sure?')) return false;

						$('#ncf_form_status_' + index).val('deleted');

						if (window['sessionStorage'] && sessionStorage.getItem('ncf-form-active') && sessionStorage.getItem('ncf-form-active') != 0) {
							sessionStorage.setItem('ncf-form-active', sessionStorage.getItem('ncf-form-active') - 1)
						}
					}

				});

				if (formsLi.length === 1) {
					console.log($('#delete_ncf_form_settings').length)

					$('#delete_ncf_form_settings').attr('style', 'display:none!important');
				}

				$wrap.css('opacity', 1);
			});
		} catch (e) {
			document.getElementById('ns-options-wrap').style.opacity = 1;
		}

	} else {
		document.getElementById('ns-options-wrap').style.opacity = 1;

	}
}())



</script>
