<?php
session_start();
include '../conexao/database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Login/login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Verificar se já é doador
$query = "SELECT * FROM doadores WHERE usuario_id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$_SESSION['usuario']['id']]);
$doador = $stmt->fetch(PDO::FETCH_ASSOC);

if ($doador) {
    header("Location: cadastro-animal.php");
    exit();
}

if ($_POST) {
    $cpf = $_POST['cpf'];
    $usuario_id = $_SESSION['usuario']['id'];
    
    $query = "INSERT INTO doadores (usuario_id, cpf) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    
    if ($stmt->execute([$usuario_id, $cpf])) {
        $_SESSION['sucesso'] = "Cadastro como doador realizado com sucesso!";
        header("Location: cadastro-animal.php");
        exit();
    } else {
        $erro = "Erro ao cadastrar como doador. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Doador - PetAmigo</title>
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
        
        .info-box {
            background: #2a2a2a;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            border-left: 4px solid #3498db;
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
                <a href="../Login/logout.php">
                    <i class="fas fa-sign-out-alt"></i> Sair (<?php echo $_SESSION['usuario']['nome']; ?>)
                </a>
            </nav>
        </section>
    </header>

    <div class="cadastro-container">
        <h2 class="title" style="text-align: center; margin-bottom: 2rem;">Tornar-se <span>Doador</span></h2>
        
        <div class="info-box">
            <h3><i class="fas fa-info-circle"></i> Benefícios de ser um Doador:</h3>
            <p>✓ Cadastrar animais para adoção</p>
            <p>✓ Acompanhar o processo de adoção</p>
            <p>✓ Receber suporte da nossa equipe</p>
            <p>✓ Contribuir para um mundo com menos animais abandonados</p>
        </div>
        
        <?php if (isset($erro)): ?>
            <div class="alert alert-error"><?php echo $erro; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="cpf">CPF *</label>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
            </div>
            
            <div class="form-group">
                <label for="termo">
                    <input type="checkbox" id="termo" name="termo" required>
                    Concordo com os termos e responsabilidades de ser um doador
                </label>
            </div>
            
            <button type="submit" class="btn" style="width: 100%;">
                <i class="fas fa-heart"></i> Tornar-me Doador
            </button>
        </form>
    </div>

    <?php include '../footer.php'; ?>

    <script>
        // Máscara para CPF
        document.getElementById('cpf').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            e.target.value = value;
        });
    </script>
</body>
</html>