<?php
	require("serverCon.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>NATURE</title>
		<link rel="icon" href="icon.png" type="image/x-icon"/>
			<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<style media="screen">

		input[type=text], input[type=password] {
  	width: 70%;
  	padding: 12px 20px;
  	margin: 8px 0;
  	display: inline-block;
  	border: 1px solid #ccc;
  	box-sizing: border-box;
		}

		.button {
		background-color: #4CAF50; /* Green */
	  border: none;
	  color: white;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
		}

		button:hover {
  	opacity: 0.8;
		}

		span.psw {
  	float: right;
  	padding-top: 16px;
		}

		div.container
		{
    display: block;
    text-align: center;
		}

		</style>

	</head>
	<body>
		<?php
			require("menu.php")
		?>
		<div class="container">
			<form method="post">
				  <h2 style="text-align:center">Login</h2>
					<input type="text" placeholder="Nome" name="Nome" value="" required><br>
					<input type="password" placeholder="Password" name="Password" value="" required><br>

				<input class="button" type="submit" id="button" value="Accedi">
				<input class="button" type="button" id="button" value="Iscriviti" onclick="location.href='iscriviti.php';">

			</form>
		</div>

			<?php
				if(isset($_POST['Nome']) && isset($_POST['Password'])){
					$nome = $_POST['Nome'];
					$pass = $_POST['Password'];

					$str = str_replace('', '_', $nome);//sql iniection
					$nome = preg_replace("/[^a-zA-Z0-9_-]/", "", $str);

					$salt = substr($nome,0,2);

					$pass = crypt($pass, $salt);

					$sql = "SELECT nome, password
							FROM utente
							WHERE nome = '$nome'
							AND password = '$pass'";
					$ok = mysqli_query($conn, $sql);

					if($ok && (mysqli_num_rows($ok) != 0))
					{
						//session_start();
						if(session_status() == PHP_SESSION_NONE){session_start();}

						session_unset();
						session_destroy();

						session_start();

						$_SESSION['STime'] = time();
						$app = mysqli_fetch_array($ok);
						$_SESSION['Nome'] = $app['nome'];

						//require("index.php");
						header("Location: index.php");
					}else{
						echo "<div class=\"w3-container w3-center\"><p>Nome Utente o Password sbagliati</p></div>";
					}
				}
			?>
		</div>
	</body>
</html>
