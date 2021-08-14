<?php
	session_unset();
	require_once  'controller/studentsController.php';		
    $controller = new studentsController();	
    $controller->mvcHandler();
?>