jQuery(function($){
	'use strict';
	$(window).on('load', function(){
		$('.widget_argenta_widget_login_widget').each(function(){
			var wrap = $(this).find('.login-wrap');
			var loginForm = $(this).find('form.login-form');
			var loginFormErr = loginForm.find('.login-error');
			var regForm = $(this).find('form.reg-form');
			var regFormErr = regForm.find('.reg-error');
			var regFormSuc = regForm.find('.reg-success');
			var loggedIn = $(this).find('.logged-in');
			var logout = $(this).find('.logout-link');

			// Registration tab
			loginForm.find('.login-registration a').on('click', function(e){
				e.preventDefault();
				wrap.css('height', regForm.outerHeight() + 'px');
				loginForm.addClass('hidden');
				regForm.addClass('visible');
				return false;
			});
			regForm.find('.back-to-login a').on('click', function(e){
				e.preventDefault();
				wrap.css('height', loginForm.outerHeight() + 'px');
				loginForm.removeClass('hidden');
				regForm.removeClass('visible');
				return false;
			});

			logout.on('click', function(e){
				e.preventDefault();

				var data = {
					'action': 'argenta_ajax_logout',
				};

				$.post( argenta_login_obj.url, data, function(res){
					var obj = JSON.parse(res);

					if( obj.logout ){
						wrap.css('height', loginForm.outerHeight() + 'px');
						loggedIn.removeClass('visible');
						loginForm.removeClass('hidden');
					} else {
						loginFormErr.addClass('visible').html(obj.message);
					}
				});

				return false;
			});

			loginForm.on('submit', function(e){
				e.preventDefault();
				var submitButton = loginForm.find('button[type="submit"]');

				submitButton.addClass('loading');

				loginFormErr.addClass('hidden');
				wrap.css('height', loginForm.outerHeight() + 'px');

				var data = {
					'action': 'argenta_ajax_login',
					'username': loginForm.find('[name="log"]').val(),
					'password': loginForm.find('[name="pwd"]').val(),
					'remember': loginForm.find('[name="rememberme"]').prop('checked'),
				};

				$.post( argenta_login_obj.url, data, function(res){
					submitButton.removeClass('loading');
					var obj = JSON.parse(res);

					if( obj.loggedin ){
						wrap.css('height', loggedIn.outerHeight() + 'px');
						loginForm.addClass('hidden');
						loggedIn.addClass('visible');
						loggedIn.find('.box-name').html(obj.username);
					} else {
						/*console.log(obj.message);*/
						loginFormErr.removeClass('hidden').html(obj.message);
						wrap.css('height', loginForm.outerHeight() + 'px');
					}
				});

				return false;
			});

			regForm.on('submit', function(e){
				e.preventDefault();
				var submitButton = regForm.find('button[type="submit"]');

				submitButton.addClass('loading');
				regFormErr.addClass('hidden');
				regFormSuc.addClass('hidden');
				wrap.css('height', regForm.outerHeight() + 'px');

				var data = {
					'action': 'argenta_ajax_registr',
					'username': regForm.find('[name="log"]').val(),
					'email': regForm.find('[name="email"]').val()
				};

				$.post( argenta_login_obj.url, data, function(res){
					submitButton.removeClass('loading');
					var obj = JSON.parse(res);

					if( obj.success_reg ){
						regFormSuc.removeClass('hidden').html( obj.message );
					} else {
						regFormErr.removeClass('hidden').html( obj.message );
					}

					wrap.css('height', regForm.outerHeight() + 'px');
				});

				return false;
			});

		});
	});

});