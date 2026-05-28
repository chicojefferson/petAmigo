<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - PetAmigo</title>
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
                <a href="../Cadastro/cadastrogeral.php">
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

    <div class="home-container" style="margin-top: 100px; padding: 4rem 0; background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('../img/principal.png') center/cover no-repeat;">
        <section id="home">
            <div class="content">
                <h3>Sobre o PetAmigo</h3>
                <p>Conheça nossa história e missão de conectar pets a lares cheios de amor</p>
            </div>
        </section>
    </div>

    <section class="about" id="about" style="margin-top: 2rem;">
        <div class="row">
            <div class="content">
                <h3>Nossa História</h3>
                <p>O PetAmigo nasceu do amor incondicional pelos animais e da vontade de fazer a diferença na vida de pets abandonados. Desde 2020, trabalhamos incansavelmente para resgatar, cuidar e encontrar lares amorosos para animais em situação de vulnerabilidade.</p>
                <p>Nossa equipe é composta por veterinários, voluntários e amantes de animais que dedicam suas vidas ao bem-estar dos nossos amigos de quatro patas.</p>
                
                <h3 style="margin-top: 2rem;">Nossa Missão</h3>
                <p>Promover a adoção responsável e consciente, educando a sociedade sobre a importância do cuidado com os animais e combatendo o abandono e maus-tratos.</p>
                
                <h3 style="margin-top: 2rem;">Nossos Valores</h3>
                <p>• Amor e respeito por todos os animais</p>
                <p>• Compromisso com o bem-estar animal</p>
                <p>• Transparência em todas as ações</p>
                <p>• Educação para adoção responsável</p>
            </div>
            <div class="container-image">
                <img src="../img/time.png" alt="sobre-nos">
            </div>
        </div>
    </section>

    <?php include '../footer.php'; ?>

</body>

</html>