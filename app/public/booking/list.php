<?php
session_start();
include('../verifica_login.php');
include('../../src/conexao.php');

$query = "SELECT
            cliente.id AS id_cliente,
            cliente.nome AS nome_cliente,
            marcacao.id AS id_marcacao,
            marcacao.data AS data_marcacao,
            funcionario.nome AS nome_funcionario,
            marcacao.estado AS estado_marcacao,
            servico.designacao AS designacao_servico
          FROM marcacao
          INNER JOIN cliente
              ON marcacao.id_cliente = cliente.id
          INNER JOIN servico_funcionario
              ON marcacao.id_servico_funcionario = servico_funcionario.id
          INNER JOIN funcionario
              ON servico_funcionario.id_funcionario = funcionario.id
          INNER JOIN servico
              ON servico_funcionario.id_servico = servico.id
          ORDER BY data_marcacao DESC";

$marcacoes = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestão de Marcações - #Caraderica</title>
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
        <li class="nav-item"><a class="nav-link" href="../service_category/list.php"><i class="bi bi-tags me-2"></i>Categorias</a></li>
        <li class="nav-item"><a class="nav-link active" href="list.php"><i class="bi bi-calendar-check me-2"></i>Marcações</a></li>
        <li class="nav-item mt-auto"><a class="nav-link logout" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
    </ul>
</nav>

<div class="content container-fluid">
    <header class="mb-4">
        <h1>Gestão de Marcações</h1>
        <p>Visualize, edite ou remova marcações existentes.</p>
    </header>

    <section class="table-section">
        <h2>Lista de Marcações</h2>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Cliente</th>
                        <th>Nome Cliente</th>
                        <th>Nome Funcionário</th>
                        <th>Serviço</th>
                        <th>Data de Marcação</th>
                        <th>Estado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(mysqli_num_rows($marcacoes) > 0){
                    foreach($marcacoes as $marcacao){
                        ?><tr>
                            <td><?= $marcacao['id_marcacao'] ?></td>
                            <td><?= $marcacao['id_cliente'] ?></td>
                            <td><?= $marcacao['nome_cliente'] ?></td>
                            <td><?= $marcacao['nome_funcionario'] ?></td>
                            <td><?= $marcacao['designacao_servico'] ?></td>
                            <td><?= $marcacao['data_marcacao'] ?></td>
                            <td><?= $marcacao['estado_marcacao'] ?></td>
                            <td class='table-actions'>
                                <a href='view.php?id=<?= $marcacao['id_marcacao'] ?>' class='btn_ver'>Ver</a>
                                <a href='edit.php?id=<?= $marcacao['id_marcacao'] ?>' class='btn_editar'>Editar</a>
                                <a href='delete.php?id=<?= $marcacao['id_marcacao'] ?>' class='btn_apagar'>Apagar</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Nenhuma marcação encontrada.</td></tr>";
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
