<?php
include_once 'includes.php';

$error = false;
if (isset($_GET["error"])) {
    $error = true;
    if ($_GET["error"] == "database")
        $message = "Erreur au niveau de la base de données!";
    if ($_GET["error"] == "login_exist")
        $message = "Ce login existe! Veuillez choisir un autre login.";    
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
                <div id="container_codrops" >
                    <div id="wrapper">
                        <div id="register" class="form">
                            <form  action="register.php" autocomplete="on" method="post">
                                <h1>Inscription</h1>
                                <?php  
                                    if ($error) {
                                        echo '<p style="color:red">'.$message.'</p>';
                                    }
                                ?>
                                <p>
                                    <label for="loginsignup" class="uname" data-icon="u">Identifiant</label>
                                    <input id="loginsignup" name="loginsignup" required="required" type="text" placeholder="ex. nom123" />
                                </p>
                                <p>
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Mot de passe</label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="ex. X8df!90EO"/>
                                </p>
                                <p>
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Confirmation mot de passe</label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="ex. X8df!90EO"/>
                                </p>
                                <p>
                                    <label for="emailsignup" class="youmail" data-icon="e" >E-mail</label>
                                    <input id="emailsignup" name="emailsignup" type="email" placeholder="mon_email@mail.com"/>
                                </p>
                                <p class="signin button">
									<input type="submit" value="S'inscrire"/>
								</p>
                                <p class="change_link">
									Vous avez déjà un compte?
									<a href="signin_view.php" class="to_register">Connexion</a>
								</p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>