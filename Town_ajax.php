<?php
file_put_contents('debug.txt', print_r($_POST, true));

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
require_once('Connections/conn_db.php');

// 除錯用：可確認 POST 值是否正確
file_put_contents("log.txt", json_encode($_POST));

// 檢查 POST 傳來的城市代碼
if (!isset($_POST['CNo']) || !is_numeric($_POST['CNo'])) {
    echo json_encode([
        "c" => false,
        "m" => "❌ 沒有收到正確的 CNo"
    ]);
    exit;
}

$CNo = intval($_POST['CNo']); // 對應 city.AutoNo → town.AutoNo

// ✅ 查出所有符合這個城市的鄉鎮（town.AutoNo 是城市編號）
$sql = "SELECT * FROM town WHERE AutoNo = ? AND State = 0";
$stmt = $link->prepare($sql);
$stmt->execute([$CNo]);

$html = "<option value=''>請選擇地區</option>";
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $html .= "<option value='" . $row["townNo"] . "'>" . $row["Name"] . "</option>";
    }

    echo json_encode([
        "c" => true,
        "m" => $html
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        "c" => false,
        "m" => "❌ 找不到任何地區資料"
    ]);
}
?>
