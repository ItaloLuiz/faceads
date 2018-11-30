<?php 
include 'vendor/autoload.php';



$base_url = 'http://localhost/faceads/';
$app_id = '';
$app_secret = '';
$access_token = '';
$account_id = '';

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
    'spend',
    'impressions'
    //'actions'
     
);

$data_inicio = date('Y-m').'-01';
$data_final = date('Y-m-d');

echo '<pre>';
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

print_r($to_array);

die;

$reach = 0;
$spend = 0;
foreach($to_array['data'] as $row){
    $reach += $row['reach'];
    $spend += $row['spend'];    
}

echo 'Alcance: '.$reach;
echo '<br>';
echo 'Total: '.$spend;