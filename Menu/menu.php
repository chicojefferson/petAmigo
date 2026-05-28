<?php
session_start();
include '../conexao/database.php';

$database = new Database();
$db = $database->getConnection();

// Buscar todos os animais disponíveis
$query = "SELECT * FROM animais WHERE disponivel = TRUE";
$stmt = $db->prepare($query);
$stmt->execute();
$animais = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossos Pets - PetAmigo</title>
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

            <div class="icon">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/ffffff/search--v1.png" alt="search--v1" />
            </div>
        </section>
    </header>

    <div class="home-container" style="margin-top: 100px; padding: 4rem 0; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('../img/principal.png') center/cover no-repeat;">
        <section id="home">
            <div class="content">
                <h3>Conheça Nossos Pets</h3>
                <p>Encontre seu companheiro perfeito entre nossos animais disponíveis para adoção</p>
                <?php if (!isset($_SESSION['usuario'])): ?>
                    <a href="../Login/login.php" class="btn" style="margin-top: 1rem;">
                        <i class="fas fa-sign-in-alt"></i> Faça login para adotar
                    </a>
                <?php endif; ?>
            </div>
        </section>
    </div>

    <section class="menu" id="menu">
        <h2 class="title">Todos os animais <span>Disponíveis</span></h2>

        <?php if (empty($animais)): ?>
            <div style="text-align: center; padding: 3rem; color: #ccc;">
                <i class="fas fa-paw" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                <h3>Nenhum animal disponível no momento</h3>
                <p>Volte em breve para conhecer nossos novos amigos!</p>
            </div>
        <?php else: ?>
            <div class="box-container">
                <?php foreach ($animais as $animal): ?>
                <div class="box">
                    <img src="../img/<?php echo $animal['imagem']; ?>" alt="<?php echo $animal['nome']; ?>" 
                         onerror="this.src='../img/dos.png'">
                    <h3><?php echo $animal['nome']; ?></h3>
                    <p class="description"><?php echo $animal['descricao']; ?></p>
                    
                    <div class="animal-details">
                        <p><i class="fas fa-paw"></i> <strong>Raça:</strong> <?php echo $animal['raca']; ?></p>
                        <p><i class="fas fa-birthday-cake"></i> <strong>Idade:</strong> <?php echo $animal['idade']; ?> anos</p>
                        <p><i class="fas fa-expand"></i> <strong>Porte:</strong> <?php echo $animal['porte']; ?></p>
                        <p><i class="fas fa-venus-mars"></i> <strong>Sexo:</strong> <?php echo $animal['sexo'] == 'M' ? 'Macho' : 'Fêmea'; ?></p>
                        
                        <?php if ($animal['vacinado']): ?>
                            <p><i class="fas fa-syringe" style="color: #2ecc71;"></i> <strong>Vacinado:</strong> Sim</p>
                        <?php endif; ?>
                        
                        <?php if ($animal['castrado']): ?>
                            <p><i class="fas fa-heart" style="color: #e74c3c;"></i> <strong>Castrado:</strong> Sim</p>
                        <?php endif; ?>
                    </div>

                    <?php if (isset($_SESSION['usuario'])): ?>
                        <a href="../Cadastro/pedido-adocao.php?animal_id=<?php echo $animal['id']; ?>" class="btn btn-adotar">
                            <i class="fas fa-heart"></i> Quero Adotar
                        </a>
                    <?php else: ?>
                        <a href="../Login/login.php" class="btn btn-login">
                            <i class="fas fa-sign-in-alt"></i> Faça login para adotar
                        </a>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <?php include '../footer.php'; ?>

    <style>
        .animal-details {
            margin: 1rem 0;
            padding: 1rem;
            background: rgba(255,255,255,0.05);
            border-radius: 8px;
        }
        
        .animal-details p {
            margin: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .animal-details i {
            width: 16px;
            text-align: center;
        }
        
        .btn-adotar {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            margin-top: 1rem;
        }
        
        .btn-adotar:hover {
            background: linear-gradient(135deg, #c0392b, #a93226);
            transform: translateY(-2px);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #3498db, #2980b9);
            margin-top: 1rem;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, #2980b9, #21618c);
            transform: translateY(-2px);
        }
        
        .box {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .box .btn {
            margin-top: auto;
            align-self: center;
            width: 90%;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .animal-details p {
                font-size: 0.9rem;
            }
            
            .box .btn {
                width: 100%;
            }
        }
    </style>
</body>
</html>