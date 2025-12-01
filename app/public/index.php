<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#Caraderica</title>
    
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
  <div class="container">
    <img src="images/logo.png" alt="Logo do Site" class="logo">    
    <div class="login-box">
      <h2>Iniciar Sessão</h2>
      <?php
        if (isset($_SESSION['nao_autenticado'])):?>
                    <div class="notification">
                      <p>ERRO: Utilizador ou palavra-passe inválidos.<br></p>
                    </div> 
        <?php
        unset($_SESSION['nao_autenticado']);  
        endif;
        ?>
      <form action="login.php" method="POST">
         <label for="email">Email</label>
           <input type="email" id="email" name="email" required>
        <br> <br>
        <label for="password">Palavra-passe</label>
        <input type="password" id="password" name="password" required>
        <br> <br>
        <button type="submit">Entrar</button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  
</body>
</html>

