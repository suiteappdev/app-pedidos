<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form">
	<div class="form-group">
		<input type="text" value="" id="txtDescripcion" placeholder="estado" class="form-control letters animated fadeInLeft">
	</div>
	<div class="data-area">
		<table class="datatable" id="tblEstadoPedido" style="margin-top:-28px;">
			<thead>
				<tr>
					<td>ID</td>
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
	_tblEstadoPedido = $('#tblEstadoPedido');
	_txtEstadoPedido = $('#txtDescripcion');

	APP.Entities.EstadoPedido.RellenarTabla(_tblEstadoPedido);
	
	_tblEstadoPedido.table({
		action:function(e){
			_txtEstadoPedido.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			_txtEstadoPedido.val($($(e).find('td')[1]).text());
		}

	});
});
</script>