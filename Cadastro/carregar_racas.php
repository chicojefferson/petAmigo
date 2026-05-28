<?php
require_once 'database.php';

header('Content-Type: application/json');

if (isset($_GET['especie_id'])) {
    $especieId = $_GET['especie_id'];
    $racas = carregarRacas($pdo, $especieId);
    echo json_encode($racas);
} else {
    echo json_encode([]);
}
?>