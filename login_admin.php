<?php
require_once("Connections/conn_db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $link->prepare("SELECT * FROM admin WHERE username=?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_login'] = true;
        $_SESSION['admin_name'] = $admin['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "帳號或密碼錯誤";
    }
}
?>
<!doctype html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <title>管理員登入</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>管理員登入</h2>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">帳號</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">密碼</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">登入</button>
    </form>
</body>
</html>
