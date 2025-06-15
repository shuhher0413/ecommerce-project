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
         <section class="container my-5 return-policy">

  <h2 class="text-center mb-4">退換貨說明</h2>
  <p>親愛的顧客您好，為保障您的權益，請於收到商品後儘速檢查。若發現商品有損壞、瑕疵或與訂購不符，請於 <strong>7 天內</strong>（含假日）聯繫客服辦理退換貨。</p>
  
  <h4>退換貨條件</h4>
  <ul>
    <li>商品須保持完整包裝、未拆封、未使用。</li>
    <li>生鮮農產品除商品瑕疵外，無法接受因個人口感等因素退換貨。</li>
    <li>若因運送過程導致損壞，請拍照存證並儘速與我們聯繫。</li>
  </ul>

  <h4>退換貨流程</h4>
  <ol>
    <li>來電或來信客服，提供訂單號、姓名及退換貨原因。</li>
    <li>客服確認後會安排物流回收商品。</li>
    <li>收到退回商品後，將依您需求退款或換貨。</li>
  </ol>

  <h4>客服聯絡方式</h4>
  <p>
    📧 Email：support@example.com <br>
    ☎️ 電話：(02)1234-5678 <br>
    🕒 服務時間：週一至週五 09:00-18:00
  </p>
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