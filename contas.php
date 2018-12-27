<?php
 include 'admin/classe_bd/vendor/autoload.php';
 include 'admin/config/conn.php';
 include 'funcoes.php';
 include 'config.php';

 if(empty($_GET['dt_ini']) || empty($_GET['dt_fim'])){
   echo 'Informe a data de inicio e a data de fim, exemplo: inicio 2018-12-01 , fim = 2018-12-28';
   exit();
   die();
 }

 //http://localhost/faceads/contas.php?dt_ini=2018-12-01&dt_fim=2018-12-17
 //select * from tbl_log_ads where data_inicio='2018-12-01' AND account_id='378016222658222'
 
 $data_ini = $_GET['dt_ini'];
 $data_fim = $_GET['dt_fim'];


 $query_contas = QB::table('tbl_contas');
 $qtda = $query_contas->count();
 $result_contas = $query_contas->get();


 foreach($result_contas as $row){
   echo CadLogs($row->account_id,$base_url,$data_ini,$data_fim);  
}
   
