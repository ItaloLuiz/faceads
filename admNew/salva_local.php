<?php session_start();

$get_val = $_POST['select'];
$secao_lista = $_SESSION['lista'] = $get_val;