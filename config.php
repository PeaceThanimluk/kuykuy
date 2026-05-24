<?php
require_once __DIR__ . '/medoo.php';
session_start();

$dbHost = getenv('DB_HOST') ?: '127.0.0.1';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: '';
$dbName = getenv('DB_NAME') ?: 'kuykuy_db';

$db = new Medoo($dbHost, $dbUser, $dbPass, $dbName);
