<?php
session_start();
include('../verifica_login.php');
include('../../src/conexao.php');

$query = "SELECT id, nome, email, telefone, adm FROM funcionario";
$funcionarios = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gerir Funcionários - #Caraderica</title>
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
        <li class="nav-item"><a class="nav-link active" href="list.php"><i class="bi bi-people me-2"></i>Funcionários</a></li>
        <li class="nav-item"><a class="nav-link" href="../service/list.php"><i class="bi bi-scissors me-2"></i>Serviços</a></li>
        <li class="nav-item"><a class="nav-link" href="../service_category/list.php"><i class="bi bi-tags me-2"></i>Categorias</a></li>
        <li class="nav-item"><a class="nav-link" href="../booking/list.php"><i class="bi bi-calendar-check me-2"></i>Marcações</a></li>
       <li class="nav-item mt-auto"><a class="nav-link logout" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
    </ul>
</nav>

<div class="content container-fluid">
    <header class="mb-4">
        <h1>Gestão de Funcionários</h1>
        <p>Visualize, edite ou remova funcionários existentes.</p>
    </header>

    <section class="table-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Lista de Funcionários</h2>
            <a href="create.php" class="btn_primary">➕ Adicionar Funcionário</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Administrador</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(mysqli_num_rows($funcionarios) > 0){
                        foreach($funcionarios as $funcionario){
                            ?> <tr>
                                <td><?= $funcionario['id'] ?></td>
                                <td><?= $funcionario['nome'] ?></td>
                                <td><?= $funcionario['email'] ?></td>
                                <td><?= $funcionario['telefone'] ?></td>
                                <td><?= ($funcionario['adm'] ? 'Sim' : 'Não') ?></td>
                                <td class='table-actions'>
                                    <a href='view.php?id=<?= $funcionario['id'] ?>' class='btn_ver'>Ver</a>
                                    <a href='edit.php?id=<?= $funcionario['id'] ?>' class='btn_editar'>Editar</a>
                                    <a href='delete.php?id=<?= $funcionario['id'] ?>' class='btn_apagar'>Apagar</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Nenhum funcionário encontrado.</td></tr>";
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
