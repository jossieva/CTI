<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrJornada=$objeto->getJornada();
$arrCarrera=$objeto->getCarrera();
?>	
<div class="row" id="threeSection" >
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Carreras</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
	<div class="row" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de registro de Carrera</h2>
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formCreateCarrera" method="post" action="">
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label">Jornada:</label>
					</div>
					<div class="col-md-8 f1">
						<select name="jornadaC" class="form-control " required><span style="color: red">*</span>
							<option class="nombreJornada">--Seleccione--</option>
							<?php 
								if($arrJornada){
									foreach($arrJornada as $data){
										echo "<option value=".$data['COD_JORNADA'].">".$data['JORNADA']."</option>";
									}
								}
							?>
						</select>
						
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label"> Nombre de la Carrera:</label>
					</div>
					<div class="col-md-8 f1">
						<input type="hidden" value="" name="idCarrera"  class="form-control idCarrera" />
						<input type="text" value="" name="carrera"  class="form-control nombreCarrera"  placeholder="Ingrese el nombre de la carrera a ingresar..."/>
					</div>
				</div>
				<br />
				<div class="col-md-12 text-center btns f1">
		        		<a href="#" class="btn btn-success submitCreateCarrera">Crear Carrera <i class="fa fa-disc"></i></a>
		      	</div>
				
			</form>
		</div>
	</div><br />
	<div class="cargando text-center"></div>
	<div class="row" id="threeSection">
		<h3 align="center" style="background: #005747;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">CARRERAS EXISTENTES EN EL ESTABLECIMIENTO</h3>
			<table id="carrera3" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
		            <tr>
		            	<th align="center">Jornada</th>
		                <th align="center">Nombre de la Carrera</th>
						<th align="center"></th>
		            </tr>
		        </thead>
		        <tbody>
		           <?php
						if($arrCarrera){
							foreach($arrCarrera as $data){
								echo "<tr><td>".$data['JORNADA']."</td>";
								echo "<td>".$data['NOMBRE_CARRERA']."</td>";
								echo "<td align='center'>
								<a href='#' onclick=modificarC('".$data['COD_CARRERA']."') ><i class='fa fa-pencil' style='color:#4c24c9'></i>
								<a href='#' onclick=deleteC('".$data['COD_CARRERA']."','carreras') ><i class='fa fa-trash' style='color:#f00'></i></a>								
								</td></tr>";
							}
						}
					?>
		            
		        </tbody>
		    </table>
		</div>