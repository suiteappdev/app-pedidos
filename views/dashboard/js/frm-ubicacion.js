$(function(){
	APP.Entities.Ubicacion = {};
	APP.Entities.Ubicacion = {
		Mostrar:function(){
			APP.View.load('ubicacion', 'zona/form/frm-ubicacion').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Agregar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()
		                    
		                    APP.Entities.Ubicacion.Guardar({
		                    	'idzona':$('#cmbUbicacionZona').val(),
		                    	'iddepartamento':$('#cmbUbicacionDepartamento').val(),
		                    }).success(function(res){
		                    	$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
		                    	$('#tblUbicacion').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#cmbUbicacionDepartamento option:selected').text()+'</td></tr>');
		                    	$('#tblUbicacion').parent().scrollTop($('#tblZona').parent()[0].scrollHeight);
		                    	$('#tblUbicacion').val('');
		                    });
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

							APP.Entities.Ubicacion.Actualizar({
								id:$('#tblUbicacion').find('.selectedRow').data('id'),
								iddepartamento:$('#cmbUbicacionDepartamento').val(),
								idzona:$('#cmbUbicacionZona').val()
							}).success(function(){
								$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
								$($('#tblUbicacion .selectedRow td')[1]).text($('#cmbUbicacionDepartamento option:selected').text());
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
					                   var http =  APP.Entities.Ubicacion.Borrar({
					                    	id:$('#tblUbicacion').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblUbicacion').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblUbicacion').find('.selectedRow').remove();
											dlg.close();
		                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});

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
				dialog.setTitle('Ubicaciones');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'ubicacion/actualizarubicacion',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'ubicacion/crearubicacion',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'ubicacion/borrarubicacion',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeUbicaciones: function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'ubicacion/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.Ubicacion.listaDeUbicaciones().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});
		},

		RellenarCombo : function(cmb){
			APP.Entities.Ubicacion.listaDeUbicaciones().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}

	}

});