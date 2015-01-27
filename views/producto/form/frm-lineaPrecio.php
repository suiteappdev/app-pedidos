<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form-group">
	<input type="text" value="" id="txtLineaPrecio" placeholder="Linea de precio" class="form-control animated fadeInLeft">
</div>
<div class="data-area">
	<table class="datatable" id="tblLineaPrecio" style="margin-top:-28px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>LISTA DE PRECIO</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
_tblLineaPrecio = $('#tblLineaPrecio');
_txtLineaPrecio = $('#txtLineaPrecio');

	APP.Entities.LineaPrecio.RellenarTabla(_tblLineaPrecio);
	
	_tblLineaPrecio.table({
		action:function(e){
			_txtLineaPrecio.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			_txtLineaPrecio.val($($(e).find('td')[1]).text());
		}

	});
});
</script>