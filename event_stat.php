<?php
	$users_event = Functions::get_users_by_event($current_event["id"]);
?>
<div class="card">
  	<div class="card-body">
		<div class="row">
		    <div class="col-sm">
		      <?php
		      echo "<ul class='list-group'>
		      	<li class='list-group-item active'>Ce qu'il faut faire pour équilibrer :</li>";
		      $neg = 0;
		      $pos = 0;
			foreach ($users_event as $user) {
				if ($user["user_login"] != $current_login) {
					$x1 = Functions::get_user_situation($current_event["id"], $current_login, $user["user_login"]);
					$x2 = Functions::get_user_situation($current_event["id"], $user["user_login"], $current_login);
					$r = $x1 - $x2;
					if ($r > 0) {
						echo "<li class='list-group-item'>".$user["user_login"].
							" doit <span class='badge badge-secondary'>CHF ".$r."</span> à ".
							$current_login." (moi)</li>";
					} else if ($r < 0) {
						echo "<li class='list-group-item'>je (".$current_login.") dois <span class='badge badge-secondary'>CHF ".(-$r)."</span> à ".$user["user_login"]."</li>";
						$neg += $r;
					}
				}
			}
			echo "</ul>";
			?>
		    </div>
		    <div class="col-sm">
		      <?php
		      $balance = array();
		     foreach ($users_event as $user1) {
		     	$val = 0;
		     	foreach ($users_event as $user2) {
		     		if ($user1["user_login"] != $user2["user_login"]) {
						$x1 = Functions::get_user_situation($current_event["id"], $user1["user_login"], $user2["user_login"]);
						$x2 = Functions::get_user_situation($current_event["id"], $user2["user_login"], $user1["user_login"]);
						$r = $x1 - $x2;
						$val += $r;
		     		}
		     	}
		     	$balance[$user1["user_login"]] = $val;
			}
			$min_val = INF;
			$max_val = -99999999999999;
			foreach ($balance as $key => $value) {
				if ($value < $min_val) $min_val = $value;
				if ($value > $max_val) $max_val = $value;
			}
			?>
			<ul class='list-group'>
		      	<li class='list-group-item active'>Balance du groupe :</li>
		      	<li class='list-group-item'>
					<table class="table-balance">
					<?php
					foreach ($balance as $key => $value) {
						if ($value > 0)
							echo "<tr><td style='text-align: right'>".$key." : CHF <span>".$value."</span></td><td class='pos-val'></td></tr>";
						if ($value < 0)
							echo "<tr><td class='neg-val'></td><td>".$key." : CHF <span>".$value."</span></td></tr>";
					}
					?>	
					</table>
				</li>
		    </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(".table-balance tbody tr td").css({
		"margin-top" : "5px"
	});
	let max_val = "<?php echo $max_val; ?>";
	let min_val = "<?php echo $min_val; ?>";
	let pos_div = $(".pos-val");
	pos_div.css({
		"background-color" : "#28a745",
		"display" : "block",
		"float" : "left",
		"height" : "30px",
		"width" : function() {
			let per = $(this).prev().children("span").text() * 100 / max_val;
			return per + "%";
		}
	});
	pos_div.prev().css({
		"color" : "#28a745",
		"font-style" : "italic",
    	"font-weight" : "bold",
		"width" : "50%",
		"padding-top" : "10px"
	});

	let neg_div = $(".neg-val");
	neg_div.css({
		"background-color" : "#dc3545",
		"display" : "block",
		"float" : "right",
		"height" : "30px",
		"direction" : "rtl",
		"width" : function() {
			let per = Math.abs($(this).next().children("span").text()) * 100 / max_val;
			return per + "%";
		}
	});
	neg_div.next().css({
		"color" : "#dc3545",
		"font-style" : "italic",
    	"font-weight" : "bold",
		"padding-top" : "10px"
	});
</script>
<style type="text/css">
.table-balance {
    width: 100%;
    max-width: 100%;
}
</style>