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
		<select id="cmbFamilia3" class="select-block" data-style="darkYellow" style="width:100%;display:inline-block;">
		</select>
		<div class="colset-1 form-element-margin">
			<div class="custom-file-upload">
			    <input type="file" id="fileFamilia4" name="myfiles[]" accept="image/x-png, image/gif, image/jpeg, image/jpg">
			</div>
		</div>
	</form>
	<div class="data-area">
		<table class="datatable" id="tblFamilia4" style="margin-top:-28px;">
			<thead>
				<tr>
					<td>ID</td>
					<td>FAMILA</td>
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
	_fileFamilia4 = $('#fileFamilia4');
	_cmbFamilia3 = $('#cmbFamilia3');
	_txtDescripcion = $('#txtDescripcion');
	_cmbEstado = $('#cmbEstado');
	_tblFamilia4 = $('#tblFamilia4');

	APP.Entities.Familia3.RellenarCombo(_cmbFamilia3);
	APP.Entities.Familia4.RellenarTabla(_tblFamilia4);
	APP.Entities.EstadoCategoria.RellenarCombo(_cmbEstado);

	_cmbFamilia3.selectpicker({size:200});
	_cmbEstado.selectpicker();
	_fileFamilia4.customFile();
	
	_tblFamilia4.table({
		action:function(e){
			_txtDescripcion.val($($(e.target).find('td')[1]).text());
			_cmbEstado.selectpicker('val', $(e.target).find('[data-idestado]').data('idestado'));
			_cmbFamilia3.selectpicker('val', $(e.target).find('[data-idfamilia]').data('idfamilia'));
		},

		UpDownArrow:function(e){
			_txtDescripcion.val($($(e).find('td')[1]).text());
			_cmbEstado.selectpicker('val', $(e).find('[data-idestado]').data('idestado'));
			_cmbFamilia3.selectpicker('val', $(e).find('[data-idfamilia]').data('idfamilia'));
		}

	});
});
</script>