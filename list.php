<?php
require_once __DIR__ . '/config.php';
if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }

$res = $db->select('borrow_list', '*', ['ORDER' => ['id' => 'ASC']]);
?>
<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-white">
  <div class="container py-4">
    <h2>List</h2>
    <div class="mb-3">
      <a href="main.php" class="btn btn-secondary me-2">Main Menu</a>
      <a href="add.php" class="btn btn-success">Add New</a>
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ลำดับ</th>
          <th>ชื่อลูกค้า</th>
          <th>ชื่อหนังสือ</th>
          <th>วันที่ยืม</th>
          <th>วันที่คืน</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php $i = 1; if ($res): while ($row = $res->fetch_assoc()): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($row['customer_name']) ?></td>
          <td><?= htmlspecialchars($row['book_name']) ?> (x<?= $row['book_qty'] ?>)</td>
          <td><?= htmlspecialchars($row['borrow_date']) ?></td>
          <td><?= htmlspecialchars($row['return_date']) ?></td>
          <td>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger ms-2" onclick="return confirm('ยืนยันการลบข้อมูล?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
