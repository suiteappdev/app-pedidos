<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form">
	<form enctype="multipart/form-data" >
		<div class="colset-1 form-element-margin">
			<input type="text" value="" id="txtDescripcion" placeholder="descripcion" class="form-control alpha animated fadeInLeft">
		</div>
		<select id="cmbEstado" class="select-block" data-style="darkYellow" style="width:100%;display:inline-block;">
		</select>
		<div class="colset-1 form-element-margin">
			<div class="custom-file-upload">
			    <input type="file" id="fileFamilia1" name="myfiles[]" accept="image/x-png, image/gif, image/jpeg, image/jpg">
			</div>
		</div>
	</form>
	<div class="data-area">
		<table class="datatable" id="tblFamilia1" style="margin-top:-28px;">
			<thead>
				<tr>
					<td>ID</td>
					<td>FAMILIA</td>
					<td>IMAGEN</td>
					<td>ESTADO</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(function(){
	_fileFamilia1 = $('#fileFamilia1');
	_txtDescripcion = $('#txtDescripcion');
	_tblFamilia1 = $('#tblFamilia1');
	_cmbEstado = $('#cmbEstado');

	APP.Entities.EstadoCategoria.RellenarCombo(_cmbEstado);
	APP.Entities.Familia1.RellenarTabla(_tblFamilia1);
	_fileFamilia1.customFile();
	_cmbEstado.selectpicker();
	
	_tblFamilia1.table({
		action:function(e){
			_txtDescripcion.val($($(e.target).find('td')[1]).text());
			_cmbEstado.selectpicker('val', $(e.target).find('[data-idestado]').data('idestado'));
		},

		UpDownArrow:function(e){
			_txtDescripcion.val($($(e).find('td')[1]).text());
			_cmbEstado.selectpicker('val', $(e).find('[data-idestado]').data('idestado'));
		}

	});
});
</script>