<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrRoles=$objeto->getRol();
$arrTipoP=$objeto->getTipo();
$arrUsuarios=$objeto->getUser();
?>	
<div class="row" id="threeSection" >
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Personal</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
	<div class="row collapse" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de Registro de Catedraticos</h2>
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formCreatePersonal" method="post" action="">
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> Nombres:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="hidden" value="" name="idPersonal"  class="form-control idPersonal" />
						<input type="text" value="" name="nombresP" id="nombres" class="form-control nombresP" />
					</div>
					<div class="col-md-2 f1">
						<label class="control-label"> Apellidos:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="text" value="" name="apellidosP" class="form-control apellidosP"  />
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> DPI:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="text" value="" name="dpiP" class="form-control dpiP" maxlength="13" />
					</div>
				</div><br />
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> Correo:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="text" value="" name="correoP" class="form-control correoP"  />
					</div>
				</div><br />
				<div class="group-form">
					<div class="col-md-2 f1 usuarioP">
						<label class="control-label"> Usuario:</label>
					</div>
					<div class="col-md-4 f1 usuarioP">
						<input type="text" value="" name="usuarioP" class="form-control" id="usuarioP" placeholder="Nombre de usuario" />
						<div id="resultado" style="height: 20px"></div>
					</div>
					<div class="col-md-2 f1 usuarioP">
						<label class="control-label"> Contraseña:</label>
					</div>
					<div class="col-md-4 f1 usuarioP">
						<input type="password" value="" name="claveP" id="clave" class="form-control" placeholder="**********"/>
					</div>					
				</div>
				<div class="col-md-12 text-center btns f1">
		        		<a href="#" class="btn btn-success submitCreatePersonal">Crear Usuario <i class="fa fa-disc"></i></a>
		     	</div>				
			</form>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-12">
				<span class="pull-right iconForm" style="font-weight: bold;font-style: italic"> Mostrar Formulario <i  class="fa fa-chevron-circle-down fa-2x" role="button"  title="Mostrar Formulario" href="#twoSection"  style="color:#b3ad4d"></i></span>
				<span class="pull-right iconForm1" style="font-weight: bold;font-style: italic"> Ocultar Formulario <i  class="fa fa-chevron-circle-up fa-2x" role="button"  title="Ocultar Formulario" href="#twoSection"   style="color:#b3ad4d"></i></span>
		</div>
	</div>
	<br />
	<div class="cargando text-center"></div>
	<div class="row" id="threeSection">
		<h3 align="center" style="background: #04369a;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">USUARIOS DE CATEDRATICOS</h3>
		<div class="col-md-4">
			<img src="../CTI/images/catedratico.png" class="img-responsive">
		</div>
		<div class="col-md-8">
			<table id="usuarios2" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #04369a; color: #fff;">
		            <tr>
		                <th align="center">Nombre</th>
						<th align="center">DPI</th>
						<th align="center">Correo</th>
						<th align="center">Usuario</th>
						<th align="center">Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
		           <?php
						if($arrRoles){
							foreach($arrUsuarios as $data){
								if($data['NIVEL']=="Catedratico"){
								echo "<tr><td>".$data['NOMBRE']." ".$data['APELLIDO']."</td>";
								echo "<td>".$data['NO_DPI']."</td>";
								echo "<td>".$data['CORREO']."</td>";
								echo "<td>".$data['USUARIO']."</td>";
								echo "<td align='center'>
								<i class='fa fa-pencil btn btn-default btn-small' onclick=modificarPersonal('".$data['COD_PERSONA']."') style='color:#4c24c9' ></i>
								<a href='#' onclick=deleteC('".$data['COD_PERSONA']."','personal') ><i class='fa fa-trash btn btn-default btn-small' style='color:#f00'></i></a>								
								</td></tr>";	
								}								
							}
						}
					?>		            
		        </tbody>
		    </table>
		  	</div>
		</div><br />