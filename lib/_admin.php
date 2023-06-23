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
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
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
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $nickname = SQL_getUserName($take_id);
            libReturn("nickname", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;

        case 'kick':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $reason = $_POST['reason'];
            $nickname = SQL_getUserName($take_id);
            SQL_set_cron('킥', $take_id, $reason);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;

        case 'ban':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $reason = $_POST['reason'];
            $nickname = SQL_getUserName($take_id);
            SQL_set_cron('밴', $take_id, $reason);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;

        case 'unban':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $reason = $_POST['reason'];
            $nickname = SQL_getUserName($take_id);
            SQL_set_cron('밴해제', $take_id, $reason);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;

        case 'giveCar':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $carcode = $_POST['car_code'] ?: libReturn("차량 코드를 입력하세요.");
            $nickname = SQL_getUserName($take_id);

            if (count(SQL_getCarcode($take_id, $carcode))) libReturn("exist");
            SQL_set_cron('차량지급', $take_id, $carcode);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "carcode"=>$carcode));
            break;

        case 'getCars':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $nickname = SQL_getUserName($take_id);
            $carcode = SQL_getCarcode($take_id);
            libReturn("carcode", array("user_id"=>$take_id, "nickname"=>$nickname, "codes"=>$carcode));
            break;

        case 'removeCar':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $carcode = $_POST['car_code'] ?: libReturn("차량 코드를 선택하세요.");
            $nickname = SQL_getUserName($take_id);
            SQL_set_cron('차량삭제', $take_id, $carcode);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "carcode"=>$carcode));
            break;

        case 'giveGroup':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $groupcode = $_POST['group_code'] ?: libReturn("그룹 코드를 입력하세요.");
            $nickname = SQL_getUserName($take_id);

            if (isBlockGroup($groupcode)) libReturn("block");
            if (hasGroup($take_id, $groupcode)) libReturn("exist");
            SQL_set_cron('권한지급', $take_id, $groupcode);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "groupcode"=>$groupcode));
            break;

        case 'getGroups':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $nickname = SQL_getUserName($take_id);
            $groupcode = SQL_getGroupcode($take_id);
            libReturn("groupcode", array("user_id"=>$take_id, "nickname"=>$nickname, "codes"=>$groupcode));
            break;

        case 'removeGroup':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $groupcode = $_POST['group_code'] ?: libReturn("그룹 코드를 선택하세요.");
            $nickname = SQL_getUserName($take_id);

            if (isBlockGroup($groupcode)) libReturn("block");
            SQL_set_cron('권한삭제', $take_id, $groupcode);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "groupcode"=>$groupcode));
            break;

        case 'changeId':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $new_id = $_POST['new_id'] ?: libReturn("신규 고유번호를 입력하세요.");
            $nickname = SQL_getUserName($take_id);

            if (SQL_hasId($new_id)) libReturn("exist");
            SQL_setId($take_id, $new_id);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname, "new_id"=>$new_id));
            break;

        case 'getInfo':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $nickname = SQL_getUserName($take_id);

            $info = $info[0];
            libReturn("userInfo", array("user_id"=>$take_id, "nickname"=>$nickname, "car_no"=>$info['registration'], "tel_no"=>$info['phone']));
            break;

        case 'changeInfo':
            $take_id = $_POST['take_id'] ?: libReturn("고유번호를 입력하세요.");
            $info = SQL_getUserInfo($take_id);
            if (!count($info)) libReturn("존재하지 않는 고유번호입니다.");
            $car_no = $_POST['car_no'] ?: libReturn("차량번호를 입력하세요.");
            $tel_no = $_POST['tel_no'] ?: libReturn("전화(계좌)번호를 입력하세요.");
            $nickname = SQL_getUserName($take_id);

            $new_car = SQL_getCarNo($take_id, $car_no);
            if (count($new_car)) libReturn("existCar", ["user_id"=>$new_car[0]['user_id'], "nickname"=>SQL_getUserName($new_car[0]['user_id'])]);

            $new_tel = SQL_getTelNo($take_id, $tel_no);
            if (count($new_tel)) libReturn("existTel", ["user_id"=>$new_tel[0]['user_id'], "nickname"=>SQL_getUserName($new_tel[0]['user_id'])]);
            
            SQL_setUserInfo($take_id, $car_no, $tel_no);
            libReturn("success", array("user_id"=>$take_id, "nickname"=>$nickname));
            break;
    }
?>