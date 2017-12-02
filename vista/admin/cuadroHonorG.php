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
			<h2 align="center" style="color: #000"><strong>Cuadro de Honor</strong> </h2>
		</div>
		<ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Cuadro de Honor <span class="fa fa-trophy "></span></li>
		  <span class="pull-right btn1 regresarActividad" style="font-size: 1.5rem"><i class='fa fa-chevron-left'><a href='index.php' > Regresar</a> </i></span>
		</ol>
		<div class="col-md-12 alumnos">

				<p align="center">
					<span>
						<a class="btn btn-default" id="generaReporteCuadro">
							<i class="fa fa-print fa-3x" style="color: #529A04"></i><br />
							<i>Imprimir reporte</i>
							</a>
					</span>
				</p>
				

		</div>
</div><br />
