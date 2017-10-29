<?php 

?>

<div class="modal fade" id="add_expense_modal" tabindex="-1" role="dialog" aria-labelledby="add_expense_modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="add_expense_modalLabel">Ajout d'une dépense :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="add_expense.php" onsubmit="sendData(this);">
        <div class="modal-body">
          <div id="step1">
            <input name="expenseCreator" type="text" class="form-control" id="expenseCreator" hidden value="<?php echo $current_login ?>">
            <input name="eventId" type="text" class="form-control" id="eventId" hidden value="<?php echo $current_event['id'] ?>">
            <div class="form-group">
              <label for="expenseNature" class="form-control-label">Nature :</label>
              <input name="expenseNature" type="text" class="form-control" id="expenseNature" placeholder="bière, dîner..." required>
            </div>
            <div class="form-group">
              <label for="expenseCost">Valeur :</label>
              <input name="expenseCost" id="expenseCost" type="text" class="form-control" required>
            </div>
          </div>
          <div id="step2">
            <h6>Utilisateurs concernés (clickez pour sélectionner):</h6>
            <table class="table table-sm" id="users-event-list">
              <?php 
                foreach ($users_event as $user_event) { ?>
                  <tr>
                    <td class="user_event" style="cursor: pointer;"><?php echo $user_event["user_login"];?></td>
                  </tr>
                <?php } 
              ?>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary" id="submit-button">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
	var selected_users = [];
	$(".user_event").click(function() {
		if ($(this).hasClass("bg-success")) {
			$(this).removeClass("bg-success");
			let i = selected_users.indexOf($(this).text());
			if (i !== -1) {
				selected_users.splice(i, 1);
			}
		} else {
			$(this).addClass("bg-success");
			selected_users.push($(this).text());
		}
	});

	function sendData(form) {
	  	var input = $("<input>")
	  		.attr("type", "hidden")
	  		.attr("name", "users_list")
	  		.val(JSON.stringify(selected_users))
	  		.appendTo(form);
	  	return true;
	}
</script>