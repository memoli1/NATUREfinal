<?php
	if(session_status() == PHP_SESSION_NONE){session_start();}
	session_unset();
	session_destroy();
	$_SESSION = 0;
	
	require("index.php");
?>