<?php
	require_once '../modelo/modelo.php';
      $user = $_POST['b'];       
      if(!empty($user)) {
                       
       		$arrData=$msj="";
             $sql = "SELECT * FROM db_persona WHERE usuario = '".$user."'";
						try{				
						 	$rec =$GLOBALS['conn']->prepare($sql);
							$rec->execute();	
							$arrData = $rec->fetchAll();
						 }catch(PDOException $e){
						 	echo "Error de Conexi&oacute;n";
						 }	
						 if((count($arrData)>0)){
						 	$msj.= "<span style='font-weight:bold;color:green;'>El nombre de usuario ya existe.</span>";
						 }else{
						 	$msj.= "<span style='font-weight:bold;color:red;'>Nombre Disponible.</span>";
						 }
						echo $msj;
      }     
?>