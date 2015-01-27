<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form">
	<div class="form-group">
		<input type="text" value="" id="txtCiudad" placeholder="Ciudad" class="form-control letters animated fadeInLeft">
	</div>
	<select id="cmbDepartamento" class="select-block" data-style="darkYellow">
	</select>
	<div class="data-area">
		<table class="datatable" id="tblCiudad" style="margin-top:-28px;">
			<thead>
				<tr>
					<td><span class="icon-key" style="margin-right: 5px;"></span>ID</td>
					<td><span class="icon-file" style="margin-right: 5px;"></span>CIUDAD</td>
					<td><span class="icon-flag" style="margin-right: 5px;"></span> DEPARTAMENTO</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(function(){
	_tblCiudad = $('#tblCiudad');
	_cmbDepartamento = $('#cmbDepartamento')
	_txtCiudad = $('#txtCiudad');

	APP.Entities.Ciudad.RellenarTabla(_tblCiudad);
	APP.Entities.Departamento.RellenarCombo(_cmbDepartamento)

	_tblCiudad.table({
		action:function(e){
			_txtCiudad.val($($(e.target).find('td')[1]).text());
			_cmbDepartamento.selectpicker('val', $(e).find('[data-iddepartamento]').data('iddepartamento'));

		},

		UpDownArrow:function(e){
			_txtCiudad.val($($(e).find('td')[1]).text());
			_cmbDepartamento.selectpicker('val', $(e).find('[data-iddepartamento]').data('iddepartamento'));
		}

	});
	_cmbDepartamento.selectpicker({size:200});
});
</script>