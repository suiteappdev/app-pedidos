<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form">
	<div class="form-group">
		<input type="text" value="" id="txtDepartamento" placeholder="Departamento" class="form-control letters animated fadeInLeft">
	</div>
	<select id="cmbPais" class="select-block" data-style="darkYellow" style="width:100%;">
	</select>
	<div class="data-area">
		<table class="datatable" id="tblDepartamento" style="margin-top:-28px;">
			<thead>
				<tr>
					<td><span class="icon-key" style="margin-right:5px;"></span>ID</td>
					<td><span class="icon-flag" style="margin-right:5px;"></span>DEPARTAMENTO</td>
					<td><span class="icon-road" style="margin-right:5px;"></span>PAIS</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
$(function(){
	_txtDepartamento = $('#txtDepartamento');
	_cmbPais = $('#cmbPais');
	_tblDepartamento = $('#tblDepartamento');

	APP.Entities.Pais.RellenarCombo(_cmbPais);
	APP.Entities.Departamento.RellenarTabla(_tblDepartamento);
	
	_tblDepartamento.table({
		action:function(e){
			_txtDepartamento.val($($(e.target).find('td')[1]).text());
			_cmbPais.val($($(e.target).find('td')[2]).data('id'));
		},

		UpDownArrow:function(e){
			_txtDepartamento.val($($(e).find('td')[1]).text());
			_cmbPais.selectpicker('val', $(e).find('[data-idpais]').data('idpais'));
		}

	});
	_cmbPais.selectpicker();
});
</script>