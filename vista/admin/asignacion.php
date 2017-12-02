<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrCurso=$objeto->getCurso();
$arrCarrera=$objeto->getCarreraJ();
$arrUsuarios=$objeto->getUser();
$arrAsigCurso=$objeto->getAsigCatedratico();
?>	
<div class="row" id="threeSection" >
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Asignar Cursos</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
	<div class="row" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Asignación de cursos a Catedraticos</h2>
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formAsigCurso" method="post" action="">
				<div class="group-form" id="selectCatedratico">
					<div class="col-md-2 f1">
						<label class="control-label">Catedratico:</label>
					</div>
					<div class="col-md-10 f1">
						<select name="catedratico" class="form-control selectCatedratico" required><span style="color: red">*</span>
							<option class="nombreCatedratico">--Seleccione--</option>
							 <?php
						if($arrUsuarios){
							foreach($arrUsuarios as $data){
								if($data['NIVEL']=="Catedratico"){
									echo "<option value=".$data['COD_PERSONA'].">".$data['NOMBRE']." ".$data['APELLIDO']."</option>";
								}								
							}
						}
					?>	
						</select>
						
					</div>
				</div>
				<div class="group-form" id="selectJornada">
					<div class="col-md-2 f1">
						<label class="control-label">Jornada:</label>
					</div>
					<div class="col-md-2 f1">
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
					<div class="col-md-2 f1">
						<label class="control-label">Carrera:</label>
					</div>
					<div class="col-md-2 f1">
						<select name="carreraC" class="form-control selectCarrera" required><span style="color: red">*</span>
							<option class="nombreCarrera">--Seleccione--</option>
						</select>						
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label">Grado:</label>
					</div>
					<div class="col-md-2 f1">
						<select name="gradoAsig" class="form-control selectGrado" required><span style="color: red">*</span>
							<option class="nombreGrado">--Seleccione--</option>
						</select>						
					</div>
				</div>
				<br />
				
		      	<div class="row">
		      		<div class="cargando text-center"></div>
		      		<div class="group-form">
		      			<div class="col-md-4"></div>
		      			<div class="col-md-4 cursosAsig">
		      				
		      			</div>
		      		</div>		      		
		      	</div>
		      	<div class="col-md-12 text-center btns f1">
		        		<a href="#" class="btn btn-success submitAsigCurso">Asignar Cursos <i class="fa fa-disc"></i></a>
		      	</div>
				
			</form>
		</div>
	</div><br />
<div class="row" id="threeSection">
		<h3 align="center" style="background: #005747;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">ASIGNACION DE CURSOS</h3>
			<table id="asignacion" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
		            <tr>
		            	<th align="center">Nombre del catedratico</th>
		                <th align="center">Nombre del Curso</th>
						<th align="center"></th>
		            </tr>
		        </thead>
		        <tbody>
		           <?php
						if($arrAsigCurso){
							foreach($arrAsigCurso as $data){
								echo "<tr><td>".$data['NOMBRE']." ".$data['APELLIDO']."</td>";
								echo "<td>".$data['NOMBRE_CURSO']."</td>";
								echo "<td align='center'>								
								<a href='#' onclick=deleteC('".$data['COD_CURSO_GRADO']."','asignacion') ><i class='fa fa-trash' style='color:#f00'></i></a>								
								</td></tr>";
							}
						}
					?>
		            
		        </tbody>
		    </table>
		</div>
	