<?php
require_once 'database.php';

// Carregar dados para os selects
$especies = carregarEspecies($pdo);
$sexos = carregarSexos($pdo);
$tamanhos = carregarTamanhos($pdo);
$status = carregarStatus($pdo);

// Carregar doadores
$doadores = [];
$success = '';
$error = '';

try {
    $stmt = $pdo->query("
        SELECT d.Id, p.NomeCompleto 
        FROM doadores d 
        INNER JOIN pessoa p ON d.PessoaId = p.Id 
        ORDER BY p.NomeCompleto
    ");
    $doadores = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Erro ao carregar doadores: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $especie_id = $_POST['especie_id'] ?? '';
    $raca_id = $_POST['raca_id'] ?? '';
    $sexo_id = $_POST['sexo_id'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $idade_estimada = $_POST['idade_estimada_meses'] ?? '';
    $tamanho_id = $_POST['tamanho_id'] ?? '';
    $cor = $_POST['cor'] ?? '';
    $microchip = $_POST['microchip'] ?? '';
    $castrado = isset($_POST['castrado']) ? 1 : 0;
    $vacinado = isset($_POST['vacinado']) ? 1 : 0;
    $castracao_recomendada = isset($_POST['castracao_recomendada']) ? 1 : 0;
    $peso = $_POST['peso_kg'] ?? '';
    $data_entrada = $_POST['data_entrada'] ?? date('Y-m-d');
    $doador_id = $_POST['doador_id'] ?? '';
    $status_id = $_POST['status_id'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO animal (
                Nome, EspecieId, RacaId, SexoId, DataNascimento, IdadeEstimadaMeses,
                TamanhoId, Cor, Microchip, Castrado, Vacinado, CastracaoRecomendada,
                PesoKg, DataEntrada, DoadorId, StatusAtualId, Observacoes, CriadoEm
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $stmt->execute([
            $nome, $especie_id, $raca_id, $sexo_id, $data_nascimento, $idade_estimada,
            $tamanho_id, $cor, $microchip, $castrado, $vacinado, $castracao_recomendada,
            $peso, $data_entrada, $doador_id, $status_id, $observacoes
        ]);
        
        $success = "Animal cadastrado com sucesso!";
    } catch (PDOException $e) {
        $error = "Erro no cadastro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Animal</title>
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
            <h2>Cadastro de Animal</h2>
            <p>Preencha os dados do animal para adoção</p>
        </div>

        <?php if (isset($success)): ?>
            <div class="message success"><?= $success ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>

        <div class="form-section">
            <form method="POST" class="cadastro-form">
                <h4>Dados Básicos</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome do Animal *</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="especie_id">Espécie *</label>
                        <select id="especie_id" name="especie_id" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($especies as $especie): ?>
                                <option value="<?= $especie['Id'] ?>"><?= htmlspecialchars($especie['Nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="raca_id">Raça</label>
                        <select id="raca_id" name="raca_id">
                            <option value="">Selecione primeiro a espécie</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sexo_id">Sexo *</label>
                        <select id="sexo_id" name="sexo_id" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($sexos as $sexo): ?>
                                <option value="<?= $sexo['Id'] ?>"><?= htmlspecialchars($sexo['Descricao']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <h4>Características Físicas</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento">
                    </div>
                    <div class="form-group">
                        <label for="idade_estimada_meses">Idade Estimada (meses)</label>
                        <input type="number" id="idade_estimada_meses" name="idade_estimada_meses" min="0" max="360">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tamanho_id">Porte *</label>
                        <select id="tamanho_id" name="tamanho_id" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($tamanhos as $tamanho): ?>
                                <option value="<?= $tamanho['Id'] ?>"><?= htmlspecialchars($tamanho['Descricao']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cor">Cor</label>
                        <input type="text" id="cor" name="cor" placeholder="Ex: Preto, Branco, Caramelo...">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="peso_kg">Peso (kg)</label>
                        <input type="number" id="peso_kg" name="peso_kg" step="0.1" min="0" max="100">
                    </div>
                    <div class="form-group">
                        <label for="microchip">Microchip</label>
                        <input type="text" id="microchip" name="microchip">
                    </div>
                </div>

                <h4>Saúde</h4>
                <div class="form-row">
                    <div class="checkbox-group">
                        <input type="checkbox" id="castrado" name="castrado" value="1">
                        <label for="castrado">Castrado</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="vacinado" name="vacinado" value="1">
                        <label for="vacinado">Vacinado</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" id="castracao_recomendada" name="castracao_recomendada" value="1">
                        <label for="castracao_recomendada">Castração Recomendada</label>
                    </div>
                </div>

                <h4>Origem e Status</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="data_entrada">Data de Entrada *</label>
                        <input type="date" id="data_entrada" name="data_entrada" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="doador_id">Doador *</label>
                        <select id="doador_id" name="doador_id" required>
                            <option value="">Selecione o doador...</option>
                            <?php if (!empty($doadores)): ?>
                                <?php foreach ($doadores as $doador): ?>
                                    <option value="<?= $doador['Id'] ?>"><?= htmlspecialchars($doador['NomeCompleto']) ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Nenhum doador cadastrado</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="status_id">Status Atual *</label>
                        <select id="status_id" name="status_id" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($status as $stat): ?>
                                <option value="<?= $stat['Id'] ?>"><?= htmlspecialchars($stat['Descricao']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    <textarea id="observacoes" name="observacoes" rows="4" placeholder="Informações adicionais sobre o animal..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Animal</button>
                </div>
            </form>
        </div>
    </div>

    <script src="cadastrogeral.js"></script>
    <script>
        // Carregar raças baseado na espécie selecionada
        document.getElementById('especie_id').addEventListener('change', function() {
            const especieId = this.value;
            const racaSelect = document.getElementById('raca_id');
            
            if (especieId) {
                fetch(`carregar_racas.php?especie_id=${especieId}`)
                    .then(response => response.json())
                    .then(racas => {
                        racaSelect.innerHTML = '<option value="">Selecione a raça</option>';
                        racas.forEach(raca => {
                            racaSelect.innerHTML += `<option value="${raca.Id}">${raca.Nome}</option>`;
                        });
                    })
                    .catch(error => console.error('Erro:', error));
            } else {
                racaSelect.innerHTML = '<option value="">Selecione primeiro a espécie</option>';
            }
        });

        // Calcular idade estimada baseada na data de nascimento
        document.getElementById('data_nascimento').addEventListener('change', function() {
            if (!this.value) return;
            
            const nascimento = new Date(this.value);
            const hoje = new Date();
            const diffMeses = (hoje.getFullYear() - nascimento.getFullYear()) * 12 + 
                             (hoje.getMonth() - nascimento.getMonth());
            
            if (diffMeses >= 0) {
                document.getElementById('idade_estimada_meses').value = diffMeses;
            }
        });
    </script>
</body>
</html>