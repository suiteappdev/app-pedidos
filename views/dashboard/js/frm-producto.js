$(function(){
	APP.Entities.Producto = {};
	APP.Entities.Producto = {
		Mostrar:function(){
			APP.View.load('producto', 'producto/form/frm-producto').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-producto',
		        	onhide:function(){
		        		delete _values;
		        	},
		        	message:_html,
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin();

		                    if(APP.validateForm('.form')){
			                    APP.Entities.Producto.Guardar().success(function(res){
			                    	if(res.success){
			                    	APP.Entities.Producto.LimpiarCampos();
			                    		$('.message-msg-area').notification({message:res.success, msgtype:'success', closable:true});
										$button.stopSpin();
										
			                    	}else if(res.error){
										$button.stopSpin();
			                    		$('.message-msg-area').notification({message:res.error, msgtype:'error', closable:true});
			                    	}
			                    });		                    	
		                    }else{
		                    	$button.stopSpin();
			                    $('.message-msg-area').notification({message:'algunos campos son incorrectos', msgtype:'error', closable:true});
		                    }
		                }
		            },{
		            	icon:'glyphicon glyphicon-search',
		            	label:'[F2]-Buscar',
		            	hotkey:113,
		            	cssClass:'btn-primary',
		            	action:function(){
		            		APP.View.load('producto', 'producto/form/frm-Buscar').success(function(_html){
								var searchDialog = new BootstrapDialog({
									message : _html,
									cssClass :'frm-productoBuscar',
									onhide:function(){
										try{
											if(_values){
												APP.Entities.Producto.ObtenerReferencias({
													idproducto:_values.id
												}).success(function(res){
													try{
														$('#txtReferencia1').val(res[0].referencia);
														$('#txtReferencia1').data('id', res[0].id);
														$('#txtReferencia2').val(res[1].referencia);
														$('#txtReferencia2').data('id', res[1].id);
														$('#txtReferencia3').val(res[2].referencia);
														$('#txtReferencia3').data('id', res[2].id);
														$('#txtReferencia4').val(res[3].referencia);
														$('#txtReferencia4').data('id', res[3].id);														
													}catch(e){

													}
												});

												APP.Entities.Producto.ObtenerPrecios({
													idproducto:_values.id
												}).success(function(res){
													$.each(res, function(key, val){
														$($('#tblPrecios tbody tr')[key]).find('.txtBase').val(val.precioneto);
														$($('#tblPrecios tbody tr')[key]).find('.txtUtilidad').val(val.utilidad);
														$($('#tblPrecios tbody tr')[key]).find('.txtSubTotal').val(accounting.formatMoney(val.subtotal));
														$($('#tblPrecios tbody tr')[key]).find('.txtUtilidad').val(val.utilidad);
														$($('#tblPrecios tbody tr')[key]).find('.txtUtilidadTotal').val(accounting.formatMoney(val.totalutilidad));
														$($('#tblPrecios tbody tr')[key]).find('.txtPrecioVenta').val(accounting.formatMoney(val.precioventa));															
														$($('#tblPrecios tbody tr')[key]).find('#cmbImpuesto').selectpicker('val', val.iva);															
													});
												});
											}											
										}catch(e){

										}
									},
									buttons :[{
										label:'[ENTER]-Usar',
										hotkey:13,
										cssClass:'btn-primary',
										action:function(dlg){
						                	_values = dlg.$modalContent.find('.selectedRow').data('object');
						                	
						                	if(!_values){
						                		dlg.$modalContent.find('.message-msg-area').notification({message:'debe seleccionar un producto', msgtype:'warning', closable:true});
			                    				return;
						                	}
											
											$('.imgpreview').data('imgsrc', _values.urlimg);
											$('#txtProductoDescripcion').val(_values.descripcion);
											$('#txtProductoEmbalaje').val(_values.embalaje);
											$('#cmbEstado').selectpicker('val', _values.idestado);
											$('#cmbFamilia1').selectpicker('val', _values.idfamilia1);
											$('#cmbFamilia2').selectpicker('val', _values.idfamilia2);
											$('#cmbFamilia3').selectpicker('val', _values.idfamilia3);
											$('#cmbFamilia4').selectpicker('val', _values.idfamilia4);
											$('#cmbFamilia5').selectpicker('val', _values.idfamilia5);
											dlg.close();
										}
									},{
										label:'Cerrar',
										cssClass:'btn-warning',
										action:function(dialog){
											dialog.close();
										}
									}]
								});

								searchDialog.realize();
								searchDialog.getModalHeader().css('background-image', 'url(public/images/pattern.jpg)');
								searchDialog.getModalBody().css('padding', '1px');
								searchDialog.getModalBody().css('background-image', 'url(public/images/pattern.jpg)');
								searchDialog.getModalFooter().css('margin-top', '0px');
								searchDialog.getModalFooter().css('border-top', '0px');
								searchDialog.getModalFooter().css('padding', '10px 10px 10px');
								searchDialog.setTitle('Buscar Productos');
								searchDialog.open();
		            		});

		            	}
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

							APP.Entities.Producto.Actualizar().success(function(){
								$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
								$($('#tblUsuarioZona .selectedRow td')[1]).text($('#cmbUsuario').val());
								$($('#tblUsuarioZona .selectedRow td')[2]).text($('#cmbZona :selected').text());
								$($('#tblUsuarioZona .selectedRow td')[3]).text($('#cmbLineaPrecio :selected').text());
							});
		                }
		            }
		            ],
		            draggable: true,
		        });
				
				dialog.realize();
				dialog.getModalHeader().css('background-image', 'url(public/images/pattern.jpg)');
				dialog.getModalBody().css('padding', '1px');
				dialog.getModalBody().css('background-image', 'url(public/images/pattern.jpg)');
				dialog.getModalFooter().css('margin-top', '0px');
				dialog.getModalFooter().css('border-top', '0px');
				dialog.getModalFooter().css('padding', '10px 10px 10px');
				dialog.setTitle('Productos');
				dialog.open();
			});			
		},

		Actualizar:function(){
			form = new FormData();
			listaDeProductosPrecios = [];
			ListaReferencias = [];
			form.append('Idproducto', _values.id);
			form.append('Descripcion', $('#txtProductoDescripcion').val());
			form.append('Estado', $('#cmbEstado').val());
			form.append('Embalaje', $('#txtProductoEmbalaje').val());
			form.append('Familia1', $('#cmbFamilia1').val());
			form.append('Familia2', $('#cmbFamilia2').val());
			form.append('Familia3', $('#cmbFamilia3').val());
			form.append('Familia4', $('#cmbFamilia4').val());
			form.append('Familia5', $('#cmbFamilia5').val());
			
			$('#tblPrecios').find('tbody tr').each(function(key, val){
				objProductoPrecios = new Object();
				objProductoPrecios.LineaPrecio = $(val).data('idlinea');
				objProductoPrecios.Base = accounting.unformat($(val).find('.txtBase').val());
				objProductoPrecios.Iva = $(val).find('.cmbImpuesto').val();
				objProductoPrecios.UtilidadTotal = accounting.unformat($(val).find('.txtUtilidadTotal').val());
				objProductoPrecios.Utilidad = $(val).find('.txtUtilidad').val();
				objProductoPrecios.PrecioVenta = accounting.unformat($(val).find('.txtPrecioVenta').val());
				objProductoPrecios.idproducto = _values.id;
				objProductoPrecios.Descuento1 = $(val).find('.txtDto1').val();
				objProductoPrecios.Descuento2 = $(val).find('.txtDto2').val();
				objProductoPrecios.Descuento3 = $(val).find('.txtDto3').val();
				objProductoPrecios.Subtotal = accounting.unformat($(val).find('.txtSubTotal').val());
				listaDeProductosPrecios.push(objProductoPrecios);
			});

			ListaReferencias.push({
				'Referencia' : $('#txtReferencia1').val(),
				'id' : $('#txtReferencia1').data('id')
			});

			ListaReferencias.push({
				'Referencia' : $('#txtReferencia2').val(),
				'id' : $('#txtReferencia2').data('id')
			});

			ListaReferencias.push({
				'Referencia' : $('#txtReferencia3').val(),
				'id' : $('#txtReferencia3').data('id')
			});

			ListaReferencias.push({
				'Referencia' : $('#txtReferencia4').val(),
				'id' : $('#txtReferencia4').data('id')
			});

			form.append('ProductoPrecio', JSON.stringify(listaDeProductosPrecios));
			form.append('ListaReferencias', JSON.stringify(ListaReferencias));
			form.append('Image', $('#fileImage').get(0).files[0]);
			
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'producto/actualizarProducto',
				mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
				data:form,
				dataType:'JSON'
			});
		},

		Guardar: function(){
			form = new FormData();
			listaDeProductosPrecios = [];
			ListaReferencias = [];

			form.append('Descripcion', $('#txtProductoDescripcion').val());
			form.append('Estado', $('#cmbEstado').val());
			form.append('Embalaje', $('#txtProductoEmbalaje').val());
			form.append('Familia1', $('#cmbFamilia1').val() == null ? 1 : $('#cmbFamilia1').val());
			form.append('Familia2', $('#cmbFamilia2').val() == null ? 1 : $('#cmbFamilia2').val());
			form.append('Familia3', $('#cmbFamilia3').val() == null ? 1 : $('#cmbFamilia3').val());
			form.append('Familia4', $('#cmbFamilia4').val() == null ? 1 : $('#cmbFamilia4').val());
			form.append('Familia5', $('#cmbFamilia5').val() == null ? 1 : $('#cmbFamilia5').val());
			
			$('#tblPrecios').find('tbody tr').each(function(key, val){
				objProductoPrecios = new Object();
				objProductoPrecios.LineaPrecio = $(val).data('idlinea');
				objProductoPrecios.Base = accounting.unformat($(val).find('.txtBase').val());
				objProductoPrecios.Iva = $(val).find('.cmbImpuesto').val();
				objProductoPrecios.UtilidadTotal = accounting.unformat($(val).find('.txtUtilidadTotal').val());
				objProductoPrecios.Utilidad = $(val).find('.txtUtilidad').val();
				objProductoPrecios.Subtotal = accounting.unformat($(val).find('.txtSubTotal').val());
				objProductoPrecios.PrecioVenta = $(val).find('.txtPrecioVenta').val();
				objProductoPrecios.Descuento1 = $(val).find('.txtDto1').val();
				objProductoPrecios.Descuento2 = $(val).find('.txtDto2').val();
				objProductoPrecios.Descuento3 = $(val).find('.txtDto3').val();

				listaDeProductosPrecios.push(objProductoPrecios);
			});

			ListaReferencias.push({
				'Referencia' : $('#txtReferencia1').val()
			});

			ListaReferencias.push({
				'Referencia' : $('#txtReferencia2').val()
			});

			ListaReferencias.push({
				'Referencia' : $('#txtReferencia3').val()
			});

			ListaReferencias.push({
				'Referencia' : $('#txtReferencia4').val()
			});


			form.append('ProductoPrecio', JSON.stringify(listaDeProductosPrecios));
			form.append('ListaReferencias', JSON.stringify(ListaReferencias));
			form.append('Image', $('#fileImage').get(0).files[0]);

			return $.ajax({
				type:'POST',
				url:BASE_PATH +'producto/crearProducto',
				mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
				data:form,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'producto/borrarusuariozona',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeProductos : function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'producto/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.Producto.listaDeProductos().success(function(res){
				$.each(res, function(key, val){
					_newRow = $('<tr data-id="'+val.id+'"><td>'+val.descripcion+'</td><td>'+val.embalaje+'</td><td>'+val.familia1+'</td><td>'+val.familia2+'</td><td>'+val.familia3+'</td><td>'+val.familia4+'</td><td>'+val.familia5+'</td><td>'+val.estado+'</td></tr>');
					_newRow.data('object', val);
					$(tbl).append(_newRow);
				});

				APP.util.fixheader(tbl);
			});
		},

		RellenarCombo : function(cmb){
			APP.Entities.UsuarioZona.listaDeUsuarioZonas().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		},

		RellenarTablaPrecio :function(tbl){
			_cmbInpuesto = $('<select class="select-block" data-style="darkYellow" style="width:100%; display:inline-block;"></select>');
			_patternNumber = new RegExp('^[0-9 ]*$');
			APP.Entities.LineaPrecio.listaDeLineaPrecios().success(function(res){
				$.each(res, function(key, val){
					_newRow = $('<tr data-idlinea="'+val.id+'"><td style="width:auto;">'+val.descripcion+'</td><td><input  style="width:100%;" type="text" value="0" class="txtBase form-control letters"></td><td><input  style="width:100%;" type="text" value="0" class="txtDto1 form-control letters"></td><td><input  style="width:100%;" type="text" value="0" class="txtDto2 form-control letters"></td><td><input  style="width:100%;" type="text" value="0" class="txtDto3 form-control letters"></td><td style="padding-top:5px;"><select  class="cmbImpuesto select-block" data-style="darkYellow" style="width:60px;; display:inline-block;"></select></td><td><input  style="width:100%;" type="text" value="0" class="txtSubTotal form-control letters" readonly></td><td><input  style="width:100%;" type="text" value="0" class="txtUtilidad form-control letters"></td><td><input style="width:100%;" type="text" value="0" class="txtUtilidadTotal form-control" readonly></td><td><input style="width:100%;"  type="text" value="0" class="txtPrecioVenta form-control" readonly></td></tr>');
					_newRow.find('.txtBase').on('keyup', function(){
						if(!_patternNumber.test($(this).val())){
							return;
						}
							_Impuesto = parseInt($(this).parent().parent().find('.cmbImpuesto').val());
							_txtBase = parseInt($(this).parent().parent().find('.txtBase').val());
							_txtDt1 = parseInt($(this).parent().parent().find('.txtDto1').val());
							_txtDt2 = parseInt($(this).parent().parent().find('.txtDto2').val());
							_txtDt3 = parseInt($(this).parent().parent().find('.txtDto3').val());
							
							_txtSubtotal = $(this).parent().parent().find('.txtSubTotal');


							_baseDto1 = _txtBase   * _txtDt1 / 100;
							_baseDto2 = (_txtBase -_baseDto1)  * _txtDt2 / 100; 
							_baseDto3 = (_txtBase -_baseDto1 - _baseDto2)  * _txtDt3 / 100;  

							_txtSubtotal.val(isNaN(_txtBase -(_baseDto1 + _baseDto2 + _baseDto3)) ? 0 : _txtBase -(_baseDto1 + _baseDto2 + _baseDto3));


						/*_precioVenta = $(this).parent().parent().find('.txtPrecioVenta');
						_txtSubtotal = parseInt($(this).parent().parent().find('.txtSubTotal'));
						_txtUtilidadTotal = $(this).parent().parent().find('.txtUtilidadTotal');
						_precioVenta = $(this).parent().parent().find('.txtPrecioVenta');*/
					});

					_newRow.find('.cmbImpuesto').on('change', function(){
							_txtBase = parseInt($(this).parent().parent().find('.txtBase').val() == ''? 0 :$(this).parent().parent().find('.txtBase').val());
							_txtDt1 = parseInt($(this).parent().parent().find('.txtDto1').val() == '' ? 0 :$(this).parent().parent().find('.txtDto1').val());
							_txtDt2 = parseInt($(this).parent().parent().find('.txtDto2').val() == '' ? 0 :$(this).parent().parent().find('.txtDto2').val());
							_txtDt3 = parseInt($(this).parent().parent().find('.txtDto3').val() == '' ? 0 :$(this).parent().parent().find('.txtDto3').val());
							
							_utilidadTotal = $(this).parent().parent().find('.txtUtilidadTotal');
							_utilidad = $(this).parent().parent().find('.txtUtilidad');
							_precioVenta = $(this).parent().parent().find('.txtPrecioVenta');							
							_txtSubtotal = $(this).parent().parent().find('.txtSubTotal');
							
							_baseDto1 = _txtBase   * _txtDt1  / 100;
							_baseDto2 = (_txtBase -_baseDto1)  * _txtDt2  / 100; 
							_baseDto3 = (_txtBase -_baseDto1 - _baseDto2) * _txtDt3 / 100;  

							_subtotal =  isNaN(_txtBase -(_baseDto1 + _baseDto2 + _baseDto3))  ? 0:_txtBase -(_baseDto1 + _baseDto2 + _baseDto3);
							_subtotalIva = ((_subtotal * parseInt($(this).children(':selected').text())) / 100) + _subtotal;
							_txtSubtotal.val(_subtotalIva);
							_utilidadTotal.val((_subtotal * parseInt(_utilidad.val() == '' ? 0 : _utilidad.val()) / 100));
							_precioVenta.val(_subtotalIva);
					});

					_newRow.find('.txtDto1').on('keyup', function(){
						if(_patternNumber.test($(this).val())){
							if($(this).hasClass('error')){
								$(this).removeClass('error');
							}

							_Impuesto = $(this).parent().parent().find('.cmbImpuesto');
							_txtBase = parseInt($(this).parent().parent().find('.txtBase').val());
							_txtDt1 = $(this).val();
							_txtDt2 = parseInt($(this).parent().parent().find('.txtDto2').val() == '' ? 0 :$(this).parent().parent().find('.txtDto2').val());
							_txtDt3 = parseInt($(this).parent().parent().find('.txtDto3').val() == '' ? 0 :$(this).parent().parent().find('.txtDto3').val());
							_utilidadTotal = $(this).parent().parent().find('.txtUtilidadTotal');
							_utilidad = $(this).parent().parent().find('.txtUtilidad');
							_precioVenta = $(this).parent().parent().find('.txtPrecioVenta');							
							_txtSubtotal = $(this).parent().parent().find('.txtSubTotal');
							
							_baseDto1 = _txtBase   * _txtDt1  / 100;
							_baseDto2 = (_txtBase -_baseDto1)  * _txtDt2  / 100; 
							_baseDto3 = (_txtBase -_baseDto1 - _baseDto2) * _txtDt3 / 100;  

							_subtotal =  isNaN(_txtBase -(_baseDto1 + _baseDto2 + _baseDto3))  ? 0:_txtBase -(_baseDto1 + _baseDto2 + _baseDto3);
							_subtotalIva = ((_subtotal * parseInt(_Impuesto.children(':selected').text())) / 100) + _subtotal;
							_txtSubtotal.val(_subtotalIva);
							_utilidadTotal.val((_subtotal * parseInt(_utilidad.val() == '' ? 0 : _utilidad.val()) / 100));
							_precioVenta.val((_subtotal * parseInt(_utilidad.val() == '' ? 0 : _utilidad.val()) / 100) + _subtotal);
						
						}else{
							$(this).val(0);
						}
					});

					_newRow.find('.txtDto2').on('keyup', function(){
						if(_patternNumber.test($(this).val())){
							if($(this).hasClass('error')){
								$(this).removeClass('error');
							}
							
							_Impuesto = $(this).parent().parent().find('.cmbImpuesto');
							_txtBase = parseInt($(this).parent().parent().find('.txtBase').val());
							_txtDt1 = parseInt($(this).parent().parent().find('.txtDto1').val() == '' ? 0 : $(this).parent().parent().find('.txtDto1').val());
							_txtDt2 = $(this).val();
							_txtDt3 = parseInt($(this).parent().parent().find('.txtDto3').val() == '' ? 0 :$(this).parent().parent().find('.txtDto3').val());
							_utilidadTotal = $(this).parent().parent().find('.txtUtilidadTotal');
							_utilidad = $(this).parent().parent().find('.txtUtilidad');
							_precioVenta = $(this).parent().parent().find('.txtPrecioVenta');							
							_txtSubtotal = $(this).parent().parent().find('.txtSubTotal');
							
							_baseDto1 = _txtBase   * _txtDt1  / 100;
							_baseDto2 = (_txtBase -_baseDto1)  * _txtDt2  / 100; 
							_baseDto3 = (_txtBase -_baseDto1 - _baseDto2) * _txtDt3 / 100;  
							
							_subtotal =  isNaN(_txtBase -(_baseDto1 + _baseDto2 + _baseDto3))  ? 0:_txtBase -(_baseDto1 + _baseDto2 + _baseDto3);
							_subtotalIva = ((_subtotal * parseInt(_Impuesto.children(':selected').text())) / 100) + _subtotal;
							_txtSubtotal.val(_subtotalIva);
							_utilidadTotal.val((_subtotal * parseInt(_utilidad.val() == '' ? 0 : _utilidad.val()) / 100));
							_precioVenta.val((_subtotal * parseInt(_utilidad.val() == '' ? 0 : _utilidad.val()) / 100) + _subtotal);

						}else{
							$(this).val(0)
						}
					});

					_newRow.find('.txtDto3').on('keyup', function(){
						if(_patternNumber.test($(this).val())){
							if($(this).hasClass('error')){
								$(this).removeClass('error');
							}
							
							_Impuesto = $(this).parent().parent().find('.cmbImpuesto');
							_txtBase = parseInt($(this).parent().parent().find('.txtBase').val());
							_txtDt1 = parseInt($(this).parent().parent().find('.txtDto1').val() == '' ? 0 : $(this).parent().parent().find('.txtDto1').val());
							_txtDt2 = parseInt($(this).parent().parent().find('.txtDto2').val() == '' ? 0 : $(this).parent().parent().find('.txtDto2').val());
							_txtDt3 = $(this).val();
							_utilidadTotal = $(this).parent().parent().find('.txtUtilidadTotal');
							_utilidad = $(this).parent().parent().find('.txtUtilidad');
							_precioVenta = $(this).parent().parent().find('.txtPrecioVenta');							
							_txtSubtotal = $(this).parent().parent().find('.txtSubTotal');
							
							_baseDto1 = _txtBase   * _txtDt1  / 100;
							_baseDto2 = (_txtBase -_baseDto1)  * _txtDt2  / 100; 
							_baseDto3 = (_txtBase -_baseDto1 - _baseDto2) * _txtDt3 / 100;  
							
							_subtotal =  isNaN(_txtBase -(_baseDto1 + _baseDto2 + _baseDto3))  ? 0:_txtBase -(_baseDto1 + _baseDto2 + _baseDto3);
							_subtotalIva = ((_subtotal * parseInt(_Impuesto.children(':selected').text())) / 100) + _subtotal;
							_txtSubtotal.val(_subtotalIva);
							_utilidadTotal.val((_subtotal * parseInt(_utilidad.val() == '' ? 0 : _utilidad.val()) / 100));
							_precioVenta.val((_subtotal * parseInt(_utilidad.val() == '' ? 0 : _utilidad.val()) / 100) + _subtotal);

						}else{
							$(this).val(0);
						}
					});

					_newRow.find('.txtUtilidad').on('keyup', function(){
						if(!_patternNumber.test($(this).val())){
							return;
						}

							_Impuesto = $(this).parent().parent().find('.cmbImpuesto');
							_txtBase = parseInt($(this).parent().parent().find('.txtBase').val());
							_txtDt1 = parseInt($(this).parent().parent().find('.txtDto1').val() == '' ? 0 : $(this).parent().parent().find('.txtDto1').val());
							_txtDt2 = parseInt($(this).parent().parent().find('.txtDto2').val() == '' ? 0 : $(this).parent().parent().find('.txtDto2').val());
							_txtDt3 = parseInt($(this).parent().parent().find('.txtDto3').val() == '' ? 0 : $(this).parent().parent().find('.txtDto3').val());
							_utilidadTotal = $(this).parent().parent().find('.txtUtilidadTotal');
							_precioVenta = $(this).parent().parent().find('.txtPrecioVenta');							
							_txtSubtotal = $(this).parent().parent().find('.txtSubTotal');

							_baseDto1 = _txtBase   * _txtDt1  / 100;
							_baseDto2 = (_txtBase -_baseDto1)  * _txtDt2  / 100; 
							_baseDto3 = (_txtBase -_baseDto1 - _baseDto2) * _txtDt3 / 100;  

							_subtotal =  isNaN((_txtBase -(_baseDto1 + _baseDto2 + _baseDto3)) + parseInt(_Impuesto.children(':selected').text())) ? 0: _txtBase -(_baseDto1 + _baseDto2 + _baseDto3) + parseInt(_Impuesto.children(':selected').text());
							_utilidadTotal.val(isNaN((_subtotal * parseInt($(this).val()) / 100)) ? 0 : (_subtotal * parseInt($(this).val()) / 100));
							_precioVenta.val((_subtotal * parseInt(_utilidad.val() == '' ? 0 : _utilidad.val()) / 100) + _subtotal);
					});

					APP.Entities.Impuestos.RellenarCombo(_newRow.find('select').selectpicker());
					$(tbl).append(_newRow);
				});

				APP.util.fixheader(tbl);
			});

		},

		ObtenerReferencias : function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'producto/ObtenerProductoReferencia',
				dataType: 'JSON'
			});
		},

		ObtenerPrecios : function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'producto/obtenerPreciosProducto',
				dataType: 'JSON'	
			});
		},

		BuscarProducto:function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'producto/buscarProductoPorColumna',
				dataType: 'JSON'
			});
		},

		MostrarImagen:function(src){
			alert(src);
		},

		LimpiarCampos :function(){
			$('#txtProductoDescripcion').val('');
			$('#txtProductoEmbalaje').val('');	
			$('.txtUtilidadTotal').val(0);
			$('.txtPrecioVenta').val(0);
			$('.txtBase').val(0);

			$('.txtUtilidad').each(function(key, ele){
				$(ele).val('');
			});

			$('.txtDto1').val(0);
			$('.txtDto2').val(0);
			$('.txtDto3').val(0);
			$('.txtSubTotal').val(0);
			
			$('#txtReferencia1').val('');
			$('#txtReferencia2').val('');
			$('#txtReferencia3').val('');
			$('#txtReferencia4').val('');
			$('#txtPrecioVenta').val('');
			$('#fileImage').val('');
		}
	}

});