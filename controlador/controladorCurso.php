<?php
require_once '../modelo/modelo.php';
	$seccion=$cursos=$grado="";	
	if(@$_GET['seccion']){
		$seccion=$_GET['seccion'];
	}		
	$objeto = new Modelo;
	
	//variables de formulario para asignar cursos a grados
	$cursos=@$_POST['curso'];
	$grado=trim(@$_POST['grado']);
	
	//variables de formulario para asignar cursos a maestros
	$cursoAsig=@$_POST['cursos'];
	$gradoAsig=trim(@$_POST['gradoAsig']);
	$catedratico=trim(@$_POST['catedratico']);
	
	

	switch ($seccion){
		case 'createCurso':
			$ingreso=$ingreso1=FALSE;
			$arrDatos="";
			$lastID="";
			if(($grado!="")&&($grado!="0")&&($grado!="--Seleccione--")){
				if($cursos['detalle']!=""){
						$z=count($cursos['detalle']['nombre']);
						if($z>=1){
							for($x=0;$x<$z;$x++){
								$nombre=$cursos["detalle"]["nombre"][$x];
								$sql="INSERT INTO `db_curso`(NOMBRE_CURSO) VALUES('$nombre')";
								try{				
								 	$rec =$GLOBALS['conn']->prepare($sql);
									$rec->execute();	
									$ingreso=TRUE;
								 }catch(PDOException $e){
								 	echo "Error de Conexi&oacute;n";
								 }	
								 if($ingreso==TRUE){
								 	$sql1="SELECT COD_CURSO FROM db_curso WHERE 1 ORDER BY COD_CURSO DESC LIMIT 1";
									try{				
									 	$rec1 =$GLOBALS['conn']->prepare($sql1);
										$rec1->execute();	
										$arrDatos = $rec1->fetchAll();
									 }catch(PDOException $e){
									 	echo "Error de Conexi&oacute;n";
									 }
									 foreach ($arrDatos as $data) {
										$lastID=$data['COD_CURSO'];
									}
									$sql2="INSERT INTO `db_asig_curso_grado`(`COD_GRADO`, `COD_CURSO`) VALUES ('$grado','$lastID')";
									try{				
									 	$rec2 =$GLOBALS['conn']->prepare($sql2);
										$rec2->execute();	
										$ingreso1=TRUE;
									 }catch(PDOException $e){
									 	echo "Error de Conexi&oacute;n";
									 }	
								 }
							}
							 if($ingreso1==TRUE){
									 	$mensaje=array('exito'=>'!Exito¡ Cursos creados exitosamente.');
										echo json_encode($mensaje);
									 }
						}else{
						$mensaje=array('error'=>'!Error¡ Debe agregar minimo un curso.');
						echo json_encode($mensaje);
						}
				}else{
						$mensaje=array('error'=>'!Error¡ Debe agregar minimo un curso.');
						echo json_encode($mensaje);
						}
			}else{
						$mensaje=array('error'=>'!Error¡ Debe seleccionar un grado.');
						echo json_encode($mensaje);
						}
			break;
		case 'asignarCatedratico':
			$ingreso=$ingreso1=FALSE;
			$arrDatos="";
			if(($gradoAsig!="")&&($cursoAsig!="0")&&($gradoAsig!="--Seleccione--")&&($cursoAsig!="--Seleccione--")&&($catedratico!=0)&&($catedratico!="")){
				if($cursoAsig['detalle']!=""){
						$z=count($cursoAsig['detalle']['nombre']);
						if($z>=1){
							for($x=0;$x<$z;$x++){
								$nombre=$cursoAsig["detalle"]["nombre"][$x];
								$sql="UPDATE db_asig_curso_grado SET  COD_PERSONA='$catedratico' WHERE COD_GRADO='$gradoAsig' AND COD_CURSO='$nombre'";								
								try{				
								 	$rec =$GLOBALS['conn']->prepare($sql);
									$rec->execute();	
									$ingreso=TRUE;
								 }catch(PDOException $e){
								 	echo "Error de Conexi&oacute;n";
								 }	
							}
							 if($ingreso==TRUE){
							 	$mensaje=array('exito'=>'!Exito¡ Cursos asignados exitosamente.');
								echo json_encode($mensaje);
							 }
					}else{
						$mensaje=array('error'=>'!Error¡ Debe agregar minimo un curso.');
						echo json_encode($mensaje);
						}
				}else{
					$mensaje=array('error'=>'!Error¡ verificar que todos los campos esten llenos.');
					echo json_encode($mensaje);
				}
			}else{
				$mensaje=array('error'=>'!Error¡ verificar que todos los campos esten llenos.');
				echo json_encode($mensaje);
			}
			break;
		default:
			
			break;
	}
?>