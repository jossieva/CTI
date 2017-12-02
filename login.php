<?php 
	 require_once 'sesion.php';
     require_once 'modelo/modelo.php';
	 
	 $objeto= new Modelo;

    if(logear()) {
        header('location: ../index.php');
	}
    
    if(isset($_POST['submit'])){ //verificamos el evento en el formulario
        $mensaje= array();
		
        
		//eliminamos espacios tanto al inicio como al final de los campos ingresados
        $usuario=trim($_POST['usuario']);
        $clave= trim($_POST['clave']);
		
		

        if(!empty($usuario)&& !empty($clave)){ //comprobamos que el usuario y la contraseña no esten vacios
          	$arrUser=$objeto->login($usuario, $clave);
			if($arrUser){
				//if($arrUser[0][7]===1){
					foreach($arrUser as $user){
						$_SESSION['id']=$user['COD_PERSONA'];
						$_SESSION['usuario']=$user['USUARIO'];
						$_SESSION['role']=$user['COD_NIVEL'];
									
		           	}
					header('Location: ../index.php');
				/*}else{
					$mensaje = "Usuario Inactivo";
				}*/
			}else{
				$mensaje="Usuario o Contrase&ntilde;a incorrecta.";
			}		  
        }else{
        	if(isset($_GET['logout']) && $_GET['logout'] == 1) {
            $mensaje = "Nombre de usuario o contraseña vacio";
			}
		 	$mensaje= "Nombre de usuario o contraseña vacio";
		}
    }else {
    	    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
            $mensaje = "Usted ha finalizado la sesi&oacute;n";
   			 } 
	$usuario = "";
	$clave= "";
   }
	
	
?>