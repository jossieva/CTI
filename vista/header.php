<?php
	 confirmarlogeo();	 
 ?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Panel princi">
    <meta name="autor" content="cti">

    <title>SCN / CTI.. . </title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../CTI/libs/bootstrap/css/bootstrap.min.css" type="text/css" />
    
    <!-- data table style -->
    <link href="../CTI/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
   
    <!-- Custom CSS -->
    <link href="../CTI/css/appCti.css" rel="stylesheet" type="text/css" />
    <link href="../CTI/css/jquery.steps.css" rel="stylesheet" type="text/css" />
    <link href="../CTI/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom Fonts -->
    <link href="../CTI/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <script src="../CTI/libs/jquery/jquery.min.js" type="text/javascript"></script>
	<script src="../CTI/js/jquery.validate.min.js" type="text/javascript"></script>
</head>
<body style="background: rgba(0,0,0,0.1)">
	
	<nav class="navbar navbar-inverse navbar-fixed-top hidden-xs hidden-sm">
		  <div class="container-fluid">
	                <a class="navbar-brand" style="padding: 0px" href="index.php"> <img src="../CTI/images/logotipo.png" width="170" height="50"  /></a>

	            <!-- Top Menu Items -->
	            <ul class="nav navbar-right top-nav">
	                <li class="dropdown">
	                    <a href="#"  class="dropdown-toggle" id="nameUser" data-toggle="dropdown"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;Bienvenido &nbsp;<?php echo $usuario; ?> <b class="caret"></b></a>
	                    <ul class="dropdown-menu">
	                        <!--li>
	                            <a href="#"><i class="fa fa-fw fa-book"></i> Guía Rapida</a>
	                        </li>
	                        <li class="divider"></li-->
	                        <li>
	                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Salir </a>
	                        </li>
	                    </ul>
	                </li>
	            </ul>
		  </div>
	</nav>

    <div id="wrapper" class="active">

   <!-- Navigation -->
    <div class="nav-side-menu">
    <div class="brand" id="menu-toggle">Colegio Tecnologico en Informática</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
          <div class="menu-list">
              <ul id="menu-content" class="menu-content collapse out">
              	<?php if($rol==1){?>
                <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><i class="fa fa-home fa-lg"></i> INICIO <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                	<li  onclick="redirectPage('newpassword')">Cambio de Contraseña</li>
                    <li class="active"><a href="logout.php">Salir</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#catalogos" class="collapsed">
                  <a href="#"><i class="fa fa-plus fa-lg"></i> ADMINISTRACION <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="catalogos">
                	<!--li onclick="redirectPage('cuadroHonorG')">Cuadro de Honor <span class="fa fa-trophy"></span></li-->
                  <li onclick="redirectPage('jornadas')">Jornadas</li>
                  <li onclick="redirectPage('carreras')">Carreras</li>
                  <li onclick="redirectPage('grado')">Grados</li>
                  <li onclick="redirectPage('curso')">Cursos</li>
                  <li onclick="redirectPage('asignacion')">Asig. Cursos</li>
                  <li  onclick="redirectPage('tipoP')">Tipo de Persona</li>
                  <li onclick="redirectPage('unidad')">Unidades</li>
                  <li onclick="redirectPage('estudiante')">Estudiantes</li>                  
                  <li onclick="redirectPage('personal')">Personal</li>                  
                  <li onclick="redirectPage('usuario')">Usuarios</li>                  
                  <!--li onclick="redirectPage('actividad')">Actividades</li-->
                </ul>


                <li data-toggle="collapse" data-target="#catedratico" class="collapsed">
                  <a href="#"><i class="fa fa-list fa-lg"></i> REPORTES  <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="catedratico">
                  <!--li onclick="redirectPage('actividades')">Actividades</li-->
                  <li onclick="redirectPage('notasUnidades')">Notas</li>   
                  <li onclick="redirectPage('notasPromedio')">Resumen Anual</li>
                  <li onclick="redirectPage('cuadroHonor')">Cuadro de Honor</li>                  
                </ul>

	             <?php 
					}elseif($rol==2){
				?>
				<li  data-toggle="" data-target="#products" class="active">
                  <a href="index.php"><i class="fa fa-home fa-lg"></i> INICIO <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu " id="products">
                	<li  onclick="redirectPage2('newpassword')">Cambio de Contraseña</li>
                    <li class="active"><a href="logout.php">Salir</a></li>
                </ul>

				
				<?php
				}else{
				?>
				<li  data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><i class="fa fa-home fa-lg"></i> INICIO <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                	<li  onclick="redirectPage('newpassword')">Cambio de Contraseña</li>
                    <li class="active"><a href="logout.php">Salir</a></li>
                </ul>

				<li data-toggle="collapse" data-target="#perfil" class="collapsed">
	                  <a href="#"><i class="fa fa-user fa-lg"></i> ESTUDIANTE <span class="arrow"></span></a>
	              </li>
	              <ul class="sub-menu collapse" id="perfil">
	                  <li onclick="redirectPageG('notasGeneral','<?php echo $iduser; ?>')">Notas General</li>
	                  <li onclick="redirectPageG('buscarActividad','<?php echo $iduser; ?>')">Actividades</li>
	                                    
	              </ul>
				<?php
				}
				?>  
            </ul>
     </div>
</div>
