$(function(){
	/**** - Define Namespace Entities Message- ****/
	APP.Entities.Programa = {
		ObtenerProgramas : function(){
			_data = [];
			$.ajax({
				async:false,
				type : 'POST',
				url:BASE_PATH+'programa/',
				dataType:'JSON',
				success : function(data){
					_data = data;
				}
			});

			return _data;
		}
	}
})