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
}