<?php
	$ip="127.0.0.1";
    $name="root";
    $pass="";

    $conn = mysqli_connect($ip, $name, $pass);
    if(!$conn){
        die("errore mysql: ".@mysqli_errno($conn));
	}

    if(mysqli_connect_errno()){
        exit("Connessione fallita!<br>Errore n. ".mysqli_connect_errno()."<br>Messaggio: ".mysqli_connect_error());
	}
    $sql = "USE nature";
    $ok = mysqli_query($conn, $sql);
    if(!$ok){
		die("imposs. selezionare DB: ".@mysqli_errno($conn));
	}
?>