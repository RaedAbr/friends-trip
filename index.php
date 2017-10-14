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
			$current_login = Session::get_user_login();
	?>
	<?php include_once 'head.php'; ?>
	<body>
		<!-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<a class="navbar-brand" href="#">Fixed top</a>
		</nav>
		<div class="container">
			<h1>Vous êtes identifié comme <?php echo $current_login; ?></h1>
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
	      <div>
	      	<?php
	      	$event_added = "";
	      	$user_event_added = "";
	      	if (isset($_GET["event_added"]) && isset($_GET["user_event_added"])) {
	      		if ($_GET["event_added"] == "yes") {
	      			$event_added = "yes";
	      			// echo "<div class='".$success."'>L'évènnement a été ajouté avec succès</div>";
	      		} else {
	      			$event_added = "no";
	      			// echo "<div class='".$failure."'>L'évènnement n'a été ajouté!</div>";
	      		}
	      		if ($_GET["user_event_added"] == "yes") {
	      			$user_event_added = "yes";
	      			// echo "<div class='".$success."'>Les utilisateurs ont été affectés avec succès</div>";
	      		} else {
	      			$user_event_added = "no";
	      			// echo "<div class='".$failure."'>Les utilisateurs n'ont pas été affectés!</div>";
	      		}
	      	} ?>
	      	<?php include_once 'list_events_view.php'; ?>
	      	<?php include_once 'add_event_view.php'; ?>
	      </div>

	    </div><!-- /.container -->


		<?php include_once 'foot.php'; ?>

		<script>
		$(document).ready(function(){
			var event_added = "<?php echo $event_added ?>";
			var user_event_added = "<?php echo $user_event_added ?>";
			alert(event_added);
			if (event_added == "yes") {
				$().toastmessage('showToast', {
					text : "L'évènnement a été ajouté avec succès.",
					position : "top-right",
					type : "success"
				});
			}
			if (event_added == "no") {
				$().toastmessage('showToast', {
					text : "L'évènnement n'a été ajouté!",
					position : "top-right",
					type : "error"
				});
			}
			if (user_event_added == "yes") {
				$().toastmessage('showToast', {
					text : "Les utilisateurs ont été affectés avec succès.",
					position : "top-right",
					type : "success"
				});
			}
			if (user_event_added == "no") {
				$().toastmessage('showToast', {
					text : "Les utilisateurs n'ont pas été affectés!",
					position : "top-right",
					type : "error"
				});
			}
		});
		</script>
	</body>
</html>
<?php } ?>