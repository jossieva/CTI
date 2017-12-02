<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrRoles=$objeto->getRol();
$arrTipoP=$objeto->getTipo();
$arrUsuarios=$objeto->getUser();
?>	
<div class="row" id="threeSection">
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Usuarios</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
	<div class="row collapse" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de Creación de usuarios</h2>
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formCreateUser" method="post" action="">
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> Nombres:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="text" value="" name="nombres" id="nombres" class="form-control" />
					</div>
					<div class="col-md-2 f1">
						<label class="control-label"> Apellidos:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="text" value="" name="apellidos" class="form-control"  />
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> Tipo de persona:</label>
					</div>
					<div class="col-md-4 f1">
						<select class="form-control" name="tipo" >
							<option>--Seleccionar--</option>
								<?php
									if($arrTipoP){
										foreach($arrTipoP as $data){
											echo "<option value='".$data['COD_TIPO_P']."'>".$data['TIPO_PERSONA']."</option>";
										}
									}
								?>
						</select>
					</div>
					<div class="col-md-2 f1">
						<label class="control-label"> DPI:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="text" value="" name="dpi" class="form-control" maxlength="13" />
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> Correo:</label>
					</div>
					<div class="col-md-10 f1">
						<input type="text" value="" name="correo" class="form-control"  />
					</div>
				</div><br />
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> Usuario:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="text" value="" name="usuario" class="form-control" placeholder="Nombre de usuario" />
					</div>
					<div class="col-md-2 f1">
						<label class="control-label"> Contraseña:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="password" value="" name="clave" class="form-control" placeholder="**********"/>
					</div>
					<div class="col-md-2 f1">
						<label> Rol:</label>
					</div>
					<div class="col-md-4 f1">
						<select class="form-control" name="rol" >
							<option>--Seleccionar--</option>
								<?php
									if($arrRoles){
										foreach($arrRoles as $data){
											echo "<option value='".$data['COD_NIVEL']."'>".$data['NIVEL']."</option>";
										}
									}
								?>
						</select>
					</div>
				</div>
				<div class="col-md-12 text-center f1">
		        		<a href="#" class="btn btn-success submitCreateUser">Crear Usuario <i class="fa fa-disc"></i></a>
		     	</div>				
			</form>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-12">
				<span class="pull-right iconForm" style="font-weight: bold;font-style: italic"> Mostrar Formulario <i  class="fa fa-plus-square-o fa-2x" role="button"  title="Mostrar Formulario" href="#twoSection"  style="color:#b3ad4d"></i></span>
				<span class="pull-right iconForm1" style="font-weight: bold;font-style: italic"> Ocultar Formulario <i  class="fa fa-chevron-circle-up fa-2x" role="button"  title="Ocultar Formulario" href="#twoSection"   style="color:#b3ad4d"></i></span>
		</div>
	</div>
	<br />
	<div class="cargando text-center"></div>
	<div class="row" id="threeSection">
		<h3 align="center" style="background: #005747;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">USUARIOS CON PRIVILEGIO ADMINISTRADOR</h3>
			<div class="col-md-8">
			<table id="usuarios2" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
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
								if($data['NIVEL']=="Administrador"){
								echo "<tr><td>".$data['NOMBRE']." ".$data['APELLIDO']."</td>";
								echo "<td>".$data['NO_DPI']."</td>";
								echo "<td>".$data['CORREO']."</td>";
								echo "<td>".$data['USUARIO']."</td>";
								echo "<td align='center'>
								<!--i class='fa fa-pencil btn btn-default btn-small editarU' style='color:#4c24c9' ></i-->
								<i class='fa fa-key btn btn-default btn-small restartPass' data-target='#updatePassUser' data-toggle='modal' alt='".$data['COD_PERSONA']."'  style='color:#4524c9'></i>
								<a href='#' onclick=deleteC('".$data['COD_PERSONA']."','usuario') ><i class='fa fa-trash btn btn-default btn-small' style='color:#f00'></i></a>								
								</td></tr>";	
								}								
							}
						}
					?>		            
		        </tbody>
		    </table>
		  	</div>
		   	<div class="col-md-4">
				<img src="../CTI/images/admin.png" class="img-responsive">
			</div>
		</div><br />
		<div class="row" id="fourSection">
		<h3 align="center" style="background: #04369a;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">USUARIOS DE CATEDRATICOS</h3>
		<div class="col-md-4">
			<img src="../CTI/images/catedratico.png" class="img-responsive">
		</div>
		<div class="col-md-8">
			<table id="usuarios1" class="display compact table-responsive" width="100%" cellspacing="0">
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
								<i class='fa fa-key btn btn-default btn-small restartPass' data-target='#updatePassUser' data-toggle='modal' alt='".$data['COD_PERSONA']."'  style='color:#4524c9'></i>
								<a href='#' onclick=deleteC('".$data['COD_PERSONA']."','usuario') ><i class='fa fa-trash btn btn-default btn-small' style='color:#f00'></i></a>								
								</td></tr>";	
								}								
							}
						}
					?>		            
		        </tbody>
		    </table>
		   </div>
		</div><br />
		<div class="row" id="fiveSection">
		<h3 align="center" style="background: #58972f;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">USUARIOS DE ESTUDIANTES</h3>
			<div class="col-md-8">
			<table id="usuarios3" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #58972f; color: #fff;">
		            <tr>
		                <th align="center">Nombre</th>
						<th align="center">Correo</th>
						<th align="center">Usuario</th>
						<th align="center">Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
		           <?php
						if($arrRoles){
							foreach($arrUsuarios as $data){
								if($data['NIVEL']=="Estudiante"){
								echo "<tr><td>".$data['NOMBRE']." ".$data['APELLIDO']."</td>";
								echo "<td>".$data['CORREO']."</td>";
								echo "<td class='nameUser'>".$data['USUARIO']."</td>";
								echo "<td align='center'>
								<i class='fa fa-key btn btn-default btn-small restartPass' data-target='#updatePassUser' data-toggle='modal' alt='".$data['COD_PERSONA']."'  style='color:#4524c9'></i>
								<a href='#' onclick=deleteC('".$data['COD_PERSONA']."','usuario') ><i class='fa fa-trash btn btn-default btn-small' style='color:#f00'></i></a>								
								</td></tr>";	
								}
								
							}
						}
					?>		            
		        </tbody>
		    </table>
		 </div>
		   	<div class="col-md-4">
				<img src="../CTI/images/alumno.png" class="img-responsive">
			</div>
		</div>
