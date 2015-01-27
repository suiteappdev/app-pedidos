$(function(){
	APP.Entities.EstadoCategoria = {};
	APP.Entities.EstadoCategoria = {
		Mostrar : function(){
			APP.View.load('producto', 'producto/form/frm-estadoCategoria').success(function(_html){
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
			                    APP.Entities.EstadoCategoria.Guardar({
			                    	'descripcion':$('#txtDescripcion').val()
			                    }).success(function(res){
			                    	$button.stopSpin();
			                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
			                    	$('#tblEstadoCategoria').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtDescripcion').val()+'</td></tr>');
			                    	$('#tblEstadoCategoria').parent().scrollTop($('#tblPais').parent()[0].scrollHeight);
			                    	$('#txtDescripcion').val('');
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
		                    if($('#tblEstadoCategoria').find('.selectedRow').length == 0){
			                    $('.message-msg-area').notification({message:'debe seleccionar una fila', msgtype:'error', closable:true});
		                    	$button.stopSpin();

		                    	return;
		                    }

		                    if(APP.validateForm('.form')){
								APP.Entities.EstadoCategoria.Actualizar({
									id:$('#tblEstadoCategoria').find('.selectedRow').data('id'),
									descripcion:$('#txtDescripcion').val()
								}).success(function(){
									$button.stopSpin();
			                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
									$($('#tblEstadoCategoria .selectedRow td')[1]).text($('#txtDescripcion').val());
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
					                   var http =  APP.Entities.EstadoCategoria.Borrar({
					                    	id:$('#tblEstadoCategoria').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblEstadoCategoria').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblEstadoCategoria').find('.selectedRow').remove();
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
				dialog.setTitle('Estados de Familia');
				dialog.open();
			});

		},

		listaDeEstadoCategorias : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'estadoCategoria/',
				dataType: 'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'estadoCategoria/crearestadocategoria',
				data:data,
				dataType:'JSON'
			});
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'estadoCategoria/actualizarestadocategoria',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'estadoCategoria/borrarestadocategoria',
				data:data,
				dataType:'JSON'
			});
		},

		RellenarTabla:function(tbl){
			APP.Entities.EstadoCategoria.listaDeEstadoCategorias().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});

		},

		RellenarCombo : function(cmb){
			APP.Entities.EstadoCategoria.listaDeEstadoCategorias().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}
	}
})