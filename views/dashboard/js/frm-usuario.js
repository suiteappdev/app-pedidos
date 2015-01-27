$(function(){
	APP.Entities.Usuario = {};
	APP.Entities.Usuario = {
		Mostrar:function(){
			APP.View.load('tipoCliente', 'tipoCliente/form/frm-usuario').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-usuario',
		        	onhide:function(){
		        		try{
			        		if(_values){
			        			_values = null;
			        		}		        			
		        		}catch(e){

		        		}
		        	},
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Agregar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()
		                    
		                    APP.Entities.Usuario.Guardar({
		                    	identificacion:$('#txtUsuarioIdentificacion').val(),
		                    	tipoidentificacion :$('#cmbUsuarioTipoIdentificacion').val(),
		                    	tipocliente:$('#cmbUsuarioTipoCliente').val(),
		                    	nombres:$('#txtUsuarioNombre').val(),
		                    	estado:$('#cmbUsuarioEstado').val(),
		                    	apellidos:$('#txtUsuarioApellido').val(),
		                    	direccion:$('#txtUsuarioDireccion').val(),
		                    	telefono1:$('#txtUsuarioTelefono1').val(),
		                    	telefono2:$('#txtUsuarioTelefono2').val(),
		                    	telefono3:$('#txtUsuarioTelefono3').val(),
		                    	descuento1:$('#txtdto1').val(),
		                    	descuento2:$('#txtdto2').val(),
		                    	descuento3:$('#txtdto3').val(),
		                    	usuario:$('#txtUsuarioUsuario').val(),
		                    	password:$('#txtUsuarioPassword').val(),
		                    	departamento:$('#cmbUsuarioDepartamento').val(),
		                    	ciudad:$('#cmbUsuarioCiudad').val(),
		                    	correo:$('#txtUsuarioCorreo').val()
		                    }).success(function(res){
		                    	$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
								APP.Entities.Usuario.LimpiarCampos();
		                    });
		                }
		            },{
		            	icon:'glyphicon glyphicon-search',
		                label: '[F2]-Buscar',
		                hotkey:113,
		                cssClass: 'btn-primary',
		                action:function(){
							APP.View.load('tipoCliente', 'tipoCliente/form/frm-buscar').success(function(_html){
			                	var dlg = new BootstrapDialog({
			                		cssClass:'frm-buscar',
			                		message: _html,
			                		buttons:[{
						            	icon:'glyphicon glyphicon-ok',
						                label: '[ENTER]-Usar',
						                hotkey:13,
						                cssClass: 'btn-primary',
						                action:function(instance){
						                	_values = instance.$modalContent.find('.selectedRow').data('object');
	                						$('#txtUsuarioIdentificacion').val(_values.identificacion);
	                    					$('#cmbUsuarioTipoIdentificacion').selectpicker('val',_values.tipoidentificacion);
	             							$('#cmbUsuarioTipoCliente').selectpicker('val', _values.tipocliente);
	        								$('#txtUsuarioNombre').val(_values.nombres);
	        								$('#cmbUsuarioEstado').selectpicker('val', _values.estado);;
	           								$('#txtUsuarioApellido').val(_values.apellidos);
	           								$('#txtUsuarioDireccion').val(_values.direccion);
	           								$('#txtUsuarioTelefono1').val(_values.telefono1);
	           								$('#txtUsuarioTelefono2').val(_values.telefono2);
	           								$('#txtUsuarioTelefono3').val(_values.telefono3);
	           								$('#txtdto1').val(_values.descuento1);
	           								$('#txtdto2').val(_values.descuento2);
	           								$('#txtdto3').val(_values.descuento3);
	         								$('#txtUsuarioUsuario').val(_values.usuario);
	          								$('#txtUsuarioPassword').val(_values.clave);
	              							$('#cmbUsuarioDepartamento').selectpicker('val', _values.departamento);
	        								$('#cmbUsuarioCiudad').selectpicker('val', _values.ciudad);
	        								$('#txtUsuarioCorreo').val(_values.email);
					                    	
					                    	instance.close();
						                }
			                		}]
						        });

								dlg.realize();
								dlg.getModalBody().css('padding', '1px');
								dlg.getModalHeader().css('background-image', 'url(public/images/pattern.jpg)');
								dlg.getModalBody().css('background-image', 'url(public/images/pattern.jpg)');
								dlg.getModalFooter().css('margin-top', '0px');
								dlg.getModalFooter().css('border-top', '0px');
								dlg.getModalFooter().css('padding', '10px 10px 10px');
								dlg.setTitle('Usuario');
								dlg.open();

							});
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                	try{
			                	if(_values == undefined){
									BootstrapDialog.alert('debe buscar un usuario');
									return;
			                	}		                		
		                	}catch(e){
								BootstrapDialog.alert('debe buscar un usuario');
								return;
		                	}

		                    var $button = this;
		                    $button.spin();
							APP.Entities.Usuario.Actualizar({
								id:_values.id,
		                    	identificacion:$('#txtUsuarioIdentificacion').val(),
		                    	tipoidentificacion :$('#cmbUsuarioTipoIdentificacion').val(),
		                    	tipocliente:$('#cmbUsuarioTipoCliente').val(),
		                    	nombres:$('#txtUsuarioNombre').val(),
		                    	estado:$('#cmbUsuarioEstado').val(),
		                    	apellidos:$('#txtUsuarioApellido').val(),
		                    	direccion:$('#txtUsuarioDireccion').val(),
		                    	telefono1:$('#txtUsuarioTelefono1').val(),
		                    	telefono2:$('#txtUsuarioTelefono2').val(),
		                    	telefono3:$('#txtUsuarioTelefono3').val(),
		                    	descuento1:$('#txtdto1').val(),
		                    	descuento2:$('#txtdto2').val(),
		                    	descuento3:$('#txtdto3').val(),
		                    	usuario:$('#txtUsuarioUsuario').val(),
		                    	password:$('#txtUsuarioPassword').val(),
		                    	departamento:$('#cmbUsuarioDepartamento').val(),
		                    	ciudad:$('#cmbUsuarioCiudad').val(),
		                    	correo:$('#txtUsuarioCorreo').val()
							}).success(function(data){
								if(data.success){
									$button.stopSpin();
		                    		$('.message-msg-area').notification({message:data.success, msgtype:'success', closable:true});
									_values = null;
								}else{
									$button.stopSpin();
									_values = null;
			                    	$('.message-msg-area').notification({message:data.error, msgtype:'error', closable:true});
									APP.Entities.Usuario.LimpiarCampos();									
								}
							});
		                }
		            },
		            {
		                icon: 'glyphicon glyphicon-ban-circle',
		                label: 'Eliminar',
		                cssClass: 'btn-warning',
		                action:function(dialog){
		                	try{
			                	if(_values == undefined){
									BootstrapDialog.alert('debe buscar un usuario');
									return;
			                	}					                		
		                	}catch(e){
								BootstrapDialog.alert('debe buscar un usuario');
								return;	
		                	}

					        var deleteInstance = BootstrapDialog.show({
					            message: '¿Desea eliminar  este item?',
			                	type: BootstrapDialog.TYPE_WARNING,
					            buttons: [{
					            	icon: 'glyphicon glyphicon-ok',
					                label: 'SI',
					                cssClass: 'btn-primary',
					                action: function(dlg){
					                   var http =  APP.Entities.Usuario.Borrar({
					                    	id:_values.id
					                    });

					                   http.complete(function(data){
											dlg.close();
											_values = null;
		                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});
											APP.Entities.Usuario.LimpiarCampos();

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
				dialog.setTitle('Usuario');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'usuario/actualizarusuario',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'usuario/crearusuario',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'usuario/borrarusuario',
				data:data,
				dataType:'JSON'
			});
		},

		listaUsuarios: function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'usuario/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.Usuario.listaUsuarios().success(function(res){
				$.each(res, function(key, val){
					_newRow = $('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.identificacion+'</td><td>'+val.nombres+'</td><td>'+val.apellidos+'</td><td>'+val.direccion+'</td></tr>');
					_newRow.data('object', val);
					$(tbl).append(_newRow);
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
		},

		Buscar : function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'usuario/',
				data:data,
				dataType:'JSON'
			});
		},

		LimpiarCampos:function(){
			$('#txtUsuarioIdentificacion').val('');
			$('#cmbUsuarioTipoIdentificacion').selectpicker('refresh');
				$('#cmbUsuarioTipoCliente').selectpicker('refresh');
			$('#txtUsuarioNombre').val('');
			$('#cmbUsuarioEstado').selectpicker('refresh');
				$('#txtUsuarioApellido').val('');
				$('#txtUsuarioDireccion').val('');
				$('#txtUsuarioTelefono1').val('');
				$('#txtUsuarioTelefono2').val('');
				$('#txtUsuarioTelefono3').val('');
				$('#txtDto1').val('');
				$('#txtDto2').val('');
				$('#txtDto3').val('');
				$('#txtUsuarioUsuario').val('');
				$('#txtUsuarioPassword').val('');
				$('#cmbUsuarioDepartamento').selectpicker('refresh');
			$('#cmbUsuarioCiudad').selectpicker('refresh');
			$('#txtUsuarioCorreo').val('');
		}

	}

});