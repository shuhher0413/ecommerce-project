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
     <link rel="stylesheet" href="fancybox-2.1.7/source/jquery.fancybox.css">
 </head>

 <body>
     <!-- 引入導覽列 -->
     <section id="header">
         <?php require_once("navbar.php"); ?>
     </section>
     <section id="content1">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-2">
                     <!--引入sidebar分類導覽-->
                     <?php include_once("sidebar.php"); ?>
                     <!--引入熱銷商品查詢-->
                     <?php include_once("hot.php"); ?>
                 </div>
                 <div class="col-md-10">
                     <!--建立類別分項-->
                     <?php include_once("breadcrumb.php"); ?>

                     <!--產品詳細資訊-->
                     <?php include_once("goods_content.php"); 
                        ?>
                    
                     </div>
                 </div>
             </div>
         </div>
         </div>
     </section>
     </div>
     </section>
     <section id="footer">
         <!-- 引入footer -->
         <?Php require_once("footer.php"); ?>
     </section>
     <!-- 引入javascript檔 -->
     <?php require_once("jsfile.php"); ?>
     <script type="text/javascript" src="fancybox-2.1.7/source/jquery.fancybox.js"></script>
     <script type="text/javascript">
         $(function() {
             //定義在滑鼠滑過圖片檔名墳入主圖src中
             $(".card .row.mt-2 .col-md-4 a").mouseover(function() {
                 var imgsrc = $(this).children("img").attr("src");

                 $("#showGoods").attr({
                     "src": imgsrc
                 });
                 //將子圖片放到lightbox展示
                 $(".fancybox").fancybox();
             });
         })
     </script>

 </body>

 </html>
 <?php

    ?>
 <script type="text/javascript">

 </script>