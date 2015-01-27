<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<select id="cmbUbicacionZona" class="select-block" data-style="btn-success" style="z-index:8;">
</select>
<select id="cmbUbicacionDepartamento" class="select-block" data-style="btn-success" style="z-index:7;">
</select>
<div class="data-area">
	<table class="datatable" id="tblUbicacion" style="margin-top:-28px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>DEPARTAMENTO</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
_tblUbicacion = $('#tblUbicacion');
_cmbUbicacionZona = $('#cmbUbicacionZona');
_cmbUbicacionDepartamento = $('#cmbUbicacionDepartamento');
	_txtZona = $('#txtZona');

	APP.Entities.Ubicacion.RellenarTabla(_tblUbicacion);
	APP.Entities.Zona.RellenarCombo(_cmbUbicacionZona);
	APP.Entities.Departamento.RellenarCombo(_cmbUbicacionDepartamento);

	_cmbUbicacionZona.on('change', function(){
		_tblUbicacion.find('tbody').empty();
		APP.Entities.Ubicacion.listaDeUbicaciones({
			idzona:$(this).val()
		}).success(function(res){
			$.each(res, function(key, val){
				_tblUbicacion.find('tbody').append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
			});
		});
	});
	
	_tblUbicacion.table({
		action:function(e){
			//_txtZona.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			//_txtZona.val($($(e).find('td')[1]).text());
		}
	});

	_cmbUbicacionZona.selectpicker({size:200});
	_cmbUbicacionDepartamento.selectpicker({size:200});

});
</script>