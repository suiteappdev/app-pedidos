<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form">
	<div class="form-group">
		<input type="text" value="" id="txtEstadoProducto" placeholder="estado" class="form-control letters animated fadeInLeft">
	</div>
	<div class="data-area">
		<table class="datatable" id="tblEstadoProducto" style="margin-top:-28px;">
			<thead>
				<tr>
					<td>ID</td>
					<td>PAIS</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(function(){
	_tblEstadoProducto = $('#tblEstadoProducto');
	_txtEstadoProducto = $('#txtEstadoProducto');

	APP.Entities.EstadoProductos.RellenarTabla(_tblEstadoProducto);
	
	_tblEstadoProducto.table({
		action:function(e){
			_txtEstadoProducto.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			_txtEstadoProducto.val($($(e).find('td')[1]).text());
		}

	});
});
</script>