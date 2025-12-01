<?php
session_start();
session_destroy();
header('Location: index.php');
exit();

#Destruir uma sessao: unset($_SESSION['NOMEDASESSAO']);