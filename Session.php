<?php

/**
* 
*/
class Session {
	public static function save_session($login, $password) {
		session_start();
		if (isset($login) && isset($password)) {
			$_SESSION["user_login"] = $login;
			$_SESSION["user_password"] = $password;
		}
	}

	public static function destroy_session() {
		session_start();
		// Détruit toutes les variables de session
		$_SESSION = array();
		// Si vous voulez détruire complètement la session, effacez également
		// le cookie de session.
		// Note : cela détruira la session et pas seulement les données de session !
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			foreach ($variable as $key) {
				setcookie(session_name(), '', time() - 42000,
					$key
				);
			}
		}
		// Finalement, on détruit la session.
		session_destroy();
	}

	public static function exist_session() {
		session_start();
		if (empty($_SESSION["user_login"]) || empty($_SESSION["user_login"])) {
			return false;
		}
		return true;
	}

	public static function get_user_login() {
		if (!isset($_SESSION["user_login"])) {
			session_start();
		}
		return $_SESSION["user_login"];
	}
}