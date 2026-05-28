<?php
session_start();
include '../conexao/database.php';

$database = new Database();
$db = $database->getConnection();

// Buscar animais disponíveis
$query = "SELECT * FROM animais WHERE disponivel = TRUE LIMIT 6";
$stmt = $db->prepare($query);
$stmt->execute();
$animais = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetAmigo - Adote um Amigo</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <header class="header">
        <section>
            <a href="../index.php" class="logo">
                <img src="../img/petlogo.png" alt="logo">
            </a>

            <!-- Menu principal -->
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

            <!-- Menu de Login e Cadastro de Pessoas no canto direito -->
            <nav class="navbar right-menu">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <a href="../Login/logout.php">
                        <i class="fas fa-sign-out-alt"></i> Sair (<?php echo $_SESSION['usuario']['nome']; ?>)
                    </a>
                <?php else: ?>
                    <a href="../Cadastro/cadastrogeral.php">
                        <i class="fas fa-user-plus"></i> Cadastro
                    </a>
                    <a href="../Login/login.php">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                <?php endif; ?>
            </nav>

            <div class="icon">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/ffffff/search--v1.png" alt="search--v1" />
            </div>
        </section>
        <nav class="navbar right-menu">
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="../Cadastro/meus-animais.php">
                    <i class="fas fa-paw"></i> Meus Animais
                </a>
                <a href="../Login/logout.php">
                    <i class="fas fa-sign-out-alt"></i> Sair (<?php echo $_SESSION['usuario']['nome']; ?>)
                </a>
                <?php else: ?>
                    <a href="../Cadastro/cadastrogeral.php">
                    <i class="fas fa-user-plus"></i> Cadastro
                </a>
                <a href="../Login/login.php">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            <?php endif; ?>
        </nav>
    </header>

    <div class="home-container">
        <section id="home">
            <div class="content">
                <h3>Adote Um Amigo de Quatro Patas</h3>
                <p>Transforme a vida de um pet e ganhe um companheiro leal. 
                Adotar é um ato de amor que muda histórias.</p>
                <a href="../Menu/menu.php" class="btn">Conheça nossos pets</a>
            </div>
        </section>
    </div>

    <section class="about" id="about">
        <h2 class="title">Sobre <span>Nós</span></h2>
        <div class="row">
            <div class="container-image">
                <img src="../img/cachorrobig.png" alt="sobre-nos">
            </div>
            <div class="content">
                <h3>Nossos Melhores Amigos</h3>
                <p>No nosso espaço, cada animal é tratado como parte da família. Cuidamos com carinho, atenção e dedicação, buscando sempre oferecer um lar cheio de amor e segurança.</p>
                <p>Acreditamos que adotar é mais do que um gesto de compaixão: é transformar vidas. Tanto a vida do pet quanto a do humano que o acolhe se enchem de alegria, aprendizado e cumplicidade.</p>
                <p>Nosso objetivo é conectar pessoas e animais, criando histórias felizes e lares cheios de amor. Aqui, cada patinha importa e cada olhar é valorizado.</p>
                <a href="../Sobre/sobre.php" class="btn">Saiba mais</a>
            </div>
        </div>
    </section>

    <section class="menu" id="menu">
        <h2 class="title">Nossos animais <span>Disponíveis</span></h2>

        <div class="box-container">
            <?php foreach ($animais as $animal): ?>
            <div class="box">
                <img src="../img/<?php echo $animal['imagem']; ?>" alt="<?php echo $animal['nome']; ?>">
                <h3><?php echo $animal['nome']; ?></h3>
                <p class="description"><?php echo $animal['descricao']; ?></p>
                <p><strong>Raça:</strong> <?php echo $animal['raca']; ?></p>
                <p><strong>Idade:</strong> <?php echo $animal['idade']; ?> anos</p>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <a href="../Cadastro/pedido-adocao.php?animal_id=<?php echo $animal['id']; ?>" class="btn">Quero adotar</a>
                <?php else: ?>
                    <a href="../Login/login.php" class="btn">Faça login para adotar</a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include '../footer.php'; ?>

</body>

</html>