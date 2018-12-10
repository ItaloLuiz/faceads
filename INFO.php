<?php session_start(); ob_start();


include 'admin/classe_bd/vendor/autoload.php';
include 'admin/config/conn.php';

include 'vendor/autoload.php';
require 'config.php';

$account_id = 'act_299619287317651';

$consulta1  = QB::table('tbl_log_ads')->select('data_insercao');
$result_1   = $consulta1->get();
$data_insercao_1 = $result_1[0]->data_insercao;
$secao = $_SESSION['testa'] = $data_insercao_1; 

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
    'actions',
    'action_values',
    'clicks'
    
    //'unique_actions',
    
);

$data_inicio = '2018-11-10';
$data_final  = '2018-12-09';

/*$data_inicio = $_POST['dt_ini'];
$data_final  = $_POST['dt_fim'];*/

//echo '<pre>';
//print_r($dados);

$params = array(
    'level'      => 'campaign',   
    'time_range' => array('since' => ''.$data_inicio.'','until' => ''.$data_final.''),
  );

  try {
    $resultado = json_encode((new AdAccount($account_id))->getInsights(
        $fields,
        $params
      )->getResponse()->getContent(), JSON_PRETTY_PRINT);
    
      //echo $resultado;
    
      $to_array = json_decode($resultado,true);
      $qtda = count($to_array);

      echo '<pre>';

      print_r($to_array);

      foreach($to_array['data'] as $row){

//print_r($row);

//$actions = $row['unique_actions'];

//print_r($actions);

$account_id  = $row['account_id'];
$campaign_id = $row['campaign_id'];
$campaign_name = $row['campaign_name'];
$reach = $row['reach'];
$spend = $row['spend'];
echo $actions = json_encode($row['actions']);

/*
echo 'comment: ' .$comment = $row['actions'][0]['value'].'<br>';

*/

      }

    
   
      die;
    
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
    'account_id'=>$account_id,
    'campaign_id'=>$campaign_id, 
    'campaign_name'=>$campaign_name,     
    'reach'=>$reach,
    'spend'=>$spend,
    'data_inicio'=>$data_inicio,
    'data_final'=>$data_final
    );
    
    $dataUpdate = array(
        'campaign_id'=>$campaign_id, 
        'campaign_name'=>$campaign_name,     
        'reach'=>$reach,
        'spend'=>$spend,
        'data_insercao'=>$data_insercao
    );
    
 

  
    
    
    $insertId = QB::table('tbl_log_ads')->onDuplicateKeyUpdate($dataUpdate)->insert($dados);
    
    
    }
    
    if(!@$insert){//pode ser um erro ou pode ter sido um update, e ainda assim retornar erro

        $consulta  = QB::table('tbl_log_ads')->select('data_insercao');
        $result   = $consulta->get();
        $data_insercao = $result[0]->data_insercao;
      

              
        if( strtotime($secao) < strtotime($data_insercao)){
         echo 'Dados atualizados<br>';
         
        }
        

    }else{
        echo 'ok<br>';
    }
   
  } catch (\Throwable $th) {
      //throw $th;
      echo '<br>Erro na chamada a API => '.$th->getMessage().'<br>';

  }



