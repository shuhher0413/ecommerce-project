    <!-- 將資料庫連線程式載入 -->
    <?php require_once("Connections/conn_db.php"); ?>
    <!-- 如果SESSION沒有啟動，則啟動SESSION功能，這是跨網頁變數存取 -->
    <?php (!isset($_SESSION)) ? session_start() : ""; ?>
    <!-- 載入共用PHP函數庫 -->
    <?php require_once("php_lib.php"); ?>
    <?php
    //建立強制使用者登入，才能結帳
    if (!isset($_SESSION['login'])) {
        $sPath = "login.php?sPath=checkout";
        header(sprintf("Location: %s", $sPath));
    }
    ?>
    <!doctype html>
    <html lang="zh-TW">

    <head>
        <!-- 引入網頁標頭 -->
        <?php include_once("headfile.php"); ?>
        <style type="text/css">
            .table td,
            .table th {
                padding: .75rem;
                vertical-align: top;
                border-bottom: none;
                border-top: 1px solid #dee2e6;
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
                        <?php include_once('checkout_content.php') ?>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section id="scontent">
            <!-- 服務說明 -->
            <?php include_once("scontent.php"); ?>
        </section>
        <section id="footer">
            <!-- 聯絡資訊 -->
            <?php include_once("footer.php"); ?>
        </section>
        <!-- 引入javescript檔 -->
        <?php include_once("jsfile.php"); ?>
        <!-- Modal收件人地址處理對話框 -->
        <?php
        // 取得所有收件人資料
        $SQLstring = sprintf("SELECT *, city.Name AS ctName, town.Name AS toName FROM addbook, city, town WHERE emailid='%d' AND addbook.myzip=town.Post AND town.AutoNo=city.AutoNo", $_SESSION['emailid']);
        $addbook_rs = $link->query($SQLstring);
        ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">收件人資訊</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="cname" id="cname" class="form-control" placeholder="收件人姓名">
                                </div>
                                <div class="col">
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="收件人電話">
                                </div>
                                <div class="col">
                                    <select name="myCity" id="myCity" class="form-control">
                                        <option value="">請選擇市區</option>
                                        <?php
                                        $city = "SELECT * FROM `city` where State=0";
                                        $city_rs = $link->query($city);
                                        while ($city_rows = $city_rs->fetch()) { ?>
                                            <option value="<?php echo $city_rows['AutoNo']; ?>">
                                                <?php echo $city_rows['Name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select><br>
                                </div>
                                <div class="col">
                                    <select name="myTown" id="myTown" class="form-control">
                                        <option value="">請選擇地區</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <input type="hidden" name="myZip" id="myZip" value="">
                                    <label for="address" id="add_label" name="add_label">郵遞區號：</label>
                                    <input type="text" name="address" id="address" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4 justify-content-center">
                                <div class="col-auto">
                                    <button type="button" class="btn btn-success" id="recipient" name="recipient">
                                        新增收件人
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">收件人姓名</th>
                                    <th scope="col">電話</th>
                                    <th scope="col">地址</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = $addbook_rs->fetch()) { ?>
                                    <tr>
                                        <th scope="row">
                                            <input type="radio" name="gridRadios"
                                                id="gridRadios[]" value="<?php echo $data['addressid']; ?>"
                                                <?php echo ($data['setdefault']) ? 'checked' : ''; ?>>
                                        </th>
                                        <td><?php echo $data['cname']; ?></td>
                                        <td><?php echo $data['mobile']; ?></td>
                                        <td><?php echo $data['myzip'] . $data['ctName'] . $data['toName'] . $data['address']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="loading" name="loading" style="display:none;position:fixed;width:100%;height:100%;top:0;left:0;background-color:rgba(255,255,255,.5);z-index:9999;"><i class="fas fa-spinner fa-spin fa-5x fa-fw" style="position:absolute;top:50%;left:50%;"></i></div>
        <script>
            let discountValue = 0;
        const initialSubtotal = <?= isset($ptotal) ? $ptotal : 0 ?>; // 從 PHP 獲取初始商品小計
        const shippingFee = 100; // 固定運費或從 PHP 獲取

 $(document).ready(function() {
    $('#applyCoupon').click(function(){
      let code = $('#couponCode').val().trim();
      if(code == ''){
        alert('請輸入折價券代碼');
        return;
      }
      $.ajax({
        url: 'check_coupon.php',
        type: 'post',
        dataType: 'json',
        data: { code: code },
        success: function(data){
          if(data.c == true){
            discountValue = parseFloat(data.discount);  // 確保是數字
            $('#discountInfo').text(`折價券已套用，折扣金額：${discountValue} 元`);
             $('#discountAmountCellText').text(`${discountValue}`); // 更新折扣顯示到正確的 span
            $('#discountRow').show(); // 顯示折扣行
             updateTotalDisplay(discountValue); // 新增：成功套用折扣後，更新總計
          }else{
            discountValue = 0; // 重置折扣
            alert(data.m);
            $('#discountInfo').text('');
             $('#discountAmountCellText').text('0'); // 重置折扣顯示到正確的 span
            $('#discountRow').hide(); // 隱藏折扣行
            updateTotalDisplay(0); // 如果券無效，用0折扣更新總計
          }
        },
        error: function(){
          discountValue = 0; // 重置折扣
          alert('系統異常，請稍後再試');
          $('#discountInfo').text('');
          updateTotalDisplay(0);
           $('#discountAmountCellText').text('0'); // 確保錯誤時也更新到正確的 span
          $('#discountRow').hide()
        }
      });
    });

    function updateTotalDisplay(discount){
      let total = initialSubtotal + shippingFee - discount;
      $('#totalAmountCell').html(`總計: ${total.toFixed(0)}`); // toFixed(0) 顯示整數，或依需求調整
    }

   // 切換付款方式時，更新 howpay
    $('button[data-bs-toggle="tab"]').on('click', function () {
        const text = $(this).text();
        if (text.includes("貨到付款")) {
            $('#howpay').val(3);
        } else if (text.includes("信用卡")) {
            $('#howpay').val(4);
        } else if (text.includes("銀行轉帳")) {
            $('#howpay').val(5);
        } else if (text.includes("電子支付")) {
            $('#howpay').val(6);
        }
    });

    // 確認結帳按鈕
    $('#btn04').click(function () {
        let addressid = $('input[name="gridRadios"]:checked').val();
        let howpay = $('#howpay').val();
        let couponCodeVal = $('#couponCode').val().trim(); // 使用者輸入的 coupon code

        if (!addressid) {
            alert("請選擇收件人！");
            return;
        }

        $("#loading").show();

        $.ajax({
        url: 'addorder.php',
        type: 'POST',
        dataType: 'json',
        data: {
            addressid: addressid,
            howpay: howpay,
            coupon_code: couponCodeVal,    // 傳遞折價券代碼
            discount_amount: discountValue // 傳遞計算後的折扣金額
        },
        success: function (data) {
            $("#loading").hide();
            if (data.c == "1") {
                alert(data.m);
                window.location.href = "index.php";
            } else {
                alert("失敗：" + data.m);
            }
        },
        error: function () {
            $("#loading").hide();
            alert("系統異常，請稍後再試");
        }
    });
});
    // 收件人更換
    $('input[name="gridRadios"]').change(function () {
        var addressid = $(this).val();
        $.ajax({
        url: 'changeaddr.php',
        type: 'POST',
        dataType: 'json',
        data: { addressid: addressid },
        success: function (data) {
            if (data.c == true) {
                alert(data.m);
                window.location.reload();
            } else {
                alert("錯誤：" + data.m);
            }
        },
        error: function () {
            alert("系統錯誤");
        }
    });
    });

    // Modal 內新增收件人按鈕
    $('#recipient').click(function() {
        var validate = 0, msg = "";
        // 限定選擇器在 Modal 內，避免與頁面其他同名 ID 衝突
        var cname = $("#exampleModal #cname").val();
        var mobile = $("#exampleModal #mobile").val();
        var myZip = $("#exampleModal #myZip").val();
        var address = $("#exampleModal #address").val();

                    if (cname == "") {
                        msg = msg + "收件人不得為空白！\n";
                        validate = 1;
                    }
                    if (mobile == "") {
                        msg = msg + "電話不得為空白！\n";
                        validate = 1;
                    }
                    var checkphone = /^[0]{1}[9]{1}[0-9]{8}$/;
        if (mobile !== "" && !checkphone.test(mobile)) { // 僅在 mobile 非空時才驗證格式
                        msg = msg + "電話格式有誤！\n";
                        validate = 1;
                    }
                    if (myZip == "") {
                        msg = msg + "郵遞區號不得為空白！\n";
                        validate = 1;
                    }
                    if (address == "") {
                        msg = msg + "地址不得為空白！\n";
                        validate = 1;
                    }

                    if (validate) {
                        alert(msg);
                        return false;
                    }
                    $.ajax({
                        url: 'addbook.php',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            cname: cname,
                            mobile: mobile,
                            myZip: myZip,
                            address: address,
                        },
                        success: function(data) {
            if (data.c == true || data.c == "1") { // 後端回傳的 c 有時是 true 有時是 "1"
                                alert(data.m);
                                window.location.reload();
                            } else {
                                alert("Database response error:" + data.m);
                            }
                        },
                        error: function(data) {
                            alert("系統目前無法連接到後臺資料庫");
                        }
                    });

                });

    // Modal 內選擇城市
    $("#exampleModal #myCity").change(function() {
        var CNo = $(this).val();
        $("#exampleModal #myZip").val(""); // 清空 Modal 內的郵遞區號
        $("#exampleModal #add_label").html("郵遞區號:"); // 重置 Modal 內的郵遞區號標籤
                    if (CNo == "") {
            $("#exampleModal #myTown").html('<option value="">請選擇地區</option>'); // 清空地區下拉選單
                        return false;
                    }
                    $.ajax({
                        url: 'Town_ajax.php',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            CNo: CNo,
                        },
                        success: function(data) {
                            console.log("收到資料：", data);
                            if (data.c == true) {
                $("#exampleModal #myTown").html(data.m); // 更新 Modal 內的地區下拉選單
                            } else {
                                alert("Database response error: " + data.m);
                $("#exampleModal #myTown").html('<option value="">請選擇地區</option>');
                            }
                        },
                        error: function(data) {
                            alert("系統目前無法連接到後台資料庫");
            $("#exampleModal #myTown").html('<option value="">請選擇地區</option>');
                        }
                    });
                });

    // Modal 內選擇地區
    $("#exampleModal #myTown").change(function() {
        var AutoNo = $(this).val();
                if (AutoNo == "") {
        $("#exampleModal #myZip").val(""); // 清空 Modal 內的郵遞區號
        $("#exampleModal #add_label").html("郵遞區號:"); // 重置 Modal 內的郵遞區號標籤
                    return false;
                }
                $.ajax({
                    url: 'Zip_ajax.php',
                    type: 'get',
                    dataType: 'json',
        data: { AutoNo: AutoNo },
                    success: function(data) {
                        if (data.c == true) {
            $("#exampleModal #myZip").val(data.Post); // 設定 Modal 內的郵遞區號
            $("#exampleModal #add_label").html('郵遞區號: ' + data.Post + ' ' + data.Cityname + data.Name); // 更新 Modal 內的郵遞區號標籤
                        } else {
                            alert("Database response error: " + data.m);
            $("#exampleModal #myZip").val("");
            $("#exampleModal #add_label").html("郵遞區號:");
                        }
                    },
                    error: function(data) {
                        alert("系統目前無法連接到後台資料庫");
            $("#exampleModal #myZip").val("");
            $("#exampleModal #add_label").html("郵遞區號:");
                    }
                });
            });
 }); // End of $(document).ready()
        </script>
    </body>

    </html>