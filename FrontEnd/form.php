<?php

	session_start();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- Icons -->

		<link
			href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
			rel="stylesheet"
		/>

		<!-- CSS import -->
		<link rel="stylesheet" href="styles/global.css" />
		<link rel="stylesheet" href="styles/form.css" />

		<title>Login</title>
	</head>
	<body>
		<div class="container">

			<div class="return">
				<a href="../FrontEnd/index.html"> Voltar para o Site </a>
			</div>
			
			<form method="POST" action="../BackEnd/login.php" >
			<h1>Login</h1>
			<p>
				Bem-vindo novamente, preencha seus dados para entrar na plataforma
			</p>
			<div class="inputGroup">
				<label for="name">Nome:</label>
				<input id="name" type="text" name="UserName" placeholder="Nome" />
			</div>
			<div class="inputGroup">
				<label for="email">Email:</label>
				<input id="email" type="email" name="Email" placeholder="Email" />
			</div>
				<div class="inputGroup">
					<label for="password">Senha:</label>
					<div class="passIcons">
						<span class="material-symbols-outlined" id="visible">
							visibility
						</span>
						<span class="material-symbols-outlined" id="visibleOff">
							visibility_off
						</span>
					</div>
					<input id="password" type="password" name="UserPassword" placeholder="Senha" />
				</div>
				<button type="submit">Entrar</button>
				<div class="error">
					<p>
						<?php 
							if (isset($_GET['loginError'])){
								echo "<p>".$_GET['loginError']."</p>";
								unset($_GET['loginError']);
							}
						?>
					</p>
				</div>

			</form>

		</div>
		<script src="./js/inputPassword.js"></script>
	</body>
</html>
