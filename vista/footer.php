    <!-- jQuery -->
	    
	     <script src="../CTI/libs/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap Core JavaScript -->

    <script src="../CTI/libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        
    <script src="../CTI/js/jquery.validate.min.js" type="text/javascript"></script>
    
    <script src="../CTI/js/bootbox.min.js" type="text/javascript"></script>
    
    <!-- data table -->
    <script src="../CTI/js/jquery.dataTables.min.js" type="text/javascript"></script>
     <script src="../CTI/js/jquery-ui.min.js" type="text/javascript"></script>
    
    <script src="../CTI/js/administrador.js" type="text/javascript"></script>
    <script src="../CTI/js/catedratico.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
    	
    });
  	/*$('.btnListarNotas').click(function(){		
  		alert('click');				  	
			var curso =$(this).attr("alt");
			alert(curso);
			var unidad =$(this).attr("title");
					//$('#NotasCurso').modal();
							//$("#listActividadesNotas").load('../CTI/controlador/controladorEstudiante.php?seccion=listarActividadesEstudiantes',{'idCursoView':curso,'idUnidad':unidad});			
					});*/	
      function redirectPageE(page,curso,persona){
				$.get("vista/estudiante/"+page+".php", function(data){
					$('#pagePrimary').html(data).trigger("create");
					if(page==="notasCurso"){
						$(".nombreAlumnos").load('../CTI/controlador/controladorPersonal.php?seccion=listarAlumno',{'idCursoView':curso}).html();	
					}			
					/*
					 * sección de manipulación del DOM y procesos de actividades
					 */
					if(page==="actividades"){
						//reconoce el curso al que se le crearan actividades
						$(".titleSectionCE").load('../CTI/controlador/controladorPersonal.php?seccion=listarCurso',{'idCursoView':curso}).html();
						//crear actividad
						$(".actividadesCurso").load('../CTI/controlador/controladorPersonal.php?seccion=listarActividadesEstudiantes',{'idCursoView':curso,'idEstudiante':persona}).html();
						
						$(".press").keypress(function(event){
							if(event.which == 13){
							cb = parseInt($(this).attr('tabindex'));
								if ( $(':input[tabindex=\'' + (cb + 1) + '\']') != null) {
								$(':input[tabindex=\'' + (cb + 1) + '\']').focus();
								$(':input[tabindex=\'' + (cb + 1) + '\']').select();
								return false;
								}
							}
						});
											
					}
				},'html');
			}
			 		
			function redirectPageG(page, user){
				$.get("vista/estudiante/"+page+".php", function(data){
					$('#pagePrimary').html(data).trigger("create");
								
					/*
					 * sección de manipulación del DOM y procesos de actividades
					 */
									
					if(page==="notasGeneral"){							
						$(".nombreAlumnos").load('../CTI/controlador/controladorEstudiante.php?seccion=listarNotas',{'idUser':user}).html();
						
					}
					if(page==="buscarActividad"){
						$('.selectCurso').change(function(){
							var curso =$(this).val();
							$(".actividadesCurso").load('../CTI/controlador/controladorPersonal.php?seccion=listarActividadesP',{'idCursoView':curso}).html();
						});
					}
				},'html');
			}
    </script>	
</body>
</html>