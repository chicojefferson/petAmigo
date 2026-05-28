<?php
session_start();
include '../conexao/database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Login/login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Buscar animal
$animal_id = $_GET['animal_id'] ?? 0;
$query = "SELECT * FROM animais WHERE id = ? AND disponivel = TRUE";
$stmt = $db->prepare($query);
$stmt->execute([$animal_id]);
$animal = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$animal) {
    header("Location: ../Menu/menu.php");
    exit();
}

// Buscar informações do usuário
$query_usuario = "SELECT * FROM usuarios WHERE id = ?";
$stmt_usuario = $db->prepare($query_usuario);
$stmt_usuario->execute([$_SESSION['usuario']['id']]);
$usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

if ($_POST) {
    $usuario_id = $_SESSION['usuario']['id'];
    $animal_id = $animal['id'];
    $motivacao = $_POST['motivacao'];
    $experiencia = $_POST['experiencia'];
    $termo = isset($_POST['termo']) ? 1 : 0;
    
    if ($termo) {
        $query = "INSERT INTO adocoes (usuario_id, animal_id, motivacao, experiencia) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        
        if ($stmt->execute([$usuario_id, $animal_id, $motivacao, $experiencia])) {
            $sucesso = "Pedido de adoção enviado com sucesso! Entraremos em contato em breve.";
            
            // Atualizar status do animal para não disponível temporariamente
            $query_update = "UPDATE animais SET disponivel = FALSE WHERE id = ?";
            $stmt_update = $db->prepare($query_update);
            $stmt_update->execute([$animal_id]);
        } else {
            $erro = "Erro ao enviar pedido de adoção. Tente novamente.";
        }
    } else {
        $erro = "Você precisa concordar com os termos de adoção responsável.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Adoção - PetAmigo</title>
    <link rel="stylesheet" href="../Home/home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .adocao-container {
            max-width: 800px;
            margin: 120px auto 4rem;
            padding: 2rem;
        }
        
        .animal-info {
            background: #1a1a1a;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .animal-info img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        
        .animal-details {
            flex: 1;
        }
        
        .form-container {
            background: #1a1a1a;
            padding: 2rem;
            border-radius: 10px;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #fff;
            font-weight: bold;
        }
        
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #333;
            border-radius: 5px;
            background: #000;
            color: #fff;
        }
        
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin: 2rem 0;
            padding: 1rem;
            background: #2a2a2a;
            border-radius: 5px;
        }
        
        .checkbox-group input {
            width: auto;
            margin-top: 0.3rem;
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
        
        .success-box {
            text-align: center;
            padding: 3rem;
            background: #1a1a1a;
            border-radius: 10px;
        }
        
        .success-box i {
            font-size: 4rem;
            color: #2ecc71;
            margin-bottom: 1rem;
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
                <a href="../Cadastro/meus-animais.php">
                    <i class="fas fa-paw"></i> Meus Animais
                </a>
                <a href="../Login/logout.php">
                    <i class="fas fa-sign-out-alt"></i> Sair (<?php echo $_SESSION['usuario']['nome']; ?>)
                </a>
            </nav>
        </section>
    </header>

    <div class="adocao-container">
        <?php if (isset($sucesso)): ?>
            <div class="success-box">
                <i class="fas fa-check-circle"></i>
                <h2>Pedido Enviado com Sucesso!</h2>
                <p><?php echo $sucesso; ?></p>
                <p style="margin: 2rem 0; color: #ccc;">
                    Nossa equipe entrará em contato dentro de 48 horas para dar continuidade ao processo.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="../Home/home.php" class="btn">Voltar para Home</a>
                    <a href="../Menu/menu.php" class="btn">Ver outros animais</a>
                </div>
            </div>
        <?php else: ?>
            <h2 class="title" style="text-align: center; margin-bottom: 2rem;">Pedido de Adoção</h2>
            
            <div class="animal-info">
                <img src="../img/<?php echo $animal['imagem']; ?>" alt="<?php echo $animal['nome']; ?>">
                <div class="animal-details">
                    <h3><?php echo $animal['nome']; ?></h3>
                    <p><strong>Espécie:</strong> <?php echo $animal['especie']; ?></p>
                    <p><strong>Raça:</strong> <?php echo $animal['raca']; ?></p>
                    <p><strong>Idade:</strong> <?php echo $animal['idade']; ?> anos</p>
                    <p><strong>Porte:</strong> <?php echo $animal['porte']; ?></p>
                    <p><strong>Descrição:</strong> <?php echo $animal['descricao']; ?></p>
                </div>
            </div>

            <?php if (isset($erro)): ?>
                <div class="alert alert-error"><?php echo $erro; ?></div>
            <?php endif; ?>

            <div class="form-container">
                <h3 style="color: #fff; margin-bottom: 1.5rem;">Informações para Adoção</h3>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="nome">Seu Nome</label>
                        <input type="text" id="nome" value="<?php echo $usuario['nome']; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Seu E-mail</label>
                        <input type="email" id="email" value="<?php echo $usuario['email']; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Seu Telefone</label>
                        <input type="text" id="telefone" value="<?php echo $usuario['telefone']; ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="endereco">Seu Endereço</label>
                        <textarea id="endereco" readonly><?php echo $usuario['endereco']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="motivacao">Por que você quer adotar <?php echo $animal['nome']; ?>? *</label>
                        <textarea id="motivacao" name="motivacao" placeholder="Conte um pouco sobre sua motivação para adotar este animal..." required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="experiencia">Você já teve experiência com animais? *</label>
                        <select id="experiencia" name="experiencia" required>
                            <option value="">Selecione</option>
                            <option value="Nenhuma">Nenhuma experiência</option>
                            <option value="Pouca">Pouca experiência</option>
                            <option value="Moderada">Experiência moderada</option>
                            <option value="Muita">Muita experiência</option>
                        </select>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="termo" name="termo" required>
                        <label for="termo" style="color: #fff;">
                            <strong>Declaro que li e concordo com os Termos de Adoção Responsável:</strong><br>
                            • Comprometo-me a fornecer todos os cuidados necessários<br>
                            • Garantirei alimentação adequada e cuidados veterinários<br>
                            • Oferecerei um ambiente seguro e amoroso<br>
                            • Não abandonarei o animal em nenhuma circunstância<br>
                            • Estou ciente de que a adoção é um compromisso para toda a vida do animal
                        </label>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; justify-content: center;">
                        <a href="../Menu/menu.php" class="btn" style="background: #666;">Cancelar</a>
                        <button type="submit" class="btn">
                            <i class="fas fa-paper-plane"></i> Enviar Pedido
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <?php include '../footer.php'; ?>
</body>
</html>