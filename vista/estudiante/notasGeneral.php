<div class="row" id="twoSectionC">
		<div class="col-md-12 titleActivityE">
			<h2 align="center">Notas Generales<span class="curso"></span></h2>
		</div>
		<ol class="breadcrumb">
		  <li><a href="index.php">Inicio</a></li>
		  <li class="active">Notas Generales</li>
		  <span class="pull-right btn1 regresarActividad" style="font-size: 1.5rem"><i class='fa fa-chevron-left'><a href='index.php' > Regresar</a> </i></span>
		</ol>
		<div class="col-md-12 alumnos">
			<form id="formCreateNote">
			<div class="row titleSectionGeneral" style="background: #5cb85c;margin-top: -20px;">
				
			</div>
			<div class="table-responsive">
			<table class="table table-hover table-bordered nombreAlumnos" style="margin-top: 10px;">
				
			</table>
			</div>
			<div class="row">
				<p align="center">
					<span>
						<a class="btn btn-default" href="../cti/vista/reportes/notasGenerales.php" target="_blank"><i class="fa fa-print fa-3x" style="color: #5cb85c"></i></a>
					</span>
				</p>
			</div>
			<div class="row" style="border-bottom: 5px solid #5cb85c">
				<hr />
						<div class="col-md-12">
							<h4 class="recomendar"><span class="fa fa-info-circle"></span>  Observaciones:</h4>
							<ul class="recomendaciones">
								<li>
									<span class="fa fa-asterisk" aria-hidden="true"></span>El total por unidad, es la sumatoria de los resultados de las actividades calificadas.<br />
									<span class="fa fa-asterisk" aria-hidden="true"></span>Sección únicamente de consulta.<br />
									<span class="fa fa-asterisk" aria-hidden="true"></span><strong style="font-size: 14px"> * </strong> Promedio acumulado.<br />
									<span class="fa fa-asterisk" aria-hidden="true"></span><strong>Total</strong> Sumatoria de Nota por ciclo.
							</ul>
						</div>
					</div>
		    </form>
		</div>
</div>

<!-- =================== MODAL DE LISTA DE CURSOS ========================= -->
<!-- Modal -->
<div class="modal fade" id="NotasCurso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel"><span><img src="../cti/images/logo.png" width="60" height="60" /></span> Notas por curso</h3>
      </div>
      <div class="modal-body ">
      	<table class="table table-bordered table-responsive">
      		<thead>
      			<tr>
      				<th>Actividad</th>
      				<th>Punteo</th>
      			</tr>
      		</thead>
      		<tbody id="listActividadesNotas">
      			
      		</tbody>
      	</table>       	
      <div class="row ">
			<div class="col-md-12">
				<h4 class="recomendar"><span class="fa fa-info-circle"></span>  Observaciones:</h4>
				<ul class="recomendaciones">
					<li>
						<span class="fa fa-asterisk" aria-hidden="true"></span>Vista de notas de actividades por curso.
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