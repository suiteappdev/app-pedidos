$(function(){
	APP.Entities.Pedido = {};
	APP.Entities.Pedido = {
		Mostrar:function(){
			APP.View.load('pedido', 'pedido/form/frm-pedido').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pedidos',
		            draggable: true,
		        	buttons:[{
		                icon: 'glyphicon glyphicon-ban-circle',
		                label: '[ESC]-Salir',
		                cssClass: 'btn-warning',
		                action : function(dlg){
		                	dlg.close();
		                }
		        	}]
		        });
				
				dialog.realize();
				dialog.setMessage(_html);
				dialog.getModalHeader().css('background-image', 'url(public/images/pattern.jpg)');
				dialog.getModalBody().css('padding', '1px');
				dialog.getModalBody().css('background-image', 'url(public/images/pattern.jpg)');
				dialog.getModalFooter().css('margin-top', '0px');
				dialog.getModalFooter().css('border-top', '0px');
				dialog.getModalFooter().css('padding', '10px 10px 10px');
				dialog.setTitle('Pedidos');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'pedido/actualizarDepartamento',
				data:data,
				dataType:'JSON'
			});
		},

		ActualizarEstadoPedido : function(data){
			_cmb = $('<select style="margin-bottom:0px!important;" class="select-block" id="cmbEstadoGrid" data-style="btn-success" ></select>');
			APP.Entities.EstadoPedido.RellenarCombo(_cmb);
	       
	        var dialog = new BootstrapDialog({
	        	cssClass:'frm-ActualizarPedido',
	        	onshow : function(dlg){
	        		dlg.getModalBody().find('#cmbEstadoGrid').selectpicker({style: 'btn-small btn-warning'});
	        	},
	        	message : _cmb,
	        	buttons:[{
	                icon: 'glyphicon glyphicon-ok',
	                cssClass: 'btn-primary',
	                action : function(dlg){
						$.ajax({
							type:'POST',
							url:BASE_PATH +'pedido/actualizarEstadoPedido',
							dataType:'JSON',
							data:{ pedido : data, estado : dlg.getModalBody().find('#cmbEstadoGrid').val()},
							success:function(res){
								if(res.success){
									dlg.close();
									$('#tblPedidos .selectedRow').find('.lnkActualizarEstado').text(dlg.getModalBody().find('#cmbEstadoGrid :selected').text());
									$('#msgAreaPedido').notification({message:res.success, msgtype:'success', closable:false});
								}else if(res.error){
									dlg.close();
									$('#msgAreaPedido').notification({message:res.error, msgtype:'error', closable:true});
								}
							}
						});
	                }
	        	}],
	            draggable: true,
	        });
				dialog.realize();
				dialog.getModalHeader().css('background-image', 'url(public/images/pattern.jpg)');
				dialog.getModalBody().css('padding', '1px');
				dialog.getModalBody().css('background-image', 'url(public/images/pattern.jpg)');
				dialog.getModalFooter().css('margin-top', '0px');
				dialog.getModalFooter().css('border-top', '0px');
				dialog.getModalFooter().css('padding', '10px 10px 10px');
				dialog.setTitle('Cambiar...');
				dialog.open();
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'pedido/borrarDepartamento',
				data:data,
				dataType:'JSON'
			});
		},

		listaDePedidos : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'pedido/',
				dataType: 'JSON'
			});
		},

		MostrarDetalle : function(idpedido){
			APP.View.load('pedido', 'pedido/form/frm-detallePedido').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	message : _html,
		        	cssClass:'frm-DetallePedido',
		        	onshow:function(dlgref){
		        		_tblDetalle = dlgref.getModalBody().find('#tblDetallePedidos');
		        		APP.Entities.Pedido.ObtenerDetallePedido({idpedido: idpedido}).success(function(data){
		        			$.each(data, function(key, val){
		        				_newRow = $('<tr><td data-idpedido="'+val.idpedido+'">'+val.idpedido+'</td><td>'+val.referencia+'</td><td>'+val.descripcion+'</td><td>'+val.descuento1+'</td><td>'+val.descuento2+'</td><td>'+val.descuento3+'</td><td>'+val.cantidad+'</td><td>'+accounting.format(val.precioventa)+'</td></tr>');
		        				_tblDetalle.find('tbody').append(_newRow);
		        			});
		        		});
		        	},
		        	onshown:function(dlgref){
		        		dlgref.getModalBody().find('#tblDetallePedidos').fixheader();
		        	},
		        	buttons:[{
		                icon: 'glyphicon glyphicon-ban-circle',
		                label: '[ESC]-Salir',
		                cssClass: 'btn-warning',
		                action : function(dlg){
		                	dlg.close();
		                }
		        	}],
		            draggable: true,
		        });
				
				dialog.realize();
				dialog.setMessage(_html);
				dialog.getModalHeader().css('background-image', 'url(public/images/pattern.jpg)');
				dialog.getModalBody().css('padding', '1px');
				dialog.getModalBody().css('background-image', 'url(public/images/pattern.jpg)');
				dialog.getModalFooter().css('margin-top', '0px');
				dialog.getModalFooter().css('border-top', '0px');
				dialog.getModalFooter().css('padding', '10px 10px 10px');
				dialog.setTitle('Detalle Pedido');
				dialog.open();
			});	
		},

		PedidoPDF : function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'pedido/pedidoPDF',
				dataType: 'JSON'
			});
		},

		ObtenerDetallePedido : function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'pedido/Detallepedido',
				dataType: 'JSON'
			});
		},

		Buscar:function(){
			_postData = {};
			

			if($('#dtpFechaInicial').val() != ''){
				_postData.init = $('#dtpFechaInicial').val();
			}

			if($('#dtpFechaFinal').val() != ''){
				_postData.post = $('#dtpFechaFinal').val();
			}
			
			_postData.estado = $('#cmbFiltroEstado').val();
			_postData.column = $('#cmbFiltro').val();
			_postData.criteria = $('#txtCriteria').val();
			
			return $.ajax({
				type:'POST',
				data:_postData,
				url:BASE_PATH + 'pedido/ObtenerTodosLosPedidos',
				dataType: 'JSON',
			});
		},
	}

});