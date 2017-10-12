<?php
include_once 'includes.php';
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="fr" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="fr" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="fr" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="fr" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="fr" class="no-js"> <!--<![endif]-->
	<?php 
		if (!Session::exist_session()) {
			header("Location: signin_view.php");
		} else {
			$user_login = Session::get_user_login();

			$events = Functions::get_all_events($user_login);
	?>
	<?php include_once 'head.php'; ?>
	<body>
		<!-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<a class="navbar-brand" href="#">Fixed top</a>
		</nav>
		<div class="container">
			<h1>Vous êtes identifié comme <?php echo $user_login; ?></h1>
			<form action="logoff.php" method="POST">
				<input type="submit" name="logoff_button" value="Déconnection">
			</form>
		</div> -->

		<?php include_once 'nav_bar.php'; ?>


	    <div class="container">

	      <div class="starter-template">
	        <h1>Petits comptes entre amis</h1>
	        <p class="lead">Ce site vous permet de noter et partager les dépenses effectuées <br> par et pour le groupe au cours de vacances communes avec vos amis.</p>
	      </div>
	      <div id="dynamic-ajax-content">
	      	<?php include_once 'list_events_view.php'; ?>
	      </div>

	    </div><!-- /.container -->



		<?php include_once 'foot.php'; ?>
	</body>
</html>
<?php } ?>