$(function(){
	APP.Data = {};
	APP.View = {};
	_workspace = $('.workspace');
	_body = $('body');
	
	APP.View.load = function(controlador, vista){
		if(controlador == '' && vista == ''){
			throw new Error('argv must be a string');
		}

		return $.ajax({
			type:'POST',
			dataType:'html',
			data:{vista : vista},
			url:BASE_PATH+controlador+'/vista'
		});
	}

	$('.vertical-menu-item[data-action]').on('click', function(){
		APP.View.load($(this).data('action'), $(this).data('route')).success(function(res){
			_workspace.html(res);
			cmdBoardItem = _workspace.find('.board-item');
			cmdBoardItem.each(function(key, ele){
				$(ele).on('click', function(){
					APP.Entities[$(this).data('entity')][$(this).data('cmdaction')]();					
				});
			});			
		});

		APP.UI.setActivedMenuItem($(this));
	});
})