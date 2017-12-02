<?php 
	require_once '../../modelo/modelo.php';
$objeto= new Modelo;
$arrJornada=$objeto->getJornada();
?>	<div class="row" id="threeSection" >
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Jornadas</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
	<div class="row" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Formulario de registro de Jornadas</h2>
			
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formCreateJornada" method="post" action="">
				<div class="group-form">
					<div class="col-md-2 f1">
						<label class="control-label"> Jornadas:</label>
					</div>
					<div class="col-md-8 f1">
						<input type="hidden" value="" name="idJornada"  class="form-control idJornada" />
						<input type="text" value="" name="jornada"  class="form-control nombreJornada" placeholder="Ingrese el nombres de la jornada a ingresar..." />
					</div>
				</div>
				<br />
				<div class="col-md-12 text-center f1 btns">
		        		<a href="#" class="btn btn-success submitCreateJornada">Crear Jornada <i class="fa fa-disc"></i></a>
		      	</div>
				
			</form>
		</div>
	</div><br />
	<div class="cargando text-center"></div>
	<div class="row" id="threeSection">
		<h3 align="center" style="background: #005747;margin: 0px 0px 5px 0px;padding: 10px;color: #FFFFFF;font-weight: bold">JORNADAS DE ESTUDIO</h3>
			<table id="jornadas3" class="display compact table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
		            <tr>
		                <th align="center">Nombre de la Jornada</th>
						<th align="center"></th>
		            </tr>
		        </thead>
		        <tbody>
		           <?php
						if($arrJornada){
							foreach($arrJornada as $data){
								echo "<tr><td>".$data['JORNADA']."</td>";
								echo "<td align='center'>
								<a href='#' onclick=modificarJ('".$data['COD_JORNADA']."') ><i class='fa fa-pencil' style='color:#4c24c9'></i>
								<a href='#' onclick=deleteC('".$data['COD_JORNADA']."','jornadas') ><i class='fa fa-trash' style='color:#f00'></i></a>								
								</td></tr>";
							}
						}
					?>
		            
		        </tbody>
		    </table>
		</div>
<script type="text/javascript">
		$('#formCreateJornada').validate({
							rules:{
								jornada:"required",
							},
							messages:{
								jornada:"Este campo es obligatorio.",
							}
						});
</script>