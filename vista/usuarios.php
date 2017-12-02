
            

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-cogs"></i> Mantenimiento
                            </li>
                            <li class="active">
                            	Usuarios
                            </li>

                        </ol>
                    </div>
                </div>
                <!-- /.row -->


                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php
                                        
                                        		foreach($totalUsuarios as $total){
                                        			echo $total['total'];
                                        		}
                                        		?>
                                        </div>
                                        <div> Usuarios Registrados</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-eye fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        	<?php
                                        		foreach($totalEstado as $total){
                                        			if($total['idEstado']==1){echo $total['total'];};
                                        		}
                                        		?>	
                                        </div>
                                        <div>Usuarios Activos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-low-vision fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        	<?php
                                        		foreach($totalEstado as $total){
                                        			if($total['idEstado']==2){echo $total['total'];};
                                        		}
                                        		?>
                                        </div>
                                        <div>Usuarios No activos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>


                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Usuarios registrados en el SIPWEB</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="tablaUsuarios">
                                        <thead style="background-color: #000; color:#fff">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nombre</th>
                                                <th>Rol</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bodyTable">
                                        	<?php
                                        	$count=0;
                                        		foreach ($listUsuarios as $user) {
                                        			
                                        	?>
                                        		<tr>
                                        			<td><?php echo ++$count; ?></td>
                                        			<td><?php echo $user['nombre']; ?></td>
                                        			<td><?php echo $user['nombrerol']; ?></td>
                                        			<td align="center"><a href="#" rel="<?php echo $user['idUsuario']; ?>" class="editar" data-toggle="modal" data-target="#modificarEstado" title="Actualizar estado del usuario"><?php
                                        								 if($user['idEstado']==1){
                                        								 		echo "<i class='glyphicon glyphicon-record' style='color:red;font-weight:bold'></i><small style='color:red;'> Activo</small>";
																		 }else{echo "<i class='glyphicon glyphicon-record' style='color:rgb(165, 153, 153)'></i><small style='color:rgb(165, 153, 153);'> No Activo</small>";}
																		?>																			
														</a>
													</td>                        
                                        		</tr>
                                        	<?php 													
												}
                                        	?>
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<!-- Modal modificacion de estados -->
<div class="modal fade" id="modificarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header" style="background-color: #5a576c">
    			<button style="color:#fff;" type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span><span class="sr-only" >Close</span></button>
		    	<h3 align="center" style="color: #FFFFFF; font-weight: bold;">Actualización de estados.</h3>
    		</div>
	      	<div class="modal-body" style="background-color: #FFF; color: #000;border-bottom: 1px dashed #FFFFFF;">
	      		<p align="center">Actualización del  esta del usuario.</p>
	      		<form method="post" action="" id="updateStatus">
			    	<input type="hidden" value="" class="idstatus" name="idstatus"/><br />
				   	<div class="form-group" id="optionsRadius">
						<label class="radio-inline">
					    <input type="radio" name="estado" id="Radio1" value="1">
						    Activo
						</label>
						<label class="radio-inline">
						<input type="radio" name="estado" id="Radio2" value="2">
							No Activo
						</label>
					</div>
					<div class="form-group">
				    	<p style="color: #FF0000" align="center"><span class="glyphicon"> </span></p>
				    </div>
				    <div class="form-group">
				    	<p align="center">
			        		<button type="submit" class="btn btn-primary updateStatus" data-dismiss="modal">Guardar <span class="glyphicon glyphicon-ok-circle"></span></button>
		        		</p>	
			    	</div>
	      		</form>
	      	</div>
   	 	</div>
  	</div>
</div>
