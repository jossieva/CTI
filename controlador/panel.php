<?php
require_once 'modelo/modelo.php';
	 confirmarlogeo();
$usuario=$_SESSION['usuario'];
$rol=$_SESSION['role'];
$iduser=$_SESSION['id'];

date_default_timezone_set("America/Guatemala");
setlocale(LC_ALL,"es_ES");
$fecha= strftime("%A %d de %B del %Y");
include_once('vista/header.php');
if($rol==1){
	$iduser=$_SESSION['id'];
		include_once 'vista/panel.php';
	
}elseif($rol==2){
	
	include 'vista/panelC.php';
}else{
	include 'vista/panelE.php';
}
include_once('vista/footer.php');
?>