<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="colset-1 message-msg-area" id="msgAreaProducto">
</div>
<div class="colset-3">
	<div class="colset-1 form-element-margin">
		<input type="text" value="" id="txtProductoDescripcion" placeholder="descripcion" class="form-control alpha" style="z-index:99999;">
	</div>
	<div class="colset-1 form-element-margin">
		<select id="cmbEstado"  class="select-block" data-style="darkYellow" style="width:100%; display:inline-block;">
		</select>
	</div>
	<div class="colset-1 form-element-margin">
		<input type="text" value="" id="txtProductoEmbalaje" placeholder="embalaje" class="form-control number">
	</div>
</div>
<div class="colset-3">
		<div class="colset-1 form-element-margin">
			<div class="colset-2" style="text-align:center;">
				<label>Familia 1</label>
			</div>
			<div class="colset-2">
				<select id="cmbFamilia1"  class="select-block" data-style="darkYellow" style="width:100%; display:inline-block;">
				</select>
			</div>
		</div>
		<div class="colset-1 form-element-margin">
			<div class="colset-2" style="text-align:center;">
				<label>Familia 2</label>
			</div>
			<div class="colset-2">
				<select id="cmbFamilia2"  class="select-block" data-style="darkYellow" style="width:100%; display:inline-block;">
				</select>
			</div>
		</div>
		<div class="colset-1 form-element-margin">
			<div class="colset-2" style="text-align:center;">
				<label>Familia 3</label>
			</div>
			<div class="colset-2">
				<select id="cmbFamilia3"  class="select-block" data-style="darkYellow" style="width:100%; display:inline-block;">
				</select>
			</div>
		</div>
</div>
<div class="colset-3">
		<div class="colset-1 form-element-margin">
			<div class="colset-2" style="text-align:center;">
				<label>Familia 4</label>
			</div>
			<div class="colset-2">
				<select id="cmbFamilia4"  class="select-block" data-style="darkYellow" style="width:100%; display:inline-block;">
				</select>
			</div>
		</div>
		<div class="colset-1 form-element-margin">
			<div class="colset-2" style="text-align:center;">
				<label>Familia 5</label>
			</div>
			<div class="colset-2">
				<select id="cmbFamilia5"  class="select-block" data-style="darkYellow" style="width:100%; display:inline-block;">
				</select>
			</div>
		</div>

