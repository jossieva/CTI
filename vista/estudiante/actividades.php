<?php 
require_once '../../modelo/modelo.php';
$objeto= new Modelo;

$arrUnidad = $objeto->getUnidad1();
	
?>	
	<div class="row" id="twoSectionC">
		<div class="col-md-12 titleActivityE">
			<h2 align="center">Registro de Actividades</h2>
		</div>
		<ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Actividades</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
		<div class="col-md-12" id="formActivity">
			
		</div>
	</div>
	<div class="cargando text-center"></div>
	<div class="row" id="threeSectionC">
			<table class="table table-responsive table-hover">
				<thead>
					<tr>
						<th class="col-md-12 titleSectionCE" colspan="3">
							
						</th>
					</tr>
					<tr>
						
						<th class="col-md-4 col-sm-4 col-xs-5">Descripción</th>
						<th class="col-md-3 hidden-xs hidden-sm">Aspectos a Calificar</th>
						<th class="col-md-3" style="text-align: center">Nota</th>
						
					</tr>
				</thead>
				<tbody class="actividadesCurso">

				</tbody>
			</table>
		</div>
</div>