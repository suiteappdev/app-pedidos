$(function(){
	APP.Entities.tipoCliente = {};
	APP.Entities.tipoCliente = {
		Mostrar:function(){
			APP.View.load('tipoCliente', 'tipoCliente/form/frm-tipoCliente').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()
		                    
		                    APP.Entities.tipoCliente.Guardar({
		                    	'descripcion':$('#txtTipoCliente').val()
		                    }).success(function(res){
		                    	$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
		                    	$('#tblTipoCliente').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtTipoCliente').val()+'</td></tr>');
		                    	$('#tblTipoCliente').parent().scrollTop($('#tblTipoCliente').parent()[0].scrollHeight);
		                    	$('#tblTipoCliente').val('');
		                    });
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

							APP.Entities.tipoCliente.Actualizar({
								id:$('#tblTipoCliente').find('.selectedRow').data('id'),
								descripcion:$('#txtTipoCliente').val()
							}).success(function(){
								$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
								$($('#tblTipoCliente .selectedRow td')[1]).text($('#txtTipoCliente').val());
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
					                   var http =  APP.Entities.tipoCliente.Borrar({
					                    	id:$('#tblTipoCliente').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblTipoCliente').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblTipoCliente').find('.selectedRow').remove();
											dlg.close();
		                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});
		                    				$('#txtTipoCliente').val('');

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
				dialog.setTitle('Tipos de usuarios');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'tipocliente/actualizartipocliente',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'tipocliente/creartipocliente',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'tipocliente/borrarTipoCliente',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeTipoClientes : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'tipoCliente/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.tipoCliente.listaDeTipoClientes().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});
		},

		RellenarCombo : function(cmb){
			APP.Entities.tipoCliente.listaDeTipoClientes().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}

	}

});