<?php 
require_once '../../modelo/modelo.php';
$objeto= new Modelo;

$arrUnidad = $objeto->getUnidad1();
	
?>	
	<div class="row" id="twoSectionC">
		<div class="col-md-12 titleActivity">
			<h2 align="center">Registro de Actividades</h2>
		</div>
		<ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Actividades</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
		<div class="col-md-12">
			<span class="pull-right iconForm" style="font-style: italic;margin-bottom: 5px;"> Nueva Actividad <i  class="fa fa-plus-square-o" role="button"  title="Mostrar Formulario" href="#twoSection"  style="color:#bbbbbb"></i></span>
			<span class="pull-right iconForm1" style="font-style: italic;margin-bottom: 5px;"> Ocultar Formulario <i  class="fa fa-chevron-circle-up " role="button"  title="Ocultar Formulario" href="#twoSection"   style="color:#bbbbbb"></i></span>
		</div>
		<div class="col-md-12" id="formActivity">
			<form class="form form-horizontal" id="formCreateActivity" method="post" action="">
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label"> Nombre de la Actividad:</label>
					</div>
					<div class="col-md-8 f1">
						<input type="hidden" value="" name="cursoGrado"  class="form-control cursoGrado"  id="cursoGrado"/>
						<input type="hidden" value="" name="codigoActividad"  class="form-control codigoActividad" />
						<?php 
							foreach ($arrUnidad as $data) {
								
							?>
						<input type="hidden" value="<?php echo $data['COD_UNIDAD'] ?>" name="idUnidad"  class="form-control idActividad" />
							<?php
							}
							?>
						<input type="text" value="" name="actividad"  class="form-control nombreActividad"  placeholder="Ingrese el nombre de la Actividad a registrar..." id="actividad"/>
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label"> Descripción de la Actividad:</label>
					</div>
					<div class="col-md-8 f1">
						<textarea type="text" value="" name="descripcionActividad"  class="form-control descripcionActividad"  placeholder="Ingrese la descripción de la Actividad que se registrara..."/></textarea>
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label"> Fecha de Entrega:</label>
					</div>
					<div class="col-md-5 f1">
						<input type="date" value="" name="fechaEntrega" id="fechaEntrega"  class="form-control fechaEntrega"  />
					</div>
				</div>
				<div class="clearfix"></div><hr />
				<div class="group-form aspectosAdd">
					<div class="col-md-3 f1">
						<label class="control-label"> Aspectos a Calificar:</label>
					</div>
					<div class="col-md-6 f1">
						<input type="text" value=""  id="aspecto" class="form-control" required="required" />
					</div>
					<div class="col-md-1 f1">
						<label class="control-label"> Punteo:</label>
					</div>
					<div class="col-md-1 f1">
						<input type="text" value=""  id="punteo" class="form-control" required="required" />
					</div>
					<div class="col-md-1 text-center f1">
			        	<a href="#" class="btn btn-success" id="btnAgregar"><i class="fa fa-plus"></i></a>
		     		</div>
				</div>
				<div class="col-md-12">
					<table role="table" class="table table-condensed table-striped" style="font-size:13px;">
						<thead style="background-color: #05137C; color: #fff">
							<tr>
								<th>Aspecto</th>
								<th>Punteo</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="listado">
							<tr id="filanohay">
								<td colspan="3" align="center" style="color: #f00;">No se han registrado datos de Aspectos a calificar</td>
							</tr>
							<tr class="filas">
							
							</tr>
						</tbody>
					</table>
				</div>		     	
				<div class="row">
		      		<div class="cargando text-center"></div>
		      		<div class="group-form">
		      			<div class="col-md-4"></div>
		      			<div class="col-md-4 RubricaAsig">
		      				
		      			</div>
		      		</div>		      		
		      	</div>
				<div class="col-md-12 text-center btnAccion f1">
		        		<a href="#" class="btn btn-primary submitCreateActividad">Crear Actividad <i class="fa fa-disc"></i></a>
		        		<a href="#" class="btn btn-danger submitUpdateActividad">Actualizar Actividad <i class="fa fa-disc"></i></a>
		        		<a href="#" class="btn btn-success cancelUpdateActividad">Cancelar <i class="fa fa-disc"></i></a>
		      	</div>				
			</form>
		</div>
	</div>
	<div class="cargando text-center"></div>
	<div class="row" id="threeSectionC">
			<table class="table table-responsive table-hover">
				<thead>
					<tr>
						<th class="col-md-12 titleSectionC" colspan="4">							
						</th>
					</tr>
					<tr>
						<th class="col-md-2 col-sm-2 col-xs-2">Punteo</th>
						<th class="col-md-4 col-sm-4 col-xs-5">Descripción</th>
						<th class="col-md-3 hidden-xs hidden-sm">Aspectos a Calificar</th>
						<th class="col-md-3 col-sm-3 col-xs-2">Acciones</th>
					</tr>
				</thead>
				<tbody class="actividadesCurso">

				</tbody>
			</table>
		</div>
