<?php 
	session_start();
    
    function logear()
    {
        return isset($_SESSION['id']);
		
    }
    function  confirmarlogeo()
    {
        if(!logear())
        {
            header('location: vista/login.php');
        }
    }
    

?>