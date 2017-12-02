<?php 
	require_once '../../modelo/modelo.php';
	require_once('../../controlador/sesion.php');
	$objeto= new Modelo;
	confirmarlogeo();
	$iduser=$_SESSION['id'];
	$arrCurso=$objeto->getAsigCursoGrado($iduser);
?>
<div class="row" id="twoSectionC">
		<div class="col-md-12 titleActivityE">
			<h2 align="center">Busqueda de actividades por curso<span class="curso"></span></h2>
		</div>
		<ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Busqueda de Actividades</li>
		  <span class="pull-right btn1 regresarActividad" style="font-size: 1.5rem"><i class='fa fa-chevron-left'><a href='index.php' > Regresar</a> </i></span>
		</ol>
		<div class="col-md-12 alumnos">
			<form id="formSearchActivity">
			<div class="row">
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label">Seleccione el Curso:</label>
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
		    </form>
		</div>
</div><br />
<div class="row" id="oneSection">
		<div class="col-md-12 titleActivityE">
			<h2 align="center">Actividades</h2>
		</div>
		<div class="col-md-12">
			<table class="table table-responsive table-hover">
				<thead>
					<tr>
						<th class="col-md-2 col-sm-2 col-xs-2">Punteo</th>
						<th class="col-md-4 col-sm-4 col-xs-5">Descripción</th>
						<th class="col-md-3 hidden-xs hidden-sm">Aspectos a Calificar</th>
					</tr>
				</thead>
				<tbody class="actividadesCurso">

				</tbody>
			</table>
		</div>
		
	</div>