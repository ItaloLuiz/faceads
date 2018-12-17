<?php header('Content-Type: application/json');
 include 'admin/classe_bd/vendor/autoload.php';
 include 'admin/config/conn.php';
 include 'funcoes.php';

 //caso queira setar uma data estática
$dt_primeiro_dia = date('Y-m').'-01';

$get_conta = $_GET['id'];

$seleciona_especifico_mes = QB::table('tbl_log_ads')
->selectDistinct(array('tbl_log_ads.reach', 'tbl_log_ads.spend','data_inicio','data_final'))
->where('campaign_id','=',$get_conta)
->where('data_inicio','=',$dt_primeiro_dia);



$result_especifico_mes = $seleciona_especifico_mes->get();



$to_json = json_encode($result_especifico_mes);
echo $to_json;

exit;