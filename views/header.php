<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="header">
    <div class="logo">
        <img src="assets/logo.png" alt="Logo" class="logo-img">
        <h1>SIRE IESHUANTA</h1>
    </div>

    <?php if (isset($_SESSION['username'])): ?>
        <nav class="user-nav">
            <span class="user-name">👤 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="index.php?controller=auth&action=logout" class="logout-btn">🚪 Salir</a>
        </nav>
    <?php endif; ?>
</header>
