$(function(){
	APP.Entities.tipoIdentificacion = {};
	APP.Entities.tipoIdentificacion = {
		Mostrar:function(){
			APP.View.load('tipoCliente', 'tipoCliente/form/frm-tipoIdentificacion').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()
		                    
		                    APP.Entities.tipoIdentificacion.Guardar({
		                    	'descripcion':$('#txtTipoIdentificacion').val()
		                    }).success(function(res){
		                    	$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
		                    	$('#tblTipoIdentificacion').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtTipoIdentificacion').val()+'</td></tr>');
		                    	$('#tblTipoIdentificacion').parent().scrollTop($('#tblTipoIdentificacion').parent()[0].scrollHeight);
		                    	$('#tblTipoIdentificacion').val('');
		                    });
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

							APP.Entities.tipoIdentificacion.Actualizar({
								id:$('#tblTipoIdentificacion').find('.selectedRow').data('id'),
								descripcion:$('#txtTipoIdentificacion').val()
							}).success(function(){
								$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
								$($('#tblTipoIdentificacion .selectedRow td')[1]).text($('#txtTipoIdentificacion').val());
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
					                   var http =  APP.Entities.tipoIdentificacion.Borrar({
					                    	id:$('#tblTipoIdentificacion').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblTipoIdentificacion').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblTipoIdentificacion').find('.selectedRow').remove();
											dlg.close();
		                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});
		                    				$('#txtTipoIdentificacion').val('');

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
				dialog.getModalBody().css('padding', '4px');
				dialog.getModalBody().css('background-image', 'url(public/images/pattern.jpg)');
				dialog.getModalFooter().css('margin-top', '0px');
				dialog.getModalFooter().css('border-top', '0px');
				dialog.getModalFooter().css('padding', '10px 10px 10px');
				dialog.setTitle('Tipos de Identificaciones');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'tipoIdentificacion/actualizartipoidentificacion',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'tipoIdentificacion/creartipoidentificacion',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'tipoIdentificacion/borrartipoidentificacion',
				data:data,
				dataType:'JSON'
			});
		},

		listaDetipoIdentificaciones : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'tipoIdentificacion/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.tipoIdentificacion.listaDetipoIdentificaciones().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});
		},
		RellenarCombo : function(cmb){
			APP.Entities.tipoIdentificacion.listaDetipoIdentificaciones().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}
	}

});