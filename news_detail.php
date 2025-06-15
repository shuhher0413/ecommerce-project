<?php
// Get the news ID from the URL parameter
$news_id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Get ID, default to 0 if not set

// --- Simulate fetching news data based on ID ---
// In a real app, query your database here:
// $sql = "SELECT title, content, date FROM news WHERE id = ?";
// $stmt = $pdo->prepare($sql);
// $stmt->execute([$news_id]);
// $news_item = $stmt->fetch();

$news_title = "找不到消息";
$news_date = "";
$news_content = "<p>抱歉，您所請求的消息不存在或已被移除。</p>";

switch ($news_id) {
    case 1:
        $news_title = "彰農葡萄啤酒~買一送一(數量有限，送完為止)";
        $news_date = "2023-10-27";
        $news_content = "<p>為回饋廣大顧客支持，彰化鮮農特選在地優質巨峰葡萄釀造的【彰農葡萄啤酒】現正舉辦買一送一活動！</p>
                         <p>口感清爽，帶有淡淡葡萄香氣，是夏日消暑的最佳選擇。數量有限，送完即止，快來搶購！</p>
                         <img src='images/placeholder_news_1.jpg' alt='葡萄啤酒' class='img-fluid my-3'>"; // Example image
        break;
    case 2:
        $news_title = "歡慶雙十國慶，全館商品特價優惠中！";
        $news_date = "2023-10-09";
        $news_content = "<p>普天同慶！為慶祝中華民國雙十國慶，彰化鮮農全館農特產品、生鮮蔬果、精選禮盒等，全面特價優惠。</p>
                         <p>活動期間：即日起至 10 月 15 日止。把握機會，將彰化在地好滋味帶回家！</p>";
        break;
    case 3:
        $news_title = "中秋佳節禮盒預購開跑，早鳥享優惠！";
        $news_date = "2023-09-15";
        $news_content = "<p>月圓人團圓，中秋送好禮！彰化鮮農精心挑選多款中秋禮盒，包含頂級水果、特色農產、健康點心等。</p>
                         <p>即日起開放預購，9 月底前完成預購即可享有早鳥優惠價，送禮自用兩相宜。</p>";
        break;
    case 4:
        $news_title = "夏季水果盛產，產地直送新鮮到家";
        $news_date = "2023-08-01";
        $news_content = "<p>炎炎夏日，正是品嚐各式美味水果的好時機！彰化鮮農為您帶來當季盛產的芒果、荔枝、芭樂、火龍果等。</p>
                         <p>堅持產地新鮮直送，讓您在家就能輕鬆享用最新鮮、最甜美的夏日水果饗宴。</p>
                         <img src='images/placeholder_news_4.jpg' alt='夏季水果' class='img-fluid my-3'>"; // Example image
        break;
    // Add more cases for other news IDs
}
// --- End simulation ---

?>
<!doctype html>
<html lang="zh-TW">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($news_title); ?> - 彰化鮮農</title> {/* Dynamic Title */}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.1/css/all.css">
  <link rel="stylesheet" href="website_p01.css"> {/* Link your main CSS */}
  <style>
    /* --- Copy relevant styles from index2.php if needed --- */
    body{
        font-family: Arial,'Noto Serif TC' , sans-serif;
        padding-top: 70px; /* Adjust for fixed navbar */
        background-color: #f4f4f4; /* Light background for content page */
    }
    .brand-text {
        font-size: 2.5rem; color: #000000; padding: 0; margin-left: 10px; line-height: 1; vertical-align: middle;
    }
    #header .navbar-brand img { max-height: 40px; vertical-align: middle; }
    #footer { /* Basic footer styles */
      background-color: #f8f9fa; padding-top: 20px; padding-bottom: 0; width: 100%; box-sizing: border-box; margin-top: 40px;
    }
    #footer .container { max-width: 1140px; margin: auto; padding: 0 15px; }
    .footer-bottom { background-color: #e9ecef; padding: 10px 0; margin-top: 20px; width: 100%; }
    #footer a { color: #0d6efd; text-decoration: none; } #footer a:hover { text-decoration: underline; }
    #footer h5 { margin-bottom: 1rem; } #footer img { max-width: 100%; height: auto; }

    .news-content-area {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
  </style>
</head>

<body>
  {/* --- Include Header (Copy from index2.php or use PHP include) --- */}
  <section id="header">
     <nav class="navbar navbar-expand-lg fixed-top bg-light shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand" href="index2.php"> {/* Link back to home */}
            <img src="images/logo.jpg" alt="彰化鮮農" class="img-fluid">
            <span class="brand-text">彰化鮮農</span>
        </a>
        {/* You might want a simpler navbar for detail pages, or the full one */}
        {/* ... (Include navbar toggler and menu if needed) ... */}
      </div>
    </nav>
  </section>

  {/* --- Main News Content --- */}
  <section id="news-detail-content" class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="news-content-area">
            <h1 class="mb-3"><?php echo htmlspecialchars($news_title); ?></h1>
            <?php if ($news_date): ?>
              <p class="text-muted mb-4"><small>發布日期：<?php echo htmlspecialchars($news_date); ?></small></p>
            <?php endif; ?>

            <hr>

            <div class="news-body mt-4">
              <?php echo $news_content; // Output the HTML content ?>
            </div>

            <div class="mt-5">
                <a href="index2.php" class="btn btn-outline-secondary">&laquo; 返回最新消息</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {/* --- Include Footer (Copy from index2.php or use PHP include) --- */}
   <section id="footer">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-3 col-6 mb-3">
          <h5>關於彰化鮮農</h5>
          <ul class="list-unstyled">
            <li><a href="#">關於彰化鮮農</a></li>
            <li><a href="#">農特產品</a></li>
            <li><a href="#">會員中心</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-6 mb-3">
          <h5>幫助</h5>
          <ul class="list-unstyled">
            <li><a href="#">常見問題</a></li>
            <li><a href="#">隱私權政策</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-6 mb-3">
          <h5>聯繫我們</h5>
          <ul class="list-unstyled">
            <li><a href="#">會員註冊</a></li>
          </ul>
        </div>
        <div class="col-md-3 col-6 mb-3">
          <img src="images/qrcode_195382706_a8378306745dc2648ffed51128438f99.png" alt="QR Code" style="max-width: 80px; margin-bottom: 10px;"><br>
          <img src="images/images.jpg" alt="Another Image" style="max-width: 80px;">
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row footer-bottom">
        <div class="col-md-12 text-center">
          <h5 class="mb-0 small">Copyright © 保證責任彰化鮮農版權所有</h5>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
