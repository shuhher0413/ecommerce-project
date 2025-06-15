 <!-- 將資料庫連線程式載入 -->
 <?php require_once("Connections/conn_db.php"); ?>
 <!-- 如果SESSION沒有啟動，則啟動SESSION功能，這是跨網頁變數存取 -->
 <?php (!isset($_SESSION)) ? session_start() : ""; ?>
 <?php require_once("php_lib.php"); ?>
 <?php 
 //驗證是否帳號登入
 if(!isset($_SESSION['login'])){
    $sPath="login.php?sPath=orderlist";
    header(sprintf("Location: %s ",$sPath));
 }
 ?>
 <!doctype html>
 <html lang="zh-TW">

 <head>
     <!-- q引入網頁標頭 -->
     <?php require_once("headfile.php"); ?>
     <style type="text/css">
            .accordion-header a {
                text-decoration: none;
            }
        </style>
 </head>

 <body>
     <!-- 引入導覽列 -->
     <section id="header">
         <?php require_once("navbar.php"); ?>
     </section>
     <section id="latest-news-carousel-section" class="my-4">
         <!-- 引入最新消息 -->
         <?php require_once("news.php"); ?>
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
                     <!--引入訂單查詢-->
                     <?php include_once("order_content.php"); ?>
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