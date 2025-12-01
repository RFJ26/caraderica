<?php
session_start();
include ('../app/public/verifica_login.php');
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Painel do Funcionário - #Caraderica</title>
</head>
<body>
    <div class="sidebar">
        <h2>#Caraderica</h2>
        <ul>
            <li><a href="dashboard.php">🏠 Início</a></li>
            <li><a href="#">📅 Minhas Marcações</a></li>
            <li><a href="#">🕒 Indisponibilidades</a></li>
            <li><a href="#">👤 Perfil</a></li>
            <li><a href="/logout.php" class="logout">🚪 Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <header>
            <h1>Bem-vindo(a), <?php echo $_SESSION['nome']; ?></h1>
            <p>Painel do Funcionário</p>
        </header>

        <section class="info">
            <h2>Hoje</h2>
            <p>Aqui podes visualizar as tuas marcações e gerir a tua disponibilidade.</p>

            <div class="cards">
                <div class="card">
                    <h3>Marcações</h3>
                    <p>Consulta as marcações do dia e o estado de cada cliente.</p>
                </div>
                <div class="card">
                    <h3>Indisponibilidades</h3>
                    <p>Bloqueia horários em que não estás disponível.</p>
                </div>
                <div class="card">
                    <h3>Perfil</h3>
                    <p>Atualiza as tuas informações e contacto.</p>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
