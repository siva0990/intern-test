<?php

header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);


file_put_contents('php://stderr', print_r($data, true));


if (!isset($data['name']) || !isset($data['prep_time']) || !isset($data['difficulty']) || !isset($data['vegetarian'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit();
}


if (is_bool($data['vegetarian'])) {
    $vegetarian = $data['vegetarian'];
} elseif ($data['vegetarian'] === 'true' || $data['vegetarian'] === 1 || $data['vegetarian'] === '1') {
    $vegetarian = true;
} elseif ($data['vegetarian'] === 'false' || $data['vegetarian'] === 0 || $data['vegetarian'] === '0') {
    $vegetarian = false;
} else {
    echo json_encode(['error' => 'Invalid vegetarian field value']);
    exit();
}

// 
$data['vegetarian'] = $vegetarian;
file_put_contents('php://stderr', print_r($data, true));

try {
    $sql = 'INSERT INTO recipes (name, prep_time, difficulty, vegetarian) VALUES (:name, :prep_time, :difficulty, :vegetarian)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $data['name'],
        'prep_time' => $data['prep_time'],
        'difficulty' => $data['difficulty'],
        'vegetarian' => $data['vegetarian']
    ]);

    echo json_encode(['status' => 'Recipe created']);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
