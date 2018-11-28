<?php 
include 'vendor/autoload.php';
require 'config.php';

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
    //'cpc',
    'campaign_name',
    //'clicks',
    //'cpm',
    'impressions',    
    'reach',
    'spend',
    //'social_spend'
    
);

//echo '<pre>';
//print_r($dados);

$params = array(
    'level'      => 'campaign',
    //'filtering'  => array(array('field' => 'delivery_info','operator' => 'IN','value' => array('active','limited'))),
    //'breakdowns' => array(),
    'time_range' => array('since' => '2018-11-01','until' => '2018-11-28'),
  );

$resultado = json_encode((new AdAccount($account_id))->getInsights(
    $fields,
    $params
  )->getResponse()->getContent(), JSON_PRETTY_PRINT);

  //echo $resultado;

  $to_array = json_decode($resultado,true);
  $qtda = count($to_array);

//print_r($to_array);

$reach = 0;
$spend = 0;
foreach($to_array['data'] as $row){
    $reach += $row['reach'];
    $spend += $row['spend'];    
}

echo 'Alcance: '.$reach;
echo '<br>';
echo 'Total: '.$spend;