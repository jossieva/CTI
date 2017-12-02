$(document).ready(function(){
	  		$('.btnListCur').click(function(){
					var grado =$(this).attr("alt");
					$("#listCursos").load('../CTI/controlador/controladorUsuarios.php?seccion=listarCursos',{'idGradoView':grado});			
			});
    		$('.btnListStudent').click(function(){
					var grado =$(this).attr("alt");
					$("#listStudent").load('../CTI/controlador/controladorEstudiante.php?seccion=listarEstudiantes',{'idGradoView':grado});			
			});
			$('.btnListCursos').click(function(){
					var grado =$(this).attr("alt");
					$("#listCatedraticosCursos").load('../CTI/controlador/controladorEstudiante.php?seccion=listarAsignaciones',{'idGradoView':grado});			
			});
			 
		   $('#jornadas3,#carrera3,#personal,#estudiantes').DataTable( {
	        "scrollY":        "70vh",
	        "scrollCollapse": true,
	        "paging":         false,
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
		} );
		function modificarEstado(unidad,estado){
			$('.idUnidadModal').val(unidad);
		}
	function redirectPageM(page, user){
		$.get("vista/admin/"+page+".php", function(data){
			$('#pagePrimary').html(data).trigger("create");
			if(page==="cursos"){
					$(".actividadesCurso").load('../CTI/controlador/controladorCatedraticos.php?seccion=listarCurso',{'idCatedratico':user}).html();
					$(".titleSectionGeneral").load('../CTI/controlador/controladorCatedraticos.php?seccion=mostrarCatedratico',{'idCatedratico':user}).html();
			}
		},'html');
	};
	function redirectPage8(page,curso,actividad){
		$.get("vista/admin/"+page+".php", function(data){
		$('#pagePrimary').html(data).trigger("create");
			/*
			 * seccion de ingreso de notas por actividades
			 */	
			if(page==="notaActividad"){							
				$(".nombreAlumnos").load('../CTI/controlador/controladorCatedraticos.php?seccion=listarAlumnos',{'idCursoView':curso,'idActividad':actividad}).html();				
				$(".encabezado").load('../CTI/controlador/controladorPersonal.php?seccion=actividadNota',{'idCursoView':curso,'idActividad':actividad}).html();
				$(".regresarActividades").load('../CTI/controlador/controladorCatedraticos.php?seccion=mostraRegreso',{'idCursoView':curso,'idActividad':actividad}).html();
			}	
		},'html');
	}
	function redirectPage7(page,curso,actividad){
		$.get("vista/personal/"+page+".php", function(data){
		$('#pagePrimary').html(data).trigger("create");
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
	function redirectPage5(page,curso,people){
		$.get("vista/admin/"+page+".php", function(data){
		$('#pagePrimary').html(data).trigger("create");
		var comillas='"';
			/*
			 * seccion de muestra de notas por actividad
			 */	
			if(page==="notasCurso"){							
				$(".nombreAlumnos").load('../CTI/controlador/controladorNotas.php?seccion=listarAlumnos',{'idCursoView':curso}).html();				
				$(".titleSectionC").load('../CTI/controlador/controladorPersonal.php?seccion=listarCursoN',{'idCursoView':curso}).html();
				$(".regresarCurso").html("<i class='fa fa-chevron-left'><a href='#' onclick="+comillas+"redirectPageM('cursos','"+people+"')"+comillas+"> Regresar</a> </i>");
				$('.imprimirNC').attr('href','../CTI/vista/reportes/notasActividades1.php?curso='+curso+'&&cat='+people);
			}
			/*
			 * seccion de muestra de notas por unidad
			 */	
			if(page==="notasUnidad"){							
				$(".nombreAlumnos").load('../CTI/controlador/controladorNotas.php?seccion=listarAlumnosGeneral',{'idCursoView':curso}).html();				
				$(".titleSectionGeneral").load('../CTI/controlador/controladorPersonal.php?seccion=listarCursoU',{'idCursoView':curso}).html();
				$(".regresarCurso").html("<i class='fa fa-chevron-left'><a href='#' onclick="+comillas+"redirectPageM('cursos','"+people+"')"+comillas+"> Regresar</a> </i>");
				$('.imprimirNU').attr('href','../CTI/vista/reportes/notasUnidad1.php?curso='+curso+'&&cat='+people);
			}
		},'html');
	}
	 function deleteCA(id,catalogo,curso){
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
														$(".actividadesCurso").load('../CTI/controlador/controladorCatedraticos.php?seccion=listarActividades',{'idCursoView':curso}).html();												
														//redirectPage1(catalogo,curso);																									
												});													
											}
										});	
						        	}
						            console.log('This was logged in the callback: ' + result);
						        }
						    });
						}
		function deleteC(id,catalogo){
							 var parametros = {
					                "id" : id,
					                "catalogo": catalogo
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
													redirectPage(catalogo);																											
												});		
																							
											}
										});	
						        	}
						            console.log('This was logged in the callback: ' + result);
						        }
						    });
						}
		function modificarEstudiante(id){
			$('#oneSection1').show();
			$('#twoSection').hide();
				$('.btns').empty();	
						$.post('../CTI/controlador/controladorUsuarios.php?seccion=modificarEstudiante',{'idM':id},function(result){
							var modi=result;
							var id,nombre,apellido,correo="";
							$.each(modi,function(i,e){
								$.each(e, function(a,b){
									if(a=="COD_PERSONA"){
										id=b;
										$('.idEstudiante').val(id);
									}
									if(a=="NOMBRE"){
										nombre=b;
										$('.nombres').val(nombre);
									}
									if(a=="APELLIDO"){
										apellidos=b;
										$('.apellidos').val(apellidos);
									}
									if(a=="CORREO"){
										correo=b;
										$('.correo').val(correo);
									}
								});								
							});		
						},"json");
					var page="'estudiante'";
					var cancelar= '<a class="btn btn-warning cancelAct" onclick="redirectPage('+page+')">Cancelar</a>';
					var actualizar= '<a class="btn btn-success updateStudent">Actualizar Estudiante</a> ';				
					$('.btns').append(actualizar,cancelar);
					
					//actualizar curso
						$('.updateStudent').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=updateStudent',
									type:'POST',
									data: $('#formUpdateStudent').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('estudiante');																									
										});									
									}
							});
						});
											
				}
		function modificarPersonal(id){
			$('#twoSection').show();
			$('.usuarioP').hide();
				$('.btns').empty();	
						$.post('../CTI/controlador/controladorUsuarios.php?seccion=modificarEstudiante',{'idM':id},function(result){
							var modi=result;
							var id,nombre,apellido,dpi,correo="";
							$.each(modi,function(i,e){
								$.each(e, function(a,b){
									if(a=="COD_PERSONA"){
										id=b;
										$('.idPersonal').val(id);
									}
									if(a=="NOMBRE"){
										nombre=b;
										$('.nombresP').val(nombre);
									}
									if(a=="APELLIDO"){
										apellidos=b;
										$('.apellidosP').val(apellidos);
									}
									if(a=="CORREO"){
										correo=b;
										$('.correoP').val(correo);
									}
									if(a=="NO_DPI"){
										dpi=b;
										$('.dpiP').val(dpi);
									}
								});								
							});		
						},"json");
					var page="'personal'";
					var cancelar= '<a class="btn btn-warning cancelAct" onclick="redirectPage('+page+')">Cancelar</a>';
					var actualizar= '<a class="btn btn-success updatePersonal">Actualizar Catedratico</a> ';				
					$('.btns').append(actualizar,cancelar);
					
					//actualizar curso
						$('.updatePersonal').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=updatePersonal',
									type:'POST',
									data: $('#formCreatePersonal').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('personal');																									
										});									
									}
							});
						});
											
				}
		function modificarC(id){
			$('.btns').empty();	
						$.post('../CTI/controlador/controladorUsuarios.php?seccion=modificarC',{'idM':id},function(result){
							var modi=result;
							var id,nombre,codJornada,jornada="";
							$.each(modi,function(i,e){
								$.each(e, function(a,b){
									if(a=="COD_CARRERA"){
										id=b;
										$('.idCarrera').val(id);
									}
									if(a=="NOMBRE_CARRERA"){
										nombre=b;
										$('.nombreCarrera').val(nombre);
									}
									if(a=="COD_JORNADA"){
										codJornada=b;
										$('.nombreJornada').val(codJornada);
									}
									if(a=="JORNADA"){
										jornada=b;
										$('.nombreJornada').text(jornada);
									}
								});								
							});		
						},"json");
					var page="'carreras'";
					var cancelar= '<a class="btn btn-warning cancelAct" onclick="redirectPage('+page+')">Cancelar</a>';
					var actualizar= '<a class="btn btn-success updateCarrera">Actualizar Carrera</a> ';						
					$(".submitCreateCarrera").remove();
					$('.btns').append(actualizar,cancelar);
					
					$('.updateCarrera').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=updateCarrera',
									type:'POST',
									data: $('#formCreateCarrera').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('carreras');																									
										});									
									}
							});
						});
					
					
				}
		function modificarJ(id){
				$('.btns').empty();	
						$.post('../CTI/controlador/controladorUsuarios.php?seccion=modificarJ',{'idM':id},function(result){
							var modi=result;
							var id,nombre="";
							$.each(modi,function(i,e){
								$.each(e, function(a,b){
									if(a=="COD_JORNADA"){
										id=b;
										$('.idJornada').val(id);
									}
									if(a=="JORNADA"){
										nombre=b;
										$('.nombreJornada').val(nombre);
									}
								});								
							});		
						},"json");
					var page="'jornadas'";
					var cancelar= '<a class="btn btn-warning cancelAct" onclick="redirectPage('+page+')">Cancelar</a>';
					var actualizar= '<a class="btn btn-success updateJornada">Actualizar Jornada</a> ';
					$(".submitCreateJornada").remove();					
					$('.btns').append(actualizar,cancelar);
					
					//actualizar jornada
						$('.updateJornada').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=updateJornada',
									type:'POST',
									data: $('#formCreateJornada').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('jornadas');																									
										});									
									}
							});
						});
											
				}
				
		function modificarCurso(id){
			$('#oneSection1').show();
			$('#twoSection1').hide();
				$('.btns').empty();	
						$.post('../CTI/controlador/controladorUsuarios.php?seccion=modificarCur',{'idM':id},function(result){
							var modi=result;
							var id,nombre="";
							$.each(modi,function(i,e){
								$.each(e, function(a,b){
									if(a=="COD_CURSO"){
										id=b;
										$('.idCurso').val(id);
									}
									if(a=="NOMBRE_CURSO"){
										nombre=b;
										$('.nombreCurso').val(nombre);
									}
								});								
							});		
						},"json");
					var page="'curso'";
					var cancelar= '<a class="btn btn-warning cancelAct" onclick="redirectPage('+page+')">Cancelar</a>';
					var actualizar= '<a class="btn btn-success updateCurso">Actualizar Curso</a> ';				
					$('.btns').append(actualizar,cancelar);
					
					//actualizar curso
						$('.updateCurso').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=updateCurso',
									type:'POST',
									data: $('#formCreateCurso').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('curso');																									
										});									
									}
							});
						});
											
				}
		function modificarG(id){
						$('.btns').empty();	
						$('#selectJornada').remove();
						$('#selectCarrera').hide();
						$.post('../CTI/controlador/controladorUsuarios.php?seccion=modificarG',{'idM':id},function(result){
							var modi=result;
							var id,nombre,cod,carrera="";
							$.each(modi,function(i,e){
								$.each(e, function(a,b){
									if(a=="COD_GRADO"){
										id=b;
										$('.idGrado').val(id);
									}
									if(a=="NOMBRE_GRADO"){
										nombre=b;
										$('.nombreGrado').val(nombre);
									}
									if(a=="COD_CARRERA"){
										cod=b;
										$('.nombreCarrera').val(cod);
									}
									if(a=="NOMBRE_CARRERA"){
										carrera=b;
										$('.nombreCarrera').text(carrera);
									}
								});								
							});		
						},"json");
					var page="'grado'";
					var cancelar= '<a class="btn btn-warning cancelAct" onclick="redirectPage('+page+')">Cancelar</a>';
					var actualizar= '<a class="btn btn-success updateGrado">Actualizar Grado</a>  ';
					$(".submitCreateGrado").remove();					
					$('.btns').append(actualizar,cancelar);
					
					$('.updateGrado').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=updateGrado',
									type:'POST',
									data: $('#formCreateGrado').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('grado');																									
										});									
									}
							});
						});
					
								
				}				

		function modificarTipo(id){
			$('.btns').empty();	
						$.post('../CTI/controlador/controladorUsuarios.php?seccion=modificarTipo',{'idM':id},function(result){
							var modi=result;
							var id,nombre="";
							$.each(modi,function(i,e){
								$.each(e, function(a,b){
									if(a=="COD_TIPO_P"){
										id=b;
										$('.idTipoP').val(id);
									}
									if(a=="TIPO_PERSONA"){
										nombre=b;
										$('.nombreTipoP').val(nombre);
									}
								});								
							});		
						},"json");
					var page="'tipoP'";
					var cancelar= '<a class="btn btn-warning cancelAct" onclick="redirectPage('+page+')">Cancelar</a>';
					var actualizar= '<a class="btn btn-success updateTipoP">Actualizar Tipo de Persona</a> ';
					$(".submitCreateTipoP").remove();
					$('.btns').append(actualizar,cancelar);		
					
					$('.updateTipoP').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=updateTipoP',
									type:'POST',
									data: $('#formCreateTipoP').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('tipoP');																									
										});									
									}
							});
						});			
				}
			function modificarUni(id){
				$('.btns').empty();	
						$.post('../CTI/controlador/controladorUsuarios.php?seccion=modificarUni',{'idM':id},function(result){
							var modi=result;
							var id,nombre="";
							$.each(modi,function(i,e){
								$.each(e, function(a,b){
									if(a=="COD_UNIDAD"){
										id=b;
										$('.idUnidad').val(id);
									}
									if(a=="NOMBRE_UNIDAD"){
										nombre=b;
										$('.nombreUnidad').val(nombre);
									}
								});								
							});		
						},"json");
					var page="'unidad'";
					var cancelar= '<a class="btn btn-warning cancelAct" onclick="redirectPage('+page+')">Cancelar</a>';
					var actualizar= '<a class="btn btn-success updateUnidad">Actualizar Unidad</a> ';
					$(".submitCreateUnidad").remove();					
					$('.btns').append(actualizar,cancelar);		
					
					$('.updateUnidad').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=updateUnidad',
									type:'POST',
									data: $('#formCreateUnidad').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('unidad');																									
										});									
									}
							});
						});		
								
				}
		function redirectPage(page){
				$.get("vista/admin/"+page+".php", function(data){
					$('#pagePrimary').html(data).trigger("create");
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
					//pagina de reporte de notas por alumnos promedio
					if(page==="notasPromedio"){
						$('.selectJornada').change(function(){
							var jornada =$(this).val();						
							$(".selectCarrera").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarCarrera',{'idAso':jornada});							
						});
						
						$('.selectCarrera').change(function(){
							var carrera =$(this).val();					
							$(".selectGrado").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarGrado',{'idGradoAso':carrera});							
						});	
						
						$('#generaReportePromedio').click(function(){
							var jornada=$( ".selectJornada option:selected" ).val();
							var carrera=$( ".selectCarrera option:selected" ).val();
							var grado=$( ".selectGrado option:selected" ).val();
							if((grado>0)){
								var url='../cti/vista/reportes/notasPromedio.php?g='+grado+'&&c='+carrera+'&&j='+jornada;
								window.open(url, '_blank');
	      						return false;
							}else{							
								bootbox.alert({
									size: "small",
								    message: 'campo de grado obligatorio', 
								});								
							}
							
						});
					}
					//pagina de reporte de notas por alumnos promedio cuadro de honor 
					if(page==="cuadroHonor"){
						$('.selectJornada').change(function(){
							var jornada =$(this).val();						
							$(".selectCarrera").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarCarrera',{'idAso':jornada});							
						});
						
						$('.selectCarrera').change(function(){
							var carrera =$(this).val();					
							$(".selectGrado").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarGrado',{'idGradoAso':carrera});							
						});	
						$('#generaReporteCuadro').click(function(){
							var jornada=$( ".selectJornada option:selected" ).val();
							var carrera=$( ".selectCarrera option:selected" ).val();
							var grado=$( ".selectGrado option:selected" ).val();
							var unidad=$( ".selectUnidad option:selected" ).val();
							if((grado>0)&&(unidad>0)){
								var url='../cti/vista/reportes/cuadroHonor.php?g='+grado+'&&c='+carrera+'&&j='+jornada+'&&u='+unidad;
								window.open(url, '_blank');
	      						return false;
							}else{							
								bootbox.alert({
									size: "small",
								    message: 'Los campos de Unidad y grado son obligatorio', 
								});								
							}
							
						});
					}
					
					//pagina de reporte de notas por alumnos
					if(page==="notasUnidades"){
						$('.selectJornada').change(function(){
							var jornada =$(this).val();						
							$(".selectCarrera").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarCarrera',{'idAso':jornada});							
						});
						
						$('.selectCarrera').change(function(){
							var carrera =$(this).val();					
							$(".selectGrado").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarGrado',{'idGradoAso':carrera});							
						});	
						$('#generaReporteNotas').click(function(){
							var jornada=$( ".selectJornada option:selected" ).val();
							var carrera=$( ".selectCarrera option:selected" ).val();
							var grado=$( ".selectGrado option:selected" ).val();
							if((grado>0)){
								var url='../cti/vista/reportes/notasGrado.php?g='+grado+'&&c='+carrera+'&&j='+jornada;
								window.open(url, '_blank');
	      						return false;
							}else{							
								bootbox.alert({
									size: "small",
								    message: 'campo de grado obligatorio', 
								});								
							}
							
						});
						
						
					}
					//pagina de usuario					
					if(page==="usuario"){
						$('.submitNewPassUser').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=newPass1',
									type:'POST',
									data: $('#formNewPass1').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
											$('#updatePassUser').modal('hide');
												bootbox.alert({
														size: "small",
													  message: i, 
												});																							
										});									
									}
							});
						});	
						$('#formCreateUser').validate({
							rules:{
								nombres:"required",
								apellidos:"required",
								dpi:"number",
								tipo:"required",
								usuario:"required",
								clave:"required",
								rol:"required",
							},
							messages:{
								nombres:"Este campo es obligatorio.",
								apellidos:"Este campo es obligatorio",
								dpi:"Solo se aceptan números.",
								tipo:"Este campo es obligatorio.",
								usuario:"Este campo es obligatorio",
								clave:"Este campo es obligatorio",
								rol:"Este campo es obligatorio",
							}
						});
						$('.iconForm1,#twoSection').hide();
						$('.iconForm').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#twoSection').show();
							$('.iconForm1').show();
						});
						$('.iconForm1').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#twoSection').hide();
							$('.iconForm').show();
						});
						var table = $('#usuarios3,#usuarios2,#usuarios1').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "100vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
					   	$('.submitCreateUser').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=createUser',
									type:'POST',
									data: $('#formCreateUser').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});												
												$('.form-control').val('');	
												redirectPage('usuario');																									
										});									
									}
							});
						});	
					   	
					}
					
					if(page==="jornadas"){
						var table = $('#jornadas3').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "70vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
					   	//crear jornada
					   	$('.submitCreateJornada').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=createJornada',
									type:'POST',
									data: $('#formCreateJornada').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('jornadas');																									
										});									
									}
							});
						});
					}
					if(page==="carreras"){
						$('#formCreateCarrera').validate({
							rules:{
								carrera:"required",
							},
							messages:{
								carrera:"Este campo es obligatorio.",
							}
						});
						var table = $('#carrera3').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "70vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
					   	$('.submitCreateCarrera').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=createCarrera',
									type:'POST',
									data: $('#formCreateCarrera').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('carreras');																									
										});									
									}
							});
						});
					}
				if(page==="grado"){
						$('#formCreateGrado').validate({
							rules:{
								grado:"required",
							},
							messages:{
								grado:"Este campo es obligatorio.",
							}
						});
						var table = $('#grado3').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "70vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
					   	$('.submitCreateGrado').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=createGrado',
									type:'POST',
									data: $('#formCreateGrado').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('grado');																									
										});									
									}
							});
						});
						$('.selectJornada').change(function(){
							var jornada =$(this).val();
							$(".selectCarrera").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarCarrera',{'idAso':jornada});
						});					
					}
				if(page==="curso"){
					$('.iconForm1,#twoSection1,#oneSection1').hide();
						$('.iconForm').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#twoSection1').show();
							$('.iconForm1').show();
							$('#oneSection1').hide();
						});
						$('.iconForm1').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#twoSection1').hide();
							$('.iconForm').show();
							$('#oneSection1').hide();
						});					
					
						$('#formCreateCurso').validate({
							rules:{
								curso:"required",
							},
							messages:{
								curso:"Este campo es obligatorio.",
							}
						});
						var table = $('#curso3').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "70vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
					   	$('a[href="#finish"]').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorCurso.php?seccion=createCurso',
									type:'POST',
									data: $('#formCreateCurso1').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('curso');																									
										});									
									}
							});
						});
						$('.selectJornada').change(function(){
							var jornada =$(this).val();						
							$(".selectCarrera").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarCarrera',{'idAso':jornada});							
						});
						
						$('.selectCarrera').change(function(){
							var carrera =$(this).val();					
							$(".selectGrado").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarGrado',{'idGradoAso':carrera});							
						});						
					}
					if(page==="asignacion"){
						var table = $('#asignacion').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "70vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
						$('.selectJornada').change(function(){
							var jornada =$(this).val();						
							$(".selectCarrera").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarCarrera',{'idAso':jornada});							
						});
						
						$('.selectCarrera').change(function(){
							var carrera =$(this).val();					
							$(".selectGrado").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarGrado',{'idGradoAso':carrera});							
						});
						$('.selectGrado').change(function(){
							var carrera =$(this).val();					
							$(".cursosAsig").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarCurso',{'idCursoAso':carrera});							
						});
						$('.submitAsigCurso').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorCurso.php?seccion=asignarCatedratico',
									type:'POST',
									data: $('#formAsigCurso').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.selectGrado').val('');	
												redirectPage('asignacion');																									
										});									
									}
							});
						});
					}
					if(page==="unidad"){
						$('#formCreateUser').validate({
							rules:{
								unidad:"required",
							},
							messages:{
								unidad:"Este campo es obligatorio.",
							}
						});
						$('#actualizarEstado').click(function(e){
							e.preventDefault();
							$('#updateState').modal('hide');
							var unidad=$('.idUnidadModal').val();
							var estado=$('input:radio[name=idEstadoUnidad]:checked').val();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
								url:'../CTI/controlador/controladorUsuarios.php?seccion=updateStateUnited',
								type:'POST',
								data: $('.updateStateUnite').serialize(),
								dataType:'json',
								success:function(data){
									$('.cargando').empty();
									$.each(data, function(e,i){
										
										bootbox.alert({
													size: "small",
													  message: i, 
										});	
									$('.form-control').val('');	
									redirectPage('unidad');																									
									});	
								}
						});
									
				
								});
						var table = $('#unidad3').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "70vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
					   	
					   	$('.submitCreateUnidad').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=createUnidad',
									type:'POST',
									data: $('#formCreateUnidad').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});												
												$('.form-control').val('');	
												redirectPage('unidad');																									
										});									
									}
							});
						});
					}
					if(page==="tipoP"){						
						$('#formCreateUser').validate({
							rules:{
								tipoP:"required",
							},
							messages:{
								tipoP:"Este campo es obligatorio.",
							}
						});
						var table = $('#tipoP3').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "70vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
					   	$('.submitCreateTipoP').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=createTipoP',
									type:'POST',
									data: $('#formCreateTipoP').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});												
												$('.form-control').val('');	
												redirectPage('tipoP');																									
										});									
									}
							});
						});
					}
				if(page==="personal"){
					$('.iconForm1,#twoSection').hide();
						$('.iconForm').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#twoSection').show();
							$('.iconForm1').show();
						});
						$('.iconForm1').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#twoSection').hide();
							$('.iconForm').show();
						});
						var table = $('#usuarios2').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "100vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
					$("#usuarioP").focusout(function(e){
							 $("#resultado,#clave").empty();
				             //obtenemos el texto introducido en el campo			             
				                   verificar = $("#usuarioP").val();    		                                           
				                        $.ajax({
				                              type: "POST",
				                              url: '../CTI/controlador/validateUser.php',
				                              data: "b="+verificar,
				                              dataType: "html",
				                              success:function(data){      
				                                    $("#resultado").append(data);
				                                    $("#clave").val(verificar);   
				                              }
				                  });		                                
				      	});
				    $('.submitCreatePersonal').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorUsuarios.php?seccion=createPersonal',
									type:'POST',
									data: $('#formCreatePersonal').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});												
												$('.form-control').val('');	
												redirectPage('personal');																									
										});									
									}
							});
						});	
				}	
				if(page==="estudiante"){
					var verificar;
					$('.selectJornada').change(function(){
							var jornada =$(this).val();						
							$(".selectCarrera").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarCarrera',{'idAso':jornada});							
						});
						
						$('.selectCarrera').change(function(){
							var carrera =$(this).val();					
							$(".selectGrado").load('../CTI/controlador/controladorUsuarios.php?seccion=llenarGrado',{'idGradoAso':carrera});							
						});	

					$("#usuario").focusout(function(e){
						 $("#resultado,#clave").empty();
			             //obtenemos el texto introducido en el campo			             
			                   verificar = $("#usuario").val();    		                                           
			                        $.ajax({
			                              type: "POST",
			                              url: '../CTI/controlador/validateUser.php',
			                              data: "b="+verificar,
			                              dataType: "html",
			                              success:function(data){      
			                                    $("#resultado").append(data);
			                                    $("#clave").val(verificar);   
			                              }
			                  });		                                
			      	});	
			      	$('a[href="#finish"]').click(function(e){
							e.preventDefault();
							$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
							$.ajax({
									url:'../CTI/controlador/controladorEstudiante.php?seccion=createEstudiante',
									type:'POST',
									data: $('#formCreateEstudiantes').serialize(),
									dataType:'json',
									success:function(data){
										$('.cargando').empty();
										$.each(data, function(e,i){
												bootbox.alert({
														size: "small",
													  message: i, 
												});													
												$('.form-control').val('');	
												redirectPage('estudiante');																									
										});									
									}
							});
						});
				$('.iconForm1,#twoSection,#oneSection1').hide();
						$('.iconForm').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#twoSection').show();
							$('.iconForm1').show();
						});
						$('.iconForm1').click(function(e){
							e.preventDefault();
							$(this).hide();
							$('#twoSection').hide();
							$('.iconForm').show();
						});
						var table = $('#usuarios3').DataTable({
					      	"order": [[ 1, "desc" ]],
					      	"scrollY":        "100vh",
					        "scrollCollapse": true,
					        "paging":         false,
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
			      					
				}
				},'html');
			}
function redirectPage6(page,curso,people){
				$.get("vista/admin/"+page+".php", function(data){
					$('#pagePrimary').html(data).trigger("create");	
					/*
					 * sección de manipulación del DOM y procesos de actividades
					 */
					if(page==="actividadesA"){
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
						$(".actividadesCurso").load('../CTI/controlador/controladorCatedraticos.php?seccion=listarActividades',{'idCursoView':curso}).html();
						// regresar a cursos
						var comillas='"';
						$(".regresarCurso").html("<i class='fa fa-chevron-left'><a href='#' onclick="+comillas+"redirectPageM('cursos','"+people+"')"+comillas+"> Regresar</a> </i>");
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
												redirectPage6('actividadesA',curso,people);																																					
										});									
									}
							});
						});					
					}
				},'html');
			}		