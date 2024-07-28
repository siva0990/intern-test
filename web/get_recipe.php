<?php
// web/get_recipe.php
header('Content-Type: application/json');
require 'db.php';

$id = $_GET['id'];
try {
    $sql = 'SELECT * FROM recipes WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($recipe);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
