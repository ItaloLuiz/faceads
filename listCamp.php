<?php header('Content-Type: application/json');
 include 'admin/classe_bd/vendor/autoload.php';
 include 'admin/config/conn.php';
 include 'funcoes.php';

//$get_conta = $_GET['id'];

//caso queira setar uma data estática
$dt_primeiro_dia = date('Y-m').'-01';

$query_log = QB::table('tbl_log_ads')
->orderBy('data_insercao','desc');

$contar = $query_log->count();


$result_log = $query_log->get();
$to_json = json_encode($result_log);
echo $to_json;

exit;