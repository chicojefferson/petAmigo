<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
    <link rel="stylesheet" href="login.css">
     <title>DevClub Login</title>

</head>
<body>
<!--parte do ruan-->
    <header class="header">

       <section>
            <a href="#" class="logo">
                <img src="petlogo.png" alt="logo">
                
            </a>


            <nav class="navbar">
                <a href="\Projeto_Pet\Home\home.php">Home</a>
                <a href="\Projeto_Pet\Sobre\sobre.php">Sobre</a>
                <a href="\Projeto_Pet\Menu\menu.php">Menu</a>
                <a href="\Projeto_Pet\Avaliações\avaliacoes.php">Avaliações</a>
                <a href="address">Endereço</a>
                <a href="\Projeto_Pet\Cadastro Geral 2\cadastrogeral.php">Cadastro Geral</a>
                <a href="\Projeto_Pet\Login\login.php">Login</a>
            </nav>

            <div class="icon">
                <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/ffffff/search--v1.png"
                    alt="search--v1" />

                <img width="30" height="30"
                    src="https://img.icons8.com/material-outlined/24/ffffff/shopping-cart--v1.png"
                    alt="shopping-cart--v1" />
            </div>
        </section>
    </header>

<!-- fim parte do ruan-->


    <main class="container">
        <form>
            <h>Login Pet Amigo</h>

           
        <div class="input-box">
            <input placeholder="Usuário" type="email">
            <i class="bx bxs-user"></i>

        </div>

        <div class="input-box">
            <input placeholder="Senha" type="password">
            <i class="bx bxs-lock-alt"></i>

        </div>

        <di class="remember-forgot">
            <label>
                <input type="checkbox">
                Lembrar senha 
            </label>

            <a href="#">Esqueci a senha</a>
        </di>

        <button type="button" class="login">Login <a href=""></a></button>

        <div class="register-link">
            <p>Não tem uma conta? <a href="../Cadastro Geral/cadastrogeral.html">Cadastre-se</a></p>
        </div>
    </form>

    </main>


    
</body>
</html>