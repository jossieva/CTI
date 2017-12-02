<script src="../CTI/libs/jquery/jquery.steps.js" type="text/javascript"></script>
<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrCurso=$objeto->getCurso();
$arrCarrera=$objeto->getCarreraJ();
?>
<div class="row" id="threeSection" >
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Cursos</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
<div class="row" id="oneSection1">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de actualizació de Cursos</h2>
		</div>
		
		<div class="col-md-12">
			<form class="form form-horizontal" id="formCreateCurso" method="post" action="">
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label"> Nombre de la unidad:</label>
					</div>
					<div class="col-md-8 f1">
						<input type="hidden" value="" name="idCurso"  class="form-control idCurso" />
						<input type="text" value="" name="curso"  class="form-control nombreCurso"  placeholder=""/>
					</div>
				</div>
				<br />
				<div class="col-md-12 text-center btns f1">
		        		
		      	</div>
				
			</form>
		</div>
	</div>
<div class="row" id="twoSection1">
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
			<h2 align="center">Formulario de registro de Cursos</h2>
		</div>
		<div class="col-md-12">
           <form class="form form-horizontal" id="formCreateCurso1" method="post" action="">
            <div id="wizard">
                <h2>Asignación Grado</h2>
                <section>
			        <legend>Asignación de Grado</legend>
			        <div class="group-form" id="selectJornada">
					<div class="col-md-3 f1">
						<label class="control-label">Jornada:</label>
					</div>
					<div class="col-md-8 f1">
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
					<div class="col-md-3 f1">
						<label class="control-label">Carrera:</label>
					</div>
					<div class="col-md-8 f1">
						<select name="carreraC" class="form-control selectCarrera" required><span style="color: red">*</span>
							<option class="nombreCarrera">--Seleccione--</option>
						</select>						
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label">Grado:</label>
					</div>
					<div class="col-md-8 f1">
						<select name="grado" class="form-control selectGrado" required><span style="color: red">*</span>
							<option class="nombreGrado">--Seleccione--</option>
						</select>						
					</div>
				</div>
              	</section>
                <h2>Cursos</h2>
                <section>
			        <legend>Creación de cursos</legend>
			        <div class="group-form">
						<div class="col-md-3 f1">
							<label class="control-label"> Nombre del Curso:</label>
						</div>
						<div class="col-md-9 f1">
							<input type="text" value=""  id="curso" class="form-control" required="required" />
						</div>
					</div>
	
					<div class="col-md-12 text-center f1">
			        		<a href="#" class="btn btn-success" id="btnAgregar">Agregar <i class="fa fa-disc"></i></a>
		     		</div>
		     	
						<div class="col-md-12">
							<p class="recomendar" style="font-size: 10px"><span class="fa fa-info-circle"></span> Los Cursos que se están agregando estaran asignados a un grado hasta presionar el botón de finalizar.</p>
						</div>
					
		     		
		     		 <div class="col-md-12" style="height: 75%; overflow: scroll">
					<table role="table" class="table table-condensed table-striped" style="font-size:13px;">
						<thead style="background-color: #05137C; color: #fff">
							<tr>
								<th>Nombre Del Curso</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="listado">
							<tr id="filanohay">
								<td colspan="2" align="center" style="color: #f00;">No se han registrado datos de Cursos</td>
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
	</div>
	<br />
		<div class="row">
		<div class="col-md-12">
				<span class="pull-right iconForm" style="font-weight: bold;font-style: italic"> Mostrar Formulario <i  class="fa fa-chevron-circle-down fa-2x" role="button"  title="Mostrar Formulario" href="#twoSection"  style="color:#b3ad4d"></i></span>
				<span class="pull-right iconForm1" style="font-weight: bold;font-style: italic"> Ocultar Formulario <i  class="fa fa-chevron-circle-up fa-2x" role="button"  title="Ocultar Formulario" href="#twoSection"   style="color:#b3ad4d"></i></span>
		</div>
	</div>
	<div class="cargando text-center"></div>
	<div class="row" id="threeSection">
		<h3 align="center" style="background: #005747;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">CURSOS DE ESTUDIO</h3>
			<table id="curso3" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
		            <tr>
		            	<th align="center">Nombre Grado</th>
		                <th align="center">Nombre del Curso</th>
						<th align="center"></th>
		            </tr>
		        </thead>
		        <tbody>
		           <?php
						if($arrCurso){
							foreach($arrCurso as $data){
								echo "<tr><td>".$data['NOMBRE_GRADO']."</td>";
								echo "<td>".$data['NOMBRE_CURSO']."</td>";
								echo "<td align='center'>
								<a href='#' onclick=modificarCurso('".$data['COD_CURSO']."') ><i class='fa fa-pencil' style='color:#4c24c9'></i></a>
								<a href='#' onclick=deleteC('".$data['COD_CURSO']."','curso') ><i class='fa fa-trash' style='color:#f00'></i></a>								
								</td></tr>";
							}
						}
					?>
		            
		        </tbody>
		    </table>
		</div>
		
<script type="text/javascript">
	$('#btnAgregar').click(function(){
		agregarFila();
	});
	function agregarFila(){
				$('#filanohay').css('display','none');
				var fila = $('<tr class="filas"></tr>');
				var name = $('#curso').val();
				
				var celda1= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="curso[detalle][nombre][]" value="'+name+'" required/></td>');
				var celda2= $('<td><a class="delete"><span style="color:red;cursor:pointer" class="glyphicon glyphicon-remove"></span></a></td>');
				fila.append(celda1);
				fila.append(celda2);
				
				$('#listado').append(fila);
				$('#curso').val("");
				$('.delete').click(function(){
					$(this).parents('tr').remove();
					if ($('.filas').length===0){
					   $('#filanohay').css('display','');
					}
				});			
			}
</script>