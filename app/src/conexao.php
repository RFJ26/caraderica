<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '12345678');
define('DB_NAME', 'hastagcaraderica');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Erro na conexão à base de dados");
