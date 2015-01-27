$(function(){
	APP.Entities.Ciudad = {};
	APP.Entities.Ciudad = {
		Mostrar:function(){
			APP.View.load('ciudad', 'pais/form/frm-ciudad').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin();

		                    if(APP.validateForm('.form')){
			                    APP.Entities.Ciudad.Guardar({
			                    	'descripcion':$('#txtCiudad').val(),
			                    	'iddepartamento' : $('#cmbDepartamento').val()
			                    }).success(function(res){
			                    	$button.stopSpin();
			                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
			                    	$('#tblCiudad').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtCiudad').val()+'</td><td>'+$('#cmbDepartamento option:selected').text()+'</td></tr>');
			                    	$('#tblCiudad').parent().scrollTop($('#tblCiudad').parent()[0].scrollHeight);
			                    	$('#txtCiudad').val('');
			                    });
		                    }else{
								$button.stopSpin();
			                    $('.message-msg-area').notification({message:'algunos campos tienen error', msgtype:'error', closable:true});	
		                    }
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin();

		                    if($('#tblCiudad').find('.selectedRow').length == 0){
								$button.stopSpin();
			                    $('.message-msg-area').notification({message:'debe seleccionar una fila', msgtype:'error', closable:true});
		                   		return;
		                    }

		                    if(APP.validateForm('.form')){
								APP.Entities.Ciudad.Actualizar({
									id:$('#tblCiudad').find('.selectedRow').data('id'),
									descripcion:$('#txtCiudad').val(),
									iddepartamento:$('#cmbDepartamento').val()
								}).success(function(){
									$button.stopSpin();
			                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
									$($('#tblCiudad .selectedRow td')[1]).text($('#txtCiudad').val());
									$($('#tblCiudad .selectedRow td')[2]).text($('#cmbDepartamento option:selected').text());
								});
		                    }else{
								$button.stopSpin();
			                    $('.message-msg-area').notification({message:'alguno campos tienen errores', msgtype:'error', closable:true});
		                    }
		                }
		            },
		            {
		                icon: 'glyphicon glyphicon-ban-circle',
		                label: 'Eliminar',
		                cssClass: 'btn-warning',
		                action:function(dialog){
		                	if($('#tblCiudad').find('.selectedRow').length == 0){
		                    	$('.message-msg-area').notification({message:'debe seleccionar una fila', msgtype:'error', closable:true});
		                		return;
		                	}
		                	
					        BootstrapDialog.show({
					            message: '¿Desea eliminar  este item?',
					            buttons: [{
					            	icon: 'glyphicon glyphicon-ok',
					                label: 'SI',
					                cssClass: 'btn-primary',
					                action: function(dlg){
					                	if($('#tblCiudad').find('.selectedRow').length <= 0){
		                    				$('.message-msg-area').notification({message:'debe seleccionar una fila', msgtype:'error', closable:true});
		                    				return;
					                	}else{
						                   var http =  APP.Entities.Ciudad.Borrar({
						                    	id:$('#tblCiudad').find('.selectedRow').data('id')
						                    });

						                   http.complete(function(data){
						                   		$('#tblCiudad').find('.selectedRow').addClass('animated fadeOutLeft');
						                   		$('#tblCiudad').find('.selectedRow').remove();
												dlg.close();
			                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});
			                    				$('#txtCiudad').val('');

						                   });					                		
					                	}
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
				dialog.setTitle('Ciudad');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'ciudad/actualizarCiudad',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'ciudad/crearCiudad',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'ciudad/borrarCiudad',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeCiudades : function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'ciudad/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.Ciudad.listaDeCiudades().success(function(res){
				console.table(res);
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td><td data-iddepartamento="'+val.iddepartamento+'">'+val.departamento+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});
		},

		RellenarCombo : function(cmb){
			APP.Entities.Ciudad.listaDeCiudades().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}

	}

});