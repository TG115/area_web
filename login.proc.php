<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';
	$GLOBALS['ret_type'] = basename(__FILE__) == basename($_SERVER["SCRIPT_NAME"]) ? 'ajax' : '';

	$id = $_POST['zeus_id'];
	$pw = $_POST['zeus_pw'];
	
	function SQL_CheckID($id, $pw) {
		return libQuery("
			SELECT *
			FROM zeus_account
			WHERE uid = ? AND upw = ? AND dflag = FALSE
		", 'ss', array($id, $pw));

	}

	function SQL_UpdateLastLogin($id) {
		return libQuery("
			UPDATE zeus_account
			SET last_login = NOW()
			WHERE uid = ? AND dflag = FALSE
		", 's', array($id));
	}

	$r = SQL_CheckID($id, $pw);
	if (count($r) == 1) {
		session_start();
		SQL_UpdateLastLogin($id);
		$_SESSION['zeus_id'] = $id;
		$_SESSION['zeus_nickname'] = $r[0]['nickname'];
		$_SESSION['user_id'] = $r[0]['user_id'];
		if ($_SESSION['user_id'] == 1 || $_SESSION['user_id'] == 17) $_SESSION['isadmin'] = true;
		header('location:/');
	} else {
		print "<script> alert('회원정보가 일치하지 않습니다.'); location.replace('login'); </script>";
	}

?>
