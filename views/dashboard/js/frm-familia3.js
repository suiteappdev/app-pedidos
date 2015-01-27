$(function(){
	APP.Entities.Familia3 = {};
	APP.Entities.Familia3 = {
		Mostrar : function(){
			APP.View.load('producto', 'producto/form/frm-familia3').success(function(_html){
		        var dialog = new BootstrapDialog({
		        	cssClass:'frm-pais',
		            buttons: [{
		            	icon:'glyphicon glyphicon-ok',
		                label: 'Guardar',
		                hotkey:13,
		                cssClass: 'btn-primary',
		                action: function(dialog) {
		                    var $button = this;
		                    $button.spin()

		                    if(APP.validateForm('.form')){
			                    APP.Entities.Familia3.Guardar().success(function(res){
			                    	$button.stopSpin();
			                    	if(res.success){
			                    		$('.message-msg-area').notification({message:'Guardado correctamente', msgtype:'success', closable:true});
			                    		$('#tblFamilia3').find('tbody').append('<tr data-id="'+res.id+'" class="animated fadeInLeft"><td>'+res.id+'</td><td>'+res.descripcion+'</td><td data-idfamilia="'+res.familia+'">'+$('#cmbFamilia2 :selected').text()+'</td><td><a href="'+res.image+'" target="_blank"><span class="icon-image2"> </span></td><td data-idestado="'+$('#cmbEstado').val()+'">'+$('#cmbEstado :selected').text()+'</td></tr>');
			                    		$('#tblFamilia3').parent().scrollTop($('#tblFamilia3').parent()[0].scrollHeight);
			                    		$('#txtDescripcion').val('');
			                    	}else{
			                    		$('.message-msg-area').notification({message:'Ocurrio un error al guardar.', msgtype:'error', closable:true});
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
		                    if($('#tblFamilia3').find('.selectedRow').length == 0){
			                    $('.message-msg-area').notification({message:'debe seleccionar una fila', msgtype:'error', closable:true});
		                    	$button.stopSpin();

		                    	return;
		                    }

		                    if(APP.validateForm('.form')){
								APP.Entities.Familia3.Actualizar().success(function(res){
									$button.stopSpin();
									if(res.success){
										$('.message-msg-area').notification({message:'se actualizó correctamente', msgtype:'success', closable:true});
										$($('#tblFamilia3 .selectedRow td')[1]).text($('#txtDescripcion').val());
										$($('#tblFamilia3 .selectedRow td')[2]).text($('#cmbFamilia2 :selected').text());
										$($('#tblFamilia3 .selectedRow td')[3]).find('a').attr('href', res.image);
										$($('#tblFamilia3 .selectedRow td')[4]).text($('#cmbEstado :selected').text());		
									}else{
										$('.message-msg-area').notification({message:'ocurrio un error al guardar', msgtype:'error', closable:true});
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
					                   var http =  APP.Entities.Familia3.Borrar({
					                    	id:$('#tblFamilia3').find('.selectedRow').data('id')
					                    });

					                   http.success(function(res){
					                   		if(res.error){
					                   			dlg.close();
		                    					$('.message-msg-area').notification({message:res.error, msgtype:'error', closable:true});
		                    					return;
					                   		}else if(res.success){
						                   		$('#tblFamilia3').find('.selectedRow').addClass('animated fadeOutLeft');
						                   		$('#tblFamilia3').find('.selectedRow').remove();
												dlg.close();
			                    				$('.message-msg-area').notification({message:res.success, msgtype:'success', closable:true});
			                    				$('#txtDescripcion').val('');	
					                   		}
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
				dialog.setTitle('Familia 3');
				dialog.open();
			});

		},

		listaDeFamilia3 : function(data){
			return $.ajax({
				type:'POST',
				data:data,
				url:BASE_PATH + 'familia3/',
				dataType: 'JSON'
			});
		},

		Guardar: function(){
			form = new FormData();

			form.append('descripcion', $('#txtDescripcion').val());
			form.append('familia', $('#cmbFamilia2').val());
			form.append('estado', $('#cmbEstado').val());
			form.append('image',  $('#fileFamilia3').get(0).files[0]);

			return $.ajax({
				type:'POST',
				url:BASE_PATH +'familia3/crearfamilia3',
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

			form.append('id', $('#tblFamilia3').find('.selectedRow').data('id'));
			form.append('descripcion', $('#txtDescripcion').val());
			form.append('familia', $('#cmbFamilia2').val());
			form.append('estado', $('#cmbEstado').val());
			form.append('image',  $('#fileFamilia3').get(0).files[0]);

			return $.ajax({
				type:'POST',
				url:BASE_PATH +'familia3/actualizarfamilia3',
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
				url:BASE_PATH +'familia3/borrarfamilia3',
				data:data,
				dataType:'JSON'
			});
		},

		RellenarTabla:function(tbl){
			APP.Entities.Familia3.listaDeFamilia3({}).success(function(res){
				$.each(res, function(key, val){
					$(tbl).append('<tr data-id="'+val.id+'"><td>'+val.id+'</td><td>'+val.descripcion+'</td><td data-idfamilia="'+val.idfamilia+'">'+val.familia+'</td><td><a href="'+val.urlimg+'" target="_blank"><span class="icon-image2"> </span></a></td><td data-idestado="'+val.idestado+'">'+val.descripcionestado+'</td></tr>');
				});

				APP.util.fixheader(tbl);
			});

		},

		RellenarCombo : function(cmb){
			APP.Entities.Familia3.listaDeFamilia3({}).success(function(res){
				$.each(res, function(key, val){
					cmb.append('<option value="'+val.id+'">'+val.descripcion+'</option>');
				});
			});
		}
	}
})