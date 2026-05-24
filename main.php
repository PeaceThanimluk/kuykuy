<?php
require_once __DIR__ . '/config.php';
if (empty($_SESSION['user'])) {
    header('Location: login.php'); exit;
}
?>
<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Main Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="main-bg text-white">
  <div class="main-container">
    <h1 class="main-title">Main Menu</h1>
    <div class="main-buttons">
      <a href="add.php" class="btn">Add List</a>
      <a href="list.php" class="btn">List</a>
      <a href="logout.php" class="btn">Log out</a>
    </div>
  </div>
</body>
</html>
