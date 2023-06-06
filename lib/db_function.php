<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/lib/database.php';

    function myRank($exp){
		if ($exp < 500) {
			$rank = "I5";
		} elseif ($exp < 1500) {
			$rank = "I4";
		} elseif ($exp < 3000) {
			$rank = "I3";
		} elseif ($exp < 5000) {
			$rank = "I2";
		} elseif ($exp < 9000) {
			$rank = "I1";

		} elseif ($exp < 15000) {
			$rank = "B5";
		} elseif ($exp < 23000) {
			$rank = "B4";
		} elseif ($exp < 33000) {
			$rank = "B3";
		} elseif ($exp < 45000) {
			$rank = "B2";
		} elseif ($exp < 65000) {
			$rank = "B1";

		} elseif ($exp < 93000) {
			$rank = "S5";
		} elseif ($exp < 129000) {
			$rank = "S4";
		} elseif ($exp < 173000) {
			$rank = "S3";
		} elseif ($exp < 217000) {
			$rank = "S2";
		} elseif ($exp < 269000) {
			$rank = "S1";

		} elseif ($exp < 346000) {
			$rank = "G5";
		} elseif ($exp < 448000) {
			$rank = "G4";
		} elseif ($exp < 575000) {
			$rank = "G3";
		} elseif ($exp < 727000) {
			$rank = "G2";
		} elseif ($exp < 904000) {
			$rank = "G1";

		} elseif ($exp < 1151000) {
			$rank = "P5";
		} elseif ($exp < 1468000) {
			$rank = "P4";
		} elseif ($exp < 1925000) {
			$rank = "P3";
		} elseif ($exp < 2382000) {
			$rank = "P2";
		} elseif ($exp < 2909000) {
			$rank = "P1";

		} elseif ($exp < 3636000) {
			$rank = "D5";
		} elseif ($exp < 4563000) {
			$rank = "D4";
		} elseif ($exp < 5690000) {
			$rank = "D3";
		} elseif ($exp < 7017000) {
			$rank = "D2";
		} elseif ($exp < 8869000) {
			$rank = "D1";

		} elseif ($exp < 11046000) {
			$rank = "A5";
		} elseif ($exp < 13548000) {
			$rank = "A4";
		} elseif ($exp < 16375000) {
			$rank = "A3";
		} elseif ($exp < 19552000) {
			$rank = "A2";
		} elseif ($exp < 23244000) {
			$rank = "A1";

		} elseif ($exp < 27451000) {
			$rank = "V5";
		} elseif ($exp < 31658000) {
			$rank = "V4";
		} elseif ($exp < 36895000) {
			$rank = "V3";
		} elseif ($exp < 42647000) {
			$rank = "V2";
		} elseif ($exp < 49384000) {
			$rank = "V1";

		} elseif ($exp < 57621000) {
			$rank = "M10";
		} elseif ($exp < 67358000) {
			$rank = "M9";
		} elseif ($exp < 78595000) {
			$rank = "M8";
		} elseif ($exp < 91332000) {
			$rank = "M7";
		} elseif ($exp < 105569000) {
			$rank = "M6";
		} elseif ($exp < 121306000) {
			$rank = "M5";
		} elseif ($exp < 138543000) {
			$rank = "M4";
		} elseif ($exp < 157280000) {
			$rank = "M3";
		} elseif ($exp < 177517000) {
			$rank = "M2";
		} else {
			$rank = "M1";
		}
		return $rank;
	}

	function SQL_pointLog($user_id, $category, $text, $point) {
		$r = libQuery("
			SELECT point
			FROM zeus_account
			WHERE user_id = ?
		;", "i", array($user_id));

		$remain_point = $r[0]['point'] + $point;

		libQuery("
			INSERT INTO zeus_point_log
			VALUES (?, ?, ?, ?, ?, NOW())
		;", "issii", array($user_id, $category, $text, $point, $remain_point));
	}

	function SQL_setUserPoint($user_id, $point) {
		libQuery("
			UPDATE zeus_account
			SET point = point + ?
			WHERE user_id = ?
		;", 'ii', array($point, $user_id));
	}

	function SQL_getUserName($user_id) {
		$r = libQuery("
			SELECT nickname
			FROM zeus_account
			WHERE user_id = ?
		;", 'i', array($user_id));

		return $r[0]['nickname'] ?? '알 수 없음';
	}

	function SQL_Get_bbs_like($idx) {
		$r = libQuery("
			SELECT COUNT(*) AS cnt
			FROM zeus_bbs_likes
			WHERE idx = ?
		;", "i", array($idx));
	
		return $r[0]['cnt'];
	}

	function SQL_Get_bbs_comment($idx) {
		$r = libQuery("
			SELECT COUNT(*) AS cnt
			FROM zeus_bbs_comment
			WHERE idx = ? AND dflag=0
		;", "i", array($idx));
	
		return $r[0]['cnt'];
	}


	function isAdminId($user_id) {
		return (
			$user_id == 1 ||
			$user_id == 3 ||
			$user_id == 7 ||
			$user_id == 4 ||
			$user_id == 253 ||
			$user_id == 14 ||
			$user_id == 2322
		);
	}

?>