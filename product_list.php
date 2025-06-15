<?php
// 建立product藥粧商品RS
$maxRows_rs = 12;   //分頁設定數量
$pageNum_rs = 0;    //起啟頁=0
if (isset($_GET['pageNum_rs'])) {
    $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;
if (isset($_GET['search_name'])) {
    //使用關鍵字查詢
    $queryFirst = sprintf("SELECT * FROM product,product_img, pyclass WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.classid=pyclass.classid AND product.p_name LIKE '%s' ORDER BY product.p_id DESC", '%' . $_GET['search_name'] . '%');
} elseif (isset($_GET['level']) && $_GET['level'] == 1) {
    //使用第一層類別查詢
    $queryFirst = sprintf("SELECT * FROM product,product_img,pyclass WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.classid=pyclass.classid AND pyclass.uplink='%d' ORDER BY product.p_id DESC", $_GET['classid']);
} elseif (isset($_GET['classid'])) {
    //使用產品類別查詢
    $queryFirst = sprintf("SELECT * FROM product,product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id AND product.classid='%d' ORDER BY product.p_id DESC", $_GET['classid']);
} else {
    //列出產品product資料查詢
    $queryFirst = sprintf("SELECT * FROM product,product_img WHERE p_open=1 AND product_img.sort=1 AND product.p_id=product_img.p_id ORDER BY product.p_id DESC", $maxRows_rs);
}

$query = sprintf("%s LIMIT %d,%d", $queryFirst, $startRow_rs, $maxRows_rs);
$pList01 = $link->query($query);
$i = 1; //控制每列row產生
?>
<?php if ($pList01->rowCount() != 0) { ?>
  <div class="row row-cols-1 row-cols-md-4 g-4">
    <?php while ($pList01_Rows = $pList01->fetch()) { ?>
      <div class="col">
        <div class="card h-100 d-flex flex-column">
          <a href="goods.php?p_id=<?= $pList01_Rows['p_id'] ?>">
            <img src="product_img/<?= $pList01_Rows['img_file'] ?>" class="card-img-top" alt="<?= $pList01_Rows['p_name'] ?>" title="<?= $pList01_Rows['p_name'] ?>">
          </a>
          <div class="card-body d-flex flex-column justify-content-between">
            <div>
              <h5 class="card-title"><?= $pList01_Rows['p_name'] ?></h5>
              <p class="card-text"><?= mb_substr($pList01_Rows['p_intro'], 0, 30, "utf-8") ?>...</p>
             <p class="color_e600a0 fw-bold">NT$<?= $pList01_Rows['p_price'] ?></p>


            </div>
            <div class="mt-auto">
              <a href="goods.php?p_id=<?= $pList01_Rows['p_id'] ?>" class="btn btn-primary btn-sm w-100 mb-1">更多資訊</a>
              <button type="button" class="btn btn-success btn-sm w-100" onclick="addcart(<?= $pList01_Rows['p_id'] ?>)">加入購物車</button>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
<?php } else { ?>
  <div class="alert alert-danger" role="alert">抱歉，沒有相關產品。</div>
<?php } ?>
