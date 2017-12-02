<?php
	include_once '../../controlador/mpdf.php';
	require_once '../../modelo/modelo.php';
	$id=@$_GET['curso'];
	$objeto= new modelo();
	$actividades=$objeto->getActividades($id);
	$curso=$objeto->getDataCurso($id);
	$jornada=$cursoD=$carrera=$grado=" ";

	foreach($curso as $data3) {
		$jornada=$data3['JORNADA'];
		$cursoD=$data3['NOMBRE_CURSO'];
		$grado=$data3['NOMBRE_GRADO'];
		$carrera=$data3['NOMBRE_CARRERA'];
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
      margin-bottom: 25;
	  font-size:12px;
	  font-weight:bold;
}
.myfixed2 { position: absolute;
      overflow: auto;
      right: 35;
      top: 20mm;
      width: 55mm;      
      padding: 0.5em;
      font-family:sans;
      margin: 0;
      rotate: 0;
}
</style>
</head>
<body>
<div>

<div class="myfixed1" align="center">
COLEGIO PRIVADO MIXTO TECNOLÓGICO EN INFORMÁTICA<br/>
	2da. Calle 12-23, Zona 4 <br/>
	COBÁN, ALTA VERAPAZ<br/>
	JORNADA '.strtoupper($jornada).'<br/>
	TEL. 79511459 - 79521190 <br/>
	Facebook: Colegio Tecnológico en Informática <br/>
	CICLO ESCOLAR 2017
</div>
</div>
<div class="myfixed2"><img src="../../images/logotipo.png"/></div>
<table>
	<thead >
		<tr bgcolor="#039" style="border-color:#039">
			<th  style="color:#fff;" colspan="3"><span><i>CARRERA: </i></span> '.($carrera).'</th>
		</tr>
		<tr bgcolor="#039" style="border-color:#039">
			<th  style="color:#fff;" colspan="3"><span><i>CURSO: </i></span> '.($cursoD).'</th>
		</tr>
		<tr bgcolor="#039" style="border-color:#039">
			<th  style="color:#fff;">Punteo</th>
			<th  style="color:#fff;">Actividades</th>
			<th  style="color:#fff;">Aspectos a calificar</th>
		</tr>
	</thead>
	<tbody id="listado">';
$count=0;
$arrActividadesPunteo=$arrPunteos="";
if(!empty($actividades)){
	foreach ($actividades as $data) {
				++$count;
		if ($data['COD_ACTIVIDAD']!="") {
			$arrActividadesPunteo=$objeto->getActividadesPunteos($data['COD_ACTIVIDAD']);
			$arrPunteos=$objeto->getPunteos($data['COD_ACTIVIDAD']);
		}
	
			foreach ($arrPunteos as $data1) {
				if($data1['total']!=""){				
					$html.= '<tr>
					<td><span align="center" style="background:#088581;color:#fff;font-size: 4rem;font-weight: bold;padding:5px;">'.$data1['total'].'</span>';						
				}else{
					$html.= '<tr>
					<td><span class="align-middle" style="background:#088581;color:#fff;font-size: 4rem;font-weight: bold; padding:5px;">0</span>';
			}		
							}							
				$html.='</td>
						<td >
							<span style="text-align: center;font-size: 1.5rem;border-bottom-style: solid; font-family:Arial, Helvetica, sans-serif;" >'.utf8_encode($data['NOMBRE_ACTIVIDAD']).'</span><br />
							<span style="font-style: italic; font-size:12px"><strong>Descripción:</strong>'.utf8_encode($data['DESCRIPCION_ACTIVIDAD']).'</span><br />
							<span style="font-style: italic"><strong>Fecha de Entrega: </strong>'.$data['FECHA_ACTIVIDAD'].'</span><br />
						</td>
						<td>
							<ul class="lista">';
		
		foreach($arrActividadesPunteo as $data2){
			$html.= '<li style="color:red; font-size:9px; font-family:courier;" width="70mm">'.
			($data2['DESCRIPCION_ASPECTO']).' <span class="breadcrumb" style="float:right;" ><i>'.$data2['PUNTEO'].' pts.</i></span> ';
		}
		$html.='</li></ul>
				</td>
			</tr>';

	}	
$html.='
		</tbody>
	</table>
	</body>
	</html>';	
}
$mpdf=new mPDF('c'); 
$mpdf->SetDisplayMode('fullpage');
$stylesheet = file_get_contents('../../css/mpdfstyleA4.css');
$mpdf->WriteHTML($stylesheet,1); 

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>