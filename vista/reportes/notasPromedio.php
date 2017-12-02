<?php
	include_once '../../controlador/mpdf.php';
	require_once '../../modelo/modelo.php';
	$g=@$_GET['g'];
	$c=@$_GET['c'];
	$j=@$_GET['j'];
	$objeto= new modelo();
	$arrDatosE=$objeto->getDataStudentReport($j,$c,$g);	
	$unidades=$objeto->getCountUnity();
	$jornada=$cursoD=$carrera=$grado=$nombre=" ";
	$contador=$noUnidad=0;
foreach($unidades as $unida){
	$noUnidad=$unida['numero'];
}
foreach($arrDatosE as $datosP){
	++$contador;
		$jornada=$datosP['JORNADA'];
	

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
      overflow: auto;
      left: 0;
      top: 22mm;
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
.headerPagedStart { page: smallsquare; }
.headerPagedEnd { page: standard; }
@page smallsquare {
    sheet-size: A4-L; 
    margin: 5%;
    margin-header: 5mm;
    margin-footer: 5mm;
}
@page standard {
    sheet-size: A4;
    margin: 15mm;
    margin-header: 5mm;
   margin-footer:5mm;
}
</style>
</head><body>';

$html.='<div class="headerPageStart">

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
			<td style="border:hidden;width:180px;"><strong>Grado:</strong></td>
			<td style="border:hidden;">'.($datosP['NOMBRE_GRADO']).'</td>
			<td style="border:hidden;width:180px;"><strong>Carrera:</strong></td>
			<td style="border:hidden">'.($datosP['NOMBRE_CARRERA']).'</td>
		</tr>
	</table>
</div>
';


$html.="<table>";
	$count=$nota=$total=$promedio=$punteo1=$punteo=0;
	$comillas='"';
	$arrDatos=$arrDatos1=$arrDatos2=$arrDatos3=$arrDatosP="";
	if(($g)){						
		$sql = "SELECT c.NOMBRE_CURSO,c.COD_CURSO,p.COD_PERSONA,p.NOMBRE,p.APELLIDO, acg.COD_CURSO_GRADO FROM db_curso c JOIN db_asig_curso_grado acg ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_asig_grado_persona agp ON agp.COD_GRADO=g.COD_GRADO JOIN db_persona p ON p.COD_PERSONA=agp.COD_PERSONA WHERE agp.COD_GRADO=".$g." GROUP BY agp.COD_PERSONA";
		echo $sql;
		try{				
		 	$rec =$GLOBALS['conn']->prepare($sql);
			$rec->execute();	
			$arrDatos = $rec->fetchAll();
		 }catch(PDOException $e){
		 	echo "Error de Conexi&oacute;n uno";
		 }	
	}else{
		$mensaje=array('error'=>'!Error¡');						
	}
	if(!empty($arrDatos)){// verificamos que la consulta de cursos no vaya vacia.
		//consulta para obtener el listado de unidades del sistema
		$sql1="SELECT c.NOMBRE_CURSO,c.COD_CURSO,p.COD_PERSONA,p.NOMBRE,p.APELLIDO, acg.COD_CURSO_GRADO FROM db_curso c JOIN db_asig_curso_grado acg ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_asig_grado_persona agp ON agp.COD_GRADO=g.COD_GRADO JOIN db_persona p ON p.COD_PERSONA=agp.COD_PERSONA WHERE agp.COD_GRADO=".$g." GROUP BY acg.COD_CURSO";
		try{				
		 	$rec1 =$GLOBALS['conn']->prepare($sql1);					 	
			$rec1->execute();								
			$arrDatos1 = $rec1->fetchAll();						
		 }catch(PDOException $e){
		 	echo "Error de Conexi&oacute;n dos";
		 }
		 // mostramso en el encabezado la cantidad de actividades, en la unidad activa
		$html.= "<tr><th style='color:#04369a'>No.</th><th style='color:#04369a'>Nombre del Alumno</th>";
		foreach($arrDatos1 as $data1){							
			$html.= "<th style='color:#04369a;text-rotate:90;'><span  style='transform: rotate(-90deg); text-align:center; font-size:12px'>".($data1['NOMBRE_CURSO'])."</span></th>";					
		}			
		$html.= "</tr>
		<tbody>";					
		foreach ($arrDatos as $data){			
			++$count;
			// mostramos los alumnos que corresponden al curso
			$html.= "<tr><td><strong>".$count."</strong></td><td><strong>".($data['NOMBRE'])." ".($data['APELLIDO']) ."</strong></td>";
			// por cada actividad verificamos si tienen nota asignada o no
			foreach($arrDatos1 as $data1){
				$sql3="SELECT a.NOMBRE_ACTIVIDAD, a.COD_UNIDAD, SUM(aag.NOTA) nota FROM db_curso cu JOIN db_asig_curso_grado acg ON acg.COD_CURSO=cu.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=acg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_asig_acti_grado aag ON aag.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_asig_grado_persona gp ON gp.COD_ASIG_GRADO_P=aag.COD_ASIG_GRADO_P JOIN db_persona pe ON pe.COD_PERSONA=gp.COD_PERSONA JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE cu.COD_CURSO=".$data1['COD_CURSO']."  AND pe.COD_PERSONA=".$data['COD_PERSONA']." GROUP BY acg.COD_CURSO";							
				try{				
			 	$rec3 =$GLOBALS['conn']->prepare($sql3);												 	
				$rec3->execute();																					
				$arrDatos3 = $rec3->fetchAll();													
			 }catch(PDOException $e){
			 	echo "Error de Conexi&oacute;n tres";
			 }					
			if(!empty($arrDatos3)){
				++$promedio;
				foreach($arrDatos3 as $data3){
					if($data3['nota']!=""){
						$total+=$data3['nota'];
						if(round($data3['nota'],2)<60){
							$html.= "<td align='center' style='font-size:12px;'><span style='border:none; text-align:center; font-weight:bold;color:#f00;background:#f5f5f5; padding:5px 5px; font-size:14px;'>".round(($data3['nota']/$noUnidad),2)."</span></td>";
						}else{
							$html.= "<td align='center' style='font-size:12px;'><span style='border:none; text-align:center; font-weight:bold;color:#000;background:#f5f5f5; padding:5px 5px; font-size:14px;'>".round(($data3['nota']/$noUnidad),2)."</span></td>";
						}	
								
					}else{
						$html.= "<td align='center' style='font-size:12px;'><span>----</span></td>";		
					}
				}											
			}else{
				$html.= "<td align='center' style='font-size:12px;'><span>----</span></td>";		
			}
		}
		$html.= "</tr>";
		$total=$promedio=0;												 	 
	}
	$html.="</tbody>";
}		
$html.='
	</table>';	
$html.='</body></html>';
$mpdf=new mPDF('c'); 
$mpdf->SetDisplayMode('fullpage');
//$stylesheet = file_get_contents('css/mpdfstyleA4.css');
$mpdf->AddPage('L');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
}
	
?>