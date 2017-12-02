<?php 
	require_once '../../modelo/modelo.php';
	require_once('../../controlador/sesion.php');
	$objeto= new Modelo;
	confirmarlogeo();
	$iduser=$_SESSION['id'];
	$arrCurso=$objeto->getAsigCursoGrado($iduser);
?>
<div class="row" id="twoSectionC">
		<div class="col-md-12 titleSectionA">
			<h2 align="center">Reporte de Actividades<span class="curso"></span></h2>
		</div>
		<ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Actividades</li>
		  <span class="pull-right btn1 regresarActividad" style="font-size: 1.5rem"><i class='fa fa-chevron-left'><a href='index.php' > Regresar</a> </i></span>
		</ol>
		<div class="col-md-12 alumnos">
			<form id="formSearchActivity">
			<div class="row">
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label">Seleccione el Grado:</label>
					</div>
					<div class="col-md-8 f1">
						<select name="curso" class="form-control selectCurso" required><span style="color: red">*</span>
							<option class="nombreGrado">--Seleccione--</option>
							<?php								
								foreach ($arrCurso as $data){
							?>
								<option value="<?php echo $data['COD_CURSO'] ?>"><?php echo $data['NOMBRE_CURSO'] ?></option>
							<?php
								}
							?>
						</select>						
					</div>
				</div>			
			</div>
				<p align="center">
					<span>
						<a class="btn btn-default" href="../cti/vista/reportes/notasGenerales.php" target="_blank">
							<i class="fa fa-print fa-3x" style="color: #04369A"></i><br />
							<i>Generar Reporte</i>
							</a>
					</span>
				</p>
			</div>			
		    </form>
		</div>
</div><br />