</div>
<div class="colset-1">
	<div class="data-area">
		<table class="datatable" id="tblPrecios" style="margin-top:-28px;">
			<thead>
				<tr>
					<td>LINEA</td>
					<td>PRECIO BASE</td>
					<td>% DESCUENTO</td>
					<td>% DESCUENTO</td>
					<td>% DESCUENTO</td>
					<td>% IVA</td>
					<td>SUBTOTAL</td>
					<td>% UTILIDAD</td>
					<td>UTILIDAD TOTAL</td>
					<td>PRECIO VENTA</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<div class="colset-1">
	<table class="datatable" style="margin-top:-28px;">
		<thead>
			<tr>
				<td>REFERENCIA 1</td>
				<td>REFERENCIA 2</td>
				<td>REFERENCIA 3</td>
				<td>REFERENCIA 4</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<input id="txtReferencia1" style="width:100%;" type="text" class="form-control letters">
				</td>
				<td>
					<input id="txtReferencia2" style="width:100%;" type="text" class="form-control letters">
				</td>
				<td>
					<input id="txtReferencia3" style="width:100%;" type="text" class="form-control letters">
				</td>
				<td>
					<input id="txtReferencia4" style="width:100%;" type="text" class="form-control letters">
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="colset-1">
	<div class="colset-2">
		<a href="undefined"><span class="icon-image2 imgpreview"></span></a>
	</div>
	<div class="colset-2">
		<div class="colset-1 form-element-margin">
			<div class="custom-file-upload">
			    <input type="file" id="fileImage" name="myfiles[]" accept="image/x-png, image/gif, image/jpeg, image/jpg">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	_msgarea = $('#msgAreaProducto');
	_tblPrecios = $('#tblPrecios');
	_cmdBuscar = $('#cmdBuscar');
	_cmdFile = $('#fileImage');
	_cmbEstado = $('#cmbEstado');
	_cmbFamilia1 = $('#cmbFamilia1');
	_cmbFamilia2 = $('#cmbFamilia2');
	_cmbFamilia3 = $('#cmbFamilia3');
	_cmbFamilia4 = $('#cmbFamilia4');
	_cmbFamilia5 = $('#cmbFamilia5');
	_imgProducto = $('.imgpreview');

	_cmdFile.on('change', function(){
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;

        if (/^image/.test( files[0].type)){
            var reader = new FileReader(); 
            reader.readAsDataURL(files[0]); 

            reader.onloadend = function(){
                _imgProducto.data('imgsrc', this.result);
            }
        }
	});

	_imgProducto.on('click', function(e){
		e.preventDefault();
		
		img = $(this).data('imgsrc');

		if(!img){
			_msgarea.notification({message: 'no ha seleccionado una imagen', msgtype:'error', closable:true});
			return;
		}

        var imgpreview = new BootstrapDialog({
            title: 'Vista Previa',
            draggable : true,
            message: '<img style="width: 30%;height: auto;margin: 0 auto;" src="'+img+'">',
        	buttons : [{
        		label:'cerrar',
        		cssClass:'btn-warning',
        		action:function(dlg){
        			dlg.close();
        		}
        	}]
        });

		imgpreview.realize();
		imgpreview.getModalHeader().css('background-image', 'url(public/images/pattern.jpg)');
		imgpreview.getModalBody().css('padding', '1px');
		imgpreview.getModalBody().css('background-image', 'url(public/images/pattern.jpg)');
		imgpreview.getModalFooter().css('margin-top', '0px');
		imgpreview.getModalFooter().css('border-top', '0px');
		imgpreview.getModalFooter().css('padding', '10px 10px 10px');
		imgpreview.setTitle('Imagen del producto');
		imgpreview.open();
	});
	
	_cmdFile.customFile();
	_cmbFamilia1.selectpicker({ noneSelectedText:'sin categoria' });
	_cmbFamilia2.selectpicker({ noneSelectedText:'sin categoria' });
	_cmbFamilia3.selectpicker({ noneSelectedText:'sin categoria' });
	_cmbFamilia4.selectpicker({ noneSelectedText:'sin categoria' });
	_cmbFamilia5.selectpicker({ noneSelectedText:'sin categoria' });

	APP.Entities.Producto.RellenarTablaPrecio(_tblPrecios);
	_tblPrecios.table({
		action:function(e){
			//_txtLineaPrecio.val($($(e.target).find('td')[1]).text());
		},

		UpDownArrow:function(e){
			//_txtLineaPrecio.val($($(e).find('td')[1]).text());
		}

	});


	_cmbFamilia1.on('change', function(){
		APP.Entities.Familia2.listaDeFamilia2({idfamilia:$(this).val()}).success(function(res){
			_cmbFamilia2.empty();
			$.each(res, function(key, val){
				_cmbFamilia2.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
			})
		});
	});

	_cmbFamilia2.on('change', function(){
		APP.Entities.Familia3.listaDeFamilia3({idfamilia:$(this).val()}).success(function(res){
			_cmbFamilia3.empty();
			$.each(res, function(key, val){
				_cmbFamilia3.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
			})
		});
	});

	_cmbFamilia3.on('change', function(){
		APP.Entities.Familia4.listaDeFamilia4({idfamilia:$(this).val()}).success(function(res){
			_cmbFamilia4.empty();
			$.each(res, function(key, val){
				_cmbFamilia4.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
			})
		});
	});

	_cmbFamilia4.on('change', function(){
		APP.Entities.Familia5.listaDeFamilia5({idfamilia:$(this).val()}).success(function(res){
			_cmbFamilia5.empty();
			$.each(res, function(key, val){
				_cmbFamilia5.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
			})
		});
	});

	APP.Entities.Familia1.RellenarCombo(_cmbFamilia1);
	APP.Entities.EstadoProductos.RellenarCombo(_cmbEstado);

	_cmbEstado.selectpicker();

	_cmdBuscar.on('click', function(){
		APP.Entities.Referencia.Mostrar();
	});

});
</script>