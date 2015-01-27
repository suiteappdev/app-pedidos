<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area" id="msgAreaPedido">
</div>

<nav class="navbar navbar-inverse " role="navigation">
	<div class="colset-5">
		<select id="cmbFiltro"  class="select-block" data-style="btn-success" style="width:160px; display:inline-block;margin-top: 10px;margin-left: 5px;">
			<option value="0">Cliente</option>
			<option value="1">Vendedor</option>
		</select>		
	</div>
	<div class="colset-5" >
		<select id="cmbFiltroEstado"  class="select-block" data-style="btn-success" style="width:180px; display:inline-block;margin-top: 10px;margin-left: 5px;">
		</select>		
	</div>	
	<div class="colset-5">
		<div class="colset-1 form-element-margin" style="padding:10px;">
			<input type="text" value="" id="dtpFechaInicial" placeholder="Fecha Inicial" class="form-control datepicker">
		</div>		
	</div>
	<div class="colset-5">
		<div class="colset-1 form-element-margin" style="padding:10px;">
			<input type="text" value="" id="dtpFechaFinal" placeholder="Fecha Final" class="form-control datepicker">
		</div>		
	</div>
	<div class="colset-5">
		<div class="colset-1" style="padding:10px;">
		    <div class="input-group">
		      <input type="text" id="txtCriteria" class="form-control">
		      <span class="input-group-btn">
		        <button class="btn btn-default icon-search" id="cmdBuscar" type="button"></button>
		      </span>
		    </div>
		</div>
	</div>
</nav>
<div class="colset-1">
	<div class="data-area">
		<table class="datatable" id="tblPedidos" style="margin-top:-28px;">
			<thead>
				<tr>
					<td><span class="icon-user"> </span>CLIENTE</td>
					<td><span class="icon-stack"> </span>UNIDADES</td>
					<td><span class="icon-coin"> </span>TOTAL</td>
					<td><span class=" icon-calendar2"> </span>FECHA PEDIDO</td>
					<td><span class="icon-user4"> </span>VENDEDOR</td>
					<td><span class="icon-eye2"> </span>LOCALIZACION</td>
					<td><span class="icon-thumbs-up"> </span>ESTADO</td>
					<td><span class="icon-signup"> </span>DETALLE</td>
					<td><span class="icon-download"> </span>DESCARGAR</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(function(){
	_tblPedidos = $('#tblPedidos');
	_cmbFiltro = $('#cmbFiltro');
	_cmbFiltroEstado = $('#cmbFiltroEstado');
	_dtpFechaIni = $('#dtpFechaInicial');
	_dtpFechaFi = $('#dtpFechaFinal');
	_cmdBuscar = $('#cmdBuscar');
	_txtCriteria = $('#txtCriteria');
	_msgarea = $('#msgAreaPedido')

	_cmdBuscar.on('click', function(){
		APP.Entities.Pedido.Buscar().success(function(_data){
			if(_data.length == 0){
				_tblPedidos.find('tbody').empty();
				_msgarea.notification({message:'No se produjo ningun resultado', msgtype:'warning', closable:true});
				return;
			}

			_tblPedidos.find('tbody').empty();
			$.each(_data, function(key, val){
				_newRow = $('<tr data-id="'+val.idpedido+'"><td>'+val.nombrecompleto+'</td><td>'+val.tunidades+'</td><td>'+accounting.format(val.total)+'</td><td>'+val.fechapedido+'</td><td>'+val.vendedor+'</td><td>'+val.geolocalizacion+'</td><td><a href="#" class="lnkActualizarEstado">'+val.descripcion+'</a></td><td><a href="#" id="ver">Ver...</a></td><td><a href="#" id="descargar"><span class="icon-file-pdf"></span></a></td></tr>');
				
				_newRow.find('#ver').on('click', function(){
					APP.Entities.Pedido.MostrarDetalle($(this).parent().parent().data('id'));
				});

				_newRow.find('#descargar').on('click', function(){
					_form = $('<form target="_blank" name="frm-pdf" method="POST" action='+BASE_PATH + 'pedido/pedidoPDF'+' ></form>');
					_form.append('<input type="text" name="idpedido" value='+$(this).parent().parent().data('id')+'>');
					_form.append('<input type="submit" value="1">');
					_form.trigger('submit');
				});

				_newRow.find('.lnkActualizarEstado').on('click', function(){
					APP.Entities.Pedido.ActualizarEstadoPedido($(this).parent().parent().data('id'));
				});

				_tblPedidos.find('tbody .cmbEstadoGrid').on('change', function(){
					APP.Entities.Pedido.ActualizarEstadoPedido({
							pedido:$(this).parent().parent().data('id'),
							estado:$(this).val()
						}).success(function(data){
							if(data.success){
				        		_msgarea.notification({message:data.success, msgtype:'success', closable:true});
							}else{
				        		_msgarea.notification({message:data.error, msgtype:'error', closable:true});
							}
						});
				});

				_tblPedidos.find('tbody').append(_newRow);
			});

			_tblPedidos.find('tbody .cmbEstadoGrid').off();

		});
	});

	_txtCriteria.on('keyup', function(e){
		if(e.keyCode == 13){
			_cmdBuscar.trigger('click');
		}
	})

	_tblPedidos.fixheader();

	APP.Entities.EstadoPedido.RellenarCombo(_cmbFiltroEstado);
	_cmbFiltro.selectpicker();
	_dtpFechaIni.datepicker({dateFormat:'yy-mm-dd'});
	_dtpFechaFi.datepicker({dateFormat:'yy-mm-dd'});
	_cmbFiltroEstado.selectpicker();

	_tblPedidos.table({
		action:function(e){
		},

		UpDownArrow:function(e){
		}
	});
});
</script>