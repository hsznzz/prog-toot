<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Invalid ID']);
}
?>
