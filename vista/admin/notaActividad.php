<div class="row" id="twoSection">
		<div class="col-md-12 titleActivityAd">
			<h2 align="center">Notas por Actividad <span class="curso"></span></h2>
		</div>
		<ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Notas</li>
		  <span class="pull-right btn1 regresarActividades" style="font-size: 1.5rem"></span>
		</ol>
		<div class="col-md-12 alumnos">
			<form id="formCreateNote">
			<div class="row encabezado" style="background: #005747;margin-top: -20px;">
				
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
	function submitGrabarNotaActividadA(curso,people){
		$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
		$.ajax({
			url:'../CTI/controlador/controladorActividades.php?seccion=asignarNotas',
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
					redirectPage6('actividadesA',curso,people);																																					
				});																
			}
		});	
	};
	function submitUpdateNotaActividadA(curso,people){
		$('.cargando').html('<img src="../CTI/images/loading.gif" width="300px" />');	
		$.ajax({
			url:'../CTI/controlador/controladorActividades.php?seccion=actualizarNotas',
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
					redirectPage6('actividadesA',curso,people);																																					
				});
			}
		});
	};
</script>