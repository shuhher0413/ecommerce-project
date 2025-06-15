<?php
header('Content-Type: application/json; charset=utf-8');
require_once('Connections/conn_db.php');
$code = trim($_POST['code']);
$sql = "SELECT * FROM discount WHERE code = ? AND is_valid = 1";
$stmt = $link->prepare($sql);
$stmt->execute([$code]);
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch();
    echo json_encode(["c" => true, "discount" => $row['discount_value']]);
} else {
    echo json_encode(["c" => false, "m" => "折價券無效或已使用"]);
}
?>
