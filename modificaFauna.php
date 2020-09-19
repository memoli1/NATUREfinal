<?php
	require("serverCon.php");
	require("sessionCon.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>NATURE</title>
		<link rel="icon" href="icon.png" type="image/x-icon"/>
		<link rel="stylesheet" href="stylecss.css">
	</head>
	<body>
		<?php
			require("menu.php");
			
			if(isset($_POST['submit'])){
				if($_POST['classe'] != "" || $_POST['nome_specie'] != "" || $_POST['anno_classif'] != ""
				|| $_POST['livello_vulne'] != "" || $_POST['link_wiki'] != ""
				|| $_POST['peso'] != "" || $_POST['altezza'] != "" || $_POST['num_avg_prole'] != ""){
					if($_POST['classe'] != "" || $_POST['nome_specie'] != "" || $_POST['anno_classif'] != ""
						|| $_POST['livello_vulne'] != "" || $_POST['link_wiki'] != ""){
						$sql = "UPDATE `specie` SET ";
						if($_POST['classe'] != ""){
							$sql = $sql."`classe` = '".$_POST['classe']."', ";
						}
						if($_POST['nome_specie'] != ""){
							$sql = $sql."`nome_specie` = '".$_POST['nome_specie']."', ";
						}
						if($_POST['anno_classif'] != ""){
							$sql = $sql."`anno_classif` = '".$_POST['anno_classif']."', ";
						}
						if($_POST['livello_vulne'] != ""){
							$sql = $sql."`livello_vulne` = '".$_POST['livello_vulne']."', ";
						}
						if($_POST['link_wiki'] != ""){
							$sql = $sql."`link_wiki` = '".$_POST['link_wiki']."', ";
						}
						$sql = substr($sql, 0, -2);
						$sql = $sql." WHERE `nome_lat` = '".$_POST['nome_lat']."'";
					
						$ok = mysqli_query($conn, $sql);

						if(!$ok) {
							echo "<div><p>fauna non modificata</p></div>";
						} else {
							echo "<div><p>specie modificata</p></div>";
						}
					}
					if($_POST['peso'] != "" || $_POST['altezza'] != "" || $_POST['num_avg_prole'] != ""){
						$sql = "UPDATE `animali` SET ";
						if($_POST['peso'] != ""){
							$sql = $sql."`peso` = '".$_POST['peso']."', ";
						}
						if($_POST['altezza'] != ""){
							$sql = $sql."`altezza` = '".$_POST['altezza']."', ";
						}
						if($_POST['num_avg_prole'] != ""){
							$sql = $sql."`num_avg_prole` = '".$_POST['num_avg_prole']."', ";
						}
						$sql = substr($sql, 0, -2);
						
						$sql = $sql." WHERE `nome_lat` = '".$_POST['nome_lat']."'";
						
						$ok = mysqli_query($conn, $sql);

						if(!$ok) {
							echo "<div><p>fauna non modificata</p></div>";
						} else {
							echo "<div><p>fauna modificata</p></div>";
						}
					}
					
					$sql = "INSERT INTO `modifica_specie` (`nome_lat`, `nome_amm`, `azione`)
					VALUES ('".$_POST['nome_lat']."', '".$_SESSION['Nome']."', 'modifica')";

					$ok = mysqli_query($conn, $sql);
					if(!$ok) {
						echo "<div><p>Errore registrazione modifica</p></div>";
					}
					
					/*$collection = (new MongoDB\Client)->NATURA->log;
						$result = $collection->insertOne([
							'nome' => $_SESSION['Nome'],
							'azione' => 'modifica',
							'tipo' => 'fauna',
							'id' => $_POST['nome_lat']});*/
				}else{
					echo "<div><p>dati non validi</p></div>";
				}
			}
		?>
		<form method="post">
			<div>
				<span>scegli l'animale:</span>
				<select name="nome_lat">
				<?php
					$sql = "SELECT nome_lat
							FROM animali";
							
					$ok = mysqli_query($conn, $sql);
							
					if($ok && (mysqli_num_rows($ok) != 0))
					{
						while($riga = mysqli_fetch_array($ok)){
							echo "<option value=\"".$riga['nome_lat']."\">".$riga['nome_lat']."</option>";
						}
					}
				?>
				</select><br>
				<span>Classe:</span><input type="text" placeholder="Classe" name="classe" value="" /><br>
				<span>Nome specie:</span><input type="text" placeholder="Nome specie" name="nome_specie" value="" /><br>
				<span>Anno classificazione:</span><input type="text" placeholder="Anno classificazione" name="anno_classif" value="" /><br>
				<span>Livello vulnerabilità:</span><input type="text" placeholder="Livello vulnerabilità" name="livello_vulne" value="" /><br>
				<span>Link wikipedia:</span><input type="text" placeholder="Link wikipedia" name="link_wiki" value="" /><br><br>
				
				<span>Peso:</span><input type="text" placeholder="Peso" name="peso" value="" /><br>
				<span>Altezza:</span><input type="text" placeholder="Altezza" name="altezza" value="" /><br>
				<span>Numero medio prole:</span><input type="text" placeholder="Numero medio prole" name="num_avg_prole" value="" /><br>
			</div>
			<input type="submit" name="submit" value="modifica fauna" />
		</form>
	</body>
</html>