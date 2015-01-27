$(document).ready(function(){
		BASE_PATH = 'http://localhost/';
		APP = {};

	APP.RegexCollection = {
		 username : new RegExp('[0-9a-zA-zñÑ]'),
		 password: new RegExp('[0-9a-zA-zñÑ]'),
		 email: new RegExp('^([ñÑa-zA-Z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$'),
		 creditcard:new RegExp('^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$'),
		 number:new RegExp('^[0-9]*$'),
		 letters: new RegExp('^[Ñña-zA-Z ]*$'),
		 passwordStrong :new RegExp('/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15})/gm'),
		 phoneNumber:new RegExp('[0-9-()+]{3,20}'),
		 alpha:new RegExp('^([Ñña-zA-Z0-9 _-]+)$'),
		 url:new RegExp('(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})')
	};

	$.fn.extend({
		notification : function(setup, callback){
			_renderOn = $(this);
			DEFAULT_MSG = "Success";
			DEFAULT_CLOSABLE = true;
			MSG_TEMPLATE = $('<div id="frm-msg" class="white light animated fadeInLeft"><p></p><div id="msg-close"></div></div>');
			
			if(arguments.length == 0 || $.isEmptyObject(setup)){
				throw new Error('invalid arguments, must be a object type');
			}else{

				if(setup.msgtype == 'error'){
					MSG_TEMPLATE.css('background-image','url('+BASE_PATH+'public/images/msg_error.png)');
				}else if(setup.msgtype == 'warning'){
					MSG_TEMPLATE.css('background-image', 'url('+BASE_PATH+'public/images/msg_warning.png)');
				}else if(setup.msgtype == 'success'){
					MSG_TEMPLATE.css('background-image', 'url('+BASE_PATH+'public/images/msg_success.png)');
				}

				if(setup.closable){
					MSG_TEMPLATE.find('#msg-close').on('click', function(){
						$(this).parent().hasClass('animated fadeInLeft') ? $(this).parent().removeClass('animated fadeInLeft'):$(this).parent().addClass('animated fadeOutLeft');
						$(this).parent().remove();
					});
				}else{
					MSG_TEMPLATE.find('#msg-close').hasClass('animated fadeInLeft') ? MSG_TEMPLATE.find('#msg-close').removeClass('animated fadeInLeft') : MSG_TEMPLATE.find('#msg-close').addClass('animated fadeInLeft');
				}
				
				setTimeout(function(){
					$('#frm-msg').remove();
				}, 4000);

				MSG_TEMPLATE.find('p').html(setup.message);
				_renderOn.append(MSG_TEMPLATE);

				if(typeof(callback) =='function'){
					callback();
				}else{
					return;
				}
			}
		}
	});


	APP.validateField = function(parameters){
		if(arguments.length == 3){
			if(arguments[0].length > arguments[2]){
				return	false;
			}else{
				if(arguments[0].length == 0){
					return false;
				}
					return APP.RegexCollection[arguments[1].toLowerCase()].test(arguments[0]);
			}
		}else if(arguments.length == 2){
				if(arguments[0].length == 0){
					return false;
				}
				
				return APP.RegexCollection[arguments[1].toLowerCase()].test(arguments[0]);
			}			
		}
		
	APP.validateForm = function(form){
		_controls = $(form).find('input[type=text], input[type=password]');
		_controlErrorStore = [];

		if(_controlErrorStore.length > 0)
			_controlErrorStore.length = 0;
		
		$.each(_controls, function(key, control){
			_control = $(control);
			switch(true){
				case(_control.hasClass('username')):
					if(!APP.validateField(_control.val(), 'username')){
						_controlErrorStore.push(_control);
						if(_control.parent().hasClass('has-error')){
							return;
						}
						_control.parent().addClass('has-error');
					}else{
						if(_control.parent().hasClass('has-error')){
							_control.parent().removeClass('has-error');
						}
					}
				break;
				case(_control.hasClass('email')):
					if(!APP.validateField(_control.val(), 'email')){
						_controlErrorStore.push(_control);
						if(_control.parent().hasClass('has-error')){
							return;
						}
						_control.parent().addClass('has-error');
					}else{
						if(_control.parent().hasClass('has-error')){
							_control.parent().removeClass('has-error');
						}
					}				
				break;
				case(_control.hasClass('letters')):
					if(!APP.validateField(_control.val(), 'letters')){
						_controlErrorStore.push(_control);
						if(_control.parent().hasClass('has-error')){
							return;
						}
						_control.parent().addClass('has-error');
					}else{
						if(_control.parent().hasClass('has-error')){
							_control.parent().removeClass('has-error');
						}
					}				
				break;
				case(_control.hasClass('number')):
					if(!APP.validateField(_control.val(), 'number')){
						_controlErrorStore.push(_control);
						if(_control.parent().hasClass('has-error')){
							return;
						}
						_control.parent().addClass('has-error');
					}else{
						if(_control.parent().hasClass('has-error')){
							_control.parent().removeClass('has-error');
						}
					}				
				break;
				case(_control.hasClass('password')):
					if(!APP.validateField(_control.val(), 'password')){
						_controlErrorStore.push(_control);
						if(_control.parent().hasClass('error')){
							return;
						}
						_control.parent().addClass('has-error');
					}else{
						if(_control.parent().hasClass('has-error')){
							_control.parent().removeClass('has-error');
						}
					}
				break;
			}
				
		});
			if(_controlErrorStore.length == 0){
				return true;
			}else{
				return false;
			}
	}

	APP.url =  {};

	APP.url.Redirect = function(url){
		if(typeof(arguments[0]) != 'string'){
			throw new Error('arg must be a string');
		}

		if(APP.validateField(BASE_PATH + arguments[0], 'url')){
			window.location.href = BASE_PATH + arguments[0];
		}else{
			throw new Error('invalid url');
		}  
	}

	APP.util = {};

	APP.util.fixheader = function(tbl){
		_table = $(tbl);
		_thead = _table.find('thead');

		fixed_table = $('<table class="fixedtable datatable"></table>');

		fixed_table_wrapper = $('<div class="fixedtablewrapper"></div>');
		_table.before(fixed_table);

		_thead.find('td').each(function(){
			$(this).css('width', $(this).width());
		});


		fixed_thead = _thead.clone();
		fixed_table.append(fixed_thead);
		_thead.css({'visibility':'hidden'});
		_table.wrap(fixed_table_wrapper);
	}
	
	APP.UI  = {};
	APP.UI.setActivedMenuItem = function(MenuItemCollection){
		$('.vertical-menu-item[data-action]').find('.icon-play3').remove();
		$('.vertical-menu-item[data-action]').removeClass('selectedMenuItem');
		MenuItemCollection.append('<span class="icon-play3 active-menu-arrow"><span>');
		MenuItemCollection.addClass('selectedMenuItem');
	}
});