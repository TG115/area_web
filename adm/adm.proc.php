<?
    if (!isset($_SESSION)) session_start();
    if (!isset($_SESSION['zeus_id'])) {
        echo '<script>alert("로그인 후 이용하실 수 있습니다."); location.href="/login";</script>';
        if ($_SESSION['user_id'] != 1) {
            echo '<script>alert("이용 권한이 없습니다."); location.href="/login";</script>';
        }
    }

    $GLOBALS['ret_type'] = basename(__FILE__) == basename($_SERVER["SCRIPT_NAME"]) ? 'ajax' : '';
    include_once $_SERVER['DOCUMENT_ROOT'].'/lib/db_function.php';

    $req = @$_POST['req'] ?? '';
    
    function getItemInfo($itemname) {
        
        switch($itemname) {
            case '후원 박스':
                $idname = "cashrb"; 
                $amount = 1;
                $mileage = 1000;
                break;
            case '후원 박스 세트': 
                $idname = "cashrb"; 
                $amount = 6;
                $mileage = 5000;
                break;
        }
        return array("idname"=>$idname, "amount"=>$amount, "mileage"=>$mileage);
    }

    function SQL_adm_give_items($user_id, $itemname, $amount) {
        if (strpos($itemname, "박스")) {
            $itemInfo = getItemInfo($itemname);
            libQuery("
                INSERT INTO zeus_giveitem (user_id, idname, itemname, amount, price, flag, wdate)
                VALUES (?, ?, ?, ?, ?, '퀵배송완료', NOW())
            ;", "issii", array($user_id, $itemInfo['idname'], $itemname, $amount * $itemInfo['amount'], 0));

            libQuery("
                INSERT INTO zeus_giveitem (user_id, idname, itemname, amount, price, flag, wdate)
                VALUES (?, ?, ?, ?, ?, '퀵배송완료', NOW())
            ;", "issii", array($user_id, "mileage", "마일리지", $amount * $itemInfo['mileage'], 0));
        } elseif ($itemname == "마일리지") {
            libQuery("
                INSERT INTO zeus_giveitem (user_id, idname, itemname, amount, price, flag, wdate)
                VALUES (?, ?, ?, ?, ?, '퀵배송완료', NOW())
            ;", "issii", array($user_id, "mileage", "마일리지", $amount, 0));
        } else {
            libQuery("
                INSERT INTO zeus_giveitem (user_id, idname, itemname, amount, price, flag, wdate)
                VALUES (?, ?, ?, ?, ?, '퀵배송완료', NOW())
            ;", "issii", array($user_id, $itemname, $itemname, $amount, 0));
        }
        
    }

    
    switch ($req) {
        case 'giveItem':
            $user_id = $_POST['give_id'];
            $itemname2 = $_POST['give_itemname2'] ?? '';
            if ($itemname2 == '') {
                $itemname = $_POST['give_itemname'];
            } else {
                $itemname = $itemname2;
            }
            $amount = $_POST['give_amount'];

            if ($amount > 0) {
                $nickname = SQL_getUserName($user_id);
                SQL_adm_give_items($user_id, $itemname, $amount);
                libReturn("success", array("user_id"=>$user_id, "nickname"=>$nickname, "itemname"=>$itemname, "amount"=>$amount));
            } else {
                libReturn("개수를 확인해주세요.");
            }
            break;

        case 'checkId':
            $user_id = $_POST['give_id'];
            $nickname = SQL_getUserName($user_id);
            libReturn("nickname", array("user_id"=>$user_id, "nickname"=>$nickname));
            break;
    }
?>