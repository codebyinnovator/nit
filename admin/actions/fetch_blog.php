<?php
require_once '../conn.php'; // your secure DB connection

$sql = "SELECT * FROM blogs ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
