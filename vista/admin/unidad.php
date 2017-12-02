<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrUnidad=$objeto->getUnidad();
?>	
<div class="row" id="threeSection">
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Unidades</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
	<div class="row" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de registro de Unidades</h2>
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formCreateUnidad" method="post" action="">
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label"> Nombre de la unidad:</label>
					</div>
					<div class="col-md-8 f1">
						<input type="hidden" value="" name="idUnidad"  class="form-control idUnidad" />
						<input type="text" value="" name="unidad"  class="form-control nombreUnidad"  placeholder="Ingrese el nombre del Unidad a registrar..."/>
					</div>
				</div>
				<br />
				<div class="col-md-12 text-center btns f1">
		        		<a href="#" class="btn btn-success submitCreateUnidad">Crear Unidad <i class="fa fa-disc"></i></a>
		      	</div>
				
			</form>
		</div>
	</div><br />
	<div class="cargando text-center"></div>
	<div class="row" id="threeSection">
		<h3 align="center" style="background: #005747;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">UNIDADES DE ESTUDIO</h3>
			<table id="unidad3" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
		            <tr>
		                <th align="center">Nombre de la Unidad</th>
		                <th align="center">Estado</th>
						<th align="center">Accciones</th>
		            </tr>
		        </thead>
		        <tbody>
		           <?php
						if($arrUnidad){
							foreach($arrUnidad as $data){
								echo "<tr><td>".$data['NOMBRE_UNIDAD']."</td>";
								if($data['ESTADO_UNIDAD']==0){
									echo "<td alt='".$data['COD_UNIDAD']."'>Inactiva</td>";	
								}else{
									echo "<td>Activa</td>";
								}
								
								echo "<td align='center'>
								<a  class='btn btn-default btn-small' onclick=modificarUni('".$data['COD_UNIDAD']."') ><i class='fa fa-pencil' style='color:#4c24c9'></i>								
								<a  data-target='#updateState' data-toggle='modal' class='btn btn-default btn-small' onclick=modificarEstado('".$data['COD_UNIDAD']."','".$data['ESTADO_UNIDAD']."') ><i class='fa fa-check-circle-o' style='color:#0f0'></i></a>
								<a  class='btn btn-default btn-small' onclick=deleteC('".$data['COD_UNIDAD']."','unidad') ><i class='fa fa-trash' style='color:#f00'></i></a>								
								
								</td></tr>";
							}
						}
					?>
		            
		        </tbody>
		    </table>
		</div>
<!-- =================== MODAL DE ACTUALIZACIÓN DE ESTADO DE UNIDADES ========================= -->
<!-- Modal -->
<div class="modal" id="updateState" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #090987;font-family:Helvetica,Arial,  sans-serif;color: #fff;font-weight:bold;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Actualización de Estado</h3>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<form class="updateStateUnite" method="post">
      			<div class="group-form">
      				<div class="col-md-3">
	      				<label class="form-label">
	      					Estado:
	      				</label>
      				</div>
      				<div class="col-md-7">
      					<input type="hidden" name="idUnidadModal" value="" class="idUnidadModal"/>
	      				<input type="radio" name="idEstadoUnidad" value="1" class="idEstadoModal"> Activo<br>
  						<input type="radio" name="idEstadoUnidad" value="0" class="idEstadoModal"> Inactivo<br>
      				</div>
      			</div><br /><br />
      			<div class="group-form">
      				<div class="col-md-12 text-center">
      					<a class="btn btn-primary" id="actualizarEstado" >Cambiar</a>
      				</div>
      			</div>
      		</form>
      	</div>
      </div>
     	 
    </div>
  </div>
</div>