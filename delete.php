<?php
require_once __DIR__ . '/config.php';
if (empty($_SESSION['user'])) { header('Location: login.php'); exit; }

$id = intval($_GET['id'] ?? 0);
if ($id > 0) {
    $db->delete('borrow_list', ['id' => $id]);
}
header('Location: list.php');
exit;
