<body>

	<style>
		ul {
  		list-style-type: none;
  		margin: 0;
  		padding: 0;
  		overflow: hidden;
  		background-color: #333;
		}

		li {
  		float: left;
		}

		li a {
  		display: block;
  		color: white;
  		text-align: center;
  		padding: 14px 16px;
  		text-decoration: none;
		}

		li a:hover:not(.active) {
  		background-color: #130;
		}

		.active {
  		background-color: #4CAF50;
		}
	</style>
</head>

<body class = "grey lighten-4" style="background-image: url(img/background.jpg); background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed">
	<nav>


	<ul>
	<li><a href="#" class = "center "> NATURE</a></li>
	<li><a class = "active" href="index.php">Home</a></li>
	<li><a href="https://www.inaturalist.org/">Sito originale</a></li>
	<?php

		if(session_status() == PHP_SESSION_NONE){session_start();}

		//if(!isset($_SESSION['STime']) || (!isset($_SESSION['Nome']))){
		//	echo '<script language="javascript">';
		//	echo 'alert("Devi effettuare l accesso")';
		//	echo '</script>';
		//} else {

		echo "<li><a class=\"nav-link\" href=\"exit.php\">Esci</a></li>";
		echo "<li><a class=\"nav-link\" href=\"mioProfilo.php\">Visualizza profilo</a></li>";
		echo "<li><a navbar-brand href=\"altriProfili.php\">Visualizza gli altri profili</a></li>";
		echo "<li><a navbar-brand href=\"modProfilo.php\">Modifica profilo</a></li>";
		echo "<li><a navbar-brand href=\"inviaMessaggio.php\">Invia un messaggio</a></li>";
		echo "<li><a navbar-brand href=\"leggiMessaggi.php\">Leggi messaggi ricevuti</a></li>";


		//}
	?>

</ul>




</body>
