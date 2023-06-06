<?
    if (!isset($_SESSION)) session_start();
    if (!isset($_SESSION['area_id'])) {
        echo '<script>alert("로그인 후 이용하실 수 있습니다."); location.href="/.php";</script>';
        if (!isset($_SESSION['isadmin'])) {
            echo '<script>alert("이용 권한이 없습니다."); location.href="/.php";</script>';
        }
    }

    $GLOBALS['ret_type'] = basename(__FILE__) == basename($_SERVER["SCRIPT_NAME"]) ? 'ajax' : '';
    include_once $_SERVER['DOCUMENT_ROOT'].'/lib/db_function.php';

    

    $req = @$_POST['req'] ?? '';

    function SQL_recent_give_items() {
        return libQuery("
            SELECT idname, itemname, COUNT(*) AS cnt
            FROM rora_giveitem
            WHERE give_id = ?
            GROUP BY idname
            ORDER BY cnt DESC
            LIMIT 10
        ", 'i', array($_SESSION['user_id']));
    }

    
    switch ($req) {
        case 'giveItem':
            $take_id = $_POST['take_id'];
            $itemname2 = $_POST['give_itemname2'] ?? '';
            if ($itemname2 == '') {
                $itemname = $_POST['give_itemname'];
            } else {
                $itemname = $itemname2;
            }
            $amount = $_POST['give_amount'];

            if ($amount > 0) {
                $nickname = SQL_getUserName($take_id);
                SQL_give_items($take_id, $itemname, $amount, '원격배송');
                libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "itemname"=>$itemname, "amount"=>$amount));
            } else {
                libReturn("개수를 확인해주세요.");
            }
            break;

        case 'givePoint':
            $take_id = $_POST['take_id'];
            $amount = $_POST['give_amount'];

            if ($amount > 0) {
                $give_id = $_SESSION['user_id'];
                $nickname = SQL_getUserName($take_id);
                SQL_pointLog($take_id, "포인트 지급", SQL_getUserName($give_id) . " [{$give_id}] 님으로부터 수령", $amount);
                SQL_setUserPoint($take_id, $amount);
                libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "itemname"=>"포인트", "amount"=>$amount));
            } else {
                libReturn("개수를 확인해주세요.");
            }
            break;

        case 'checkId':
            $take_id = $_POST['take_id'];
            $nickname = SQL_getUserName($take_id);
            libReturn("nickname", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;
    }
?>