</div>
<script type="text/javascript">
	var total=0;
	$('.submitUpdateActividad').hide();
	$('.delete').click(function(){
					$(this).parents('tr').remove();
					//total-=$(this).parents('tr').html();
					if ($('.filas').length===0){
					   $('#filanohay').css('display','');
					}
				});
	$('#btnAgregar').click(function(){
		agregarFila();
		//$('#valorActividad').val(total);
	});
	function modificarActividad(actividad,curso){
		
			     	var noActividad=actividad;
			     	var idCurso=curso;
			        $.ajax({
			            url:'../CTI/controlador/controladorActividades.php?seccion=actividadAspectosEdit',
			            type:'POST',
			            dataType:'json',
			            data:{actividad:noActividad,curso:idCurso}
			        }).done(function(respuesta){
			        	var cod,cod_aspecto,nombre,descripcion,fecha,aspecto,punteo="";	
			        	$('#formActivity').show();		        	
			        	$.each(respuesta, function(b,llave){
			        		$.each(llave, function(c,d){	
			        			var longitud=c.length;			        					        	
			        			if(c=="COD_ACTIVIDAD"){
									cod=d;
									$('.codigoActividad').val(cod);
								}								
			        			if(c=="NOMBRE_ACTIVIDAD"){
									nombre=d;
									$('.nombreActividad').val(nombre);
								}
								if(c=="DESCRIPCION_ACTIVIDAD"){
									descripcion=d;
									$('.descripcionActividad').val(descripcion);
								}
								if(c=="FECHA_ACTIVIDAD"){
									fecha=d;
									$('.fechaEntrega').val(fecha);
								}
								if(c=="DESCRIPCION_ASPECTO"){
									aspecto=d;								
								}
								if(c=="COD_ASPECTO"){
									cod_aspecto=d;
								}
								if(c=="PUNTEO"){										
									punteo=d;
									$('#filanohay').css('display','none');
									var fila = $('<tr class="filas"></tr>');
									var celda1= $('<td><input type="hidden" name="codAspecto[detalle][]" value="'+cod_aspecto +'" class="control" /><input style="width:100%; border:none; background-color:transparent;" class="novisible control" name="aspecto[detalle][nombre][]" value="'+aspecto+'" required/></td>');
									var celda2= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible control" name="aspecto[detalle][punteo][]" value="'+punteo+'" required/></td>');
									//var celda3= $('<td><a class="delete"><span style="color:red;cursor:pointer" class="glyphicon glyphicon-remove"></span></a></td>');
									fila.append(celda1);
									fila.append(celda2);
									//fila.append(celda3);
										
									$('#listado').append(fila);
									$('#aspecto,#punteo').val("");
									$('.delete').click(function(){
										$(this).parents('tr').remove();
										//total-=$(this).parents('tr').html();
										if ($('.filas').length===0){
										   $('#filanohay').css('display','');
										}
									});
								}
								$('.submitCreateActividad').hide();
								$('.submitUpdateActividad').show();
								$('.aspectosAdd').hide();
								
			        		
			        	});
			        	
			        });
			    });
	}
	$('.cancelUpdateActividad').click(function(e){
		$('.submitCreateActividad').show();
		$('.submitUpdateActividad').hide();
		$('.form-control').val('');	
		$('.filas').empty();
		$('#filanohay').css('display','');
		$('.aspectosAdd').show();
		$('.delete').parents('tr').remove();
		$('#formActivity').hide();		 
	});
	function agregarFila(){
				$('#filanohay').css('display','none');
				var fila = $('<tr class="filas"></tr>');
				var name = $('#aspecto').val();
				var punteo = $('#punteo').val();
				
				var celda1= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="aspecto[detalle][nombre][]" value="'+name+'" required/></td>');
				var celda2= $('<td><input style="width:100%; border:none; background-color:transparent;" class="novisible" name="aspecto[detalle][punteo][]" value="'+punteo+'" required/></td>');
				var celda3= $('<td><a class="delete"><span style="color:red;cursor:pointer" class="glyphicon glyphicon-remove"></span></a></td>');
				fila.append(celda1);
				fila.append(celda2);
				fila.append(celda3);
				//total=(total+punteo);
				$('#listado').append(fila);
				$('#aspecto,#punteo').val("");
				$('.delete').click(function(){
					$(this).parents('tr').remove();
					if ($('.filas').length===0){
					   $('#filanohay').css('display','');
					}
				});			
			}
</script>