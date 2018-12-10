<?php session_start();

include 'admin/classe_bd/vendor/autoload.php';
include 'admin/config/conn.php';
include 'funcoes.php';
include 'config.php';


$consulta1  = QB::table('tbl_log_ads');
$result_1   = $consulta1->get();
$data_insercao_1 = $result_1[0]->data_insercao;
$secao = $_SESSION['testa'] = $data_insercao_1;

echo $secao;
