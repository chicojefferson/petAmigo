<?php
session_start();
include '../conexao/database.php';

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    
    $query = "INSERT INTO usuarios (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    
    if ($stmt->execute([$nome, $email, $senha, $telefone, $endereco])) {
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso! Faça login para continuar.";
        header("Location: ../Login/login.php");
        exit();
    } else {
        $erro = "Erro ao cadastrar. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - PetAmigo</title>
    <link rel="stylesheet" href="../Home/home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .cadastro-container {
            max-width: 600px;
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
    </style>
</head>

<body>

    <header class="header">
        <section>
            <a href="../index.php" class="logo">
                <img src="../img/petlogo.png" alt="logo">
            </a>

            <nav class="navbar main-menu">
                <a href="../Home/home.php">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="../Sobre/sobre.php">
                    <i class="fas fa-paw"></i> Sobre
                </a>
                <a href="../Menu/menu.php">
                    <i class="fas fa-paw"></i> Menu
                </a>
                <a href="../Avaliações/avaliacoes.php">
                    <i class="fas fa-star"></i> Avaliações
                </a>
            </nav>

            <nav class="navbar right-menu">
                <a href="cadastrogeral.php">
                    <i class="fas fa-user-plus"></i> Cadastro
                </a>
                <a href="../Login/login.php">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </nav>

            <div class="icon">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/ffffff/search--v1.png" alt="search--v1" />
            </div>
        </section>
    </header>

    <div class="cadastro-container">
        <h2 class="title" style="text-align: center; margin-bottom: 2rem;">Cadastro <span>PetAmigo</span></h2>
        
        <?php if (isset($erro)): ?>
            <div class="alert alert-error"><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo *</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="email">E-mail *</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha *</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone *</label>
                <input type="tel" id="telefone" name="telefone" required>
            </div>
            
            <div class="form-group">
                <label for="endereco">Endereço Completo *</label>
                <textarea id="endereco" name="endereco" rows="3" required></textarea>
            </div>
            
            <button type="submit" class="btn" style="width: 100%;">Cadastrar</button>
        </form>
        
        <p style="text-align: center; margin-top: 1rem; color: #ccc;">
            Já tem cadastro? <a href="../Login/login.php" style="color: #3498db;">Faça login aqui</a>
        </p>
    </div>

    <?php include '../footer.php'; ?>

</body>

</html>