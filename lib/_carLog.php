<?
$GLOBALS['ret_type'] = basename(__FILE__) == basename($_SERVER["SCRIPT_NAME"]) ? 'ajax' : '';
include_once $_SERVER['DOCUMENT_ROOT'].'/lib/db_function.php';

function fAPI() {
	$page = (int)(@$_GET['page'] ?: 1);
	$user_id = (int)(@$_GET['user_id'] ?: 0);
	$where = '';
	if ($user_id) {
		$where = "AND (g.give_id = $user_id OR g.take_id = $user_id)";
	}
	$max_row = 20;
	$offset = ($page - 1) * $max_row;

	$r_cnt = libQuery("
		SELECT COUNT(*) AS cnt
		FROM rora_cron AS g
		WHERE g.type IN ('차량지급', '차량삭제') $where
	");

	if ($r_cnt[0]['cnt'] < 1) {
		echo "<script>alert('고유번호를 다시 확인해주세요.');</script>";
	}

	$r_list = libQuery("
		SELECT g.*, a.name AS give_nickname, b.name AS take_nickname
		FROM rora_cron AS g
        LEFT JOIN vrp_users AS a ON a.id = g.give_id
        LEFT JOIN vrp_users AS b ON b.id = g.take_id
		WHERE g.type IN ('차량지급', '차량삭제') $where
		ORDER BY wdate DESC
		LIMIT ?
		OFFSET ?
	", 'ii', array($max_row, $offset));

	$r_is_exist_next = $max_row * $page < $r_cnt[0]['cnt'];

	$page > 1 
		? $prev = $page-1 : $prev="";
	$r_is_exist_next
		? $next = $page+1 : $next="";


	

	return libReturn('log_list', array('max_row'=>$max_row, 'page'=>$page, 'tot_cnt'=>ceil($r_cnt[0]['cnt'] / $max_row), 'prev'=>$prev, 'next'=>$next, 'list'=>$r_list));

}
return fAPI();
?>