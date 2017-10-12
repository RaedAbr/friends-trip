<?php
include_once 'includes.php';

$from_registration = false;
if (isset($_GET["registration"])) {
	$from_registration = true;
}

$user_not_found = false;
if (isset($_GET["error"])) {
	$user_not_found = true;
}

if (Session::exist_session()) {
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="fr" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="fr" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="fr" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="fr" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="fr" class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="UTF-8" />
		<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
		<title>Petits comptes entre amis</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Petits comptes entre amis" />
		<meta name="keywords" content="voyage, amis, comptes" />
		<meta name="author" content="Raed" />
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<link rel="stylesheet" type="text/css" href="./css/animate-custom.css" />
	</head>
	<body>
		<div class="container">
			<header>
				<h1>Petits comptes entre amis</h1>
			</header>
			<section>
				<div id="container_codrops">
					<div id="wrapper">
						<div id="login" class="form">
							<form  action="connect.php" autocomplete="on" method="post">
								<h1>Connexion</h1>
								<?php  
									if ($from_registration) {
										echo '<p style="color:green">Inscription réussite. Vous pouvez vous maintenant!</p>';
									} 
									if ($user_not_found) {
										echo '<p style="color:red">Identificateur ou mot de passe inconnu!</p>';
									}
								?>
								<p>
									<label for="user_login" class="uname" data-icon="u">Identifiant</label>
									<input id="user_login" name="user_login" required="required" type="text" placeholder="ex. nom123"/>
								</p>
								<p>
									<label for="password" class="youpasswd" data-icon="p">Mot de passe</label>
									<input id="password" name="password" required="required" type="password" placeholder="ex. X8df!90EO" />
								</p>
								<p class="login button">
									<input type="submit" value="Connexion" />
								</p>
								<p class="change_link">
									Pas encore inscrit?
									<a href="signup_view.php" class="to_register">S'inscrire</a>
								</p>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
	</body>
</html>