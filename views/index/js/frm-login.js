$(function(){
	function SessionInit(){
		_form = $('#frm-login');
		_frm_msg_area = $('.login-msg-area');
		if(APP.validateForm(_form)){
			$.ajax({
				type:'GET',
				url:BASE_PATH+'usuario/userAuth',
				data:_form.serialize(),
				dataType :'JSON',
				success: function(data){
					if(data.session)
						APP.url.Redirect('dashboard');
					else
						_frm_msg_area.notification({
							message : 'Datos Incorrectos',
							delay: 1000,
							parentElement : this,
							effect : 'slideDown',
							type : 'error',
							closable:true	
						}, setTimeout(function(){
							_frm_msg_area.children().slideUp('fast').remove();
						}, 10000));						
				}
			});
		}
	}

	$('#cmdLogin').on('click', function(e){
		e.preventDefault();
		$.get(BASE_PATH+'/index/loadhtml', function(data){
			_html = data;
	        var dialog = new BootstrapDialog({
	        	cssClass:'login-dialog',
	            buttons: [{
	                label: 'Iniciar',
	                hotkey:13,
	                autospin: true,
	                cssClass: 'btn-primary',
	                action: function(dialog) {
						SessionInit();
	                }
	            },
	            {
	                icon: 'glyphicon glyphicon-ban-circle',
	                label: 'Cancelar',
	                cssClass: 'btn-warning',
	                action:function(dialog){
	                	dialog.close();
                }
            }],
	            draggable: true,
	        });
			
			dialog.realize();
			dialog.setMessage(_html);
			dialog.getModalHeader().css('background-image', 'url(public/images/pattern.jpg)');
			dialog.getModalBody().css('width', '300px');
			dialog.getModalBody().css('padding', '4px');
			dialog.getModalFooter().css('margin-top', '0px');
			dialog.getModalFooter().css('border-top', '0px');
			dialog.getModalFooter().css('padding', '10px 10px 10px');
			dialog.setTitle('Iniciar Sesion');
			dialog.open();

		});

	});

})