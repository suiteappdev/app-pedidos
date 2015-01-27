$(function(){
	APP.Entities.Impuestos = {};
	APP.Entities.Impuestos = {
		Mostrar:function(){
			APP.View.load('producto', 'producto/form/frm-impuestos').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-impuestos',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()
		                    
		                    APP.Entities.Impuestos.Guardar({
		                    	'descripcion':$('#txtDescripcion').val()
		                    }).success(function(res){
		                    	$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
		                    	$('#tblImpuestos').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtDescripcion').val()+'</td></tr>');
		                    	$('#tblImpuestos').parent().scrollTop($('#tblImpuestos').parent()[0].scrollHeight);
		                    	$('#tblImpuestos').val('');
		                    });
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

							APP.Entities.Impuestos.Actualizar({
								id:$('#tblImpuestos').find('.selectedRow').data('id'),
								descripcion:$('#txtDescripcion').val()
							}).success(function(){
								$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
								$($('#tblImpuestos .selectedRow td')[1]).text($('#txtDescripcion').val());
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
					                   var http =  APP.Entities.Impuestos.Borrar({
					                    	id:$('#tblImpuestos').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblImpuestos').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblImpuestos').find('.selectedRow').remove();
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
				dialog.setTitle('Impuestos');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'impuestos/actualizarimpuestos',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'impuestos/crearimpuestos',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'impuestos/borrarimpuestos',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeImpuestos : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'impuestos/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.Impuestos.listaDeImpuestos().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});
		},

		RellenarCombo : function(cmb){
			APP.Entities.Impuestos.listaDeImpuestos().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}

	}

});