<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form">
	<form enctype="multipart/form-data" >
		<div class="colset-1 form-element-margin">
			<input type="text" value="" id="txtDescripcion" placeholder="descripcion" class="form-control letters animated fadeInLeft">
		</div>
		<select id="cmbEstado" class="select-block" data-style="darkYellow" style="width:100%;display:inline-block;">
		</select>
		<select id="cmbFamilia1" class="select-block" data-style="darkYellow" style="width:100%;display:inline-block;">
		</select>
		<div class="colset-1 form-element-margin">
			<div class="custom-file-upload">
			    <input type="file" id="fileFamilia2" name="myfiles[]" accept="image/x-png, image/gif, image/jpeg, image/jpg">
			</div>
		</div>
	</form>
	<div class="data-area">
		<table class="datatable" id="tblFamilia2" style="margin-top:-28px;">
			<thead>
				<tr>
					<td>ID</td>
					<td>FAMILIA</td>
					<td>FAMILIA PADRE</td>
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
	_fileFamilia2 = $('#fileFamilia2');
	_cmbFamilia1 = $('#cmbFamilia1');
	_txtDescripcion = $('#txtDescripcion');
	_cmbEstado = $('#cmbEstado');
	_tblFamilia2 = $('#tblFamilia2');

	APP.Entities.Familia1.RellenarCombo(_cmbFamilia1);
	APP.Entities.Familia2.RellenarTabla(_tblFamilia2);
	APP.Entities.EstadoCategoria.RellenarCombo(_cmbEstado);
	APP.Entities.Familia1

	_cmbFamilia1.selectpicker({size:200});
	_cmbEstado.selectpicker();
	_fileFamilia2.customFile();
	
	_tblFamilia2.table({
		action:function(e){
			_txtDescripcion.val($($(e.target).find('td')[1]).text());
			_cmbEstado.selectpicker('val', $(e.target).find('[data-idestado]').data('idestado'));
			_cmbFamilia1.selectpicker('val', $(e.target).find('[data-idfamilia]').data('idfamilia'));
		},

		UpDownArrow:function(e){
			_txtDescripcion.val($($(e).find('td')[1]).text());
			_cmbEstado.selectpicker('val', $(e).find('[data-idestado]').data('idestado'));
			_cmbFamilia1.selectpicker('val', $(e).find('[data-idfamilia]').data('idfamilia'));
		}

	});
});
</script>