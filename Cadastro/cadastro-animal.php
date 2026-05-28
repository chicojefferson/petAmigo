<?php
session_start();
include '../conexao/database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Login/login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Verificar se é doador
$query = "SELECT d.* FROM doadores d WHERE d.usuario_id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$_SESSION['usuario']['id']]);
$doador = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$doador) {
    header("Location: cadastro-doador.php");
    exit();
}

if ($_POST) {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $idade = $_POST['idade'];
    $porte = $_POST['porte'];
    $sexo = $_POST['sexo'];
    $vacinado = isset($_POST['vacinado']) ? 1 : 0;
    $castrado = isset($_POST['castrado']) ? 1 : 0;
    $descricao = $_POST['descricao'];
    $observacoes = $_POST['observacoes'];
    $doador_id = $doador['id'];
    
    // Upload da imagem
    $imagem = 'default.png';
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem = uniqid() . '.' . $extensao;
        $caminho = '../img/animais/' . $imagem;
        
        if (!is_dir('../img/animais/')) {
            mkdir('../img/animais/', 0777, true);
        }
        
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);
    }
    
    $query = "INSERT INTO animais (nome, especie, raca, idade, porte, sexo, vacinado, castrado, descricao, observacoes, imagem, doador_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    
    if ($stmt->execute([$nome, $especie, $raca, $idade, $porte, $sexo, $vacinado, $castrado, $descricao, $observacoes, $imagem, $doador_id])) {
        $sucesso = "Animal cadastrado com sucesso! Ele já está disponível para adoção.";
        // Limpar formulário
        $_POST = array();
    } else {
        $erro = "Erro ao cadastrar animal. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Animal - PetAmigo</title>
    <link rel="stylesheet" href="../Home/home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .cadastro-container {
            max-width: 800px;
            margin: 120px auto 4rem;
            padding: 2rem;
            background: #1a1a1a;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(255,255,255,0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #fff;
        }
        
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #333;
            border-radius: 5px;
            background: #000;
            color: #fff;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        
        .checkbox-group {
            display: flex;
            gap: 2rem;
            margin: 1rem 0;
        }
        
        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .info-box {
            background: #2a2a2a;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <header class="header">
        <section>
            <a href="../index.php" class="logo">
                <img src="../img/petlogo.png" alt="logo">
            </a>

            <nav class="navbar main-menu">
                <a href="../Home/home.php"><i class="fas fa-home"></i> Home</a>
                <a href="../Sobre/sobre.php"><i class="fas fa-paw"></i> Sobre</a>
                <a href="../Menu/menu.php"><i class="fas fa-paw"></i> Menu</a>
                <a href="../Avaliações/avaliacoes.php"><i class="fas fa-star"></i> Avaliações</a>
            </nav>

            <nav class="navbar right-menu">
                <a href="meus-animais.php"><i class="fas fa-paw"></i> Meus Animais</a>
                <a href="../Login/logout.php">
                    <i class="fas fa-sign-out-alt"></i> Sair (<?php echo $_SESSION['usuario']['nome']; ?>)
                </a>
            </nav>
        </section>
    </header>

    <div class="cadastro-container">
        <h2 class="title" style="text-align: center; margin-bottom: 2rem;">Cadastrar <span>Animal</span></h2>
        
        <?php if (isset($sucesso)): ?>
            <div class="alert alert-success"><?php echo $sucesso; ?></div>
        <?php endif; ?>
        
        <?php if (isset($erro)): ?>
            <div class="alert alert-error"><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <div class="info-box">
            <i class="fas fa-info-circle"></i> Preencha todas as informações do animal para ajudar na adoção.
        </div>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome do Animal *</label>
                <input type="text" id="nome" name="nome" value="<?php echo $_POST['nome'] ?? ''; ?>" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="especie">Espécie *</label>
                    <select id="especie" name="especie" required>
                        <option value="">Selecione</option>
                        <option value="Cachorro" <?php echo ($_POST['especie'] ?? '') == 'Cachorro' ? 'selected' : ''; ?>>Cachorro</option>
                        <option value="Gato" <?php echo ($_POST['especie'] ?? '') == 'Gato' ? 'selected' : ''; ?>>Gato</option>
                        <option value="Outro" <?php echo ($_POST['especie'] ?? '') == 'Outro' ? 'selected' : ''; ?>>Outro</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="raca">Raça *</label>
                    <input type="text" id="raca" name="raca" value="<?php echo $_POST['raca'] ?? ''; ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="idade">Idade (anos) *</label>
                    <input type="number" id="idade" name="idade" min="0" max="30" value="<?php echo $_POST['idade'] ?? ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="porte">Porte *</label>
                    <select id="porte" name="porte" required>
                        <option value="">Selecione</option>
                        <option value="Pequeno" <?php echo ($_POST['porte'] ?? '') == 'Pequeno' ? 'selected' : ''; ?>>Pequeno</option>
                        <option value="Médio" <?php echo ($_POST['porte'] ?? '') == 'Médio' ? 'selected' : ''; ?>>Médio</option>
                        <option value="Grande" <?php echo ($_POST['porte'] ?? '') == 'Grande' ? 'selected' : ''; ?>>Grande</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="sexo">Sexo *</label>
                    <select id="sexo" name="sexo" required>
                        <option value="">Selecione</option>
                        <option value="M" <?php echo ($_POST['sexo'] ?? '') == 'M' ? 'selected' : ''; ?>>Macho</option>
                        <option value="F" <?php echo ($_POST['sexo'] ?? '') == 'F' ? 'selected' : ''; ?>>Fêmea</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Saúde</label>
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="vacinado" <?php echo isset($_POST['vacinado']) ? 'checked' : ''; ?>>
                            Vacinado
                        </label>
                        <label>
                            <input type="checkbox" name="castrado" <?php echo isset($_POST['castrado']) ? 'checked' : ''; ?>>
                            Castrado
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="imagem">Foto do Animal</label>
                <input type="file" id="imagem" name="imagem" accept="image/*">
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição *</label>
                <textarea id="descricao" name="descricao" rows="3" required placeholder="Descreva o temperamento, personalidade, hábitos..."><?php echo $_POST['descricao'] ?? ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="observacoes">Observações Adicionais</label>
                <textarea id="observacoes" name="observacoes" rows="2" placeholder="Histórico de saúde, comportamentos específicos, etc..."><?php echo $_POST['observacoes'] ?? ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn" style="width: 100%;">
                <i class="fas fa-save"></i> Cadastrar Animal
            </button>
        </form>
    </div>

    <?php include '../footer.php'; ?>
</body>
</html>