<?php

header('Content-Type: application/json');
require 'db.php';

$id = $_GET['id'];
$data = json_decode(file_get_contents('php://input'), true);

try {
    $sql = 'INSERT INTO ratings (recipe_id, rating) VALUES (:recipe_id, :rating)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'recipe_id' => $id,
        'rating' => $data['rating']
    ]);

    echo json_encode(['status' => 'Rating added']);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
