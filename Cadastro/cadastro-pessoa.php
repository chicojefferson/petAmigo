<?php
require_once 'database.php';

$especies = carregarEspecies($pdo);
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    
    // Campos específicos para adotantes
    $especie_preferida_id = $_POST['especie_preferida_id'] ?? null;
    $raca_preferida_id = $_POST['raca_preferida_id'] ?? null;
    $possui_outros_pets = isset($_POST['possui_outros_pets']) ? 1 : 0;
    $tipo_residencia = $_POST['tipo_residencia'] ?? '';
    $possui_quintal_murado = isset($_POST['possui_quintal_murado']) ? 1 : 0;
    $requisitos = $_POST['requisitos'] ?? '';
    
    // Endereço
    $cep = $_POST['cep'] ?? '';
    $logradouro = $_POST['logradouro'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $complemento = $_POST['complemento'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    
    try {
        $pdo->beginTransaction();
        
        // Inserir pessoa
        $stmt = $pdo->prepare("INSERT INTO pessoa (NomeCompleto, CPF, DataNascimento, Email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $cpf, $data_nascimento, $email]);
        $pessoa_id = $pdo->lastInsertId();
        
        // Inserir telefone
        $stmt = $pdo->prepare("INSERT INTO telefone (PessoaId, Tipo, Numero, Whatsapp) VALUES (?, 'Celular', ?, 1)");
        $stmt->execute([$pessoa_id, $telefone]);
        
        // Inserir endereço
        $stmt = $pdo->prepare("INSERT INTO endereco (PessoaId, Logradouro, Numero, Complemento, Bairro, Cidade, Estado, CEP, Principal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)");
        $stmt->execute([$pessoa_id, $logradouro, $numero, $complemento, $bairro, $cidade, $estado, $cep]);
        
        // Inserir como adotante ou doador
        if ($tipo === 'adotante' || $tipo === 'ambos') {
            $stmt = $pdo->prepare("
                INSERT INTO adotantes (
                    PessoaId, EspeciePreferidaId, RacaPreferidaId, PossuiOutrosPets, 
                    TipoResidencia, PossuiQuintalMurado, Requisitos
                ) VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $pessoa_id, $especie_preferida_id, $raca_preferida_id, $possui_outros_pets,
                $tipo_residencia, $possui_quintal_murado, $requisitos
            ]);
        }
        
        if ($tipo === 'doador' || $tipo === 'ambos') {
            $stmt = $pdo->prepare("INSERT INTO doadores (PessoaId) VALUES (?)");
            $stmt->execute([$pessoa_id]);
        }
        
        $pdo->commit();
        $success = 'Cadastro realizado com sucesso!';
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        $error = 'Erro no cadastro: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
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
            <h2>Cadastro de Pessoa</h2>
            <p>Preencha os dados para cadastrar adotante/doador</p>
        </div>

        <?php if ($success): ?>
            <div class="message success"><?= $success ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>

        <div class="form-section">
            <form method="POST" class="cadastro-form">
                <h4>Dados Pessoais</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome Completo *</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="telefone">Telefone *</label>
                        <input type="text" id="telefone" name="telefone" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF *</label>
                        <input type="text" id="cpf" name="cpf" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Cadastro *</label>
                        <select id="tipo" name="tipo" required>
                            <option value="">Selecione...</option>
                            <option value="adotante">Adotante</option>
                            <option value="doador">Doador</option>
                            <option value="ambos">Ambos</option>
                        </select>
                    </div>
                </div>

                <!-- Campos específicos para adotantes -->
                <div id="campos-adotante" style="display: none;">
                    <h4>Preferências para Adoção</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="especie_preferida_id">Espécie Preferida</label>
                            <select id="especie_preferida_id" name="especie_preferida_id">
                                <option value="">Selecione...</option>
                                <?php foreach ($especies as $especie): ?>
                                    <option value="<?= $especie['Id'] ?>"><?= htmlspecialchars($especie['Nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="raca_preferida_id">Raça Preferida</label>
                            <select id="raca_preferida_id" name="raca_preferida_id">
                                <option value="">Selecione primeiro a espécie</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="tipo_residencia">Tipo de Residência</label>
                            <select id="tipo_residencia" name="tipo_residencia">
                                <option value="">Selecione...</option>
                                <option value="casa">Casa</option>
                                <option value="apartamento">Apartamento</option>
                                <option value="sítio">Sítio</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="checkbox-group">
                            <input type="checkbox" id="possui_outros_pets" name="possui_outros_pets" value="1">
                            <label for="possui_outros_pets">Possui outros pets</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="possui_quintal_murado" name="possui_quintal_murado" value="1">
                            <label for="possui_quintal_murado">Possui quintal murado</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="requisitos">Requisitos/Preferências Especiais</label>
                        <textarea id="requisitos" name="requisitos" rows="3" placeholder="Alguma preferência ou requisito especial para adoção?"></textarea>
                    </div>
                </div>

                <h4>Endereço</h4>
                <div class="form-row">
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep">
                    </div>
                    <div class="form-group">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" id="logradouro" name="logradouro">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="text" id="numero" name="numero">
                    </div>
                    <div class="form-group">
                        <label for="complemento">Complemento</label>
                        <input type="text" id="complemento" name="complemento">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" name="bairro">
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="estado">
                            <option value="">Selecione...</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Cadastro</button>
                </div>
            </form>
        </div>
    </div>

    <script src="cadastrogeral.js"></script>
    <script>
        // Mostrar/ocultar campos de adotante
        document.getElementById('tipo').addEventListener('change', function() {
            const camposAdotante = document.getElementById('campos-adotante');
            if (this.value === 'adotante' || this.value === 'ambos') {
                camposAdotante.style.display = 'block';
            } else {
                camposAdotante.style.display = 'none';
            }
        });

        // Carregar raças baseado na espécie preferida
        document.getElementById('especie_preferida_id').addEventListener('change', function() {
            const especieId = this.value;
            const racaSelect = document.getElementById('raca_preferida_id');
            
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
    </script>
</body>
</html>