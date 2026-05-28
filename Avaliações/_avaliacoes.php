<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações - Nossos Clientes</title>
    <link rel="stylesheet" href="avaliacoes.css">
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

    <section class="reviews">
        <h2 class="title">Avaliações dos <span>Nossos Clientes</span></h2>

        <!-- Resumo das avaliações -->
        <div class="rating-summary">
            <div class="average-rating">4.8/5</div>
            <div class="total-reviews">Baseado em 247 avaliações</div>
            <div class="rating-stats">
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Recomendam</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">4.9</div>
                    <div class="stat-label">Atendimento</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">4.7</div>
                    <div class="stat-label">Processo</div>
                </div>
            </div>
        </div>

        <!-- Lista de avaliações -->
        <div class="review-container">
            <!-- Avaliação 1 -->
            <div class="review-box">
                <div class="review-header">
                    <img src="avatar1.png" alt="Maria Silva" class="review-avatar">
                    <div class="review-info">
                        <h4>Maria Silva</h4>
                        <div class="review-stars">★★★★★</div>
                        <div class="review-date">15/03/2024</div>
                    </div>
                </div>
                <div class="review-text">
                    "Adotei minha Golden aqui e foi a melhor decisão! O processo foi muito transparente e a equipe super atenciosa. Minha Luna chegou saudável e feliz, já adaptada à nova casa."
                </div>
                <div class="review-pet">
                    <img src="dos.png" alt="Golden">
                    <div class="review-pet-info">
                        <h5>Luna</h5>
                        <p>Golden - Adotada em 10/03/2024</p>
                    </div>
                </div>
            </div>

            <!-- Avaliação 2 -->
            <div class="review-box">
                <div class="review-header">
                    <img src="avatar2.png" alt="João Santos" class="review-avatar">
                    <div class="review-info">
                        <h4>João Santos</h4>
                        <div class="review-stars">★★★★★</div>
                        <div class="review-date">10/03/2024</div>
                    </div>
                </div>
                <div class="review-text">
                    "Excelente experiência! Adotei um Maine Coon e todo o suporte pós-adoção foi fundamental. Meu Thor é um amor, muito bem cuidado e socializado. Recomendo muito!"
                </div>
                <div class="review-pet">
                    <img src="Maine Coon.png" alt="Maine Coon">
                    <div class="review-pet-info">
                        <h5>Thor</h5>
                        <p>Maine Coon - Adotado em 05/03/2024</p>
                    </div>
                </div>
            </div>

            <!-- Avaliação 3 -->
            <div class="review-box">
                <div class="review-header">
                    <img src="avatar3.png" alt="Ana Costa" class="review-avatar">
                    <div class="review-info">
                        <h4>Ana Costa</h4>
                        <div class="review-stars">★★★★☆</div>
                        <div class="review-date">08/03/2024</div>
                    </div>
                </div>
                <div class="review-text">
                    "Processo de adoção muito bem organizado. Adotei um Shih Tzu que já veio vacinado e castrado. Só não dei 5 estrelas porque a documentação demorou um pouco mais do que o esperado."
                </div>
                <div class="review-pet">
                    <img src="Shih Tzu.png" alt="Shih Tzu">
                    <div class="review-pet-info">
                        <h5>Mel</h5>
                        <p>Shih Tzu - Adotada em 01/03/2024</p>
                    </div>
                </div>
            </div>

            <!-- Avaliação 4 -->
            <div class="review-box">
                <div class="review-header">
                    <img src="avatar4.png" alt="Pedro Lima" class="review-avatar">
                    <div class="review-info">
                        <h4>Pedro Lima</h4>
                        <div class="review-stars">★★★★★</div>
                        <div class="review-date">02/03/2024</div>
                    </div>
                </div>
                <div class="review-text">
                    "Incrível o trabalho que fazem! Adotei um vira-lata e a equipe foi muito honesta sobre todo o histórico do animal. Meu Max é a alegria da casa, muito grato por todo cuidado."
                </div>
                <div class="review-pet">
                    <img src="vira-lata.png" alt="Vira-lata">
                    <div class="review-pet-info">
                        <h5>Max</h5>
                        <p>Vira-lata - Adotado em 25/02/2024</p>
                    </div>
                </div>
            </div>

            <!-- Avaliação 5 -->
            <div class="review-box">
                <div class="review-header">
                    <img src="avatar5.png" alt="Carla Rodrigues" class="review-avatar">
                    <div class="review-info">
                        <h4>Carla Rodrigues</h4>
                        <div class="review-stars">★★★★★</div>
                        <div class="review-date">28/02/2024</div>
                    </div>
                </div>
                <div class="review-text">
                    "Adoção responsável e humanizada. Fizeram várias visitas para garantir que o ambiente era adequado e deram todas as orientações. Meu Sphynx é único, saudável e muito carinhoso!"
                </div>
                <div class="review-pet">
                    <img src="Sphynx.png" alt="Sphynx">
                    <div class="review-pet-info">
                        <h5>Cleo</h5>
                        <p>Sphynx - Adotada em 20/02/2024</p>
                    </div>
                </div>
            </div>

            <!-- Avaliação 6 -->
            <div class="review-box">
                <div class="re  view-header">
                    <img src="avatar6.png" alt="Ricardo Alves" class="review-avatar">
                    <div class="review-info">
                        <h4>Ricardo Alves</h4>
                        <div class="review-stars">★★★★★</div>
                        <div class="review-date">25/02/2024</div>
                    </div>
                </div>
                <div class="review-text">
                    "Profissionalismo e amor pelos animais em primeiro lugar. Adotei um Labrador que já foi treinado basicamente. O acompanhamento pós-adoção fez toda diferença na adaptação."
                </div>
                <div class="review-pet">
                    <img src="Labrador.png" alt="Labrador">
                    <div class="review-pet-info">
                        <h5>Rex</h5>
                        <p>Labrador - Adotado em 18/02/2024</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>