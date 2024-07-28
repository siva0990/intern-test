<?php
// web/create_recipe.php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

// Log input data for debugging
file_put_contents('php://stderr', print_r($data, true));

// Check for required fields
if (!isset($data['name']) || !isset($data['prep_time']) || !isset($data['difficulty']) || !isset($data['vegetarian'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit();
}

// Validate and convert vegetarian field to boolean
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

// Log the processed data
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
