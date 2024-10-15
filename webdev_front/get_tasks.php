<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM tasks");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($tasks);
?>
