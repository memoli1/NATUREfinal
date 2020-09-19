
<?php
	if(session_status() == PHP_SESSION_NONE){session_start();}

	if(!isset($_SESSION['STime']) || (!isset($_SESSION['Nome']))){
		echo '<script language="javascript">';
		echo 'alert("Devi effettuare l accesso")';
		echo '</script>';
		require("accedi.php");
		die();
	}

	$STime = intval($_SESSION['STime']);
	$timeNow = intval(time());
	if(($timeNow-$STime)>3600){
		session_unset();
		session_destroy();
		$_SESSION = 0;
		echo '<script language="javascript">';
		echo 'alert("Devi effettuare l accesso")';
		echo '</script>';
		require("accedi.php");
		die();
	}else{
		$_SESSION['$STime'] = $timeNow;
	}
?>
