(function($){
	$.fn.table = function(setting){
		return this.each(function(){
			_table = $(this);
			_rs = new Object();

			$(document).bind('DOMNodeInserted', _table,  function(e) {
			    _self = $(e.target);
			    if(_self.is("tr")) {
			    	_self.on('click', function(){
						_table.find('tbody .selectedRow').removeClass('selectedRow');
						$(this).addClass('selectedRow');
			    		setting.action(e); 
			    	});
			    }           
			});

			$(window).on('keyup', _table, function(e){
				if(e.keyCode == 38){
					_activeRow = _table.find('tr.selectedRow');
					if(_activeRow.length){
						if(_activeRow.index() == 0){
							_table.parent().scrollTop(0);
							return;
						}

						_activeRow.removeClass('selectedRow');
						_activeRow.prev().addClass('selectedRow');
						if(_activeRow.position().top + _activeRow.height() > 0 && _activeRow.position().top < _table.parent().height()){
						
						}else{
							_table.parent().scrollTop(_table.parent().scrollTop() +_activeRow.position().top);
						}
						 
					}else{
						_table.find('tbody').children().last().addClass('selectedRow');
					}

					setting.UpDownArrow(_table.find('tr.selectedRow'));
				}

				if(e.keyCode == 40){
					_activeRow = _table.find('tr.selectedRow');
					if(_activeRow.length){
						if(_table.find('tbody tr:last').hasClass('selectedRow')){
							return;
						}

						_activeRow.removeClass('selectedRow');
						_activeRow.next().addClass('selectedRow');

						if(_activeRow.position().top + _activeRow.height() > 0 && _activeRow.position().top < _table.parent().height()){
							console.log('visible')
						}else{
							_table.parent().scrollTop(_table.parent().scrollTop() + _activeRow.position().top);
						}

					}else{
						_table.find('tbody').children().first().addClass('selectedRow');
					}

					setting.UpDownArrow(_table.find('tr.selectedRow'));
				}	
			});
			});
	}	
}(jQuery));
