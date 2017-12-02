<?php
	include_once '../../controlador/mpdf.php';
	require_once '../../modelo/modelo.php';
	require_once('../../controlador/sesion.php');
	confirmarlogeo();
	$g=@$_GET['g'];
	$c=@$_GET['c'];
	$j=@$_GET['j'];
	$u=@$_GET['u'];
	$objeto= new modelo();
	$arrDatosE=$objeto->getDataStudentReport($j,$c,$g);
	$arrCuadro=$objeto->getCuadrodeHonor($g,$u);
	$arrCursos=$objeto->getNoCursos($g);			
	$jornada=$cursoD=$carrera=$grado=$nombre=$cursos=" ";
	$contador=0;
	foreach($arrCursos as $number){
		$cursos=$number['cursos'];
	}
$mpdf=new mPDF('c'); 
$mpdf->SetDisplayMode('fullpage');
$stylesheet = file_get_contents('css/mpdfstyleA4.css');
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
			<td style="border:hidden">'.($datosP['NOMBRE_GRADO']).'</td>
		</tr>
		<tr>
			<td style="border:hidden;width:180px;"><strong>Carrera:</strong></td>
			<td style="border:hidden">'.($datosP['NOMBRE_CARRERA']).'</td>
		</tr>
	</table>
</div>
';


$html.="<h2 align='center'>CUADRO DE HONOR</h2><table>";
	$count=$nota=$total=$promedio=$punteo1=$punteo=0;
	$comillas='"';

	if(!empty($arrCuadro)){// verificamos que la consulta de cursos no vaya vacia.
		 // mostramso en el encabezado la cantidad de actividades, en la unidad activa
		$html.= "<tr><th style='color:#04369a'>Posición</th><th style='color:#04369a'>Nombre del Alumno</th>
				<th style='text-align:center;color:#04369a'>Promedio</th>
			</tr>
		<tbody>";					
		foreach ($arrCuadro as $data){			
			++$count;
			// mostramos los alumnos que corresponden al curso
			$html.= "<tr><td align='center'><strong>".$count."</strong></td><td align='center'><strong>".($data['NOMBRE'])." ".($data['APELLIDO'])."</strong></td>
						 <td align='center'><strong>".round((($data['nota'])/($cursos)),2)."</strong></td></tr>";
			
		}
										 	 
	}
	$html.="</tbody>";
		
$html.='
	</table>';
	
	

	
$html.='</body></html>';	

}
$mpdf->AddPage('L');

$mpdf->WriteHTML($stylesheet,1); 

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;	
?>