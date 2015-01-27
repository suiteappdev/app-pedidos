<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1">
	<div class="colset-1 message-msg-area">
	</div>
	<div class="form-group">
		<input type="text" value="" id="txtDescripcion" placeholder="Impuestos" class="form-control animated fadeInLeft">
	</div>
	<div class="data-area">
		<table class="datatable" id="tblImpuestos" style="margin-top:-28px;">
			<thead>
				<tr>
					<td>ID</td>
					<td>IMPUESTO</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(function(){
_tblImpuestos = $('#tblImpuestos');
_txtImpuestos = $('#txtDescripcion');

	APP.Entities.Impuestos.RellenarTabla(_tblImpuestos);
	
	_tblImpuestos.table({
		action:function(e){
			_txtImpuestos.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			_txtImpuestos.val($($(e).find('td')[1]).text());
		}

	});

	/*_cmbUbicacionZona.selectpicker({size:200});
	_cmbUbicacionDepartamento.selectpicker({size:200});*/

});
</script>