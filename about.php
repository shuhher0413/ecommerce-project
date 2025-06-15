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
                     <section class="about-banner text-white d-flex align-items-center justify-content-center">
  <h1>關於我們</h1>
</section>

<section class="about-content container py-5">
  <h2>🌱 我們的初心</h2>
  <p>我們是一群熱愛土地的青年，致力於將台灣在地小農的優質農產品送上您的餐桌。從田間到餐桌，每一項商品都來自友善耕作、安心來源。</p>

  <h2>🍎 我們的堅持</h2>
  <ul>
    <li>合作小農皆經過實地拜訪，確保農法友善與品質穩定。</li>
    <li>不使用農藥殘留高的產品，支持有機與自然農法。</li>
    <li>以公平價格回饋農民，讓農業永續發展。</li>
  </ul>

  <h2>📦 我們怎麼做</h2>
  <p>產品下單後，我們會立即通知農家新鮮採收，並由物流冷藏直送您手上，保持農產品最新鮮的風味與營養。</p>

  <h2>📞 聯絡我們</h2>
  <p>
    客服信箱：<a href="mailto:service@farmfresh.com">service@farmfresh.com</a><br>
    服務專線：(04)1234-5678<br>
    服務時間：週一至週五 09:00 ~ 17:00
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