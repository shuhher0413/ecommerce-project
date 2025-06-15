<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
require_once("Connections/conn_db.php");

if (!isset($_GET['AutoNo']) || !is_numeric($_GET['AutoNo'])) {
    echo json_encode(["c" => false, "m" => "❌ 缺少或錯誤的地區代碼"]);
    exit;
}

$townNo = intval($_GET['AutoNo']);

$sql = "SELECT t.Post, t.Name AS TownName, c.Name AS CityName 
        FROM town t 
        JOIN city c ON t.AutoNo = c.AutoNo 
        WHERE t.townNo = ? LIMIT 1";

$stmt = $link->prepare($sql);
$stmt->execute([$townNo]);

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode([
        "c" => true,
        "Post" => $row['Post'],
        "Name" => $row['TownName'],
        "Cityname" => $row['CityName']
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["c" => false, "m" => "❌ 查無郵遞區號"]);
}
?>
