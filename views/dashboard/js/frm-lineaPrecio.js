$(function(){
	APP.Entities.LineaPrecio = {};
	APP.Entities.LineaPrecio = {
		Mostrar:function(){
			APP.View.load('lineaPrecio', 'producto/form/frm-lineaPrecio').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin();
		                    $button.disable();
		                    $button.text('actualizando productos...');
		                    
		                    APP.Entities.LineaPrecio.Guardar({
		                    	'descripcion':$('#txtLineaPrecio').val()
		                    }).success(function(res){
		                    	$button.stopSpin();
		                    	$button.enable();
		                    	$button.text('Guardar');
		                    	
		                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
		                    	$('#tblLineaPrecio').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtLineaPrecio').val()+'</td></tr>');
		                    	$('#tblLineaPrecio').parent().scrollTop($('#tblLineaPrecio').parent()[0].scrollHeight);
		                    	$('#tblLineaPrecio').val('');
		                    });
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

							APP.Entities.LineaPrecio.Actualizar({
								id:$('#tblLineaPrecio').find('.selectedRow').data('id'),
								descripcion:$('#txtLineaPrecio').val()
							}).success(function(){
								$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
								$($('#tblLineaPrecio .selectedRow td')[1]).text($('#txtLineaPrecio').val());
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
					                   var http =  APP.Entities.LineaPrecio.Borrar({
					                    	id:$('#tblLineaPrecio').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblLineaPrecio').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblLineaPrecio').find('.selectedRow').remove();
											dlg.close();
		                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});
		                    				$('#txtLineaPrecio').val('');

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
				dialog.setTitle('Lista de precios');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'lineaPrecio/actualizarlineaprecio',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'lineaPrecio/crearlineaprecio',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'lineaPrecio/borrarlineaprecio',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeLineaPrecios : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'lineaPrecio/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.LineaPrecio.listaDeLineaPrecios().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});
		},

		RellenarCombo : function(cmb){
			APP.Entities.LineaPrecio.listaDeLineaPrecios().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}

	}

});