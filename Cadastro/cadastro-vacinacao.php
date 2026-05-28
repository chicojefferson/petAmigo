<?php
require_once 'database.php';

// Carregar animais e vacinas
$animais = [];
$vacinas = carregarVacinas($pdo);
$success = '';
$error = '';

try {
    // Carregar todos os animais
    $stmt = $pdo->query("
        SELECT a.Id, a.Nome, e.Nome as Especie 
        FROM animal a 
        LEFT JOIN especies e ON a.EspecieId = e.Id 
        ORDER BY a.Nome
    ");
    $animais = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Erro ao carregar animais: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_id = $_POST['animal_id'] ?? '';
    $vacina_id = $_POST['vacina_id'] ?? '';
    $data_aplicacao = $_POST['data_aplicacao'] ?? '';
    $proxima_dose = $_POST['proxima_dose'] ?? '';
    $lote = $_POST['lote'] ?? '';
    $clinica = $_POST['clinica'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO vacina_para_animal (
                AnimalId, VacinaId, DataAplicacao, ProximaDose, Lote, Clinica, Observacoes
            ) VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$animal_id, $vacina_id, $data_aplicacao, $proxima_dose, $lote, $clinica, $observacoes]);
        
        $success = "Registro de vacinação salvo com sucesso!";
        
    } catch (PDOException $e) {
        $error = "Erro ao salvar vacinação: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Vacinação</title>
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
            <h2>Registro de Vacinação</h2>
            <p>Registre as vacinas aplicadas nos animais</p>
        </div>

        <?php if ($success): ?>
            <div class="message success"><?= $success ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>

        <div class="form-section">
            <form method="POST" class="cadastro-form">
                <h4>Dados da Vacinação</h4>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="animal_id">Animal *</label>
                        <select id="animal_id" name="animal_id" required>
                            <option value="">Selecione o animal...</option>
                            <?php if (!empty($animais)): ?>
                                <?php foreach ($animais as $animal): ?>
                                    <option value="<?= $animal['Id'] ?>">
                                        <?= htmlspecialchars($animal['Nome']) ?> 
                                        (<?= htmlspecialchars($animal['Especie']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Nenhum animal cadastrado</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="vacina_id">Vacina *</label>
                        <select id="vacina_id" name="vacina_id" required>
                            <option value="">Selecione a vacina...</option>
                            <?php if (!empty($vacinas)): ?>
                                <?php foreach ($vacinas as $vacina): ?>
                                    <option value="<?= $vacina['Id'] ?>">
                                        <?= htmlspecialchars($vacina['Nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Nenhuma vacina cadastrada</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="data_aplicacao">Data de Aplicação *</label>
                        <input type="date" id="data_aplicacao" name="data_aplicacao" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="proxima_dose">Próxima Dose</label>
                        <input type="date" id="proxima_dose" name="proxima_dose">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="lote">Lote</label>
                        <input type="text" id="lote" name="lote" placeholder="Número do lote da vacina">
                    </div>
                    
                    <div class="form-group">
                        <label for="clinica">Clínica/Veterinário</label>
                        <input type="text" id="clinica" name="clinica" placeholder="Nome da clínica ou veterinário">
                    </div>
                </div>

                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    <textarea id="observacoes" name="observacoes" rows="4" placeholder="Observações sobre a vacinação..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Vacinação</button>
                </div>
            </form>
        </div>
    </div>

    <script src="cadastrogeral.js"></script>
</body>
</html>