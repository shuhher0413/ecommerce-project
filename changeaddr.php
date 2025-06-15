<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json;charset=utf-8');

require_once('Connections/conn_db.php');

(!isset($_SESSION)) ? session_start() : "";

if (isset($_SESSION['emailid']) && $_SESSION['emailid'] != "") {
    $emailid = $_SESSION['emailid'];
    $addressid = intval($_POST['addressid']); // 避免注入風險，轉型

    // 先取消該使用者的所有預設收件人
    $query = sprintf("UPDATE addbook SET setdefault = '0' WHERE emailid='%s' AND setdefault = '1';", $emailid);
    $link->query($query);

    // 再把選定的那筆設為預設
    $query = sprintf("UPDATE addbook SET setdefault = '1' WHERE addressid='%d' AND emailid='%s';", $addressid, $emailid);
    $result = $link->query($query);

    if ($result) {
        $retcode = array("c" => true, "m" => "收件人已經變更。");
    } else {
        $retcode = array("c" => false, "m" => "抱歉！資料無法寫入後台資料庫，請聯絡管理人員。");
    }

    echo json_encode($retcode, JSON_UNESCAPED_UNICODE);
}
return;

?>
