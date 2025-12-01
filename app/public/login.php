<?php
session_start();
include ('../src/conexao.php');

if (empty($_POST['email']) || empty($_POST['password'])) {
    header('Location: index.php');
    exit();
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = "SELECT id, nome, adm FROM funcionario WHERE email = '{$email}' AND palavra_passe = md5('{$password}')";

$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);

if ($row ==1){
    $_SESSION['email'] = $email;
    $dados = mysqli_fetch_array($result);
    $_SESSION['nome'] = $dados['nome'];
    $_SESSION['id'] = $dados['id'];
    if ($dados['adm'] == 1){
        header('Location: ../adm/dashboard.php');

    }else{
        header('Location: ../worker/dashboard.php');
    }
}else{
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();

}