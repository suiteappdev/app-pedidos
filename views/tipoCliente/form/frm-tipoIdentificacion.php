<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form-group">
	<input type="text" value="" id="txtTipoIdentificacion" placeholder="Tipo de identificacion" class="form-control animated fadeInLeft">
</div>
<div class="data-area">
	<table class="datatable" id="tblTipoIdentificacion" style="margin-top:-28px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>IDENTIFICACION</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
	_tblTipoIdentificacion = $('#tblTipoIdentificacion');
	_txtTipoIdentificacion = $('#txtTipoIdentificacion');

	APP.Entities.tipoIdentificacion.RellenarTabla(_tblTipoIdentificacion);

	_tblTipoIdentificacion.table({
		action:function(e){
			_txtTipoIdentificacion.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			_txtTipoIdentificacion.val($($(e).find('td')[1]).text());
		}

	});
});
</script>