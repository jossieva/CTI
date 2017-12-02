 $(document).ready(function(){		
    	$('#cursosAsignados').DataTable({
	        "scrollY":        "150vh",
	        "scrollCollapse": true,
	        "paging":         true,
	         "language": {
					   "zeroRecords": "No se encontraron registros",
					   "info": "",
					   "infoEmpty": "No hay registros disponibles",
					   "paginate":{"previous":"Anterior",
					   "next":"Siguiente"},
					   "search": "Buscar",
					   "infoFiltered": "(filtro de un total de _MAX_ registros)"
				    }
	   		 });
    });
    function deleteC(id,catalogo,curso){
							 var parametros = {
					                "id" : id,
					                "catalogo": catalogo,
					                "curso": curso
					        };					        
					         bootbox.confirm({
						        message: "Está seguro que desea eliminar el registro?",
						        buttons: {
						            confirm: {
						                label: 'Si',
						                className: 'btn-success'
						            },
						            cancel: {
						                label: 'No',
						                className: 'btn-danger'
						            }
						        },
						        callback: function (result) {
						        	if(result==true){
						        		 $.ajax({
											url:'../CTI/controlador/controladorUsuarios.php?seccion=deleteC',
											type:'POST',
											data: parametros,
											dataType:'json',
											success:function(data){
												$.each(data, function(e,i){
														bootbox.alert({
															size: "small",
															  message: i, 
															});
														$(".actividadesCurso").load('../CTI/controlador/controladorPersonal.php?seccion=listarActividades',{'idCursoView':curso}).html();												
														//redirectPage1(catalogo,curso);																									
												});													
											}
										});	
						        	}
						            console.log('This was logged in the callback: ' + result);
						        }
						    });
						}
	function redirectPage3(page,curso,actividad){
		$.get("vista/personal/"+page+".php", function(data){
		$('#pageSecond').html(data).trigger("create");
			/*
			 * seccion de ingreso de notas por actividades
			 */	
			if(page==="notaActividad"){							
				$(".nombreAlumnos").load('../CTI/controlador/controladorPersonal.php?seccion=listarAlumnos',{'idCursoView':curso,'idActividad':actividad}).html();				
				$(".encabezado").load('../CTI/controlador/controladorPersonal.php?seccion=actividadNota',{'idCursoView':curso,'idActividad':actividad}).html();
				$(".regresarActividad").load('../CTI/controlador/controladorPersonal.php?seccion=mostraRegreso',{'idCursoView':curso,'idActividad':actividad}).html();
			}	
		},'html');
	}
	function redirectPage4(page,curso){
		$.get("vista/personal/"+page+".php", function(data){
		$('#pageSecond').html(data).trigger("create");
			/*
			 * seccion de muestra de notas por actividad
			 */	
			if(page==="notasCurso"){							
				$(".nombreAlumnos").load('../CTI/controlador/controladorNotas.php?seccion=listarAlumnos',{'idCursoView':curso}).html();				
				$(".titleSectionC").load('../CTI/controlador/controladorPersonal.php?seccion=listarCursoN',{'idCursoView':curso}).html();
				$('.imprimirNC').attr('href','../CTI/vista/reportes/notasActividades.php?curso='+curso);
			}
			/*
			 * seccion de muestra de notas por unidad
			 */	
			if(page==="notasUnidad"){							
				$(".nombreAlumnos").load('../CTI/controlador/controladorNotas.php?seccion=listarAlumnosGeneral',{'idCursoView':curso}).html();				
				$(".titleSectionGeneral").load('../CTI/controlador/controladorPersonal.php?seccion=listarCursoU',{'idCursoView':curso}).html();
				$('.imprimirNU').attr('href','../CTI/vista/reportes/notasUnidad.php?curso='+curso);
			}
		},'html');
	}
    function redirectPage1(page,curso){
				$.get("vista/personal/"+page+".php", function(data){
					$('#pageSecond').html(data).trigger("create");	
					/*
					 * sección de manipulación del DOM y procesos de actividades
					 */
					if(page==="actividades"){
					$("#actividad").autocomplete({						
				        source: "../CTI/controlador/controladorActividades.php?seccion=autocompletar&curso="+curso,
				        minLength: 6
				    });
					$("#actividad").focusout(function(){
			     	var noActividad=$('#actividad').val();
			        $.ajax({
			            url:'../CTI/controlador/controladorActividades.php?seccion=actividadAspectos',
			            type:'POST',
			            dataType:'json',
			            data:{actividad:noActividad,curso:curso}
			        }).done(function(respuesta){
			        	var nombre,descripcion,fecha,aspecto,punteo="";			        	
			        	$.each(respuesta, function(b,llave){
			        		$.each(llave, function(c,d){	
			        			var longitud=c.length;			        					        	
			        			if(c=="NOMBRE_ACTIVIDAD"){
									nombre=d;
									$('.nombreActividad').val(nombre);
								}
								if(c=="DESCRIPCION_ACTIVIDAD"){
									descripcion=d;
									$('.descripcionActividad').val(descripcion);
								}
								if(c=="FECHA_ACTIVIDAD"){
									fecha=d;
									$('.fechaEntrega').val(fecha);
								}
								if(c=="DESCRIPCION_ASPECTO"){
									aspecto=d;								
								}
								if(c=="PUNTEO"){										
									punteo=d;
									$('#filanohay').css('display','none');
									var fila = $('<tr class="filas"></tr>');
									var celda1= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="aspecto[detalle][nombre][]" value="'+aspecto+'" required/></td>');
									var celda2= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="aspecto[detalle][punteo][]" value="'+punteo+'" required/></td>');
									var celda3= $('<td><a class="delete"><span style="color:red;cursor:pointer" class="glyphicon glyphicon-remove"></span></a></td>');
									fila.append(celda1);
									fila.append(celda2);
									fila.append(celda3);
										
									$('#listado').append(fila);
									$('#aspecto,#punteo').val("");
									$('.delete').click(function(){
										$(this).parents('tr').remove();
										//total-=$(this).parents('tr').html();
										if ($('.filas').length===0){
										   $('#filanohay').css('display','');
										}
									});
								}
								
			        		});							     		
			        	});
			        	
			        });
			    });				    				
						$("#fechaEntrega,#fechaEntrega1").datepicker({
					  	 		dateFormat: 'yy-mm-dd',
					  	 	});
					  	 $('.cursoGrado').val(curso);
						$('.iconForm1,#formActivity').hide();
						$('.iconForm').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#formActivity').show();
							$('.iconForm1').show();
						});
						$('.iconForm1').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#formActivity').hide();
							$('.iconForm').show();
						});
						//reconoce el curso al que se le crearan actividades
						$(".titleSectionC").load('../CTI/controlador/controladorPersonal.php?seccion=listarCurso',{'idCursoView':curso}).html();
						//crear actividad
						$(".actividadesCurso").load('../CTI/controlador/controladorPersonal.php?seccion=listarActividades',{'idCursoView':curso}).html();
						// accion para crear actividades
						$('.submitCreateActividad').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorPersonal.php?seccion=createActivity',
									type:'POST',
									data: $('#formCreateActivity').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});												
												$('.form-control').val('');	
												redirectPage1('actividades',curso);																																					
										});									
									}
							});
						});	
						// acción para actualizar actividades
						$('.submitUpdateActividad').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorPersonal.php?seccion=updateActivity',
									type:'POST',
									data: $('#formCreateActivity').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});												
												$('.form-control').val('');	
												redirectPage1('actividades',curso);																																					
										});									
									}
							});
						});					
					}
				},'html');
			}
			function redirectPage2(page){
				$.get("vista/admin/"+page+".php", function(data){
					$('#pageSecond').html(data).trigger("create");
					/*
					 * Seccion de paginas 
					  */
					if(page==="newpassword"){
						$('.submitNewPass').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=newPass',
									type:'POST',
									data: $('#formNewPass').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});												
												window.location.href="logout.php";																									
										});									
									}
							});
						});	
					}
				},'html');
			}
    	