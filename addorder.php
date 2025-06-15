<?php
header('Content-Type: application/json;charset=utf-8');
require_once('Connections/conn_db.php');
if (!isset($_SESSION)) session_start();

if (isset($_SESSION['emailid'])) {
     $emailid = isset($_SESSION['emailid']) ? intval($_SESSION['emailid']) : 0; // 確保 emailid 是整數
      // 確保 addressid 和 howpay 是整數，並進行基本驗證
      $addressid = isset($_POST['addressid']) ? intval($_POST['addressid']) : 0;
      $howpay = isset($_POST['howpay']) ? intval($_POST['howpay']) : 0;

    if ($emailid === 0) {
        echo json_encode(["c" => "0", "m" => "錯誤：Session 中的 emailid 無效。"]);
        exit;
    }
    if ($addressid === 0) {
        echo json_encode(["c" => "0", "m" => "錯誤：未選擇有效的收件人地址。"]);
        exit;
    }
    if ($howpay === 0) { // 假設 0 不是一個有效的付款方式 ID
        echo json_encode(["c" => "0", "m" => "錯誤：未選擇有效的付款方式。"]);
        exit;
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $orderid = date('YmdHis') . rand(10000, 99999);
        $coupon_code = isset($_POST['coupon_code']) ? trim($_POST['coupon_code']) : null;
         if (empty($coupon_code)) { // 如果 coupon_code 是空字串，設為 null
          $coupon_code = null;
      }
    $discount_amount = isset($_POST['discount_amount']) ? floatval($_POST['discount_amount']) : 0.0;
    
    // 假設 uorder 資料表有 coupon_code 和 discount_applied 欄位
    // 如果沒有，你需要先 ALTER TABLE uorder ADD coupon_code VARCHAR(50) NULL, ADD discount_applied DECIMAL(10,2) DEFAULT 0.00;
    $sql = "INSERT INTO uorder (orderid, emailid, addressid, howpay, paystatus, status, coupon_code, discount_applied)
            VALUES (?, ?, ?, ?, 35, 7, ?, ?)"; // 將 '35', '7' 改為數字
    $stmt = $link->prepare($sql);

     if ($stmt) { // 檢查 prepare 是否成功
          if ($stmt->execute([$orderid, $emailid, $addressid, $howpay, $coupon_code, $discount_amount])) {
              // 使用預備語句更新購物車
              $update_cart_sql = "UPDATE cart SET orderid=?, emailid=?, status=? WHERE ip=? AND orderid IS NULL";
              $cart_stmt = $link->prepare($update_cart_sql);
              $cart_status = 8; // 假設購物車中已成立訂單的項目狀態為 8
  
              if ($cart_stmt && $cart_stmt->execute([$orderid, $emailid, $cart_status, $ip])) {
                  echo json_encode(["c" => "1", "m" => "謝謝您，訂單已成立！"]);
              } else {
                  $cart_error = $cart_stmt ? $cart_stmt->errorInfo()[2] : $link->errorInfo()[2];
                  error_log("訂單 $orderid 已建立，但購物車更新失敗: " . $cart_error);
                  echo json_encode(["c" => "1", "m" => "訂單已部分成立，但購物車狀態更新時發生問題，請聯繫客服。"]);
              }
          } else {
              // prepare 失敗
          $prepareErrorInfo = $link->errorInfo();
          error_log("Order SQL prepare failed: " . print_r($prepareErrorInfo, true));
          echo json_encode(["c" => "0", "m" => "訂單處理失敗(SQL準備錯誤)： " . $prepareErrorInfo[2]]);
          }
    } } else {
      echo json_encode(["c" => "0", "m" => "使用者未登入或 Session 資訊不足。"]);
      exit;
    }

?>
