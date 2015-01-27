<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form">
	<div class="form-group">
		<input type="text" value="" id="txtDescripcion" placeholder="Pais" class="form-control letters animated fadeInLeft">
	</div>
	<div class="data-area">
		<table class="datatable" id="tblEstadoCategoria" style="margin-top:-28px;">
			<thead>
				<tr>
					<td><span class="icon-key" style="margin-right:5px;"></span>ID</td>
					<td><span class="icon-earth" style="margin-right:5px;"></span>Descripcion</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(function(){
	_tblEstadoCategoria = $('#tblEstadoCategoria');
	_txtEstadoCategoria = $('#txtDescripcion');

	APP.Entities.EstadoCategoria.RellenarTabla(_tblEstadoCategoria);
	
	_tblEstadoCategoria.table({
		action:function(e){
			_txtEstadoCategoria.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			_txtEstadoCategoria.val($($(e).find('td')[1]).text());
		}

	});
});
</script>