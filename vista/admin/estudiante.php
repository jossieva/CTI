<script src="../CTI/libs/jquery/jquery.steps.js" type="text/javascript"></script>
<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrRoles=$objeto->getRol();
$arrTipoP=$objeto->getTipo();
$arrUsuarios=$objeto->getUser();
$arrGrado=$objeto->getGrado();
$arrCarrera=$objeto->getCarreraJ();
?>	
<div class="row" id="threeSection">
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Estudiantes</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
<div class="row" id="oneSection1">
	<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de Actualización de Estudiante</h2>
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formUpdateStudent" method="post" action="">
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> Nombres:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="hidden" value="" name="idStudent" class="form-control idEstudiante" />
						<input type="text" value="" name="nameStudent" class="form-control nombres" />
					</div>
					<div class="col-md-2 f1">
						<label class="control-label"> Apellidos:</label>
					</div>
					<div class="col-md-4 f1">
						<input type="text" value="" name="lastNameStudent"  class="form-control apellidos"  />
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> Correo:</label>
					</div>
					<div class="col-md-10 f1">
						<input type="text" value="" name="emailStudent"  class="form-control correo"  />
					</div>
				</div><br />
				<div class="col-md-12 text-center btns f1">
		        	
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
	
	<div class="row" id="twoSection">
		     <script>
                $(function ()
                {
                    $("#wizard").steps({
                        headerTag: "h2",
                        bodyTag: "section",
                        transitionEffect: "slideLeft"
                    });
                });
            </script>
		<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de registro de Estudiantes</h2>
		</div>
		<div class="col-md-12">
            <form class="form form-horizontal" id="formCreateEstudiantes" method="post" action="">
            <div id="wizard">
                <h2>Asig. Grado</h2>
                <section>
			        <legend>Asignación de Grado</legend>
			        <div class="group-form" id="selectJornada">
					<div class="col-md-2 f1">
						<label class="control-label">Jornada:</label>
					</div>
					<div class="col-md-4 f1">
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
					<div class="col-md-4 f1">
						<select name="carreraC" class="form-control selectCarrera" required><span style="color: red">*</span>
							<option class="nombreCarrera">--Seleccione--</option>
						</select>						
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label">Grado:</label>
					</div>
					<div class="col-md-4 f1">
						<select name="grado" class="form-control selectGrado" required><span style="color: red">*</span>
							<option class="nombreGrado">--Seleccione--</option>
						</select>						
					</div>
				</div>
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
							<input type="text" value="" name="apellidos" id="apellidos" class="form-control"  />
						</div>
					</div>
					<div class="group-form">
						<div class="col-md-2 f1">
							<label class="control-label"> Correo:</label>
						</div>
						<div class="col-md-4 f1">
							<input type="text" value="" name="correo" id="correo" class="form-control"  />
						</div>
					</div><br />
					<div class="group-form">
						<div class="col-md-2 f1">
							<label class="control-label"> Usuario:</label>
						</div>
						<div class="col-md-4 f1">
							<input type="text" value="" name="usuario" id="usuario" class="form-control" placeholder="Nombre de usuario" />
							<div id="resultado" style="height: 20px"></div>
						</div>
						
						<div class="col-md-2 f1">
							<label class="control-label"> Contraseña:</label>
						</div>
						<div class="col-md-4 f1">
							<input type="password" value="" name="clave" id="clave" class="form-control" placeholder="**********"/>
						</div> 
					</div>
					<div class="col-md-12 text-center f1">
			        		<a href="#" class="btn btn-success submitCreateUser" id="btnAgregar">Agregar Usuario <i class="fa fa-disc"></i></a>
		     		</div>
              	</section>
                <h2>Lista de Estudiantes</h2>
                <section>
			        <legend>Listado de Estudiantes</legend>
			         <div class="col-md-12" style="height: 100%; overflow: scroll">
					<table role="table" class="table table-condensed table-striped" style="font-size:13px;">
						<thead style="background-color: #05137C; color: #fff">
							<tr>
								<th>Nombres </th>
								<th>Apellidos</th>
								<th>Correo </th>
								<th>Usuario </th>
								<th>Contraseña</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="listado">
							<tr id="filanohay">
								<td colspan="6" align="center" style="color: #f00;">No se han registrado datos de Estudiantes</td>
							</tr>
							<tr class="filas">
							
							</tr>
						</tbody>
					</table>
				</div>
						
					
                </section>
            </div>
            </form>
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
								<i class='fa fa-pencil btn btn-default btn-small editarEstudiante' onclick=modificarEstudiante('".$data['COD_PERSONA']."') style='color:#4c24c9' ></i>
								<a href='#' onclick=deleteC('".$data['COD_PERSONA']."','estudiante') ><i class='fa fa-trash btn btn-default btn-small' style='color:#f00'></i></a>								
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
<script type="text/javascript">
		$('#formCreateEstudiantes').validate({
		rules:{
			nombres:{required:true},
			apellidos:{required:true},
			usuario:{required:true},
			clave:{required:true},
		},
		messages:{
			nombres:"Este campo es obligatorio.",
			apellidos:"Este campo es obligatorio",
			usuario:"Este campo es obligatorio",
			clave:"Este campo es obligatorio",
		}
	});



	$('#btnAgregar').click(function(){
		if(agregarFila()){
			alert('estudiante agregado');
		};
	});
	function agregarFila(){
		
				$('#filanohay').css('display','none');
				var fila = $('<tr class="filas"></tr>');
				var name = $('#nombres').val();
				var lastName = $('#apellidos').val();
				var correo = $('#correo').val();
				var usuario = $('#usuario').val();
				var clave = $('#clave').val();
				
				var celda1= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="estudiante[detalle][nombre][]" value="'+name+'" required/></td>');
				var celda2= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="estudiante[detalle][apellido][]" value="'+lastName+'" required/></td>');
				var celda3= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="estudiante[detalle][correo][]" value="'+correo+'" required/></td>');
				var celda4= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="estudiante[detalle][usuario][]" value="'+usuario+'" required/></td>');
				var celda5= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="estudiante[detalle][clave][]" value="'+clave+'" required/></td>');
				var celda6= $('<td><a class="delete"><span style="color:red;cursor:pointer" class="glyphicon glyphicon-remove"></span></a></td>');
				fila.append(celda1);
				fila.append(celda2);
				fila.append(celda3);
				fila.append(celda4);
				fila.append(celda5);
				fila.append(celda6);
				
				$('#listado').append(fila);
				$('#nombres,#apellidos,#correo,#usuario,#clave').val("");
				$('.delete').click(function(){
					$(this).parents('tr').remove();
					if ($('.filas').length===0){
					   $('#filanohay').css('display','');
					}
				});			
			}
</script>