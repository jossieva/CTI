<?php 
	require_once '../CTI/modelo/modelo.php';
$objeto= new Modelo;
$arrCarrera=$objeto->getGrado();
$arrCatedraticos=$objeto->getCatedraticos();
?>	
<div class="container-fluid" id="pagePrimary">
	<div class="row hidden-xs hidden-sm" id="oneSection" style="border-bottom: 5px solid #04369A;border-top: 5px solid #04369A">
		 <h3 align="center"><img src="../CTI/images/logo.png" width="100" height="100"> &nbsp;Colegio Tecnologico en Informatica</h3>
	</div><br />
	<div class="row" id="twoSection">
		<div class="col-md-12 titlePanel">
			<h2 align="center">Control General de ingreso de datos</h2>
		</div>		
			<table id="carrera3" class="table table-striped table-responsive" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
		            <tr>
		            	<th align="center">No.</th>
		            	<th align="center">Jornada</th>
		                <th align="center">Nombre de la Carrera</th>
		                <th align="center">Grado</th>
		                <th style="width: 10%; text-align: center"><i class="fa fa-gears"></i></th>
						
		            </tr>
		        </thead>
		        <tbody>
		           <?php
		           $count=0;
						if($arrCarrera){
							foreach($arrCarrera as $data){
								++$count;
								echo "<tr><td>".$count."</td>";
								echo "<td>".$data['JORNADA']."</td>";
								echo "<td>".$data['NOMBRE_CARRERA']."</td>";
								echo "<td>".$data['NOMBRE_GRADO']."</td>";
								echo "<td style='text-align:center;'>
								<span data-target='#ListCurs' data-toggle='modal' class='btnListCur btn btn-default btn-small' data-placement='left' title='Catalogo de Cursos' alt='".$data['COD_GRADO']."'><i class='fa fa-file-text-o' style='color:#f00'> </i></span>  
								<span data-target='#ListStudent' data-toggle='modal' class='btnListStudent btn btn-default btn-small' data-placement='left' title='Catalogo de alumnos' alt='".$data['COD_GRADO']."'> <i class='fa fa-list-alt' style='color:#00f'></i></span>									
								</td></tr>";
			
							}
						}
					?>
		            
		        </tbody>
		    </table>
			
	</div><br />
	<div class="row" id="threeSection">
		<div class="col-md-12 titlePanel">
			<h3 align="center">Listado de Personal</h3>
		</div>
				<table id="personal" class="display compact table" width="100%" cellspacing="0">
		        <thead style="background: #005747; color: #fff;">
		            <tr>
		            	<th align="center">No.</th>
		            	<th align="center">Nombre del Catedratico</th>
		                <th style="text-align: center"><i class="fa fa-gears"></i></th>
						
		            </tr>
		        </thead>
		        <tbody>
		           <?php
		                  $count=0;
						  $com='"';
						if($arrCatedraticos){							
							foreach($arrCatedraticos as $data){
								++$count;
								echo "<tr><td>".$count."</td>";
								echo "<td>".$data['NOMBRE']." ".$data['APELLIDO']."</td>";
								echo "<td align='center'>
								<a onclick=".$com."redirectPageM('cursos','".$data['COD_PERSONA']."')".$com."  class='btnListCursos btn btn-default' data-placement='left' title='Actividades Catedratico' >cursos <i class='fa fa-book'></i></a>  
								<a href='#' data-target='#ListCatedraticos' data-toggle='modal' class='btnListCursos btn btn-default btn-small' data-placement='left' title='Catalogo de cursos' alt='".$data['COD_PERSONA']."'> <i class='fa fa-list' style='color:#00f'></i></a>									
								</td></tr>";
			
							}
						}
					?>
		            
		        </tbody>
		    </table>
	</div><br />

<!-- =================== MODAL DE LISTA DE CURSOS ========================= -->
<!-- Modal -->
<div class="modal fade" id="ListCurs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel"><span><img src="../cti/images/logo.png" width="60" height="60" /></span> Catalogo de Cursos</h3>
      </div>
      <div class="modal-body">
      	<table class="table">
      		<thead>
      			<tr>
      				<th>No.</th>
      				<th>Nombre del Curso</th>
      			</tr>
      		</thead>
      		<tbody id="listCursos">
      			
      		</tbody>
      	</table>       	
      <div class="row ">
			<div class="col-md-12">
				<h4 class="recomendar"><span class="fa fa-info-circle"></span>  Observaciones:</h4>
				<ul class="recomendaciones">
					<li>
						<span class="fa fa-asterisk" aria-hidden="true"></span>Listado de cursos de acuerdo al pensum de estudio.
					</li>
				</ul>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

<!-- =================== MODAL DE LISTA DE ALUMNOS POR GRADO ========================= -->
<!-- Modal -->
<div class="modal fade" id="ListStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel"><span><img src="../cti/images/logo.png" width="60" height="60" /></span> Listado de Alumnos</h3>
      </div>
      <div class="modal-body">
      	<table class="table">
      		<thead>
      			<tr>
      				<th>No.</th>
      				<th>Nombre del Alumno</th>
      			</tr>
      		</thead>
      		<tbody id="listStudent">
      			
      		</tbody>
      	</table>
      	<div class="row ">
			<div class="col-md-12">
				<h4 class="recomendar"><span class="fa fa-info-circle"></span>  Observaciones:</h4>
				<ul class="recomendaciones">
					<li>
						<span class="fa fa-asterisk" aria-hidden="true"></span>Listado de alumnos oficialmente inscritos.
					</li>
				</ul>
			</div>
		</div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
<!-- =================== MODAL DE LISTA DE CURSOS ASIGNADOS A CATEDRATICOS ========================= -->
<!-- Modal -->
<div class="modal fade" id="ListCatedraticos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel"><span><img src="../cti/images/logo.png" width="60" height="60" /></span> Listado de cursos asignados</h3>
      </div>
      <div class="modal-body">
      	<table class="table">
      		<thead>
      			<tr>
      				<th>No.</th>
      				<th>Curso</th>
      				<th>Grado</th>
      				<th>Carrera</th>
      			</tr>
      		</thead>
      		<tbody id="listCatedraticosCursos">
      			
      		</tbody>
      	</table>
      	<div class="row ">
			<div class="col-md-12">
				<h4 class="recomendar"><span class="fa fa-info-circle"></span>  Observaciones:</h4>
				<ul class="recomendaciones">
					<li>
						<span class="fa fa-asterisk" aria-hidden="true"></span>Listado de cursos asignados por catedratico.
					</li>
				</ul>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
