<?php
$host = 'localhost';
$dbname = 'bd_adocao_pet';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Funções auxiliares
function carregarEspecies($pdo) {
    $stmt = $pdo->query("SELECT * FROM especies ORDER BY Nome");
    return $stmt->fetchAll();
}

function carregarRacas($pdo, $especieId = null) {
    if ($especieId) {
        $stmt = $pdo->prepare("SELECT * FROM racas WHERE EspecieId = ? ORDER BY Nome");
        $stmt->execute([$especieId]);
    } else {
        $stmt = $pdo->query("SELECT * FROM racas ORDER BY Nome");
    }
    return $stmt->fetchAll();
}

function carregarSexos($pdo) {
    $stmt = $pdo->query("SELECT * FROM sexo ORDER BY Id");
    return $stmt->fetchAll();
}

function carregarTamanhos($pdo) {
    $stmt = $pdo->query("SELECT * FROM tamanho ORDER BY Id");
    return $stmt->fetchAll();
}

function carregarStatus($pdo) {
    $stmt = $pdo->query("SELECT * FROM statusanimal ORDER BY Id");
    return $stmt->fetchAll();
}

function carregarVacinas($pdo) {
    $stmt = $pdo->query("SELECT * FROM vacinas ORDER BY Nome");
    return $stmt->fetchAll();
}
?>