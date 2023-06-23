<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	function SQL_give_items($take_id, $itemname, $amount, $option) {
		
        libQuery("
            INSERT INTO rora_giveitem (give_id, take_id, idname, amount, flag, send_date)
            VALUES (?, ?, ?, ?, ?, NOW())
        ;", "iisis", array($_SESSION['user_id'] ?? $take_id, $take_id, $itemname, $amount, $option));
    }

	function SQL_getUserName($user_id) {
		$r = libQuery("
			SELECT name
			FROM vrp_users
			WHERE id = '$user_id'
		;");

		$name = $r[0]['name'] ?? '알 수 없음';
		return trim(str_replace('?', '', $name));
	}

	function SQL_getCarcode($user_id, $code = '') {
		$where = $code ? "AND vehicle = '$code'" : '';
		return libQuery("
			SELECT vehicle
			FROM vrp_user_vehicles
			WHERE user_id = ? $where
		", 'i', [$user_id]);
	}

	function isAdminId($user_id) {
		$r = false;
		$row = libQuery("
			SELECT dvalue
			FROM vrp_user_data
			WHERE user_id = ? AND dkey = ?
		", 'is', array($user_id,'vRP:datatable'));

		if (isset($row[0])) {
			$dvalue = $row[0]['dvalue'];
			$data = json_decode($dvalue, true);
			$groups = $data['groups'];

			$adm = [
				'rorasujeong', 
				'namu1129',
				'superadmins',
				'normaladmins',
				'testadmins'
			];
			
			foreach($adm as $group) {
				if (array_key_exists($group, $groups)) {
					$r = true;
					break;
				}
			}
		}
    
    	return $r;
	}

    function SQL_set_cron($type, $user_id, $text) {
        libQuery("
            INSERT INTO rora_cron (type, give_id, take_id, text)
            VALUES (?, ?, ?, ?)
        ", 'siis', [$type, $_SESSION['user_id'], $user_id, $text]);
    }
?>