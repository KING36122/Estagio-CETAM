<?php
	define("TITULO", "SIGPRO");
	include "cabecalho.php";
?>

<body onselectstart="return false">
	<section class="index-section">
		<div class="index-div-principal">
			<div class="index-div-title">
				<p>Faça seu Login!</p>
			</div>
		</div>
		<div class="login-div">
			<div class="login-div-box">
				<div class="login-div-img">
					<img class="logo" src="img/LOGO2.png">
				</div>
				<div class="login-div-form">
					<form action="login.php" method="post">
						<label class="login-label login-label-a" for="usuario"> Login:</label>
						<input class="login-input" type="email" name="email" id="inputEmail" required title="Preencha com seu Login" autocomplete="off" placeholder="Digite seu login"><br>
						<label class="login-label" for="senha"> Senha:</label>
						<input class="login-input" type="password" name="senha" id="inputSenha" required placeholder="Digite sua senha" title="Preencha com sua senha"><br>
						<center>    
							<button class="login-button" type="submit" value="Entrar" name="submit"> Acessar</button>
						</center>
					</form>
				</div>
			</div>
		</div>
	</section>
</body>