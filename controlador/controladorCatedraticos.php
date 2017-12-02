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
	$people="";
	$activity=trim(@$_POST['actividad']);
	$idCatedratico=trim(@$_POST['idCatedratico']);
	
		//Variable utilizada para recibir el parametro para listar cursos por grados
	$idCursoView=trim(@$_POST['idCursoView']);	
	$idActividad=trim(@$_POST['idActividad']);	
	$idEstudiante=trim(@$_POST['idEstudiante']);
	
	//variables de formulario para crear carreras
	$actividad=trim(@$_POST['actividad']);
	$descripcion=trim(@$_POST['descripcionActividad']);	
	$fechaEntrega=trim(@$_POST['fechaEntrega']);
	$cursoGrado=trim(@$_POST['cursoGrado']);
	$aspectosActividad=(@$_POST['aspecto']);
	$codAspecto=(@$_POST['codAspecto']);
	$idUnidad=trim(@$_POST['idUnidad']);
	$idUpdateActividad=trim(@$_POST['codigoActividad']);
		
		
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
		case 'listarAlumnos':
					$count=$nota=0;
					$comillas='"';
					$punteo1=$punteo=0;
					
					$arrDatos=$arrDatos1=$arrDatos2=$arrDatos3="";
					if(($idCursoView!="")){						
						$sql = "SELECT pe.COD_PERSONA,pe.NOMBRE,pe.APELLIDO, c.NOMBRE_CURSO, gp.COD_ASIG_GRADO_P, cg.COD_PERSONA as maestro FROM db_persona pe JOIN db_asig_grado_persona gp ON gp.COD_PERSONA=pe.COD_PERSONA JOIN db_grado g ON g.COD_GRADO=gp.COD_GRADO JOIN db_asig_curso_grado cg ON cg.COD_GRADO=g.COD_GRADO JOIN db_curso c ON c.COD_CURSO=cg.COD_CURSO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=cg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD WHERE a.COD_ACTIVIDAD=".$idActividad." AND c.COD_CURSO=".$idCursoView." GROUP BY pe.COD_PERSONA";
						echo $sql;
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
					$sql1="SELECT sum(asp.PUNTEO)total FROM db_aspectos asp JOIN db_rubrica ru ON ru.COD_ASPECTO=asp.COD_ASPECTO WHERE ru.COD_ACTIVIDAD=".$idActividad;
					try{				
					 	$rec1 =$GLOBALS['conn']->prepare($sql1);					 	
						$rec1->execute();								
						$arrDatos1 = $rec1->fetchAll();						
					 }catch(PDOException $e){
					 	echo "Error de Conexi&oacute;n";
					 }
				if(!empty($arrDatos)){
					foreach ($arrDatos as $data){			
					++$count;		
					$people=$data['maestro'];
						foreach($arrDatos1 as $data2){
							$punteo=$data2['total'];
						}
						echo "<tr><td>".$count."</td><td>".$data['NOMBRE']." ".$data['APELLIDO']."<input value='".$data['COD_ASIG_GRADO_P']."' type='hidden' name='alumno[detalle][ide][]' /></td><td>";
						$sql3="SELECT pe.COD_PERSONA,pe.NOMBRE,pe.APELLIDO, c.NOMBRE_CURSO,ag.NOTA FROM db_persona pe JOIN db_asig_grado_persona gp ON gp.COD_PERSONA=pe.COD_PERSONA JOIN db_grado g ON g.COD_GRADO=gp.COD_GRADO JOIN db_asig_curso_grado cg ON cg.COD_GRADO=g.COD_GRADO JOIN db_curso c ON c.COD_CURSO=cg.COD_CURSO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=cg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_asig_acti_grado ag ON ag.COD_ASIG_GRADO_P=gp.COD_ASIG_GRADO_P WHERE ag.COD_ACTIVIDAD=".$idActividad." AND c.COD_CURSO=".$idCursoView."  AND pe.COD_PERSONA=".$data['COD_PERSONA']." GROUP BY pe.COD_PERSONA";
						try{				
						 	$rec3 =$GLOBALS['conn']->prepare($sql3);					 	
							$rec3->execute();								
							$arrDatos3 = $rec3->fetchAll();						
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }
						
						if(!empty($arrDatos3)){
									$nota=count($arrDatos3);							
							foreach ($arrDatos3 as $data3){
								$notas=$data3['NOTA'];
								echo "<input value='".$data3['NOTA']."' name='punteo[]' type='text' style='width:40px' alt='action1' class='press' tabindex='".$count."' /> /".$punteo."</td></tr>";
							}							
						}else{
							echo "<input value='".$punteo1."' name='punteo1[]' type='text' style='width:40px' alt='action2' class='press' tabindex='".$count."' /> /".$punteo."</td></tr>";
						}													 	 
					}								

						if($nota>0){
							echo "<tr><td colspan='3' align='center'>							
					    	<a class='btn btn-danger submitEditNotaActividad' onclick=".$comillas."submitUpdateNotaActividadA('$idCursoView','$people')".$comillas.">Actualizar <i class='fa fa-'></i></a>
					    	</td></tr>";
						}else{
							echo "<tr><td colspan='3' align='center'>
					    	<a class='btn btn-primary submitGrabarNotaActividad' onclick=".$comillas."submitGrabarNotaActividadA('$idCursoView','$people')".$comillas.">Guardar  <i class='fa fa-floppy-o'></i></a>
					    	</td></tr>";
						}
					echo "<script>
								   $('.press').keypress(function(e) {								 	
							       if(e.which == 13){
										cb = parseInt($(this).attr('tabindex'));
										if ( $(':input[tabindex=\'' + (cb + 1) + '\']') != null) {
										$(':input[tabindex=\'' + (cb + 1) + '\']').focus();
										$(':input[tabindex=\'' + (cb + 1) + '\']').select();
										return false;
										}
									}
							    });						
							</script>";
				}									
			break;
		case 'mostraRegreso':
				$comillas='"';
				$arrDatos="";
				$persona="";
				if(($idCursoView!="")){						
						$sql = "SELECT cu.NOMBRE_CURSO,cg.COD_PERSONA, pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD, a.DESCRIPCION_ACTIVIDAD, a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD, a.FECHA_ACTIVIDAD FROM db_plan_curso pc JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_curso cu ON cu.COD_CURSO=cg.COD_CURSO JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE pc.COD_CURSO_GRADO=$idCursoView AND u.ESTADO_UNIDAD=1 ORDER BY a.FECHA_ACTIVIDAD DESC ";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	//echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				foreach($arrDatos as $datos){
					$persona=$datos['COD_PERSONA'];
					break;
				}
				
				echo "<i class='fa fa-chevron-left'><a href='#' onclick=".$comillas."redirectPage6('actividadesA', '$idCursoView','$persona')".$comillas."> Regresar</a> </i>";
			break;
		case 'listarCurso':
					$count=0;
					$com='"';
					$arrDatos="";
					if(($idCatedratico!="")){						
						$sql = "SELECT acg.COD_CURSO_GRADO, c.NOMBRE_CURSO,c.COD_CURSO, g.NOMBRE_GRADO, g.COD_GRADO ,ca.NOMBRE_CARRERA,ca.COD_CARRERA,j.JORNADA, j.COD_JORNADA, p.NOMBRE, p.APELLIDO, p.COD_PERSONA FROM db_asig_curso_grado acg JOIN db_persona p ON p.COD_PERSONA=acg.COD_PERSONA JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_carrera ca on ca.COD_CARRERA=g.COD_CARRERA JOIN db_jornada j ON j.COD_JORNADA=ca.COD_JORNADA WHERE acg.COD_PERSONA=".$idCatedratico." ORDER BY g.COD_GRADO ASC ";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	//echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				foreach ($arrDatos as $data) {
					echo "<tr>
						<td class='col-md-2 col-sm-2 col-xs-2'>
							<i class='fa fa-book fa-3x'></i>
						</td>
						<td class='col-md-6 col-sm-6 col-xs-5'>
							<span style='text-align: center;font-size: 2rem;border-bottom-style: solid; font-family:Arial, Helvetica, sans-serif;' >".$data['NOMBRE_CURSO']."</span><br />
							<span style='font-style: italic'>".$data['NOMBRE_GRADO']." / ".$data['NOMBRE_CARRERA']." / ".$data['JORNADA']."</span>
						</td>
						<td class='col-md-4 col-sm-4 col-xs-2'>
							<ul class='btn-group-xs' role='group'>
								<li data-toggle='tooltip'  title='Creación de Actividades' class='btn btn-default actividades fa fa-check'><a onclick=".$com."redirectPage6('actividadesA','".$data['COD_CURSO_GRADO']."','".$data['COD_PERSONA']."')".$com." > Actividades</a></li>
								<li data-toggle='tooltip'  title='Ver Notas' class='btn btn-default notas fa fa-sticky-note'><a onclick=".$com."redirectPage5('notasCurso','".$data['COD_CURSO_GRADO']."','".$data['COD_PERSONA']."')".$com."> Notas</a></li>
								<li data-toggle='tooltip'  title='Notas por actividades' class='btn btn-default reporteCurso fa fa-list-alt' ><a onclick=".$com."redirectPage5('notasUnidad','".$data['COD_CURSO_GRADO']."','".$data['COD_PERSONA']."')".$com."> General</a></li>
								<li data-toggle='tooltip'  title='Reporte Actividades' class='btn btn-default reporte fa fa-file-pdf-o'><a target='_blank'  href='../cti/vista/reportes/actividades.php?curso=".$data['COD_CURSO_GRADO']."'> Reporte</a></li>
							</ul>
						</td><tr>";
				}		
			break;
		case 'mostrarCatedratico':
					$count=0;
					$arrDatos="";
					if(($idCatedratico!="")){						
						$sql = "SELECT p.* FROM db_persona p WHERE p.COD_PERSONA=".$idCatedratico;
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	//echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				foreach ($arrDatos as $data) {
					echo "<th colspan='4'>Catedratico: ".$data['NOMBRE']." ".$data['APELLIDO']."</th>";
				}
		
			break;
		case 'listarActividades':
					$count=0;
					$arrDatos=$arrDatos1=$arrDatos2="";
					if(($idCursoView!="")){						
						$sql = "SELECT cu.NOMBRE_CURSO,cg.COD_PERSONA, pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD, a.DESCRIPCION_ACTIVIDAD, a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD, a.FECHA_ACTIVIDAD FROM db_plan_curso pc JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_curso cu ON cu.COD_CURSO=cg.COD_CURSO JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE pc.COD_CURSO_GRADO=$idCursoView AND u.ESTADO_UNIDAD=1 ORDER BY a.FECHA_ACTIVIDAD DESC ";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	//echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				if(!empty($arrDatos)){
				foreach ($arrDatos as $data) {
					++$count;
					$people=$data['COD_PERSONA'];
					if($data['COD_ACTIVIDAD']!=""){
						$sql1="SELECT asp.DESCRIPCION_ASPECTO, asp.PUNTEO FROM db_aspectos asp JOIN db_rubrica ru ON ru.COD_ASPECTO=asp.COD_ASPECTO JOIN db_actividad ac ON ac.COD_ACTIVIDAD=ru.COD_ACTIVIDAD WHERE ru.COD_ACTIVIDAD=".$data['COD_ACTIVIDAD'];
						$sql2="SELECT sum(asp.PUNTEO)total FROM db_aspectos asp JOIN db_rubrica ru ON ru.COD_ASPECTO=asp.COD_ASPECTO WHERE ru.COD_ACTIVIDAD=".$data['COD_ACTIVIDAD'];
						try{				
						 	$rec1 =$GLOBALS['conn']->prepare($sql1);
						 	$reC2 =$GLOBALS['conn']->prepare($sql2);
							$rec1->execute();	
							$reC2->execute();	
							$arrDatos1 = $rec1->fetchAll();
							$arrDatos2 = $reC2->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }
					}
				echo '<tr>
						<td class="col-md-2 col-sm-2 col-xs-2 text-center">';
						foreach($arrDatos2 as $data2){
							if($data2['total']!=""){
								echo '<span class="align-middle" style="background:#005747;color:#fff;font-size: 4rem;font-weight: bold; border-radius: 5px;border: solid;padding:5px;">'.$data2['total'].'</span>';
							}else{
								echo '<span class="align-middle" style="background:#005747;color:#fff;font-size: 4rem;font-weight: bold; border-radius: 5px;border: solid;padding:5px;">0</span>';
							}
						}
						echo '</td>
						<td class="col-md-3 col-sm-3 col-xs-3">
							<span style="text-align: center;font-size: 2rem;border-bottom-style: solid; font-family:Arial, Helvetica, sans-serif;" >'.$data['NOMBRE_ACTIVIDAD'].'</span><br />
							<span style="font-style: italic">'.utf8_encode($data['DESCRIPCION_ACTIVIDAD']).'</span><br />
							<span style="font-style: italic"><strong>Fecha de Entrega: </strong>'.$data['FECHA_ACTIVIDAD'].'</span><br />
						</td>
						<td class="col-md-4 hidden-sm hidden-xs">
							<ul class="">';
							foreach($arrDatos1 as $data1){
								echo '<li data-toggle="tooltip"  title="Aspectos" class="col-md-10"><a>'.$data1['DESCRIPCION_ASPECTO'].' </a><span class="col-md-1 align-middle pull-right" style="background:#000000;color:#fff;font-size: 1rem;font-weight: bold; border-radius: 2px;border: solid 1px #000;padding:1px 5px;">'.$data1['PUNTEO'].'</span></li>';
							}
								
						echo'</ul>
						</td>						
						<td class="col-md-3 col-sm-3 col-xs-2">
							<ul class="btn-group-xs" role="group">
								<li data-toggle="tooltip"  title="Agregar de Aspectos" class=" btn btn-default fa fa-pencil"><a onclick=modificarActividadA("'.$data['COD_ACTIVIDAD'].'","'.$idCursoView.'")  > Editar</a></li><br/>
								<li data-toggle="tooltip"  title="Ingreso de Notas" class="btn btn-default notas fa fa-list" ><a onclick=redirectPage8("notaActividad","'.$idCursoView.'","'.$data['COD_ACTIVIDAD'].'")> Notas</a></li><br/>
								<li data-toggle="tooltip"  title="Agregar de Aspectos" class=" btn btn-default actividades fa fa-trash"><a onclick=deleteCA("'.$data['COD_ACTIVIDAD'].'","actividades","'.$idCursoView.'") > Borrar</a></li>
								
							</ul>
						</td>
					</tr>';
				}
			}else{
				echo "Sin Información.";
			}
			break;
		case 'mostrarRegresoCurso':
					$arrDatos="";
					$catedratico="";
					$comillas='"';
					if(($idCursoView!="")){						
						$sql = "SELECT cu.NOMBRE_CURSO,cg.COD_PERSONA, pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD, a.DESCRIPCION_ACTIVIDAD, a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD, a.FECHA_ACTIVIDAD FROM db_plan_curso pc JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_curso cu ON cu.COD_CURSO=cg.COD_CURSO JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE pc.COD_CURSO_GRADO=$idCursoView AND u.ESTADO_UNIDAD=1 ORDER BY a.FECHA_ACTIVIDAD DESC ";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrDatos = $rec->fetchAll();
						 }catch(PDOException $e){
						 	//echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				if(!empty($arrDatos)){
					foreach ($arrDatos as $data) {
						$catedratico=$data['COD_PERSONA'];
					}
				}				
				echo "<i class='fa fa-chevron-left'><a href='#' onclick=".$comillas."redirectPageM('cursos','$catedratico')".$comillas."> Regresar</a> </i>";
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
		case 'updateActivity':
				if(($idUpdateActividad!="")){
					if($fechaEntrega!=""){
						$ingreso=$ingreso2=FALSE;
							$sql = "UPDATE `db_actividad` SET NOMBRE_ACTIVIDAD= '$actividad', DESCRIPCION_ACTIVIDAD='$descripcion', FECHA_ACTIVIDAD='$fechaEntrega', COD_UNIDAD='$idUnidad' WHERE COD_ACTIVIDAD=".$idUpdateActividad;
							//echo $sql;
							try{				
							 	$rec =$GLOBALS['conn']->prepare($sql);
								$rec->execute();	
								$ingreso=TRUE;
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n";
							 }	
						if($ingreso==TRUE){
							if($codAspecto['detalle']!=""){
								//echo "entramos";
									$z=count($codAspecto['detalle']);
									if($z>=1){
										for($x=0;$x<$z;$x++){
											$codigo=$codAspecto["detalle"][$x];
											$nombre=$aspectosActividad["detalle"]["nombre"][$x];
											$punteo=$aspectosActividad["detalle"]["punteo"][$x];
											$sqlA="UPDATE `db_aspectos`SET DESCRIPCION_ASPECTO='$nombre', PUNTEO='$punteo' WHERE COD_ASPECTO=".$codigo.";";
											//echo $sqlA;
											try{				
											 	$recA =$GLOBALS['conn']->prepare($sqlA);
												$recA->execute();	
												$ingreso2=TRUE;
											 }catch(PDOException $e){
											 	echo "Error de Conexi&oacute;n";
											 }
										}
										if($ingreso2==TRUE){
											$mensaje=array('exito'=>'Datos actualizados exitosamente.');
											echo json_encode($mensaje);	
										}
									}
								}
							}else{
								$mensaje=array('error'=>'!Error¡en actualización de actividad.');
								echo json_encode($mensaje);	
							}
						
					}else{
						$mensaje=array('error'=>'!Verifique que todos los campos han sido ingresados.!');
						echo json_encode($mensaje);
					}
				}else{
					$mensaje=array('error'=>'!Error¡Ingrese nombre de la Actividad.');
					echo json_encode($mensaje);
				}			
			break;
		default:
			
			break;
	}

?>