<?php

header('Content-Type: application/json');
require 'db.php';

$id = $_GET['id'];

try {
    $sql = 'DELETE FROM recipes WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    echo json_encode(['status' => 'Recipe deleted']);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
