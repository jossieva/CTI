<?php 
	require_once '../CTI/modelo/modelo.php';
	require_once'sesion.php';
	 confirmarlogeo();
	 $iduser=$_SESSION['id'];
$objeto= new Modelo;

$arrEstudiante=$objeto->getEstudiante($iduser);
$arrCurso=$objeto->getAsigCursoGrado($iduser);
?>	
<div class="container-fluid" id="pagePrimary"  >
	<div class="row" id="fourSection"  >
		<div class="col-md-2 hidden-xs hidden-sm text-center">
			<img src="../CTI/images/logo.png" class="" height="100%" width="100%"/>
		</div>
		<div class="col-md-8 titleSectionP">
			<?php
			
				foreach ($arrEstudiante as $data) {
			?>
				<table class="display table compact table-hover table-responsive">
					<tr>
						<th colspan="2" style="background: #5cb85c; color: #fff; border-radius: 5px; font-weight: bold; font-style: italic">DATOS DEL ESTUDIANTE:<!--span class="pull-right"><a class="fa fa-pencil" href="#"></a></span--></th>	
					</tr>
					<tr>
						<th style="padding:4px">NOMBRE COMPLETO:</th>
						<td style="padding:2px"><?php echo $data['NOMBRE']." ".$data['APELLIDO']; ?></td>
					</tr>
					<tr>
						<th style="padding:4px">CORREO</th>
						<td style="padding:2px"><?php echo $data['CORREO']; ?></td>
					</tr>
					<tr>
						<th style="padding:4px">USUARIO.</th>
						<td style="padding:2px"><?php echo $data['USUARIO']; ?></td>
					</tr>
					<tr>
						<th style="padding:4px">GRADO.</th>
						<td style="padding:2px"><?php echo $data['NOMBRE_GRADO']; ?></td>
					</tr>
					<tr>
						<th style="padding:4px">CARRERA.</th>
						<td style="padding:2px"><?php echo $data['NOMBRE_CARRERA']; ?></td>
					</tr>
				</table>
			<?php
				}
			?>
			
	</div>
	<div class="col-md-2 col-sm-12 hidden-xs text-center">
			<img src="../CTI/images/student.png" class="img-responsive"  />
		</div>	
</div><br />
<div class="row" id="twoSection"  >	
		<div class="col-md-12" >
			<table class="table table-responsive table-hover" style="z-index: 200">
				<thead>
					<tr>
						<th class="col-md-12 titleSectionCE" colspan="3">
							<h3><i class="fa fa-caret-right"></i> Listado de Cursos </h3>
						</th>
					</tr>
				</thead>
				<tbody >
					<?php			
						foreach ($arrCurso as $data) {
					?>
					<tr>
						<td class="col-md-2 col-sm-2 col-xs-2">
							<i class="fa fa-book fa-3x"></i>
						</td>
						<td class="col-md-6 col-sm-6 col-xs-5">
							<span style="text-align: center;font-size: 2rem;border-bottom-style: solid; font-family:Arial, Helvetica, sans-serif;" ><?php echo $data['NOMBRE_CURSO']; ?></span><br />
						</td>
						<td class="col-md-4 col-sm-4 col-xs-2">
							<ul class="btn-group-xs" role="group">
								<li data-toggle="tooltip"  title="Creación de Actividades" class=" btn btn-default actividades fa fa-flag"><a onclick="redirectPageE('actividades','<?php echo $data['COD_CURSO_GRADO']; ?>','<?php echo $data['COD_PERSONA']; ?>')"> Actividades</a></li>
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
</div><br />
<div class="row" id="threeSection" style="background: transparent">	
		<div class="col-md-6 text-center" style="margin-top: 5px">
			<a class="btn btn-warning btn-block" onclick="redirectPageG('notasGeneral','<?php echo $iduser; ?>')">
				<i class="fa fa-sticky-note-o fa-3x"></i><br />
				<span>NOTAS GENERAL</span>
			</a>
		</div>
		<div class="col-md-6 text-center " style="margin-top: 5px">
			<a class="btn btn-info btn-block" onclick="redirectPageG('buscarActividad','<?php echo $iduser; ?>')" >
				<i class="fa fa-file-text-o fa-3x"></i><br />
				<span>ACTIVIDADES</span>
			</a>
		</div>
</div>
