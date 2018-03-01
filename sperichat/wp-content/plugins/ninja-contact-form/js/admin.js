jQuery(function($){

	var $win = $(window);
	var $body = $('body');
	var preview = $('#ncf_button_preview');


	function isScrolledIntoView($elem, elemTop, elemBottom, rule) {
		var docViewTop = $win.scrollTop();
		var docViewBottom = docViewTop + $win.height();

		return rule === 'after' ? docViewBottom > elemBottom + 50 : (elemBottom <= docViewBottom && elemTop >= docViewTop - 25) || (elemBottom > docViewBottom && elemTop < docViewTop - 25);
	}

	$('.switcher').each(function(){
		var $t = $(this);
		$t.next('label')/*.html('')*/.append($t);
		$(this).after('<div><div></div></div>')
	})

	$('.postbox select').each(function(){
		var id = this.id
		$(this).wrap('<div class="select-wrapper" id="'+id+'-wrapper"></div>')
	})

	$('#ns-options-wrap form').on('submit', function(e){
		var p = $('.ncf_display');
		var current = p.find('.loc_popup')
		var hidden = p.find('input:hidden');
		var user = current.find('select[id*=user_status]').val();
		var rule = current.find('select[id*=display_rule]').val();
		var mobile = current.find('select[id*=display_mobile]').val();
		var ids = current.find('[id*=display_ids]').val();

		var resulted = {
			'user' : {
				'everyone' : user === 'everyone' ? 1 : 0,
				'loggedin' : user === 'loggedin' ? 1 : 0,
				'loggedout' : user === 'loggedout' ? 1 : 0
			},
			'mobile' : {
				'yes' : mobile === 'yes' ? 1 : 0,
				'no' : mobile === 'no' ? 1 : 0
			},

			'rule' : {
				'include' : rule === 'include' ? 1 : 0,
				'exclude' : rule === 'exclude' ? 1 : 0
			},
			'location' : {
				'pages' : traversePages(current.find('input[id*=display_page]')),
				'cposts' : traversePages(current.find('input[id*=display_cpost]')),
				'cats' : traversePages(current.find('input[id*=display_cat]')),
				'taxes' : {},
				'langs' : traversePages(current.find('input[id*=display_lang]')),
				'wp_pages' : traversePages(current.find('input[id*=display_wp_page]')),
				'ids': ids.split(',')
			}
		};
		hidden.val(JSON.stringify(resulted));
	}).on( 'submit', function () {
		var $defaults = $('.ncf_form_settings .loc_popup');

		$defaults.each(function(i,el){
			var current = $(this);
			var p = current.closest('.settings-form-row');
			var hidden = p.find('input:hidden');
			var ids = current.find('[id*=display_ids]').val();

			var resulted = {

				'location' : {
					'pages' : traversePages(current.find('input[id*=display_page]')),
					'cposts' : traversePages(current.find('input[id*=display_cpost]')),
					'cats' : traversePages(current.find('input[id*=display_cat]')),
					'taxes' : {},
					'langs' : traversePages(current.find('input[id*=display_lang]')),
					'wp_pages' : traversePages(current.find('input[id*=display_wp_page]')),
					'ids': ids.split(',')
				}
			};

			hidden.val(JSON.stringify(resulted));
		});

	});

	function traversePages(pages) {
		var res = {};

		pages.each(function(i, el){
			var t = $(el);
			var val = t.val();
			if (t.is(':checked')) res[val] = 1;
		});

		return res
	}

	$('#ncf_label_style').change(function(){
		var val = this.value;
		preview.find('.fa-stack-1x').removeClass(function() {
			return $( this ).attr( 'class' ).match(/icon-mail-.+?\b/)[0];
		}).addClass('icon-mail-' + val);
	})

	$('#ncf_label_shape').change(function(){
		var val = this.value;
		preview.find('.fa-stack-2x')
			.removeClass('icon-circle icon-square icon-circle-thin icon-square-o')
			.addClass('icon-' + val);
	})

	$('#ncf_label_size').change(function(){
		var val = this.value;
		console.log(val)
		preview.find('.fa-stack').removeClass('fa-1x fa-2x fa-3x')
			.addClass('fa-' + val);
	})

	preview.insertAfter($('#tabs'));

	var state = 'in';
	var $tabs = $('#tabs-copy');
	var $or = $('#tabs');
	var $form = $('#ns-options-wrap form')

	$win.scroll(function(){

		var elemTop = $tabs.offset().top;
		var elemBottom = elemTop + $tabs.height();
		if (isScrolledIntoView($tabs,elemTop,elemBottom, 'in'))  {
			if (state !== 'in') {
				state = 'in';
				$or.removeClass('transition-in');
				setTimeout(function(){
					$body.removeClass('fixed-nav');
					$or.css({'width': '', left: ''});
				}, 50)
			}
		} else {
			if (state !== 'out') {
				state = 'out';
				$body.addClass('fixed-nav');
				$or.css({'width': $tabs.width(), left: $form.offset().left});
				setTimeout(function(){
					$or.addClass('transition-in');
				}, 100)
			}
		}

	});

	$win.resize(function(){
		if ($body.is('.fixed-nav')) {
			$or.css({'width': $tabs.width(), left: $form.offset().left})
		}
	})

	$or.find('li').not('#save-tab').click(function(){
		$('html,body').animate({
			scrollTop: 0
		}, 300);
	})

	$('#save-tab').click(function(){
		$(this).closest('form').submit();
		$('#fade-overlay').addClass('loading').find('svg')[0].unpauseAnimations();
	})

	$('#test_email').bind('click', function(){
		var to = $('#test_email_to').val();

		if (!to) {
      alert('Please enter valid e-mail')
			return
		};

		$('#fade-overlay').addClass('loading').find('svg')[0].unpauseAnimations();

		$.ajax({
			type: "post",
			url: window.ajax_url,
			data: "action=ncf_send_message&send_to=" + to +"&ncf_name_field=Name&ncf_email_field=test%40ninjakick.com&ncf_subject_field=Test+Email+From+NK:Contact+Form&ncf_message_field=Test+message",
			dataType: "json",
			success: function(response) {
				console.log(response);
				if (response.success) {
					alert('Check your inbox for email!')
				} else {
					alert('Something went wrong!')
				}
				$('#fade-overlay').removeClass('loading').find('svg')[0].pauseAnimations();
			},
			error: function(){
				alert('Something went wrong!');
				$('#fade-overlay').removeClass('loading').find('svg')[0].pauseAnimations();
			}
		});
	})

	$body.addClass('page-loaded');

})