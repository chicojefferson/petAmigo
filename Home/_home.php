<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop - Adote um Amigo</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>

    <header class="header">
        <section>
            <a href="#" class="logo">
                <img src="petlogo.png" alt="logo">
            </a>

            <!-- Menu principal -->
            <nav class="navbar main-menu">
                <a href="\Projeto_Pet\Home\home.php">Home</a>
                <a href="\Projeto_Pet\Sobre\sobre.php">Sobre</a>
                <a href="\Projeto_Pet\Menu\menu.php">Menu</a>
                <a href="\Projeto_Pet\Avaliações\avaliacoes.php">Avaliações</a>
                <a href="\Projeto_Pet\Endereço\endereco.php">Endereço</a>
            </nav>

            <!-- Menu de Login e Cadastro de Pessoas no canto direito -->
            <nav class="navbar right-menu">
                <a href="\Projeto_Pet\Cadastro Geral 3\cadastrogeral.php">Cadastro Geral</a>
                <a href="\Projeto_Pet\Login\login.php">Login</a>
            </nav>

            <div class="icon">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/ffffff/search--v1.png" alt="search--v1" />
                <img width="30" height="30" src="https://img.icons8.com/material-outlined/24/ffffff/shopping-cart--v1.png" alt="shopping-cart--v1" />
            </div>
        </section>
    </header>

    <div class="home-container">
        <section id="home">
            <div class="content">
                <h3>Adote Um Amigo de Quatro Patas</h3>
                <p>Transforme a vida de um pet e ganhe um companheiro leal. 
                Adotar é um ato de amor que muda histórias.</p>
                <a href="\Projeto_Pet\Menu\menu.php" class="btn">Conheça nossos pets</a>
            </div>
        </section>
    </div>

    <section class="about" id="about">
        <h2 class="title">Sobre <span>Nós</span></h2>
        <div class="row">
            <div class="container-image">
                <img src="cachorrobig.png" alt="sobre-nos">
            </div>
            <div class="content">
                <h3>Nossos Melhores Amigos</h3>
                <p>No nosso espaço, cada animal é tratado como parte da família. Cuidamos com carinho, atenção e dedicação, buscando sempre oferecer um lar cheio de amor e segurança.</p>
                <p>Acreditamos que adotar é mais do que um gesto de compaixão: é transformar vidas. Tanto a vida do pet quanto a do humano que o acolhe se enchem de alegria, aprendizado e cumplicidade.</p>
                <p>Nosso objetivo é conectar pessoas e animais, criando histórias felizes e lares cheios de amor. Aqui, cada patinha importa e cada olhar é valorizado.</p>
                <a href="\Projeto_Pet\Sobre\sobre.php" class="btn">Saiba mais</a>
            </div>
        </div>
    </section>

    <section class="menu" id="menu">
        <h2 class="title">Nossos animais <span>Disponíveis</span></h2>

        <div class="box-container">
            <div class="box">
                <img src="dos.png" alt="Golden Retriever">
                <h3>Golden</h3>
                <p class="description">Amigável e brincalhão, perfeito para famílias</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="Labrador.png" alt="Labrador">
                <h3>Labrador</h3>
                <p class="description">Inteligente e energético, ótimo companheiro</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="Shih Tzu.png" alt="Shih Tzu">
                <h3>Shih Tzu</h3>
                <p class="description">Carinhoso e adaptável, ideal para apartamento</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="Maine Coon.png" alt="Maine Coon">
                <h3>Maine Coon</h3>
                <p class="description">Gato tranquilo e sociável, de porte grande</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="Persa.png" alt="Gato Persa">
                <h3>Persa</h3>
                <p class="description">Calmo e elegante, de pelagem exuberante</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="Sphynx.png" alt="Gato Sphynx">
                <h3>Sphynx</h3>
                <p class="description">Carinhoso e único, não tem pelos</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 PetShop - Adote um Amigo. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>