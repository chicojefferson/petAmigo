<?php
require_once 'database.php';

// Carregar animais disponíveis para adoção
$animais = [];
$adotantes = [];
$success = '';
$error = '';

try {
    // Carregar animais disponíveis
    $stmt = $pdo->query("
        SELECT a.Id, a.Nome, e.Nome as Especie, r.Nome as Raca 
        FROM animal a 
        LEFT JOIN especies e ON a.EspecieId = e.Id 
        LEFT JOIN racas r ON a.RacaId = r.Id 
        WHERE a.StatusAtualId IN (SELECT Id FROM statusanimal WHERE Codigo = 'disponivel')
        ORDER BY a.Nome
    ");
    $animais = $stmt->fetchAll();

    // Carregar adotantes
    $stmt = $pdo->query("
        SELECT ad.Id, p.NomeCompleto, p.Id as PessoaId
        FROM adotantes ad 
        INNER JOIN pessoa p ON ad.PessoaId = p.Id 
        ORDER BY p.NomeCompleto
    ");
    $adotantes = $stmt->fetchAll();
    
} catch (PDOException $e) {
    $error = "Erro ao carregar dados: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adotante_id = $_POST['adotante_id'] ?? '';
    $animal_id = $_POST['animal_id'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    
    try {
        $pdo->beginTransaction();
        
        // Inserir pedido de adoção
        $stmt = $pdo->prepare("
            INSERT INTO pedido_adocao (
                AdotanteId, AnimalId, DataSolicitacao, Status, Observacoes
            ) VALUES (?, ?, NOW(), 'pendente', ?)
        ");
        $stmt->execute([$adotante_id, $animal_id, $observacoes]);
        
        // Atualizar status do animal para "em processo"
        $stmt = $pdo->prepare("
            UPDATE animal 
            SET StatusAtualId = (SELECT Id FROM statusanimal WHERE Codigo = 'em_processo') 
            WHERE Id = ?
        ");
        $stmt->execute([$animal_id]);
        
        $pdo->commit();
        $success = "Pedido de adoção enviado com sucesso!";
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        $error = "Erro ao enviar pedido: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Adoção</title>
    <link rel="stylesheet" href="cadastrogeral.css">
</head>
<body>
    <header class="header">
        <section>
            <a href="../Home/home.html" class="logo">
                <img src="petlogo.png" alt="logo">
            </a>

            <nav class="navbar main-menu">
                <a href="\Projeto_Pet\Home\home.php">Home</a>
                <a href="\Projeto_Pet\Sobre\sobre.php">Sobre</a>
                <a href="\Projeto_Pet\Menu\menu.php">Menu</a>
                <a href="\Projeto_Pet\Avaliações\avaliacoes.php">Avaliações</a>
                <a href="address">Endereço</a>
            </nav>

            <nav class="navbar right-menu">
                <a href="cadastrogeral.php">Faça seu cadastro</a>
                <a href="\Projeto_Pet\Login\login.php">Login</a>
            </nav>

            <div class="icon">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/ffffff/search--v1.png" alt="search--v1" />
            </div>
        </section>
    </header>

    <div class="cadastro-container">
        <div class="cadastro-header">
            <h2>Pedido de Adoção</h2>
            <p>Solicite a adoção de um animal disponível</p>
        </div>

        <?php if ($success): ?>
            <div class="message success"><?= $success ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>

        <div class="form-section">
            <form method="POST" class="cadastro-form">
                <h4>Dados do Pedido</h4>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="adotante_id">Adotante *</label>
                        <select id="adotante_id" name="adotante_id" required>
                            <option value="">Selecione o adotante...</option>
                            <?php if (!empty($adotantes)): ?>
                                <?php foreach ($adotantes as $adotante): ?>
                                    <option value="<?= $adotante['Id'] ?>">
                                        <?= htmlspecialchars($adotante['NomeCompleto']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Nenhum adotante cadastrado</option>
                            <?php endif; ?>
                        </select>
                        <small style="color: #ccc; margin-top: 0.5rem; display: block;">
                            Não encontrou o adotante? <a href="cadastro-pessoa.php" style="color: #3498db;">Cadastre uma nova pessoa como adotante</a>
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label for="animal_id">Animal para Adoção *</label>
                        <select id="animal_id" name="animal_id" required>
                            <option value="">Selecione o animal...</option>
                            <?php if (!empty($animais)): ?>
                                <?php foreach ($animais as $animal): ?>
                                    <option value="<?= $animal['Id'] ?>">
                                        <?= htmlspecialchars($animal['Nome']) ?> 
                                        (<?= htmlspecialchars($animal['Especie']) ?><?= $animal['Raca'] ? ' - ' . htmlspecialchars($animal['Raca']) : '' ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Nenhum animal disponível para adoção</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    <textarea id="observacoes" name="observacoes" rows="4" placeholder="Informações adicionais sobre o pedido de adoção..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar Pedido</button>
                </div>
            </form>
        </div>

        <?php if (!empty($animais)): ?>
        <div class="form-section" style="margin-top: 2rem;">
            <h4>Animais Disponíveis para Adoção</h4>
            <div class="animais-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                <?php foreach ($animais as $animal): ?>
                    <div class="animal-card" style="background: #2a2a2a; padding: 1.5rem; border-radius: 10px; border: 1px solid #333;">
                        <h5 style="color: #3498db; margin-bottom: 0.5rem;"><?= htmlspecialchars($animal['Nome']) ?></h5>
                        <p style="color: #ccc; margin-bottom: 0.25rem;">
                            <strong>Espécie:</strong> <?= htmlspecialchars($animal['Especie']) ?>
                        </p>
                        <?php if ($animal['Raca']): ?>
                        <p style="color: #ccc; margin-bottom: 0.25rem;">
                            <strong>Raça:</strong> <?= htmlspecialchars($animal['Raca']) ?>
                        </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script src="cadastrogeral.js"></script>
</body>
</html>