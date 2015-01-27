$(function(){
	APP.Entities.Zona = {};
	APP.Entities.Zona = {
		Mostrar:function(){
			APP.View.load('zona', '/zona/form/frm-zona').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()
		                    
		                    APP.Entities.Zona.Guardar({
		                    	'descripcion':$('#txtZona').val()
		                    }).success(function(res){
		                    	$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
		                    	$('#tblZona').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+$('#txtZona').val()+'</td></tr>');
		                    	$('#tblZona').parent().scrollTop($('#tblZona').parent()[0].scrollHeight);
		                    	$('#tblZona').val('');
		                    });
		                }
		            },{
		            	icon:'glyphicon glyphicon-refresh',
		                label: 'Actualizar',
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

							APP.Entities.Zona.Actualizar({
								id:$('#tblZona').find('.selectedRow').data('id'),
								descripcion:$('#txtZona').val()
							}).success(function(){
								$button.stopSpin();
		                    	$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
								$($('#tblZona .selectedRow td')[1]).text($('#txtZona').val());
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
					                   var http =  APP.Entities.Zona.Borrar({
					                    	id:$('#tblZona').find('.selectedRow').data('id')
					                    });

					                   http.complete(function(data){
					                   		$('#tblZona').find('.selectedRow').addClass('animated fadeOutLeft');
					                   		$('#tblZona').find('.selectedRow').remove();
											dlg.close();
		                    				$('.message-msg-area').notification({message:'se borró correctamente', msgtype:'success', closable:true});
		                    				$('#txtZona').val('');

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
				dialog.setTitle('Zonas');
				dialog.open();
			});			
		},

		Actualizar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'zona/actualizarzona',
				data:data,
				dataType:'JSON'
			});
		},

		Guardar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'zona/crearzona',
				data:data,
				dataType:'JSON'
			});
		},

		Borrar: function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'zona/borrarzona',
				data:data,
				dataType:'JSON'
			});
		},

		listaDeZonas : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'zona/',
				dataType: 'JSON'
			});
		},

		RellenarTabla : function(tbl){
			APP.Entities.Zona.listaDeZonas().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});
		},

		RellenarCombo : function(cmb){
			APP.Entities.Zona.listaDeZonas().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}

	}

});