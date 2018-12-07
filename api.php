<?php ob_start();
if(!isset($_POST['conta']) || empty($_POST['conta'])){    
    exit();
    die();
}

if(empty($_POST['data_ini']) || empty($_POST['data_fim'])){
    echo 'Informe a data de inicio e a data de fim, exemplo: inicio 2018-12-01 , fim = 2018-12-28.<br>';
    exit();
    die();
  }

/*
## OBJETIVO

Pegar dados de alcance e gasto total das campanhas.
Para melhor resultado a APP deve ser criado na conta empresarial, porque
futuramente o facebook fara uma "checagem" e podera pedir documentos da empresa.

Os campos possiveis podem ser pegos no seguinte endereço
https://developers.facebook.com/docs/marketing-api/reference/ads-insights

## DIFERENÇA NO ALCANCE DAS CAMPANHAS
https://www.quintly.com/blog/facebook-post-reach-explained

*/
include 'admin/classe_bd/vendor/autoload.php';
include 'admin/config/conn.php';

include 'vendor/autoload.php';
require 'config.php';
//$account_id = 'act_258725951253917';// esse dado sera informado via get
$account_id = 'act_'.$_POST['conta'];

use FacebookAds\Api;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\AdsInsights;

// Initialize a new Session and instantiate an Api object
Api::init($app_id, $app_secret, $access_token);
$api = Api::instance();

$fields = array(    
    'account_id',
    'campaign_id',    
    'campaign_name',      
    'reach',
    'spend'
    
);

/*
facebook trabalha com intervalo máximo de 28 dias, 
então a ideia abaixo é setar o inicio como 01
e analisar, se o dia for maior que 28 ele pega 28,
se menor ele pega o dia atual
*/

$dia = date('d');

if($dia < '28'){
    $dia = $dia;
}elseif($dia > '28'){
    $dia = '28';
}else{
    $dia == '28';
}


/*$data_inicio = date('Y-m').'-01';
$data_final = date('Y-m').'-'.$dia;*/

/*
Para dar mais controle de data foi modficado a forma de usar este dado,
anteriormente a data era informada baseado no primeiro dia do mês atual e 
como data final o máximo permitido seria ate o dia 28 de cada mês.
*/

$data_inicio = $_POST['data_ini'];
$data_final  = $_POST['data_fim'];



$params = array(
    'level'      => 'campaign',   
    'time_range' => array('since' => ''.$data_inicio.'','until' => ''.$data_final.''),
  );

$resultado = json_encode((new AdAccount($account_id))->getInsights(
    $fields,
    $params
  )->getResponse()->getContent(), JSON_PRETTY_PRINT);

  //echo $resultado;

  $to_array = json_decode($resultado,true);
  $qtda = count($to_array);

  //echo '<pre>';
  //print_r($to_array);


$reach = 0;
$spend = 0;
foreach($to_array['data'] as $row){
    /*soma os valores
    $reach += $row['reach'];
    $spend += $row['spend'];*/

    $reach = $row['reach'];
    $spend = $row['spend'];   
    
    $account_id    = $row['account_id'];
    $campaign_id   = $row['campaign_id'];
    $campaign_name = $row['campaign_name'];    

    $data_insercao = date('Y-m-d H:i:s');

$dados = array(
  'account_id'   =>$account_id,
  'campaign_id'  =>$campaign_id, 
  'campaign_name'=>$campaign_name,     
  'reach'=>$reach,
  'spend'=>$spend,
  'data_inicio'=>$data_inicio,
  'data_final' =>$data_final
);

$dataUpdate = array(    
  'reach'=>$reach,
  'spend'=>$spend,
  'data_inicio'=>$data_inicio,
  'data_final' =>$data_final,
  'data_insercao'=>$data_insercao
);

/*$consulta  = QB::table('tbl_log_ads')->where('account_id','=',$account_id);
$contar    = $consulta->get();*/

/*
SQL "puro"
$sql = "INSERT INTO tbl_log_ads (account_id,campaign_id,campaign_name,reach,spend,data_inicio,data_final)
      VALUES ('$account_id','$campaign_id','$campaign_name','$reach','$spend','$data_inicio','$data_final')
      ON DUPLICATE KEY UPDATE reach = '$reach', spend = '$spend' ";
$insert = QB::query($sql);*/

//usar o padrão da classe
$insert = QB::table('tbl_log_ads')->onDuplicateKeyUpdate($dataUpdate)->insert($dados);


}



if(!@$insert){
    echo 'erro.<br>';
}else{
    echo 'ok.<br>';
}

