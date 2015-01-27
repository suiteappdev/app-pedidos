<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<nav class="navbar navbar-inverse navbar-embossed" role="navigation" style="margin-bottom:10px!important;">
	<select id="cmbFiltro"  class="select-block" data-style="btn-success" style="width:150px; display:inline-block;margin-top: 10px;margin-left: 5px;">
		<option value="2">referencia</option>
		<option value="1">producto</option>
	</select>
	<form class="navbar-form navbar-right" action="#" role="search">
		<div class="form-group">
				  <div class="input-group">
				    <input class="form-control" id="txtBuscar" type="search" placeholder="Buscar Referencia">
				    <span class="input-group-btn">
				      <button type="submit" class="btn"><span class="fui-search"></span></button>
				    </span>
				  </div>
			</div>
	</form>
</nav>
<div class="colset-1 form-element-margin">
	<input type="text" value="" id="txtReferencia" placeholder="referencia" class="form-control" style="z-index:99999;">
</div>
<div class="colset-1 form-element-margin">
	<div class="input-group">
	  <span class="input-group-addon">22</span>
		<input type="text" value="" disabled="disabled" id="txtReferenciaProducto" placeholder="Producto" class="form-control" style="z-index:10;">
	</div>
</div>
<div class="data-area">
	<table class="datatable" id="tblBuscar" style="margin-top:-28px;">
		<thead>
			<tr>
				<td><span class="icon-key"> </span>ID</td>
				<td><span class="icon-key2"> </span>IDENTIFICACION</td>
				<td><span class="icon-user"> </span>NOMBRE</td>
				<td><span class="icon-profile"> </span>APELLIDOS</td>
				<td><span class="icon-office"> </span>DIRECCION</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
	_cmbFiltro = $('#cmbFiltro');
	_tblBuscar = $('#tblBuscar');
	_txtBuscar = $('#txtBuscar');
	_txtReferenciaProducto = $('#txtReferenciaProducto');
	_txtReferenciaProducto.val($('#txtProductoDescripcion').val());

	_cmbFiltro.on('change', function(){
		_txtBuscar.focus();
	});

	_txtBuscar.on('keyup', function(){
		_val = $(this).val();
		_col = _cmbFiltro.val();
		_tblBuscar.find('tbody tr').each(function(key, val){
			if($($(val).children()[_col]).text().toLowerCase().indexOf(_val.toLowerCase()) >= 0){
				$(val).show();
			}else{
				$(val).hide();
			}
		});
	})

	//APP.Entities.Usuario.RellenarTabla(_tblBuscar);

	new APP.util.table(_tblBuscar, {
		action:function(e){
			//_txtTipoCliente.val($($(e.target).find('td')[1]).text());

		},

		UpDownArrow:function(e){
			//_txtTipoCliente.val($($(e).find('td')[1]).text());
		}

	});

	_cmbFiltro.selectpicker();
});
</script>