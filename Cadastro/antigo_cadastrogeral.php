<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - PetAmigo</title>
    <link rel="stylesheet" href="../Home/home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .cadastro-container {
            max-width: 600px;
            margin: 120px auto 4rem;
            padding: 2rem;
            background: #1a1a1a;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(255,255,255,0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #fff;
        }
        
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #333;
            border-radius: 5px;
            background: #000;
            color: #fff;
        }
    </style>
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

    <div class="cadastro-container">
        <h2 class="title" style="text-align: center; margin-bottom: 2rem;">Cadastro <span>PetAmigo</span></h2>
        
        <form action="processa_cadastro.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" required>
            </div>
            
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <textarea id="endereco" name="endereco" rows="3" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="pet_interesse">Pet de Interesse</label>
                <select id="pet_interesse" name="pet_interesse">
                    <option value="">Selecione um pet</option>
                    <option value="golden">Golden Retriever</option>
                    <option value="labrador">Labrador</option>
                    <option value="shih_tzu">Shih Tzu</option>
                    <option value="maine_coon">Maine Coon</option>
                    <option value="persa">Persa</option>
                    <option value="sphynx">Sphynx</option>
                </select>
            </div>
            
            <button type="submit" class="btn" style="width: 100%;">Cadastrar</button>
        </form>
        
        <p style="text-align: center; margin-top: 1rem; color: #ccc;">
            Já tem cadastro? <a href="../Login/login.php" style="color: #3498db;">Faça login aqui</a>
        </p>
    </div>

    <?php include '../footer.php'; ?>

</body>

</html>