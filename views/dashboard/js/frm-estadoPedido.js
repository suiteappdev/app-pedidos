$(function(){
	APP.Entities.EstadoPedido = {};
	APP.Entities.EstadoPedido = {
		Mostrar:function(){
			APP.View.load('pedido', 'pedido/form/frm-estadoPedido').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()
		                    
		                    APP.Entities.EstadoPedido.Guardar({
		                    	'descripcion':$('#txtDescripcion').val()
		                    }).success(function(res){
		                    	$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
		                    	$('#tblEstadoPedido').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtDescripcion').val()+'</td></tr>');
		                    	$('#tblEstadoPedido').parent().scrollTop($('#tblEstadoPedido').parent()[0].scrollHeight);
		                    	$('#txtDescripcion').val('');
		                    });
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

							APP.Entities.EstadoPedido.Actualizar({
								id:$('#tblEstadoPedido').find('.selectedRow').data('id'),
								descripcion:$('#txtDescripcion').val()
							}).success(function(){
								$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
								$($('#tblEstadoPedido .selectedRow td')[1]).text($('#txtDescripcion').val());
							});
		                }
		            },
		            {
		                icon: 'glyphicon glyphicon-ban-circle',
		                label: 'Eliminar',
		                cssClass: 'btn-warning',
		                action:function(dialog){
					        BootstrapDialog.show({
					            message: '¿Desea eliminar  este item?',
					            buttons: [{
					            	icon: 'glyphicon glyphicon-ok',
					                label: 'SI',
					                cssClass: 'btn-primary',
					                action: function(dlg){
					                   var http =  APP.Entities.EstadoPedido.Borrar({
					                    	id:$('#tblEstadoPedido').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblEstadoPedido').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblEstadoPedido').find('.selectedRow').remove();
											dlg.close();
		                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});
		                    				$('#txtDescripcion').val('');

					                   });
					                }
					            }, {
					                icon: 'glyphicon glyphicon-ban-circle',
					                label: 'NO',
					                cssClass: 'btn-warning',
					                action:function(dlg){
										dlg.close();
					                }
					            }]
					        });
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
				dialog.setTitle('Estados de los Pedidos');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'estadoPedido/actualizarestadopedido',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'estadoPedido/crearestadopedido',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'estadoPedido/borrarestadopedido',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeEstadoPedidos : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'estadoPedido/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.EstadoPedido.listaDeEstadoPedidos().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});
		},

		RellenarCombo : function(cmb, callback){
			APP.Entities.EstadoPedido.listaDeEstadoPedidos().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				}
				
				);

				if(typeof callback == 'function'){
					try{
						return (callback)();
					}catch(e){

					}
				}else{
					return;
				}
			});
		}

	}

});