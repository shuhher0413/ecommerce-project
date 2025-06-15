 <!-- 將資料庫連線程式載入 -->
 <?php require_once("Connections/conn_db.php"); ?>
 <!-- 如果SESSION沒有啟動，則啟動SESSION功能，這是跨網頁變數存取 -->
 <?php (!isset($_SESSION)) ? session_start() : ""; ?>
 <?php require_once("php_lib.php"); ?>
 <!doctype html>
 <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <section id="content" class="container my-5 p-4 bg-light rounded shadow-sm">
           <div class="p-3 mb-4 text-white bg-primary text-center rounded">
  <h1>常見問題 FAQ</h1>
</div>
    <div class="accordion" id="faqAccordion">
        <?php
        $SQL = "SELECT * FROM faq WHERE status=1 ORDER BY id ASC";
        $rs = $link->query($SQL);
        $i = 0;
        while($row = $rs->fetch()) {
            $i++;
        ?>
        <?= '<i class="fas fa-question-circle text-primary me-2"></i>' . htmlspecialchars($row['question']) ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading<?= $i ?>">
                <button class="accordion-button <?= $i>1 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="<?= $i==1 ? 'true' : 'false' ?>" aria-controls="collapse<?= $i ?>">
                    <?= htmlspecialchars($row['question']) ?>
                </button>
            </h2>
            <div id="collapse<?= $i ?>" class="accordion-collapse collapse <?= $i==1 ? 'show' : '' ?>" aria-labelledby="heading<?= $i ?>" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <?= nl2br(htmlspecialchars($row['answer'])) ?>
                </div>
            </div>
        </div>
        <?php } ?>
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