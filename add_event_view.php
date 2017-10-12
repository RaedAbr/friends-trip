<h2>Ajouter un évènement :</h2>
<form method="POST" action="add_event.php">
  <div class="form-group col col-lg-3">
    <label for="eventName">Libéllé</label>
    <input type="text" class="form-control" id="eventName" placeholder="Voyage à ..., sortie à ...">
  </div>
  <div class="form-group col col-lg-3">
    <label for="">Date</label>
    <input id="datepicker" type="text" class="form-control">
  </div>
  <!-- <div class="form-group">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Example multiple select</label>
    <select multiple class="form-control" id="exampleFormControlSelect2">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div> -->
  <input type="submit" class="btn btn-primary" value="Ajouter">
  <input type="button" class="btn btn-secondary" id="cancelButton" value="Annuler">
</form>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>