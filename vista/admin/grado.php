<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrGrado=$objeto->getGrado();
$arrCarrera=$objeto->getCarreraJ();
?>	
<div class="row" id="threeSection" >
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Grado</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
	<div class="row" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de registro de Grados</h2>
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formCreateGrado" method="post" action="">
				<div class="group-form" id="selectJornada">
					<div class="col-md-3 f1">
						<label class="control-label">Jornada:</label>
					</div>
					<div class="col-md-8 f1">
						<select name="jornadaC" class="form-control selectJornada" required>
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
				<div class="group-form" id="selectCarrera">
					<div class="col-md-3 f1">
						<label class="control-label">Carrera:</label>
					</div>
					<div class="col-md-8 f1">
						<select name="carreraC" class="form-control selectCarrera" >
							<option class="nombreCarrera">--Seleccione--</option>

						</select>						
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label"> Nombre del Grado:</label>
					</div>
					<div class="col-md-8 f1">
						<input type="hidden" value="" name="idGrado"  class="form-control idGrado" />
						<input type="text" value="" name="grado"  class="form-control nombreGrado"  placeholder="Ingrese el nombre del grado  a registrar..."/>
					</div>
				</div>
				<br />
				<div class="col-md-12 text-center btns f1">
		        		<a href="#" class="btn btn-success submitCreateGrado">Crear Grado <i class="fa fa-disc"></i></a>
		      	</div>
				
			</form>
		</div>
	</div><br />
	<div class="cargando text-center"></div>
	<div class="row" id="threeSection">
		<h3 align="center" style="background: #005747;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">GRADOS DE ESTUDIO</h3>
			<table id="grado3" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
		            <tr>
		            	<th align="center">Jornada</th>
		            	<th align="center">Nombre de la Carrera</th>
		                <th align="center">Nombre del Grado</th>
						<th align="center"></th>
		            </tr>
		        </thead>
		        <tbody>
		           <?php
						if($arrGrado){
							foreach($arrGrado as $data){
								echo "<tr><td>".$data['JORNADA']."</td>";
								echo "<td>".$data['NOMBRE_CARRERA']."</td>";
								echo "<td>".$data['NOMBRE_GRADO']."</td>";
								echo "<td align='center'>
								<a href='#' onclick=modificarG('".$data['COD_GRADO']."') ><i class='fa fa-pencil' style='color:#4c24c9'></i>
								<a href='#' onclick=deleteC('".$data['COD_GRADO']."','grado') ><i class='fa fa-trash' style='color:#f00'></i></a>							
								</td></tr>";
							}
						}
					?>
		            
		        </tbody>
		    </table>
		</div>