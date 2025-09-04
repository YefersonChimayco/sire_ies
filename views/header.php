<header class="header">
    <div class="logo">
        <h1>SIRE IESHUANTA</h1>
    </div>
    <?php if (isset($_SESSION['username'])): ?>
        <nav class="user-nav">
            <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="index.php?controller=auth&action=logout" class="logout-btn">Salir</a>
        </nav>
    <?php endif; ?>
</header>