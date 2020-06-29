<?php
		session_start();
		
		//Frees all session variables 
		session_unset();
		
		//Destroys session
		session_destroy(); 
		
		header("location:index.php");
?>
		