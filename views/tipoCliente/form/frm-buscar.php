<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
	<select id="cmbFiltro"  class="select-block" data-style="btn-success" style="width:250px; display:inline-block;margin-top: 10px;margin-left: 5px;">
		<option value="2">Nombre | Apellido</option>
		<option value="1">Identificacion</option>
		<option value="3">Telefono</option>
	</select>
	<form class="navbar-form navbar-right" action="#" role="search">
		<div class="form-group">
				  <div class="input-group">
				    <input class="form-control" id="txtBuscar" type="search" placeholder="Buscar Cliente">
				    <span class="input-group-btn">
				      <button type="button"  class="btn" id="cmdBuscar"><span class="fui-search"></span></button>
				    </span>
				  </div>
			</div>
	</form>
</nav>
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
	_cmdBuscar = $('#cmdBuscar');

	_cmbFiltro.on('change', function(){
		_txtBuscar.focus();
	});

	_cmdBuscar.on('click', function(e){
		e.preventDefault();
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

	APP.Entities.Usuario.RellenarTabla(_tblBuscar);

	_tblBuscar.table({
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