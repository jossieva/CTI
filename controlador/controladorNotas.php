<?php
require_once '../modelo/modelo.php';
	$seccion=$estudiante=$grado="";	
	if(@$_GET['seccion']){
		$seccion=$_GET['seccion'];
	}		
	$objeto = new Modelo;

		//Variable utilizada para recibir el parametro para listar cursos por grados
	$idAlumno=@$_POST['alumno'];	
	$idActividad=trim(@$_POST['codActividad']);
	$punteo=@$_POST['punteo'];
	$punteo1=@$_POST['punteo1'];	
	$idCursoView=trim(@$_POST['idCursoView']);	
	$idActividad1=trim(@$_POST['idActividad']);		

	//variables de formulario para crear carreras

	switch ($seccion) {
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
			case 'listarAlumnos':
					$count=$nota=0;
					$comillas='"';
					$punteo1=$punteo=0;
					$arrDatos=$arrDatos1=$arrDatos2=$arrDatos3="";
					if(($idCursoView!="")){						
						$sql = "SELECT pe.COD_PERSONA,pe.NOMBRE,pe.APELLIDO, g.COD_GRADO, g.NOMBRE_GRADO FROM db_persona pe JOIN db_asig_grado_persona agp ON agp.COD_PERSONA=pe.COD_PERSONA JOIN db_grado g ON g.COD_GRADO=agp.COD_GRADO JOIN db_asig_curso_grado acg ON acg.COD_GRADO=g.COD_GRADO WHERE acg.COD_CURSO=".$idCursoView;
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
				if(!empty($arrDatos)){// verificamos que la consulta de alumnos no vaya vacia.
					//consulta para obtener el listado de actividades por curso
					$sql1="SELECT cu.NOMBRE_CURSO, a.NOMBRE_ACTIVIDAD, a.COD_UNIDAD, a.COD_ACTIVIDAD FROM db_curso cu JOIN db_asig_curso_grado acg ON acg.COD_CURSO=cu.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=acg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE cu.COD_CURSO=".$idCursoView."  AND u.ESTADO_UNIDAD=1";
					try{				
					 	$rec1 =$GLOBALS['conn']->prepare($sql1);					 	
						$rec1->execute();								
						$arrDatos1 = $rec1->fetchAll();						
					 }catch(PDOException $e){
					 	echo "Error de Conexi&oacute;n";
					 }
					 // mostramso en el encabezado la cantidad de actividades, en la unidad activa
					echo "<thead ><th>No.</th><th>Nombre del Alumno</th>";
						foreach($arrDatos1 as $data1){							
							echo "<th><span  style='transform: rotate(-90deg); text-align:center; font-size:10px'>".$data1['NOMBRE_ACTIVIDAD']."</span></th>";					
						}			
					echo "</thead><tbody>";					
					foreach ($arrDatos as $data){			
					++$count;
					// mostramos los alumnos que corresponden al curso
						echo "<tr><td>".$count."</td><td>".$data['NOMBRE']." ".$data['APELLIDO']."</td>";
						// por cada actividad verificamos si tienen nota asignada o no
						foreach($arrDatos1 as $data1){
							$sql3="SELECT  a.NOMBRE_ACTIVIDAD, a.COD_UNIDAD, aag.NOTA FROM db_curso cu JOIN db_asig_curso_grado acg ON acg.COD_CURSO=cu.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=acg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_asig_acti_grado aag ON aag.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_asig_grado_persona gp ON gp.COD_ASIG_GRADO_P=aag.COD_ASIG_GRADO_P JOIN db_persona pe ON pe.COD_PERSONA=gp.COD_PERSONA JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE cu.COD_CURSO=".$idCursoView."  AND u.ESTADO_UNIDAD= 1 AND pe.COD_PERSONA=".$data['COD_PERSONA']." AND a.COD_ACTIVIDAD=".$data1['COD_ACTIVIDAD'];
							$sql4="SELECT sum(asp.PUNTEO)total FROM db_aspectos asp JOIN db_rubrica ru ON ru.COD_ASPECTO=asp.COD_ASPECTO WHERE ru.COD_ACTIVIDAD=".$data1['COD_ACTIVIDAD'];
							try{				
							 	$rec3 =$GLOBALS['conn']->prepare($sql3);
								$rec4 =$GLOBALS['conn']->prepare($sql4);					 	
								$rec3->execute();						
								$rec4->execute();								
								$arrDatos3 = $rec3->fetchAll();
								$arrDatos4 = $rec4->fetchAll();						
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n";
							 }	
						foreach($arrDatos4 as $data4){
							$punteo=$data4['total'];
						}
								if(!empty($arrDatos3)){
									foreach($arrDatos3 as $data3){
										++$cuenta;
										if($data3['NOTA']!=""){
											echo "<td align='center' style='font-size:12px;'><input value='".$data3['NOTA']."' name='punteo[]' type='text' style='width:40px; border:none' alt='action1' class='press' tabindex='".$count."' disabled='disabled' /> /".$punteo."</td>";	
										}else{
											echo "<td align='center' style='font-size:12px;'><input value='".$punteo1."' name='punteo1[]' type='text' style='width:40px' alt='action2' class='press' tabindex='".$count."' /> /".$punteo."</td>";		
										}
									}											
								}else{
									echo "<td align='center' style='font-size:12px;'><input value='NNI' name='punteo1[]' type='text' style='width:40px;border:none; text-align:center; font-weight:bold;color:#b14f08' disabled='disabled' alt='action2' class='press' tabindex='".$count."' /> /".$punteo."</td>";
								}
						}echo "</tr>";												 	 
					}
					echo "</tbody>";
				}									
			break;		
			case 'listarAlumnosGeneral':
					$count=$nota=$total=$promedio=0;
					$comillas='"';
					$punteo1=$punteo=0;
					$arrDatos=$arrDatos1=$arrDatos2=$arrDatos3="";
					if(($idCursoView!="")){						
						$sql = "SELECT pe.COD_PERSONA,pe.NOMBRE,pe.APELLIDO, g.COD_GRADO, g.NOMBRE_GRADO FROM db_persona pe JOIN db_asig_grado_persona agp ON agp.COD_PERSONA=pe.COD_PERSONA JOIN db_grado g ON g.COD_GRADO=agp.COD_GRADO JOIN db_asig_curso_grado acg ON acg.COD_GRADO=g.COD_GRADO WHERE acg.COD_CURSO=".$idCursoView;
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
				if(!empty($arrDatos)){// verificamos que la consulta de alumnos no vaya vacia.
					//consulta para obtener el listado de actividades por curso
					$sql1="SELECT * FROM db_unidad";
					try{				
					 	$rec1 =$GLOBALS['conn']->prepare($sql1);					 	
						$rec1->execute();								
						$arrDatos1 = $rec1->fetchAll();						
					 }catch(PDOException $e){
					 	echo "Error de Conexi&oacute;n";
					 }
					 // mostramso en el encabezado la cantidad de actividades, en la unidad activa
					echo "<thead ><th>No.</th><th>Nombre del Alumno</th>";
						foreach($arrDatos1 as $data1){							
							echo "<th><span  style='transform: rotate(-90deg); text-align:center; font-size:10px'>".$data1['NOMBRE_UNIDAD']."</span></th>";					
						}			
					echo "<th>Total</th>
							<th>Promedio</th>
							</thead>
						<tbody>";					
					foreach ($arrDatos as $data){			
					++$count;
					// mostramos los alumnos que corresponden al curso
						echo "<tr><td>".$count."</td><td>".$data['NOMBRE']." ".$data['APELLIDO']."</td>";
						// por cada actividad verificamos si tienen nota asignada o no
						foreach($arrDatos1 as $data1){
							$sql3="SELECT a.NOMBRE_ACTIVIDAD, a.COD_UNIDAD, SUM(aag.NOTA) nota FROM db_curso cu JOIN db_asig_curso_grado acg ON acg.COD_CURSO=cu.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=acg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_asig_acti_grado aag ON aag.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_asig_grado_persona gp ON gp.COD_ASIG_GRADO_P=aag.COD_ASIG_GRADO_P JOIN db_persona pe ON pe.COD_PERSONA=gp.COD_PERSONA JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE cu.COD_CURSO=".$idCursoView."  AND pe.COD_PERSONA=".$data['COD_PERSONA']." AND u.COD_UNIDAD=".$data1['COD_UNIDAD'];							
							try{				
							 	$rec3 =$GLOBALS['conn']->prepare($sql3);												 	
								$rec3->execute();																					
								$arrDatos3 = $rec3->fetchAll();													
							 }catch(PDOException $e){
							 	echo "Error de Conexi&oacute;n";
							 }							
							$punteo=100;						
								if(!empty($arrDatos3)){
									++$promedio;
									foreach($arrDatos3 as $data3){
										if($data3['nota']!=""){
											$total+=$data3['nota'];
											if($data3['nota']<60){
												echo "<td align='center' style='font-size:12px;'><span  style='width:40px;border:none; text-align:center; font-weight:bold;color:#f00;'>".$data3['nota']."</span> / ".$punteo."</td>";													
											}else{
												echo "<td align='center' style='font-size:12px;'><span  style='width:40px;border:none; text-align:center; font-weight:bold;color:#000;'>".$data3['nota']."</span> / ".$punteo."</td>";
											}	
										}else{
											echo "<td align='center' style='font-size:12px;'><input value='CPC' name='punteo1[]' type='text' style='width:40px;border:none; text-align:center; font-weight:bold;color:#b14f08;' disabled='disabled' alt='action2' class='press' tabindex='".$count."' /> /".$punteo."</td>";		
										}
									}											
								}else{
									echo "<td align='center' style='font-size:12px;'><input value='CPC' name='punteo1[]' type='text' style='width:40px;border:none; text-align:center; font-weight:bold;color:#b14f08;' disabled='disabled' alt='action2' class='press' tabindex='".$count."' /> /".$punteo."</td>";
								}
						}
						echo "<td align='center' style='font-weight:bold'>".$total."</td>";
						echo "<td align='center' style='font-weight:bold'>".round(($total/$promedio),2)."</td>";
						echo "</tr>";
						$total=$promedio=0;												 	 
					}
					
					echo "</tbody>";
				}									
			break;	
			default:
			
			break;
	}
?>