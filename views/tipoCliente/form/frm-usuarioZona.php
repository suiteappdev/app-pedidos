<php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<select id="cmbUsuario" class="select-block" data-style="darkYellow" style="z-index:9;">
</select>
<select id="cmbZona" class="select-block" data-style="darkYellow" style="z-index:8;">
</select>
<select id="cmbLineaPrecio" class="select-block" data-style="darkYellow" style="z-index:8;">
</select>
<div class="data-area">
	<table class="datatable" id="tblUsuarioZona" style="margin-top:-28px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>IDENTIFICACION</td>
				<td>ZONA</td>
				<td>LINEA</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
	_tblUsuarioZona = $('#tblUsuarioZona');
	_cmbUsuario = $('#cmbUsuario');
	_cmbZona = $('#cmbZona');
	_cmbLineaPrecio = $('#cmbLineaPrecio');

	APP.Entities.Zona.RellenarCombo(_cmbZona);
	APP.Entities.LineaPrecio.RellenarCombo(_cmbLineaPrecio);
	APP.Entities.UsuarioZona.RellenarTabla(_tblUsuarioZona);

	APP.Entities.Usuario.listaUsuarios().success(function(res){
		$.each(res, function(key, val){
			_cmbUsuario.append('<option value="'+val.identificacion+'">'+val.nombres+'</option>');
		});
	});

	_cmbUsuario.on('change', function(){
		APP.Entities.UsuarioZona.listaDeUsuarioZonas({
			identificacion:$(this).val()
		}).success(function(res){
			_tblUsuarioZona.find('tbody').empty();
			$.each(res, function(key, val){
				_tblUsuarioZona.append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td data-identificacion="'+val.identificacion+'">'+val.identificacion+'</td><td data-zona="'+val.idzona+'">'+val.zona+'</td><td data-lineaprecio="'+val.idlinea+'">'+val.lineaprecio+'</td></tr>');
			});
		});
	});

	_cmbUsuario.selectpicker({size:200});
	_cmbLineaPrecio.selectpicker({size:200});
	_cmbZona.selectpicker({size:200});

	_tblUsuarioZona.table({
		action:function(e){
			_cmbZona.selectpicker('val', $($(e.target).find('td')[2]).data('zona'));
			_cmbLineaPrecio.selectpicker('val', $($(e.target).find('td')[3]).data('lineaprecio'));
		},

		UpDownArrow:function(e){
			_cmbZona.selectpicker('val', $($(e).find('td')[2]).data('zona'));
			_cmbLineaPrecio.selectpicker('val', $($(e).find('td')[3]).data('lineaprecio'));
		}

	});
});
</script>