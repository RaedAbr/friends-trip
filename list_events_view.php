<?php 
	include_once 'includes.php';
	$events = Functions::get_all_events($current_login);
?>

<div class="row">
    <div class="col">
  		<h2>Liste d'évènements :</h2>
    </div>
    <div class="col">
    	<div class="text-right">
    		<a href="#" id="add-event" data-toggle="modal" data-target="#add_event_modal" data-event-creator="<?php echo $current_login; ?>">
    			<img src="icons/squared-plus.svg" class="glyphicon" data-toggle="tooltip" data-placement="top" title="Ajouter un évènement">
    		</a>
    	</div>
    </div>
 </div>

  <?php if (count($events) == 0) { ?>
  	<h4 class="text-danger">Vous avez pas d'évènements!</h4>
  	<?php } else { ?>
  		<div class="list-group">
  		<?php 
  			foreach ($events as $event) { ?>
			  <a href="event_view.php?id=<?php echo $event["id"]; ?>" class="list-group-item list-group-item-action flex-column align-items-start">
			    <div class="d-flex w-100 justify-content-between">
			      <h5 class="mb-1"><?php echo $event["name"] ?></h5>
			      <small class="text-muted"><?php echo $event["date"] ?></small>

			    </div>
			    <!-- <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> -->
			    <small>id : <?php echo $event["id"] ?> | </small>
			    <small>Ajouté par : <?php echo $event["creator"] ?></small>
			  </a>
		<?php 	} ?>
			 <!--  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
			    <div class="d-flex w-100 justify-content-between">
			      <h5 class="mb-1">List group item heading</h5>
			      <small class="text-muted">3 days ago</small>
			    </div>
			    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
			    <small class="text-muted">Donec id elit non mi porta.</small>
			  </a>
			  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
			    <div class="d-flex w-100 justify-content-between">
			      <h5 class="mb-1">List group item heading</h5>
			      <small class="text-muted">3 days ago</small>
			    </div>
			    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
			    <small class="text-muted">Donec id elit non mi porta.</small>
			  </a> -->
		</div>
		<script>
			$(function () {
			  $('[data-toggle="tooltip"]').tooltip();
			});
		</script>
		<?php 	} ?>