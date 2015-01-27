<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form-group">
	<input type="text" value="" id="txtEstado" placeholder="estado" class="form-control animated fadeInLeft">
</div>
<div class="data-area">
	<table class="datatable" id="tblEstados" style="margin-top:-28px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>ESTADOS</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
	_tblEstado = $('#tblEstados');
	_txtEstado = $('#txtEstado');

	APP.Entities.EstadoCliente.RellenarTabla(_tblEstado);

	_tblEstado.table({
		action:function(e){
			_txtEstado.val($($(e.target).find('td')[1]).text());

		},

		UpDownArrow:function(e){
			_txtEstado.val($($(e).find('td')[1]).text());
		}

	});
});
</script>