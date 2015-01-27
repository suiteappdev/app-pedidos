<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="form-group">
	<input type="text" value="" id="txtZona" placeholder="Zona" class="form-control animated fadeInLeft">
</div>
<div class="data-area">
	<table class="datatable" id="tblZona" style="margin-top:-28px;">
		<thead>
			<tr>
				<td>ID</td>
				<td>ZONA</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
	_tblZona = $('#tblZona');
	_txtZona = $('#txtZona');

	APP.Entities.Zona.RellenarTabla(_tblZona);
	_tblZona.table({
		action:function(e){
			_txtZona.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			_txtZona.val($($(e).find('td')[1]).text());
		}
	});
});
</script>