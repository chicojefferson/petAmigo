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
                <h3>Conheça Nossos Pets</h3>
                <p>Encontre seu companheiro perfeito entre nossos animais disponíveis para adoção</p>
            </div>
        </section>
    </div>

    <section class="menu" id="menu">
        <h2 class="title">Todos os animais <span>Disponíveis</span></h2>

        <div class="box-container">
            <div class="box">
                <img src="../img/dos.png" alt="Golden Retriever">
                <h3>Golden</h3>
                <p class="description">Amigável e brincalhão, perfeito para famílias</p>
                <p><strong>Idade:</strong> 2 anos</p>
                <p><strong>Porte:</strong> Grande</p>
                <a href="../Cadastro/cadastrogeral.php" class="btn">Quero adotar</a>
            </div>
            
            <div class="box">
                <img src="../img/Labrador.png" alt="Labrador">
                <h3>Labrador</h3>
                <p class="description">Inteligente e energético, ótimo companheiro</p>
                <p><strong>Idade:</strong> 1 ano</p>
                <p><strong>Porte:</strong> Grande</p>
                <a href="../Cadastro/cadastrogeral.php" class="btn">Quero adotar</a>
            </div>
            
            <!-- Adicione os outros animais aqui -->
             <!-- No loop dos animais, atualize o botão: -->
            <div class="box">
            <!-- ... outras informações do animal ... -->
             <?php if (isset($_SESSION['usuario'])): ?>
                    <a href="../Cadastro/pedido-adocao.php?animal_id=<?php echo $animal['id']; ?>" class="btn">Quero adotar</a>
                <?php else: ?>
                    <a href="../Login/login.php" class="btn">Faça login para adotar</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include '../footer.php'; ?>

</body>

</html>