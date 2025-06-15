# 電商購物網站專案

這是一個使用 **PHP + MySQL + Bootstrap** 架設的電商購物網站。

## 🌐 線上展示
- 網站網址：[https://www.mhmoney168.byethost6.com](https://www.mhmoney168.byethost6.com)

## 📦 功能總覽
- 使用者註冊、登入、登出
- 商品分類、列表、詳細瀏覽
- 加入購物車、變更數量、移除商品
- 收件人地址管理（新增/編輯/選擇）
- 結帳流程包含多種付款方式：
  - 貨到付款
  - 信用卡
  - 銀行轉帳
  - 電子支付（保留項目）
- 折價券套用機制
- FAQ（常見問題）文章後台維護
- 隱私權與退換貨說明頁面

## 🔧 安裝指南
1. 將專案資料夾上傳至 PHP + MySQL 環境（建議使用 XAMPP 或遠端主機）。
2. 使用 phpMyAdmin 匯入資料庫 SQL，包括 `users`、`product`、`cart`、`uorder`、`multiselect` 等表。
3. 修改 `Connections/conn_db.php` 中的資料庫連線資訊（host、dbname、user、password）。
4. 瀏覽首頁 `index.php`，即可體驗網站功能。

## 🗂 目錄結構（簡述）
project01/
├── about.php
├── addcart.php
├── checkout.php
├── Connections/
│ └── conn_db.php
├── product_img/
├── images/
├── jsfile.php、php_lib.php…
├── faq.php、faq_admin.php
├── return_policy.php、privacy.php
└── …其餘頁面與管理功能

## 🔍 畫面預覽
- 首頁輪播、商品分類、搜尋功能
- 購物車頁面、結帳頁面（付款方式選擇、地址 modal）
- FAQ 後台管理介面（可新增/修改/停用 FAQ）
- 會員中心：訂單查詢、訂單明細 view

## 💡 技術亮點
- 使用 Bootstrap 建立 RWD 反應式網頁
- 使用 PDO 與 MySQL 建立安全資料存取
- 購物車與訂單系統整合範本程式，並根據作業需求加以客製
- FAQ、折價券為後台可編輯的動態功能
- 可擴充：信用卡串接、電子支付 API 整合

---

📌 **專案狀態**  
目前功能完整，可操作網站所有流程，尚可強化：  
- 資安防護（CSRF、XSS）；  
- 完整付款串接；  
- 後台管理介面更完善。

---

## 🚀 使用建議
- 將這份 README 放到 GitHub 根目錄，並加上首頁網站截圖更吸睛
- 可以在履歷/LinkedIn 增加 demo 網站連結，讓面試官點擊體驗
- 有時間可以補上 Github Pages 或 Heroku 部署連結

