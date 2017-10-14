<div class="modal fade" id="add_event_modal" tabindex="-1" role="dialog" aria-labelledby="add_event_modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="add_event_modalLabel">Ajout d'un évènement :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="add_event.php" onsubmit="sendData(this);">
        <div class="modal-body">
          <div id="step1">
            <div class="form-group">
              <label for="eventCreator" class="form-control-label">Créateur :</label>
              <input name="eventCreator" type="text" class="form-control" id="eventCreator" readonly>
            </div>
            <div class="form-group">
              <label for="eventName" class="form-control-label">Libéllé :</label>
              <input name="eventName" type="text" class="form-control" id="eventName" placeholder="Voyage à ..., sortie à ...">
            </div>
            <div class="form-group">
              <label for="datepicker">Date :</label>
              <input name="datepicker" id="datepicker" type="text" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="userWeight" class="form-control-label">Mon poids (1 par défaut):</label>
              <input name="userWeight" type="text" class="form-control" id="userWeight" value="1">
            </div>
          </div>
          <div id="step2">
            <h6>Ajout des participants :</h6>
            <div class="form-group">
              <input type="text" class="form-control" id="searchUsers" 
              	placeholder="Entrez le login d'un utilisateur..." onkeyup="showResult(this.value)"
              	autocomplete="off">
            </div>
            <div class="row">
              <div class="col">
                Résultat :
                <div id="users_login"></div>
              </div>
              <div class="col">
                Sélectionnés :
                <table class="table table-sm" id="selected-user-list"></table>
              </div>
            </div>
            <div class="form-group">
              <span id="users_count">0</span> utilisateur(s) sélectionné(s)
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary" id="prev-button">Précédent</button>
          <button type="button" class="btn btn-primary" id="next-button">Suivant</button>
          <button type="submit" class="btn btn-primary" id="submit-button">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  } );


  $("#next-button").on("click", function() {
    // alert( $("input:text").length);
    let bool = true;
    if ($("#userWeight").val() === "") {
      $("#userWeight").addClass("empty-input");
      bool = false;
    } else {
      $("#userWeight").removeClass("empty-input");
    }
    if ($("#datepicker").val() === "") {
      $("#datepicker").addClass("empty-input");
      bool = false;
    } else {
      $("#datepicker").removeClass("empty-input");
    }
    if ($("#eventName").val() === "") {
      $("#eventName").addClass("empty-input");
      bool = false;
    } else {
      $("#eventName").removeClass("empty-input");
    }
    if (bool) {
      swapNextPage();
    }
  });

  $("#prev-button").on("click", function() {
    swapPrevPage();
  });

  $("#add_event_modal").on("show.bs.modal", function (event) {
    resetPages();
    let button = $(event.relatedTarget) // Button that triggered the modal
    let recipient = button.data("event-creator") // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal"s content. We"ll use jQuery here, but you could use a data binding library or other methods instead.
    let modal = $(this)
    // modal.find(".modal-title").text("New message to " + recipient)
    modal.find(".modal-body #eventCreator").val(recipient)
  });

  var selected_logins = [];

  function showResult(str) {
    $("#users_login").html("");
    if (str.length != 0) {
      $.post("live_users_search.php", {pattern : str, list : JSON.stringify(selected_logins)})
        .done(function(result) {
          $("#users_login").html(result);
        });
    }
  }

  var current_user;
  var current_user_weight;
  function swapNextPage() {
  	current_user = $("input[name=eventCreator]").val();
  	current_user_weight = $("input[name=userWeight]").val();
    $("#step1").toggle( "slide", {"direction" : "left"}, 100, function() {
      $("#step2").toggle("slide", {"direction" : "right"}, 100);
      $("#submit-button").removeAttr("disabled");
      $("#next-button").attr("disabled", "true");
      $("#prev-button").removeAttr("disabled");
      $("#userWeight").removeClass("empty-input");
      $("#datepicker").removeClass("empty-input");
      $("#eventName").removeClass("empty-input");
    });
  }

  function swapPrevPage() {
    $("#step2").toggle( "slide", {"direction" : "right"}, 100, function() {
      $("#step1").toggle("slide", {"direction" : "left"}, 100);
      $("#submit-button").attr("disabled", "true");
      $("#next-button").removeAttr("disabled");
      $("#prev-button").attr("disabled", "true");
    });
  }

  function resetPages() {
    $("#submit-button").attr("disabled", "true");
    $("#prev-button").attr("disabled", "true");
    $("#next-button").removeAttr("disabled");
    $("#step2").hide();
    $("#step1").toggle("slide", {"direction" : "left"}, 100);
    $("input").removeClass("empty-input");
  }

  function userSelected(selected) {
    if (selected.attr("selected-user") === "no") {
      // if (selected_logins.indexOf(selected.attr("user-login")) === -1) {
      selected.attr("src", "icons/squared-minus.svg");
      // selected.parent().parent().addClass("table-success");
      selected.attr("selected-user", "yes");
      selected.parent().parent().siblings(".user-weight").html(
      	'<input class="form-control" for-login="' + selected.attr("user-login") +'" type="text" value="1" ' + 
			      	'style="width: 24px;' + 
			      	'padding: 0;' + 
			      	'text-align: center;">'
			);
      if (selected_logins.length == 0) {
      	var title = $('<tr class="table-active">')
      		.html("<td>Login</td><td>Poids</td><td></td>")
      		.appendTo($("#selected-user-list"));
      	// $("#selected-user-list").append(selected.parent().parent().parent());
      }
      selected_logins.push(selected.attr("user-login"));
      $("#selected-user-list").append(selected.parent().parent().parent());
      // }
    } else {
      selected.attr("src", "icons/squared-plus.svg");
      // selected.parent().parent().removeClass("table-success");
      selected.attr("selected-user", "no");
      selected_logins.splice(selected_logins.indexOf(selected.attr("user-login")), 1);
      showResult($("#searchUsers").val());
      selected.parent().parent().parent().remove();
    }
    $("#users_count").text(selected_logins.length);
  }

  function sendData(form) {
  	logins_weight = [];
  	logins_weight.push({
			login : current_user,
			weight : current_user_weight
  	})
  	selected_logins.forEach(function(l) {
  		logins_weight.push({
  			login : l,
  			weight : $("input[for-login='" + l + "']").val()
  		});
   	});
  	var input = $("<input>")
  		.attr("type", "hidden")
  		.attr("name", "users_list")
  		.val(JSON.stringify(logins_weight))
  		.appendTo(form);
  	return true;
  }
</script>