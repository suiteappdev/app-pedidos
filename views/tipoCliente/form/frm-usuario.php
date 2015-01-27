<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area">
</div>
<div class="colset-2 form-element-margin">
	<select id="cmbUsuarioTipoCliente" class="select-block" data-style="darkYellow" style="z-index:9;">
	</select>	
</div>
<div class="colset-2 form-element-margin">
	<select id="cmbUsuarioEstado" class="select-block" data-style="darkYellow" style="z-index:8;">
	</select>
</div>
<div class="colset-2 form-element-margin">
	<select id="cmbUsuarioTipoIdentificacion" class="select-block" data-style="darkYellow" style="z-index:7;">
	</select>
</div>
	<div class="colset-2 form-element-margin">
		<input type="text" value="" id="txtUsuarioIdentificacion" placeholder="identificacion" class="form-control" style="z-index:99999;">
	</div>
	<div class="colset-1 form-element-margin">
		<input type="text" value="" id="txtUsuarioNombre" placeholder="nombre" class="form-control">
	</div>
	<div class="colset-1 form-element-margin">
		<input type="text" value="" id="txtUsuarioApellido" placeholder="apellidos" class="form-control">
	</div>
	<div class="colset-1 form-element-margin">
		<input type="text" value="" id="txtUsuarioUsuario" placeholder="usuario" class="animated fadeInLeft form-control">
	</div>
	<div class="colset-1 form-element-margin">
		<input type="password" value="" id="txtUsuarioPassword" placeholder="contraseña" class="animated fadeInLeft form-control">
	</div>
	<div class="colset-2">
		<select id="cmbUsuarioDepartamento" class="select-block" data-style="darkYellow" style="z-index:9;">
		</select>
	</div>
	<div class="colset-2">
		<select id="cmbUsuarioCiudad" class="select-block" data-style="darkYellow" style="z-index:9;">
		</select>
	</div>
<div class="colset-1 form-element-margin">
	<input type="text" value="" id="txtUsuarioDireccion" placeholder="direccion" class="form-control">
</div>
<div class="colset-3 form-element-margin">
	<input type="text" value="" id="txtUsuarioTelefono1" placeholder="telefono 1" class="form-control">	
</div>
<div class="colset-3 form-element-margin">
	<input type="text" value="" id="txtUsuarioTelefono2" placeholder="telefono 2" class="form-control">
</div>
<div class="colset-3 form-element-margin">
	<input type="text" value="" id="txtUsuarioTelefono3" placeholder="telefono 3" class="form-control">
</div>
<div class="colset-1">
	<input type="text" value="" id="txtUsuarioCorreo" placeholder="correo" class="form-control">
</div>
<div class="colset-1" id="dtoArea" style="display:none;">
	<table class="datatable">
		<thead>
			<tr>
				<td>% DESCUENTO 1</td>
				<td>% DESCUENTO 2</td>
				<td>% DESCUENTO 3</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<input id="txtdto1" value="0" style="width:100%;" type="text" class="form-control letters">
				</td>
				<td>
					<input id="txtdto2" value="0" style="width:100%;" type="text" class="form-control letters">
				</td>
				<td>
					<input id="txtdto3" value="0" style="width:100%;" type="text" class="form-control letters">
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script type="text/javascript">
$(function(){
	_cmbUsuarioTipoCliente = $('#cmbUsuarioTipoCliente');
	_cmbUsuarioTipoIdentificacion = $('#cmbUsuarioTipoIdentificacion');
	_cmbUsuarioEstado = $('#cmbUsuarioEstado');
	_cmbUsuarioDepartamento = $('#cmbUsuarioDepartamento');
	_cmbUsuarioCiudad = $('#cmbUsuarioCiudad');
	_txtUsuarioUsuario = $('#txtUsuarioUsuario');
	_txtUsuarioPassword = $('#txtUsuarioPassword');
	_dtoArea = $('#dtoArea');

	_cmbUsuarioTipoCliente.on('change', function(){
		if($(this).val() == 3){
			_txtUsuarioUsuario.show();
			_txtUsuarioPassword.show();
			_dtoArea.hide();
			return;
		}else if($(this).val() == 2){
			_txtUsuarioUsuario.hide();
			_txtUsuarioPassword.hide();
			_dtoArea.show();
		}else if($(this).val() == 4){
			_txtUsuarioUsuario.show();
			_txtUsuarioPassword.show();
			_dtoArea.hide();
		}
	});

	_cmbUsuarioDepartamento.on('change', function(){
		APP.Entities.Ciudad.listaDeCiudades({iddepartamento:$(this).val()}).success(function(res){
			_cmbUsuarioCiudad.empty();
			$.each(res, function(key, val){
				_cmbUsuarioCiudad.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
			});
		});
	});

	APP.Entities.tipoCliente.RellenarCombo(_cmbUsuarioTipoCliente);
	APP.Entities.tipoIdentificacion.RellenarCombo(_cmbUsuarioTipoIdentificacion);
	APP.Entities.EstadoCliente.RellenarCombo(_cmbUsuarioEstado);
	APP.Entities.Departamento.RellenarCombo(_cmbUsuarioDepartamento);

	_cmbUsuarioTipoCliente.selectpicker({size:200});
	_cmbUsuarioEstado.selectpicker({size:200});
	_cmbUsuarioTipoIdentificacion.selectpicker({size:200});
	_cmbUsuarioCiudad.selectpicker({size:200});
	_cmbUsuarioDepartamento.selectpicker({size:200});

	/*_tblTipoCliente = $('#tblTipoCliente');
	_txtTipoCliente = $('#txtTipoCliente');

	APP.Entities.tipoCliente.RellenarTabla(_tblTipoCliente);

	new APP.util.table(_tblTipoCliente, {
		action:function(e){
			_txtTipoCliente.val($($(e.target).find('td')[1]).text());

		},

		UpDownArrow:function(e){
			_txtTipoCliente.val($($(e).find('td')[1]).text());
		}

	});*/
});
</script>