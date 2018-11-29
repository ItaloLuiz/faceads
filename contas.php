<?php
 include 'admin/classe_bd/vendor/autoload.php';
 include 'admin/config/conn.php';
 include 'funcoes.php';
 include 'config.php';


 $query_contas = QB::table('tbl_contas');
 $qtda = $query_contas->count();
 $result_contas = $query_contas->get();


 foreach($result_contas as $row){
   echo CadLogs($row->account_id,$base_url);  
}
   
