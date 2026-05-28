<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Nossos Animais</title>
    <link rel="stylesheet" href="menu.css">
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
                <a href="address">Endereço</a>
            </nav>

            <!-- Menu de Login e Cadastro de Pessoas no canto direito -->
            <nav class="navbar right-menu">
                <a href="\Projeto_Pet\Cadastro Geral 2\cadastrogeral.php">Faça seu cadastro</a>
                <a href="\Projeto_Pet\Login\login.php">Login</a>
            </nav>

            <div class="icon">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/ffffff/search--v1.png" alt="search--v1" />
                <img width="30" height="30" src="https://img.icons8.com/material-outlined/24/ffffff/shopping-cart--v1.png" alt="shopping-cart--v1" />
            </div>
        </section>
    </header>

    <section class="menu" id="menu">
        <h2 class="title">Nossos <span>Animais</span></h2>

        <div class="box-container">
            <!-- Cachorros -->
            <div class="box">
                <img src="dos.png" alt="Golden">
                <h3>Golden</h3>
                <p class="price">Disponível para adoção</p>
                <p>Raça dócil e brincalhona, perfeita para famílias</p>
                <a href="#" class="btn">Adote Agora</a>
            </div>

            <div class="box">
                <img src="Labrador.png" alt="Labrador">
                <h3>Labrador</h3>
                <p class="price">Disponível para adoção</p>
                <p>Inteligente e energético, ideal para atividades</p>
                <a href="#" class="btn">Adote Agora</a>
            </div>

            <div class="box">
                <img src="Shih Tzu.png" alt="Shih Tzu">
                <h3>Shih Tzu</h3>
                <p class="price">Disponível para adoção</p>
                <p>Pequeno e carinhoso, perfeito para apartamentos</p>
                <a href="#" class="btn">Adote Agora</a>
            </div>

            <!-- Gatos -->
            <div class="box">
                <img src="Maine Coon.png" alt="Maine Coon">
                <h3>Maine Coon</h3>
                <p class="price">Disponível para adoção</p>
                <p>Gato de porte grande, muito sociável e carinhoso</p>
                <a href="#" class="btn">Adote Agora</a>
            </div>

            <div class="box">
                <img src="Persa.png" alt="Persa">
                <h3>Persa</h3>
                <p class="price">Disponível para adoção</p>
                <p>Raça tranquila e elegante, de pelos longos</p>
                <a href="#" class="btn">Adote Agora</a>
            </div>

            <div class="box">
                <img src="Sphynx.png" alt="Sphynx">
                <h3>Sphynx</h3>
                <p class="price">Disponível para adoção</p>
                <p>Gato sem pelos, muito afetuoso e brincalhão</p>
                <a href="#" class="btn">Adote Agora</a>
            </div>

            <!-- Animais adicionais -->
            <div class="box">
                <img src="vira-lata.png" alt="Vira-lata">
                <h3>Vira-lata Caramelo</h3>
                <p class="price">Disponível para adoção</p>
                <p>Amigável e resistente, cheio de personalidade</p>
                <a href="#" class="btn">Adote Agora</a>
            </div>

            <div class="box">
                <img src="siames.png" alt="Siamês">
                <h3>Siamês</h3>
                <p class="price">Disponível para adoção</p>
                <p>Inteligente e vocal, muito apegado ao dono</p>
                <a href="#" class="btn">Adote Agora</a>
            </div>
        </div>
    </section>

</body>
</html>