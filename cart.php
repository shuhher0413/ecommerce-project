    <!-- 將資料庫連線程式載入 -->
    <?php require_once("Connections/conn_db.php"); ?>
    <!-- 如果SESSION沒有啟動，則啟動SESSION功能，這是跨網頁變數存取 -->
    <?php (!isset($_SESSION)) ? session_start() : ""; ?>
    <!-- 載入共用PHP函數庫 -->
    <?php require_once("php_lib.php"); ?>
    <!doctype html>
    <html lang="zh-TW">

    <head>
        <!-- 引入網頁標頭 -->
        <?php include_once("headfile.php"); ?>
        <style type="text/css">
            /* 輸入有錯誤時，顯示紅框 */
            table input:invalid {
                border: solid red 3px;
            }
        </style>
    </head>

    <body>
        <section id="header">
            <!--引入導覽列-->
            <?php include_once("navbar.php"); ?>
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
                        <!--購物車模組-->
                        <?php include_once("cart_content.php"); 
                        ?>
       
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section id="scontent">
      
        </section>
        <section id="footer">
            <!-- 聯絡資訊 -->
            <?php include_once("footer.php"); ?>
        </section>
        <!-- 引入javescript檔 -->
        <?php include_once("jsfile.php"); ?>
        <script type="text/javascript">
                        $("input").change(function() {
                var qty = $(this).val();
                const cartid = $(this).attr("cartid");
                if (qty <= 0 || qty >= 50) {
                    alert("更改數量需大於0以上，以及小於50以下");
                    return false;
                }
                $.ajax({
                    url: 'change_qty.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        cartid: cartid,
                        qty: qty,
                    },
                    success: function(data) {
                        if (data.c == true) {
                            //alert(data.m);
                            window.location.reload();
                        } else {
                            alert(data.m);
                        }
                    },
                    error: function(data) {
                        alert("系統目前無法連接到後台資料庫");
                    }
                });
            });
        </script>
    </body>
    <?php


    ?>

    </html>