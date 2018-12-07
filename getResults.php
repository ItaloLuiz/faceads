<?php header('Content-Type: application/json');
 include 'admin/classe_bd/vendor/autoload.php';
 include 'admin/config/conn.php';
 include 'funcoes.php';

 if(!isset($_GET['id']) || empty($_GET['id'])){
       echo '[{"erro":"informe o id de uma campanha"}]';
       exit();
       die();
 }

 //caso queira setar uma data estática
$dt_primeiro_dia = date('Y-m').'-01';

 $get_conta = $_GET['id'];

 $seleciona_especifico_mes = QB::table('tbl_log_ads')
 ->selectDistinct(array('tbl_log_ads.reach', 'tbl_log_ads.spend'))
 ->where('account_id','=',$get_conta)
 ->where('data_inicio','=',$dt_primeiro_dia);

 $contar = $seleciona_especifico_mes->count();

 if($contar <=0){
      echo '[{"erro":"campanha não encontrada"}]';
      exit();
      die();
 }

 $result_especifico_mes = $seleciona_especifico_mes->get();

 $total_gasto_mes   = 0;
 $total_alcance_mes = 0;
  foreach($result_especifico_mes as $row){
        $total_gasto_mes   += $row->spend;
        $total_alcance_mes += $row->reach;       

  }

 $saida = '[{"campaign_id":"'.$get_conta.'","Total gasto":"'.$total_gasto_mes.'","Total alcance":"'.$total_alcance_mes.'"}]';
 echo $saida;

 exit;