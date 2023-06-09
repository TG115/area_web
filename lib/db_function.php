<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

	$blacklist_group = ["superadmin", "subadmin", "rpadmin", "레벨"];

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

	function SQL_getGroupcode($user_id) {
		return array_keys(json_decode(libQuery("
			SELECT dvalue
			FROM vrp_user_data
			WHERE user_id = ? AND dkey = 'vRP:datatable'
		", 'i', [$user_id])[0]['dvalue'], true)['groups']);
	}

	function SQL_hasId($user_id) {
		return libQuery("
			SELECT COUNT(*) AS cnt
			FROM vrp_users
			WHERE id = ?
		", 'i', [$user_id])[0]['cnt'];
	}

	function SQL_setId($user_id, $new_id) {
		libQuery("UPDATE vrp_users SET id=? WHERE id=?", 'ii', [$new_id, $user_id]);
		libQuery("UPDATE vrp_user_data SET user_id=? WHERE user_id=?", 'ii', [$new_id, $user_id]);
		libQuery("UPDATE vrp_user_identities SET user_id=? WHERE user_id=?", 'ii', [$new_id, $user_id]);
		libQuery("UPDATE vrp_user_ids SET user_id=? WHERE user_id=?", 'ii', [$new_id, $user_id]);
		libQuery("UPDATE vrp_user_moneys SET user_id=? WHERE user_id=?", 'ii', [$new_id, $user_id]);
		libQuery("UPDATE vrp_user_vehicles SET user_id=? WHERE user_id=?", 'ii', [$new_id, $user_id]);
		libQuery("UPDATE vrp_warning SET user_id=? WHERE user_id=?", 'ii', [$new_id, $user_id]);
		libQuery("UPDATE vrp_dailycheck SET user_id=? WHERE user_id=?", 'ii', [$new_id, $user_id]);
		libQuery("UPDATE vrp_ptime SET user_id=? WHERE user_id=?", 'ii', [$new_id, $user_id]);
	}

	function SQL_getCarNo($user_id, $car_no) {
		return libQuery("
			SELECT user_id
			FROM vrp_user_identities
			WHERE user_id <> ? AND registration = ?
		", 'is', [$user_id, $car_no]);
	}

	function SQL_getTelNo($user_id, $tel_no) {
		return libQuery("
			SELECT user_id
			FROM vrp_user_identities
			WHERE user_id <> ? AND phone = ?
		", 'is', [$user_id, $tel_no]);
	}

	function SQL_getUserInfo($user_id) {
		return libQuery("
			SELECT registration, phone
			FROM vrp_user_identities
			WHERE user_id = ?
		", 'i', [$user_id]);
	}

	function SQL_setUserInfo($user_id, $car_no, $tel_no) {
		libQuery("
			UPDATE vrp_user_identities
			SET registration = ?, phone = ?
			WHERE user_id = ?
		", 'ssi', [$car_no, $tel_no, $user_id]);
	}

	function hasGroup($user_id, $group) {
		return in_array($group, SQL_getGroupcode($user_id));
	}

	function isBlockGroup($group) {
		global $blacklist_group;
		return in_array($group, $blacklist_group);
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