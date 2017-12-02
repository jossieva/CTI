<?php
require_once '../modelo/modelo.php';
	require_once('../controlador/sesion.php');
	confirmarlogeo();
	$seccion=$estudiante=$grado="";	
	if(@$_GET['seccion']){
		$seccion=$_GET['seccion'];
	}		
	$objeto = new Modelo;
	
	//variables de formulario para crear usuario
	$estudiante=@$_POST['estudiante'];
	$grado=trim(@$_POST['grado']);
	
		//Variable utilizada para recibir el parametro para listar cursos por grados
	$idCursoView=trim(@$_POST['idCursoView']);	
	$idActividad=trim(@$_POST['idActividad']);	
	$idEstudiante=trim(@$_POST['idUser']);
	$idUnidad=trim(@$_POST['idUnidad']);
	$iduser=$_SESSION['id'];
	
		//Variable utilizada para recibir el parametro para listar cursos por grados
	$idGradoView=trim(@$_POST['idGradoView']);		
	

	switch ($seccion) {
		case 'createEstudiante':
			$ingreso=$ingreso1=FALSE;
			$arrDatos="";
			$lastID="";
			if(($grado!="")&&($grado!="0")&&($grado!="--Seleccione--")){
				if($estudiante['detalle']!=""){
						$z=count($estudiante['detalle']['nombre']);
						if($z>=1){
							for($x=0;$x<$z;$x++){
								$nombre=$estudiante["detalle"]["nombre"][$x];
								$apellido=$estudiante["detalle"]["apellido"][$x];
								$correo=$estudiante["detalle"]["correo"][$x];
								$usuario=$estudiante["detalle"]["usuario"][$x];
								$clave=sha1($estudiante["detalle"]["clave"][$x]);
								$sql="INSERT INTO `db_persona`(COD_NIVEL, COD_TIPO_P, NOMBRE, APELLIDO, CORREO, USUARIO, CLAVE) VALUES('3','4','$nombre','$apellido','$correo','$usuario','$clave')";
								try{				
								 	$rec =$GLOBALS['conn']->prepare($sql);
									$rec->execute();	
									$ingreso=TRUE;
								 }catch(PDOException $e){
								 	echo "Error de Conexi&oacute;n";
								 }	
								 if($ingreso==TRUE){
								 	$sql1="SELECT COD_PERSONA FROM db_persona WHERE 1 ORDER BY COD_PERSONA DESC LIMIT 1";
									try{				
									 	$rec1 =$GLOBALS['conn']->prepare($sql1);
										$rec1->execute();	
										$arrDatos = $rec1->fetchAll();
									 }catch(PDOException $e){
									 	echo "Error de Conexi&oacute;n";
									 }
									 foreach ($arrDatos as $data) {
										$lastID=$data['COD_PERSONA'];
									}
									$sql2="INSERT INTO `db_asig_grado_persona`(`COD_GRADO`, `COD_PERSONA`) VALUES ('$grado','$lastID')";
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
									 	$mensaje=array('exito'=>'!Exito¡ Estudiantes creados exitosamente.');
										echo json_encode($mensaje);
									 }
						}else{
						$mensaje=array('error'=>'!Error¡ Debe agregar minimo un Estudiante.');
						echo json_encode($mensaje);
						}
				}else{
						$mensaje=array('error'=>'!Error¡ Debe agregar minimo un Estudiante.');
						echo json_encode($mensaje);
						}
			}else{
						$mensaje=array('error'=>'!Error¡ Debe seleccionar un grado.');
						echo json_encode($mensaje);
						}
			break;
		case 'listarEstudiantes':
					$count=0;
					$arrDatos="";
					if(($idGradoView!="")){						
						$sql = "SELECT g.NOMBRE_GRADO, gp.COD_GRADO, p.NOMBRE, p.APELLIDO FROM db_asig_grado_persona gp JOIN db_grado g ON g.COD_GRADO=gp.COD_GRADO JOIN db_persona p ON p.COD_PERSONA=gp.COD_PERSONA WHERE gp.COD_GRADO=$idGradoView";
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
				echo "<tr><td style='list-style-type: none;'><span class='badge' style='background:#090987'>".$count."</span></td><td> ".$data['NOMBRE']." ".$data['APELLIDO']."</td></tr>";
				}
			break;
		case 'listarAsignaciones':
					$count=0;
					$arrDatos="";
					if(($idGradoView!="")){						
						$sql = "SELECT acg.COD_CURSO_GRADO, c.NOMBRE_CURSO, p.NOMBRE, p.APELLIDO, g.NOMBRE_GRADO, ca.NOMBRE_CARRERA FROM db_asig_curso_grado acg JOIN db_persona p ON p.COD_PERSONA=acg.COD_PERSONA JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_carrera ca ON ca.COD_CARRERA=g.COD_CARRERA WHERE acg.COD_PERSONA=$idGradoView ORDER BY g.COD_GRADO ASC";
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
				echo "<tr><td style='list-style-type: none;'><span class='badge' style='background:#090987'>".$count."</span></td><td> ".$data['NOMBRE_CURSO']."</td> <td>".$data['NOMBRE_GRADO']."</td><td>".$data['NOMBRE_CARRERA']."</td> </tr>";
				}
			break;
			//listado cursos del grado del alumno
		case 'listarNotas':
					$count=$nota=$total=$promedio=0;
					$comillas='"';
					$punteo1=$punteo=0;
					$arrDatos=$arrDatos1=$arrDatos2=$arrDatos3=$arrDatosP="";
					if(($idEstudiante!="")){						
						$sql = "SELECT c.NOMBRE_CURSO,c.COD_CURSO,p.COD_PERSONA,p.NOMBRE,p.APELLIDO, acg.COD_CURSO_GRADO FROM db_curso c JOIN db_asig_curso_grado acg ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_asig_grado_persona agp ON agp.COD_GRADO=g.COD_GRADO JOIN db_persona p ON p.COD_PERSONA=agp.COD_PERSONA WHERE agp.COD_PERSONA=".$idEstudiante;
						
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
				if(!empty($arrDatos)){// verificamos que la consulta de cursos no vaya vacia.
					//consulta para obtener el listado de unidades del sistema
					$sql1="SELECT * FROM db_unidad";
					try{				
					 	$rec1 =$GLOBALS['conn']->prepare($sql1);					 	
						$rec1->execute();								
						$arrDatos1 = $rec1->fetchAll();						
					 }catch(PDOException $e){
					 	echo "Error de Conexi&oacute;n";
					 }
					 // mostramso en el encabezado la cantidad de actividades, en la unidad activa
					echo "<thead ><th>No.</th><th>Nombre del Curso</th>";
						foreach($arrDatos1 as $data1){							
							echo "<th><span  style='transform: rotate(-90deg); text-align:center; font-size:10px'>".$data1['NOMBRE_UNIDAD']."</span></th>";					
						}			
					echo "<th style='text-align:center;'>Total</th>
							<th style='text-align:center;'>Promedio *</th>
							</thead>
						<tbody>";					
					foreach ($arrDatos as $data){			
					++$count;
					// mostramos los alumnos que corresponden al curso
						echo "<tr><td>".$count."</td><td>".$data['NOMBRE_CURSO']."</td>";
						// por cada actividad verificamos si tienen nota asignada o no
						foreach($arrDatos1 as $data1){
							$sql3="SELECT a.NOMBRE_ACTIVIDAD, a.COD_UNIDAD, SUM(aag.NOTA) nota FROM db_curso cu JOIN db_asig_curso_grado acg ON acg.COD_CURSO=cu.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=acg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_asig_acti_grado aag ON aag.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_asig_grado_persona gp ON gp.COD_ASIG_GRADO_P=aag.COD_ASIG_GRADO_P JOIN db_persona pe ON pe.COD_PERSONA=gp.COD_PERSONA JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE cu.COD_CURSO=".$data['COD_CURSO']."  AND pe.COD_PERSONA=".$idEstudiante." AND u.COD_UNIDAD=".$data1['COD_UNIDAD'];							
							try{				
							 	$rec3 =$GLOBALS['conn']->prepare($sql3);												 	
								$rec3->execute();																					
								$arrDatos3 = $rec3->fetchAll();													
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n";
							 }					
								if(!empty($arrDatos3)){
									++$promedio;
									foreach($arrDatos3 as $data3){
										if($data3['nota']!=""){
											$total+=$data3['nota'];
											echo "<td align='center' style='font-size:12px;'><a href='#NotasCurso' class='btn btnListarNotas' alt='".$data['COD_CURSO']."' title='".$data1['COD_UNIDAD']."' ><span style='background:#e3e3e3;padding:4px;font-size:12px'>".$data3['nota']."</span></a></td>";	
										}else{
											echo "<td align='center' style='font-size:12px;'><input value='----' name='punteo1[]' type='text' style='width:40px;border:none; text-align:center; font-weight:bold;color:#b14f08;' disabled='disabled' alt='action2' class='press' tabindex='".$count."' /></td>";		
										}
									}											
								}else{
									echo "<td align='center' style='font-size:12px;'><input value='----' name='punteo1[]' type='text' style='width:40px;border:none; text-align:center; font-weight:bold;color:#b14f08;' disabled='disabled' alt='action2' class='press' tabindex='".$count."' /></td>";
								}
						}
						echo "<td align='center' style='font-weight:bold'>".$total."</td>";
						echo "<td align='center' style='font-weight:bold'>".round(($total/$promedio),2)."</td>";
						echo "</tr>";
						$total=$promedio=0;												 	 
					}
					echo "<tr><td colspan='2' align='center'><strong>PROMEDIO</strong></td>";
					foreach($arrDatos1 as $data1){
						$sqlP = "SELECT g.NOMBRE_GRADO, a.COD_UNIDAD, SUM(aag.NOTA) nota FROM db_curso cu JOIN db_asig_curso_grado acg ON acg.COD_CURSO=cu.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=acg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_asig_acti_grado aag ON aag.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_asig_grado_persona gp ON gp.COD_ASIG_GRADO_P=aag.COD_ASIG_GRADO_P JOIN db_persona pe ON pe.COD_PERSONA=gp.COD_PERSONA JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE pe.COD_PERSONA=".$idEstudiante." AND u.COD_UNIDAD=".$data1['COD_UNIDAD']."  GROUP BY g.COD_GRADO";
						try{				
						 	$recP =$GLOBALS['conn']->prepare($sqlP);
							$recP->execute();	
							$arrDatosP = $recP->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }						
						 if(!empty($arrDatosP)){
						 	foreach($arrDatosP as $dataP){
								echo "<td align='center'>".round(($dataP['nota']/$count),2)."</td>"; 	
							 }	
						 }else{
						 	echo "<td align='center'>---</td>";
						 }
						 					
					}	
					echo "</tr>";
				echo "</tbody>";
				
				}	
				echo "<script>
							$('.btnListarNotas').click(function(e){
						  	e.preventDefault();
							var curso =$(this).attr('alt');
							var unidad =$(this).attr('title');
							$('#NotasCurso').modal();
							$('#listActividadesNotas').load('../CTI/controlador/controladorEstudiante.php?seccion=listarActividadesEstudiantes',{'idCursoView':curso,'idUnidad':unidad});			
					});						
							</script>";					
			break;
		case 'listarActividadesEstudiantes':
					$count=0;
					$arrDatos=$arrDatos1=$arrDatos2="";
					if(($idCursoView!="")){						
						$sql = "SELECT cu.NOMBRE_CURSO, pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD, a.DESCRIPCION_ACTIVIDAD, a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD, a.FECHA_ACTIVIDAD, acg.NOTA FROM db_plan_curso pc JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_asig_acti_grado acg ON acg.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_asig_grado_persona agp ON agp.COD_ASIG_GRADO_P=acg.COD_ASIG_GRADO_P JOIN db_curso cu ON cu.COD_CURSO=cg.COD_CURSO JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE cg.COD_CURSO=$idCursoView AND u.COD_UNIDAD=$idUnidad AND agp.COD_PERSONA=$iduser ORDER BY a.FECHA_ACTIVIDAD DESC ";
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
					if($data['COD_ACTIVIDAD']!=""){						
						$sql2="SELECT sum(asp.PUNTEO)total FROM db_aspectos asp JOIN db_rubrica ru ON ru.COD_ASPECTO=asp.COD_ASPECTO WHERE ru.COD_ACTIVIDAD=".$data['COD_ACTIVIDAD'];
						try{									 	
						 	$reC2 =$GLOBALS['conn']->prepare($sql2);							
							$reC2->execute();								
							$arrDatos2 = $reC2->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }
					}
				echo '<tr>
					
						<td class="col-md-3 col-sm-3 col-xs-3">
							<span style="text-align: center;font-size: 14px;border-bottom-style: solid; font-family:Arial, Helvetica, sans-serif;" >'.$data['NOMBRE_ACTIVIDAD'].'</span><br />
							<span style="font-style: italic;font-size:12px;"><strong>Fecha de Entrega: </strong>'.$data['FECHA_ACTIVIDAD'].'</span><br />
						</td>
						<td class="col-md-3 col-sm-3 col-xs-2 text-center">';
						
							if($data['NOTA']!=""){
								echo '<span class="align-middle" style="background:#5cb85c;color:#fff;font-size: 14px;font-weight: bold; border-radius: 5px;border: solid;padding:5px;">'.$data['NOTA'].' /';
								foreach($arrDatos2 as $data2){
									if($data2['total']!=""){
										echo ' '.$data2['total'].'</span>';
									}else{
										echo ' 0 </span>';
									}
								}
							}else{
								echo '<span class="align-middle" style="background:#5cb85c;color:#fff;font-size: 3em;font-weight: bold; border-radius: 5px;border: solid;padding:5px;">0</span>';
							}
						
						echo '</td>
					</tr>';					
				}				
			}else{
				echo "Sin Información.";
			}
			break;			
		default:			
			break;
	}
?>