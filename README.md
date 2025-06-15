電商藥粧網站專案
這是一個以 PHP 製作的簡易電商網站，主要功能包含會員註冊與登入、商品瀏覽、購物車、結帳、訂單查詢等。此專案為職訓課程結訓作品，用以練習網站後台開發及前端頁面設計。

📌 專案特色
🛒 完整購物車流程：加入商品、修改數量、刪除商品。

📦 結帳功能：可選擇收件人地址、付款方式（貨到付款、信用卡、轉帳、電子支付）。

🎫 折價券功能：可驗證折價券代碼並計算折扣。

🔐 會員系統：註冊、登入、修改資料。

📋 訂單查詢：可查詢歷史訂單並查看明細。

📱 響應式設計：Bootstrap 版型支援桌機與手機。

🗂 目錄結構
bash
複製
編輯
project01/
├── index.php                  # 首頁
├── login.php                   # 會員登入頁
├── register.php                # 會員註冊頁
├── checkout.php                # 結帳頁
├── cart.php                    # 購物車頁
├── orderlist.php               # 訂單查詢頁
├── product_list.php            # 商品列表頁
├── goods.php                   # 商品詳細頁
├── addcart.php                 # 加入購物車處理
├── addorder.php                # 建立訂單處理
├── check_coupon.php            # 折價券驗證
├── Connections/conn_db.php     # 資料庫連線設定
├── images/                     # 圖片資料夾
├── product_img/                # 商品圖片
├── uploads/                    # 上傳資料夾
├── style.css                   # 自訂樣式
├── jsfile.php                  # 共用 JS 匯入
└── README.md                   # 專案說明文件


首頁

商品列表

購物車

結帳頁

訂單查詢

⚙ 使用技術
前端：HTML / CSS / Bootstrap / jQuery

後端：PHP 7.x

資料庫：MySQL

伺服環境：XAMPP (本機測試環境)

🚀 如何執行
1️⃣ 安裝 XAMPP 或其他 PHP + MySQL 環境
2️⃣ 匯入資料庫 SQL 檔案（可提供或自行建立）
3️⃣ 將專案放到 htdocs 目錄下
4️⃣ 瀏覽器開啟 http://localhost/project01/index.php 開始使用

🙋 作者與說明
此專案為職訓中心課程成果作品，用於學習、履歷展示與求職用途，非正式商業網站。
GitHub 專案網址：https://github.com/shuhher0413/ecommerce-project
