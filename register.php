<?php
include_once 'includes.php';

$data = array(
	"login" => $_POST["loginsignup"],
	"password" => $_POST["passwordsignup"],
	"email" => $_POST["emailsignup"]);

$conn = new Connection();
$db = $conn->get_db();

$result = pg_query($db, "select * from trip.user where login like '" . $data["login"] . "';");
if (pg_num_rows($result) == 0) {
	if (pg_insert($db, 'trip.user', $data)) {
		header("Location: signin_view.php?registration=ok");
	} else {
		header("Location: signup_view.php?error=database");
	}
} else {
	header("Location: signup_view.php?error=login_exist");
	die;
}