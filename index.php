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
			
	      	$event_added = "";
	      	$user_event_added = "";
	      	if (isset($_GET["event_added"]) && isset($_GET["user_event_added"])) {
	      		if ($_GET["event_added"] == "yes") {
	      			$event_added = "yes";
	      		} else {
	      			$event_added = "no";
	      		}
	      		if ($_GET["user_event_added"] == "yes") {
	      			$user_event_added = "yes";
	      		} else {
	      			$user_event_added = "no";
	      		}
	      	} ?>
	<?php include_once 'head.php'; ?>
	<body>

		<?php include_once 'nav_bar.php'; ?>


	    <div class="container">

	      <div class="starter-template">
	        <h1>Petits comptes entre amis</h1>
	        <p class="lead">Ce site vous permet de noter et partager les dépenses effectuées <br> par et pour le groupe au cours de vacances communes avec vos amis.</p>
	      </div>
	      <div>
	      	<?php include_once 'list_events_view.php'; ?>
	      	<?php include_once 'add_event_view.php'; ?>
	      </div>

	    </div><!-- /.container -->
		<?php include_once 'foot.php'; ?>

		<script type="text/javascript">
			var event_added = "<?php echo $event_added ?>";
			var user_event_added = "<?php echo $user_event_added ?>";
			if (event_added == "yes") {
				$().toastmessage('showToast', {
					text : "L'évènnement a été ajouté avec succès.",
					position : "top-right",
					type : "success",
					stayTime : 3000
				});
			}
			if (event_added == "no") {
				$().toastmessage('showToast', {
					text : "L'évènnement n'a été ajouté!",
					position : "top-right",
					type : "error",
					stayTime : 3000
				});
			}
			if (user_event_added == "yes") {
				$().toastmessage('showToast', {
					text : "Les utilisateurs ont été affectés avec succès.",
					position : "top-right",
					type : "success",
					stayTime : 3000
				});
			}
			if (user_event_added == "no") {
				$().toastmessage('showToast', {
					text : "Les utilisateurs n'ont pas été affectés!",
					position : "top-right",
					type : "error",
					stayTime : 3000
				});
			}
		</script>
	</body>
</html>
<?php } ?>