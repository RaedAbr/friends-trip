<?php

define('HOST', 'localhost');
define('PORT', '5432');
define('DBNAME', 'trip');
// à changer avec le bon postgres user name et password
define('USER', 'raed');
define('PASSWORD', 'raed.1993');

class Connection {
	private $db;

	public function __construct() {
		$conn_string = "host=" . HOST . " port=" . PORT . " dbname=" . DBNAME . " user=" . USER . " password=" . PASSWORD;
		$this->db = pg_connect($conn_string);
	}

	public function get_db() {
		return $this->db;
	}
}