<?php header('Content-Type: application/json');
 include 'admin/classe_bd/vendor/autoload.php';
 include 'admin/config/conn.php';
 include 'funcoes.php';

 //caso queira setar uma data estática
//$dt_primeiro_dia = date('Y-m').'-01';

$dt_primeiro_dia = $_GET['dt_ini'];

$explode = explode("-",$dt_primeiro_dia);

$mes = $explode[1];    
$ano = $explode[0];
$ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));

$dt_ultimo_dia = date('Y-m').'-'.$ultimo_dia;
$get_conta = $_GET['id'];



$sql = "SELECT nome_unidade as unidade, campaign_id,campaign_name,
reach,spend,data_inicio,data_final
FROM tbl_log_ads
INNER JOIN tbl_contas
ON tbl_log_ads.account_id = tbl_contas.account_id
WHERE campaign_id='$get_conta'
AND data_inicio BETWEEN '$dt_primeiro_dia' AND '$dt_ultimo_dia'
ORDER BY unidade
";

//echo $sql;

//echo '<br>';

$seleciona_especifico_mes = QB::query($sql);


/*$seleciona_especifico_mes = QB::table('tbl_log_ads')
->selectDistinct(array('tbl_log_ads.reach', 'tbl_log_ads.spend','data_inicio','data_final'))
->where('campaign_id','=',$get_conta)
->where('data_inicio','=',$dt_primeiro_dia);*/

$result_especifico_mes = $seleciona_especifico_mes->get();
$contar = count($result_especifico_mes);

if($contar <=0){
    echo 'sem-dados';
}else{
     $to_json = json_encode($result_especifico_mes);
     echo $to_json;
}

exit;