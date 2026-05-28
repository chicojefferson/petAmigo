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