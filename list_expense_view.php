<?php 
	$expenses = Functions::get_all_expenses($current_event["id"]);
?>

<div class="row">
    <div class="col">
  		<h2>Liste de dépenses :</h2>
    </div>
    <div class="col">
    	<div class="text-right">
    		<a href="#" id="add-expense" data-toggle="modal" data-target="#add_expense_modal" data-expense-creator="<?php echo $current_expense; ?>">
    			<img src="icons/squared-plus.svg" class="glyphicon" data-toggle="tooltip" data-placement="top" title="Ajouter une dépense">
    		</a>
    	</div>
    </div>
 </div>

  <?php if (count($expenses) == 0) { ?>
  	<h4 class="text-danger">Pas de dépenses pour cet événement!</h4>
  	<?php } else { ?>
  		<div class="list-group">
  		<?php 
  			foreach ($expenses as $expense) { 
  				$concerned = Functions::get_all_expense_concerned($expense["id"]); ?>
			  <a class="list-group-item list-group-item-action flex-column align-items-start">
			    <div class="d-flex w-100 justify-content-between">
			      <h5 class="mb-1"><?php echo $expense["nature"] ?></h5>
			      <div>
			      	<h6 class="mb-1 concerned-users" style="cursor: pointer;">Concernés <img style="width: 20px;" src="icons/triangle-down.svg"></h6>
			      	<ul> <?php
			      		foreach ($concerned as $co) {
			      			echo "<li>".$co["concerned"]."</li>";
			      		} ?>
			      	</ul>
			      </div>
			      <small class="text-muted"><?php echo $expense["date"] ?></small>

			    </div>
			    <!-- <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p> -->
			    <small>id : <?php echo $expense["id"] ?> | </small>
			    <small>Payée par : <?php echo $expense["user_login"] ?> | </small>
			    <small>Valeur : <?php echo $expense["cost"] ?></small>
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

			$(".concerned-users").parent().children("ul").hide();
			$(".concerned-users").click(function() {
				$(this).parent().children("ul").slideToggle().toggleClass("opened");
				let isVisible = $(this).parent().children("ul").is(".opened");
				if (isVisible === true) {
					$(this).children("img").attr("src", "icons/triangle-up.svg");
				} else {
					$(this).children("img").attr("src", "icons/triangle-down.svg");
				}
			});
		</script>
		<?php 	} ?>