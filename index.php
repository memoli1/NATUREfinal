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
		?>


</div>



		<?php
		//echo "<body style=\"background-color:white\">";
		echo "<div class=\"card text-white bg-success mb-3 mt-4\">";
		echo "<div class=\"w3-container w3-center\">";


			$sql = "SELECT tipo
					FROM utente
					WHERE nome = '".$_SESSION['Nome']."'";

			$ok = mysqli_query($conn, $sql);

			if($ok && (mysqli_num_rows($ok) != 0))
			{
				$riga = mysqli_fetch_array($ok);
				if($riga['tipo'] == "amministratore"){
					echo "<h2>AMMINISTRATORE</h2>";
					echo "<a href=\"aggiungiSegnalazione.php\">Inserisci segnalazione</a><br>
					<a href=\"visualizzaSegnalazioni.php\">Visualizza segnalazioni</a><br>
					<a href=\"classificaSegnalazione.php\">Classifica una segnalazione</a><br>
					<a href=\"visualizzaEscursioni.php\">Visualizza escursioni</a><br>
					<a href=\"adesisciEscursione.php\">Aderisci ad una escursione</a><br>
					<a href=\"visualizzaCampagne.php\">Visualizza campagne di raccolta fondi</a><br>
					<a href=\"donaCampagna.php\">Dona a una campagna di raccolta fondi</a><br>
					<a href=\"nuovaFlora.php\">Inserisci nuova flora</a><br>
					<a href=\"modificaFlora.php\">Modifica flora</a><br>
					<a href=\"eliminaFlora.php\">Elimina flora</a><br>
					<a href=\"nuovaFauna.php\">Inserisci nuova fauna</a><br>
					<a href=\"modificaFauna.php\">Modifica fauna</a><br>
					<a href=\"eliminaFauna.php\">Elimina fauna</a><br>
					<a href=\"nuovoHabitat.php\">Inserisci nuovo habitat</a><br>
					<a href=\"modificaHabitat.php\">Modifica habitat</a><br>
					<a href=\"eliminaHabitat.php\">Elimina habitat</a><br>
					<a href=\"floraInHabitat.php\">Inserisci flora in un habitat</a><br>
					<a href=\"faunaInHabitat.php\">Inserisci fauna in un habitat</a><br>
					<a href=\"correggiClass.php\">Correggi una classificazioni</a><br>
					<a href=\"creaCampagna.php\">Crea una campagna di raccolta fondi</a><br>";
				} else {
					echo "";
					echo "<h2>UTENTE SEMPLICE & PREMIUM</h2>";
					echo "<a href=\"aggiungiSegnalazione.php\">Inserisci segnalazione</a><br>
						<a href=\"visualizzaSegnalazioni.php\">Visualizza segnalazioni</a><br>
						<a href=\"modificaFotoSegnalazione.php\">Modifica foto segnalazione</a><br>
						<a href=\"classificaSegnalazione.php\">Classifica una segnalazione</a><br>
						<a href=\"visualizzaEscursioni.php\">Visualizza escursioni</a><br>
						<a href=\"adesisciEscursione.php\">Aderisci ad una escursione</a><br>
						<a href=\"escursioniAderite.php\">Visualizza escursioni a cui si aderisce</a><br>
						<a href=\"visualizzaCampagne.php\">Visualizza campagne di raccolta fondi</a><br>
						<a href=\"donaCampagna.php\">Dona a una campagna di raccolta fondi</a><br>";
					if($riga['tipo'] == "premium"){
						echo "<h2>Premium</h2>";
						echo "<a href=\"creaEscursione.php\">Crea escursione</a><br>";
					}
				}
			}else{
				echo "<div><p>Errore rete</p></div>";
				die();
			}
			echo "</div>";
			echo "</div>";
			//echo "</div>";
			//echo "</body>";
		?>
	</body>
</html>
