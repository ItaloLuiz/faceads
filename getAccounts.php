<?php header('Content-Type: application/json');
 include 'admin/classe_bd/vendor/autoload.php';
 include 'admin/config/conn.php';
 include 'funcoes.php';

 $query_contas = QB::table('tbl_contas');
 $qtda = $query_contas->count();
 $result_contas = $query_contas->get();

 $to_json = json_encode($result_contas);

 echo $to_json;
 exit;