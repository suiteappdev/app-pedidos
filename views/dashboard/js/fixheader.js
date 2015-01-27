$(function(){
	function fixheader(){
		_table = $('.datatable');
		_thead = _table.find('thead');

		fixed_table = $('</table>', {
			'cellpadding': 5,
			'cellspacing':0,
			'border':1,
			'id':'fixed_table_header'
		});

		fixed_table_wrapper = $('</div>', {
			'height': 300,
			 'css': {
			 	'overflow': 'scroll'
			 }
		});

		_table.before(fixed_table);

		_thead.find('td').each(function(){
			$(this).css('width', $(this).width());
		});

		fixed_thead = _thead.clone();
		fixed_table.append(fixed_thead);

		_thead.hide();
		_table.wrap(fixed_table_wrapper);		
	}
});