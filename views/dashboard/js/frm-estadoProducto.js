$(function(){
	APP.Entities.EstadoProductos = {};
	APP.Entities.EstadoProductos = {
		Mostrar : function(){
			APP.View.load('estadoProducto', 'producto/form/frm-estadoProducto').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                hotkey:13,
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

		                    if(APP.validateForm('.form')){
			                    APP.Entities.EstadoProductos.Guardar({
			                    	'descripcion':$('#txtEstadoProducto').val()
			                    }).success(function(res){
			                    	$button.stopSpin();
			                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
			                    	$('#tblEstadoProducto').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtEstadoProducto').val()+'</td></tr>');
			                    	$('#tblEstadoProducto').parent().scrollTop($('#tblEstadoProducto').parent()[0].scrollHeight);
			                    	$('#txtEstadoProducto').val('');
			                    });
		                    }else{
		                    	$button.stopSpin();
			                    $('.message-msg-area').notification({message:'algunos campos tienen errores', msgtype:'error', closable:true});

		                    }
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin();
		                    if($('#tblEstadoProducto').find('.selectedRow').length == 0){
			                    $('.message-msg-area').notification({message:'debe seleccionar una fila', msgtype:'error', closable:true});
		                    	$button.stopSpin();

		                    	return;
		                    }

		                    if(APP.validateForm('.form')){
								APP.Entities.EstadoProductos.Actualizar({
									id:$('#tblEstadoProducto').find('.selectedRow').data('id'),
									descripcion:$('#txtEstadoProducto').val()
								}).success(function(){
									$button.stopSpin();
			                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
									$($('#tblEstadoProducto .selectedRow td')[1]).text($('#txtEstadoProducto').val());
								});
		                    }else{
								$button.stopSpin();
			                    $('.message-msg-area').notification({message:'algunos campos tienen errores', msgtype:'error', closable:true});	
		                    }
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
					                   var http =  APP.Entities.EstadoProductos.Borrar({
					                    	id:$('#tblEstadoProducto').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblEstadoProducto').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblEstadoProducto').find('.selectedRow').remove();
											dlg.close();
		                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});
		                    				$('#txtEstadoProducto').val('');

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
				dialog.setTitle('Estados de los productos');
				dialog.open();
			});

		},

		listaDeEstadoProductos : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'estadoProducto/',
				dataType: 'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'estadoProducto/crearestadoproducto',
				data:data,
				dataType:'JSON'
			});
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'estadoProducto/actualizarestadoproducto',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'estadoProducto/borrarestadoproducto',
				data:data,
				dataType:'JSON'
			});
		},

		RellenarTabla:function(tbl){
			APP.Entities.EstadoProductos.listaDeEstadoProductos().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});

		},

		RellenarCombo : function(cmb){
			APP.Entities.EstadoProductos.listaDeEstadoProductos().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}
	}
})