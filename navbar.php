  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="images/logo.jpg" alt="彰化鮮農" class="img-fluid"> <span class="brand-text">彰化鮮農</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php
      //讀取後台購物車內產品數量
      $SQLstring = "SELECT * FROM cart WHERE orderid is NULL AND ip='" . $_SERVER['REMOTE_ADDR'] . "'";
      $cart_rs = $link->query($SQLstring);
      ?>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="about.php">關於我們</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">農特產品</a>
          </li>
          <?php if (isset($_SESSION["login"])) { ?>
            <li class="nav-item"><a class="nav-link" href="javascript:void(0);" onclick="btn_confirmLink('確定登出？','logout.php')">會員登出</a></li>
          <?php  } else { ?>
            <li class="nav-item"><a class="nav-link" href="login.php">會員登入</a></li>
          <?php
          } ?>
          <li class="nav-item">
            <a class="nav-link" href="#">預約交易</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="orderlist.php">查訂單</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">折價卷</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              鮮農專區
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">認識彰化鮮農</a></li>
              <li><a class="dropdown-item" href="#">門市資訊</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">供應商報價服務</a></li>
              <li><a class="dropdown-item" href="#">加盟專區</a></li>
              <li><a class="dropdown-item" href="#">合作伙伴</a></li>
            </ul>

          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#search" aria-label="搜尋" title="搜尋">
              <i class="fas fa-search" aria-hidden="true"></i>
              <span class="visually-hidden">搜尋</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#share" aria-label="分享" title="分享">
              <i class="fas fa-share-alt" aria-hidden="true"></i>
              <span class="visually-hidden">分享</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#customer_service" aria-label="客服中心" title="客服中心">
              <i class="fas fa-headset" aria-hidden="true"></i>
              <span class="visually-hidden">客服中心</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php" aria-label="加入會員" title="加入會員">
              <i class="fas fa-user-plus" aria-hidden="true"></i>
              <span class="visually-hidden">加入會員</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php" aria-label="購物車" title="購物車">
              <i class="fas fa-shopping-cart" aria-hidden="true"><span class="badge text-bg-info"><?php echo $cart_rs->rowCount(); ?></span></i>
              <span class="visually-hidden">購物車</span>
            </a>
          </li>
          </li>
  <!-- 管理選單：只有管理員看到 -->
  <?php if (isset($_SESSION['admin_login'])) { ?>
  <li class="nav-item">
    <a class="nav-link" href="faq_admin.php">FAQ 管理</a>
  </li>
  <?php } ?>
        </ul>
       <?php if (isset($_SESSION["login"])) { ?>
            <ul class="navbar-nav ms-auto me-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="uploads/<?php echo ($_SESSION['imgname']!= '') ? $_SESSION['imgname'] : 'svatar.svg'; ?>" width="40" height="40" class="rounded-circle">
                    </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="orderlist.php">Order List</a>
                <a class="dropdown-item" href="profile.php">Edit Profile</a>
                <a class="dropdown-item" href="#" onclick="btn_confirmLink('請確定是否要登出？','logout.php')">Log Out</a>
              </div>
            </li>
          </ul>
        <?php } ?>
        <?php if (isset($_SESSION['admin_login'])) { ?>
<li class="nav-item">
  <a class="nav-link" href="faq_admin.php">FAQ 管理</a>
</li>
<li class="nav-item">
  <a class="nav-link" href="logout_admin.php">登出管理員</a>
</li>
<?php } else { ?>
<li class="nav-item">
  <a class="nav-link" href="login_admin.php">管理員登入</a>
</li>
<?php } ?>

      </div>
    </div>
  </nav>