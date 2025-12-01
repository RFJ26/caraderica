<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('Location: ../index.php'); // sobe uma pasta e volta ao login
    exit();
}
