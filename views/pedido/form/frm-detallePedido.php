<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area" id="msgAreaPedido">
</div>
<div class="colset-1">
	<div class="data-area">
		<table class="datatable" id="tblDetallePedidos" style="margin-top:-28px;">
			<thead>
				<tr>
					<td><span class="icon-key"> </span>PEDIDO</td>
					<td><span class="icon-signup"> </span>REFERENCIA</td>
					<td><span class="icon-stack"> </span>PRODUCTO</td>
					<td><span class="icon-stack"> </span>% DESCUENTO</td>
					<td><span class="icon-stack"> </span>% DESCUENTO</td>
					<td><span class="icon-stack"> </span>% DESCUENTO</td>
					<td><span class=" icon-calculate"> </span>CANTIDAD</td>
					<td><span class="icon-coin"> </span>PRECIO</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(function(){
	_tblDetallePedido = $('#tblDetallePedidos');
	_tblDetallePedido.table({
		action:function(e){
		},

		UpDownArrow:function(e){
		}

	});

});
</script>