<!-- =================== MODAL DE MODIFICACIÓN DE CLAVES DE USUARIOS ========================= -->
<!-- Modal -->
<div class="modal fade" id="updatePassUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Restablecer Contraseña</h3>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12">
				<form class="form form-horizontal" id="formNewPass1" method="post" action="">
					<!--div class="group-form">
						<div class="col-md-4 f1">
							<label class="control-label"> Nombre de Usuario:</label>
						</div>
						<div class="col-md-8 f1">
							<input type="text" value="<?php  ?>" name="nameUser" id="nameUser" class="form-control" readonly="readonly">
						</div>
					</div-->
					<div class="group-form">
						<div class="col-md-4 f1">
							<label class="control-label"> Nueva contraseña:</label>
						</div>
						<div class="col-md-8 f1">
							<input type="hidden" value="" name="idNewPass1" id="idUpdatePassUser">
							<input type="text" value="" name="newPass1"  class="form-control" id="newPass" placeholder="Ingrese la nueva contraseña..."/>
						</div>
					</div>
					<div class="group-form">
						<div class="col-md-4 f1">
							<label class="control-label">Confirme Contraseña:</label>
						</div>
						<div class="col-md-8 f1">
							<input type="text" value="" name="newPassW1"  class="form-control"  placeholder="Confirme Contraseña Nueva..."/>
						</div>
					</div>				
				</form>
			</div>
      	</div>
      </div>
     	 <div class="text-center btns f1">
		        		<a href="#" class="btn btn-success submitNewPassUser">Restablecer<i class="fa fa-disc"></i></a>
		</div>
    </div>
  </div>
</div>
<script type="text/javascript">
		$('.restartPass').click(function(e){
			e.preventDefault();
			var id=$(this).attr('alt');
			$('#idUpdatePassUser').val(id);
			
		});
		$('#formNewPass1').validate({
				rules:{
					newPass1:{
							required:true,
							maxlength:15,
							minlength:5
					},
					newPassW1: {
							required:true,
							equalTo:"#newPass"
							}
				},
				messages:{
					newPass1:{
						required:"Este Campo es obligatorio",
						maxlength: "La longitud maxima es de 15 caracteres",
						minlength:"Minimo utilizar 5 caracteres"
					},
					newPassW1:{
						required:"Este campo es obligatorio",
						equalTo:"Las contraseñas no coinciden, ingrese nuevamente el valor"
					}
				}
			});
</script>