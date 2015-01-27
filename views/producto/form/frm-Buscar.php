<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area" id="msgArea">
</div>
<nav class="navbar navbar-inverse navbar-embossed" role="navigation">
	<select id="cmbFiltro"  class="select-block" data-style="btn-success" style="width:150px; display:inline-block;margin-top: 10px;margin-left: 5px;">
		<option value="descripcion">Descripcion</option>
		<option value="referencia">Referencia</option>
	</select>
	<form class="navbar-form navbar-right" action="#" role="search">
		<div class="form-group">
				  <div class="input-group">
				    <input class="form-control" id="txtBuscar" type="search" placeholder="Buscar Producto">
				    <span class="input-group-btn">
				      <button type="button" id="cmdBuscar" class="btn"><span class="fui-search"></span></button>
				    </span>
				  </div>
			</div>
	</form>
</nav>
<div class="data-area">
	<table class="datatable" id="tblBuscar" style="margin-top:-28px;">
		<thead>
			<tr>
				<td><span class="icon-key2"> </span>DESCRIPCION</td>
				<td><span class="icon-user"> </span>EMBALAJE</td>
				<td><span class="icon-user"> </span>FAMILIA 1</td>
				<td><span class="icon-user"> </span>FAMILIA 2</td>
				<td><span class="icon-user"> </span>FAMILIA 3</td>
				<td><span class="icon-user"> </span>FAMILIA 4</td>
				<td><span class="icon-user"> </span>FAMILIA 5</td>
				<td><span class="icon-office"> </span>ESTADO</td>
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
	_msgarea = $('#msgArea');

	_cmdBuscar.on('change', function(){
		_txtBuscar.focus();
	})

	_cmdBuscar.on('click', function(e){
		APP.Entities.Producto.BuscarProducto({
			col:_cmbFiltro.val(),
			val:_txtBuscar.val()
		}).success(function(_data){
			if(_data.length == 0){
				_tblBuscar.find('tbody').empty();
				_msgarea.notification({message:'No se produjo ningun resultado', msgtype:'warning', closable:true});
				return;
			}

			_tblBuscar.find('tbody').empty();
			$.each(_data, function(key, val){
				_newRow = $('<tr data-id="'+val.id+'"><td>'+val.descripcion+'</td><td>'+val.embalaje+'</td><td>'+val.familia1+'</td><td>'+val.familia2+'</td><td>'+val.familia3+'</td><td>'+val.familia4+'</td><td>'+val.familia5+'</td><td>'+val.estado+'</td></tr>');
				_newRow.data('object', val);
				
				_tblBuscar.find('tbody').append(_newRow);
			});
		});
	});

	_tblBuscar.fixheader();
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