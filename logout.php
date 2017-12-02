<?php
session_start();

    $_SESSION = array();
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-10000, '/');
    }
	session_destroy();
        header('location: index.php?logout=1');
?>