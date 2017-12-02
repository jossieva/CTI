<?php 
	require_once '../CTI/modelo/modelo.php';
	require_once'sesion.php';
	 confirmarlogeo();
	 $iduser=$_SESSION['id'];
$objeto= new Modelo;

$arrCatedratico=$objeto->getCatedratico($iduser);
$arrCurso=$objeto->getAsigCatedraticoCurso($iduser);
?>	
<div class="container-fluid" id="pageSecond" >
	<div class="row" id="oneSection" style="border-bottom: 10px solid #04369a">
		 <h3 align="center"><img src="../CTI/images/logo.png" width="100" height="100"> &nbsp;Colegio Tecnologico en Informatica</h3>
	</div><br />
	<div class="row" id="fourSection" >
		<div class="col-md-4 text-center" >
			<img src="../CTI/images/maestro.png" class="" height="100%" width="50%"/>
		</div>
		<div class="col-md-8 titleSectionP">
			<?php
			
				foreach ($arrCatedratico as $data) {
			?>
				<table class="display compact table table-hover table-responsive">
					<tr>
							<th colspan="2" style="background: #04369a; color: #fff; font-weight: bold; font-style: italic">DATOS PERSONALES:</th>
							
						</tr>
						<tr>
							<th>NOMBRE COMPLETO:</th>
							<td><?php echo $data['NOMBRE']." ".$data['APELLIDO']; ?></td>
						</tr>
						<tr>
							<th>NO. DPI.</th>
							<td><?php echo $data['NO_DPI']; ?></td>
						</tr>
						<tr>
							<th>CORREO</th>
							<td><?php echo $data['CORREO']; ?></td>
						</tr>
				</table>
			<?php
				}
			?>
			
		</div>
</div>
<div class="row" id="twoSection" style="border-bottom: 10px solid #04369a">
	<br />
		<div class="col-md-12 titleSectionP">
		
		<div class="col-md-12">
			<table class="table table-responsive table-hover">
				<thead>
					<tr>
						<th class="col-md-12 titleSectionC" colspan="3">
							<h3><i class="fa fa-caret-right"></i> Cursos Asignados </h3>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php			
						foreach ($arrCurso as $data) {
					?>
					<tr>
						<td class="col-md-2 col-sm-2 col-xs-2">
							<i class="fa fa-book fa-3x"></i>
						</td>
						<td class="col-md-6 col-sm-6 col-xs-5">
							<span style="text-align: center;font-size: 2rem;border-bottom-style: solid; font-family:Arial, Helvetica, sans-serif;" ><?php echo $data['NOMBRE_CURSO']; ?></span><br />
							<span style="font-style: italic"><?php echo $data['NOMBRE_GRADO']." / ".$data['NOMBRE_CARRERA']." / ".$data['JORNADA']; ?></span>
						</td>
						<td class="col-md-4 col-sm-4 col-xs-2">
							<ul class="btn-group-xs" role="group">
								<li data-toggle="tooltip"  title="Creación de Actividades" class=" btn btn-default actividades fa fa-check"><a onclick="redirectPage1('actividades','<?php echo $data['COD_CURSO_GRADO']; ?>')"> Actividades</a></li>
								<li data-toggle="tooltip"  title="Ver Notas" class="btn btn-default notas fa fa-sticky-note"><a disabled="disabled"  onclick="redirectPage4('notasCurso','<?php echo $data['COD_CURSO_GRADO']; ?>')"> Notas</a></li>
								<li data-toggle="tooltip"  title="Notas por actividads" class=" btn btn-default reporteCurso fa fa-list-alt" ><a href="#" onclick="redirectPage4('notasUnidad','<?php echo $data['COD_CURSO_GRADO']; ?>')"> General</a></li>
								<li data-toggle="tooltip"  title="Reporte Actividades" class="btn btn-default reporte fa fa-file-pdf-o"  ><a target="_blank"  href="../cti/vista/reportes/actividades.php?curso=<?php echo $data['COD_CURSO_GRADO']; ?>"> Reporte</a></li>
							</ul>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>

</div>		
</div>