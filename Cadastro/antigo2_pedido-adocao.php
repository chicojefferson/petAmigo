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
$query = "SELECT * FROM animais WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$animal_id]);
$animal = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$animal) {
    header("Location: ../Menu/menu.php");
    exit();
}

if ($_POST) {
    $usuario_id = $_SESSION['usuario']['id'];
    
    $query = "INSERT INTO adocoes (usuario_id, animal_id) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    
    if ($stmt->execute([$usuario_id, $animal_id])) {
        $sucesso = "Pedido de adoção enviado com sucesso! Entraremos em contato em breve.";
    } else {
        $erro = "Erro ao enviar pedido de adoção. Tente novamente.";
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

    <div class="home-container" style="margin-top: 100px; padding: 4rem 0;">
        <section id="home">
            <div class="content">
                <h3>Pedido de Adoção</h3>
                <p>Preencha o formulário para adotar <?php echo $animal['nome']; ?></p>
            </div>
        </section>
    </div>

    <section class="about" style="max-width: 600px; margin: 2rem auto;">
        <?php if (isset($sucesso)): ?>
            <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
                <?php echo $sucesso; ?>
            </div>
            <a href="../Menu/menu.php" class="btn">Voltar aos Animais</a>
        <?php else: ?>
            <div class="box" style="text-align: center;">
                <img src="../img/<?php echo $animal['imagem']; ?>" alt="<?php echo $animal['nome']; ?>" style="max-width: 200px;">
                <h3><?php echo $animal['nome']; ?></h3>
                <p><strong>Raça:</strong> <?php echo $animal['raca']; ?></p>
                <p><strong>Idade:</strong> <?php echo $animal['idade']; ?> anos</p>
                <p><strong>Descrição:</strong> <?php echo $animal['descricao']; ?></p>
                
                <form method="POST" style="margin-top: 2rem;">
                    <p style="color: #ccc; margin-bottom: 1rem;">
                        Ao confirmar, você estará solicitando a adoção de <?php echo $animal['nome']; ?>. 
                        Nossa equipe entrará em contato para continuar o processo.
                    </p>
                    <button type="submit" class="btn">Confirmar Pedido de Adoção</button>
                </form>
            </div>
        <?php endif; ?>
    </section>

    <?php include '../footer.php'; ?>
</body>
</html>