<?php
require_once '../modelo/modelo.php';
	$seccion=$estudiante=$grado="";	
	if(@$_GET['seccion']){
		$seccion=$_GET['seccion'];
	}		
	$objeto = new Modelo;

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
		case 'listarAlumno':
					$count=0;
					$punteo1=$punteo=0;
					$arrDatos=$arrDatos1=$arrDatos2="";
					if(($idCursoView!="")){						
						$sql = "SELECT pe.COD_PERSONA,pe.NOMBRE,pe.APELLIDO, g.NOMBRE_GRADO, agp.COD_ASIG_GRADO_P,pc.COD_ACTIVIDAD FROM db_persona pe JOIN db_asig_grado_persona agp ON agp.COD_PERSONA=pe.COD_PERSONA JOIN db_grado g ON g.COD_GRADO=agp.COD_GRADO JOIN db_asig_curso_grado acg ON acg.COD_GRADO=g.COD_GRADO JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=acg.COD_CURSO_GRADO WHERE c.COD_CURSO=".$idCursoView." GROUP BY pe.COD_PERSONA";
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
					
				
					++$count;
				foreach($arrDatos2 as $data2){
					$punteo=$data2['total'];
				}
				
				echo "<tr><td>".$count."</td><td>".$data['NOMBRE']." ".$data['APELLIDO']."<input value='".$data['COD_ASIG_GRADO_P']."' type='hidden' name='alumno[detalle][ide][]' /></td><td><input name='punteo[detalle][nota][]' type='text' value='".$punteo1."' style='width:5%' /><span> /".$punteo."</span> </td></tr>";
				}
			break;
		case 'mostraRegreso':
				$comillas='"';
				echo "<i class='fa fa-chevron-left'><a href='#' onclick=".$comillas."redirectPage1('actividades', '$idCursoView')".$comillas."> Regresar</a> </i>";
			break;
		
		case 'actividadNota':
					$arrDatos="";
					if(($idActividad!="")){						
						$sql = "SELECT cu.NOMBRE_CURSO,pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD,a.DESCRIPCION_ACTIVIDAD,a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD, a.FECHA_ACTIVIDAD FROM db_plan_curso pc JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_curso cu ON cu.COD_CURSO=cg.COD_CURSO JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE a.COD_ACTIVIDAD=$idActividad ORDER BY a.FECHA_ACTIVIDAD DESC ";
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
					if($data['COD_ACTIVIDAD']!=""){
						$sql1="SELECT asp.DESCRIPCION_ASPECTO, asp.PUNTEO FROM db_aspectos asp JOIN db_rubrica ru ON ru.COD_ASPECTO=asp.COD_ASPECTO JOIN db_actividad ac ON ac.COD_ACTIVIDAD=ru.COD_ACTIVIDAD WHERE ru.COD_ACTIVIDAD=".$data['COD_ACTIVIDAD'];
						
						try{				
						 	$rec1 =$GLOBALS['conn']->prepare($sql1);						
							$rec1->execute();								
							$arrDatos1 = $rec1->fetchAll();						
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }
					}
				echo '<div clas="col-md-12">
						<div class="col-md-7 col-sm-7 col-xs-7">
							<input type="hidden" name="codActividad" value="'.$data['COD_ACTIVIDAD'].'" />
							<span style="text-align: center;font-size: 2rem;border-bottom-style: solid; font-family:Arial, Helvetica, sans-serif;color:#fff" >'.$data['NOMBRE_ACTIVIDAD'].'</span><br />
							<span style="font-style: italic;color:#fff">'.utf8_encode($data['DESCRIPCION_ACTIVIDAD']).'</span><br />
							<span style="font-style: italic;color:#fff"><strong>Fecha de Entrega: </strong>'.$data['FECHA_ACTIVIDAD'].'</span><br />
						</div>
						<div class="col-md-5 hidden-sm hidden-xs">
							<ul class="">';
							foreach($arrDatos1 as $data1){
								echo '<li data-toggle="tooltip"  title="Aspectos" class="col-md-10"><a style="color:#fff;list-style:none;">'.$data1['DESCRIPCION_ASPECTO'].' </a><span class="col-md-1 align-middle pull-right" style="background:#fff;color:#000;font-size: 1rem;font-weight: bold; border-radius: 2px;border: solid 1px #000;padding:1px 5px;">'.$data1['PUNTEO'].'</span></li>';
							}
								
						echo'</ul>
						</div>						
					</div>';
				}
			
			break;
			//listado alumnos para notas por actividad
		case 'listarAlumnos':
					$count=$nota=0;
					$comillas='"';
					$punteo1=$punteo=0;
					$arrDatos=$arrDatos1=$arrDatos2=$arrDatos3="";
					if(($idCursoView!="")){						
						$sql = "SELECT pe.COD_PERSONA,pe.NOMBRE,pe.APELLIDO, c.NOMBRE_CURSO, gp.COD_ASIG_GRADO_P FROM db_persona pe JOIN db_asig_grado_persona gp ON gp.COD_PERSONA=pe.COD_PERSONA JOIN db_grado g ON g.COD_GRADO=gp.COD_GRADO JOIN db_asig_curso_grado cg ON cg.COD_GRADO=g.COD_GRADO JOIN db_curso c ON c.COD_CURSO=cg.COD_CURSO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=cg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD WHERE a.COD_ACTIVIDAD=".$idActividad." AND c.COD_CURSO=".$idCursoView." GROUP BY pe.COD_PERSONA";
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
					    	<a class='btn btn-danger submitEditNotaActividad' onclick=".$comillas."submitUpdateNotaActividad('$idCursoView')".$comillas.">Actualizar <i class='fa fa-'></i></a>
					    	</td></tr>";
						}else{
							echo "<tr><td colspan='3' align='center'>
					    	<a class='btn btn-primary submitGrabarNotaActividad' onclick=".$comillas."submitGrabarNotaActividad('$idCursoView')".$comillas.">Guardar  <i class='fa fa-floppy-o'></i></a>
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
		case 'listarCurso':
					$count=0;
					$arrDatos="";
					if(($idCursoView!="")){						
						$sql = "SELECT acg.COD_CURSO_GRADO, c.NOMBRE_CURSO, p.NOMBRE, p.APELLIDO FROM db_asig_curso_grado acg JOIN db_persona p ON p.COD_PERSONA=acg.COD_PERSONA JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO WHERE acg.COD_CURSO_GRADO=$idCursoView ORDER BY g.COD_GRADO ASC ";
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
				echo "<i class='fa fa-caret-right'></i> ACTIVIDADES(".$data['NOMBRE_CURSO'].")";
				}
			break;
			case 'listarCursoN':
					$count=0;
					$arrDatos=$arrDato1=$unidad="";
					if(($idCursoView!="")){						
						$sql = "SELECT acg.COD_CURSO_GRADO, c.NOMBRE_CURSO, p.NOMBRE, p.APELLIDO FROM db_asig_curso_grado acg JOIN db_persona p ON p.COD_PERSONA=acg.COD_PERSONA JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO WHERE acg.COD_CURSO_GRADO=$idCursoView ORDER BY g.COD_GRADO ASC ";
						$sql1 = "SELECT u.NOMBRE_UNIDAD FROM db_unidad u WHERE u.ESTADO_UNIDAD=1 ";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec1 =$GLOBALS['conn']->prepare($sql1);
							$rec->execute();	
							$rec1->execute();	
							$arrDatos = $rec->fetchAll();
							$arrDato1 = $rec1->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				
				foreach ($arrDato1 as $data1) {
					$unidad=$data1['NOMBRE_UNIDAD'];
				}
				foreach ($arrDatos as $data) {
					++$count;
				echo "<h3 align='center' style='font-weight:bold; font-size:3rem;'>Curso: ".$data['NOMBRE_CURSO']."<span style='font-style:none; font-size:1.5rem'> ( ".$unidad." )</span></h3>";
				}
			break;
			case 'listarCursoU':
					$count=0;
					$arrDatos=$arrDato1=$unidad="";
					if(($idCursoView!="")){						
						$sql = "SELECT acg.COD_CURSO_GRADO, c.NOMBRE_CURSO, p.NOMBRE, p.APELLIDO FROM db_asig_curso_grado acg JOIN db_persona p ON p.COD_PERSONA=acg.COD_PERSONA JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO WHERE acg.COD_CURSO_GRADO=$idCursoView ORDER BY g.COD_GRADO ASC ";
						$sql1 = "SELECT u.NOMBRE_UNIDAD FROM db_unidad u WHERE u.ESTADO_UNIDAD=1 ";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec1 =$GLOBALS['conn']->prepare($sql1);
							$rec->execute();	
							$rec1->execute();	
							$arrDatos = $rec->fetchAll();
							$arrDato1 = $rec1->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
					}else{
						$mensaje=array('error'=>'!Error¡');						
					}
				
				foreach ($arrDato1 as $data1) {
					$unidad=$data1['NOMBRE_UNIDAD'];
				}
				foreach ($arrDatos as $data) {
					++$count;
				echo "<h3 align='center' style='font-weight:bold; font-size:3rem;color:#fff'>Curso: ".$data['NOMBRE_CURSO']."</h3>";
				}
			break;
			case 'listarGrado':
					$count=0;
					$arrDatos=$arrDato1=$unidad="";
					if(($idCursoView!="")){						
						$sql = "SELECT acg.COD_CURSO_GRADO, c.NOMBRE_CURSO, g.NOMBRE_GRADO FROM db_asig_curso_grado acg JOIN db_persona p ON p.COD_PERSONA=acg.COD_PERSONA JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO WHERE acg.COD_CURSO_GRADO=$idCursoView ORDER BY g.COD_GRADO ASC ";						
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
				echo "<h3 align='center' style='font-weight:bold; font-size:3rem; color:#fff'>Grado: ".$data['NOMBRE_GRADO']."</h3>";
				}
			break;
		case 'listarActividades':
					$count=0;
					$arrDatos=$arrDatos1=$arrDatos2="";
					if(($idCursoView!="")){						
						$sql = "SELECT cu.NOMBRE_CURSO, pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD, a.DESCRIPCION_ACTIVIDAD, a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD, a.FECHA_ACTIVIDAD FROM db_plan_curso pc JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_curso cu ON cu.COD_CURSO=cg.COD_CURSO JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE pc.COD_CURSO_GRADO=$idCursoView AND u.ESTADO_UNIDAD=1 ORDER BY a.FECHA_ACTIVIDAD DESC ";
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
								echo '<span class="align-middle" style="background:#04369a;color:#fff;font-size: 4rem;font-weight: bold; border-radius: 5px;border: solid;padding:5px;">'.$data2['total'].'</span>';
							}else{
								echo '<span class="align-middle" style="background:#04369a;color:#fff;font-size: 4rem;font-weight: bold; border-radius: 5px;border: solid;padding:5px;">0</span>';
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
								<li data-toggle="tooltip"  title="Agregar de Aspectos" class=" btn btn-default fa fa-pencil"><a onclick=modificarActividad("'.$data['COD_ACTIVIDAD'].'","'.$idCursoView.'")  > Editar</a></li><br/>
								<li data-toggle="tooltip"  title="Ingreso de Notas" class="btn btn-default notas fa fa-list" ><a onclick=redirectPage3("notaActividad","'.$idCursoView.'","'.$data['COD_ACTIVIDAD'].'")> Notas</a></li><br/>
								<li data-toggle="tooltip"  title="Ver Aspectos" class="btn btn-default notas fa fa-check visible-sm visible-xs"><a href="#"> Aspectos</a></li>
								<li data-toggle="tooltip"  title="Agregar de Aspectos" class=" btn btn-default actividades fa fa-trash"><a onclick=deleteC("'.$data['COD_ACTIVIDAD'].'","actividades","'.$idCursoView.'") > Borrar</a></li>
								
							</ul>
						</td>
					</tr>';
				}
			}else{
				echo "Sin Información.";
			}
			break;
		case 'listarActividadesP':
					$count=0;
					$arrDatos=$arrDatos1=$arrDatos2="";
					if(($idCursoView!="")){						
						$sql = "SELECT cu.NOMBRE_CURSO, pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD, a.DESCRIPCION_ACTIVIDAD, a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD, a.FECHA_ACTIVIDAD FROM db_plan_curso pc JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_curso cu ON cu.COD_CURSO=cg.COD_CURSO JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE pc.COD_CURSO_GRADO=$idCursoView AND u.ESTADO_UNIDAD=1 ORDER BY a.FECHA_ACTIVIDAD DESC ";
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
								echo '<span class="align-middle" style="background:#5cb85c;color:#fff;font-size: 4rem;font-weight: bold; border-radius: 5px;border: solid;padding:5px;">'.$data2['total'].'</span>';
							}else{
								echo '<span class="align-middle" style="background:#5cb85c;color:#fff;font-size: 4rem;font-weight: bold; border-radius: 5px;border: solid;padding:5px;">0</span>';
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
					</tr>';
				}
				echo "<tr align='center'><td colspan='3'>			
					<a class='btn btn-default' href='../cti/vista/reportes/actividades.php?curso=$idCursoView' target='_blank'><i class='fa fa-print fa-3x' style='color: #5cb85c'></i></a>
				</td>
		</tr>";
			}else{
				echo "Sin Información";
			}
			break;
		case 'listarActividadesEstudiantes':
					$count=0;
					$arrDatos=$arrDatos1=$arrDatos2="";
					if(($idCursoView!="")){						
						$sql = "SELECT cu.NOMBRE_CURSO, pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD, a.DESCRIPCION_ACTIVIDAD, a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD, a.FECHA_ACTIVIDAD, acg.NOTA FROM db_plan_curso pc JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_asig_acti_grado acg ON acg.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_asig_grado_persona agp ON agp.COD_ASIG_GRADO_P=acg.COD_ASIG_GRADO_P JOIN db_curso cu ON cu.COD_CURSO=cg.COD_CURSO JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE pc.COD_CURSO_GRADO=$idCursoView AND u.ESTADO_UNIDAD=1 AND agp.COD_PERSONA=$idEstudiante ORDER BY a.FECHA_ACTIVIDAD DESC ";
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
						<td class="col-md-3 col-sm-3 col-xs-2 text-center">';
						
							if($data['NOTA']!=""){
								echo '<span class="align-middle" style="background:#5cb85c;color:#fff;font-size: 18px;font-weight: bold; border-radius: 5px;border: solid;padding:5px;">'.$data['NOTA'].' /';
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
		case 'createActivity':
			$lastID="";
			$lastIdAs="";
			if(($actividad!="")){
				if($fechaEntrega!=""){
					$ingreso=$ingreso1=$ingreso2=$ingreso3=FALSE;
						$sql = "INSERT INTO `db_actividad`(NOMBRE_ACTIVIDAD,DESCRIPCION_ACTIVIDAD,FECHA_ACTIVIDAD,COD_UNIDAD) VALUES('$actividad','$descripcion','$fechaEntrega','$idUnidad')";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$ingreso=TRUE;
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						if($ingreso==TRUE){
							$sql1="SELECT COD_ACTIVIDAD FROM db_actividad WHERE 1 ORDER BY COD_ACTIVIDAD DESC LIMIT 1 ";
								try{				
								 	$rec1 =$GLOBALS['conn']->prepare($sql1);
									$rec1->execute();	
									$arrDatos = $rec1->fetchAll();
									$ingreso1=TRUE;
								 }catch(PDOException $e){
								 	echo "Error de Conexi&oacute;n";
								 }
								 foreach ($arrDatos as $data) {
									$lastID=$data['COD_ACTIVIDAD'];
								}
								$sql2="INSERT INTO `db_plan_curso`(`COD_CURSO_GRADO`, `COD_ACTIVIDAD`) VALUES ('$cursoGrado','$lastID')";
								try{				
								 	$rec2 =$GLOBALS['conn']->prepare($sql2);
									$rec2->execute();	
									$ingreso=TRUE;
								 }catch(PDOException $e){
								 	echo "Error de Conexi&oacute;n";
								 }	
						}
						if($aspectosActividad['detalle']!=""){
							$z=count($aspectosActividad['detalle']['nombre']);
							if($z>=1){
								for($x=0;$x<$z;$x++){
									$nombre=$aspectosActividad["detalle"]["nombre"][$x];
									$punteo=$aspectosActividad["detalle"]["punteo"][$x];
									$sqlA="INSERT INTO `db_aspectos`(DESCRIPCION_ASPECTO,PUNTEO) VALUES('$nombre','$punteo')";
									try{				
									 	$recA =$GLOBALS['conn']->prepare($sqlA);
										$recA->execute();	
										$ingreso2=TRUE;
									 }catch(PDOException $e){
									 	echo "Error de Conexi&oacute;n";
									 }
									if($ingreso2==TRUE){
								 		$sql3="SELECT COD_ASPECTO FROM db_aspectos WHERE 1 ORDER BY COD_ASPECTO DESC LIMIT 1";
										try{				
										 	$rec1 =$GLOBALS['conn']->prepare($sql3);
											$rec1->execute();	
											$arrDatos1 = $rec1->fetchAll();
										 }catch(PDOException $e){
										 	echo "Error de Conexi&oacute;n";
										 }
										 foreach ($arrDatos1 as $data) {
											$lastIdAs=$data['COD_ASPECTO'];
										}
										$sql4="INSERT INTO `db_rubrica`(`COD_ACTIVIDAD`, `COD_ASPECTO`) VALUES ('$lastID','$lastIdAs')";
										try{				
										 	$rec3 =$GLOBALS['conn']->prepare($sql4);
											$rec3->execute();	
											$ingreso1=TRUE;
										 }catch(PDOException $e){
										 	echo "Error de Conexi&oacute;n";
										 }	
									}
								}
							}
						}
						if($ingreso1==TRUE){
							$mensaje=array('exito'=>'!Exito¡ Actividad creada exitosamente.');
							echo json_encode($mensaje);
						}
					}else{
						$mensaje=array('error'=>'!Error¡Ingrese fecha de Entrega de la Actividad.');
						echo json_encode($mensaje);
					}						
				}else{
					$mensaje=array('error'=>'!Error¡Ingrese nombre de la Actividad.');
					echo json_encode($mensaje);
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