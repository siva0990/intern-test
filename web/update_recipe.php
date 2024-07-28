<?php

header('Content-Type: application/json');
require 'db.php';

$id = $_GET['id'];
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['name']) || !isset($data['prep_time']) || !isset($data['difficulty']) || !isset($data['vegetarian'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit();
}


$vegetarian = filter_var($data['vegetarian'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

if (is_null($vegetarian)) {
    echo json_encode(['error' => 'Invalid boolean value for vegetarian']);
    exit();
}

try {
    $sql = 'UPDATE recipes SET name = :name, prep_time = :prep_time, difficulty = :difficulty, vegetarian = :vegetarian WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $data['name'],
        'prep_time' => $data['prep_time'],
        'difficulty' => $data['difficulty'],
        'vegetarian' => $vegetarian ? 'true' : 'false',
        'id' => $id
    ]);

    echo json_encode(['status' => 'Recipe updated']);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
