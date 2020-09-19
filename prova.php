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
    $sql = "USE prova";
    $ok = mysqli_query($conn, $sql);
    if(!$ok){
		die("imposs. selezionare DB: ".@mysqli_errno($conn));
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>NATURE</title>
		<link rel="icon" href="icon.png" type="image/x-icon"/>
		<link rel="stylesheet" href="stylecss.css">
	</head>
	<body>
		<div>
			<form method="post" enctype="multipart/form-data">
				<input type="file" name="image" /><br>
				<input type="submit" name="submit" value="invia" />
			</form>
			<?php
				if(isset($_POST['submit'])){
					if($_FILES['image']['tmp_name'] == "" || getimagesize($_FILES['image']['tmp_name']) == FALSE){
						echo "inserisci foto";
					} else {
						$image = addslashes($_FILES['image']['tmp_name']);
						$image = file_get_contents($image);
						$image = base64_encode($image);

						$sql = "INSERT INTO img
						(img) values
						('$image')";

						$ok = mysqli_query($conn, $sql);
						if(!$ok) {
							echo "Errore";
						} else {
							echo "ok";
						}
					}
				}
				
				$sql = "SELECT img
						FROM img";
				$ok = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_array($ok)){
					echo "<img height=\"300\" width=\"300\" src=\"data:image;base64,".$row['img']."\">";
				}
			?>
		</div>
	</body>
</html>