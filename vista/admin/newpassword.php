<?php
require_once('../../sesion.php');
	 confirmarlogeo();
	 $iduser=$_SESSION['id'];
?>
<div class="row" id="threeSection">
	<ol class="breadcrumb" style="margin:0px">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Contraseña</li>
		  <span class="pull-right btn1" style="font-size: 1.5rem"><i class="fa fa-chevron-left"><a href="index.php"> Regresar</a> </i></span>
		</ol>
</div>
<div class="row" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">CAMBIO DE CONTRASEÑA <img src="../CTI/images/clave.png" class="img-responsive hidden-xs hidden-sm clave pull-right" width="55" /></h2>
		</div>
		<div class="col-md-12">
			<form class="form form-horizontal" id="formNewPass" method="post" action="">
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label"> Nueva contraseña:</label>
					</div>
					<div class="col-md-8 f1">
						<input type="hidden" value="<?php echo $iduser; ?>" name="idNewPass">
						<input type="text" value="" name="newPass"  class="form-control" id="newPass" placeholder="Ingrese la nueva contraseña..."/>
					</div>
				</div>
				<div class="group-form">
					<div class="col-md-3 f1">
						<label class="control-label">Confirme Contraseña:</label>
					</div>
					<div class="col-md-8 f1">
						<input type="text" value="" name="newPassW"  class="form-control"  placeholder="Confirme Contraseña Nueva..."/>
					</div>
				</div>
				<br />
				<div class="col-md-12 text-center btns f1">
		        		<a href="#" class="btn btn-success submitNewPass">Cambiar<i class="fa fa-disc"></i></a>
		      	</div>
				
			</form>
		</div>
		<div class="col-md-offset-3">
			<h4 class="recomendar"><span class="fa fa-info-circle"></span> Observación:</h4>
			<ul class="recomendaciones">
				<li>
					<span class="fa fa-asterisk" aria-hidden="true"></span>Por seguridad al momento de realizar el cambio de contraseña tendra que volver a iniciar sesión.
			</ul>
		</div>

	</div><br />
	<div class="cargando text-center"></div>
<script type="text/javascript">
	$('#formNewPass').validate({
				rules:{
					newPass:{
							required:true,
							maxlength:15,
							minlength:5
					},
					newPassW: {
							required:true,
							equalTo:"#newPass"
							}
				},
				messages:{
					newPass:{
						required:"Este Campo es obligatorio",
						maxlength: "La longitud maxima es de 15 caracteres",
						minlength:"Minimo utilizar 5 caracteres"
					},
					newPassW:{
						required:"Este campo es obligatorio",
						equalTo:"Las contraseñas no coinciden, ingrese nuevamente el valor"
					}
				}
			});
</script>