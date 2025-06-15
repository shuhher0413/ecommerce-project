<?php
require_once("Connections/conn_db.php");
session_start();

// 新增或更新 FAQ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['faq_id'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    if ($id == 0) {
        $stmt = $link->prepare("INSERT INTO faq (question, answer, status) VALUES (?, ?, 1)");
        $stmt->execute([$question, $answer]);
        $msg = "FAQ 已新增！";
    } else {
        $stmt = $link->prepare("UPDATE faq SET question=?, answer=? WHERE id=?");
        $stmt->execute([$question, $answer, $id]);
        $msg = "FAQ 已更新！";
    }
    header("Location: faq_admin.php?msg=" . urlencode($msg));
    exit;
}

// 停用 FAQ
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $stmt = $link->prepare("UPDATE faq SET status=0 WHERE id=?");
    $stmt->execute([$id]);
    header("Location: faq_admin.php?msg=" . urlencode("已停用！"));
    exit;
}

// 啟用 FAQ
if (isset($_GET['enable'])) {
    $id = intval($_GET['enable']);
    $stmt = $link->prepare("UPDATE faq SET status=1 WHERE id=?");
    $stmt->execute([$id]);
    header("Location: faq_admin.php?msg=" . urlencode("已啟用！"));
    exit;
}

// 讀取所有 FAQ
$rs = $link->query("SELECT * FROM faq ORDER BY id DESC");
?>

<!doctype html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <title>FAQ 管理</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>FAQ 管理</h2>
    <?php if (isset($_GET['msg'])) echo "<div class='alert alert-info'>" . htmlspecialchars($_GET['msg']) . "</div>"; ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#faqModal" onclick="fillForm(0, '', '')">新增 FAQ</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>問題</th>
                <th>狀態</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $rs->fetch()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['question']) ?></td>
                <td>
                    <?= $row['status'] ? "<span class='badge bg-success'>啟用</span>" : "<span class='badge bg-secondary'>停用</span>" ?>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#faqModal"
                            onclick="fillForm(<?= $row['id'] ?>, `<?= htmlspecialchars(addslashes($row['question'])) ?>`, `<?= htmlspecialchars(addslashes($row['answer'])) ?>`)">編輯</button>
                    <?php if ($row['status']) { ?>
                        <a href="?del=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定停用？')">停用</a>
                    <?php } else { ?>
                        <a href="?enable=<?= $row['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('確定啟用？')">啟用</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="faqModalLabel">FAQ 編輯</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="faq_id" id="faq_id" value="0">
                    <div class="mb-3">
                        <label for="question" class="form-label">問題</label>
                        <input type="text" class="form-control" id="question" name="question" required>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">答案</label>
                        <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">儲存</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </form>
        </div>
    </div>

<script>
function fillForm(id, question, answer) {
    document.getElementById('faq_id').value = id;
    document.getElementById('question').value = question;
    document.getElementById('answer').value = answer;
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
