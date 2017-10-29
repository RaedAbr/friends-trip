<?php
include_once 'includes.php';
$current_event = Functions::get_event_by_id($_POST["eventId"]);

$event = array(
	"user_login" => $_POST["expenseCreator"],
	"event_id" => $_POST["eventId"],
	"nature" => $_POST["expenseNature"],
	"cost" => $_POST["expenseCost"]
);

$concerned_users = json_decode($_POST["users_list"]);

$expense_id = Functions::insert_expense($event);

if ($expense_id != -1) {
	foreach ($concerned_users as $user) {
		$expense_concerned = array(
			"expense_id" => $expense_id,
			"concerned" => $user
		);
		if (!Functions::insert_expense_concerned($expense_concerned)) {
			header("Location: event_view.php?id=".$current_event["id"]."&expense_added=yes&concerned_added=no");
		}
	}
	header("Location: event_view.php?id=".$current_event["id"]."&expense_added=yes&concerned_added=yes");
} else {
	header("Location: event_view.php?id=".$current_event["id"]."&expense_added=no&concerned_added=no");
}