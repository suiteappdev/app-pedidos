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
		<select id="cmbFamilia4" class="select-block" data-style="darkYellow" style="width:100%;display:inline-block;">
		</select>
		<div class="colset-1 form-element-margin">
			<div class="custom-file-upload">
			    <input type="file" id="fileFamilia5" name="myfiles[]" accept="image/x-png, image/gif, image/jpeg, image/jpg">
			</div>
		</div>
	</form>
	<div class="data-area">
		<table class="datatable" id="tblFamilia5" style="margin-top:-28px;">
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
	_fileFamilia5 = $('#fileFamilia5');
	_cmbFamilia4 = $('#cmbFamilia4');
	_txtDescripcion = $('#txtDescripcion');
	_cmbEstado = $('#cmbEstado');
	_tblFamilia5 = $('#tblFamilia5');

	APP.Entities.Familia4.RellenarCombo(_cmbFamilia4);
	APP.Entities.Familia5.RellenarTabla(_tblFamilia5);
	APP.Entities.EstadoCategoria.RellenarCombo(_cmbEstado);

	_cmbFamilia4.selectpicker({size:200});
	_cmbEstado.selectpicker();
	_fileFamilia5.customFile();
	
	_tblFamilia5.table({
		action:function(e){
			_txtDescripcion.val($($(e.target).find('td')[1]).text());
			_cmbEstado.selectpicker('val', $(e.target).find('[data-idestado]').data('idestado'));
			_cmbFamilia4.selectpicker('val', $(e.target).find('[data-idfamilia]').data('idfamilia'));
		},

		UpDownArrow:function(e){
			_txtDescripcion.val($($(e).find('td')[1]).text());
			_cmbEstado.selectpicker('val', $(e).find('[data-idestado]').data('idestado'));
			_cmbFamilia4.selectpicker('val', $(e).find('[data-idfamilia]').data('idfamilia'));
		}

	});
});
</script>