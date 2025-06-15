    <!-- 將資料庫連線程式載入 -->
    <?php require_once("Connections/conn_db.php"); ?>
    <!-- 如果SESSION沒有啟動，則啟動SESSION功能，這是跨網頁變數存取 -->
    <?php (!isset($_SESSION)) ? session_start() : ""; ?>
    <!-- 載入共用PHP函數庫 -->
    <?php require_once("php_lib.php"); ?>
    <?php 
    //取得要返回的php頁面
    if(isset($_GET["sPath"])){
        $sPath=$_GET['sPath'] . ".php";
    } else{
        //登入完成預設要進入首頁
        $sPath="index.php";
    }
    //檢查是否完成登入驗證
    if(isset($_SESSION['login'])){
        header(sprintf("location: %s", $sPath));
       //php 5.2.6舊版採用下列方式
       //echo "<>window.location.href=''" .$sPath . "';</script>";
        }
    ?>
    <!doctype html>
    <html lang="zh-TW">

    <head>
        <!-- 引入網頁標頭 -->
        <?php include_once("headfile.php"); ?>
      
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
                        <!-- 引入登入模組 -->
                   <?php require_once("login_content.php"); ?>
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
        <script type="text/javascript" src="commlib.js"></script>
        <script type="text/javascript">
            $(function(){
                $("#form1").submit(function(){
                    const inputAccount = $("#inputAccount").val();
                    const inputPassword = MD5($("#inputPassword").val());
                    $("#loading").show();
                    //利用$ajax函數呼叫後台的auth_user.php驗證帳號密碼
                    $.ajax({
                        url: "auth_user.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            inputAccount: inputAccount,
                            inputPassword: inputPassword
                        },
                        success: function(data){
                            if(data.c ==true){
                                alert(data.m);
                                //window.location.reload();
                                window.location.href = "<?php echo $sPath;?>";
                            } else{
                                alert(data.m);
                                                           }
                            },
                            error:function(data){
                                alert("系統目前無法連接到後台資料庫");
                            }
            });
        });
    });
        </script>

         <div id="loading" name="loading" style="display:none;position:fixed;width:100%;height:100%;top:0;left:0;background-color:rgba(255,255,255,.5);z-index:9999;"><i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position:absolute;top:50%;left:50%;"></i></div>
    </body>
    <?php


    ?>

    </html>