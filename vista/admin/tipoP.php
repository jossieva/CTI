<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrPersona=$objeto->getTipoP();
?>	
<div class="row" id="threeSection" >
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Tipo de Persona</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
	<div class="row" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de Registro de Tipo de Personas</h2>
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formCreateTipoP" method="post" action="">
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label"> Tipo de Persona:</label>
					</div>
					<div class="col-md-8 f1">
						<input type="hidden" value="" name="idTipoP"  class="form-control idTipoP" />
						<input type="text" value="" name="tipoP"  class="form-control nombreTipoP"  placeholder="Ingrese el nombre del grado  a registrar..."/>
					</div>
				</div>
				<br />
				<div class="col-md-12 text-center btns f1">
		        		<a href="#" class="btn btn-success submitCreateTipoP">Crear Tipo de Persona <i class="fa fa-disc"></i></a>
		      	</div>
				
			</form>
		</div>
	</div><br />
	<div class="cargando text-center"></div>
	<div class="row" id="threeSection">
		<h3 align="center" style="background: #005747;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">TIPO DE PERSONAS DEL SISTEMA</h3>
			<table id="tipoP3" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
		            <tr>
		                <th align="center">Tipo de Persona</th>
						<th align="center"></th>
		            </tr>
		        </thead>
		        <tbody>
		           <?php
						if($arrPersona){
							foreach($arrPersona as $data){
								echo "<tr><td>".$data['TIPO_PERSONA']."</td>";
								echo "<td align='center'>
								<a href='#' onclick=modificarTipo('".$data['COD_TIPO_P']."') ><i class='fa fa-pencil' style='color:#4c24c9'></i>
								<a href='#' onclick=deleteC('".$data['COD_TIPO_P']."','tipoP') ><i class='fa fa-trash' style='color:#f00'></i></a>								
								</td></tr>";
							}
						}
					?>
		            
		        </tbody>
		    </table>
		</div>