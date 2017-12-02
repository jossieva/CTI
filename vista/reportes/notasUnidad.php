<?php
	include_once '../../controlador/mpdf.php';
	require_once '../../modelo/modelo.php';
	require_once('../../controlador/sesion.php');
	confirmarlogeo();
	$iduser=$_SESSION['id'];
	$idCursoView=@$_GET['curso'];
	$objeto= new modelo();
	$arrDatos=$objeto->getAsigCatedraticoCurso($iduser);	
	$arrCurso=$objeto->getDataCurso($idCursoView);
	$jornada=$cursoD=$carrera=$grado=$nombre=" ";
	foreach($arrDatos as $datos){
		$jornada=$datos['JORNADA'];
		$carrera=$datos['NOMBRE_CARRERA'];
		$grado=$datos['NOMBRE_GRADO'];
		$nombre=$datos['NOMBRE']." ".$datos['APELLIDO'];
	}
	foreach($arrCurso as $curso){
		$cursoD=$curso['NOMBRE_CURSO'];
	}
$html = '<html><head>
<style>
table {
 font-family: sans-serif;
 width:100%;
}
 td, th{
 font-family: sans-serif;
 border-bottom: .01mm solid black;
}
 p{
 	font-size:12px;
	text-align:center;
	font-weight:bold;
 }

.myfixed1 { position: absolute;
      overflow: visible;
      left: 0;
      top: 0;
      align:center;
      font-family:sans;
      margin-bottom: 10mm;
	  font-size:14px;
	  font-weight:bold;
}
.myfixed2{
	 position: absolute;
      overflow: auto;
      right: 55;
      top: 20mm;
      width: 55mm;      
      padding: 0.5em;
      font-family:sans;
      margin: 0;
      rotate: 0;
}
.encabezado{
	margin-bottom:10mm;
}
</style>
</head>
<body>
<div>

<div class="myfixed1" align="center">
COLEGIO PRIVADO MIXTO TECNOLÓGICO EN INFORMÁTICA<br/>
	2da. Calle 12-23, Zona 4, COBÁN, ALTA VERAPAZ<br/>
	JORNADA '.strtoupper($jornada).'<br/>
	TEL. 79511459 - 79521190 <br/>
	Facebook: Colegio Tecnológico en Informática <br/>
	CICLO ESCOLAR 2017
</div>
</div>
<div class="myfixed2"><img src="../../images/logotipo.png"/></div>
<div class="encabezado">
	<table style="border:hidden">
		<tr>
			<td style="border:hidden; width:180px;"><strong>Nombre del Catedratico:<strong></td>
			<td style="border:hidden">'.($nombre).'</td>
		</tr>
		<tr>
			<td style="border:hidden;width:180px;"><strong>Grado:</strong></td>
			<td style="border:hidden">'.($grado).'</td>
		</tr>
		<tr>
			<td style="border:hidden;width:180px;"><strong>Carrera:</strong></td>
			<td style="border:hidden">'.($carrera).'</td>
		</tr>
	</table>
</div>
<div>
<h3 style="text-align:center;">'.$cursoD.'</h3>
</div>
';


$html.="<table>";
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
						$html.= "<tr>
									<th>No.</th>
									<th>Nombre del Alumno</th>";
						foreach($arrDatos1 as $data1){							
							$html.= "<th><span  style='transform: rotate(-90deg); text-align:center; font-size:12px'>".($data1['NOMBRE_UNIDAD'])."</span></th>";					
						}			
						$html.= "<th style='text-align:center;'>Total</th>
								<th style='text-align:center;'>Promedio</th>
							</tr>
						<tbody>";					
					foreach ($arrDatos as $data){			
					++$count;
					// mostramos los alumnos que corresponden al curso
						$html.= "<tr><td>".$count."</td><td>".($data['NOMBRE'])." ".($data['APELLIDO'])."</td>";
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
												$html.= "<td align='center' style='font-size:12px;'><span  style='width:40px;border:none; text-align:center; font-weight:bold;color:#f00;'>".$data3['nota']."</span> / ".$punteo."</td>";													
											}else{
												$html.= "<td align='center' style='font-size:12px;'><span  style='width:40px;border:none; text-align:center; font-weight:bold;color:#000;'>".$data3['nota']."</span> / ".$punteo."</td>";
											}
	
										}else{
											$html.= "<td align='center' style='font-size:12px;'><span  style='width:40px;border:none; text-align:center; font-weight:bold;color:#b14f08;'> CPC </span> /".$punteo."</td>";		
										}
									}											
								}else{
									$html.= "<td align='center' style='font-size:12px;'><span  style='width:40px;border:none; text-align:center; font-weight:bold;color:#b14f08;'> CPC </span> / ".$punteo."</td>";
								}
						}
						$html.= "<td align='center' style='font-weight:bold'>".$total."</td>";
						$html.= "<td align='center' style='font-weight:bold'>".round(($total/$promedio),2)."</td>";
						$html.= "</tr>";
						$total=$promedio=0;												 	 
					}
					
					$html.= "</tbody>";
				
}		
$html.='
	</table>
	</html>';	

$mpdf=new mPDF('c'); 
$mpdf->SetDisplayMode('fullpage');
$stylesheet = file_get_contents('css/mpdfstyleA4.css');
$mpdf->AddPage('L');
$mpdf->WriteHTML($stylesheet,1); 

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>