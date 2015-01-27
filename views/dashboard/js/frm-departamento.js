$(function(){
	APP.Entities.Departamento = {};
	APP.Entities.Departamento = {
		Mostrar:function(){
			APP.View.load('departamento', 'pais/form/frm-departamento').success(function(_html){
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
			                    APP.Entities.Departamento.Guardar({
			                    	'descripcion':$('#txtDepartamento').val(),
			                    	'id' : $('#cmbPais').val()
			                    }).success(function(res){
			                    	$button.stopSpin();
			                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
			                    	$('#tblDepartamento').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtDepartamento').val()+'</td><td>'+$('#cmbPais option:selected').text()+'</td></tr>');
			                    	$('#tblDepartamento').parent().scrollTop($('#tblDepartamento').parent()[0].scrollHeight);
			                    	$('#txtDepartamento').val('');
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
		                    
		                    if($('#tblDepartamento').find('.selectedRow').length == 0){
			                    $('.message-msg-area').notification({message:'debe seleccionar una fila', msgtype:'error', closable:true});
		                    	$button.stopSpin();
		                    	return;
		                    }

		                    if(APP.validateForm('.form')){
								APP.Entities.Departamento.Actualizar({
									id:$('#tblDepartamento').find('.selectedRow').data('id'),
									descripcion:$('#txtDepartamento').val(),
									idpais:$('#cmbPais').val()
								}).success(function(){
									$button.stopSpin();
			                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
									$($('#tblDepartamento .selectedRow td')[1]).text($('#txtDepartamento').val());
									$($('#tblDepartamento .selectedRow td')[2]).text($('#cmbPais option:selected').text());
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
		                	if($('#tblDepartamento').find('.selectedRow').length == 0){
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
					                   var http =  APP.Entities.Departamento.Borrar({
					                    	id:$('#tblDepartamento').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblDepartamento').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblDepartamento').find('.selectedRow').remove();
											dlg.close();
		                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});
		                    				$('#txtDepartamento').val('');

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
				dialog.setTitle('Departamento');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'departamento/actualizarDepartamento',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'departamento/crearDepartamento',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'departamento/borrarDepartamento',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeDepartamentos : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'departamento/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.Departamento.listaDeDepartamentos().success(function(res){
				console.table(res);
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td><td data-idpais="'+val.idpais+'">'+val.pais+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});
		},

		RellenarCombo : function(cmb){
			APP.Entities.Departamento.listaDeDepartamentos().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}

	}

});