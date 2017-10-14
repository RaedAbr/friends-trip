<?php
include_once 'includes.php';

class Functions {

	public static function get_all_events($user) {
		$conn = new Connection();
		$db = $conn->get_db();

		$req = "select * from trip.user_event
			where user_login like '" . $user . "';";
		$result = pg_query($db, $req);
		$array = array();
		while ($row = pg_fetch_assoc($result)) {
			$req = "select * from trip.event
				where id = '" . $row["event_id"] . "';";
			$result2 = pg_query($db, $req);
			$entry = pg_fetch_assoc($result2);
			array_push($array, $entry);
		}
		return $array;
	}

	public static function get_users_by_login_pattern($pattern)
	{
		$conn = new Connection();
		$db = $conn->get_db();

		$req = "select * from trip.user where login ilike '" .$pattern . "%';";
		$result = pg_query($db, $req);
		$array = array();
		while ($row = pg_fetch_assoc($result)) {
			array_push($array, $row);
		}
		return $array;
	}

	public static function insert_event($event) {
		$conn = new Connection();
		$db = $conn->get_db();

		$req = "INSERT INTO trip.event (name, date, creator) 
				VALUES ('".$event["name"]."', '".$event["date"]."', '".$event["creator"]."')
   				RETURNING trip.event.id;";
		if ($result = pg_query($db, $req)) {
			$row = pg_fetch_assoc($result);
			return $row["id"];
		}
		return -1;
	}

	public static function insert_user_event($user_event) {
		$conn = new Connection();
		$db = $conn->get_db();

		if (pg_insert($db, 'trip.user_event', $user_event)) 
			return true;
		return false;
	}
}