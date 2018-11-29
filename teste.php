<?php

$senha = 'minhasenha123';
$hash  = password_hash($senha, PASSWORD_DEFAULT);
echo $hash;
echo '<br>';
$seta_hash = '$2y$10$.rHojXPzJA82QGMPj.rLIe8On8XGRPDExCWoKwA3ydP85qgRrAyNC';

if (password_verify($senha, $seta_hash)) {
    echo 'valida';
} else {
    echo 'invalida';
}