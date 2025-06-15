<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>收支表</title>
</head>
<body>
    <h1>收支紀錄</h1>
    <a href="form.html">新增紀錄</a><br><br>
    <table border="1" cellpadding="8">
        <tr>
            <th>類型</th>
            <th>金額</th>
            <th>備註</th>
            <th>日期</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM records ORDER BY created_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['type']}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['note']}</td>
                    <td>{$row['created_at']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
