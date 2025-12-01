<?php
session_start();
include('../verifica_login.php');
include('../../src/conexao.php');

$query = "SELECT id, designacao FROM categoria";
$categorias = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestão de Categorias - #Caraderica</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="../css/dashboard.css"> 
</head>
<body>
    <button id="sidebarToggle" class="sidebar-toggle">
    <i class="bi bi-list"></i>
    </button>
<nav class="sidebar d-flex flex-column">
    <h2>#Caraderica</h2>
    <ul class="nav flex-column mt-3" style="list-style: none; padding-left: 0;">
        <li class="nav-item"><a class="nav-link" href="../adm/dashboard.php"><i class="bi bi-house-door me-2"></i>Início</a></li>
        <li class="nav-item"><a class="nav-link" href="../worker/list.php"><i class="bi bi-people me-2"></i>Funcionários</a></li>
        <li class="nav-item"><a class="nav-link" href="../service/list.php"><i class="bi bi-scissors me-2"></i>Serviços</a></li>
        <li class="nav-item"><a class="nav-link active" href="list.php"><i class="bi bi-tags me-2"></i>Categorias</a></li>
        <li class="nav-item"><a class="nav-link" href="../booking/list.php"><i class="bi bi-calendar-check me-2"></i>Marcações</a></li>
        <li class="nav-item mt-auto"><a class="nav-link logout" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
    </ul>
</nav>

<div class="content container-fluid">
    <header class="mb-4">
        <h1>Gestão de Categorias</h1>
        <p>Visualize, edite ou remova categorias existentes.</p>
    </header>

    <section class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Lista de Categorias</h2>
            <a href="create.php" class="btn_primary">➕ Adicionar Categoria</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID da Categoria</th>
                        <th>Designação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(mysqli_num_rows($categorias) > 0){
                    foreach($categorias as $categoria){
                        ?><tr>
                            <td><?= $categoria['id'] ?></td>
                            <td><?= $categoria['designacao'] ?></td>
                            <td class='table-actions'>
                                <a href='view.php?id=<?= $categoria['id'] ?>' class='btn_ver'>Ver</a>
                                <a href='edit.php?id=<?= $categoria['id'] ?>' class='btn_editar'>Editar</a>
                                <a href='delete.php?id=<?= $categoria['id'] ?>' class='btn_apagar'>Apagar</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Nenhuma categoria encontrada.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const toggle = document.getElementById('sidebarToggle');

        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>
</body>
</html>
