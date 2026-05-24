<?php
require_once __DIR__ . '/config.php';
if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }

$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer = $_POST['customer_name'] ?? '';
    $book = $_POST['book_name'] ?? '';
    $qty = intval($_POST['book_qty'] ?? 1);
    $borrow = $_POST['borrow_date'] ?? null;
    $return = $_POST['return_date'] ?? null;

    $data = [
        'customer_name' => $customer,
        'book_name' => $book,
        'book_qty' => $qty,
        'borrow_date' => $borrow,
        'return_date' => $return
    ];
    $insertId = $db->insert('borrow_list', $data);
    if ($insertId !== false) { $success = true; }
}
?>
<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h2>Add List</h2>
    <?php if ($success): ?>
      <div class="alert alert-success">✅ เพิ่มข้อมูลสำเร็จ</div>
    <?php endif; ?>
    <form method="post" onsubmit="return confirm('ยืนยันว่าจะเพิ่มใช่หรือไม่?')">
      <div class="mb-3">
        <label class="form-label">ชื่อลูกค้าที่ยืม</label>
        <input name="customer_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">ชื่อหนังสือที่ยืม</label>
        <input name="book_name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">จำนวน</label>
        <input name="book_qty" type="number" class="form-control" value="1" min="1">
      </div>
      <div class="mb-3">
        <label class="form-label">วันที่ยืม</label>
        <input name="borrow_date" type="date" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">วันที่ต้องคืน</label>
        <input name="return_date" type="date" class="form-control">
      </div>
      <button class="btn btn-primary">Submit</button>
      <a href="list.php" class="btn btn-secondary">Back</a>
      <a href="main.php" class="btn btn-outline-secondary">Back to Main Menu</a>
    </form>
  </div>
</body>
</html>
