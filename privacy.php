 <!-- 將資料庫連線程式載入 -->
 <?php require_once("Connections/conn_db.php"); ?>
 <!-- 如果SESSION沒有啟動，則啟動SESSION功能，這是跨網頁變數存取 -->
 <?php (!isset($_SESSION)) ? session_start() : ""; ?>
 <?php require_once("php_lib.php"); ?>
 <!doctype html>
<html lang="zh-TW">

 <head>
   <!-- q引入網頁標頭 -->
   <?php require_once("headfile.php"); ?>
 </head>

 <body>
   <!-- 引入導覽列 -->
   <section id="header">
     <?php require_once("navbar.php"); ?>
   </section>
   <section id="content">
     <div class="container-fluid">
       <div class="row">
         <div class="col-md-2">
           <!--引入sidebar分類導覽-->
           <?php include_once("sidebar.php"); ?>
           <!--引入熱銷商品查詢-->
           <?php include_once("hot.php"); ?>
         </div>
         <div class="col-md-10">
           <section id="content1">
    <div class="container">
      <div class="privacy-policy">
        <h2>隱私權政策</h2>
        <p>我們重視您的隱私權，並致力於保護您的個人資料。以下為我們收集、使用及保護個人資料的相關政策。</p>

        <h4>1️⃣ 資料收集</h4>
        <p>為了提供更好的服務，我們會在您註冊、下訂單或使用服務時，收集必要的個人資料，如姓名、電話、Email、地址等。</p>

        <h4>2️⃣ 資料用途</h4>
        <p>我們僅用於：
          <ul>
            <li>訂單處理與客服聯繫</li>
            <li>會員管理與服務改善</li>
            <li>行銷通知（僅限經您同意後）</li>
          </ul>
        </p>

        <h4>3️⃣ 資料保護</h4>
        <p>我們採取合理的技術與管理措施，防止您的資料被未授權存取、竄改或外洩。</p>

        <h4>4️⃣ 資料查詢與修改</h4>
        <p>您可隨時登入會員中心查詢或修改您的個人資料。如需協助，請聯絡客服。</p>

        <h4>5️⃣ 聯絡我們</h4>
        <p>如有任何隱私權相關問題，歡迎聯絡我們：<br>
          📧 Email：support@example.com<br>
          ☎️ 電話：(02)1234-5678
        </p>
      </div>
    </div>
  </section>
         </div>
       </div>
     </div>
   </section>
   <section id="footer">
    <!-- 引入footer -->
   <?Php require_once("footer.php"); ?>
   </section>
<!-- 引入javascript檔 -->
   <?php require_once("jsfile.php"); ?>
 </body>

 </html>
 <?php

  ?>