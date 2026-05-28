<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop - Adote um Amigo</title>
    <link rel="stylesheet" href="Home/home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <header class="header">
        <section>
            <a href="#" class="logo">
                <img src="img/petlogo.png" alt="logo">
            </a>

            <!-- Menu principal -->
            <nav class="navbar main-menu">
                <a href="index.php">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="Sobre/sobre.php">
                    <i class="fas fa-paw"></i> Sobre
                </a>
                <a href="Menu/menu.php">
                    <i class="fas fa-paw"></i> Menu
                </a>
                <a href="Avaliações/avaliacoes.php">
                    <i class="fas fa-star"></i> Avaliações
                </a>
            </nav>

            <!-- Menu de Login e Cadastro de Pessoas no canto direito -->
            <nav class="navbar right-menu">
                <a href="Cadastro/cadastrogeral.php">
                    <i class="fas fa-user-plus"></i> Cadastro
                </a>
                <a href="Login/login.php">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </nav>

            <div class="icon">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/ffffff/search--v1.png" alt="search--v1" />
            </div>
        </section>
    </header>

    <div class="home-container">
        <section id="home">
            <div class="content">
                <h3>Adote Um Amigo de Quatro Patas</h3>
                <p>Transforme a vida de um pet e ganhe um companheiro leal. 
                Adotar é um ato de amor que muda histórias.</p>
                <a href="Menu/menu.php" class="btn">Conheça nossos pets</a>
            </div>
        </section>
    </div>

    <section class="about" id="about">
        <h2 class="title">Sobre <span>Nós</span></h2>
        <div class="row">
            <div class="container-image">
                <img src="img/cachorrobig.png" alt="sobre-nos">
            </div>
            <div class="content">
                <h3>Nossos Melhores Amigos</h3>
                <p>No nosso espaço, cada animal é tratado como parte da família. Cuidamos com carinho, atenção e dedicação, buscando sempre oferecer um lar cheio de amor e segurança.</p>
                <p>Acreditamos que adotar é mais do que um gesto de compaixão: é transformar vidas. Tanto a vida do pet quanto a do humano que o acolhe se enchem de alegria, aprendizado e cumplicidade.</p>
                <p>Nosso objetivo é conectar pessoas e animais, criando histórias felizes e lares cheios de amor. Aqui, cada patinha importa e cada olhar é valorizado.</p>
                <a href="Sobre/sobre.php" class="btn">Saiba mais</a>
            </div>
        </div>
    </section>

    <section class="menu" id="menu">
        <h2 class="title">Nossos animais <span>Disponíveis</span></h2>

        <div class="box-container">
            <div class="box">
                <img src="img/dos.png" alt="Golden Retriever">
                <h3>Golden</h3>
                <p class="description">Amigável e brincalhão, perfeito para famílias</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="img/Labrador.png" alt="Labrador">
                <h3>Labrador</h3>
                <p class="description">Inteligente e energético, ótimo companheiro</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="img/Shih Tzu.png" alt="Shih Tzu">
                <h3>Shih Tzu</h3>
                <p class="description">Carinhoso e adaptável, ideal para apartamento</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="img/Maine Coon.png" alt="Maine Coon">
                <h3>Maine Coon</h3>
                <p class="description">Gato tranquilo e sociável, de porte grande</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="img/Persa.png" alt="Gato Persa">
                <h3>Persa</h3>
                <p class="description">Calmo e elegante, de pelagem exuberante</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
            <div class="box">
                <img src="img/Sphynx.png" alt="Gato Sphynx">
                <h3>Sphynx</h3>
                <p class="description">Carinhoso e único, não tem pelos</p>
                <a href="#" class="btn">Adote agora</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Endereço</h3>
                <p><i class="fas fa-map-marker-alt"></i> Rua dos Animais, 123</p>
                <p>Centro, São Paulo - SP</p>
                <p>CEP: 01234-567</p>
            </div>
            
            <div class="footer-section">
                <h3>Contato</h3>
                <p><i class="fas fa-phone"></i> (11) 9999-9999</p>
                <p><i class="fas fa-envelope"></i> contato@petamigo.com.br</p>
            </div>
            
            <div class="footer-section">
                <h3>Redes Sociais</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Horário de Funcionamento</h3>
                <p>Segunda a Sexta: 8h às 18h</p>
                <p>Sábado: 9h às 16h</p>
                <p>Domingo: 9h às 12h</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2024 PetAmigo - Adote um Amigo. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>