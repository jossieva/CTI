<div class="row" id="twoSectionC">
		<div class="col-md-12 titleActivity">
			<h2 align="center">Notas por Actividad <span class="curso"></span></h2>
		</div>
		<ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Notas</li>
		  <span class="pull-right btn1 regresarActividad" style="font-size: 1.5rem"></span>
		</ol>
		<div class="col-md-12 alumnos">
			<form id="formCreateNote">
			<div class="row encabezado" style="background: #04369a;margin-top: -20px;">
				
			</div>
			
			<table class="table">
				<thead>
					<th>No.</th>
					<th>Nombre del Alumno</th>
					<th>Punteo</th>
				</thead>
				<tbody class="nombreAlumnos">
					
				</tbody>
			</table>
			
		    </form>
		</div>
</div>
<script type="text/javascript">
	function submitGrabarNotaActividad(curso){
		$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
		$.ajax({
			url:'../CTI/controlador/controladorNotas.php?seccion=asignarNotas',
			type:'POST',
			data: $('#formCreateNote').serialize(),
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
	};
	function submitUpdateNotaActividad(curso){
		$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
		$.ajax({
			url:'../CTI/controlador/controladorNotas.php?seccion=actualizarNotas',
			type:'POST',
			data: $('#formCreateNote').serialize(),
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
	};
</script>