<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"));
$task = $data->task;

if ($task) {
    $stmt = $pdo->prepare("INSERT INTO tasks (task) VALUES (:task)");
    $stmt->bindParam(':task', $task);
    $stmt->execute();
    echo json_encode(['id' => $pdo->lastInsertId(), 'task' => $task]);
} else {
    echo json_encode(['error' => 'Invalid task']);
}
?>
