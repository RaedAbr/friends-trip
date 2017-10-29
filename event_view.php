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
			if (isset($_GET["id"]) && !empty($_GET["id"])) {
				$current_login = Session::get_user_login();
				$current_event = Functions::get_event_by_id($_GET["id"]);

				$expense_added = "";
		      	$concerned_added = "";
		      	if (isset($_GET["expense_added"]) && isset($_GET["concerned_added"])) {
		      		if ($_GET["expense_added"] == "yes") {
		      			$expense_added = "yes";
		      		} else {
		      			$expense_added = "no";
		      		}
		      		if ($_GET["concerned_added"] == "yes") {
		      			$concerned_added = "yes";
		      		} else {
		      			$concerned_added = "no";
		      		}
		      	}
			} else {
				header("Location: index.php");
			}
	?>
	<?php include_once 'head.php'; ?>
	<body>

		<?php include_once 'nav_bar.php'; ?>


	    <div class="container">

			<h1>Événement : "<?php echo $current_event["name"]; ?>"</h1>
	      <div>
	      	<?php include_once 'event_stat.php'; ?>
	      	<?php include_once 'list_expense_view.php'; ?>
	      	<?php include_once 'add_expense_view.php'; ?>
	      </div>

	    </div><!-- /.container -->
		<?php include_once 'foot.php'; ?>

		<script type="text/javascript">
			var expense_added = "<?php echo $expense_added ?>";
			var concerned_added = "<?php echo $concerned_added ?>";
			if (expense_added == "yes") {
				$().toastmessage('showToast', {
					text : "La dépense a été ajouté avec succès.",
					position : "top-right",
					type : "success",
					stayTime : 3000
				});
			}
			if (expense_added == "no") {
				$().toastmessage('showToast', {
					text : "La dépense n'a pas été ajouté!",
					position : "top-right",
					type : "error",
					stayTime : 3000
				});
			}
			if (concerned_added == "yes") {
				$().toastmessage('showToast', {
					text : "Les utilisateurs concernés ont été affectés avec succès.",
					position : "top-right",
					type : "success",
					stayTime : 3000
				});
			}
			if (concerned_added == "no") {
				$().toastmessage('showToast', {
					text : "Les utilisateurs concernés n'ont pas été affectés!",
					position : "top-right",
					type : "error",
					stayTime : 3000
				});
			}
		</script>
	</body>
</html>
<?php } ?>