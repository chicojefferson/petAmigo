<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações - PetAmigo</title>
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
                <h3>Avaliações dos Nossos Clientes</h3>
                <p>Veja o que dizem sobre suas experiências de adoção conosco</p>
            </div>
        </section>
    </div>

    <section class="about" id="about" style="margin-top: 2rem;">
        <div class="row">
            <div class="content">
                <h3>Depoimentos</h3>
                
                <div class="avaliacao">
                    <h4>Maria Silva ★★★★★</h4>
                    <p>"Adotei meu Golden há 6 meses e foi a melhor decisão da minha vida. O processo foi muito transparente e a equipe super atenciosa!"</p>
                </div>
                
                <div class="avaliacao">
                    <h4>João Santos ★★★★★</h4>
                    <p>"Adotamos um Labrador e a experiência foi incrível. Todo o suporte pós-adoção fez toda a diferença na adaptação."</p>
                </div>
                
                <div class="avaliacao">
                    <h4>Ana Costa ★★★★☆</h4>
                    <p>"Processo muito organizado e humano. Sinto que fizemos parte de algo especial ao dar um lar para um animal necessitado."</p>
                </div>
            </div>
        </div>
    </section>

    <?php include '../footer.php'; ?>

</body>

</html>