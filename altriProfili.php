<?php
	require("serverCon.php");
	require("sessionCon.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>NATURE</title>
		<link rel="icon" href="icon.png" type="image/x-icon"/>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	</head>
	<body>
		<?php
			require("menu.php");

			echo "<div class=\"card text-white bg-success mb-3 mt-4\">";
			echo "<div class=\"w3-container w3-center\">";
			$sql = "SELECT u.nome, u.email, u.anno_nascita, u.profes,
			u.foto, u.data_reg, u.tipo, u.num_segn,
			p.class_corrette, p.class_errate, p.class_totali, p.affidabilita
					FROM utente u left join premium p on(u.nome = p.nome)
					WHERE u.nome <> '".$_SESSION['Nome']."'";

			$ok = mysqli_query($conn, $sql);

			if($ok && (mysqli_num_rows($ok) != 0))
			{
				$count = 1;
				while($riga = mysqli_fetch_array($ok)){
					echo "<h2>".$count."° utente</h2>
					<p>nome: ".$riga['nome']."</p>
					<p>email: ".$riga['email']."</p>
					<p>anno di nascita: ".$riga['anno_nascita']."</p>
					<p>professione: ".$riga['profes']."</p>
					<img src=\"data:image;base64,".$riga['foto']."\" width=\"100px\" height=\"100px\">
					<p>data registrazione: ".$riga['data_reg']."</p>
					<p>tipo utente: ".$riga['tipo']."</p>
					<p>numero segnalazioni: ".$riga['num_segn']."</p>";
					if($riga['tipo'] == "premium"){
						echo "<h3>Premium</h3>
						<p>numero segnalazioni corrette: ".$riga['class_corrette']."</p>
						<p>numero segnalazioni errate: ".$riga['class_errate']."</p>
						<p>numero segnalazioni totali: ".$riga['class_totali']."</p>
						<p> affidabilità: ".$riga['affidabilita']."</p>";
					}
					$count+=1;
				}
			}
			echo "</div>";
			echo "</div>";
		?>
	</body>
</html>
