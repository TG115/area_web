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

        case 'checkId':
            $take_id = $_POST['take_id'];
            $nickname = SQL_getUserName($take_id);
            libReturn("nickname", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;

        case 'kick':
            $take_id = $_POST['take_id'];
            $reason = $_POST['reason'];
            $nickname = SQL_getUserName($take_id);
            SQL_set_cron('킥', $take_id, $reason);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;

        case 'ban':
            $take_id = $_POST['take_id'];
            $reason = $_POST['reason'];
            $nickname = SQL_getUserName($take_id);
            SQL_set_cron('밴', $take_id, $reason);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;

        case 'unban':
            $take_id = $_POST['take_id'];
            $reason = $_POST['reason'];
            $nickname = SQL_getUserName($take_id);
            SQL_set_cron('밴해제', $take_id, $reason);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;

        case 'giveCar':
            $take_id = $_POST['take_id'];
            $carcode = $_POST['car_code'];
            $nickname = SQL_getUserName($take_id);

            if (count(SQL_getCarcode($take_id, $carcode))) libReturn("exist");
            SQL_set_cron('차량지급', $take_id, $carcode);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "carcode"=>$carcode));
            break;

        case 'getCars':
            $take_id = $_POST['take_id'];
            $nickname = SQL_getUserName($take_id);
            $carcode = SQL_getCarcode($take_id);
            libReturn("carcode", array("user_id"=>$take_id, "nickname"=>$nickname, "codes"=>$carcode));
            break;

        case 'removeCar':
            $take_id = $_POST['take_id'];
            $carcode = $_POST['car_code'];
            $nickname = SQL_getUserName($take_id);
            SQL_set_cron('차량삭제', $take_id, $carcode);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "carcode"=>$carcode));
            break;

        case 'giveGroup':
            $take_id = $_POST['take_id'];
            $groupcode = $_POST['group_code'];
            $nickname = SQL_getUserName($take_id);

            if (isBlockGroup($groupcode)) libReturn("block");
            if (hasGroup($take_id, $groupcode)) libReturn("exist");
            SQL_set_cron('권한지급', $take_id, $groupcode);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "groupcode"=>$groupcode));
            break;

        case 'getGroups':
            $take_id = $_POST['take_id'];
            $nickname = SQL_getUserName($take_id);
            $groupcode = SQL_getGroupcode($take_id);
            libReturn("groupcode", array("user_id"=>$take_id, "nickname"=>$nickname, "codes"=>$groupcode));
            break;

        case 'removeGroup':
            $take_id = $_POST['take_id'];
            $groupcode = $_POST['group_code'];
            $nickname = SQL_getUserName($take_id);

            if (isBlockGroup($groupcode)) libReturn("block");
            SQL_set_cron('권한삭제', $take_id, $groupcode);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "groupcode"=>$groupcode));
            break;
    }
?>