<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form-group">
	<input type="text" value="" id="txtTipoCliente" placeholder="Tipo de usuario" class="form-control animated fadeInLeft">
</div>
<div class="data-area">
	<table class="datatable" id="tblTipoCliente" style="margin-top:-28px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>Perfil</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
	_tblTipoCliente = $('#tblTipoCliente');
	_txtTipoCliente = $('#txtTipoCliente');

	APP.Entities.tipoCliente.RellenarTabla(_tblTipoCliente);

	_tblTipoCliente.table({
		action:function(e){
			_txtTipoCliente.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			_txtTipoCliente.val($($(e).find('td')[1]).text());
		}

	});
});
</script>