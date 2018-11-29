<?php ob_start();
if(!isset($_GET['conta']) || empty($_GET['conta'])){    
    exit;
    die;
}
include 'admin/classe_bd/vendor/autoload.php';
include 'admin/config/conn.php';

include 'vendor/autoload.php';
require 'config.php';
//$account_id = 'act_258725951253917';// esse dado sera informado via get
$account_id = 'act_'.$_GET['conta'];

use FacebookAds\Api;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\AdsInsights;

// Initialize a new Session and instantiate an Api object
Api::init($app_id, $app_secret, $access_token);
$api = Api::instance();
/*
Os campos possiveis podem ser pegos no seguinte endereço
https://developers.facebook.com/docs/marketing-api/reference/ads-insights
*/
$fields = array(    
    'account_id',
    'campaign_id',    
    'campaign_name',      
    'reach',
    'spend' 
);

$data_inicio = date('Y-m').'-01';
$data_final = date('Y-m-d');

//echo '<pre>';
//print_r($dados);

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
    $reach += $row['reach'];
    $spend += $row['spend'];   
    
    $account_id    = $row['account_id'];
    $campaign_id   = $row['campaign_id'];
    $campaign_name = $row['campaign_name'];    

$dados = array(
'account_id'=>$account_id,
'campaign_id'=>$campaign_id, 
'campaign_name'=>$campaign_name,     
'reach'=>$reach,
'spend'=>$spend,
'data_inicio'=>$data_inicio,
'data_final'=>$data_final
);

$insert = QB::table('tbl_log_ads')->insert($dados);
}

if(!$insert){
    echo 'erro';
}else{
    echo 'ok';
}

