<?php
session_start();
include('../verifica_login.php');
include('../../src/conexao.php');

// Consultas para métricas
$total_marcacoes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM marcacao"))['total'];
$total_categorias = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM categoria"))['total'];
$total_clientes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM cliente"))['total'];

// Consulta últimas marcações
$marcacoes_query = "
SELECT 
    cliente.nome AS cliente,
    funcionario.nome AS funcionario,
    servico.designacao AS servico,
    marcacao.data,
    marcacao.estado
FROM marcacao
JOIN cliente ON marcacao.id_cliente = cliente.id
JOIN servico_funcionario ON marcacao.id_servico_funcionario = servico_funcionario.id
JOIN funcionario ON servico_funcionario.id_funcionario = funcionario.id
JOIN servico ON servico_funcionario.id_servico = servico.id
ORDER BY marcacao.data DESC
LIMIT 7;
";
$marcacoes = mysqli_query($conn, $marcacoes_query);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Funcionário #Caraderica</title>
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
            <li class="nav-item"><a class="nav-link active" href="dashboard.php"><i class="bi bi-house-door me-2"></i>Início</a></li>
            <li class="nav-item"><a class="nav-link" href="../worker/list.php"><i class="bi bi-people me-2"></i>Funcionários</a></li>
            <li class="nav-item"><a class="nav-link" href="../service/list.php"><i class="bi bi-scissors me-2"></i>Serviços</a></li>
            <li class="nav-item"><a class="nav-link" href="../service_category/list.php"><i class="bi bi-tags me-2"></i>Categorias</a></li>
            <li class="nav-item"><a class="nav-link" href="../booking/list.php"><i class="bi bi-calendar-check me-2"></i>Marcações</a></li>
            <li class="nav-item mt-auto"><a class="nav-link logout" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
        </ul>
    </nav>

    <div class="content container-fluid">
        <header class="mb-4">
            <h1>Bem-vindo(a), <?= $_SESSION['nome'] ?></h1>
            <p>Painel do Administrador</p>
        </header>

        <section class="metrics-section mb-4">
            <div class="metrics d-flex gap-3 flex-wrap">
                <div class="metric-card p-3 text-center flex-grow-1">
                    <div class="card-title"><?= $total_marcacoes ?></div>
                    <div class="card-text">Marcações</div>
                </div>
                <div class="metric-card p-3 text-center flex-grow-1">
                    <div class="card-title"><?= $total_categorias ?></div>
                    <div class="card-text">Categorias de Serviços</div>
                </div>
                <div class="metric-card p-3 text-center flex-grow-1">
                    <div class="card-title"><?= $total_clientes ?></div>
                    <div class="card-text">Clientes</div>
                </div>
            </div>
        </section>

        <section class="table-section">
            <h2>Últimas Marcações</h2>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Funcionário</th>
                            <th>Serviço</th>
                            <th>Data</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(mysqli_num_rows($marcacoes) > 0){
                            while($row = mysqli_fetch_assoc($marcacoes)){
                                echo "<tr>
                                    <td>{$row['cliente']}</td>
                                    <td>{$row['funcionario']}</td>
                                    <td>{$row['servico']}</td>
                                    <td>{$row['data']}</td>
                                    <td>{$row['estado']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Nenhuma marcação encontrada.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.querySelector('.sidebar'); // vai buscar a sidebar
        const toggle = document.getElementById('sidebarToggle'); // vai buscar o botao

        toggle.addEventListener('click', () => { // adiciona o evento de click
            sidebar.classList.toggle('active'); // alterna no css para mostrar/esconder
        });
    </script>


</body>
</html>
