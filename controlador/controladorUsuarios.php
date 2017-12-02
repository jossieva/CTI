<?php
require_once '../modelo/modelo.php';
	$jornadaCarrera=$newPass=$newPassw=$seccion=$nombres=$apellidos=$dpi=$correo=$tipo=$rolN=$usuarioN=$clave=$jornada=$curso=$carrera=$grado=$undiad=$tipoP=$idM=$catalogoM="";	
	if(@$_GET['seccion']){
		$seccion=$_GET['seccion'];
	}		
	$objeto = new Modelo;
	
	//variables de formulario para crear usuario
	$nombres=trim(@$_POST['nombres']);
	$apellidos=trim(@$_POST['apellidos']);
	$dpi=trim(@$_POST['dpi']);
	$correo=trim(@$_POST['correo']);
	$tipo=trim(@$_POST['tipo']);
	$rolN=trim(@$_POST['rol']);
	$usuarioN=trim(@$_POST['usuario']);
	$clave=trim(@$_POST['clave']);

	//variables de formulario para crear usuarios catedraticos
	$nombresP=trim(@$_POST['nombresP']);
	$apellidosP=trim(@$_POST['apellidosP']);
	$dpiP=trim(@$_POST['dpiP']);
	$correoP=trim(@$_POST['correoP']);
	$usuarioP=trim(@$_POST['usuarioP']);
	$claveP=trim(@$_POST['claveP']);
	$idPersonal=trim(@$_POST['idPersonal']);
	
	//variables de formulario para crear jornadas
	$jornada=trim(@$_POST['jornada']);
	$idJornada=trim(@$_POST['idJornada']);
	$establecimiento=1;
	
	//variables de formulario para crear carreras
	$carrera=trim(@$_POST['carrera']);
	$jornadaCarrera=trim(@$_POST['jornadaC']);
	$idCarrera=trim(@$_POST['idCarrera']);
	
	
	//variables de formulario para crear grados
	$grado=trim(@$_POST['grado']);
	$carreraGrado=trim(@$_POST['carreraC']);
	$idGrado=trim(@$_POST['idGrado']);
	
	//variables de formulario para crear cursos
	$curso=trim(@$_POST['curso']);	
		$idCurso=trim(@$_POST['idCurso']);	
	
	//variables de formulario para crear cursos
	$unidad=trim(@$_POST['unidad']);
	$idUnidad=trim(@$_POST['idUnidad']);
	
		//variables de formulario para crear cursos
	$tipoP=trim(@$_POST['tipoP']);
	$idTipoP=trim(@$_POST['idTipoP']);	
	
	//variables de formulario para crear cursos
	$idTipo=trim(@$_POST['id']);	
	$catalogo=trim(@$_POST['catalogo']);
	
	//variables de formulario para crear cursos
	$idModC=trim(@$_POST['idM']);	
	
	//variables de formulario para crear cursos
	$idAso=trim(@$_POST['idAso']);
	$idGradoAso=trim(@$_POST['idGradoAso']);	
	$idCursoAso=trim(@$_POST['idCursoAso']);	
	
	//Variable utilizada para recibir el parametro para listar cursos por grados
	$idGradoView=trim(@$_POST['idGradoView']);	
	
	//Variables de actualización de datos de estudiantes
	$idStudent=(@$_POST['idStudent']);
	$nameStudent=(@$_POST['nameStudent']);
	$lastNameStudent=(@$_POST['lastNameStudent']);
	$emailStudent=(@$_POST['emailStudent']);
	
	//Variable utilizada para recibir el parametro para listar cursos por grados
	$newPass=trim(@$_POST['newPass']);
	$newPassw=trim(@$_POST['newPassW']);
	$idNewPass=trim(@$_POST['idNewPass']);
	$newPass1=trim(@$_POST['newPass1']);
	$newPassw1=trim(@$_POST['newPassW1']);
	$idNewPass1=trim(@$_POST['idNewPass1']);
	
	//variables para la actualización de estado
	$idUnidadModal=trim(@$_POST['idUnidadModal']);
	$idEstadoModal=trim(@$_POST['idEstadoUnidad']);
	
	
	switch ($seccion) {
		case 'newPass':
			if(($newPass===$newPassw)&&($newPass!="")){
				$actualizar=FALSE;
				$newPass=sha1($newPass);
				$sql = "UPDATE db_persona SET CLAVE='$newPass' WHERE COD_PERSONA='$idNewPass'";
				try{				
				 	$rec =$GLOBALS['conn']->prepare($sql);
					$rec->execute();	
					$ingreso=TRUE;
				}catch(PDOException $e){
				 	echo "Error de Conexi&oacute;n";
				 }	
				if($ingreso==TRUE){
				 	$mensaje=array('exito'=>'Clave Actualizada Exitosamente.');
					echo json_encode($mensaje);
				}
			}
			break;
			case 'newPass1':
			if(($newPass1===$newPassw1)&&($newPass1!="")){
				$actualizar=FALSE;
				$newPass1=sha1($newPass1);
				$sql = "UPDATE db_persona SET CLAVE='$newPass1' WHERE COD_PERSONA='$idNewPass1'";
				try{				
				 	$rec =$GLOBALS['conn']->prepare($sql);
					$rec->execute();	
					$ingreso=TRUE;
				}catch(PDOException $e){
				 	echo "Error de Conexi&oacute;n";
				 }	
				if($ingreso==TRUE){
				 	$mensaje=array('exito'=>'Clave Actualizada Exitosamente.');
					echo json_encode($mensaje);
				}
			}
			break;
		case 'createUser':
			if(($usuarioN!="")){
				if($clave!=""){
					if($rolN!=""){
						$ingreso=FALSE;
						$clave=sha1($clave);
						$sql = "INSERT INTO `db_persona`(COD_NIVEL, COD_TIPO_P, NOMBRE, APELLIDO, NO_DPI, CORREO, USUARIO, CLAVE) VALUES('$rolN','$tipo','$nombres','$apellidos','$dpi','$correo','$usuarioN','$clave')";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Usuarios creado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡ Ingrese el rol del usuario.');
						echo json_encode($mensaje);
					}
					
				}else{
					$mensaje=array('error'=>'Ingrese la clave del usuario.');
					echo json_encode($mensaje);
				}
				
			}else{
					$mensaje=array('error'=>'!Error¡Ingrese nombre del usuario.');
					echo json_encode($mensaje);
			}
			break;
		case 'createPersonal':
			if(($usuarioP!="")){
				if($claveP!=""){
						$ingreso=FALSE;
						$clave=sha1($claveP);
						$sql = "INSERT INTO `db_persona`(COD_NIVEL, COD_TIPO_P,NOMBRE, APELLIDO, NO_DPI, CORREO, USUARIO, CLAVE) VALUES('2','3','$nombresP','$apellidosP','$dpiP','$correoP','$usuarioP','$clave')";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Catedratico creado exitosamente.');
							echo json_encode($mensaje);
						 }					
					
				}else{
					$mensaje=array('error'=>'Ingrese la clave del usuario.');
					echo json_encode($mensaje);
				}
				
			}else{
					$mensaje=array('error'=>'!Error¡Ingrese nombre del usuario.');
					echo json_encode($mensaje);
			}
			break;
		case 'createJornada':
			if(($jornada!="")){
						$ingreso=FALSE;
						$sql = "INSERT INTO `db_jornada`(COD_ESTABLECIMIENTO,JORNADA) VALUES('$establecimiento','$jornada')";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Jornada creada exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡Ingrese nombre de la Jornada de estudios.');
					echo json_encode($mensaje);
			}
			break;
		case 'updateJornada':
			if(($idJornada!="")){
						$ingreso=FALSE;
						$sql = "UPDATE db_jornada SET JORNADA='$jornada' WHERE COD_JORNADA='$idJornada'";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Jornada Actualizada exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡no es posible actualizar en estos momentos.');
					echo json_encode($mensaje);
			}
			break;
		case 'createCarrera':
			if(($carrera!="")){
						$ingreso=FALSE;
						$sql = "INSERT INTO `db_carrera`(COD_JORNADA,NOMBRE_CARRERA) VALUES('$jornadaCarrera','$carrera')";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Carrera creada exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡Ingrese nombre de la Carrera.');
					echo json_encode($mensaje);
			}
			break;
		case 'updateCarrera':
			if(($jornadaCarrera!="")){
				if(($idCarrera!="")){
							$ingreso=FALSE;
							$sql = "UPDATE db_carrera SET COD_JORNADA='$jornadaCarrera', NOMBRE_CARRERA='$carrera' WHERE COD_CARRERA='$idCarrera'";
							try{				
							 	$rec =$GLOBALS['conn']->prepare($sql);
								$rec->execute();	
								$ingreso=TRUE;
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n";
							 }	
							 if($ingreso==TRUE){
							 	$mensaje=array('exito'=>'!Exito¡ Carrera Actualizada Exitosamente.');
								echo json_encode($mensaje);
							 }
	
				}else{
						$mensaje=array('error'=>'!Error¡No fue posible actualizar carrera.');
						echo json_encode($mensaje);
				}
			}
			break;
		case 'createGrado':
			if(($grado!="")){
						$ingreso=FALSE;
						$sql = "INSERT INTO `db_grado`(COD_CARRERA,NOMBRE_GRADO) VALUES('$carreraGrado','$grado')";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Grado creado exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡Ingrese nombre del grado.');
					echo json_encode($mensaje);
			}
			break;
		case 'updateGrado':
			if(($carreraGrado!="")){
				if(($idGrado!="")){
							$ingreso=FALSE;
							$sql = "UPDATE db_grado SET COD_CARRERA='$carreraGrado', NOMBRE_GRADO='$grado' WHERE COD_GRADO='$idGrado'";
							try{				
							 	$rec =$GLOBALS['conn']->prepare($sql);
								$rec->execute();	
								$ingreso=TRUE;
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n";
							 }	
							 if($ingreso==TRUE){
							 	$mensaje=array('exito'=>'!Exito¡ Grado Actualizado Exitosamente.');
								echo json_encode($mensaje);
							 }
	
				}else{
						$mensaje=array('error'=>'!Error¡No fue posible actualizar Grado.');
						echo json_encode($mensaje);
				}
			}
			break;
	case 'updateCurso':
			if(($idCurso!="")){
						$ingreso=FALSE;
						$sql = "UPDATE db_curso SET NOMBRE_CURSO='$curso' WHERE COD_CURSO='$idCurso'";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Curso Actualizada exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡no es posible actualizar en estos momentos.');
					echo json_encode($mensaje);
			}
			break;
		case 'createUnidad':
			if(($unidad!="")){
						$ingreso=FALSE;
						$sql = "INSERT INTO `db_unidad`(NOMBRE_UNIDAD) VALUES('$unidad')";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Unidad creada exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡Ingrese nombre de la Unidad.');
					echo json_encode($mensaje);
			}
			break;
		
		case 'updateUnidad':
			if(($idUnidadM!="")){
						$ingreso=FALSE;
						$sql = "UPDATE db_unidad SET NOMBRE_UNIDAD='$unidad' WHERE COD_UNIDAD='$idUnidad'";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Unidad Actualizada exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡no es posible actualizar en estos momentos.');
					echo json_encode($mensaje);
			}
			break;
		case 'updateStateUnited':
			if(($idEstadoModal==0)||($idEstadoModal==1)){
						$ingreso=FALSE;
						$sql = "UPDATE db_unidad SET ESTADO_UNIDAD='$idEstadoModal' WHERE COD_UNIDAD='$idUnidadModal'";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Unidad Actualizada exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡no es posible actualizar en estos momentos.');
					echo json_encode($mensaje);
			}
			break;
	case 'createTipoP':
			if(($tipoP!="")){
						$ingreso=FALSE;
						$sql = "INSERT INTO `db_tipo_persona`(TIPO_PERSONA) VALUES('$tipoP')";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Tipo de Persona creada exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡Ingrese nombre del tipo de persona.');
					echo json_encode($mensaje);
			}
			break;
		case 'updateTipoP':
			if(($idTipoP!="")){
						$ingreso=FALSE;
						$sql = "UPDATE db_tipo_persona SET TIPO_PERSONA='$tipoP' WHERE COD_TIPO_P='$idTipoP'";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Tipo de Persona Actualizada exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡no es posible actualizar en estos momentos.');
					echo json_encode($mensaje);
			}
			break;
		case 'updateStudent':
			if(($idStudent!="")){
						$ingreso=FALSE;
						$sql = "UPDATE db_persona SET NOMBRE='$nameStudent', APELLIDO='$lastNameStudent', CORREO='$emailStudent' WHERE COD_PERSONA='$idStudent'";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Estudiante Actualizado exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡no es posible actualizar en estos momentos.');
					echo json_encode($mensaje);
			}
			break;
		case 'updatePersonal':
			if(($idPersonal!="")){
						$ingreso=FALSE;
						$sql = "UPDATE db_persona SET NOMBRE='$nombresP', APELLIDO='$apellidosP', NO_DPI='$dpiP', CORREO='$correoP' WHERE COD_PERSONA='$idPersonal'";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Catedratico Actualizado exitosamente.');
							echo json_encode($mensaje);
						 }

			}else{
					$mensaje=array('error'=>'!Error¡no es posible actualizar en estos momentos.');
					echo json_encode($mensaje);
			}
			break;
		case 'deleteC':
			switch ($catalogo){
				case 'tipoP':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "DELETE FROM `db_tipo_persona` WHERE COD_TIPO_P=$idTipo";

						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
						echo json_encode($mensaje);
					}
					break;
				case 'asignacion':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "UPDATE db_asig_curso_grado SET  COD_PERSONA='null' WHERE COD_CURSO_GRADO=$idTipo";

						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro desasignado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido desasignar el curso.');
						echo json_encode($mensaje);
					}
					break;
				case 'carreras':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "DELETE FROM `db_carrera` WHERE COD_CARRERA=$idTipo";

						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
						echo json_encode($mensaje);
					}
				break;
				case 'curso':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "DELETE FROM `db_asig_curso_grado` WHERE COD_CURSO=$idTipo";
						$sql1 = "DELETE FROM `db_curso` WHERE COD_CURSO=$idTipo";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec1 =$GLOBALS['conn']->prepare($sql1);
							$rec->execute();
							$rec1->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
						echo json_encode($mensaje);
					}
				break;
				case 'actividades':
					if(($idTipo!="")){
						$arrData="";
						$ingreso=$ingreso1=$ingreso2=$ingreso3=FALSE;
						$sqlN = "DELETE FROM `db_asig_acti_grado` WHERE COD_ACTIVIDAD=$idTipo";
						$sql1 = "DELETE FROM `db_plan_curso` WHERE COD_ACTIVIDAD=$idTipo";
						try{				
							$rec1 =$GLOBALS['conn']->prepare($sql1);
							$recN =$GLOBALS['conn']->prepare($sqlN);
							$rec1->execute();	
							$recN->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n ";
						 }
						if($ingreso==TRUE){
							$sql2 = "SELECT *  FROM `db_rubrica` WHERE COD_ACTIVIDAD=$idTipo";
							try{				
								$rec2 =$GLOBALS['conn']->prepare($sql2);
								$rec2->execute();
								$arrData= $rec2->fetchAll();	
								$ingreso1=TRUE;
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n ";
							 }
							 if(($ingreso1==TRUE)&&($arrData)){
							 	foreach($arrData as $data){
							 		$sql3="DELETE FROM `db_aspectos` WHERE COD_ASPECTO=".$data['COD_ASPECTO'];
									$sql4="DELETE FROM `db_rubrica` WHERE COD_ASPECTO=".$data['COD_ASPECTO']." AND COD_ACTIVIDAD=".$idTipo;
									try{				
										$rec3 =$GLOBALS['conn']->prepare($sql3);
										$rec4 =$GLOBALS['conn']->prepare($sql4);
										$rec3->execute();	
										$rec4->execute();	
										$ingreso2=TRUE;
									 }catch(PDOException $e){
									 	echo "Error de Conexi&oacute;n  ";
									 }
							 	}
								if($ingreso2==TRUE){
									$sql = "DELETE FROM `db_actividad` WHERE COD_ACTIVIDAD=$idTipo";						
									try{				
									 	$rec =$GLOBALS['conn']->prepare($sql);										
										$rec->execute();											
										$ingreso3=TRUE;
									 }catch(PDOException $e){
									 	echo "Error de Conexi&oacute;n";
									 }	
									 if($ingreso3==TRUE){
									 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
										echo json_encode($mensaje);
									 }else{
										$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
										echo json_encode($mensaje);
									}
								}else{
									$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
									echo json_encode($mensaje);
								}
							 }else{
								$sql = "DELETE FROM `db_actividad` WHERE COD_ACTIVIDAD=$idTipo";						
								try{				
								 	$rec =$GLOBALS['conn']->prepare($sql);										
									$rec->execute();											
									$ingreso3=TRUE;
								 }catch(PDOException $e){
								 	echo "Error de Conexi&oacute;n";
								 }	
								 if($ingreso3==TRUE){
								 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
									echo json_encode($mensaje);
								 }else{
									$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro. ');
									echo json_encode($mensaje);
								}
							}
						}
					}
						
						
						
					
				break;
				case 'grado':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "DELETE FROM `db_grado` WHERE COD_GRADO=$idTipo";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
						echo json_encode($mensaje);
					}
				break;
				case 'jornadas':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "DELETE FROM `db_jornada` WHERE COD_JORNADA=$idTipo";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
						echo json_encode($mensaje);
					}
				break;
				case 'unidad':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "DELETE FROM `db_unidad` WHERE COD_UNIDAD=$idTipo";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
						echo json_encode($mensaje);
					}
				break;
				case 'usuario':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "DELETE FROM `db_persona` WHERE COD_PERSONA=$idTipo";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
						echo json_encode($mensaje);
					}
				break;
				case 'estudiante':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "DELETE FROM `db_persona` WHERE COD_PERSONA=$idTipo";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
						echo json_encode($mensaje);
					}
				break;
				case 'personal':
					if(($idTipo!="")){
						$ingreso=FALSE;
						$sql = "DELETE FROM `db_persona` WHERE COD_PERSONA=$idTipo";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if($ingreso==TRUE){
						 	$mensaje=array('exito'=>'!Exito¡ Registro eliminado exitosamente.');
							echo json_encode($mensaje);
						 }
					}else{
						$mensaje=array('error'=>'!Error¡no se a podido eliminar el registro.');
						echo json_encode($mensaje);
					}
				break;
			}
			break;
			case 'modificarC':
					$arrDatos="";
					if(($idModC!="")){						
						$sql = "SELECT c.*, j.JORNADA FROM db_carrera c INNER JOIN db_jornada j ON j.COD_JORNADA=c.COD_JORNADA WHERE c.COD_CARRERA=$idModC";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				echo json_encode($arrDatos);
			break;
			case 'modificarJ':
					$arrDatos="";
					if(($idModC!="")){						
						$sql = "SELECT * FROM `db_jornada` WHERE COD_JORNADA=$idModC";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				echo json_encode($arrDatos);
			break;
			case 'modificarG':
					$arrDatos="";
					if(($idModC!="")){						
						$sql = "SELECT g.*, c.NOMBRE_CARRERA, c.COD_CARRERA FROM db_grado g INNER JOIN db_carrera c ON g.COD_CARRERA=c.COD_CARRERA WHERE COD_GRADO=$idModC";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				echo json_encode($arrDatos);
			break;
			case 'modificarCur':
					$arrDatos="";
					if(($idModC!="")){						
						$sql = "SELECT * FROM `db_curso` WHERE COD_CURSO=$idModC";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				echo json_encode($arrDatos);
			break;
			case 'modificarEstudiante':
					$arrDatos="";
					if(($idModC!="")){						
						$sql = "SELECT * FROM `db_persona` WHERE COD_PERSONA=$idModC";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				echo json_encode($arrDatos);
			break;
			case 'modificarTipo':
					$arrDatos="";
					if(($idModC!="")){						
						$sql = "SELECT * FROM `db_tipo_persona` WHERE COD_TIPO_P=$idModC";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				echo json_encode($arrDatos);
			break;
			case 'modificarUni':
					$arrDatos="";
					if(($idModC!="")){						
						$sql = "SELECT * FROM `db_unidad` WHERE COD_UNIDAD=$idModC";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				echo json_encode($arrDatos);
			break;
			case 'llenarCarrera':
				$view="<option> Seleccionar </option>";
					$arrDatos="";
					if(($idAso!="")){						
						$sql = "SELECT DISTINCT(j.JORNADA),c.* FROM db_carrera c INNER JOIN db_jornada j ON j.COD_JORNADA=c.COD_JORNADA WHERE c.COD_JORNADA=$idAso";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				foreach ($arrDatos as $data) {
					$view.= "<option value='".$data['COD_CARRERA']."'>".$data['NOMBRE_CARRERA']."</option>";
				}
				echo $view;
			break;
			case 'llenarGrado':
				$view="<option> Seleccionar </option>";
					$arrDatos="";
					if(($idGradoAso!="")){						
						$sql = "SELECT DISTINCT(g.NOMBRE_GRADO),c.*,g.COD_GRADO FROM db_carrera c INNER JOIN db_grado g ON g.COD_CARRERA=c.COD_CARRERA WHERE g.COD_CARRERA=$idGradoAso";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				
				foreach ($arrDatos as $data) {
					$view.="<option value='".$data['COD_GRADO']."'>".$data['NOMBRE_GRADO']."</option>";
				}
				echo $view;
			break;
			case 'llenarCurso':
					$arrDatos="";
					$view="<legend> Listado de Cursos </legend>";
					if(($idCursoAso!="")){						
						$sql = "SELECT g.NOMBRE_GRADO, acg.COD_GRADO, c.NOMBRE_CURSO, c.COD_CURSO FROM db_asig_curso_grado acg JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO WHERE acg.COD_GRADO=$idCursoAso";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				if($arrDatos){
					foreach($arrDatos as $data) {
						$view.="<p><input type='checkbox'  value='".$data['COD_CURSO']."' name='cursos[detalle][nombre][]' /> ".$data['NOMBRE_CURSO']."</p>";
					}
				}else{
					$view.="<p class='text-center'>No se encuentran cursos asignados al grado.</p>";
				}
				echo $view;
			break;
			case 'listarCursos':
				$count=0;
					$arrDatos="";
					if(($idGradoView!="")){						
						$sql = "SELECT g.NOMBRE_GRADO, acg.COD_GRADO, c.NOMBRE_CURSO FROM db_asig_curso_grado acg JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO WHERE acg.COD_GRADO=$idGradoView";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				
				foreach ($arrDatos as $data) {
				++$count;
				echo "<tr><td style='list-style-type: none;'><span class='badge' style='background:#ff0000'>".$count."</span></td><td> ".$data['NOMBRE_CURSO']."</td></tr>";
				}
			break;
					
		default:
			
			break;
	}
	
?>