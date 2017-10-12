<?php  
include_once 'includes.php';

$data = array(
	"login" => $_POST["user_login"],
	"password" => $_POST["password"]);

$conn = new Connection();
$db = $conn->get_db();

$req = "select * from trip.user 
	where login like '".$data["login"]."' 
	and password like '".$data["password"]."';";
$result = pg_query($db, $req);
if (pg_num_rows($result) == 0) {
	header("Location: signin_view.php?error=user_not_found");
} else {
	Session::save_session($data["login"], $data["password"]);
	header("Location: index.php");
}