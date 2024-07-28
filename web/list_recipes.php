<?php

header('Content-Type: application/json');
require 'db.php';

try {
    $sql = 'SELECT * FROM recipes';
    $stmt = $pdo->query($sql);

    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($recipes);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
