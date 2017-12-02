<?php 
	require_once '../../modelo/modelo.php';
	require_once('../../controlador/sesion.php');
	$objeto= new Modelo;
	confirmarlogeo();
	$iduser=$_SESSION['id'];
	$arrCurso=$objeto->getAsigCursoGrado($iduser);
	$arrCurso=$objeto->getCurso();
	$arrCarrera=$objeto->getCarreraJ();
	
	
?>
<div class="row" id="twoSectionC">
		<div class="col-md-12 titleSectionA">
			<h2 align="center"><strong>Reporte de Notas</strong></h2>
		</div>
		<ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Notas</li>
		  <span class="pull-right btn1 regresarActividad" style="font-size: 1.5rem"><i class='fa fa-chevron-left'><a href='index.php' > Regresar</a> </i></span>
		</ol>
		<div class="col-md-12 alumnos">
			<form id="formSearchActivity" method="get" >
			<section>
			        <div class="group-form" id="selectJornada">
					<div class="col-md-3 f1">
						<label class="control-label">Jornada:</label>
					</div>
					<div class="col-md-8 f1">
						<select name="jornadaC" class="form-control selectJornada" required><span style="color: red">*</span>
							<option class="nombreJornada">--Seleccione--</option>
							<?php 
								if($arrCarrera){
									foreach($arrCarrera as $data){
										echo "<option value=".$data['COD_JORNADA'].">".$data['JORNADA']."</option>";
									}
								}
							?>
						</select>
						
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label">Carrera:</label>
					</div>
					<div class="col-md-8 f1">
						<select name="carreraC" class="form-control selectCarrera" required><span style="color: red">*</span>
							<option class="nombreCarrera">--Seleccione--</option>
						</select>						
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label">Grado:</label>
					</div>
					<div class="col-md-8 f1">
						<select name="grado" class="form-control selectGrado" required><span style="color: red">*</span>
							<option class="nombreGrado">--Seleccione--</option>
						</select>						
					</div>
				</div>
              	</section>
				<p align="center">
					<span>
						<a class="btn btn-default" id="generaReporteNotas">
							<i class="fa fa-print fa-3x" style="color: #04369A"></i><br />
							<i>Generar Reporte</i>
							</a>
					</span>
				</p>
			</div>			
		    </form>
		</div>
</div><br />
