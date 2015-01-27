$(function(){
	APP.Entities.UsuarioZona = {};
	APP.Entities.UsuarioZona = {
		Mostrar:function(){
			APP.View.load('tipoCliente', 'tipoCliente/form/frm-usuarioZona').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()
		                    
		                    APP.Entities.UsuarioZona.Guardar({
								identificacion:$('#cmbUsuario').val(),
								idzona:$('#cmbZona').val(),
								idlinea:$('#cmbLineaPrecio').val()
		                    }).success(function(res){
		                    	if(res.estado){
		                    		$('.message-msg-area').notification({message:'este vendedor ya esta tiene esta zona', msgtype:'warning', closable:true});
									$button.stopSpin();
		                    	}else{
									$button.stopSpin();
		                    		$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
		                    		$('#tblUsuarioZona').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#cmbUsuario').val()+'</td><td data-zona="'+$('#cmbZona').val()+'">'+$('#cmbZona :selected').text()+'</td><td data-lineaprecio="'+$('#cmbLineaPrecio').val()+'">'+$('#cmbLineaPrecio :selected').text()+'</td></tr>');
		                    		$('#tblUsuarioZona').parent().scrollTop($('#tblUsuarioZona').parent()[0].scrollHeight);	
		                    	}
		                    });
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

							APP.Entities.UsuarioZona.Actualizar({
								id:$('#tblUsuarioZona').find('.selectedRow').data('id'),
								identificacion:$('#cmbUsuario').val(),
								idzona:$('#cmbZona').val(),
								idlineaprecio:$('#cmbLineaPrecio').val()
							}).success(function(){
								$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
								$($('#tblUsuarioZona .selectedRow td')[1]).text($('#cmbUsuario').val());
								$($('#tblUsuarioZona .selectedRow td')[2]).text($('#cmbZona :selected').text());
								$($('#tblUsuarioZona .selectedRow td')[3]).text($('#cmbLineaPrecio :selected').text());
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
					                   var http =  APP.Entities.UsuarioZona.Borrar({
					                    	id:$('#tblUsuarioZona').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblUsuarioZona').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblUsuarioZona').find('.selectedRow').remove();
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
				dialog.setTitle('Zonas de Vendedores');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'usuariozona/actualizarusuariozona',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'usuariozona/crearusuariozona',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'usuariozona/borrarusuariozona',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeUsuarioZonas : function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'usuariozona/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.UsuarioZona.listaDeUsuarioZonas().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td data-identificacion="'+val.identificacion+'">'+val.identificacion+'</td><td data-zona="'+val.idzona+'">'+val.zona+'</td><td data-lineaprecio="'+val.idlinea+'">'+val.lineaprecio+'</td></tr>');
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
		}

	}

});