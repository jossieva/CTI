<?php
require_once '../modelo/modelo.php';
	$seccion=$estudiante=$grado="";	
	if(@$_GET['seccion']){
		$seccion=$_GET['seccion'];
	}		
	$objeto = new Modelo;
	// variable
	$actividad=trim(@$_GET['term']);
	$curso=trim(@$_GET['curso']);
	$curso1=trim(@$_POST['curso']);
	$arrActividad="";
	$activity=trim(@$_POST['actividad']);
	$idCatedratico=trim(@$_POST['idCatedratico']);
	
	
	$idAlumno=@$_POST['alumno'];	
	$idActividad=trim(@$_POST['codActividad']);
	$punteo=@$_POST['punteo'];
	$punteo1=@$_POST['punteo1'];	
	$idCursoView=trim(@$_POST['idCursoView']);	
	$idActividad1=trim(@$_POST['idActividad']);		
	
		
	switch ($seccion) {
		case 'autocompletar':
				$arrDatos="";
				if ($actividad!="") {
					$sql="SELECT a.COD_ACTIVIDAD, a.NOMBRE_ACTIVIDAD FROM db_actividad a JOIN db_plan_curso pc ON pc.COD_ACTIVIDAD=a.COD_ACTIVIDAD WHERE pc.COD_CURSO_GRADO=".$curso." AND  a.NOMBRE_ACTIVIDAD like '%".$actividad."%'";
					try{				
						$rec =$GLOBALS['conn']->prepare($sql);
						$rec->execute();	
						$arrDatos = $rec->fetchAll();
					}catch(PDOException $e){
					 	echo "Error de Conexi&oacute;n";
				    }
					foreach($arrDatos as $data){
					$arrActividad[]= utf8_encode($data['NOMBRE_ACTIVIDAD']);

					}
					echo json_encode($arrActividad);
				}
			break;
		case 'actividadAspectos':
			$arrData="";
			if($activity!=""){
				$sql="SELECT a.COD_ACTIVIDAD, a.NOMBRE_ACTIVIDAD, asp.DESCRIPCION_ASPECTO, a.DESCRIPCION_ACTIVIDAD,a.FECHA_ACTIVIDAD, asp.PUNTEO FROM db_actividad a JOIN db_plan_curso pc ON pc.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_rubrica ru ON ru.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_aspectos asp ON asp.COD_ASPECTO=ru.COD_ASPECTO WHERE a.NOMBRE_ACTIVIDAD = '".$activity."' AND pc.COD_CURSO_GRADO=".$curso1;
				try{				
					$rec =$GLOBALS['conn']->prepare($sql);
					$rec->execute();	
					$arrData = $rec->fetchAll();
				}catch(PDOException $e){
				 	echo "Error de Conexi&oacute;n";
			    }
				echo json_encode($arrData);
			}
			break;
		case 'actividadAspectosEdit':
			$arrData="";
			if($activity!=""){
				$sql="SELECT a.COD_ACTIVIDAD, a.NOMBRE_ACTIVIDAD,asp.COD_ASPECTO, asp.DESCRIPCION_ASPECTO, a.DESCRIPCION_ACTIVIDAD,a.FECHA_ACTIVIDAD, asp.PUNTEO FROM db_actividad a JOIN db_plan_curso pc ON pc.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_rubrica ru ON ru.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_aspectos asp ON asp.COD_ASPECTO=ru.COD_ASPECTO WHERE a.COD_ACTIVIDAD ='".$activity."' AND pc.COD_CURSO_GRADO=".$curso1 ;
				try{				
					$rec =$GLOBALS['conn']->prepare($sql);
					$rec->execute();	
					$arrData = $rec->fetchAll();
				}catch(PDOException $e){
				 	echo "Error de Conexi&oacute;n";
			    }
				echo json_encode($arrData);
			}
			break;
		case 'asignarNotas':
			$ingreso=FALSE;
			$arrDatos="";
			if($idActividad!=""){
				if($idAlumno['detalle']!=""){					
					$z=count($idAlumno['detalle']['ide']);
					if($z>=1){
						for($x=0;$x<$z;$x++){
							$nombre=$idAlumno["detalle"]["ide"][$x];
							$punteoo=$punteo1[$x];						
							$sqlA="INSERT INTO `db_asig_acti_grado`(COD_ASIG_GRADO_P,COD_ACTIVIDAD,NOTA,ESTADO) VALUES('$nombre','$idActividad','$punteoo','1')";
							try{				
							 	$recA =$GLOBALS['conn']->prepare($sqlA);
								$recA->execute();	
								$ingreso=TRUE;
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n";
							 }							
						}
						if($ingreso==TRUE){
							$mensaje=array('Exito'=>'Notas ingresadas exitosamente.');
							echo json_encode($mensaje);
						}
					}
				}
			}
			break;
		case 'actualizarNotas':
			$ingreso=FALSE;
			$arrDatos="";
			if($idActividad!=""){
				if($idAlumno['detalle']!=""){
					$y=count($punteo1);					
					$z=count($idAlumno['detalle']['ide']);
					if($z>=1){
						for($x=0;$x<($z-$y);$x++){
							$nombre=$idAlumno["detalle"]["ide"][$x];
							$punteoo=$punteo[$x];					
							$sqlA="UPDATE `db_asig_acti_grado` SET NOTA='$punteoo' WHERE COD_ASIG_GRADO_P='$nombre' AND COD_ACTIVIDAD='$idActividad'";	
							try{				
							 	$recA =$GLOBALS['conn']->prepare($sqlA);
								$recA->execute();	
								$ingreso=TRUE;
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n";
							 }							 							
						}						
						if($ingreso==TRUE){
							$mensaje=array('Exito'=>'Notas Actualizadas exitosamente.');
							echo json_encode($mensaje);
						}
					}
					if($y>=1){
						$no=($z-$y);
						for($x=0;$x<$y;$x++){
							$no1=($no+$x);
							
							$nombre=$idAlumno["detalle"]["ide"][$no1];
							$punteooo=$punteo1[$x];						
							$sqlA="INSERT INTO `db_asig_acti_grado`(COD_ASIG_GRADO_P,COD_ACTIVIDAD,NOTA,ESTADO) VALUES('$nombre','$idActividad','$punteooo','1')";
							try{				
							 	$recA =$GLOBALS['conn']->prepare($sqlA);
								$recA->execute();	
								$ingreso=TRUE;
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n";
							 }							
						}
					}
				}
			}
			break;
				default:
			
			break;
	}

?>