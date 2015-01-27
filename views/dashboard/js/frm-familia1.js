$(function(){
	APP.Entities.Familia1 = {};
	APP.Entities.Familia1 = {
		Mostrar : function(){
			APP.View.load('producto', 'producto/form/frm-familia1').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-familia1',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                hotkey:13,
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

		                    if(APP.validateForm('.form')){
			                    APP.Entities.Familia1.Guardar().success(function(res){
			                    	$button.stopSpin();
			                    	if(res.success){
				                    	$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
				                    	$('#tblFamilia1').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+res.descripcion+'</td><td><a href="'+res.image+'"><span class="icon-image2"> </span></a></td><td data-idestado="'+$('#cmbEstado').val()+'">'+$('#cmbEstado :selected').text()+'</td></tr>');
				                    	$('#tblFamilia1').parent().scrollTop($('#tblFamilia1').parent()[0].scrollHeight);
				                    	$('#txtDescripcion').val('');
			                    	}else{
				                    	$('.message-msg-area').notification({message:'ocurrio un error al guardar', msgtype:'error', closable:true});
			                    	}
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
		                    if($('#tblFamilia1').find('.selectedRow').length == 0){
			                    $('.message-msg-area').notification({message:'debe seleccionar una fila', msgtype:'error', closable:true});
		                    	$button.stopSpin();

		                    	return;
		                    }

		                    if(APP.validateForm('.form')){
								APP.Entities.Familia1.Actualizar().success(function(res){
									$button.stopSpin();
									if(res.success){
										$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
										$($('#tblFamilia1 .selectedRow td')[1]).text($('#txtDescripcion').val());
										$($('#tblFamilia1 .selectedRow td')[3]).text($('#cmbEstado :selected').text());
									}else{
										$('.message-msg-area').notification({message:'ocurrio un error al actualizar', msgtype:'error', closable:true});
									}
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
					        BootstrapDialog.show({
					            message: '¿Desea eliminar  este item?',
					            buttons: [{
					            	icon: 'glyphicon glyphicon-ok',
					                label: 'SI',
					                cssClass: 'btn-primary',
					                action: function(dlg){
					                   var http =  APP.Entities.Familia1.Borrar({
					                    	id:$('#tblFamilia1').find('.selectedRow').data('id')
					                    });

					                   http.success(function(res){
						                   	if(res.error){
			                    				$('.message-msg-area').notification({message:res.error, msgtype:'error', closable:true});
												dlg.close();
												return;
			  
						                   	}else if(res.success){
			                    				$('.message-msg-area').notification({message:res.success, msgtype:'success', closable:true});
						                   		$('#tblFamilia1').find('.selectedRow').addClass('animated fadeOutLeft');
						                   		$('#tblFamilia1').find('.selectedRow').remove();
												dlg.close();
			                    				$('#txtDescripcion').val('');
						                   	}
											
											dlg.close();
					                   });

					                   http.complete(function(data){

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
				dialog.setTitle('Familia 1');
				dialog.open();
			});

		},

		listaDeFamilia1 : function(){
			return $.ajax({
				type:'POST',
				url:BASE_PATH + 'familia1/',
				dataType: 'JSON'
			});
		},

		Guardar: function(){
			form = new FormData();

			form.append('descripcion', $('#txtDescripcion').val());
			form.append('estado', $('#cmbEstado').val());
			form.append('image',  $('#fileFamilia1').get(0).files[0]);

			return $.ajax({
				type:'POST',
				url:BASE_PATH +'familia1/crearfamilia1',
				mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
				data:form,
				dataType:'JSON'
			});
		},

		Actualizar:function(data){
			form = new FormData();

			form.append('id', $('#tblFamilia1').find('.selectedRow').data('id'));
			form.append('descripcion', $('#txtDescripcion').val());
			form.append('estado', $('#cmbEstado').val());
			form.append('image', $('#fileFamilia1').get(0).files[0]);

			return $.ajax({
				type:'POST',
				url:BASE_PATH +'familia1/actualizarfamilia1',
				mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
				data:form,
				dataType:'JSON'
			});
		},

		Borrar:function(data){
			return $.ajax({
				type:'POST',
				url:BASE_PATH +'familia1/borrarfamilia1',
				data:data,
				dataType:'JSON'
			});
		},

		RellenarTabla:function(tbl){
			APP.Entities.Familia1.listaDeFamilia1().success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td><td><a href="'+val.urlimg+'"><span class="icon-image2"> </span></a></td><td data-idestado="'+val.idestado+'">'+val.descripcionestado+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});

		},

		RellenarCombo : function(cmb){
			APP.Entities.Familia1.listaDeFamilia1().success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}
	}
})