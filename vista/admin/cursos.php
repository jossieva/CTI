<?php 
require_once '../../modelo/modelo.php';
$objeto= new Modelo;

$arrUnidad = $objeto->getUnidad1();
	
?>	
	<div class="row" id="twoSectionC">
		<div class="col-md-12 titleActivityAd">
			<h2 align="center">Listado de Cursos</h2>
		</div>
		<ol class="breadcrumb" style="margin: 0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Cursos</li>
		  <span class="pull-right btn1 regresarActividad" style="font-size: 1.5rem"><i class='fa fa-chevron-left'><a href='index.php' > Regresar</a> </i></span>
		</ol>		
	</div>
	<div class="cargando text-center"></div>
	<div class="row" id="threeSectionC">
			<table class="table table-responsive table-hover">
				<thead>
					<tr class="titleSectionGeneral" style="background: #005747;margin-top: -20px; color: #fff">
						
					</tr>
					<tr>
						<th></th>
						<th>Curso</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody class="actividadesCurso">

				</tbody>
			</table>
		</div>
</div>