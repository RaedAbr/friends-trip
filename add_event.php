<?php
include_once 'includes.php';

$event = array(
	"name" => $_POST["eventName"],
	"creator" => $_POST["eventCreator"],
	"date" => $_POST["datepicker"],
);

$users_and_weight_list = json_decode($_POST["users_list"]);

$event_id = Functions::insert_event($event);
if ($event_id != -1) {
	foreach ($users_and_weight_list as $en) {
		$user_event = array(
			"event_id" => $event_id,
			"user_login" => $en->login,
			"user_weight" => $en->weight
		);
		if (!Functions::insert_user_event($user_event)) {
			header("Location: index.php?event_added=yes&user_event_added=no");
		}
	}
	header("Location: index.php?event_added=yes&user_event_added=yes");
} else {
	header("Location: index.php?event_added=no&user_event_added=no");
}