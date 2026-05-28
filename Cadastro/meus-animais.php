<?php
session_start();
include '../conexao/database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Login/login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Verificar se é doador e buscar seus animais
$query = "SELECT a.* FROM animais a 
          INNER JOIN doadores d ON a.doador_id = d.id 
          WHERE d.usuario_id = ? 
          ORDER BY a.data_cadastro DESC";
$stmt = $db->prepare($query);
$stmt->execute([$_SESSION['usuario']['id']]);
$animais = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar se é doador
$query_doador = "SELECT d.* FROM doadores d WHERE d.usuario_id = ?";
$stmt_doador = $db->prepare($query_doador);
$stmt_doador->execute([$_SESSION['usuario']['id']]);
$doador = $stmt_doador->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Animais - PetAmigo</title>
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
                <?php if ($doador): ?>
                    <a href="cadastro-animal.php"><i class="fas fa-plus"></i> Cadastrar Animal</a>
                <?php else: ?>
                    <a href="cadastro-doador.php"><i class="fas fa-heart"></i> Ser Doador</a>
                <?php endif; ?>
                <a href="../Login/logout.php">
                    <i class="fas fa-sign-out-alt"></i> Sair (<?php echo $_SESSION['usuario']['nome']; ?>)
                </a>
            </nav>
        </section>
    </header>

    <div class="home-container" style="margin-top: 100px; padding: 4rem 0; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('../img/principal.png') center/cover no-repeat;">
        <section id="home">
            <div class="content">
                <h3>Meus Animais Cadastrados</h3>
                <p>Gerencie os animais que você cadastrou para adoção</p>
            </div>
        </section>
    </div>

    <section class="menu" id="menu">
        <div style="text-align: center; margin-bottom: 2rem;">
            <?php if ($doador): ?>
                <a href="cadastro-animal.php" class="btn">
                    <i class="fas fa-plus"></i> Cadastrar Novo Animal
                </a>
            <?php else: ?>
                <a href="cadastro-doador.php" class="btn">
                    <i class="fas fa-heart"></i> Torne-se um Doador
                </a>
            <?php endif; ?>
        </div>

        <?php if (empty($animais) && $doador): ?>
            <div style="text-align: center; padding: 3rem; color: #ccc;">
                <i class="fas fa-paw" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <h3>Nenhum animal cadastrado</h3>
                <p>Comece cadastrando seu primeiro animal para adoção!</p>
                <a href="cadastro-animal.php" class="btn">Cadastrar Primeiro Animal</a>
            </div>
        <?php elseif (empty($animais)): ?>
            <div style="text-align: center; padding: 3rem; color: #ccc;">
                <i class="fas fa-heart" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <h3>Você ainda não é um doador</h3>
                <p>Torne-se um doador para cadastrar animais para adoção!</p>
                <a href="cadastro-doador.php" class="btn">Tornar-se Doador</a>
            </div>
        <?php else: ?>
            <div class="box-container">
                <?php foreach ($animais as $animal): ?>
                <div class="box">
                    <img src="../img/animais/<?php echo $animal['imagem']; ?>" alt="<?php echo $animal['nome']; ?>" 
                         onerror="this.src='../img/dos.png'">
                    <h3><?php echo $animal['nome']; ?></h3>
                    <p class="description"><?php echo $animal['descricao']; ?></p>
                    <p><strong>Raça:</strong> <?php echo $animal['raca']; ?></p>
                    <p><strong>Idade:</strong> <?php echo $animal['idade']; ?> anos</p>
                    <p><strong>Porte:</strong> <?php echo $animal['porte']; ?></p>
                    <p><strong>Status:</strong> 
                        <span style="color: <?php echo $animal['disponivel'] ? '#2ecc71' : '#e74c3c'; ?>">
                            <?php echo $animal['disponivel'] ? 'Disponível' : 'Adotado'; ?>
                        </span>
                    </p>
                    <div style="margin-top: 1rem;">
                        <small>Cadastrado em: <?php echo date('d/m/Y', strtotime($animal['data_cadastro'])); ?></small>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <?php include '../footer.php'; ?>
</body>
</html>